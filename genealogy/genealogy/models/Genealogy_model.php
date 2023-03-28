<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

/*
 * Contine toate functile de administrare si gestionare pentru arborii genealogici
 * Functii: tree_insert, family_insert, family_add_child, family_delete_child, family_add_parent, family_delete_parent
 */


class Genealogy_model extends SQL_DB
{
	private $errors;
	
	public  $admin_id;
	public  $tree_id;
	public  $family_id;
	public  $member_id;
	public  $rel_id;
	public  $link_member_id;
	public  $direction;
	
	public  $acc_api;
	
	
	// -----------------------------------------------------------------------
	public function __construct()
	{
		$this->errors    = array();
		
		$this->admin_id  = 0;
		$this->tree_id   = 0;
		$this->family_id = 0;
	}
	
	
	// input: void
	// output: (bool)
	public function sql_start()
	{
		if($this->acc_api)
			$this->acc_api->sql_start();
		
		return parent::sql_querry("START TRANSACTION;"); 
	}
	
	
	
	// input: void
	// output: (bool)
	public function sql_commit()
	{
		return parent::sql_querry("COMMIT;"); 
	}
	
	
	
	// input: void
	// output: (bool)
	public function sql_rollback()
	{
		return parent::sql_querry("ROLLBACK;"); 
	}
	
	
	public function errors_str()
	{
		return implode('<br />', $this->errors);
	}
	
	
	// -----------------------------------------------------------------------
	// insereaza membrul si creaza toate legaturile de care are nevoie arborele
	public function regMemberCompletelyInsert($account_id, $p_config)
	{
		if(!array_key_exists("tree_id", $p_config) || !array_key_exists("direction", $p_config) || !array_key_exists("family_id", $p_config) || !array_key_exists("rel_id", $p_config) || !array_key_exists("link_member_id", $p_config))
		{
			$this->errors[] = "gen_memeber_insert(): Lipsesc setari din lista de configuratie!";
			return false;
		}
		
		$this->acc_api->sql_start();
		
		// daca este vorba de o ex relatie
		if($p_config['direction'] == 'ex1' || $p_config['direction'] == 'ex2')
		{
			// se creaza un membru pentru arbore
			$ex_member_id  = $this->member_insert($account_id);
			
			// daca nu s-a trimis nici o familie
			if($p_config['family_id'] == 0)
			{
				$new_tree_created = true;
				// se creaza un arbore secundar
				if(($ex_tree_id = $gen->tree_insert($ex_member_id, NULL, 0)) == 0)
				{
					$acc_api->sql_rollback();
					$gen->sql_rollback();
					$POST->set_error('system', "Arborele secundar nu a putut fi creat.");
				}
				
				// se creaza o familie in arborele secundar
				if(!$POST->errors() && !($ex_family_id = $gen->family_insert($ex_tree_id, array('name' => $new_account['firstname']))))
				{
					$acc_api->sql_rollback();
					$gen->sql_rollback();
					$POST->set_error('system', "Familia din arborele secundar nu a putut fi creata.");
				}
			}
			else
			{
				$new_tree_created = false;
				$ex_family_id = $p_config['family_id'];
				$ex_family = $gen->get_family($ex_family_id);
				$ex_tree_id = $ex_family['tree_id'];
			}
			
			// daca nu sunt erori
			if(!$POST->errors())
			{
				// instructiuni suplimentare pentru copil
				if($rel_id == 3)
				{
					// se adauga membru nou creat in familie
					$gen->tree_id	= $ex_tree_id;// set tree id
					$gen->family_id	= $ex_family_id;// set family id
					// -------------------------------------------------------------------------------
					// se adauga membrul pe pozitia de copil in familia curenta
					if(!$POST->errors() && !$gen->family_add_child($ex_member_id))
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Userul nou creat nu a putut fi introdus in familia curenta.");
					}
					// EXPORT REGISTER se adauga membrul la familie
					if($reg_family_id = $gen->get_reg_family_id())
					{
						$acc_api->family_member_insert($reg_family_id, $ex_member_id, 'child');
					}
					// -------------------------------------------------------------------------------
					//
					//
					//
					// -------------------------------------------------------------------------------
					// se creaza o familie noua pentru perspectiva desc a membrului
					if(!$gen->family_insert($ex_tree_id, array('name' => $new_account['firstname'])))
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Familia nu a putut fi creata.");
					}
					// se adauga membrul in familia pentru perspectiva desc
					if(!$POST->errors() && !$gen->family_add_parent(1, $ex_member_id))
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Userul nou creat nu a putut fi introdus in familie.");
					}
					// EXPORT REGISTER - se adauga membrul la familie si in register
					if($acc_api->family_id > 0 && !$acc_api->family_member_insert($acc_api->family_id, $account_id, 'parent'))
					{
						$acc_api->sql_rollback();
						$POST->set_error('system', "Membrul nu a putut fi exportat catre register.loghin.com");
					}
					// -------------------------------------------------------------------------------
				}
				
				
				
