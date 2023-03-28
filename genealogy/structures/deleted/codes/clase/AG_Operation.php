<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../../module/e_403.php"));
}
//
//
//
class AG_Operation extends SQL_DB
{
	// ====================================================
	//
	// FAMILY FUNCTIOS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//
	// ====================================================
	function family_create($TreeID, $type = DBT_FAM_C4_V1)
	{
		// verificam $TreeID
		if(!$TreeID) return 0; else $TreeID = intval($id_arbore);
		// incepem tranzactiile
		SQL_DB::sql_querry("START TRANSACTION;");
		// introducem detaliile familiei
		$bool1 = SQL_DB::sql_querry("INSERT INTO `".DBT_FAM_INFO."` (`".DBT_FAM_INFO_C2."`, `".DBT_FAM_INFO_C2."`) VALUES (NULL, 'no');");
		$FamilyID = intval(mysql_insert_id());
		// introducem familia si membri acesteia
		$bool2 = SQL_DB::sql_querry("INSERT INTO `".DBT_FAM."` (`".DBT_FAM_C1."`, `".DBT_FAM_C2."`) VALUES ($FamilyID, $TreeID);");
		if($FamilyID && $bool1 && $bool2)
		{
			SQL_DB::sql_querry("COMMIT;");// salvam inserarile
			return $FamilyID;
		}
		else
		{
			SQL_DB::sql_querry("ROLLBACK;");// anulam inserarile
			return 0;
		}
	}
	// ========================================================================
	function family_update($id_family, $sets)
	{
		$return = SQL_DB::sql_update(DBT_FAM, $sets, "`".DBT_FAM_C1."` = '$id_family'", 1);
		return $return;
	}
	// ========================================================================
	function family_delete($id_family)
	{
		$return = SQL_DB::sql_delete(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", 1);
		return $return;
	}
	// ========================================================================
	function family_children_add($id_family, $id_children)
	{
		$temp = array();
		$sets = array();
		$children_string = NULL;
		
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C8));
		if(isset($temp[1]))
		{
			if(isset($temp[1][DBT_FAM_C8]))
				$children_string = $temp[1][DBT_FAM_C8];
			if($children_string)
				$children_string .= ',';
			$children_string .= '-'.$id_children.'-';
			$sets[DBT_FAM_C8] = $children_string;
			if(AG_Operation::family_update($id_family, $sets))
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}
	// ========================================================================
	function family_children_replace($id_family, $current_id_children, $new_id_children)
	{
		$temp = array();
		$sets = array();
		$children_string = NULL;
		
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C8));
		if(isset($temp[1]))
		{
			if(isset($temp[1][DBT_FAM_C8]))
			{
				$children_string = $temp[1][DBT_FAM_C8];
				$children = AG_Operation::childrenInArray($children_string);
				$children_string = NULL;
				foreach($children['array'] as $local_id)
				{
					if($children_string)
						$children_string .= ',';
					if($local_id == $current_id_children)
						$children_string .= '-'.$new_id_children.'-';
					else
						$children_string .= '-'.$local_id.'-';
				}
			}
			else
				$children_string = '-'.$id_children.'-';
			$sets[DBT_FAM_C8] = $children_string;
			if(AG_Operation::family_update($id_family, $sets))
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}
	// ========================================================================
	function family_children_delete($id_family, $id_children)
	{
		$temp = array();
		$sets = array();
		$children_string = NULL;
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C8));
		if(isset($temp[1]))
		{
			if(isset($temp[1][DBT_FAM_C8]))
			{
				$children_string = $temp[1][DBT_FAM_C8];
				$children = AG_Operation::childrenInArray($children_string);
				$children_string = NULL;
				foreach($children['array'] as $local_id)
				{
					if($local_id != $id_children)
					{
						if($children_string)
							$children_string .= ',';
						$children_string .= '-'.$local_id.'-';
					}
				}
			}
			$sets[DBT_FAM_C8] = $children_string;
			if(AG_Operation::family_update($id_family, $sets))
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}
	// ========================================================================
	function family_user_add($id_family, $id_user, $id_rel)
	{
		// $id_rel = 1; // parinte 1
		// $id_rel = 2; // parinte 2
		// $id_rel = 3; // copil
		$bool = FALSE;
		$sets = array();
		
		switch($id_rel)
		{
			case 1:
				$sets[DBT_FAM_C6] = $id_user;
				if(AG_Operation::family_update($id_family, $sets))
					$bool = TRUE;
				break;
			case 2:
				$sets[DBT_FAM_C7] = $id_user;
				if(AG_Operation::family_update($id_family, $sets))
					$bool = TRUE;
				break;
			case 3:
				if(AG_Operation::family_children_add($id_family, $id_user))
					$bool = TRUE;
				break;
		}
		
		return $bool;
	}
	// ========================================================================
	function family_user_change($id_family, $curent_id_user, $new_id_user, $id_rel)
	{
		// $id_rel = 1; // parinte 1
		// $id_rel = 2; // parinte 2
		// $id_rel = 3; // copil
		$bool = FALSE;
		$sets = array();
		
		switch($id_rel)
		{
			case 1:
				$sets[DBT_FAM_C6] = $new_id_user;
				if(AG_Operation::family_update($id_family, $sets))
					$bool = TRUE;
				break;
			case 2:
				$sets[DBT_FAM_C7] = $new_id_user;
				if(AG_Operation::family_update($id_family, $sets))
					$bool = TRUE;
				break;
			case 3:
				if(AG_Operation::family_children_replace($id_family, $curent_id_user, $new_id_user))
					$bool = TRUE;
				break;
		}
		
		return $bool;
	}
	// ========================================================================
	function family_get_children($id_family)
	{
		$children = array();
		if(($id_family = intval($id_family)) > 0)
		{
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C8));
			if(isset($temp[1][DBT_FAM_C8]) && $temp[1][DBT_FAM_C8])
			{
				$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
				$children = $children['array'];
			}
		}
		return $children;
	}
	// ========================================================================
	function family_user_reference($id_tree, $id_user)
	{
		/*
			return array(
				'id_family' => array(
					'id_user' => 0,
					'id_rel' => 0
				),
				'id_family' => array(
					'id_user' => 0,
					'id_rel' => 0
				),
			);
		*/
		$family_user_reference = array();
		$array = array();
		$id_rel = 0;
		
		$array = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' AND (`".DBT_FAM_C6."` = '$id_user' OR `".DBT_FAM_C7."` = '$id_user' OR `".DBT_FAM_C8."` LIKE '%-$id_user-%')", NULL, 0, 0, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
		foreach($array as $row)
		{
			if($row[DBT_FAM_C6] == $id_user)
				$id_rel = 1;
			else
			if($row[DBT_FAM_C7] == $id_user)
				$id_rel = 2;
			else
				$id_rel = 3;
			
			$family_user_reference[$row[DBT_FAM_C1]] = array('id_user' => $id_user, 'id_rel' => $id_rel);
		}
		
		return $family_user_reference;
	}
	// ========================================================================
	// functie recursiva ce verifica daca o familie detine legaturi catre target_family prin intermediul familiilor din $family_array
	// returneaza TRUE daca detine iar FALSE in caz contrar
	function family_check_linked($id_this_family, $id_target_family, &$family_array, &$family_linked)
	{
		//return TRUE;// TODO: momentan lasam asa sa vedem daca merge importul normal
		// functia este buna doar ca trebuie sa-i trimitem $family_linked
		if($id_this_family == $id_target_family)
			return TRUE;
		else
		{
			$next_id = (isset($family_linked[$id_this_family])) ? $family_linked[$id_this_family] : 0;
			if($next_id > 0 && (in_array($next_id, $family_array) || $next_id == $id_target_family))
				return AG_Operation::family_check_linked($next_id, $id_target_family, $family_array, $family_linked);
			else
				return FALSE;
		}
	}
	// ========================================================================
	// importa membri din familia userului importat (partenerul, copii si ex relatiile)
	// returneaza un array cu userii importati cu succes si cel neimportati
	function family_import_local($current_id_family, $imported_user, $internal_position, &$current_family, &$family_imported_user)/* Nu mai este folosita*/
	{
		// $current_id_family - id-ul familiei userului importat (familia din arborele nostru)
		// $imported_user - id-ul userului importat
		// $internal_position - pozitia pe care s-a importat userul (1 - parinte1, 2 - parinte2, 3 - copil)
		$return_import_local = array();
		$return_import_local[0] = array();// cei importati cu succes
		$return_import_local[1] = array();// cei neimportati (dai cauza unei erori sau oricealtceva)
		
		$id_partener = 0;
		if($internal_position == 1)
			$id_partener = $family_imported_user[2];// partener (parinte 2)
		else
		if($internal_position == 2)
			$id_partener = $family_imported_user[1];// partener (parinte 1)
		
		if($id_partener)// daca userul importat avea partener in arborele de unde a fost preluat
		{
			// verificam daca in arborele nostru exista definit un partener
			$partener_exist = AG_Operation::checkIn_partener($current_id_family, $id_partener);
			
			if(!$partener_exist)// daca partenerul este definit, il importam si pe el
			{
				$bool = FALSE;
				if($internal_position == 1)
					$bool = AG_Operation::family_user_add($current_id_family, $id_partener, 2);
				else
				if($internal_position == 2)
					$bool = AG_Operation::family_user_add($current_id_family, $id_partener, 1);
				
				if($bool)
					$return_import_local[0][] = $id_partener;// adaugam copilul in lista cu cei importati
				else
					$return_import_local[1][] = $id_partener;// adaugam copilul in lista cu cei neimportati
			}
		}
		// end ------------------------------------------------------------
		//
		//
		// importam copii -------------------------------------------------
		$children_string = $family_imported_user[3];
		if($children_string)
		{
			$children = AG_Operation::childrenInArray($children_string);
			foreach($children['array'] as $id_children)
			{
				if($id_children)
				{
					$bool = FALSE;
					// verificam daca exista copilul
					$children_exist = AG_Operation::checkIn_children($current_id_family, $id_children);
					if(!$children_exist)// daca nu exista, il importam si pe el
						$bool = AG_Operation::family_children_add($current_id_family, $id_children);
					
					if($bool)
						$return_import_local[0][] = $id_children;// adaugam copilul in lista cu cei importati
					else
						$return_import_local[1][] = $id_children;// adaugam copilul in lista cu cei neimportati
				}
			}
		}
		
		return $return_import_local;
	}
	// ========================================================================
	// importa familile descendente sau ascendente ce au legatura cu userul importat
	// returneaza un array cu familiile importat cu succes, cele neimporate, userii importati cu succes si cel neimportati
	function family_import_expansive($current_id_tree, &$families_for_import, $target_id_family, $direction, &$family_linked)
	{
		// $current_id_tree - id-ul arborelui nostru (unde a fost imporat userul)
		// &$families_for_import - pointer catre lista cu famili ce trebuiesc importate
		// $id_target_family - id-ul familiei userului importat (familia din arborele extern - de unde a fost importat userul)
		//
		$return_import_expansive = array();
		$return_import_expansive[0] = array();// familile importate cu succes
		$return_import_expansive[1] = array();// cele neimporate
		$return_import_expansive[2] = array();// userii importati cu succes
		$return_import_expansive[3] = array();// cei neimportati (dai cauza unei erori sau oricealtceva)
		
		foreach($families_for_import as $this_id_family)
		{
			$this_id_family = intval($this_id_family);
			if($this_id_family && ($this_id_family != $target_id_family || $direction == 'asc'))// daca este != 0 si daca este != de familia userului importat
			{
				// verificam daca familia ce urmeaza a fi importat are legaturi cu familia userului importat
				// in mod normal ar trebui sa aiba, dar mai bine sa ne asiguram utilizand funtia family_check_linked()
				$linked = AG_Operation::family_check_linked($this_id_family, $target_id_family, $families_for_import, $family_linked);
				//var_export($family_linked); print '&nbsp;&nbsp;&nbsp;&nbsp;';
				//print $this_id_family.' -'; var_export($linked); print '<br />';
				if($linked)
				{
					// extragem membri familiei din arborele extern
					$temp = array();
					$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$this_id_family'", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
					$sets = array();
					$sets[DBT_FAM_C6] = (isset($temp[1][DBT_FAM_C6])) ? intval($temp[1][DBT_FAM_C6]) : 0;
					$sets[DBT_FAM_C7] = (isset($temp[1][DBT_FAM_C7])) ? intval($temp[1][DBT_FAM_C7]) : 0;
					$sets[DBT_FAM_C8] = (isset($temp[1][DBT_FAM_C8])) ? $temp[1][DBT_FAM_C8] : NULL;
					unset($temp);
					// creem o noua familie in arborele nostru
					$NEW_id_family = AG_Operation::family_create($current_id_tree);
					// introducem membri in familia nou creata
					if(AG_Operation::family_update($NEW_id_family, $sets))
						$return_import_expansive[0][] = $this_id_family;
					else
						$return_import_expansive[1][] = $this_id_family;
				}
			}
		}
		
		return $return_import_expansive;
	}
	// ========================================================================
	function get_members_connects($id_tree, $id_user, $to = NULL, &$member_ids = array(), $return_type = 'general')
	{
		// $to = 'asc'; familia curenta + familiile ascendente
		// $to = 'desc'; familia curenta + familiile descendente
		// $to = 'only_asc'; doar familiile ascendente
		// $to = 'only_desc'; doar familiile descendente
		// $to = NULL;
		// $return_type = 'general';
		// $return_type = 'local';
		//
		// initializare
		$recursiv_return = array();
		$recursiv_return[0] = 0;
		$recursiv_return[1] = 0;
		$recursiv_return[2] = 0;
		$recursiv_return[3] = array();
		
		// adaugam membri familiei in care userul este parinte
		if($return_type == 'general' && in_array($to, array('asc', 'desc', NULL)))
		{
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' and `".DBT_FAM_C4."` = '".DBT_FAM_C4_V1."' and (`".DBT_FAM_C6."` = '$id_user' or `".DBT_FAM_C7."` = '$id_user')", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
			if(isset($temp[1]))
			{
				// mutam membri in array-ul principal
				$member_ids[intval($temp[1][DBT_FAM_C1])][1] = intval($temp[1][DBT_FAM_C6]);
				$member_ids[intval($temp[1][DBT_FAM_C1])][2] = intval($temp[1][DBT_FAM_C7]);
				$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
				$member_ids[intval($temp[1][DBT_FAM_C1])][3] = $children['array'];
			}
			unset($temp);
		}
		
		switch($to)
		{
			case 'desc':
			case 'only_desc':
				// selectam familia curenta
				$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' and `".DBT_FAM_C8."` LIKE '%-$id_user-%'", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
				if(isset($temp[1]))
				{
					$recursiv_return[0] = intval($temp[1][DBT_FAM_C1]);
					$recursiv_return[1] = intval($temp[1][DBT_FAM_C6]);
					$recursiv_return[2] = intval($temp[1][DBT_FAM_C7]);
					$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
					$recursiv_return[3] = $children['array'];
					
					// mutam membri in array-ul principal
					$member_ids[$recursiv_return[0]][1] = $recursiv_return[1];
					$member_ids[$recursiv_return[0]][2] = $recursiv_return[2];
					$member_ids[$recursiv_return[0]][3] = $recursiv_return[3];
				}
				unset($temp);
				
				// continuam recursivitatea
				if($recursiv_return[1])
					$local_return = AG_Operation::get_members_connects($id_tree, $recursiv_return[1], 'desc', $member_ids, 'local');
				
				if($recursiv_return[2])
					$local_return = AG_Operation::get_members_connects($id_tree, $recursiv_return[2], 'desc', $member_ids, 'local');
				
				if($recursiv_return[3])
				{
					foreach($recursiv_return[3] as $id_children)
						if($id_children != $id_user)
						$local_return = AG_Operation::get_members_connects($id_tree, $id_children, 'asc', $member_ids, 'local');
				}
				break;
			case 'asc':
			case 'only_asc':
				//echo '++<br />';
				// selectam familia curenta
				$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' and (`".DBT_FAM_C6."` = '$id_user' or `".DBT_FAM_C7."` = '$id_user')", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
				if(isset($temp[1]))
				{
					$recursiv_return[0] = intval($temp[1][DBT_FAM_C1]);
					$recursiv_return[1] = intval($temp[1][DBT_FAM_C6]);
					$recursiv_return[2] = intval($temp[1][DBT_FAM_C7]);
					$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
					$recursiv_return[3] = $children['array'];
					//var_export($recursiv_return[0]); echo '<br />';
					//var_export($member_ids); echo '<br />';
					//if(isset($member_ids[$recursiv_return[0]]))
						//break;
					
					// mutam membri in array-ul principal
					$member_ids[$recursiv_return[0]][1] = $recursiv_return[1];
					$member_ids[$recursiv_return[0]][2] = $recursiv_return[2];
					$member_ids[$recursiv_return[0]][3] = $recursiv_return[3];
				}
				unset($temp);
				
				// continuam recursivitatea
				//if($recursiv_return[1] && $recursiv_return[1] != $id_user)
					//$local_return = AG_Operation::get_members_connects($id_tree, $recursiv_return[1], 'desc', $member_ids, 'local');
				
				//if($recursiv_return[2] && $recursiv_return[2] != $id_user)
					//$local_return = AG_Operation::get_members_connects($id_tree, $recursiv_return[2], 'desc', $member_ids, 'local');
				
				if($recursiv_return[3])
				{
					foreach($recursiv_return[3] as $id_children)
					{
						//echo $id_children.'<br />';
						if($id_children)
							$local_return = AG_Operation::get_members_connects($id_tree, $id_children, 'asc', $member_ids, 'local');
					}
				}
				break;
		}
		if($return_type == 'general')
			return $member_ids; // returnam toate familiile gasite
		else
			return $recursiv_return; // returnam familia ceruta
	}
	// ========================================================================
	// numara membri din $member_ids returnat de functia get_members_connects()
	function cnt_members_connects(&$member_ids)
	{
		$cnt = 0;
		foreach($member_ids as $id_family => $members)
		{
			if($members[1])
				$cnt++;
			if($members[2])
				$cnt++;
			foreach($members[3] as $local_id)
			{
				if($local_id)
					$cnt++;
			}
		}
		return $cnt;
	}
	// ========================================================================
	// elimita membri care nu pot fi importati pentru ca:
	// - locul lor este deja ocupat
	function filter_members_connects($id_tree, $member_ids)
	{
		foreach($member_ids as $id_family => $members)
		{
			$check1 = AG_Operation::checkIn_tree($id_tree, $members[1]);
			$check2 = AG_Operation::checkIn_tree($id_tree, $members[2]);
			$check3 = FALSE;
			foreach($members[3] as $local_key => $local_id)
			{
				if(!$check3)
					$check3 = AG_Operation::checkIn_tree($id_tree, $local_id);
			}
			if($check1 || $check2 || $check3)
				unset($member_ids[$id_family]);
			
		}
		return $member_ids;
	}
	// ========================================================================
	function membru_connects($id_family, $id_user)
	{
		/*
		
		members = array(
			id_family => array(1 => id_tata, 2 => id_mama, 3 => array(id_copil, id_copil, ...))
		)
		
		*/
		$return = array(
			'asc' => array(
				'count' => 0,
				'members' => array()
			),
			'desc' => array(
				'count' => 0,
				'members' => array()
			),
			'current' => array(
				'count' => 0,
				'members' => array()
			),
		);
		
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
		if(isset($temp[1]))
		{
			$return['current']['members'][$id_family][1] = 0;
			$return['current']['members'][$id_family][2] = 0;
			$return['current']['members'][$id_family][3] = array();
			
			if($temp[1][DBT_FAM_C6] && $temp[1][DBT_FAM_C6] != $id_user)
			{
				$return['current']['members'][$id_family][1] = $temp[1][DBT_FAM_C6];
				$return['current']['count']++;
			}
			if($temp[1][DBT_FAM_C7] && $temp[1][DBT_FAM_C7] != $id_user)
			{
				$return['current']['members'][$id_family][2] = $temp[1][DBT_FAM_C7];
				$return['current']['count']++;
			}
			
			$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
			foreach($children['array'] as $local_id)
			{
				if($local_id && $local_id != $id_user)
				{
					$return['current']['members'][$id_family][3][] = $local_id;
					$return['current']['count']++;
				}
			}
		}
		
		return $return;
	}
	// ========================================================================
	function family_get_linked($id_tree, $id_user, $to = NULL, &$family_ids = array(), $return_type = 'general', $parent_id = 0)
	{
		// $to = 'asc'; familia curenta + familiile ascendente
		// $to = 'desc'; familia curenta + familiile descendente
		// $to = 'only_asc'; doar familiile ascendente
		// $to = 'only_desc'; doar familiile descendente
		// $to = NULL;
		// $return_type = 'general';
		// $return_type = 'local';
		//
		// initializare
		$recursiv_return = array();
		$recursiv_return[0] = 0;
		$recursiv_return[1] = 0;
		$recursiv_return[2] = 0;
		$recursiv_return[3] = array();
		
		// adaugam membri familiei in care userul este parinte
		if(!$to)
		{
			$array1 = AG_Operation::family_get_linked($id_tree, $id_user, 'only_asc');
			$array2 = AG_Operation::family_get_linked($id_tree, $id_user, 'only_desc');
			
			foreach($array1 as $key => $value)
			{
				$family_ids[$value] = $key;
			}
			
			foreach($array2 as $key => $value)
			{
				if(!isset($family_ids[$key]))
					$family_ids[$key] = $value;
			}
		}
		else
		if($return_type == 'general' && in_array($to, array('asc', 'desc')))
		{
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' and `".DBT_FAM_C4."` = '".DBT_FAM_C4_V1."' and (`".DBT_FAM_C6."` = '$id_user' or `".DBT_FAM_C7."` = '$id_user')", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
			if(isset($temp[1]))
				$family_ids[intval($temp[1][DBT_FAM_C1])] = $parent_id;
			unset($temp);
		}
		
		switch($to)
		{
			case 'desc':
			case 'only_desc':
				// selectam familia curenta
				$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' and `".DBT_FAM_C8."` LIKE '%-$id_user-%'", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
				if(isset($temp[1]))
				{
					$recursiv_return[0] = intval($temp[1][DBT_FAM_C1]);
					$recursiv_return[1] = intval($temp[1][DBT_FAM_C6]);
					$recursiv_return[2] = intval($temp[1][DBT_FAM_C7]);
					$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
					$recursiv_return[3] = $children['array'];
					
					// mutam membri in array-ul principal
					if($parent_id)
						$family_ids[$recursiv_return[0]] = $parent_id;
				}
				unset($temp);
				
				// continuam recursivitatea
				if($recursiv_return[1])
					$local_return = AG_Operation::family_get_linked($id_tree, $recursiv_return[1], 'desc', $family_ids, 'local', $recursiv_return[0]);
				
				if($recursiv_return[2])
					$local_return = AG_Operation::family_get_linked($id_tree, $recursiv_return[2], 'desc', $family_ids, 'local', $recursiv_return[0]);
				
				if($recursiv_return[3])
				{
					foreach($recursiv_return[3] as $id_children)
						$local_return = AG_Operation::family_get_linked($id_tree, $id_children, 'asc', $family_ids, 'local', $recursiv_return[0]);
				}
				break;
			case 'asc':
			case 'only_asc':
				// selectam familia curenta
				$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' and (`".DBT_FAM_C6."` = '$id_user' or `".DBT_FAM_C7."` = '$id_user')", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
				if(isset($temp[1]))
				{
					$recursiv_return[0] = intval($temp[1][DBT_FAM_C1]);
					$recursiv_return[1] = intval($temp[1][DBT_FAM_C6]);
					$recursiv_return[2] = intval($temp[1][DBT_FAM_C7]);
					$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
					$recursiv_return[3] = $children['array'];
					if($parent_id)
						$family_ids[$parent_id] = $recursiv_return[0];
				}
				unset($temp);
				
				if($recursiv_return[3])
				{
					foreach($recursiv_return[3] as $id_children)
					{
						if($id_children)
							$local_return = AG_Operation::family_get_linked($id_tree, $id_children, 'asc', $family_ids, 'local', $recursiv_return[0]);
					}
				}
				break;
		}
		if($return_type == 'general')
			return $family_ids; // returnam toate familiile gasite
		else
			return $recursiv_return; // returnam familia ceruta
	}
	// ====================================================
	//
	// EXREL FUNCTIOS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//
	// ====================================================
	function exrel_create_all($id_tree1, $id_user1, $id_user2, $id_rel2)
	{
		// se selecteaza id-ul adminului
		$id_admin = AG_Operation::tree_get_admin($id_tree1);
		// se creaza arborele secundar
		$id_tree2 = AG_Operation::tree_create($id_admin, NULL, $id_user2);
		// se creaza familie in arborele secundar
		$id_family2 = AG_Operation::family_create($id_tree2);
		// se creaza legatura
		$id_exrel = AG_Operation::exrel_create();
		// se selecteaza id-ul familiei din arborele primar
		$id_family1 = AG_Operation::myFamily($id_user1, $id_tree1, 'asc');
		// se salveaza datele de legatura
		$sets = array();
		$sets[DBT_TREE_LINK_C2] = $id_tree1;
		$sets[DBT_TREE_LINK_C3] = $id_family1;
		$sets[DBT_TREE_LINK_C4] = $id_user1;
		$sets[DBT_TREE_LINK_C5] = $id_tree2;
		$sets[DBT_TREE_LINK_C6] = $id_family2;
		$sets[DBT_TREE_LINK_C7] = $id_user2;
		if($id_rel2 == 3)// daca importam un copil, pagintele2 va fi = 0
			$sets[DBT_TREE_LINK_C7] = 0;
		$bool = AG_Operation::exrel_update($id_exrel, $sets);
		// se returneaza id-ul familiei din arborele secundar
		return $id_family2;
	}
	// ========================================================================
	function exrel_create()
	{
		$insert = array();
		$insert[DBT_TREE_LINK_C1] = 'NULL';
		$id_exrel = SQL_DB::sql_insert(DBT_TREE_LINK, $insert);
		return $id_exrel;
	}
	// ========================================================================
	function exrel_update($id_exrel, $sets)
	{
		$return = SQL_DB::sql_update(DBT_TREE_LINK, $sets, "`".DBT_TREE_LINK_C1."` = '$id_exrel'", 1);
		return $return;
	}
	// ========================================================================
	// sterge toti arborii secundari, familiile acestora  si legaturile dintre ei
	function exrel_delete_all($primary_id_family, $id_family, $id_user = 0)
	{
		if($id_user)
			$where = "(`".DBT_TREE_LINK_C3."` = '$id_family' AND `".DBT_TREE_LINK_C4."` = '$id_user') OR (`".DBT_TREE_LINK_C5."` = '$id_family' AND `".DBT_TREE_LINK_C6."` = '$id_user')";
		else
			$where = "`".DBT_TREE_LINK_C3."` = '$id_family' OR `".DBT_TREE_LINK_C5."` = '$id_family'";
		// verificam daca familia are legaruri cu alti arbori secundari
		$array = SQL_DB::sql_select(DBT_TREE_LINK, $where);
		foreach($array as $row)
		{
			$target_id_exrel  = $row[DBT_TREE_LINK_C1];
			$target_id_tree	  = ($row[DBT_TREE_LINK_C3] == $id_family) ? $row[DBT_TREE_LINK_C5] : $row[DBT_TREE_LINK_C2];
			$target_id_family = ($row[DBT_TREE_LINK_C3] == $id_family) ? $row[DBT_TREE_LINK_C6] : $row[DBT_TREE_LINK_C3];
			if($target_id_family != $primary_id_family)
			{
				// recurenta
				AG_Operation::exrel_delete_all($primary_id_family, $target_id_family, 0);
				// stergem arborele cu toate familiile
				AG_Operation::tree_delete_all($target_id_tree);
				// stergem legatura
				AG_Operation::exrel_delete($target_id_exrel);
			}
		}
	}
	// ========================================================================
	// sterge doar legatura de tip ex relatie
	function exrel_delete($id_exrel)
	{
		$bool = SQL_DB::sql_delete(DBT_TREE_LINK, "`".DBT_TREE_LINK_C1."` = '$id_exrel'", 1);
		return $bool;
	}
	// ========================================================================
	// returneaza un array cu familile din arbori secundari
	function getExRelatii($id_tree, $id_user = 0)
	{
		$familyArray = array();
		$key = 1;
		if($id_user)
			$where = "(`".DBT_TREE_LINK_C2."` = '$id_tree' AND `".DBT_TREE_LINK_C4."` = '$id_user') OR (`".DBT_TREE_LINK_C5."` = '$id_tree' AND `".DBT_TREE_LINK_C7."` = '$id_user')";
		else
			$where = "`".DBT_TREE_LINK_C2."` = '$id_tree' OR `".DBT_TREE_LINK_C5."` = '$id_tree'";
		$tree_linked = SQL_DB::sql_select(DBT_TREE_LINK, $where);
		foreach($tree_linked as $row)
		{
			if($row[DBT_TREE_LINK_C2] == $id_tree)
				$id_family = $row[DBT_TREE_LINK_C6];
			else
				$id_family = $row[DBT_TREE_LINK_C3];
			
			if($id_family > 0)
			{
				$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1);
				if(isset($temp[1]))
					$familyArray[$key++] = $temp[1];
			}
		}
		return $familyArray;
	}
	// =====================================================
	//
	// USER FUNCTIOS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//
	// ====================================================
	function user_create($info = array())
	{
		/*
		$info = array(
			'camp' => 'valoare'
		);
		*/
		$info[DBT_USER_INFO_C1] = 'NULL';
		$id_user = SQL_DB::sql_insert(DBT_USER_INFO, $info);
		return intval($id_user);
	}
	// ========================================================================
	function user_info($id_user, $key = NULL)
	{
		if($key)
		{
			$temp = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '$id_user'", NULL, 0, 1, array($key));
			return (isset($temp[1][$key])) ? $temp[1][$key] : NULL;
		}
		else
		{
			$temp = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '$id_user'", NULL, 0, 1);
			return (isset($temp[1])) ? $temp[1] : array();
		}
	}
	// ========================================================================
	function user_haveAsc($id_arbore, $id_user, $status = DBT_FAM_C4_V1)
	{
		$bool = FALSE;
		if(($id_arbore > 0) && ($id_user > 0))
			$bool = SQL_DB::sql_count(DBT_FAM, "`".DBT_FAM_C2."` = '$id_arbore' AND (`".DBT_FAM_C6."` = '$id_user' OR `".DBT_FAM_C7."` = '$id_user')", DBT_FAM_C1, 1);
		if($bool)
			return TRUE;
		else
			return FALSE;
	}
	// ========================================================================
	function user_haveDesc($id_arbore, $id_user, $status = DBT_FAM_C4_V1)
	{
		$bool = SQL_DB::sql_count(DBT_FAM, "(`".DBT_FAM_C2."` = '$id_arbore' AND `".DBT_FAM_C4."` = '".$status."') and (`".DBT_FAM_C8."` LIKE '%-$id_user-%')", DBT_FAM_C1, 1);
		if($bool)
			return TRUE;
		else
			return FALSE;
	}
	// ========================================================================
	function user_haveExRel($id_tree, $id_user)
	{
		$bool = SQL_DB::sql_count(DBT_TREE_LINK, "(`".DBT_TREE_LINK_C2."` = '$id_tree' AND `".DBT_TREE_LINK_C4."` = '$id_user') OR (`".DBT_TREE_LINK_C5."` = '$id_tree' AND `".DBT_TREE_LINK_C7."` = '$id_user')", DBT_TREE_LINK_C1, 1);
		if($bool)
			return TRUE;
		else
			return FALSE;
	}
	// ========================================================================
	function user_countExRel($id_tree, $id_user)
	{
		$cnt = SQL_DB::sql_count(DBT_TREE_LINK, "(`".DBT_TREE_LINK_C2."` = '$id_tree' AND `".DBT_TREE_LINK_C4."` = '$id_user') OR (`".DBT_TREE_LINK_C5."` = '$id_tree' AND `".DBT_TREE_LINK_C7."` = '$id_user')");
		return intval($cnt);
	}
	// ========================================================================
	function userInfo($id_user, $keys = array())
	{
		if(!is_array($keys))
			$keys = array();
		$array = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '$id_user'", NULL, 0, 1, $keys);
		return (isset($array[1])) ? $array[1] : array();
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function AG_ifExist($type, $id_user)
	{
		// $type = 'arbore_admin';
		// $type = 'arbore_membru';
		// $type = 'tata';
		// $type = 'mama';
		// $type = 'asc'; verifica daca are ascendenti (familie)
		// $type = 'desc'; verifica daca are descendenti (parinti)
		$c = 0;
		switch($type)
		{
			case'arbore_admin': $c = SQL_DB::sql_count('agenealogic_arbori', "`id_admin` = '$id_user'"); break;
			case'arbore_membru': $c = SQL_DB::sql_count('agenealogic', "`".DBT_FAM_C8."` LIKE '%-$id_user-%' OR `".DBT_FAM_C6."` = '$id_user' OR `".DBT_FAM_C7."` = '$id_user'"); break;
			case'tata': $c = SQL_DB::sql_count('agenealogic', "`".DBT_FAM_C8."` LIKE '%-$id_user-%' AND `".DBT_FAM_C6."` > '0'"); break;
			case'mama': $c = SQL_DB::sql_count('agenealogic', "`".DBT_FAM_C8."` LIKE '%-$id_user-%' AND `".DBT_FAM_C7."` > '0'"); break;
			case'asc': $c = SQL_DB::sql_count('agenealogic', "`".DBT_FAM_C6."` = '$id_user' OR `".DBT_FAM_C7."` = '$id_user'"); break;
			case'desc': $c = SQL_DB::sql_count('agenealogic', "`".DBT_FAM_C8."` LIKE '%-$id_user-%'"); break;
		}
		
		if($c > 0) return true;
		else return false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function checkImport($id_user)
	{
		
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function checkIn_partener($id_family, $id_partener)
	{
		$bool = SQL_DB::sql_count(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family' AND (`".DBT_FAM_C6."` = '$id_partener' or `".DBT_FAM_C7."` = '$id_partener')", DBT_FAM_C1, 1);
		if($bool)
			return TRUE;
		else
			return FALSE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function get_partener($id_family, $id_user)
	{
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C6, DBT_FAM_C7));
		$id_partener = 0;
		if(isset($temp[1]))
		{
			if($temp[1][DBT_FAM_C6] != $id_user)
				$id_partener = intval($temp[1][DBT_FAM_C6]);
			else
				$id_partener = intval($temp[1][DBT_FAM_C7]);
		}
		
		return $id_partener;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function checkIn_children($id_family, $id_children)
	{
		$bool = SQL_DB::sql_count(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family' AND `".DBT_FAM_C8."` LIKE '%-$id_children-%'", DBT_FAM_C1, 1);
		if($bool)
			return TRUE;
		else
			return FALSE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function checkIn_family($id_tree, $id_family)
	{
		// familia de importat
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
		$members = array(
			1 => (isset($temp[1][DBT_FAM_C6])) ? intval($temp[1][DBT_FAM_C6]) : 0,
			2 => (isset($temp[1][DBT_FAM_C7])) ? intval($temp[1][DBT_FAM_C7]) : 0,
			3 => (isset($temp[1][DBT_FAM_C8])) ? $temp[1][DBT_FAM_C8] : NULL
		);
		unset($temp);
		
		$return = array(
			0 => 0,// 0 - nici o familie nu exista, nr - idul familiei (daca exista)
			1 => 0,// 0 - nu exista, 1 - parintele1 exista si este acelasi, 2 - exista dar nu este acelasi
			2 => 0,// 0 - nu exista, 1 - parintele2 exista si este acelasi, 2 - exista dar nu este acelasi
			3 => 0// 0 - copii nu exista, 1 - toti copii exista, 2 - copii exista partial
		);
		
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' AND (`".DBT_FAM_C6."` = '".$members[1]."' OR `".DBT_FAM_C7."` = '".$members[2]."')", NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
		if(isset($temp[1]))
		{
			// familia exista
			$return[0] = $temp[1][DBT_FAM_C1];
			
			// verificam parintele 1
			if(!$temp[1][DBT_FAM_C6])
				$return[1] = 0;
			else
			if($temp[1][DBT_FAM_C6] == $members[1])
				$return[1] = 1;
			else
			if($temp[1][DBT_FAM_C6] != $members[1])
				$return[1] = 2;
			
			// verificam parintele 2
			if(!$temp[1][DBT_FAM_C7])
				$return[2] = 0;
			else
			if($temp[1][DBT_FAM_C7] == $members[2])
				$return[2] = 1;
			else
			if($temp[1][DBT_FAM_C7] != $members[2])
				$return[2] = 2;
			
			// tinand cont ca o familie trebuie sa aibe OBLIGATORIU un parinte definit, vom verifica copii doar daca exista familia
			
		}
		
		return $return;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function checkIn_tree($id_tree, $id_user)
	{
		$bool = SQL_DB::sql_count(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree' AND (`".DBT_FAM_C6."` = '$id_user' OR `".DBT_FAM_C7."` = '$id_user' OR `".DBT_FAM_C8."` LIKE '%-$id_user-%')");
		if($bool)
			return TRUE;
		else
			return FALSE;
	}
	// =====================================================
	//
	// TREE FUNCTIOS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//
	// ====================================================
	function tree_create($id_admin, $name = NULL, $default_user = 0, $primary = 0)
	{
		$info = array();
		$info[DBT_TREE_C1] = 'NULL';
		$info[DBT_TREE_C2] = $id_admin;
		$info[DBT_TREE_C3] = $name;
		$info[DBT_TREE_C4] = $default_user;
		$info[DBT_TREE_C5] = $primary;
		$id_arbore = SQL_DB::sql_insert(DBT_TREE, $info);
		return intval($id_arbore);
	}
	// ========================================================================
	function tree_get_families($id_tree)
	{
		$array = array();
		$array = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree'");
		if(!is_array($array))
			$array = NULL;
		return $array;
	}
	// ========================================================================
	function tree_get_admin($id_tree)
	{
		$temp = array();
		$temp = SQL_DB::sql_select(DBT_TREE, "`".DBT_TREE_C1."` = '$id_tree'", NULL, 0, 1, array(DBT_TREE_C2));
		$id_admin = (isset($temp[1][DBT_TREE_C2])) ? intval($temp[1][DBT_TREE_C2]) : 0;
		return $id_admin;
	}
	// ========================================================================
	function tree_get_defaultUser($id_tree)
	{
		$temp = array();
		$temp = SQL_DB::sql_select(DBT_TREE, "`".DBT_TREE_C1."` = '$id_tree'", NULL, 0, 1, array(DBT_TREE_C4));
		$id_default_user = (isset($temp[1][DBT_TREE_C4])) ? intval($temp[1][DBT_TREE_C4]) : 0;
		return $id_default_user;
	}
	// ========================================================================
	function tree_set_defaultUser($id_tree, $id_user)
	{
		$sets = array();
		$sets[DBT_TREE_C4] = intval($id_user);
		$return = SQL_DB::sql_update(DBT_TREE, $sets, "`".DBT_TREE_C1."` = '$id_tree'", 1);
		return $return;
	}
	// ========================================================================
	// sterge atat arborele cat si familiile acestuia
	function tree_delete_all($id_tree)
	{
		$families = AG_Operation::tree_get_families($id_tree);
		foreach($families as $row)
		{
			AG_Operation::family_delete($row[DBT_FAM_C1]);
		}
		AG_Operation::tree_delete($id_tree);
	}
	// ========================================================================
	// sterge doar arborele
	function tree_delete($id_tree)
	{
		$bool = SQL_DB::sql_delete(DBT_TREE, "`".DBT_TREE_C1."` = '$id_tree'", 1);
		return $bool;
	}
	// ========================================================================
	function childrenInArray($children_string)
	{
		$children = array('count' => 0, 'array' => array());
		
		$exp = explode(',', $children_string);
        $children['count'] = count($exp);
        if($children['count'])
        {
			$children['count'] = 0;
        	foreach($exp as $exp_key => $exp_value)
            {
				$id_children = intval(str_replace('-', '', $exp_value));
				if(is_int($id_children))
				{
					$children['array'][] = $id_children;
					$children['count']++;
				}
			}
		}
		else
		{
			$id_children = intval(str_replace('-', '', $children_string));
			if(is_int($id_children))
			{
				$children['count'] = 1;
				$children['array'][] = $id_children;
			}
			else
				$children['count'] = 0;
		}
		
		return $children;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function myTree($id_family)
	{
		$id_tree = 0;
		if($id_family > 0)
		{
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C2));
			$id_tree = (isset($temp[1][DBT_FAM_C2])) ? intval($temp[1][DBT_FAM_C2]) : 0;
		}
		return $id_tree;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function myFamily($id_user, $id_arbore, $local_direction = NULL)
	{
		$if_family = 0;
		if(is_int($id_user) && is_int($id_arbore))
		{
			// DBT_FAM = 'agenealogic';
			//   DBT_FAM_C1 = 'idul familiei';
			//   DBT_FAM_C2 = 'id_arbore';
			//   DBT_FAM_C6 = 'parinte 1';
			//   DBT_FAM_C7 = 'parinte 2';
			//   DBT_FAM_C8 = 'id_copii';
			switch($local_direction)
			{
				default:
					$array = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_arbore' and (`".DBT_FAM_C6."` = '$id_user' or `".DBT_FAM_C7."` = '$id_user')", NULL, 0, 1, array(DBT_FAM_C1));
					if(isset($array[1][DBT_FAM_C1]))
						$if_family = intval($array[1][DBT_FAM_C1]);
					else
					{
						$array = SQL_DB::sql_select(DBT_FAM, "(`".DBT_FAM_C2."` = '$id_arbore') and (`".DBT_FAM_C8."` LIKE '%-$id_user-%')", NULL, 0, 1, array(DBT_FAM_C1));
						if(isset($array[1][DBT_FAM_C1]))
							$if_family = intval($array[1][DBT_FAM_C1]);
					}
					break;
				case 'asc':
					$array = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_arbore' and (`".DBT_FAM_C6."` = '$id_user' or `".DBT_FAM_C7."` = '$id_user')", NULL, 0, 1, array(DBT_FAM_C1));
					$if_family = (isset($array[1][DBT_FAM_C1])) ? intval($array[1][DBT_FAM_C1]) : 0;
					break;
				case 'desc':
					$array = SQL_DB::sql_select(DBT_FAM, "(`".DBT_FAM_C2."` = '$id_arbore') and (`".DBT_FAM_C8."` LIKE '%-$id_user-%')", NULL, 0, 1, array(DBT_FAM_C1));
					$if_family = (isset($array[1][DBT_FAM_C1])) ? intval($array[1][DBT_FAM_C1]) : 0;
					break;
			}
		}
		return $if_family;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function myRel($id_family, $id_user)
	{
		$id_rel = 0;
		$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '$id_family'", NULL, 0, 1, array(DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
		if(isset($temp[1]))
		{
			if(intval($temp[1][DBT_FAM_C6]) == $id_user)
				$id_rel = 1;
			else
			if(intval($temp[1][DBT_FAM_C7]) == $id_user)
				$id_rel = 2;
			else
			if($temp[1][DBT_FAM_C8])
			{
				$children = AG_Operation::childrenInArray($temp[1][DBT_FAM_C8]);
				foreach($children['array'] as $id_children)
				{
					if($id_children == $id_user)
					{
						$id_rel = 3;
						break;
					}
				}
			}
		}
		return $id_rel;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function myDefaultUser($TreeID)
	{
		$id_user = 0;
		if(is_int($TreeID) && $TreeID > 0)
		{
			$array = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$TreeID'", NULL, 0, 1, array(DBT_FAM_C6, DBT_FAM_C7));
			if(isset($array[1][DBT_FAM_C6]) && $array[1][DBT_FAM_C6])
				$id_user = intval($array[1][DBT_FAM_C6]);
			else
			if(isset($array[1][DBT_FAM_C7]) && $array[1][DBT_FAM_C7])
				$id_user = intval($array[1][DBT_FAM_C7]);
		}
		return $id_user;
	}
	// ========================================================================
	function dbFamilyArray($AGmyIDTree, $AGmyIDFamily, $limit = 0, &$familyArray)
	{
		$familyArrayChildren = array();// lista cu copii tuturor famililor
		$familyArrayParents = array();// lista cu parintii tuturor famililor
		if($AGmyIDTree && $AGmyIDFamily)
		{
			// se creaza o lista cu toate familiile din arborele curent
			// DBT_FAM = 'agenealogic';
			//   DBT_FAM_C1 = 'id family';
			//   DBT_FAM_C2 = 'id_arbore';
			//   DBT_FAM_C4 = 'status';
			//     DBT_FAM_C4_V1 = 'current'
			//   DBT_FAM_C6 = 'parinte 1';
			//   DBT_FAM_C7 = 'parinte 2';
			//   DBT_FAM_C8 = 'id_copii';
			//print '<pre>'; var_export($familyArray); exit;
			if(!count($familyArray))
				$familyArray = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$AGmyIDTree' and `".DBT_FAM_C4."` = '".DBT_FAM_C4_V1."'", NULL, 0, 0, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
			// selectam key-a familiei aflate in prim plan
			// relam familiile si le transformam copii in array
			foreach($familyArray as $key => $value)
			{
				$familyArrayParents[$value[DBT_FAM_C1]] = array($value[DBT_FAM_C6], $value[DBT_FAM_C7]);
				if($value[DBT_FAM_C8])
				{
					$childrenInArray = AG_Operation::childrenInArray($value[DBT_FAM_C8]);
					$familyArray[$key]['count_copii'] = $childrenInArray['count'];
					$familyArray[$key]['array_copii'] = $childrenInArray['array'];
					$familyArrayChildren[$value[DBT_FAM_C1]] = $childrenInArray['array'];
				}
				else
				{
					$familyArray[$key]['count_copii'] = 0;
					$familyArray[$key]['array_copii'] = array();
					$familyArrayChildren[$value[DBT_FAM_C1]] = array();
				}
			}
		}
		return array('familyArray' => $familyArray, 'familyArrayChildren' => $familyArrayChildren, 'familyArrayParents' => $familyArrayParents);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function familiesPosition($dbFamilyArray, $AGmyIDFamily)
	{
		if(isset($dbFamilyArray['familyArrayChildren']) && isset($dbFamilyArray['familyArrayParents']) && isset($dbFamilyArray['familyArray']))
		{
			$familyPositions = array();
			$not_seted = array();// constine o lista cu familile care nu au fost setate
			$familyArrayChildren = $dbFamilyArray['familyArrayChildren'];// lista cu copii tuturor famililor
			$familyArrayParents = $dbFamilyArray['familyArrayParents'];// lista cu parintii tuturor famililor
			$familyIdKey = array();// contine id-ul familiei in raport cu key-a din array
			// se creaza o lista cu toate familiile din arborele curent
			// DBT_FAM = 'agenealogic';
			//   DBT_FAM_C1 = 'id family';
			//   DBT_FAM_C2 = 'id_arbore';
			//   DBT_FAM_C4 = 'status';
			//     DBT_FAM_C4_V1 = 'current'
			//   DBT_FAM_C6 = 'parinte 1';
			//   DBT_FAM_C7 = 'parinte 2';
			//   DBT_FAM_C8 = 'string copii';
			$array = $dbFamilyArray['familyArray'];
			// relam familiile si le transformam copii in array
			foreach($array as $key => $value)
			{
				$familyArrayParents[$value[DBT_FAM_C1]] = array($value[DBT_FAM_C6], $value[DBT_FAM_C7]);
				if($value[DBT_FAM_C8])
				{
					$childrenInArray = AG_Operation::childrenInArray($value[DBT_FAM_C8]);
					$array[$key]['count_copii'] = $childrenInArray['count'];
					$array[$key]['array_copii'] = $childrenInArray['array'];
					$familyArrayChildren[$value[DBT_FAM_C1]] = $childrenInArray['array'];
				}
				else
				{
					$array[$key]['count_copii'] = 0;
					$array[$key]['array_copii'] = array();
					$familyArrayChildren[$value[DBT_FAM_C1]] = array();
				}
				$not_seted[$value[DBT_FAM_C1]] = NULL;
				$familyIdKey[$value[DBT_FAM_C1]] = $key;
			}
			// rulam toate familile si stabilim pozitia in raport cu familia aflata in prim plan
			$key=0;
			$n=0; $m=500;// de cate ori poate rula (maximum) aceasta bucla | previne rularea infinita
			$backs = array();
			$primplan_family = false;// daca a fost setata
			do
			{
				$value = $array[$key];
				if(!count($not_seted) && !count($backs) && $value['id_family'] == $array[$key]['id_family'])
					break;// daca am continua ar repeta bucla inutil
				//
				// daca familia este in prim plan
				//print '<pre>'; var_export($AGmyIDFamily); exit;
				if($value['id_family'] == $AGmyIDFamily)
				{
					// se atribuie valorile
					$familyPositions[$value['id_family']] = array(
						'identifier' => array(
							'this' => '0',
							'asc' => NULL,
							'desc' => array(1 => NULL, 2 => NULL)
						),
						'ids' => array(
							'this' => $value['id_family'],
							'asc' => 0,
							'desc' => array(1 => 0, 2 => 0)
						),
						'recognition' => array(
							'type' => 1,
							'align' => NULL,
							'grade' => 1
						),
						'conectTo' => array(
							'id_family' => 0,
							'id_user' => 0
						)
					);
					$primplan_family = true;
					if($key > 1) $key = 1;
					unset($not_seted[$value['id_family']]);
					
					// cautam familia tatalui si a mamei
					$fam_tata = AG_Operation::searchInChildren($value[DBT_FAM_C6], $familyArrayChildren);
					$fam_mama = AG_Operation::searchInChildren($value[DBT_FAM_C7], $familyArrayChildren);
					
					$asc_identif = $familyPositions[$value['id_family']]['identifier']['this'];
					
					if($fam_tata)
					{
						$this_identif = $asc_identif.'0';
						$familyPositions[$value['id_family']]['identifier']['desc'][1] = $this_identif;
						$familyPositions[$value['id_family']]['ids']['desc'][1] = $fam_tata;
						
						// se atribuie valorile
						$this_grade = strlen($this_identif);
						$familyPositions[$fam_tata] = array(
							'identifier' => array(
								'this' => $this_identif,
								'asc' => $asc_identif,
								'desc' => array(1 => NULL, 2 => NULL)
							),
							'ids' => array(
								'this' => $fam_tata,
								'asc' => $value['id_family'],
								'desc' => array(1 => 0, 2 => 0)
							),
							'recognition' => array(
								'type' => 2,
								'align' => NULL,
								'grade' => $this_grade
							),
							'conectTo' => array(
								'id_family' => $value['id_family'],
								'id_user' => $value[DBT_FAM_C6]
							)
						);
						unset($not_seted[$fam_tata]);
						
						if($value['id_family'] == $array[$key]['id_family'])
							$key = $familyIdKey[$fam_tata];
						else
							$backs[] = $familyIdKey[$fam_tata];
					}
					if($fam_mama)
					{
						$this_identif = $asc_identif.'1';
						$familyPositions[$value['id_family']]['identifier']['desc'][2] = $this_identif;
						$familyPositions[$value['id_family']]['ids']['desc'][2] = $fam_mama;
						
						// se atribuie valorile
						$this_grade = strlen($this_identif);
						$familyPositions[$fam_mama] = array(
							'identifier' => array(
								'this' => $this_identif,
								'asc' => $asc_identif,
								'desc' => array(1 => NULL, 2 => NULL)
							),
							'ids' => array(
								'this' => $fam_mama,
								'asc' => $value['id_family'],
								'desc' => array(1 => 0, 2 => 0)
							),
							'recognition' => array(
								'type' => 2,
								'align' => NULL,
								'grade' => $this_grade
							),
							'conectTo' => array(
								'id_family' => $value['id_family'],
								'id_user' => $value[DBT_FAM_C7]
							)
						);
						unset($not_seted[$fam_mama]);
						
						if($value['id_family'] == $array[$key]['id_family'])
							$key = $familyIdKey[$fam_mama];
						else
							$backs[] = $familyIdKey[$fam_mama];
					}
					$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
					continue;
				}
				elseif($primplan_family)
				{
					// cautam familia tatalui si a mamei
					$fam_tata = AG_Operation::searchInChildren($value[DBT_FAM_C6], $familyArrayChildren);
					$fam_mama = AG_Operation::searchInChildren($value[DBT_FAM_C7], $familyArrayChildren);
					
					$asc_identif = $familyPositions[$value['id_family']]['identifier']['this'];
					
					if($fam_tata)
					{
						$this_identif = $asc_identif.'0';
						$familyPositions[$value['id_family']]['identifier']['desc'][1] = $this_identif;
						$familyPositions[$value['id_family']]['ids']['desc'][1] = $fam_tata;
						$this_grade = strlen($this_identif);
						// se atribuie valorile
						$familyPositions[$fam_tata] = array(
							'identifier' => array(
								'this' => $this_identif,
								'asc' => $asc_identif,
								'desc' => array(1 => NULL, 2 => NULL)
							),
							'ids' => array(
								'this' => $fam_tata,
								'asc' => $value['id_family'],
								'desc' => array(1 => 0, 2 => 0)
							),
							'recognition' => array(
								'type' => 3,
								'align' => NULL,
								'grade' => $this_grade
							),
							'conectTo' => array(
								'id_family' => $value['id_family'],
								'id_user' => $value[DBT_FAM_C6]
							)
						);
						unset($not_seted[$fam_tata]);
						
						$key = $familyIdKey[$fam_tata];
						if($fam_mama)
							$backs[] = $familyIdKey[$fam_mama];
					}
					if($fam_mama)
					{
						$this_identif = $asc_identif.'1';
						$familyPositions[$value['id_family']]['identifier']['desc'][2] = $this_identif;
						$familyPositions[$value['id_family']]['ids']['desc'][2] = $fam_mama;
						
						// se atribuie valorile
						$this_grade = strlen($this_identif);
						$familyPositions[$fam_mama] = array(
							'identifier' => array(
								'this' => $this_identif,
								'asc' => $asc_identif,
								'desc' => array(1 => NULL, 2 => NULL)
							),
							'ids' => array(
								'this' => $fam_mama,
								'asc' => $value['id_family'],
								'desc' => array(1 => 0, 2 => 0)
							),
							'recognition' => array(
								'type' => 3,
								'align' => NULL,
								'grade' => $this_grade
							),
							'conectTo' => array(
								'id_family' => $value['id_family'],
								'id_user' => $value[DBT_FAM_C7]
							)
						);
						unset($not_seted[$fam_mama]);
						
						if(!$fam_tata)
							$key = $familyIdKey[$fam_mama];
					}
					if(!$fam_tata && !$fam_mama)
					{
						if(count($backs))
						{
							$last_key =  array_pop(array_keys($backs));
							$key = $backs[$last_key];
							array_pop($backs);
							$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
							continue;
						}
						else
						{
							// s-au terminat toti descendentii
							break;
						}
							
					}
						
				}
				
				$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
			}
			while($n < $m);
			//echo 'Prima bucla a rulat de <strong>'.$n.'</strong> ori. Capacilate maxima de rulare: <strong>'.$m.'</strong>.<br />';
			//
			// initiem a doua bucla do-while pentru a actualiza $familyPositions si pe partea de ascendenti
			$key=0;
			$n=0; $m=500;// de cate ori poate rula (maximum) aceasta bucla | previne rularea infinita
			$backs = array();
			do
			{
				$value = $array[$key];
				//
				// daca familia este in prim plan
				if($value['id_family'] == $AGmyIDFamily)
				{
					$this_children = $familyArrayChildren[$value['id_family']];
					if(count($this_children))
					{
						$desc_identif = 1;
						foreach($this_children as $nr => $id_children)
						{
							$this_identif = $desc_identif.($nr+1);
							$searchInParents = AG_Operation::searchInParents($id_children, $familyArrayParents);
							$this_family = $searchInParents['id_family'];
							$parent = $searchInParents['parent'];
							if($this_family)
							{
								// se atribuie valorile
								$familyPositions[$this_family] = array(
									'identifier' => array(
										'this' => $this_identif,
										'asc' => NULL,
										'desc' => array(1 => NULL, 2 => NULL)
									),
									'ids' => array(
										'this' => $this_family,
										'asc' => 0,
										'desc' => array(1 => 0, 2 => 0)
									),
									'recognition' => array(
										'type' => 5,
										'align' => $parent,
										'grade' => 2
									),
									'conectTo' => array(
										'id_family' => $value['id_family'],
										'id_user' => $id_children
									)
								);
								$familyPositions[$this_family]['ids']['desc'][$parent] = $value['id_family'];
								$familyPositions[$this_family]['identifier']['desc'][$parent] = $desc_identif;
								unset($not_seted[$this_family]);
								
								if($value['id_family'] == $array[$key]['id_family'])
									$key = $familyIdKey[$this_family];
								else
									$backs[] = $familyIdKey[$this_family];
							}
						}
						if($value['id_family'] == $array[$key]['id_family'])
						{
							if(count($backs))
							{
								$last_key =  array_pop(array_keys($backs));
								$key = $backs[$last_key];
								array_pop($backs);
								continue;
							}
							else
								break;// s-au terminat toti ascendentii
						}
						else
							continue;
					}
					else
						break;// in cazul in care copii familiei aflata in prim plan nu are famili se termina bucla
				}
				else
				{
					$this_children = $familyArrayChildren[$value['id_family']];
					if(count($this_children))
					{
						$desc_identif = $familyPositions[$value['id_family']]['identifier']['this'];
						foreach($this_children as $nr => $id_children)
						{
							$this_identif = $desc_identif.($nr+1);
							$searchInParents = AG_Operation::searchInParents($id_children, $familyArrayParents);
							$this_family = $searchInParents['id_family'];
							$parent = $searchInParents['parent'];
							if($this_family)
							{
								// se atribuie valorile
								$this_grade = strlen($this_identif);
								$familyPositions[$this_family] = array(
									'identifier' => array(
										'this' => $this_identif,
										'asc' => NULL,
										'desc' => array(1 => NULL, 2 => NULL)
									),
									'ids' => array(
										'this' => $this_family,
										'asc' => 0,
										'desc' => array(1 => 0, 2 => 0)
									),
									'recognition' => array(
										'type' => 5,
										'align' => $parent,
										'grade' => $this_grade
									),
									'conectTo' => array(
										'id_family' => $value['id_family'],
										'id_user' => $id_children
									)
								);
								$familyPositions[$this_family]['ids']['desc'][$parent] = $value['id_family'];
								$familyPositions[$this_family]['identifier']['desc'][$parent] = $desc_identif;
								unset($not_seted[$this_family]);
								
								if($value['id_family'] == $array[$key]['id_family'])
									$key = $familyIdKey[$this_family];
								else
									$backs[] = $familyIdKey[$this_family];
							}
						}
						if($value['id_family'] == $array[$key]['id_family'])
						{
							if(count($backs))
							{
								$last_key =  array_pop(array_keys($backs));
								$key = $backs[$last_key];
								array_pop($backs);
								$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
								continue;
							}
							else
								break;// s-au terminat toti ascendentii
						}
						else
						{
							$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
							continue;
						}
					}
					else
					{
						if(count($backs))
						{
							$last_key =  array_pop(array_keys($backs));
							$key = $backs[$last_key];
							array_pop($backs);
							$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
							continue;
						}
						else
							break;// s-au terminat toti ascendentii
					}
				}
				
				$n++;// acesta nu se sterge, comenteaza sau conditioneaza! Previne rularea infinita
			}
			while($n < $m);
			//echo 'A doua bucla a rulat de <strong>'.$n.'</strong> ori. Capacilate maxima de rulare: <strong>'.$m.'</strong>.<br />';
			/**/
		}
		
		return $familyPositions;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function multidimensional_search($parents, $searched)
	{
		if (empty($searched) || empty($parents))
			return false;
		
		foreach ($parents as $key => $value)
		{ 
			$exists = true; 
			foreach ($searched as $skey => $svalue)
				$exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue); 
			if($exists)
				return $key; 
		}
		return false; 
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function import_search($info = array(), $id_tree = 0)
	{
		$arrayTree = array();
		$membersCurentTree = array();
		$where = NULL;
		$array1 = array();
		$array2 = array();
		$array = array();
		$members_key_id = array();
		// $info = array(
		//		'firstname' => 'Alfred',
		//		'lastname' => 'Martin',
		//		'born' => '1988-11-05',// optional
		//		'deces' => '2003-01-22'// optional
		// );
		//
		// daca $id_tree > 0 de vor elimita toti membri ce fac parte din arborele respectiv
		//
		// se creaza un array cu membrii actuali ai arborelui precizat
		// acestia nu trebuiesc sa apara in rezultatele cautarii fiindca nu pot fi importati in acelasi arbore de 2 ori
		if($id_tree)
		{
			$arrayTree = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$id_tree'");
			foreach($arrayTree as $row)
			{
				if($row[DBT_FAM_C6])
					$membersCurentTree[] = $row[DBT_FAM_C6];
				if($row[DBT_FAM_C7])
					$membersCurentTree[] = $row[DBT_FAM_C7];
				if($row[DBT_FAM_C8])
				{
					$exp = explode(',', $row[DBT_FAM_C8]);
					foreach($exp as $exp_value)
					{
						$exp_value = intval(str_replace('-', '', $exp_value));
						if($exp_value)
							$membersCurentTree[] = $exp_value;
					}
				}
			}
			array_unique($membersCurentTree);
		}
		
		if(isset($info[DBT_USER_INFO_C2]) && $info[DBT_USER_INFO_C2] && isset($info[DBT_USER_INFO_C3]) && $info[DBT_USER_INFO_C3])
		{
			$array1 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C2."` = '".$info[DBT_USER_INFO_C2]."'
													and `".DBT_USER_INFO_C3."` = '".$info[DBT_USER_INFO_C3]."'");
			$array2 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C2."` = '".$info[DBT_USER_INFO_C2]."'
													and `".DBT_USER_INFO_C3."` LIKE '".$info[DBT_USER_INFO_C3]."%'");
			$members_key_id = array();
			$array = array_merge($array1, $array2);
			foreach($array as $key => $row)
			{
				if(in_array($row[DBT_USER_INFO_C1], $members_key_id))
					unset($array[$key]);
				else
					$members_key_id[$key] = $row[DBT_USER_INFO_C1];
			}
		}
		else
		if(isset($info[DBT_USER_INFO_C2]) && $info[DBT_USER_INFO_C2])
		{
			$array1 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C2."` = '".$info[DBT_USER_INFO_C2]."'
													 or `".DBT_USER_INFO_C2."` LIKE '% ".$info[DBT_USER_INFO_C2]."'
													 or `".DBT_USER_INFO_C2."` LIKE '%-".$info[DBT_USER_INFO_C2]."'");
			$array2 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C2."` LIKE '".$info[DBT_USER_INFO_C2]."%'
													 or `".DBT_USER_INFO_C2."` LIKE '% ".$info[DBT_USER_INFO_C2]."%'
													 or `".DBT_USER_INFO_C2."` LIKE '%-".$info[DBT_USER_INFO_C2]."%'");
			$members_key_id = array();
			$array = array_merge($array1, $array2);
			foreach($array as $key => $row)
			{
				if(in_array($row[DBT_USER_INFO_C1], $members_key_id))
					unset($array[$key]);
				else
					$members_key_id[$key] = $row[DBT_USER_INFO_C1];
			}
		}
		else
		if(isset($info[DBT_USER_INFO_C3]) && $info[DBT_USER_INFO_C3])
		{
			$array1 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C3."` = '".$info[DBT_USER_INFO_C3]."'
													 or `".DBT_USER_INFO_C3."` LIKE '% ".$info[DBT_USER_INFO_C3]."'
													 or `".DBT_USER_INFO_C3."` LIKE '%-".$info[DBT_USER_INFO_C3]."'");
			$array2 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C3."` LIKE '".$info[DBT_USER_INFO_C3]."%'
													 or `".DBT_USER_INFO_C3."` LIKE '% ".$info[DBT_USER_INFO_C3]."%'
													 or `".DBT_USER_INFO_C3."` LIKE '%-".$info[DBT_USER_INFO_C3]."%'");
			$members_key_id = array();
			$array = array_merge($array1, $array2);
			foreach($array as $key => $row)
			{
				if(in_array($row[DBT_USER_INFO_C1], $members_key_id))
					unset($array[$key]);
				else
					$members_key_id[$key] = $row[DBT_USER_INFO_C1];
			}
		}
		else
		{
			$array = SQL_DB::sql_select(DBT_USER_INFO, NULL);
			$members_key_id = array();
			foreach($array as $key => $row)
			{
				if(in_array($row[DBT_USER_INFO_C1], $members_key_id))
					unset($array[$key]);
				else
					$members_key_id[$key] = $row[DBT_USER_INFO_C1];
			}
		}
		
		return $array;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// functie ce afiseaza toate familiile in care userul este parinte
	function where_is_parent($id_user)
	{
		// $extern[] = array(
		// 		'id_tree' => n,
		//		'id_family' => n,
		//		'id_user' => $id_user,
		//		'id_rel' => 1 or 2,
		// );
		$id_user = intval($id_user);
		$extern = array();
		$array = SQL_DB::sql_select(DBT_FAM, "(`".DBT_FAM_C6."` = '$id_user' OR `".DBT_FAM_C7."` = '$id_user') AND (`".DBT_FAM_C4."` = '".DBT_FAM_C4_V1."')", NULL);
		foreach($array as $row)
		{
			$id_rel = ($id_user == $row[DBT_FAM_C6]) ? 1 : 2;
			
			$extern[] = array(
				'id_tree' => $row[DBT_FAM_C2],
				'id_family' => $row[DBT_FAM_C1],
				'id_user' => $id_user,
				'id_rel' => $id_rel,		  
			);
		}
		return $extern;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function searchInChildren($id_user, $array)
	{
		// $array[$id_family] = array(
		// 		0 => $id_copil,
		//		1 => $id_copil,
		//		2 => $id_copil
		// );
		foreach($array as $id_family => $array_children)
		{
			if(in_array($id_user, $array_children))
			{
				return $id_family;
				break;
			}
		}
		return 0;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function searchInParents($id_user, $array)
	{
		// $array[$id_family] = array(
		// 		0 => $id_tata,
		//		1 => $id_mama
		// );
		foreach($array as $id_family => $array_parents)
		{
			if(in_array($id_user, $array_parents))
			{
				$parent = array_search($id_user, $array_parents);
				return array('id_family' => $id_family, 'parent' => ($parent+1));
				break;
			}
		}
		return 0;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function FamilyLines($recognition)
	{
		$PrintLines = array();
		
		$familyType = $recognition[0];
		$familyAlign = $recognition[1];
		$familyGrade = $recognition[2];
		$familyChildren = $recognition[3];
		$familyWidth = $recognition[4][0];
		$familyHeight = $recognition[4][1];
		$exRelatii = intval($recognition[5][0]);
		$exRelatieActiva = intval($recognition[5][1]);
		$option = $recognition[6];
		
		switch($familyType)
		{
			case 1:
				if($option == 2)// este pentru linile butoanelor
				{
					if($familyAlign == 1)
					{
						$half = 0;
						if($exRelatii >= 1)
							$PrintLines[1] = array(array($half, 90), array($half+ceil(AGFORMAT_T1_EX_W/2), 90));
						if($exRelatii >= 2)
							$PrintLines[2] = array(array($half, $PrintLines[1][0][1]-19), array($PrintLines[1][1][0], $PrintLines[1][1][1]-19));
						if($exRelatii >= 3)
							$PrintLines[3] = array(array($half, $PrintLines[2][0][1]-19), array($PrintLines[1][1][0], $PrintLines[2][1][1]-19));
						if($exRelatii >= 4)
							$PrintLines[4] = array(array($half, $PrintLines[3][0][1]-19), array($PrintLines[1][1][0], $PrintLines[3][1][1]-19));
						if($exRelatii >= 5)
							$PrintLines[5] = array(array($half, $PrintLines[4][0][1]-19), array($PrintLines[1][1][0], $PrintLines[4][1][1]-19));
						//print '<pre>'; var_export($PrintLines); exit;
					}
					else
					if($familyAlign == 2)
					{
						$half = 0;
						if($exRelatii >= 1)
							$PrintLines[1] = array(array($half, 90), array($half-ceil(AGFORMAT_T1_EX_W/2), 90));
						if($exRelatii >= 2)
							$PrintLines[2] = array(array($half, $PrintLines[1][0][1]-19), array($PrintLines[1][1][0], $PrintLines[1][1][1]-19));
						if($exRelatii >= 3)
							$PrintLines[3] = array(array($half, $PrintLines[2][0][1]-19), array($PrintLines[1][1][0], $PrintLines[2][1][1]-19));
						if($exRelatii >= 4)
							$PrintLines[4] = array(array($half, $PrintLines[3][0][1]-19), array($PrintLines[1][1][0], $PrintLines[3][1][1]-19));
						if($exRelatii >= 5)
							$PrintLines[5] = array(array($half, $PrintLines[4][0][1]-19), array($PrintLines[1][1][0], $PrintLines[4][1][1]-19));
					}
				}
				else
				{
					// default
					$PrintLines[1] = array(array(AGFORMAT_T1_ET_X, AGFORMAT_T1_ET_Y), array(AGFORMAT_T1_ET_X, AGFORMAT_T1_ET_Y+40));
					if($familyChildren)
						$PrintLines[2] = array(array(AGFORMAT_T1_ET_X, AGFORMAT_T1_ET_Y), array(AGFORMAT_T1_ET_X, AGFORMAT_T1_ET_Y-45));
					// parinte 1
					$PrintLines[3] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T1_P1_X, AGFORMAT_T1_P1_Y));
					// parinte 2
					$PrintLines[4] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T1_P2_X, AGFORMAT_T1_P2_Y));
					// copii
					for($nr=0; $nr<$familyChildren; $nr++)
					{
						
						$local_distance = AGFORMAT_T1_C_DIST;
						if(!$familyChildren%2)
						{
							$local_start = $familyChildren / 2 - 0.5;
							$local_half = $familyChildren / 2;
							if($nr <= $local_half)
							{
								$this_posX = ceil(($local_start - $nr) * $local_distance);
								if($this_posX)
									$this_posX *= -1;
							}
							else
								$this_posX = ceil((($nr - (floor($local_half) + 1)) + $local_start) * $local_distance);
						}
						else
						{
							$local_start = ($familyChildren - 1) / 2;
							$local_half = $familyChildren / 2;
							if($nr <= $local_half)
							{
								$this_posX = ceil(($local_start - $nr) * $local_distance);
								if($this_posX)
									$this_posX *= -1;
							}
							else
								$this_posX = ceil(($nr - $local_start) * $local_distance);
						}
						
						$this_posY = AGFORMAT_T1_C_Y + AGFORMAT_T1_UBH;
						
						$PrintLines[] = array(array($PrintLines[2][1][0], $PrintLines[2][1][1]), array($this_posX, $PrintLines[2][1][1]));
						$PrintLines[] = array(array($this_posX, $PrintLines[2][1][1]), array($this_posX, $this_posY));
					}
				}
				
				break;
			case 2:
			case -2:
				// default
				$PrintLines[1] = array(array(AGFORMAT_T2_ET_X, AGFORMAT_T2_ET_Y), array(AGFORMAT_T2_ET_X, AGFORMAT_T2_ET_Y+60));
				$PrintLines[2] = array(array(AGFORMAT_T2_ET_X, AGFORMAT_T2_ET_Y), array(AGFORMAT_T2_ET_X, AGFORMAT_T2_ET_Y+ceil(AGFORMAT_T1_ET_H/2)));
				$PrintLines[3] = array(array($PrintLines[2][1][0], $PrintLines[2][1][1]), array($PrintLines[2][1][0], 0));
				// parinte 1
				$PrintLines[4] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T2_P1_X, AGFORMAT_T2_P1_Y));
				// parinte 2
				$PrintLines[5] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T2_P2_X, AGFORMAT_T2_P2_Y));
				// copii
				for($nr=0; $nr<$familyChildren; $nr++)
				{
					$local_children = $familyChildren;
					$local_distance = AGFORMAT_T2_C_DIST;
					if($local_children%2)
						$local_children++;
					
					$local_start = $local_children / 2 - 0.5;
					$local_half = $local_children / 2;
					if($nr <= $local_half)
					{
						$this_posX = ceil(($local_start - $nr) * $local_distance);
						if($nr < $local_half)
							$this_posX += ceil(AGFORMAT_T2_C_SPACE/2);
						if($this_posX)
							$this_posX *= -1;
						if($nr == $local_half)
							$this_posX += ceil(AGFORMAT_T2_C_SPACE/2);
					}
					else
					{
						$this_posX = ceil(($nr - $local_start) * $local_distance);
						$this_posX += ceil(AGFORMAT_T2_C_SPACE/2);
					}
					
					$this_posY = AGFORMAT_T2_C_Y;
					
					$PrintLines[] = array(array($PrintLines[2][1][0], $PrintLines[2][1][1]), array($this_posX, $PrintLines[2][1][1]));
					$PrintLines[] = array(array($this_posX, $PrintLines[2][1][1]), array($this_posX, $this_posY));
				}
				break;
			case 3:
			case -3:
				// default
				$PrintLines[1] = array(array(AGFORMAT_T3_ET_X, AGFORMAT_T3_ET_Y), array(AGFORMAT_T3_ET_X, AGFORMAT_T3_ET_Y+40));
				$PrintLines[2] = array(array(AGFORMAT_T3_ET_X, AGFORMAT_T3_ET_Y), array(AGFORMAT_T3_ET_X, 0));
				// parinte 1
				$PrintLines[3] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T3_P1_X, AGFORMAT_T3_P1_Y));
				// parinte 2
				$PrintLines[4] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T3_P2_X, AGFORMAT_T3_P2_Y));
				// copii
				
				break;
			case 4:
			case -4:
				if($familyAlign == 1)
				{
					// default
					$half = ceil($familyWidth/2);
					if($exRelatii >= 1)
						$PrintLines[1] = array(array($half, 181), array($half-10, 181));
					if($exRelatii >= 2)
						$PrintLines[2] = array(array($half, $PrintLines[1][0][1]-19), array($PrintLines[1][1][0], $PrintLines[1][1][1]-19));
					if($exRelatii >= 3)
						$PrintLines[3] = array(array($half, $PrintLines[2][0][1]-19), array($PrintLines[1][1][0], $PrintLines[2][1][1]-19));
					if($exRelatii >= 4)
						$PrintLines[4] = array(array($half, $PrintLines[3][0][1]-19), array($PrintLines[1][1][0], $PrintLines[3][1][1]-19));
					if($exRelatii >= 5)
						$PrintLines[5] = array(array($half, $PrintLines[4][0][1]-19), array($PrintLines[1][1][0], $PrintLines[4][1][1]-19));
					// lini activa
					$PrintLines[6] = array(array($PrintLines[$exRelatieActiva][1][0]-5, $PrintLines[$exRelatieActiva][1][1]), array($PrintLines[$exRelatieActiva][1][0]-25, $PrintLines[$exRelatieActiva][1][1]));
					$PrintLines[7] = array(array($PrintLines[6][1][0], $PrintLines[6][1][1]), array($PrintLines[6][1][0], AGFORMAT_T4_ET_Y+ceil(AGFORMAT_T4_ET_H/2)));
					// catre mijlocul etichetei
					$PrintLines[8] = array(array($PrintLines[7][1][0], $PrintLines[7][1][1]), array($PrintLines[7][1][0]-100, $PrintLines[7][1][1]));
					// parinte
					$PrintLines[9] = array(array($PrintLines[8][1][0], $PrintLines[8][1][1]), array($PrintLines[7][1][0]-(AGFORMAT_T4_P_X-37), $PrintLines[7][1][1]));
					if($familyChildren > 0)
					{
						// copii
						$PrintLines[10] = array(array($PrintLines[8][1][0], $PrintLines[8][1][1]), array($PrintLines[8][1][0], $PrintLines[8][1][1]-70));
						// copil 1
						$PrintLines[11] = array(array($PrintLines[10][1][0], $PrintLines[10][1][1]), array($PrintLines[10][1][0]+40, $PrintLines[10][1][1]));
						$PrintLines[12] = array(array($PrintLines[11][1][0], $PrintLines[11][1][1]), array($PrintLines[11][1][0], $PrintLines[11][1][1]-13));
						// copii
						$key = 13;
						for($nr=2; $nr<=$familyChildren; $nr++)
						{
							$PrintLines[$key] = array(array($PrintLines[$key-2][1][0], $PrintLines[$key-2][1][1]), array($PrintLines[$key-2][1][0]-AGFORMAT_T4_C_DIST-2, $PrintLines[$key-2][1][1]));
							$key++;
							$PrintLines[$key] = array(array($PrintLines[$key-1][1][0], $PrintLines[$key-1][1][1]), array($PrintLines[$key-1][1][0], $PrintLines[$key-1][1][1]-13));
							$key++;
						}
					}
				}
				else
				if($familyAlign == 2)
				{
					// default
					$half = ceil($familyWidth/2) * -1;
					if($exRelatii >= 1)
						$PrintLines[1] = array(array($half, 181), array($half+10, 181));
					if($exRelatii >= 2)
						$PrintLines[2] = array(array($half, $PrintLines[1][0][1]-19), array($PrintLines[1][1][0], $PrintLines[1][1][1]-19));
					if($exRelatii >= 3)
						$PrintLines[3] = array(array($half, $PrintLines[2][0][1]-19), array($PrintLines[1][1][0], $PrintLines[2][1][1]-19));
					if($exRelatii >= 4)
						$PrintLines[4] = array(array($half, $PrintLines[3][0][1]-19), array($PrintLines[1][1][0], $PrintLines[3][1][1]-19));
					if($exRelatii >= 5)
						$PrintLines[5] = array(array($half, $PrintLines[4][0][1]-19), array($PrintLines[1][1][0], $PrintLines[4][1][1]-19));
					// lini activa
					$PrintLines[6] = array(array($PrintLines[$exRelatieActiva][1][0], $PrintLines[$exRelatieActiva][1][1]), array($PrintLines[$exRelatieActiva][1][0]+25, $PrintLines[$exRelatieActiva][1][1]));
					$PrintLines[7] = array(array($PrintLines[6][1][0], $PrintLines[6][1][1]), array($PrintLines[6][1][0], AGFORMAT_T4_ET_Y+ceil(AGFORMAT_T4_ET_H/2)));
					// catre mijlocul etichetei
					$PrintLines[8] = array(array($PrintLines[7][1][0], $PrintLines[7][1][1]), array($PrintLines[7][1][0]+100, $PrintLines[7][1][1]));
					// parinte
					$PrintLines[9] = array(array($PrintLines[8][1][0], $PrintLines[8][1][1]), array($PrintLines[7][1][0]+(AGFORMAT_T4_P_X-37), $PrintLines[7][1][1]));
					if($familyChildren > 0)
					{
						// copii
						$PrintLines[10] = array(array($PrintLines[8][1][0], $PrintLines[8][1][1]), array($PrintLines[8][1][0], $PrintLines[8][1][1]-70));
						// copil 1
						$PrintLines[11] = array(array($PrintLines[10][1][0], $PrintLines[10][1][1]), array($PrintLines[10][1][0]-40, $PrintLines[10][1][1]));
						$PrintLines[12] = array(array($PrintLines[11][1][0], $PrintLines[11][1][1]), array($PrintLines[11][1][0], $PrintLines[11][1][1]-13));
						// copii
						$key = 13;
						for($nr=2; $nr<=$familyChildren; $nr++)
						{
							$PrintLines[$key] = array(array($PrintLines[$key-2][1][0], $PrintLines[$key-2][1][1]), array($PrintLines[$key-2][1][0]+AGFORMAT_T4_C_DIST+2, $PrintLines[$key-2][1][1]));
							$key++;
							$PrintLines[$key] = array(array($PrintLines[$key-1][1][0], $PrintLines[$key-1][1][1]), array($PrintLines[$key-1][1][0], $PrintLines[$key-1][1][1]-13));
							$key++;
						}
					}
				}
				
				
				foreach($PrintLines as $key => $value)
				{
					if($key <= 5)
						unset($PrintLines[$key]);
				}
				break;
			case 5:
			case -5:
				// default
				$PrintLines[1] = array(array(AGFORMAT_T5_ET_X, AGFORMAT_T5_ET_Y), array(AGFORMAT_T5_ET_X, AGFORMAT_T5_ET_Y+40));
				if($familyChildren)
					$PrintLines[2] = array(array(AGFORMAT_T5_ET_X, AGFORMAT_T5_ET_Y), array(AGFORMAT_T5_ET_X, AGFORMAT_T5_ET_Y-15));
				// parinte 1
				$PrintLines[3] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T5_P1_X, AGFORMAT_T5_P_Y));
				// parinte 2
				$PrintLines[4] = array(array($PrintLines[1][1][0], $PrintLines[1][1][1]), array(AGFORMAT_T5_P2_X, AGFORMAT_T5_P_Y));
				// linia pentru parintele de legatura
				if($familyAlign == 1)
					$PrintLines[5] = array(array($PrintLines[3][1][0], $PrintLines[3][1][1]), array($PrintLines[3][1][0], $PrintLines[3][1][1]+AGFORMAT_T5_UBH+AGFORMAT_T5_P_MB));
				else
					$PrintLines[5] = array(array($PrintLines[4][1][0], $PrintLines[4][1][1]), array($PrintLines[4][1][0], $PrintLines[4][1][1]+AGFORMAT_T5_UBH+AGFORMAT_T5_P_MB));
				// copii
				for($nr=0; $nr<$familyChildren; $nr++)
				{
					
					$local_distance = AGFORMAT_T5_C_DIST;
					if($familyChildren%2)
						$local_start = ($familyChildren - 1) / 2;
					else
						$local_start = $familyChildren / 2 - 0.5;
					$local_half = $familyChildren / 2;
					if($nr <= $local_half)
					{
						$this_posX = ceil(($local_start - $nr) * $local_distance);
						if($this_posX)
							$this_posX *= -1;
					}
					else
						$this_posX = ceil(($nr -  $local_start) * $local_distance);
					
					$this_posY = AGFORMAT_T5_C_Y + AGFORMAT_T5_UBH;
					
					$PrintLines[] = array(array($PrintLines[2][1][0], $PrintLines[2][1][1]), array($this_posX, $PrintLines[2][1][1]));
					$PrintLines[] = array(array($this_posX, $PrintLines[2][1][1]), array($this_posX, $this_posY));
				}
				break;
		}
		return $PrintLines;
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/AG_Operation.html
?>