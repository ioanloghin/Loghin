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
// require:
//		function SQL_DB::sql_select();
//		function AG_Operation::childrenInArray();
//		function AG_Operation::get_members_connects();
//		function AG_Operation::family_update();
//		function AG_Operation::family_delete();
//		function AG_Operation::get_partener();
//
//
class AG_PoP2
{
	static $id_admin = 0; // id-ul administratorului
	private $my; // array cu date despre arborele celui care face administrarea
	private $linked; // array cu date despre membrul care face legatura intre familia noua si arbole
	private $extern; // array cu date despre arborele de unde se face importul (daca este cazul)
	private $info; // array cu informatile despre utilizator
	// pentru stocarea erorilor
	private $errno = 0;
	//
	// ========================================================================
	public function __construct($my_id_tree, $my_family_id, $my_id_user, $my_rel = 0)
	{
		global $acc_api;
		
		$this->my = array();
		$this->my['id_tree'] = 0;
		$this->my['family_id'] = 0;
		$this->my['id_user'] = 0;
		$this->my['id_rel'] = 0;
		$this->my['info'] = array();
		
		$this->linked = array();
		$this->linked['id_user'] = 0;
		$this->linked['direction'] = NULL;// asc|desc|ex1|ex2
		
		$this->extern = array();
		$this->extern['id_tree'] = 0;
		$this->extern['family_id'] = 0;
		$this->extern['id_user'] = 0;
		$this->extern['id_rel'] = 0;
		
		
		// memoram id_user
		if(is_numeric($my_id_user) && $my_id_user > 0)
			$this->my['id_user'] = intval($my_id_user);
		// memoram id_tree
		if(is_numeric($my_id_tree) && $my_id_tree > 0)
			$this->my['id_tree'] = intval($my_id_tree);
		// memoram id_rel
		if(in_array($my_rel, array(1, 2, 3)))
			$this->my['id_rel'] = $my_rel;
		
		if((!$my_family_id) && ($this->my['id_user'] > 0) && ($this->my['id_tree'] > 0))
		{
			$where = "(`".DBT_FAM_C2."` = '".$this->my['id_tree']."')";
			if(in_array($this->my['id_rel'], array(1, 2)))
				$where .= " AND (`".DBT_FAM_C6."` = '".$this->my['id_user']."' or `".DBT_FAM_C7."` = '".$this->my['id_user']."')";
			else
			if($this->my['id_rel'] == 3)
				$where .= " AND (`".DBT_FAM_C8."` LIKE '%-".$this->my['id_user']."-%')";
			// selectam id family
			$temp = SQL_DB::sql_select(DBT_FAM, $where, NULL, 0, 1, array(DBT_FAM_C1, DBT_FAM_C6, DBT_FAM_C7, DBT_FAM_C8));
			if(isset($temp[1][DBT_FAM_C1]))
				$this->my['family_id'] = intval($temp[1][DBT_FAM_C1]);
			unset($temp);
		}
		elseif($my_family_id)
		{
			if(is_int($my_family_id) && $my_family_id > 0)
				$this->my['family_id'] = $my_family_id;
		}
		
		// selectam informatile despre utilizator
		if($this->my['id_user'] > 0)
			$this->set_info($this->my['id_user'], $this->my['info']);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_linked($id_user, $direction = NULL)
	{
		if(is_numeric($id_user))
			$this->linked['id_user'] = intval($id_user);
		if(in_array($direction, array('ex1', 'ex2', 'asc', 'desc')))
			$this->linked['direction'] = $direction;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	static function get_linked($data)
	{
		$linked = array();
		$linked['id_user'] = 0;
		$linked['direction'] = NULL;
		
		if(strlen($data['this']['identifier']) > 3 && substr($data['this']['identifier'], 0, 3) == 'EX1')// pentru exrelatia din stanga (ex relatiile parintelui 1)
		{
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '".$data['asc']['id']."'", NULL, 0, 1, array(DBT_FAM_C6));
			$linked['id_user'] = (isset($temp[1][DBT_FAM_C6])) ? intval($temp[1][DBT_FAM_C6]) : 0;
			$linked['direction'] = 'ex1';
			unset($temp);
		}
		else
		if(strlen($data['this']['identifier']) > 3 && substr($data['this']['identifier'], 0, 3) == 'EX2')// pentru exrelatia din dreapta (ex relatiile parintelui 2)
		{
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '".$data['asc']['id']."'", NULL, 0, 1, array(DBT_FAM_C7));
			$linked['id_user'] = (isset($temp[1][DBT_FAM_C7])) ? intval($temp[1][DBT_FAM_C7]) : 0;
			$linked['direction'] = 'ex2';
			unset($temp);
		}
		else
		if($data['asc']['id'])
		{
			$desc_side = substr($data['this']['identifier'], strlen($data['asc']['identifier']), strlen($data['this']['identifier']) - strlen($data['asc']['identifier']));
			$key = ($desc_side == '1') ? DBT_FAM_C7 : DBT_FAM_C6;
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '".$data['asc']['id']."'", NULL, 0, 1, array($key));
			$linked['id_user'] = (isset($temp[1][$key])) ? intval($temp[1][$key]) : 0;
			$linked['direction'] = 'desc';
			unset($temp);
		}
		else
		if($data['desc']['id'])
		{
			$children_index = substr($data['this']['identifier'], strlen($data['desc']['identifier']), strlen($data['this']['identifier']) - strlen($data['desc']['identifier']));
			$children_index = intval($children_index);
			$children_index--; // scadem o valoare pentru ca numerotarea copiilor incepe de la 0
			$temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C1."` = '".$data['desc']['id']."'", NULL, 0, 1, array(DBT_FAM_C8));
			$children_string = (isset($temp[1][DBT_FAM_C8])) ? $temp[1][DBT_FAM_C8] : NULL;
			unset($temp);
			$children = AG_Operation::childrenInArray($children_string);
			foreach($children['array'] as $key => $local_id)
			{
				if($children_index == $key)
				{
					$linked['id_user'] = intval($local_id);
					$linked['direction'] = 'asc';
				}
			}
		}
		
		return $linked;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_admin($id_admin)
	{
		// memoram id_admin
		if(is_int($id_admin) && $id_admin > 0)
			$this->id_admin = $id_admin;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function check_admin()
	{
		// verifica fiecare operatiune de management daca administratorul are sau nu drepturi
		// returneaza FALSE daca administratorul nu are drepturi de a face respectiva operatiune
		return TRUE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_extern($extern_id_tree, $extern_family_id, $extern_id_user, $extern_rel)
	{
		if(is_numeric($extern_id_tree) && $extern_id_tree > 0)
			$this->extern['id_tree'] = intval($extern_id_tree);
		if(is_numeric($extern_family_id) && $extern_family_id > 0)
			$this->extern['family_id'] = intval($extern_family_id);
		if(is_numeric($extern_id_user) && $extern_id_user > 0)
			$this->extern['id_user'] = intval($extern_id_user);
		if(in_array($extern_rel, array(1, 2, 3)))
			$this->extern['id_rel'] = intval($extern_rel);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function create($sets, $obj_refresh = FALSE)
	{
		if(is_array($sets))
			$this->my['id_user'] = AG_Operation::user_create($sets);
		
		if($obj_refresh && $this->my['id_user'])
			$this->set_info($this->my['id_user'], $this->my['info']);
		
		// se creaza familia (daca nu exista)
		if(!$this->my['family_id'] && $this->my['id_tree'])
			$this->my['family_id'] = $this->new_family();
		
		// se adauga utilizatorul in familie
		/*if(!$this->linked['direction'] || in_array($this->linked['direction'], array('asc', 'desc')))
			$bool_insert = AG_Operation::family_user_add($this->my['family_id'], $this->my['id_user'], $this->my['id_rel']);
		else
		if(($this->linked['direction'] == 'ex1') || ($this->linked['direction'] == 'ex2'))*/
			$bool_insert = AG_Operation::family_user_add($this->my['family_id'], $this->my['id_user'], $this->my['id_rel']);
		
		
		return ($this->my['id_user']) ? TRUE : FALSE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function new_family()
	{
		$id_new_family = 0;
		$sets = array();
		switch($this->linked['direction'])
		{
			case 'ex1':
			case 'ex2':
				// ---------------------------------------------------------
				// daca id user extern != 0 inseamna ca se face import, in caz contrar inseamna ca se creaza un user nou
				$id_user2 = ($this->extern['id_user']) ? $this->extern['id_user'] : $this->my['id_user'];
				$id_new_family = AG_Operation::exrel_create_all($this->my['id_tree'], $this->linked['id_user'], $id_user2, $this->my['id_rel']);
				// ---------------------------------------------------------
				break;
			case 'desc':
			case 'asc':
				// ---------------------------------------------------------
				$id_new_family = AG_Operation::family_create($this->my['id_tree']);
				if($this->linked['direction'] == 'desc')
					$sets[DBT_FAM_C8] = '-'.$this->linked['id_user'].'-';
				else
				{
					// daca userul nostru trebuie inserat pe pozitia 1, userul de legatura va ocupa pozitia 2
					if($this->my['id_rel'] == 1)
						$sets[DBT_FAM_C7] = $this->linked['id_user'];
					else
					// daca userul nostru trebuie inserat pe pozitia 2, userul de legatura va ocupa pozitia 1
					if($this->my['id_rel'] == 2)
						$sets[DBT_FAM_C6] = $this->linked['id_user'];
					// daca userul nostru trebuie inserat pe pozitia 3, userul de legatura va ocupa pozitia in functie de sex-ul acestuia
					else
					{
						// obtinem sexul userului de legatura
						$linked_user_gender = AG_Operation::user_info($this->linked['id_user'], DBT_USER_INFO_C4);
						if($linked_user_gender == 2)
							$sets[DBT_FAM_C7] = $this->linked['id_user'];
						else
							$sets[DBT_FAM_C6] = $this->linked['id_user'];
					}
				}
				$bool_update = AG_Operation::family_update($id_new_family, $sets);
				// ---------------------------------------------------------
				break;
		}
		return $id_new_family;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function import()
	{
		$bool_import = false;
		// se creaza familia (daca nu exista)
		if(!$this->my['family_id'] && $this->my['id_tree'])
			$this->my['family_id'] = $this->new_family();
		
		// importam membrul
		if($this->my['id_user'])
		{
			// verificam daca este user default
			$tree_default_user = AG_Operation::tree_get_defaultUser($this->my['id_tree']);
			if($tree_default_user == $this->my['id_user'])
				AG_Operation::tree_set_defaultUser($this->my['id_tree'], $this->extern['id_user']);
			
			$bool_import = AG_Operation::family_user_change($this->my['family_id'], $this->my['id_user'], $this->extern['id_user'], $this->my['id_rel']);
			// modificam toate familile care il au ca referinta pe user-ul inlocuit
			$family_user_reference = AG_Operation::family_user_reference($this->my['id_tree'], $this->my['id_user']);
			foreach($family_user_reference as $local_family_id => $local_row)
				AG_Operation::family_user_change($local_family_id, $local_row['id_user'], $this->extern['id_user'], $local_row['id_rel']);
		}
		else
			$bool_import = AG_Operation::family_user_add($this->my['family_id'], $this->extern['id_user'], $this->my['id_rel']);
		
		return $bool_import;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function set_info($id_user, &$referinta_array_info)
	{
		$info = array();
		$info = $this->db_get_info($id_user);
		if(count($info) > 0)
			$referinta_array_info = $info;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function db_get_info($user_id)
	{
		global $acc_api;
		if(is_numeric($user_id) && $user_id > 0)
			return $acc_api->get_account($user_id);
		else
			return false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_info($info_key, $option = NULL)
	{
		$the_info = NULL;
		switch($info_key)
		{
			default:
				if(isset($this->my['info'][$info_key]))
					$the_info = $this->my['info'][$info_key];
				break;
			case "info":
				if(isset($this->my['info']))
					$the_info = $this->my['info'];
				break;
			case "image":
				if(isset($this->my['info'][DBT_USER_INFO_C5]) && $this->my['info'][DBT_USER_INFO_C5])
					$the_info = ROOT.$this->my['info'][DBT_USER_INFO_C5];	
				else
					$the_info = ROOT.'design/imagini/no_image.jpg';
				break;
			case "gender":
				if(isset($this->my['info'][DBT_USER_INFO_C4]))
				{
					switch($this->my['info'][DBT_USER_INFO_C4])
					{
						default:
							$the_info = NULL;
							break;
						case 1:
							$the_info = 'Masculin';
							break;
						case 2:
							$the_info = 'Feminin';
							break;
					}
				}
				break;
			case "fullname":
				if(isset($this->my['info'][DBT_USER_INFO_C2]) && isset($this->my['info'][DBT_USER_INFO_C3]))
					$the_info = $this->my['info'][DBT_USER_INFO_C2].' '.$this->my['info'][DBT_USER_INFO_C3];	
				break;
			case "age":
				$t_born = (isset($this->my['info'][DBT_USER_INFO_C6])) ? $this->my['info'][DBT_USER_INFO_C6] : NULL;
				$t_deces = (isset($this->my['info'][DBT_USER_INFO_C7])) ? $this->my['info'][DBT_USER_INFO_C7] : NULL;
				$the_info = AG_View::span_age($t_born, $t_deces);
				break;
		}
		return $the_info;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function import_local($id_partener, $children = array())
	{
		if(($id_partener) || (is_array($children) && count($children)))
		{
			// se creaza familie noua (daca este cazul) ==================
			// si se stabileste locul pentru partener ====================
			$side = 0;
			$id_new_family = 0;
			if($this->my['id_rel'] == 1)
			{
				$side = 2;
				$id_new_family = $this->my['family_id'];
			}
			else
			if($this->my['id_rel'] == 2)
			{
				$side = 1;
				$id_new_family = $this->my['family_id'];
			}
			else
			if($this->my['id_rel'] == 3)
			{
				$sets = array();
				// se creaza o noua familie
				$id_new_family = AG_Operation::family_create($this->my['id_tree']);
				// obtinem sexul userului de legatura
				$linked_user_gender = AG_Operation::user_info($this->extern['id_user'], DBT_USER_INFO_C4);
				if($linked_user_gender == 2)
				{
					$sets[DBT_FAM_C7] = $this->extern['id_user'];
					$side = 1;
				}
				else
				{
					$sets[DBT_FAM_C6] = $this->extern['id_user'];
					$side = 2;
				}
				// introducem utilizatorul de legatura
				AG_Operation::family_update($id_new_family, $sets);
			}
			//
			if($id_new_family)
			{
				// import partener(a) ========================================
				if($id_partener > 0)
					AG_Operation::family_user_add($id_new_family, $id_partener, $side);
				//
				// import copii ==============================================
				foreach($children as $id_children)
				{
					if(!AG_Operation::checkIn_children($id_new_family, $id_children))
						AG_Operation::family_children_add($id_new_family, $id_children);
				}
			}
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function import_expansive($families_for_import)
	{
		if(count($families_for_import))
		{
			$direction = ($this->my['id_rel'] == 3) ? 'asc' : 'desc';
			$family_linked = array();
			$family_linked = AG_Operation::family_get_linked($this->extern['id_tree'], $this->extern['id_user'], NULL);
			$return_import_expansive = AG_Operation::family_import_expansive($this->my['id_tree'], $families_for_import, $family_imported_user[0], $direction, $family_linked);
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function change($new_user_id)
	{
		if((is_int($new_user_id)) && ($new_user_id > 0) && ($this->from['family_id'] > 0))
		{
			// verificam daca este user default
			$default_user = AG_Operation::tree_get_defaultUser($this->from['id_tree']);
			if($default_user == $this->my['id_user'])
				//AG_Operation::tree_set_defaultUser($this->from['id_tree'], $new_user_id);
				print "set default user ".$new_user_id."<br />";
					
			//$bool_import1 = AG_Operation::family_user_change($this->from['family_id'], $this->my['id_user'], $new_user_id, $this->from['id_rel']);
			print "Family id = ".$this->from['family_id']." change user ".$this->my['id_user']." -> ".$new_user_id."<br />";
			// modificam toate familile care il au ca referinta pe user-ul inlocuit
			$family_user_reference = AG_Operation::family_user_reference($this->from['id_tree'], $this->my['id_user']);
			foreach($family_user_reference as $local_family_id => $local_row)
				//AG_Operation::family_user_change($local_family_id, $local_row['id_user'], $new_user_id, $local_row['id_rel']);
				print "[foreach] Family id = ".$local_family_id." change user ".$local_row['id_user']." -> ".$new_user_id."<br />";
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function edit($sets, $obj_refresh = FALSE)
	{
		$bool = FALSE;
		if(is_array($sets) && ($this->my['id_user'] > 0))
			$bool = SQL_DB::sql_update(DBT_USER_INFO, $sets, "`".DBT_USER_INFO_C1."` = '".$this->my['id_user']."'", 1);
		
		if($obj_refresh)
			$this->set_info($this->my['id_user'], $this->my['info']);
		
		return $bool;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function delete()
	{
		$bool = false;
		if($this->my['family_id'] > 0)
		{
			$is_parent = (in_array($this->my['id_rel'], array(1, 2)));
			$id_partener = 0;
			if($is_parent)
				$id_partener = AG_Operation::get_partener($this->my['family_id'], $this->my['id_user']);
			// daca este parinte iar partenerul nu este definit, se elimina familia
			if($is_parent && !$id_partener)
			{
				// eliminam familia
				if(!($bool = AG_Operation::family_delete($this->my['family_id'])))
					$this->errno = 301;
				// eliminam ex relatiile familiei
				AG_Operation::exrel_delete_all($this->my['family_id'], $this->my['family_id'], 0);
			}
			else// in caz contrar, se eliminam doar membrul
			{
				$sets = array();
				switch($this->my['id_rel'])
				{
					case 1:
					case 2:
						if($this->my['id_rel'] == 1)
							$sets[DBT_FAM_C6] = 0;
						else
							$sets[DBT_FAM_C7] = 0;
						if(!($bool = AG_Operation::family_update($this->my['family_id'], $sets)))
							$this->errno = 302;
						break;
					case 3:
						if(!($bool = AG_Operation::family_children_delete($this->my['family_id'], $this->my['id_user'])))
							$this->errno = 303;
						break;
					default: $this->errno = 304; break;
				}
				// eliminam ex relatiile familiei
				AG_Operation::exrel_delete_all($this->my['family_id'], $this->my['family_id'], $this->my['id_user']);
			}
			
			if($is_parent)
				$remove_direction = 'only_desc';// eliminam descendentii daca userul deletat este parinte
			elseif($this->my['id_rel'] == 3)
				$remove_direction = 'only_asc';// eliminam ascendentii daca userul deletat este copil
			
			if(isset($remove_direction))
			{
				$member_ids = AG_Operation::get_members_connects($this->my['id_tree'], $this->my['id_user'], $remove_direction);
				foreach($member_ids as $local_id => $members)
				{
					// eliminam familia
					AG_Operation::family_delete($local_id);
					// eliminam ex relatiile familiei
					AG_Operation::exrel_delete_all($this->my['family_id'], $local_id, 0);
				}
			}
			
			// daca userul era default la arbore, il schimbam
			$default_user = AG_Operation::tree_get_defaultUser($this->my['id_tree']);
			if($this->my['id_user'] == $default_user)
			{
				if($id_partener > 0)// daca partenerul exista il introducem pe el ca user default
					AG_Operation::tree_set_defaultUser($this->my['id_tree'], $id_partener);
				else
					AG_Operation::tree_set_defaultUser($this->my['id_tree'], 0);// setam pe 0 (fara user default)
			}
		}
		else
			$this->errno = 300;
		return $bool;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function errno()
	{
		return $this->errno;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function strerror()
	{
		$strerror[0] = NULL; // nu sunt erori
		// pentru creare si editare
		$strerror[100] = "Eroare 1";
		$strerror[101] = "Eroare 1";
		$strerror[102] = "Eroare 1";
		// pentru importul de utilizatori
		$strerror[200] = "Eroare 1";
		$strerror[201] = "Eroare 1";
		$strerror[202] = "Eroare 1";
		// pentru stergerea utilizatorului
		$strerror[300] = "Nu s-a specificat familia din care face parte userul.";
		$strerror[301] = "Familia nu s-a putut sterge.";
		$strerror[302] = "Parintele nu s-a putut sterge din familie.";
		$strerror[303] = "Copilul nu s-a putut sterge din familie.";
		$strerror[304] = "Nu s-a specificat pozitia userului.";
		
		if(isset($strerror[$this->errno]))
			return $strerror[$this->errno];
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/AG_UserAdmin.html
?>