<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
class Struct_model extends SQL_DB
{
	public function get_blocks($projectID, $blockID = 0/* blocul din prim-plan */, $deep = 0/* adancime */, $row_key = 'id'/* ce cheie sa aibe fiecare rand returnat */)
	{
		if($blockID > 0)
		{
			// seteaza variabila sql pentru nivelul blocului curent
			parent::sql_querry("SET @this_level = ( SELECT `lvl` FROM `struct_blocks` WHERE `id` = '$blockID' );");
		
			// face selectia block-urilor ce corespund adancimii (deep)
			// pe langa asta vom mai selecta 1 adancime in plus ca sa stiim care din ultimele block-uri au continuare
			$select_query = "SELECT * FROM `struct_blocks` WHERE `project` = '$projectID' AND `lvl` >= @this_level AND `lvl` <= @this_level+$deep+1;";
		}
		else
		{
			if($deep)
			{
				// seteaza variabila sql pentru cel mai mic nivel
				parent::sql_querry("SET @min_level = ( SELECT `lvl` FROM `struct_blocks` WHERE `project` = '$projectID' ORDER BY `lvl` ASC LIMIT 1);");
				
				// selecteaza blocurile ce corespund adancimii specificate in raport cu cel mai mic nivel
				$select_query = "SELECT * FROM `struct_blocks` WHERE `project` = '$projectID' AND `lvl` >= @min_level AND `lvl` <= @min_level+$deep+1;";
			}
			else
				// selecteaza toate blocurile ala proiectului specificat
				$select_query = "SELECT * FROM `struct_blocks` WHERE `project` = '$projectID';";
		}
		
		$results = parent::sql_querry($select_query);
		
		// pregatim datele de iesire
		$db_blocks = array();
		while($row=mysql_fetch_assoc($results))
			$db_blocks[$row[$row_key]] = $row;
		
		return $db_blocks;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_ateco($lang)
	{
		// tabelele din baza Ateco (CAEN) in ordinea superioritatii
		$tables = array('sezione', 'divisione', 'gruppo', 'classe', 'categoria', 'sottocategoria');
		
		// face selectia pe nivele
		$levels = array();	
		foreach($tables as $lvl => $table)
		{
			$results = parent::sql_querry("SELECT t.id, t.codice, t.titolo".(($lvl > 0) ? ", rel.id_".$tables[$lvl-1]." AS sup" : NULL)." FROM `ateco_relation` AS rel, `ateco_".$lang."_".$table."` AS t WHERE rel.id_".$table." = t.id GROUP BY rel.id_".$table.";");
			
			$levels[$lvl] = array();
			while($row=mysql_fetch_assoc($results))
				$levels[$lvl][$row['id']] = array('id' => $row['id'], 'sup' => (($lvl > 0) ? $row['sup'] : 0), 'code' => (($lvl > 0) ? $levels[$lvl-1][$row['sup']]['code'] : NULL).$row['codice'], 'label' => $row['titolo']);
		}
		
		return $levels;
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */