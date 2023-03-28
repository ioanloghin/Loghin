<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class ST_Operations
{
	// general attributes
	private $projectID;	// (integer) id-ul grupului curente (sau o cheie unica de identificare)
	private $blocks = array();// sintaxa $blocks[CODE] = array([id][sup][lvl][type][code][label][action=enum(0-ok,1-insert,2-update sup si label,3-delete)])
	private $temp_ids = array();// blocurile trebuies inserate ordonat dupa idul temporar ca sa nu mai trebuiasca sa modificam 'sup' in momentul cand blocurile superioare primesc id permanent; sintaxa: $temp_ids[TEMP_ID] = ID_PERMANENT;
	private $commands = array();// sintaxa: $commands[ACTION] = array(CODE,CODE,CODE,CODE,...);
	// Ateco attributes
	private $ateco_lang;
	// Errors
	private $errors = array();// $errors[auto_index] = (string)KEY EROARE;
	//
	// ========================================================================
	public function __construct($projectID)
	{
		// salveaza datele in variabilele obiectului
		$this->projectID = (int)$projectID;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// afiseaza datele curente din obiect (sub forma de structura)
	public function ateco($lang)
	{
		$this->ateco_lang = $lang;
		
		$db_ateco = Struct_model::get_ateco($this->ateco_lang);
		$db_blocks = Struct_model::get_blocks($this->projectID, 0, 0, 'code', $this->ateco_lang);
		
		// ne asiguram ca $db_ateco este ordonat crescator dupa nivel
		ksort($db_ateco);
		
		// id temporar pentru blocurile ce trebuiesc inserate
		$temp_id = 0;
		
		// parcurge $db_ateco pe nivele
		foreach($db_ateco as $ateco_lvl => $array_blocks)
		{
			// parcurgem blocurile fiecarui nivel
			foreach($array_blocks as $ateco_id => $ateco_row)
			{
				// blocul superior din baza noastra de date
				$db_superior = ($ateco_lvl > 0) ? $db_blocks[$db_ateco[$ateco_lvl-1][$ateco_row['sup']]['code']] : FALSE;
				
				// verificare pentru update
				if($ateco_row['code'] && array_key_exists($ateco_row['code'], $db_blocks))
				{
					// daca este ok, nu aplicam nici o actiune
					$db_blocks[$ateco_row['code']]['action'] = 0;
					
					// verifica daca superiorul este pe lista de insert
					if($ateco_lvl > 0)
					{
						// daca este pe lista de insert trebuie sa modificam 
						if($db_superior['action'] == 1)
						{
							$db_blocks[$ateco_row['code']]['sup'] = $db_superior['id'];
							$db_blocks[$ateco_row['code']]['action'] = 2;
						}
					}
					
					// verifica daca nivelul este corect
					if($ateco_lvl > 0)
					{
						
					}
					
					// verifica daca label este corect
					if($db_blocks[$ateco_row['code']]['label'] != $ateco_row['label'])
					{
						// ii vom aplica update
						$db_blocks[$ateco_row['code']]['label'] = $ateco_row['label'];
						$db_blocks[$ateco_row['code']]['action'] = 2;
					}
					
					// adauga codul in commands
					$this->commands[2][] = $ateco_row['code'];
				}
				else
				if($ateco_row['code'])
				{
					// adauga noul block
					$db_blocks[$ateco_row['code']] = array(
						'code' => $ateco_row['code'],
						'id' => 'temp'.++$temp_id,
						'sup' => (($ateco_lvl > 0) ? $db_superior['id'] : 0),
						'lvl' => (($ateco_lvl > 0) ? $db_superior['lvl']+1 : 0),// TODO
						'type' => 1,
						'label' => $ateco_row['label'],
						'action' => 1
					);
					
					// adauga id-ul temporar
					$this->temp_ids['temp'.$temp_id] = 0;
					
					// adauga codul in commands
					$this->commands[1][] = $ateco_row['code'];
				}
			}
		}
		
		// cele fara actiune nu am ce cauta in baza noastra de date,
		// sunt in plus asa ca le vom sterge (action = 3)
		foreach($db_blocks as $code => $block)
		{
			if(!array_key_exists('action', $block))// daca nu are action definit
			{
				// !!!este functional dar nu mai trebuie sa stearga nimic
				// in loc de 3, vom pune 0 ca sa nu faca nimic
				$db_blocks[$code]['action'] = 0;
				// adauga codul in commands
				$this->commands[0][] = $code;
			}
		}
		
		// ordoneaza lista de blocuri dupa code
		ksort($db_blocks);
		
		// pastreaza blocurile
		$this->blocks = $db_blocks;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// afiseaza datele curente din obiect (sub forma de structura)
	public function display()
	{
		$actions = array('este ok (<u>nothing</u>)', 'este nou (<u>insert</u>)', 'incorect (<u>update</u>)', 'nu este necesar (<u>delete</u>)');
		
		$html_code = '<div id="ST_Operations">';
		
		$html_code .= '<div class="th clear"><div class="cell_1">project</div><div class="cell_2">id</div><div class="cell_3">sup</div><div class="cell_4">lvl</div><div class="cell_5">type</div><div class="cell_6">code</div><div class="cell_7">label</div><div class="cell_8">status (action)</div></div>';
		
		foreach($this->blocks as $block)
			$html_code .= '<div class="tr c'.$block['action'].' clear"><div class="cell_1">'.$this->projectID.'</div><div class="cell_2">'.$block['id'].'</div><div class="cell_3">'.$block['sup'].'</div><div class="cell_4">'.$block['lvl'].'</div><div class="cell_5">'.$block['type'].'</div><div class="cell_6">'.$block['code'].'</div><div class="cell_7 inline_overflow">'.$block['label'].'</div><div class="cell_8">'.$actions[$block['action']].'</div></div>';
		
		$html_code .= '</div>';
		
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// salveaza datele din obiect in baza de date
	public function save()
	{
		SQL_DB::sql_querry("START TRANSACTION;");
		$sql_commands = NULL;
		
		// ordonam $commands ca sa incepem cu inserarea, urmata de update si delete
		ksort($this->commands);
		
		// executam comenzile de stergere
		foreach($this->commands as $command => $codes)
		{
			// daca este 0, nu facem nimic (nici o actiune)
			if($command == 0) continue;
			
			foreach($codes as $code)
			{
				$block = $this->blocks[$code];
				switch($command)
				{
					case 1://insert
						// daca procesul esueaza, anuleaza toate comenzile efectuate si returneaza FALSE
						// !!!este functional dar nu mai trebuie sa intereze nimic
						/*if(!$this->block_insert($block))
						{
							SQL_DB::sql_querry("ROLLBACK;");
							return FALSE;
						}*/
						break;
					case 2://update
						// daca procesul esueaza, anuleaza toate comenzile efectuate si returneaza FALSE
						if(!$this->block_update($block))
						{
							SQL_DB::sql_querry("ROLLBACK;");
							return FALSE;
						}
						break;
					case 3://delete
						// daca procesul esueaza, anuleaza toate comenzile efectuate si returneaza FALSE
						// !!!este functional dar nu mai trebuie sa stearga nimic
						/*if(!$this->block_delete($block['id']))
						{
							SQL_DB::sql_querry("ROLLBACK;");
							return FALSE;
						}*/
						break;
				}
			}
		}
		
		// daca nu au aparut probleme
		// salvam tranzactia si returnam TRUE
		SQL_DB::sql_querry("COMMIT;");
		return TRUE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// FUNCTII DE GESTIUNE
	// ------------------------------------------------------------------------
	// returneaza TRUE daca s-a executat corect
	public function block_insert($block)
	{
		// verificam daca toate atributele blocului au fost trimise
		if(!array_key_exists('id', $block) || !array_key_exists('sup', $block) || !array_key_exists('lvl', $block) || !array_key_exists('code', $block) || !array_key_exists('label', $block))
		{
			// inregistreaza eroare si returneaza false
			$this->errors[] = 'insert_1';
			return FALSE;
		}
		
		// stabilim id-ul blocului superior
		$sup_id = (array_key_exists($block['sup'], $this->temp_ids)) ? $this->temp_ids[$block['sup']] : $block['sup'];
		
		// executam comanda pentru insert
		$this_id = SQL_DB::sql_insert(MYSQL_PRE.'blocks', array(
				'project' => $this->projectID,
				'id' => NULL,
				'sup' => $sup_id,
				'lvl' => $block['lvl'],
				'type' => $block['type'],
				'code' => $block['code']
		));
		
		// inseram denumirea
		SQL_DB::sql_insert(MYSQL_PRE.'blocks_lang', array(
				'block_id' => $this_id,
				$this->ateco_lang => $block['label']
		));
		
		// modifica id-ul temporar al blocului cu id-ul permanent obtinut prin inserare
		if($this_id > 0)
			$this->temp_ids[$block['id']] = $this_id;
		else
		{
			// inregistreaza eroare si returneaza false
			$this->errors[] = 'insert_2';
			return FALSE;
		}
		
		// daca nu au aparut erori, returneaza TRUE
		return TRUE;
	}
	// ------------------------------------------------------------------------
	// returneaza TRUE daca s-a executat corect
	public function block_update($block)
	{
		// verificam daca toate atributele blocului au fost trimise
		if(!array_key_exists('id', $block) || !array_key_exists('sup', $block) || !array_key_exists('lvl', $block) || !array_key_exists('label', $block))
		{
			// inregistreaza eroare si returneaza false
			$this->errors[] = 'update_1';
			return FALSE;
		}
		
		// efectueaza actualizarea 1
		if(array_key_exists($block['sup'], $this->temp_ids) && !SQL_DB::sql_update(MYSQL_PRE.'blocks', array($sets['sup'] => $this->temp_ids[$block['sup']]), "`id` = '$block[id]'", 1))
		{
			// inregistreaza eroare si returneaza false
			$this->errors[] = 'update_2';
			return FALSE;
		}
		
		// efectueaza actualizarea 2
		if(!SQL_DB::sql_update(MYSQL_PRE.'blocks_lang', array($this->ateco_lang => $block['label']), "`block_id` = '$block[id]'", 1))
		{
			// inregistreaza eroare si returneaza false
			$this->errors[] = 'update_3';
			return FALSE;
		}
		
		// daca nu au aparut erori, returneaza TRUE
		return TRUE;
	}
	// ------------------------------------------------------------------------
	// returneaza TRUE daca s-a executat corect
	public function block_delete($blockID)
	{
		// efectueaza stergerea
		if(!SQL_DB::sql_delete('struct_blocks', "`id` = '$blockID'", 1))
		{
			// inregistreaza eroare si returneaza false
			$this->errors[] = 'delete_1';
			return FALSE;
		}
		
		// daca nu au aparut erori, returneaza TRUE
		return TRUE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function errors()
	{
		$language = array();
		$language['insert_1'] = "Lipsesc datele ce trebuiau trimise catre block_insert().<br />";
		$language['insert_2'] = "Comanda sql de inserare din block_insert() a esuat.<br />";
		$language['update_1'] = "Lipsesc datele ce trebuiau trimise catre block_update().<br />";
		$language['update_2'] = "Comanda sql de actualizare din block_update() a esuat.<br />";
		$language['delete_1'] = "Comanda sql de stergere din block_delete() a esuat.<br />";
		
		$returned = array();
		foreach($this->errors as $key)
			$returned[$key] = array_key_exists($key, $language) ? $language[$key] : '{'.$key.'}';
		
		return $returned;
	}
	// ========================================================================
}
//
//
// END ST_Operations class

/* End of file ST_Operations.php */
/* Location: ./libraries/ST/ST_Operations.php */
?>