				// instructiuni pentru parinti
				if($p_config['rel_id'] == 1 || $p_config['rel_id'] == 2 || $new_tree_created)
				{
					// daca s-a cerut intruducerea unui copil si nu era deja creat arborele
					if($p_config['rel_id'] == 3)
					{
						// se mai creaza un membru nou, pe post de parinte
						// LEGATURA INTRE ARBORI SE FACE DOAR INTRE PARINTI
						$ex_member_id  = $gen->member_insert(0);
						$rel_id = ($p_config['direction'] == 'ex1') ? 2 : 1;
					}
					
					// se adauga membru nou creat in familia curenta
					$gen->tree_id	= $ex_tree_id;// set tree id
					$gen->family_id	= $ex_family_id;// set family id
					// -------------------------------------------------------------------------------
					// se adauga membrul pe pozitia de parinte in familia curenta
					if(!$POST->errors() && !$gen->family_add_parent($p_config['rel_id'], $ex_member_id))
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Userul nou creat nu a putut fi introdus in familia curenta.");
					}
					// EXPORT REGISTER se adauga membrul la familie
					if($reg_family_id = $gen->get_reg_family_id())
					{
						$acc_api->family_member_insert($reg_family_id, $ex_member_id, 'parent');
					}
					// -------------------------------------------------------------------------------
					//
					//
					// -------------------------------------------------------------------------------
					// se creaza o familie noua in care membrul este copil (pentru perspectiva asc)
					if(!$gen->family_insert($ex_tree_id, array('name' => $new_account['firstname']))/* func. schimba $gen->family_id cu id-ul nou creat */)
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Familia nu a putut fi creata.");
					}
					// se adauga membru in familia pentru perspectiva asc
					if(!$POST->errors() && !$gen->family_add_child($ex_member_id)/* lucreaza pe id-ul nou creat */)
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Userul de legatura nu a putut fi introdus in familia noua.");
					}
					// EXPORT REGISTER - se adauga membrul la familie si in register
					if($acc_api->family_id > 0 && !$acc_api->family_member_insert($acc_api->family_id, $account_id, 'child'))
					{
						$acc_api->sql_rollback();
						$POST->set_error('system', "Membrul nu a putut fi exportat catre register.loghin.com");
					}
					// -------------------------------------------------------------------------------
				}
				
				// obtine familia userului de legatura
				$p_config['family_id'] = 0;
				foreach($gen->get_member_families($link_member_id) as $fam)
					if($fam['side'] == 'p1' || $fam['side'] == 'p2')
						$p_config['family_id'] = $fam['family_id'];
				
				if($p_config['family_id'] == 0)
				{
					$acc_api->sql_rollback();
					$gen->sql_rollback();
					$POST->set_error('system', "Familia userului de legatura nu a fost gasita.");
				}
				
				// se creeaza legatura intre arborele principal si cel secundar
				// doar daca nu s-a creat un arbore nou
				if(!$POST->errors() && $new_tree_created && !$gen->tree_link_insert($p_config['tree_id'], $p_config['family_id'], $p_config['link_member_id'], $ex_tree_id, $ex_family_id, $ex_member_id))
				{
					$acc_api->sql_rollback();
					$gen->sql_rollback();
					$POST->set_error('system', "Legatura intre arbori nu a putut fi creeata.");
				}
				
				// schimbam datele pentru afisare
				$params['tree_id'] = $ex_tree_id;
				$params['member_id'] = $ex_member_id;
			}
		}
		else// end if($p_config['direction'] == 'ex1' || $p_config['direction'] == 'ex2')
		{
			// se adauga membrul in familii
			switch($p_config['rel_id'])
			{
				case 1:
				case 2:
					// se adauga membrul pe pozitia parinte
					// daca $p_config['family_id'] == 0, se va insera intr-o familie noua
					if(!$this->acc_api->family_member_insert($p_config['family_id'], $account_id, 'parent'))
					{
						$this->acc_api->sql_rollback();
						$this->errors[] = "gen_memeber_insert(): Membrul nu a putut fi inserat pe pozitia parinte (#1).";
						return false;
					}
					
					// se creaza o noua familie si se adauga membrul pe pozitia copil
					if(!$this->acc_api->family_member_insert(0, $account_id, 'child'))
					{
						$this->acc_api->sql_rollback();
						$this->errors[] = "gen_memeber_insert(): Membrul nu a putut fi inserat pe pozitia child (#1).";
						return false;
					}
					break;
				case 3:
					// se adauga membrul pe pozitia copil
					if(!$this->acc_api->family_member_insert($p_config['family_id'], $account_id, 'child'))
					{
						$this->acc_api->sql_rollback();
						$this->errors[] = "gen_memeber_insert(): Membrul nu a putut fi inserat pe pozitia child (#2).";
						return false;
					}
					
					// se creaza o noua familie si se adauga membrul pe pozitia parinte
					if(!$this->acc_api->family_member_insert(0, $account_id, 'parent'))
					{
						$this->acc_api->sql_rollback();
						$this->errors[] = "gen_memeber_insert(): Membrul nu a putut fi inserat pe pozitia parent (#2).";
						return false;
					}
					break;
			}
		}
		
		// FIXME: de decomentat
		//$this->acc_api->sql_commit();
		
		
		
		
		return true;
	}
	// -----------------------------------------------------------------------
	
	
	// -----------------------------------------------------------------------
	// elimita familiile care au avize
	public function compatibility_elimitate_nonapproval_families(&$families_GEN)
	{
		foreach($families_GEN as $k => $f)
		{
			if($this->acc_api->is_approval($f['account_id'], $f['family_id']))
				unset($families_GEN[$k]);
		}
	}
	
	
	// -----------------------------------------------------------------------
	// functile compatibility adapteaza formatul datelor provenite din register
	// la sistemul de afisare genealogy
	//
	// aceasta functie returneaza toate familile care sunt legate de acest account
	// practic creeaza un arbore virtual al acestui account
	public function compatibility_generate_tree_families($account_id, $family_id = 0)
	{
		// familile in format 'genealogy'
		$genealogy_families = array(); 
		
		if($family_id == 0)
		{
			// familia aflata la cheia [0] trebuie sa fie familia aflata in prim plan
			$arr = $this->acc_api->sql_select('l_families_members', "`account_id` = '$account_id' AND `grade` = 'parent'", NULL, 0, 1);
			if(!$arr)// daca nu s-a gasit o familie in care este parinte, se cauta o familie in care este copil
				$arr = $this->acc_api->sql_select('l_families_members', "`account_id` = '$account_id' AND `grade` = 'child'", NULL, 0, 1);	
			// daca nu s-a gasit nici o familie din care account-ul sa faca parte, nu se poate genera arborele
			if(!$arr)
				return false;
		}
		else
			$arr[0]['family_id'] = $family_id;
		
		// se introduce familia aflata in prim plan
		$genealogy_families[0] = $this->compatibility_family($arr[0]['family_id']);
		
		// se introduc si celelalte familii inrudite
		// obtine familiile din arborele curent (in format REGISTER)
		$this->compatibility_familly2tree_families($families_REG, $arr[0]['family_id'], false);
		
		// elimina dublurile pentru accounturi
		/*$unique = array(); $deleting = array();
		foreach($families_REG as $key => $fam)
		{
			if(in_array($fam['account_id'], $unique))
				$deleting[] = $fam['family_id'];
			else
				$unique[$fam['account_id']] = true;
		}
		foreach($families_REG as $key => $fam)
		{
			if(in_array($fam['family_id'], $deleting))
				unset($families_REG[$key]);
		}*/
		
		
		// converteste familiile in format GENEALOGY
		$families_GEN = $this->compatibility_families_to_gen($families_REG);
		
		foreach($families_GEN as $fam)
			$genealogy_families[] = $fam;
		
		return $genealogy_families;
	}
	
	// returneaza familia din register, in formatul bazei de date genealogy
	// Register format:
	// account_id 	family_id 	firstname 	lastname 	grade 	adopted 	father_name 	mother_name
	//     2	       4	      Chis	      Ioan	    parent	   0
	//
	// Genealogy format:
	// family_id 	tree_id 	Parent1 	Parent2 	Children
	//     4	       2	       0	       4	     -3-,-5-
	public function compatibility_family($family_id)
	{
		$arr = $this->acc_api->sql_select('l_families_members', "family_id = '$family_id'");
		$arr2 = $this->acc_api->sql_select('l_families', "family_id = '$family_id'");
		$parent1 = 0;
		$parent2 = 0;
		$children_string = '';
		
		foreach($arr as $member)
		{
			switch($member['grade'])
			{
				case 'parent':
					if(!$parent1)
						$parent1 = $member['account_id'];
					else
						$parent2 = $member['account_id'];
					break;
				case 'child':
					if($children_string)
						$children_string .= ',';
					
					$children_string .= '-'.$member['account_id'].'-';
					break;
			}
		}
		
		$genealogy_family = array(
			'family_id' => (int)$family_id,
			'account_id'=> (int)$arr2[0]['account_id'],
			'tree_id'   => 0,
			'Parent1'   => (int)$parent1,
			'Parent2'   => (int)$parent2,
			'Children'  => $children_string,
			'name'      => $arr2[0]['name'],
			'lastname'  => $arr2[0]['lastname'],
			'country'   => $arr2[0]['country'],
			'location'  => $arr2[0]['location'],
			'zip'       => $arr2[0]['zip'],
			'aniversary'=> $arr2[0]['aniversary'],
			'type'      => $arr2[0]['type'],
		);
		
		return $genealogy_family;
	}
	
	// returneaza toate familile inrudite cu familia curenta (in format REGISTER)
	// $inclusiv - true (va include si prima familie pentru care s-a facut cererea)
	public function compatibility_familly2tree_families(&$families_ids, $family_id, $inclusiv = true)
	{
		if(!isset($families_ids))
			$families_ids = array();
		
		if($inclusiv)
			$families_ids[] = $family_id;
		$arr = $this->acc_api->sql_select('l_families_members', "`family_id` = '$family_id'");
		
		foreach($arr as $row)
		{
			$grade = ($row['grade'] != 'parent') ? 'parent' : 'child';
			$family_id = $this->compatibility_account2family_id($row['account_id'], $grade);
			if($family_id && !in_array($family_id, $families_ids))
				$this->compatibility_familly2tree_families($families_ids, $family_id, true);
		}
	}
	// --------------------------------------------------------------------------
	//
	//
	// converteste familiile returnate de functia compatibility_familly2tree_families() in format GENEALOGY
	public function compatibility_families_to_gen($families_ids)
	{
		$gen_families = array();
		foreach($families_ids as $family_id)
			$gen_families[] = $this->compatibility_family($family_id);
		return $gen_families;
	}
	// --------------------------------------------------------------------------
	//
	//
	// returneaza family_id selectata dupa un account_id
	public function compatibility_account2family_id($account_id, $grade)
	{
		$arr = $this->acc_api->sql_select('l_families_members', "`account_id` = '$account_id' AND `grade` = '$grade'", NULL, 0, 1);
		return (isset($arr[0]['family_id'])) ? $arr[0]['family_id'] : 0;
	}
	// --------------------------------------------------------------------------
	//
	//
	// functia AG_Operation::dbFamilyArray(), versiune compatibila cu DIRECT_MODE
	public function compatibility_dbFamilyArray($family_id, $limit = 0)
	{
		
		// obtine familiile din arborele curent (in format REGISTER)
		$this->compatibility_familly2tree_families($families_REG, $family_id, true);
		
		// converteste familiile in format GENEALOGY
		$families_GEN = $this->compatibility_families_to_gen($families_REG);
		
		
		$familyArrayChildren = array();// lista cu copii tuturor famililor
		$familyArrayParents = array();// lista cu parintii tuturor famililor
		if($family_id)
		{
			// selectam key-a familiei aflate in prim plan
			// relam familiile si le transformam copii in array
			foreach($families_GEN as $key => $value)
			{
				$familyArrayParents[$value['family_id']] = array($value['Parent1'], $value['Parent2']);
				if($value['Children'])
				{
					$childrenInArray = AG_Operation::childrenInArray($value['Children']);
					$families_GEN[$key]['count_copii'] = $childrenInArray['count'];
					$families_GEN[$key]['array_copii'] = $childrenInArray['array'];
					$familyArrayChildren[$value['family_id']] = $childrenInArray['array'];
				}
				else
				{
					$families_GEN[$key]['count_copii'] = 0;
					$families_GEN[$key]['array_copii'] = array();
					$familyArrayChildren[$value['family_id']] = array();
				}
			}
		}
		return array('familyArray' => $families_GEN, 'familyArrayChildren' => $familyArrayChildren, 'familyArrayParents' => $familyArrayParents);
	}
	// -----------------------------------------------------------------------
	//
	//
	// returneaza familile din care userul face parte
	public function compatibility_get_member_tree($account_id)
	{
		$list = array();
		$arr = $this->acc_api->sql_select('l_families_members', "`account_id` = '$account_id' AND `grade` = 'parent'");
		foreach($arr as $fam)
			if(!array_key_exists($fam['family_id'], $list))
				$list[$fam['family_id']] = $fam;
		
		$arr = $this->acc_api->sql_select('l_families_members', "`account_id` = '$account_id' AND `grade` = 'child'");
		foreach($arr as $fam)
			if(!array_key_exists($fam['family_id'], $list))
				$list[$fam['family_id']] = $fam;
		
		// reset keys
		$list = array_values($list);
		
		return $list;
	}
	// -----------------------------------------------------------------------
	//
	//
	// -----------------------------------------------------------------------
	// input: (int) $reg_family_id <-- id-ul familiei din register.loghin.com
	// output: (bool)
	public function set_reg_family_id($reg_family_id)
	{
		// check $reg_family_id
		if($reg_family_id <= 0)
		{
			$this->set_error('reg_family', 'Reg Family ID is 0.');
			return false;
		}
		
		return parent::sql_update(MYSQL_PRE.'families', array('reg_family_id' => $reg_family_id), "`family_id` = '".$this->family_id."'", 1);
	}
	
	
	
	// -----------------------------------------------------------------------
	// input: (int) $family_id, (int) $user_id
	// output: (bool)
	public function get_reg_family_id($family_id = 0)
	{
		// check $family_id
		if($family_id == 0)
			$family_id = $this->family_id;
		
		if(!is_int($family_id))
			$family_id = (int)$family_id;
		if($family_id <= 0)
		{
			$this->set_error('family', 'Family ID is 0.');
			return false;
		}
		
		// get childen string
		$temp = parent::sql_select(MYSQL_PRE.'families', "`family_id` = '$family_id'", NULL, 0, 1, array('reg_family_id'));
		if(!isset($temp[1]['reg_family_id']))
		{
			$this->set_error('family', 'Family does not exist.');
			return false;
		}
		return $temp[1]['reg_family_id'];
	}
	
	// -----------------------------------------------------------------------
	// input: (int) $member_id
	// output: (int) $account_id
	public function member2account($member_id)
	{
		$temp = parent::sql_select(MYSQL_PRE.'members', "`member_id` = '$member_id'", NULL, 0, 1, array('account_id'));
		return (isset($temp[1]['account_id'])) ? $temp[1]['account_id'] : 0;
	}
	
	
	// -----------------------------------------------------------------------
	// input: (int) $member_id, (string) $label, (char) $primary
	// output: (int) $tree_id
	public function tree_insert($member_id, $label = NULL, $primary = '1')
	{
		if($label == NULL)
			$label = "New tree (".rand(11,99).")";
		
		// se creaza arborelee
		$this->tree_id = parent::sql_insert(MYSQL_PRE.'trees', array('admin_id' => $member_id, 'default_member_id' => $member_id, 'label' => $label, 'primary' => $primary));
		
		// se creeaza legatura arbore-user
		$this->member_tree_insert($member_id, $this->tree_id);
		
		return $this->tree_id;
	}
	
	
	// -----------------------------------------------------------------------
	private function member_tree_insert($member_id, $tree_id, $admin = '0')
	{
		// comanda nu returneaza nimic intrucat tabelul nu are primary key
		parent::sql_insert(MYSQL_PRE.'members_in_tree', array('member_id' => $member_id, 'tree_id' => $tree_id, 'admin' => $admin));
	}
	
	// -----------------------------------------------------------------------
	private function member_tree_delete($member_id, $tree_id)
	{
		// comanda nu returneaza nimic intrucat tabelul nu are primary key
		parent::sql_delete(MYSQL_PRE.'members_in_tree', "`member_id` = '$member_id' AND `tree_id` = '$tree_id'", 1);
	}
	
	// -----------------------------------------------------------------------
	public function get_member_tree($account_id)
	{
		return SQL_DB::sql_left_join(MYSQL_PRE."members_in_tree", MYSQL_PRE."trees", "`t1`.tree_id = `t2`.tree_id", "`t1`.`member_id` IN
									 (SELECT `member_id` FROM `gen_members` WHERE `account_id` = '$account_id')");
	}
	
	// -----------------------------------------------------------------------
	public function in_tree($account_id, $tree_id)
	{
		$arr = SQL_DB::sql_select(MYSQL_PRE."members_in_tree", "`tree_id` = '$tree_id' AND `member_id` IN
									 (SELECT `member_id` FROM `gen_members` WHERE `account_id` = '$account_id')");
		return (bool)count($arr);
	}
	
	// -----------------------------------------------------------------------
	public function is_admin($account_id, $tree_id)
	{
		
		//return 
	}
	
	// -----------------------------------------------------------------------
	// input: (int) $family_id, (int) $user_id
	// output: (bool)
	public function get_family($family_id = 0)
	{
		// check $family_id
		if($family_id == 0)
			$family_id = $this->family_id;
		
		if(!is_int($family_id))
			$family_id = (int)$family_id;
		if($family_id <= 0)
		{
			$this->set_error('family', 'Family ID is 0.');
			return false;
		}
		
		$arr = SQL_DB::sql_left_join(MYSQL_PRE."families", MYSQL_PRE."families_members", "`t1`.family_id = `t2`.family_id", "`t1`.`family_id` = '$family_id'");
		if(!isset($arr[0]))
		{
			$this->set_error('family', 'Family does not exist.');
			return false;
		}
		return $arr[0];
	}
	
	// -----------------------------------------------------------------------
	// input: (int) $member_id
	// output: (array) lista cu familiile din care face parte membrul
	public function get_member_families($member_id)
	{
		$array = array();
		
		$arr = SQL_DB::sql_select(MYSQL_PRE."families_members", "`Parent1` = '$member_id'");
		foreach($arr as $i => $r)
		{
			$r['side'] = 'p1';
			$array[] = $r;
		}
		
		$arr = SQL_DB::sql_select(MYSQL_PRE."families_members", "`Parent2` = '$member_id'");
		foreach($arr as $i => $r)
		{
			$r['side'] = 'p2';
			$array[] = $r;
		}
		
		$arr = SQL_DB::sql_select(MYSQL_PRE."families_members", "`Children` LIKE '%-$member_id-%'");
		foreach($arr as $i => $r)
		{
			$r['side'] = 'c';
			$array[] = $r;
		}
			
		
		return $array;
	}
	
	
	// -----------------------------------------------------------------------
	// input: (array) $insert
	// output: (int) $family_id
	public function family_insert($tree_id, $date)
	{
		if(!is_array($date))
		{
			$this->set_error('family', 'Set information for family.');
			return false;
		}
		
		if(!isset($date['name']))
		{
			$this->set_error('family', 'Set name for family.');
			return false;
		}
		
		if(!isset($date['type']))
			$date['type'] = 'public';
		
		// se creeaza o familie
		$this->family_id = parent::sql_insert(MYSQL_PRE.'families', array('name' => $date['name'], 'reg_family_id' => '0'));
		
		// se creeaza spatiul pentru membrii familiei
		parent::sql_insert(MYSQL_PRE.'families_members', array('family_id' => $this->family_id, 'tree_id' => $tree_id));
		
		
		if($this->acc_api)
		{
			// EXPORT REGISTER - se creaza o familie noua si in register
			$this->acc_api->set_field('l_families.name', $date['name']);
			$this->acc_api->set_field('l_families.type', $date['type']);
			if(!$this->acc_api->family_id = $this->acc_api->family_insert())
			{
				$this->acc_api->sql_rollback();
				return false;
			}
			
			// se stabileste legatura intre familia din Genealogy si cea din Register
			$this->set_reg_family_id($this->acc_api->family_id);
		}
		
		return $this->family_id;
	}
	
	
	// -----------------------------------------------------------------------
	// input: (array) $insert
	// output: (bool)
	public function family_delete($family_id)
	{
		// check $tree_id
		if(!is_int($this->tree_id))
			$this->tree_id = (int)$this->tree_id;
		if($this->tree_id <= 0)
		{
			$this->set_error('family', 'Tree ID is 0.');
			return false;
		}
		
		$family = $this->get_family($family_id);
		if($family)
		{
			if(!$this->acc_api->family_delete($family['reg_family_id']))
			{
				$this->set_error('family', 'External family could not be removed.');
				return false;
			}
		}
		
		
		if(parent::sql_delete(MYSQL_PRE.'families_members', "`family_id` = '$family_id'", 1))
		{
			// sterge fiecare alocare de membru la structura
			$this->user_tree_delete($family['Parent1'], $family['tree_id']);
			$this->user_tree_delete($family['Parent2'], $family['tree_id']);
			$children = Genealogy_model::childrenInArray($family['Children']);
			$children_string = NULL;
			foreach($children['array'] as $local_id)
			{
				$this->user_tree_delete($local_id, $family['tree_id']);
			}
			
			return parent::sql_delete(MYSQL_PRE.'families', "`family_id` = '$family_id'", 1);
		}
		else
			return false;
	}
	
	
	// -----------------------------------------------------------------------
	// input: (array) $insert
	// output: (bool)
	/*public function families_link_reorder($parent_family_id)
	{
		$arr = parent::sql_select(MYSQL_PRE.'families_link', "`parent_family_id` = '$parent_family_id'", "ORDER BY `order` ASC"));
		$c_order = 1;
		foreach($arr as $row)
			parent::sql_update(MYSQL_PRE.'families_link', array('order' => $c_order++), "`parent_family_id` = '$parent_family_id' AND `child_family_id` = '".$row['child_family_id']."'");
	}*/
	
	
	// -----------------------------------------------------------------------
	// input: (array) $insert
	// output: (bool)
	/*public function families_link_insert($parent_family_id, $child_family_id, $order = 'auto')
	{
		if($order == 'auto')
		{
			$last_link = parent::sql_select(MYSQL_PRE.'families_link', "`parent_family_id` = '$parent_family_id'", "ORDER BY `order` DESC", 0, 1));
			$count     = parent::sql_count(MYSQL_PRE.'families_link', "`parent_family_id` = '$parent_family_id'"));
			
			if($count != $last_link[1]['order'])
			{
				// reorder
				$this->families_link_reorder($parent_family_id);
				// select corect last order
				$last_link = parent::sql_select(MYSQL_PRE.'families_link', "`parent_family_id` = '$parent_family_id'", "ORDER BY `order` DESC", 0, 1));
			}
			
			$order = $last_link[1]['order']+1;
		}
		
		$this->fam_link_id = parent::sql_insert(MYSQL_PRE.'families_link', array('parent_family_id' => $parent_family_id, 'child_family_id' => $child_family_id, 'order' => $order));
		return (bool)$this->fam_link_id;
	}*/
	
	
	// -----------------------------------------------------------------------
	// input: (int) $account_id
	// output: (int) $member_id
	public function member_insert($account_id = 0, $data = array())
	{
		$member_id = parent::sql_insert(MYSQL_PRE.'members', array('account_id' => $account_id));
		if($member_id == 0)
			return false;
		
		// importa datele din REGISTER DB
		$import = array();
		if($account_id > 0)
		{
			$account = $this->acc_api->get_account($account_id);
			$import['firstname']	= (array_key_exists('firstname', $account)) ? $account['firstname'] : NULL;
			$import['lastname']		= (array_key_exists('lastname', $account)) ? $account['lastname'] : NULL;
			$import['born']			= (array_key_exists('birthday', $account)) ? $account['birthday'] : NULL;
		}
		
		// verificare data array
		$sets = array();
		$sets['member_id']  = $member_id;
		$sets['firstname']	= (array_key_exists('firstname', $data)) ? $data['firstname'] : (array_key_exists('firstname', $import)) ? $import['firstname'] : NULL;
		$sets['lastname']	= (array_key_exists('lastname', $data)) ? $data['lastname'] : (array_key_exists('lastname', $import)) ? $import['lastname'] : NULL;
		$sets['oldname']	= (array_key_exists('oldname', $data)) ? $data['oldname'] : (array_key_exists('oldname', $import)) ? $import['oldname'] : NULL;
		$sets['born']		= (array_key_exists('born', $data)) ? $data['born'] : (array_key_exists('born', $import)) ? $import['born'] : NULL;
		$sets['dead']		= (array_key_exists('dead', $data)) ? $data['dead'] : (array_key_exists('dead', $import)) ? $import['dead'] : NULL;
		$sets['alive']		= (array_key_exists('alive', $data)) ? $data['alive'] : (array_key_exists('alive', $import)) ? $import['alive'] : '1';
		
		$member_data_id = parent::sql_insert(MYSQL_PRE.'members_data', $sets);
		
		return $member_id;
	}
	
	// -----------------------------------------------------------------------
	// input: (int) $account_id
	// output: (int) $member_id
	public function tree_link_insert($a_tree_id, $a_family_id, $a_member_id, $b_tree_id, $b_family_id, $b_member_id)
	{		
		return parent::sql_insert(MYSQL_PRE.'trees_links', array('a_tree_id' => $a_tree_id, 'a_family_id' => $a_family_id, 'a_member_id' => $a_member_id, 'b_tree_id' => $b_tree_id, 'b_family_id' => $b_family_id, 'b_member_id' => $b_member_id));
	}
	
	
	// -----------------------------------------------------------------------
	// input: (int) $member_id
	// output: (bool)
	public function member_update($member_id, $account_id)
	{		
		return parent::sql_update(MYSQL_PRE.'members', array('account_id' => $account_id), "`member_id` = '$member_id'", 1);
	}
	
	
	// -----------------------------------------------------------------------
	// input: (int) $family_id, (int) $account_id
	// output: (bool)
	public function family_add_child($member_id)
	{
		// check $family_id
		if(!is_int($this->family_id))
			$family_id = (int)$this->family_id;
		if($this->family_id <= 0)
		{
			$this->set_error('family', 'Family ID is 0.');
			return false;
		}
		
		// get childen string
		$family = $this->get_family($this->family_id);
		if(!$family)
		{
			$this->set_error('family', 'Family does not exist.');
			return false;
		}
		
		// adauga legatura membrului cu arborele
		$this->member_tree_insert($member_id, $family['tree_id']);
		
		$childen_string = trim($family['Children'].',-'.$member_id.'-', ',');
		return parent::sql_update(MYSQL_PRE.'families_members', array('Children' => $childen_string), "`family_id` = '".$this->family_id."'", 1);
	}
	
	
	// -----------------------------------------------------------------------
	// input: (int) $user_id
	// output: (bool)
	public function family_del_child($family_id, $member_id)
	{
		$account_id = $this->member2account($member_id);
		$family     = $this->get_family($family_id);
		
		// verifica daca exista familia
		if(!$family)
		{
			$this->set_error('family', 'Family does not exist.');
			return false;
		}
		
		// sterge membrul din familia aflata in baza de date register
		if(isset($family['reg_family_id']))
		{
			if(!$this->acc_api->family_member_delete($family['reg_family_id'], $account_id))
			{
				$this->set_error('family', 'External family merber could not be removed.');
				return false;
			}
		}
		
		// seteaza account_id 0 pentru membrul curent
		$this->member_update($member_id, 0);
		
		// elimina membrul din copii familiei
		/*$children = Genealogy_model::childrenInArray($family['Children']);
		$children_string = NULL;
		foreach($children['array'] as $local_id)
		{
			if($local_id != $member_id)
			{
				if($children_string)
					$children_string .= ',';
				$children_string .= '-'.$local_id.'-';
			}
		}
		
		return parent::sql_update(MYSQL_PRE.'families_members', array('Children' => $childen_string), "`family_id` = '$family_id'", 1);*/
	}
	
	
	// -----------------------------------------------------------------------
	// input: (int) $pos, (int) $user_id
	// output: (bool)
	public function family_add_parent($pos, $member_id)
	{
		// check $pos
		if(!in_array($pos, array(1, 2)))
			return false;
		
		// check $family_id
		if(!is_int($this->family_id))
			$family_id = (int)$this->family_id;
		if($this->family_id <= 0)
		{
			$this->set_error('family', 'Family ID is 0.');
			return false;
		}
		
		// obtine informatii despre familie
		$family = $this->get_family($this->family_id);
		
		// adauga legatura membrului cu arborele
		$this->member_tree_insert($member_id, $family['tree_id']);
		
		return parent::sql_update(MYSQL_PRE.'families_members', array('Parent'.$pos => $member_id), "`family_id` = '".$this->family_id."'", 1);
	}
	
	
	
	// -----------------------------------------------------------------------
	// input: (int) $pos, (int) $user_id
	// output: (bool)
	public function family_del_parent($family_id, $member_id)
	{
		$account_id = $this->member2account($member_id);
		$family     = $this->get_family($family_id);
		
		// verifica daca exista familia
		if(!$family)
		{
			$this->set_error('family', 'Family does not exist.');
			return false;
		}
		
		// sterge membrul din familia aflata in baza de date register
		if(isset($family['reg_family_id']))
		{
			if(!$this->acc_api->family_member_delete($family['reg_family_id'], $account_id))
			{
				$this->set_error('family', 'External family merber could not be removed.');
				return false;
			}
		}
		
		// seteaza account_id 0 pentru membrul curent
		$this->member_update($member_id, 0);
		
		/*if(parent::sql_select(MYSQL_PRE.'families_members', "`family_id` = '".$this->family_id."' AND `Parent1` = '$user_id'"))
			$pos = 1;
		elseif(parent::sql_select(MYSQL_PRE.'families_members', "`family_id` = '".$this->family_id."' AND `Parent2` = '$user_id'"))
			$pos = 2;
		else
		{
			$this->set_error('family', 'User is not parent.');
			return false;
		}*/
		
		// sterge legatura membrului cu arborele
		//$this->user_tree_delete($user_id, $family['tree_id']);
		
		//return (parent::sql_update(MYSQL_PRE.'families_members', array('Parent'.$pos => 0), "`family_id` = '$family_id'", 1));
	}
	
	
	// -----------------------------------------------------------------------
	// input: (int) $member_id
	// output: (bool)
	// elimina un account_id dintr-un arbore insa lasa pastreaza legaturile intre membrii (pune account_id 0 la membrul curent)
	public function tree_clean_member($member_id)
	{
		$account_id = $this->member2account($member_id);
		$families   = $this->get_member_families($member_id);
		foreach($families as $fam)
		{
			// obtine informatii despre familie
			$family = $this->get_family($fam['family_id']);
			
			// sterge membrul din familia aflata in baza de date register
			if(isset($family['reg_family_id']))
			{
				if(!$this->acc_api->family_member_delete($family['reg_family_id'], $account_id))
				{
					$this->set_error('family', 'External family merber could not be removed.');
					return false;
				}
			}
		}
		
		// seteaza account_id 0 pentru membrul curent
		return $this->member_update($member_id, 0);
		
		/*if(parent::sql_select(MYSQL_PRE.'families_members', "`family_id` = '".$this->family_id."' AND `Parent1` = '$user_id'"))
			$pos = 1;
		elseif(parent::sql_select(MYSQL_PRE.'families_members', "`family_id` = '".$this->family_id."' AND `Parent2` = '$user_id'"))
			$pos = 2;
		else
		{
			$this->set_error('family', 'User is not parent.');
			return false;
		}*/
		
		// sterge legatura membrului cu arborele
		//$this->user_tree_delete($user_id, $family['tree_id']);
		
		//return (parent::sql_update(MYSQL_PRE.'families_members', array('Parent'.$pos => 0), "`family_id` = '$family_id'", 1));
	}
	
	
	// -----------------------------------------------------------------------
	// input: (string) $children_string -1-,-2,-,-3-,...-n-
	// output: (array) array('count' => n, 'array' => array(1, 2, 3,..., n))
	static function childrenInArray($children_string)
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
	
	
	// -----------------------------------------------------------------------
	public function set_error($key, $value)
	{
		$this->errors[$key] = $value;
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */
?>