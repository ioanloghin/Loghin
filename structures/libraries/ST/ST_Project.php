<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class ST_Project
{
	// attributes
	private $projectID;	// (integer) id-ul grupului curente (sau o cheie unica de identificare)
	private $blockID;	// (integer) id-ul grupului superior
	private $deep;		// (integer) nivelul pe care se afla
	private $direction; // (enum(1-sus in jos,2-stanga spre dreapta)) // directia de afisare
	// dimensions
	public $width		= 0; // (integer) latimea containerului
	public $height		= 0; // (integer) inaltimea containerului
	// contained
	public static $groups = array(); // (array(id => instance,)) referinte catre grupurile structurii
	// sesiune
	const sess_key = 'struct-extends';
	public static $session;
	//
	// ========================================================================
	public function __construct($projectID, $blockID, $deep, $direction = 1)
	{
		// salveaza datele in variabilele obiectului
		$this->projectID = (int)$projectID;
		$this->blockID	 = (int)$blockID;
		$this->deep	 	 = (int)$deep;
		$this->direction = (int)$direction;
		
		// initializare sesiune pentru memorarea deschiderilor
		if(!isset($_SESSION[SESSION][self::sess_key]))
			$_SESSION[SESSION][self::sess_key] = array('groups' => array());
		
		// muta sesiunea in obiect
		self::$session =& $_SESSION[SESSION][self::sess_key];
		
		// selecteaza blocks din baza de date
		// $db_blocks[blockID] = array('db_key' => 'db_value');
		$db_blocks = Struct_model::get_blocks($this->projectID, $this->blockID, $this->deep);
		// datele vin ordonate crescator dupa nivel ('lvl')
		
		// organizeaza lista pe structuri erarhice
		$inferiors = array();
		foreach($db_blocks as $row_blockID => $row_info)
			$inferiors[$row_info['sup']][] = $row_blockID;
		
		// daca s-a speficicat un BlockID
		if($this->blockID)
		{
			$new_inferiors = array();
			reset($inferiors);
			$stiva = array();
			do
			{
				if($stiva)// daca sunt valori in stiva
				{
					$k_sup = end($stiva);
					$sup = key($stiva);
					array_pop($stiva);
				}
				else
				{
					$sup = (int)key($inferiors);// int
					$k_sup = 0;
					next($inferiors);
				}
				$inf = (array_key_exists($sup, $inferiors)) ? $inferiors[$sup] : array();
				if(($k_sup && array_key_exists($k_sup, $new_inferiors)) || ($sup == $this->blockID))
				{
					
					// introduce valoarea in noul array
					$new_inferiors[$sup] = $inf;
					
					// introduce valorile in stiva
					foreach($inf as $inf_id)
						$stiva[$inf_id] = $sup;
				}
				elseif($sup == 0 && in_array($this->blockID, $inf))
				{
					// introduce valoarea in noul array
					$new_inferiors[0] = array($this->blockID);
				}
			}
			while($inf || $stiva);
			
			// stergem valorile care nu sunt necesare
			/*foreach($inferiors as $sup_block => $inside_blocks)
				if(!array_key_exists($sup_block, $new_inferiors))
					unset($inferiors[$sup_block]);*/
			$inferiors = $new_inferiors;
			unset($new_inferiors);
		}
		
		// poti afla grupul unui block; $block2group[BLOCK_ID] = GROUP_ID;
		$block2group = array();
		
		// creaza gropuri de block-uri pe nivele
		// $groups[level][auto_key] = array(instance group);
		// important ca datele sa fie ordonate crescator dupa nivel
		$firstlevel;
		foreach($inferiors as $sup_block => $inside_blocks)
		{
			if(count($inside_blocks))
			{
				// stabileste nivelul curent
				$this_lvl = $db_blocks[current($inside_blocks)]['lvl'];
				
				// stabileste primul nivel
				if(!isset($firstlevel))
					$firstlevel = $this_lvl;
				
				// initializare
				if(!array_key_exists($this_lvl, self::$groups)) self::$groups[$this_lvl] = array();
				
				// numarul de grupuri pe acest nivel
				$brothers = count($inside_blocks);
				
				// parcurge blocurile de pe nivel
				foreach($inside_blocks as $row_blockID)
				{
					// stabileste id-ul grupului
					$gr_id = $this_lvl.count(self::$groups[$this_lvl]);// nr. nivel si nr. de index
					
					// daca nivelul curent este mai mare decat adancimea permisa SAU
					// daca nivelul curent este mai mic decat nivelul blocului din prim-plan, nu inregistram grupul
					if(($this_lvl > $this->deep) || (($this->blockID > 0) && ($this_lvl < $db_blocks[$this->blockID]['lvl'])))
						continue;
					
					// daca grupul se afla pe primul nivel, va fi afisat
					//if($firstlevel == $this_lvl)
						self::$session['groups'][] = $gr_id;
					
					// se creaza grupul
					self::$groups[$this_lvl][$gr_id] = new ST_Group($gr_id, $sup_block, $this_lvl, $this->direction);
					
					// numarul de frati
					self::$groups[$this_lvl][$gr_id]->brothers = $brothers;
					
					// se creaza si se adauga blocurile grupului
					self::$groups[$this_lvl][$gr_id]->insert_block($row_blockID, new ST_Block($row_blockID, $db_blocks[$row_blockID]['code'], $db_blocks[$row_blockID]['label'], $db_blocks[$row_blockID]['type']));
					
					// adauga acest grup la grupul parinte (daca are superior)
					if($sup_block > 0)
					{
						$parent = $block2group[$sup_block];// id-ul grupului parinte
						self::$groups[$this_lvl-1][$parent]->insert_group($parent, self::$groups[$this_lvl][$gr_id]/* referinta catre grupul curent */);
					}
					
					$block2group[$row_blockID] = $gr_id;// asociaza id block -> id group
					
				}
			}
		}
		
		// ordoneaza grupurile descrescator dupa nivel
		krsort(self::$groups);
		
		// parcurge toate nivelele (de la nivel maxim la nivel min) stabilind 'width' si 'height' pentru fiecare grup
		foreach(self::$groups as $gr_level => $gr_array)
		{
			// parcurge toate grupurile paralele de pe acest nivel
			foreach($gr_array as $gr_id => $group)
			{
				// dimensiunea maxima a blocurilor din interior
				// le avem deja stocate asa ca doar pe preluam
				$blocks_max_width	= $group->get('blocks_max_w');
				$blocks_max_height	= $group->get('blocks_max_h');
				
				// dimensiunea maxima a grupurilor din interior
				// pe acestea nu le avem asa ca trebuie sa le stabilim
				$groups_max_width	= 0;
				$groups_max_height	= 0;
				
				// parcurgem toate grupurile din interor si stabilim $groups_max_width si $groups_max_height
				switch($group->get('format'))
				{
					default:
					case 1:// grupurile sunt pe orizontala
						$index = 0;// numarul de ordin al grupului
						foreach($group->get_groups() as $obj_group)
						{
							// calculeaza latimea maxima
							$groups_max_width += $obj_group->full_width();
							if($index++ > 0)
								$groups_max_width += $obj_group->get('outside_x');
							
							// stabileste inaltimea maxima
							if($groups_max_height < $obj_group->full_height())
								$groups_max_height = $obj_group->full_height();	
						}
						// adaugam grupului curent valoarea pentru 'width'
						$group->set_width(($blocks_max_width > $groups_max_width) ? $blocks_max_width : $groups_max_width);
						
						// adaugam grupului curent valoarea pentru 'height'
						$group->set_height(($blocks_max_height/* inaltimea maxima pentru blocuri */ + $groups_max_height/* inaltimea maxima pentru grupuri */));
						break;
					case 2:// grupurile sunt pe verticala
						$index = 0;// numarul de ordin al grupului
						foreach($group->get_groups() as $obj_group)
						{
							// calculeaza inaltimea maxima
							$groups_max_height += $obj_group->full_height();
							if($index++ > 0)
								$groups_max_height += $obj_group->get('outside_y');
							
							// stabileste latimea maxima
							if($groups_max_width < $obj_group->full_width())
								$groups_max_width = $obj_group->full_width();
						}
						// adaugam grupului curent valoarea pentru 'width'
						$group->set_height(($blocks_max_height > $groups_max_height) ? $blocks_max_height : $groups_max_height);
							
						// adaugam grupului curent valoarea pentru 'height'
						$group->set_width(($blocks_max_width/* latimea maxima pentru blocuri */ + $groups_max_width/* latimea maxima pentru grupuri */));
						break;
				}
				
			}
		}
		
		// parcurge toate nivelele (de la nivel maxim la nivel min) stabilind 'left' si 'top' pentru fiecare grup
		// mai memoram si cel mai intalt grup si latimea totala a grupurilor
		$max_height = 0; $max_width = 0;
		$level_index = 0;// numarul nivelului curent
		$levels = count(self::$groups);// numarul de nivele
		foreach(self::$groups as $gr_level => $gr_array)
		{
			// incrementam numarul nivelului
			$level_index++;
			
			// parcurge toate grupurile paralele de pe acest nivel
			foreach($gr_array as $gr_id => $group)
			{
				// blocurile din interiorul acestui grup
				$inside_blocks = $group->get_blocks();
				
				// centreaza blocurile
				switch($group->get('format'))
				{
					default:
					case 1:// grupurile sunt pe orizontala
						$index = 0;
						$mLeft = (int)(($group->get('width') - $group->get('blocks_max_w'))/2);
						foreach($inside_blocks as $obj_block)
						{
							if($index++)// incepand cu al doilea
								// adaugam spatiul exterior
								$mLeft += $obj_block->get('outside_x');
							
							// setam margine left pentru blocul current
							$obj_block->left = $mLeft;
							
							// adaugam la mLeft latimea blocului pentru ca urmatorul sa inceapa de unde se termina acesta
							$mLeft += $obj_block->full_width();
						}
						break;
					case 2:// grupurile sunt pe verticala
						$index = 0;
						$mTop = (int)(($group->get('height') - $group->get('blocks_max_h'))/2);
						foreach($inside_blocks as $obj_block)
						{
							if($index++)// incepand cu al doilea
								// adaugam spatiul exterior
								$mTop += $obj_block->get('outside_y');
							
							// setam margine top pentru blocul current
							$obj_block->top = $mTop;
							
							// adaugam la mTop inaltimea blocului pentru ca urmatorul sa inceapa de unde se termina acesta
							$mTop += $obj_block->full_height();
						}
						break;
				}
				
				
				
				// grupurile din interiorul acestui grup
				$inside_groups = $group->get_groups();
				
				// parcurgem toate grupurile din interor si stabilim $groups_max_width si $groups_max_height
				switch($group->get('format'))
				{
					default:
					case 1:// grupurile sunt pe orizontala
						$index = 0;
						foreach($inside_groups as $obj_group)
						{
							// adaugam grupului din interior, margin left
							if($index++)
								$obj_group->left = $group->get('outside_x');
							
							// adauga grupului din interior, margin top
							$obj_group->top = $group->get('blocks_max_h') + $group->get('lines_h');
						}
						break;
					case 2:// grupurile sunt pe verticala
						$index = 0;
						foreach($inside_groups as $obj_group)
						{
							// adaugam grupului din interior, margin top
							if($index++)
								$obj_group->top = $group->get('outside_y');
							
							// adauga grupului din interior, margin left
							$obj_group->left = $group->get('blocks_max_w') + $group->get('lines_w');
						}
						break;
				}
				
				// daca ne aflam pe cel mai inalt nivel (adica ultima iteratie de nivel pentru ca lista este ordinata descrescator)
				if($level_index == $levels)
				{
					switch($group->get('format'))
					{
						default:
						case 1:// grupurile sunt pe orizontala
							// vom aduna latimea tuturor grupelor de pe acest nivel
							if($this->blockID == 0)
								$max_width += $group->full_width() + $group->get('outside_x');
							else
								foreach($group->get_blocks() as $this_block)
									if($this_block->get('id') == $this->blockID)
										$max_width = $group->full_width() + $group->get('outside_x')*2;
							
							// stabilim inaltimea maxima pe acest nivel
							if($max_height < $group->full_height())
								$max_height = $group->full_height();
							break;
						case 2:// grupurile sunt pe verticala
							// vom aduna inaltimea tuturor grupelor de pe acest nivel
							if($this->blockID == 0)
								$max_height += $group->full_height() + $group->get('outside_y');
							else
								foreach($group->get_blocks() as $this_block)
									if($this_block->get('id') == $this->blockID)
										$max_height = $group->full_height() + $group->get('outside_y')*2;
							
							// stabilim latimea maxima pe acest nivel
							if($max_width < $group->full_width())
								$max_width = $group->full_width();
							break;
					}
				}
				
			}
		}
		// seteaza latimea si inaltimea maxima a proiectului
		$this->width	= $max_width;
		$this->height	= $max_height;
		
		//
		//print '<pre>'; var_export(self::$groups); print '</pre>';
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// returneaza valoarea variabilei cerute
	// este singura cale de a accesa variabilele private si in plus este mult mai sigur
	public function get($key, $default = NULL)
	{
		return (isset($this->$key)) ? $this->$key : $default;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function display()
	{
		$html_code = '<div id="ST_ProjectII" style="width:'.$this->width.'px; height:'.$this->height.'px;">';
		
		// ordonam grupele crescador dupa nivel 
		ksort(self::$groups);
		
		// parcurge DOAR primul nivel pentru ca se apeleaza recursiv si pe celelalte
		// pargurge grupurile de pe nivel
		foreach(current(self::$groups) as $gr_id => $group)
		{
			$visible = false;
			if(in_array($gr_id, self::$session['groups']))
				$visible = true;
			
			// cere codul HTML si il memoreaza pentru afisare
			$html_code .= $group->HTMLcode2();
		}
		
		$html_code .= '</div>';
		
		// returneaza codul HTML pentru afisare
		return $html_code;
	}
	// ========================================================================
}
//
//
// END ST_Project class

/* End of file ST_Project.php */
/* Location: ./libraries/ST/ST_Project.php */