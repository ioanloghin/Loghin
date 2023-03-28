<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class ST_Group
{
	// identifiers
	private $id;		// (string) id-ul grupului curente (sau o cheie unica de identificare)
	private $level;		// (integer)
	private $sup_block;	// (integer)
	public  $index;		// (integer) numarul de ordin (in cazul grupurilor paralele)
	// dimensions
	public $width;			  // (integer) latimea containerului
	public $height;			  // (integer) inaltimea containerului
	public $left		= 0;  // (integer) margin left
	public $top		    = 0;  // (integer) margin top
	private $lines_w	= 30; // (integer) latimea chenarului cu linii (pentru $format = 2)
	private $lines_h	= 30; // (integer) inaltimea chenarului cu linii (pentru $format = 1)
	private $outside_x	= 10; // (integer) spatiul de la grupul din stanga (pentru asezarea pe orizontala)
	private $outside_y	= 10; // (integer) spatiul de la grupul de sus (pentru asezarea pe verticala)
	// attributes
	private $label;			 // (string) denumirea grupului (este optionala)
	private $format;	 	 // (enum(1,2)) 1 - blocuri pe orizontala, 2 - blocuri pe verticala
	// contained
	private $inside_blocks = array(); // (array(id => instance,)) blocurile din interior
	private $blocks_max_w = 0; // (integer) latimea maxima a spatiului cu blocuri
	private $blocks_max_h = 0; // (integer) inaltimea maxima a spatiului cu blocuri
	private $inside_groups = array(); // (array(id => instance,)) grupurile din interior
	//
	// ========================================================================
	public function __construct($id, $sup_block, $level, $format = 1)
	{
		// salvam datele in variabilele obiectului
		$this->id		= (int)$id;
		$this->level	= (int)$level;
		$this->sup_block= (int)$sup_block;
		
		$this->format	= $format;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function insert_block($id, $instance)
	{
		// adauga index blocului si imcrementeaza numarul de blocuri
		$instance->index = count($this->inside_blocks);
		
		// adauga blocul in lista
		$this->inside_blocks[(int)$id] = $instance;
		
		// calculeaza $this->blocks_max_h
		switch($this->format)
		{
			default:
			case 1:// blocuri pe orizontala
				// dimensiunile blocului
				$instance->width = 60; $instance->height = 100;
				
				// stabileste inaltimea maxima
				if($this->blocks_max_h < $instance->full_height())
					$this->blocks_max_h = $instance->full_height();
				
				// calculeaza $this->blocks_max_w
				$this->blocks_max_w += $instance->full_width();
				if($instance->index)// incepand cu al doilea
					$this->blocks_max_w += $instance->get('outside_x');
				break;
			case 2:// blocuri pe verticala
				// dimensiunile blocului
				$instance->width = 170; $instance->height = 30;
				
				// stabileste latimea maxima
				if($this->blocks_max_w < $instance->full_width())
					$this->blocks_max_w = $instance->full_width();
				
				// calculeaza inaltimea maxima
				$this->blocks_max_h += $instance->full_height();
				if($instance->index)// incepand cu al doilea
					$this->blocks_max_h += $instance->get('outside_y');
				break;
		}
		
		return true;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function insert_group($id, &$instance)
	{
		// adauga index blocului si imcrementeaza numarul de blocuri
		$instance->index = count($this->inside_groups);
		
		// adaugam margin-left blocului
		if(count($this->inside_groups) > 1)
			switch($this->format)
			{
				default:
				case 1:// grupurile sunt pe orizontala
					$instance->left = end($this->inside_groups)->get('left')/* margin-left al ultimului bloc */
									+ end($this->inside_groups)->get('width')/* latimea ultimului bloc */
									+ end($this->inside_groups)->get('outside_x')/* spatiu intre blocuri */;
					break;
				case 2:// grupurile sunt pe verticala
					$instance->top = end($this->inside_groups)->get('top')/* margin-top al ultimului bloc */
									+ end($this->inside_groups)->get('height')/* inaltimea ultimului bloc */
									+ end($this->inside_groups)->get('outside_y')/* spatiu intre blocuri */;
					break;
			}
		
		// adauga blocul in lista
		$this->inside_groups[] = $instance;
		
		// adauga spatiu pentru grupul nou adaugat
		/*$this->width = $instance->get('left') + $instance->get('width');
		if($this->height < $instance->get('height'))
			$this->height = $instance->get('height');*/
		
		return true;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// elimina un block din acest grup
	// nu am avut ocazia sa o utilizez dar poate fi utila
	public function block_remove($id)
	{
		if(isset($this->inside_blocks[$id]))
		{
			unset($this->inside_blocks[$id]);
			$this->inside_blocks_count--;
			return true;
		}
		else
			return false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// returneaza intreaga latimea a grupului (impreuna cu padding si border)
	public function full_width()
	{
		switch($this->format)
		{
			default:
			case 1:// blocuri pe orizontala
				return $this->width /* latime */ + 0/* border */;
				break;
			case 2:// blocuri pe verticala
				return $this->width /* latime */ + $this->lines_w /* latimea chenarului cu linii */ + 0/* border */;
				break;
		}
		
	}
	// ------------------------------------------------------------------------
	// returneaza intreaga inaltime a grupului (impreuna cu padding si border)
	public function full_height()
	{
		switch($this->format)
		{
			default:
			case 1:// blocuri pe orizontala
				return $this->height /* inaltime */ + $this->lines_h /* inaltimea chenarului cu linii */ + 0/* border */;
				break;
			case 2:// blocuri pe verticala
				return $this->height /* inaltime */ + 0/* border */;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// IMPORTANT! a se folosi set_width((int)) sau set_height((int)) numai atunci cand
	// 'left' si 'top' nu au fost inca setate
	// iar pentru grupurile superioare nu s-a stabilit 'width' respectiv 'height'
	// IN CAZ CONTRAR, a se folosi change_width((+/-int)) respectiv change_height((+/-int))
	public function set_width($value)
	{
		$this->width = $value;
	}
	// ------------------------------------------------------------------------
	public function set_height($value)
	{
		$this->height = $value;
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
	// ------------------------------------------------------------------------
	// returneaza instanta blocului cerur dupa blockID
	public function get_block($blockID)
	{
		return (isset($this->inside_blocks[$blockID])) ? $this->inside_blocks[$blockID] : FALSE;
	}
	// ------------------------------------------------------------------------
	// returneaza toate blocurile
	public function get_blocks()
	{
		return $this->inside_blocks;
	}
	// ------------------------------------------------------------------------
	// returneaza instanta grupului cerur dupa groupID
	public function get_group($groupID)
	{
		return (isset($this->inside_groups[$groupID])) ? $this->inside_groups[$groupID] : FALSE;
	}
	// ------------------------------------------------------------------------
	// returneaza toate blocurile
	public function get_groups()
	{
		return $this->inside_groups;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode($bgcolor = 0xf60)
	{
		if(!$this->sup_block)// daca nu are superior
		{
			$bgcolor += $this->id * 32;
			switch($this->format)
			{
				default:
				case 1:// grupurile sunt pe orizontala
					$this->left = $this->outside_x;
					break;
				case 2:// grupurile sunt pe verticala
					$this->top = $this->outside_y;
					break;
			}
			
		}
		
		$bgcolor += 16 * 2;
		
		// atributele HTML ale grupului
		$html_code = '<div id="'.$this->id.'" class="group" style="width:'.$this->width.'px; height:'.$this->height.'px; margin-left:'.$this->left.'px; margin-top:'.$this->top.'px;">'."\n\r";/* background-color:#'.dechex($bgcolor).'*/
		
		// adauga codul HTML al blocurilor din interior
		foreach($this->inside_blocks as $obj_block)
			$html_code .= $obj_block->HTMLcode();
		
		// adauga codul HTML al liniilor
		// vom folosi $this->p_top ca si inaltime pentru div-ul cu linii
		$html_code .= $this->html_lines();
		
		// adauga codul HTML al grupurilor din interior
		foreach($this->inside_groups as $obj_group)
			$html_code .= $obj_group->HTMLcode($bgcolor);
		
		// inchidem divizia
		$html_code .= '</div>'."\n\r";
		
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function generate_lines()
	{
		$lines = array();
		// incepe generarea doar daca acest grup are grupuri inferioare (children)
		if(count($this->inside_groups))
		{
			switch($this->format)
			{
				default:
				case 1:// grupurile sunt pe orizontala
					if(count($this->inside_groups) == 1)
					{
						// generam doar o singura linie verticala pe mijloc
						$this_line = array();
						$this_line['c'] = '#0068B7';
						$this_line['w'] = 2;
						$this_line['h'] = $this->lines_h;
						$this_line['l'] = (int)($this->width/2);
						$this_line['t'] = 0;
						$lines[] = $this_line;
					}
					else
					{
						// genereaza linia de legatura cu cel de sus
						$top_line = array();
						$top_line['c'] = '#0068B7';
						$top_line['w'] = 2;
						$top_line['h'] = 15;
						$top_line['l'] = (int)($this->width/2);
						$top_line['t'] = 0;
						$lines[] = $top_line;
						
						// genereaza linia orizontala
						// resetam intai lista cu blocks ca sa fim siguri ca il selectam pe primul cand apelam current()
						reset($this->inside_groups);
						$mid_line = array();
						$mid_line['c'] = '#0068B7';
						$mid_line['h'] = 2;
						$mid_line['l'] = current($this->inside_groups)->get('left') + (int)(current($this->inside_groups)->get('width')/2);
						$mid_line['t'] = 14;
						
						// parcurge toate blocurile din grupa si le adauga linii
						$this_line = array();
						$this_line['c'] = '#0068B7';
						$this_line['w'] = 2;
						$this_line['h'] = 15;
						$this_line['t'] = 15;
						$mLeft = 0;// margin left pentru linie
						$index = 0;
						foreach($this->inside_groups as $this_group)
						{
							// adaugam jumatate din latimea grupului
							$mLeft += floor($this_group->full_width()/2);
							
							// setam maring left si inregistram linia
							$this_line['l'] = $mLeft;
							$lines[] = $this_line;
							
							// adaugam margin left al ultimului punct
							$mid_line['w'] = $mLeft;
							
							// adaug latimea grupului pentru ca urmatorul sa inceapta de unde s-a terminat acesta
							$mLeft += ceil($this_group->full_width()/2);
							$mLeft += $this_group->get('outside_x');
						}
						
						// reseteaza pointerul de pozitie pe vector pentru a putea selecta primul element
						reset($this->inside_groups);
						
						// scade jumatate din latimea primului grup
						$mid_line['w'] -= floor(current($this->inside_groups)->full_width()/2);
						$mid_line['w'] += 2;// rezolvare problema pixeli lipsa din coltul dreapta sus al liniei
						
						// generam linia mijlocie
						$lines[] = $mid_line;
					}
					break;
				case 2:// grupurile sunt pe verticala
					if(count($this->inside_groups) == 1)
					{
						// generam doar o singura linie verticala pe mijloc
						$this_line = array();
						$this_line['c'] = '#0068B7';
						$this_line['w'] = $this->lines_w;
						$this_line['h'] = 2;
						$this_line['l'] = 0;
						$this_line['t'] = (int)($this->height/2);
						$lines[] = $this_line;
					}
					else
					{
						// genereaza linia de legatura cu cel de sus
						$top_line = array();
						$top_line['c'] = '#0068B7';
						$top_line['w'] = 15;
						$top_line['h'] = 2;
						$top_line['l'] = 0;
						$top_line['t'] = (int)($this->height/2);
						$lines[] = $top_line;
						
						// genereaza linia orizontala
						// resetam intai lista cu blocks ca sa fim siguri ca il selectam pe primul cand apelam current()
						reset($this->inside_groups);
						$mid_line = array();
						$mid_line['c'] = '#0068B7';
						$mid_line['t'] = current($this->inside_groups)->get('top') + (int)(current($this->inside_groups)->get('height')/2);
						$mid_line['w'] = 2;
						$mid_line['l'] = 14;
						
						// parcurge toate blocurile din grupa si le adauga linii
						$this_line = array();
						$this_line['c'] = '#0068B7';
						$this_line['w'] = 15;
						$this_line['h'] = 2;
						$this_line['l'] = 15;
						$mTop = 0;// margin top pentru linie
						$index = 0;
						foreach($this->inside_groups as $this_group)
						{
							// adaugam jumatate din latimea grupului
							$mTop += floor($this_group->full_height()/2);
							
							// setam maring left si inregistram linia
							$this_line['t'] = $mTop;
							$lines[] = $this_line;
							
							// adaugam margin left al ultimului punct
							$mid_line['h'] = $mTop;
							
							// adaug latimea grupului pentru ca urmatorul sa inceapta de unde s-a terminat acesta
							$mTop += ceil($this_group->full_height()/2);
							$mTop += $this_group->get('outside_y');
						}
						
						// reseteaza pointerul de pozitie pe vector pentru a putea selecta primul element
						reset($this->inside_groups);
						
						// scade jumatate din latimea primului grup
						$mid_line['h'] -= floor(current($this->inside_groups)->full_height()/2);
						$mid_line['h'] += 2;// rezolvare problema pixeli lipsa din coltul dreapta sus al liniei
						
						// generam linia mijlocie
						$lines[] = $mid_line;
					}
					break;
			}
		}
		
		return $lines;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function html_lines()
	{
		switch($this->format)
		{
			default:
			case 1:// grupurile sunt pe orizontala
				$html_code = '<div class="lines" style="width:'.$this->width.'px;height:'.$this->lines_h.'px; margin-top:'.$this->blocks_max_h.'px;">'."\n\r";
				break;
			case 2:// grupurile sunt pe verticala
				$html_code = '<div class="lines" style="width:'.$this->lines_w.'px;height:'.$this->height.'px; margin-left:'.$this->blocks_max_w.'px;">'."\n\r";
				break;
		}
		
		// genereaza coordonatele si dimensiunile liniilor
		$lines = $this->generate_lines();
		
		// creaza codul HTML pentru linii
		foreach($lines as $line)
			$html_code .= "\t".'<div style="width:'.$line['w'].'px; height:'.$line['h'].'px; margin-left:'.$line['l'].'px; margin-top:'.$line['t'].'px; background-color:'.$line['c'].';"></div>'."\n\r";
		
		$html_code .= '</div>'."\n\r";
		return $html_code;
	}
	// ========================================================================
}
//
//
// END ST_Group class

/* End of file ST_Group.php */
/* Location: ./libraries/ST/ST_Group.php */
?>