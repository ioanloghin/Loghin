<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Tree extends Controllers
{
	// -----------------------------------------------------------------------------
	public function __construct()
	{
		
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function approvals()
	{
		global $MyUser;
		$approval_id	= (defined('arg1')) ? arg1 : 0;
		$option			= (defined('arg2')) ? arg2 : '';
		
		
		$this->load_library('Tree');
		
		if($option == 'accept')
		{
			$approval = new Approval($approval_id);
			$approval->delete();
			redirect(anchor("tree", "approvals"));
		}
		
		$this->load_view('templates/harmony/head', array('title' => 'Avize pentru arbori'));
		$this->load_view('templates/harmony/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_approvals', array('approval_id' => $approval_id));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function create()
	{
		global $MyUser, $acc_api, $gen;
		
		$this->load_model('CreateTree');
		$cTree = new CreateTree();
		
		if(!isset($_SESSION[SESSION]['cTree']['step']))
			$_SESSION[SESSION]['cTree']['step'] = 1;
		
		// preluam in siguranta valorile trimise prin POST
		$POST = new form_data('cTree');
		if(!$MyUser->logged())
		{
			$POST->set_var('username', 'Utilizator', NULL, 'trim', 'required|valid_username');
			$POST->set_var('email', 'Email', NULL, 'trim', 'required|valid_email');
			$POST->set_var('password', 'Parola', NULL, 'trim', 'required');
			$POST->set_var('re_password', 'Confirma parola', NULL, 'trim', 'matches[password]');
		}
		
		$POST->set_var('family_name', 'Family Name', NULL, 'trim', '');
		$POST->set_var('firstname', 'First Name', NULL, 'trim', '');
		$POST->set_var('lastname', 'Last Name', NULL, 'trim', '');
		$POST->set_var('type', 'Profile Type', NULL, 'trim', '');
		
		$params = array();
		
		if(isset($_POST['register']))
		{
			if($POST->check_antirefresh())// verifica daca s-a dat refresh dupa inregistrare
			{
				// verifica daca sunt corecte informatiile trimise
				$POST->validation();
				
				if(!$POST->errors())// daca nu sunt probleme
				{
					if(!$MyUser->logged())
					{
						// se creaza account-ul
						$acc_api->set_field('l_accounts.loghin_id', $POST->get_var('username'));
						$acc_api->set_field('l_accounts.email',     $POST->get_var('email'));
						$acc_api->set_field('l_accounts.password',  Hash::make($POST->get_var('password')));
						$acc_api->set_field('l_accounts.firstname', $POST->get_var('firstname'));
						$acc_api->set_field('l_accounts.lastname',  $POST->get_var('lastname'));
						
						if(!$acc_api->valid() || !$acc_api->account_insert())
						{
							$POST->set_error('system', "Account-ul nu a putut fi creat.");
						}
						
						// set admin_id
						$admin_account_id  = $acc_api->get_account_id($POST->get_var('username'));
						$acc_api->owner_id = $acc_api->get_account_id($POST->get_var('username'));
					}
					else
					{
						// set admin_id
						$admin_account_id  = $MyUser->account_id();
						$acc_api->owner_id = $MyUser->account_id();
					}
					
					if(!$POST->errors() && $admin_account_id > 0)
					{
						// ---------------
						$p_config = array(
							'tree_id' 			=> 0,
							'family_id' 		=> 0,
							'rel_id' 			=> 1,
							'direction'			=> 'desc',
							'link_member_id'	=> 0,
						);
						// ---------------
						if(!$gen->regMemberCompletelyInsert($admin_account_id, $p_config))
							$POST->set_error('system', $gen->errors_str());
					}
					
					if(!$POST->errors())
					{
						// inregistrarea s-a realizat cu success
						$POST->set_successful(1);
					}
				}
			}
			else
				// inregistrarea s-a realizat cu success si utilizatorul a dat refresh
				$POST->set_successful(2);
		}
		
		if(isset($_POST['next1']))
		{
			
			$_SESSION[SESSION]['cTree']['step'] = 2;
			$POST->copy_in_sess();
		}

		$infoUser = array('fullname' => '&nbsp;', 'age' => '', 'city' => '', 'country' => '', 'image' => '');
		
		$this->load_view('templates/harmony/head', array('title' => 'Organigrama'));
		$this->load_view('tree/head_end_create');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_create', array('cTree' => $cTree, 'POST' => $POST, 'infoUser' => $infoUser, 'params' => $params));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function insert()
	{
		global $MyUser, $acc_api, $gen;
		
		$tree_id		= (defined('arg1')) ? arg1 : 0;
		$family_id		= (defined('arg2')) ? arg2 : 0;
		$member_id		= (defined('arg3')) ? arg3 : 0;
		$rel_id			= (defined('arg4')) ? arg4 : 0;
		$link_member_id	= (defined('arg5')) ? arg5 : 0;
		$direction		= (defined('arg6')) ? arg6 : '';
		
		$params = array('tree_id' => $tree_id, 'family_id' => $family_id, 'member_id' => $member_id, 'rel_id' => $rel_id, 'link_member_id' => $link_member_id, 'direction' => $direction);
		
		$this->load_model('CreateTree');
		$cTree = new CreateTree();
		
		if(!isset($_SESSION[SESSION]['cTree']['step']))
			$_SESSION[SESSION]['cTree']['step'] = 1;
		
		// preluam in siguranta valorile trimise prin POST
		$POST = new form_data('cTree');
		
		$POST->set_var('loghin_id', 'Loghin User Name', NULL, 'trim', 'valid_username');
		if($POST->get_var('loghin_id') == NULL)
		{
			$POST->set_var('username', 'User Name', NULL, 'trim', 'required|valid_username');
			$POST->set_var('firstname', 'First Name', NULL, 'trim', 'required');
			$POST->set_var('lastname', 'Last Name', NULL, 'trim', 'required');
			$POST->set_var('gender', 'Gender', NULL, 'trim', '');
			$POST->set_var('born_d', 'born_d', NULL, 'trim', '');
			$POST->set_var('born_m', 'born_m', NULL, 'trim', '');
			$POST->set_var('born_y', 'born_y', NULL, 'trim', '');
			
			$birthday = ($POST->get_var('born_y')) ? $POST->get_var('born_y') : '0000';
			$birthday .= '-'.($POST->get_var('born_m')) ? $POST->get_var('born_m') : '00';
			$birthday .= '-'.($POST->get_var('born_d')) ? $POST->get_var('born_d') : '00';
		}
		
		if(isset($_POST['add']))
		{
			if($POST->check_antirefresh())// verifica daca s-a dat refresh dupa inregistrare
			{
				// verifica daca sunt corecte informatiile trimise
				$POST->validation();
				
				if(!$POST->errors())// daca nu sunt probleme
				{
					// start transactions
					//$acc_api->sql_start();
					//$gen->sql_start();
					
					// setting up genealogy model
					$gen->admin_id		= $MyUser->account_id();
					$gen->tree_id		= $tree_id;
					$gen->family_id		= $family_id;
					$gen->member_id		= $member_id;
					$gen->rel_id		= $rel_id;
					$gen->link_member_id= $link_member_id;
					$gen->direction		= $direction;
					
					$new_account = array();
					
					// se creaza account-ul sau se importa
					if($POST->get_var('loghin_id') != NULL)
					{
						// verifica daca utilizatorul introdus exista in baza de date
						if(!$acc_api->username_exists($POST->get_var('loghin_id')))
						{
							$acc_api->sql_rollback();
							$POST->set_error('system', "Loghin User Name nu a putut fi gasit.");
						}
						
						if(!$POST->errors())
							// set new user id
							$new_account = $acc_api->get_account_u($POST->get_var('loghin_id'));
						
						// verificam daca exista in arborele curent
						// previne inregistrarea dublurilor
						if($gen->in_tree($new_account['account_id'], $tree_id))
						{
							$acc_api->sql_rollback();
							$POST->set_error('system', "Acest account exista in arborele curent.");
						}
					}
					else
					{
						// se creaza account-ul
						$acc_api->set_field('l_accounts.loghin_id', $POST->get_var('username'));
						$acc_api->set_field('l_accounts.email',     NULL);
						$acc_api->set_field('l_accounts.password',  NULL);
						$acc_api->set_field('l_accounts.firstname', $POST->get_var('firstname'));
						$acc_api->set_field('l_accounts.lastname',  $POST->get_var('lastname'));
						$acc_api->set_field('l_accounts.birthday',  $birthday);
						
						if($acc_api->username_exists() || !$acc_api->account_insert(array(), $MyUser->account_id())/* adauga un account secundar */)
						{
							$acc_api->sql_rollback();
							$gen->sql_rollback();
							$POST->set_error('system', "Account-ul nu a putut fi creat.");
						}
						else
						{
							// set new user id
							$new_account['account_id']	= $acc_api->get_account_id($POST->get_var('username'));
							$new_account['firstname']	= $POST->get_var('firstname');
							$new_account['lastname']	= $POST->get_var('lastname');
							$new_account['birthday']	= $birthday;
						}
					}
					
					
					if(!$POST->errors() && $new_account['account_id'] > 0)
					{
						// ---------------
						$p_config = array(
							'tree_id' 			=> $tree_id,
							'family_id' 		=> $family_id,
							'rel_id' 			=> $rel_id,
							'direction'			=> $direction,
							'link_member_id'	=> $link_member_id,
						);
						// ---------------
						if(!$gen->regMemberCompletelyInsert($new_account['account_id'], $p_config))
							$POST->set_error('system', $gen->errors_str());
					}
					
					if(!$POST->errors())
					{
						// inregistrarea s-a realizat cu success
						$POST->set_successful(1);
					}
				}
			}
			else
				// inregistrarea s-a realizat cu success si utilizatorul a dat refresh
				$POST->set_successful(2);
		}
		
		if(isset($_POST['next1']))
		{
			
			$_SESSION[SESSION]['cTree']['step'] = 2;
			$POST->copy_in_sess();
		}
		
		$infoUser = array('fullname' => '&nbsp;', 'age' => '', 'city' => '', 'country' => '', 'image' => '');
		
		$this->load_view('templates/harmony/head', array('title' => 'Genealogy Insert member'));
		$this->load_view('tree/head_end_create');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_insert', array('cTree' => $cTree, 'POST' => $POST, 'infoUser' => $infoUser, 'gen' => $gen, 'params' => $params));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function delete()
	{
		global $MyUser, $acc_api, $gen;
		
		$tree_id		= (defined('arg1')) ? arg1 : 0;
		$family_id		= (defined('arg2')) ? arg2 : 0;
		$member_id		= (defined('arg3')) ? arg3 : 0;
		$params = array('tree_id' => $tree_id, 'family_id' => $family_id, 'member_id' => $member_id);
		
		$this->load_model('CreateTree');
		$cTree = new CreateTree();
		
		if(!isset($_SESSION[SESSION]['cTree']['step']))
			$_SESSION[SESSION]['cTree']['step'] = 1;
		
		// preluam in siguranta valorile trimise prin POST
		$POST = new form_data('cTree');
		$POST->set_var('system', 'System', NULL, '', '');
		
		if(isset($_POST['del']))
		{
			if($POST->check_antirefresh())// verifica daca s-a dat refresh dupa inregistrare
			{
				// verifica daca sunt corecte informatiile trimise
				$POST->validation();
				
				if(!$POST->errors())// daca nu sunt probleme
				{
					// start transactions
					$acc_api->sql_start();
					$gen->sql_start();
					
					if(!$gen->tree_clean_member($member_id))
					{
						$acc_api->sql_rollback();
						$gen->sql_rollback();
						$POST->set_error('system', "Membrul nu a putut fi elimitat din familie.");
					}
					
					if(!$POST->errors())
					{
						$acc_api->sql_commit();
						$gen->sql_commit();
						// inregistrarea s-a realizat cu success
						$POST->set_successful(1);
					}
				}
			}
			else
				// inregistrarea s-a realizat cu success si utilizatorul a dat refresh
				$POST->set_successful(2);
		}
		
		if(isset($_POST['next1']))
		{
			
			$_SESSION[SESSION]['cTree']['step'] = 2;
			$POST->copy_in_sess();
		}
		
		$infoUser = array('fullname' => '&nbsp;', 'age' => '', 'city' => '', 'country' => '', 'image' => '');
		
		$this->load_view('templates/harmony/head', array('title' => 'Genealogy Delete member'));
		$this->load_view('tree/head_end_create');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_delete', array('cTree' => $cTree, 'POST' => $POST, 'infoUser' => $infoUser, 'gen' => $gen, 'acc_api' => $acc_api, 'params' => $params));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function graph()
	{
		global $MyUser, $gen;
		
		$AGmyIDTree		= (defined('arg1')) ? arg1 : 0;
		$AGmyIDUser		= (defined('arg2')) ? arg2 : 0;
		$AGmyDirection  = (defined('arg3')) ? arg3 : 0;
		$AGmyIDFamily	= (defined('arg4')) ? arg4 : 0;
		$AGmyIDRel		= 0;
		
		$account_id     = $AGmyIDUser;
		$family_id      = $AGmyIDFamily;
		
		if($account_id)
		{
			$this->load_library('Tree');
			
			$AGmyIDUser   = (!$AGmyIDUser) ? AG_Operation::myDefaultUser($AGmyIDTree) : $AGmyIDUser;
			$AGmyIDFamily = (!$AGmyIDFamily) ? AG_Operation::myFamily($AGmyIDUser, $AGmyIDTree, $AGmyDirection) : $AGmyIDFamily;
			$AGmyIDRel    = (!$AGmyIDRel) ? AG_Operation::myRel($AGmyIDFamily, $AGmyIDUser) : $AGmyIDRel;
			
			$AGmyPreview = (isset($_GET['preview'])) ? TRUE :  FALSE;
			$tree_admin  = AG_Operation::tree_get_admin($AGmyIDTree);
			$AGmyAdmin   = TRUE;
			
			if(!isset($_SESSION[SESSION]['AGmyView'][$AGmyIDTree]))
			{
				$_SESSION[SESSION]['AGmyView'][$AGmyIDTree] = array(
					'asc' => array(),
					'desc' => array(),
				);
			}
			if(isset($_GET['tree_asc']))
			{
				$tree_asc = $_GET['tree_asc'];
				$_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['asc'] = array();
				if($tree_asc)
				{
					$exp = explode(',', $tree_asc);
					foreach($exp as $id_fam)
					{
						if($id_fam)
							$_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['asc'] = intval($id_fam);
					}
				}
			}
			if(isset($_GET['tree_desc']))
			{
				$tree_desc = $_GET['tree_desc'];
				$_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['desc'] = array();
				if($tree_desc)
				{
					$exp = explode(',', $tree_desc);
					foreach($exp as $id_fam)
					{
						if($id_fam)
							$_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['desc'] = intval($id_fam);
					}
				}
			}
			// includem configurarile ------------------------------------------------------------------------------------------------ //
			$AG_print_coordonate = false;
			// ----------------------------------------------------------------------------------------------------------------------- //
			$pageContent = NULL;
			$pageStyle   = NULL;
			
			$db_array = array();
			$db_array['families'] = array();
			$db_array['users'] = array();
			
			$vector = array();
			$vector['families'] = array();// lista cu obiecte de tip AG_FamilyBox
			
			if(DIRECT_MODE)
				$db_array['families'] = $gen->compatibility_generate_tree_families($account_id, $family_id);
			else
			{
				$results = SQL_DB::sql_querry("SELECT fam.*, fam_info.*
											  FROM `".DBT_FAM."` AS fam
											  LEFT JOIN `".DBT_FAM_INFO."` AS fam_info
											  ON fam.".DBT_FAM_C1." = fam_info.".DBT_FAM_INFO_C1."
											  WHERE fam.".DBT_FAM_C1." = '$AGmyIDFamily'
											  LIMIT 0,1");
				while($row = mysql_fetch_array($results, MYSQL_ASSOC))
					$db_array['families'][0] = $row;
				unset($results);
			}
			
			if(isset($db_array['families'][0]))
			{
				if(DIRECT_MODE)
				{
					$AGmyIDFamily = $db_array['families'][0]['family_id'];
				}
				else
				{
					$db_array_family = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C2."` = '$AGmyIDTree' AND `".DBT_FAM_C1."` != '$AGmyIDFamily'");
					foreach($db_array_family as $row)
						$db_array['families'][] = $row;
					unset($db_array_family);
				}
				
				
				foreach($db_array['families'] as $key => $familyInfo)
				{
					$this_fam_obj = new AG_FamilyBox();
					$this_fam_obj->setInfo($familyInfo);
					
					// #1 start Se creaza obiecte pentru fiecare membru al familiei ------------------------------
					$members_ref = array();
					// DBT_FAM_C6 = 'id_tata' -------------------------------------
					$local_id_user = $familyInfo['Parent1'];
					
					if($local_id_user > 0)
						$members_ref[1] = new AG_UserBox($local_id_user, 1);
					elseif($AGmyAdmin)
						$members_ref[1] = new AG_UserBox(0, 3);
					else
						$members_ref[1] = new AG_UserBox(0, 2);
					
					$members_ref[1]->setInternalRelation(1);
					//
					// DBT_FAM_C7 = 'id_mama' -------------------------------------
					$local_id_user = $familyInfo['Parent2'];
					
					if($local_id_user > 0)
						$members_ref[2] = new AG_UserBox($local_id_user, 1);
					elseif($AGmyAdmin)
						$members_ref[2] = new AG_UserBox(0, 3);
					else
						$members_ref[2] = new AG_UserBox(0, 2);
					
					$members_ref[2]->setInternalRelation(2);
					//
					// DBT_FAM_C8 = 'id_copii' -------------------------------------
					$members_ref[3] = array();
					$familyInfo['count_copii'] = 0;
					if($familyInfo['Children'])
					{
						$exp = explode(',', $familyInfo['Children']);
						$familyInfo['count_copii'] = count($exp);
						if($familyInfo['count_copii'] > 1)
						{
							foreach($exp as $exp_key => $local_id_user)
							{
								$local_id_user = (int)trim($local_id_user, '-');
								$this_obj = new AG_UserBox($local_id_user, 1);
								$this_obj->setInternalRelation(3, $exp_key);
								$members_ref[3][] = $this_obj;
							}
						}
						else
						{
							$local_id_user = (int)trim($familyInfo['Children'], '-');
							if($local_id_user)
							{
								$familyInfo['count_copii'] = 1;
								$this_obj = new AG_UserBox($local_id_user, 1);
								$this_obj->setInternalRelation(3);
								$members_ref[3][] = $this_obj;
							}
							else
								$familyInfo['count_copii'] = 0;
						}
					}
					
					// ii adaugam un copil sablon
					if($AGmyAdmin)
					{
						$this_obj = new AG_UserBox(0, 3);
						$this_obj->setInternalRelation(3, count($members_ref[3]));
						
						$members_ref[3][] = $this_obj;
						$familyInfo['count_copii']++;
					}
					// #1 end ------------------------------------------------------------------------------------
					//
					// se creaza obiectul familiei
					// DBT_FAM_C1 = 'family_id'
					$this_fam_obj->setMembers($members_ref);
					// se cere calcularea coordonatelor membrilor
					$this_fam_obj->calculateMembersCoord();
					// se introduce obiectul in vector
					$vector['families'][] = $this_fam_obj;
					unset($members_ref);
				}
				$arrayFamilyObj = array();
				foreach($vector['families'] as $key => $family_obj)
				{
					$this_family_id = (int)$family_obj->info['family_id'];
					$arrayFamilyObj[$this_family_id] = $family_obj;
				}
				unset($vector['families']);
				
				// 
				if(DIRECT_MODE)
					$dbFamilyArray = $gen->compatibility_dbFamilyArray($AGmyIDFamily, 0);
				else
					$dbFamilyArray = AG_Operation::dbFamilyArray($AGmyIDTree, $AGmyIDFamily, 0, $db_array['families']);
				
				// eliminam familiile care au avize
				$gen->compatibility_elimitate_nonapproval_families($dbFamilyArray);
				
				//print '<pre>'; var_export($db_array['families']); exit;
				//print '<pre>'; var_export($dbFamilyArray); exit;
				$familiesPosition = AG_Operation::familiesPosition($dbFamilyArray, $AGmyIDFamily);
				
				
				
				$familyArrayChildren = $dbFamilyArray['familyArrayChildren'];
				$familyArrayParents = $dbFamilyArray['familyArrayParents'];
				$familyKeys = array();
				//
				//
				// start SETAM identifier, ids, recognition --------------------------------------------------------- //
				foreach($arrayFamilyObj as $this_family_id => $family_obj)
				{
					$familyKeys[$this_family_id] = $key;
					if(isset($familiesPosition[$this_family_id]))
					{
						$this_identifier = $familiesPosition[$this_family_id]['identifier'];
						$this_ids = $familiesPosition[$this_family_id]['ids'];
						$this_recognition = $familiesPosition[$this_family_id]['recognition'];
						$family_obj->setPosition($this_identifier, $this_ids, $this_recognition);
					}
				}
				// end ---------------------------------------------------------------------------------------------------- //
				//
				//
				// start SE STABILESTE ORDONEA FAMILIILOR IN ARRAY -------------------------------------------------------- //
				$new_order = array();
				$order_types = array(1, 2, 3, 4, 5);
				$restart = false;
				$curent_grade = 1;
				$preparing = array();
				foreach($arrayFamilyObj as $this_family_id => $family_obj)
					$preparing[$family_obj->recognition['type']][$this_family_id] = $family_obj->recognition['grade'];
				
				foreach($preparing as $family_type => $family_details)
					asort($preparing[$family_type]);// sortam familiile fiecarui tip dupa grad
				ksort($preparing);// sortam tipurile familiilor
				foreach($preparing as $family_type => $family_details)
				{
					foreach($family_details as $this_family_id => $this_family_grade)
						$new_order[$this_family_id] = $arrayFamilyObj[$this_family_id];
				}
				unset($arrayFamilyObj);
				$arrayFamilyObj = array();
				$arrayFamilyObj = $new_order;
				unset($new_order);
				// end ---------------------------------------------------------------------------------------------------- //
				//
				//
				//print '<pre>'; var_export($arrayFamilyObj); exit;
				$familyArrayIdentif = NULL;
				foreach($arrayFamilyObj as $this_family_id => $family_obj)
					$familyArrayIdentif[$family_obj->info[DBT_FAM_C1]] = $family_obj->identifier['this'];
				//print '<pre>'; var_export($vector['families']); exit;
				
				$arrayMembersCoord = array();
				$arrayFamilyDimension = array();
				$arrayMembersHover = array();
				$AGPlanW = 0;
				$AGPlanH = 0;
				$temp_array_tip1 = array();
				$temp_array_tip2 = array();
				$temp_array_tip3 = array();
				$temp_array_tip5 = array();
				$topSpaceFor5 = 0;
				$topMinus = 500;// margin top minus
				foreach($arrayFamilyObj as $this_family_id => $family_obj)
				{
					$local_members = $family_obj->members_ref;
					if(isset($familiesPosition[$this_family_id]))
					{
						//
						// verificam pentru fiecare user ce ascendenti si ce descendenti are
						$family_obj->setAscDescMembers($familyArrayChildren, $familyArrayParents, $familyArrayIdentif, $arrayFamilyObj);
						//
						// calculam pozitia membrilor
						$family_obj->calculateMembersCoord();
					}
				}
				//print '<pre>'; var_export($arrayFamilyObj[2]->members_ref); exit;
				foreach($arrayFamilyObj as $this_family_id => $family_obj)
				{
					$local_members = $family_obj->members_ref;
					
					if($family_obj->members_ref[1])
					{
						$arrayMembersCoord[$this_family_id][$family_obj->members_ref[1]->member_id()] = array($family_obj->members_ref[1]->posX, $family_obj->members_ref[1]->posY);
						if($family_obj->members_ref[1]->box_type == 1 || $family_obj->members_ref[1]->box_type == 4)
							$arrayMembersHover[$family_obj->members_ref[1]->member_id().'p'] = array('marginLeft' => $family_obj->members_ref[1]->marginLeft);
						// inmagazinam datele despre familia in care se afla userul
						/*$family_obj->members_ref[1]->thisFamily['type'] = $family_obj->recognition['type'];
						$family_obj->members_ref[1]->thisFamily['align'] = $family_obj->recognition['align'];
						$family_obj->members_ref[1]->thisFamily['grade'] = $family_obj->recognition['grade'];*/
					}
					
					if($family_obj->members_ref[2])
					{
						$arrayMembersCoord[$this_family_id][$family_obj->members_ref[2]->member_id()] = array($family_obj->members_ref[2]->posX, $family_obj->members_ref[2]->posY);
						if($family_obj->members_ref[2]->box_type == 1 || $family_obj->members_ref[2]->box_type == 4)
							$arrayMembersHover[$family_obj->members_ref[2]->member_id().'p'] = array('marginLeft' => $family_obj->members_ref[2]->marginLeft);
						// inmagazinam datele despre familia in care se afla userul
						/*$family_obj->members_ref[2]->thisFamily['type'] = $family_obj->recognition['type'];
						$family_obj->members_ref[2]->thisFamily['align'] = $family_obj->recognition['align'];
						$family_obj->members_ref[2]->thisFamily['grade'] = $family_obj->recognition['grade'];*/
					}
					
					foreach($family_obj->members_ref[3] as $key => $userbox)
					{
						$arrayMembersCoord[$this_family_id][$userbox->member_id()] = array($userbox->posX, $userbox->posY);
						if($userbox->box_type == 1 || $userbox->box_type == 4)
						{
							//if(!isset($arrayMembersHover[$userbox->member_id()]))
								$arrayMembersHover[$userbox->member_id().'c'] = array('marginLeft' => $userbox->marginLeft);
						}
						// inmagazinam datele despre familia in care se afla userul
						/*$userbox->thisFamily['type'] = $family_obj->recognition['type'];
						$userbox->thisFamily['align'] = $family_obj->recognition['align'];
						$userbox->thisFamily['grade'] = $family_obj->recognition['grade'];*/
					}
					
					$arrayFamilyDimension[$this_family_id] = array($family_obj->width, $family_obj->height);
					// dimensiunile planului
					switch($family_obj->recognition['type'])
					{
						case 1:
							if(!count($temp_array_tip1))
							{
								$AGPlanH += $family_obj->height;
								$AGPlanH += 4; // margine bottom
								$temp_array_tip1[] = true;
								//print '[1] += '.$family_obj->height.'<br />';
							}
							break;
						case 2:
							if(!count($temp_array_tip2))
							{
								$AGPlanH += $family_obj->height;
								$AGPlanH += 4; // margine bottom
								$temp_array_tip2[] = true;
								//print '[2] += '.$family_obj->height.'<br />';
							}
							break;
						case 3:
							if(!in_array($family_obj->recognition['grade'], $temp_array_tip3))
							{
								$AGPlanH += $family_obj->height;
								$AGPlanH += 4; // margine bottom
								$temp_array_tip3[] = $family_obj->recognition['grade'];
								//print '[3{'.$family_obj->recognition['grade'].'}] += '.$family_obj->height.'<br />';
							}
							break;
						case 4:
							//$AGPlanH += $family_obj->height;
							break;
						case 5:
							if(!in_array($family_obj->recognition['grade'], $temp_array_tip5))
							{
								$AGPlanH += $family_obj->height;
								$AGPlanH += 4; // margine bottom
								$temp_array_tip5[] = $family_obj->recognition['grade'];
								//print '[5{'.$family_obj->recognition['grade'].'}] += '.$family_obj->height.'<br />';
								$topSpaceFor5 += AGFORMAT_T5_H;// margin top (pentru familile de tip ascendenti)
								
								$topMinus += AGFORMAT_T5_H;
							}
							// crestem marginea de sus prin scaderea lui $topMinus
							foreach($_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['asc'] as $local_identif)
							{
								/*if($family_obj->identifier['this'] == $local_identif)
									$topMinus -= AGFORMAT_T5_H;*/
							}
							break;
					}
				}
				// pentru modul de administrare
				if($AGmyAdmin)
				{
					// adaugam spatiu pentru o familie sablon descendenta
					// familia sablon poate fi de tip 2 sau 3
					// verificam tipul
					if(count($temp_array_tip3))// pentru tip 3
					{
						$AGPlanH += AGFORMAT_T3_UBH + ((AGFORMAT_T3_P1_Y >= AGFORMAT_T3_P2_Y) ? AGFORMAT_T3_P1_Y : AGFORMAT_T3_P2_Y);
						$AGPlanH += 4; // margine bottom
					}
					else// pentru tip 2
					{
						$AGPlanH += AGFORMAT_T2_UBH + ((AGFORMAT_T2_P1_Y >= AGFORMAT_T2_P2_Y) ? AGFORMAT_T2_P1_Y : AGFORMAT_T2_P2_Y);
						$AGPlanH += 4; // margine bottom
					}
				}
				// plan - margin bottom
				$AGPlanH += 1000;
				//
				// setam margin pentru familia aflata in prim plan
				$AGPlanW = 2000; // TODO:de calculat automat latimea planului
				$this_family_width = $arrayFamilyDimension[$AGmyIDFamily][0];
				$arrayFamilyObj[$AGmyIDFamily]->marginLeft = ceil(($AGPlanW - $this_family_width)/2);
				$arrayFamilyObj[$AGmyIDFamily]->marginTop = $topSpaceFor5+510;// padding top
				unset($arrayFamilyDimension);
				//
				//
				//
				// preluam ex relatiile
				$exRelatiiDB = array();
				if($arrayFamilyObj[$AGmyIDFamily]->members_ref[1]->member_id() > 0)
					$exRelatiiDB[1] = AG_Operation::getExRelatii($AGmyIDTree, $arrayFamilyObj[$AGmyIDFamily]->members_ref[1]->member_id());
				else
					$exRelatiiDB[1] = array();
				
				if($arrayFamilyObj[$AGmyIDFamily]->members_ref[2]->member_id() > 0)
					$exRelatiiDB[2] = AG_Operation::getExRelatii($AGmyIDTree, $arrayFamilyObj[$AGmyIDFamily]->members_ref[2]->member_id());
				else
					$exRelatiiDB[2] = array();
				
				$exRelatiiObj = array();
				$exRelatiiObj[1] = array();
				$exRelatiiObj[2] = array();
				foreach($exRelatiiDB[1] as $key => $familyInfo)
				{
					$this_fam_obj = new AG_FamilyBox();
					$this_fam_obj->setInfo($familyInfo);
					// #1 start Se creaza obiecte pentru fiecare membru al familiei ------------------------------
					$members_ref = array();
					//
					// DBT_FAM_C6 // 'id_parinte1' --------------------------
					$members_ref[1] = NULL;
					//
					// DBT_FAM_C7 // 'id_parinte2' --------------------------
					$local_id_user = $familyInfo[DBT_FAM_C7];
					
					if($local_id_user > 0)
						$this_obj = new AG_UserBox($local_id_user, 1);
					elseif($AGmyAdmin)
					{
						$this_obj = new AG_UserBox(0, 3);
						$this_obj->ascFamily['id'] = $AGmyIDFamily;
						$this_obj->ascFamily['identifier'] = '0';
					}
					else
					{
						$this_obj = new AG_UserBox(0, 2);
						$this_obj->ascFamily['id'] = $AGmyIDFamily;
						$this_obj->ascFamily['identifier'] = '0';
					}
					
					$this_obj->setInternalRelation(2);
					$members_ref[2] = $this_obj;
					//
					// DBT_FAM_C8 // 'id_copii' -----------------------------
					$members_ref[3] = array();
					$familyInfo['count_copii'] = 0;
					if($familyInfo[DBT_FAM_C8])
					{
						$exp = explode(',', $familyInfo[DBT_FAM_C8]);
						$familyInfo['count_copii'] = count($exp);
						if($familyInfo['count_copii'] > 1)
						{
							foreach($exp as $exp_key => $local_id_user)
							{
								$local_id_user = intval(str_replace('-', '', $local_id_user));
								$this_obj = new AG_UserBox($local_id_user, 1);
								$this_obj->setInternalRelation(3, $exp_key);
								$members_ref[3][] = $this_obj;
							}
						}
						else
						{
							$local_id_user = intval(str_replace('-', '', $familyInfo[DBT_FAM_C8]));
							if($local_id_user)
							{
								$familyInfo['count_copii'] = 1;
								$this_obj = new AG_UserBox($local_id_user, 1);
								$this_obj->setInternalRelation(3);
								$members_ref[3][] = $this_obj;
							}
							else
								$familyInfo['count_copii'] = 0;
						}
					}
					
					// adaugam un copil sablon daca este pe modul administrare
					if($AGmyAdmin)
					{
						$this_obj = new AG_UserBox(0, 3);
						$this_obj->setInternalRelation(3, count($members_ref[3]));
						$this_obj->ascFamily['id'] = $AGmyIDFamily;
						$this_obj->ascFamily['identifier'] = '0';
								
						$members_ref[3][] = $this_obj;
						$familyInfo['count_copii']++;
					}
					// #1 end ------------------------------------------------------------------------------------
					//
					// se creaza obiectul familiei
					// DBT_FAM_C1 = 'family_id'
					$this_fam_obj->setMembers($members_ref);
					// setam tipul familiei
					$this_identifier = array('this' => 'EX1'.(count($exRelatiiObj[1])+1), 'asc' => '0', 'desc' => array(1 => NULL, 2 => NULL));
					$this_ids = array('this' => $familyInfo[DBT_FAM_C1], 'asc' => $AGmyIDFamily, 'desc' => array(1 => 0, 2 => 0));
					$this_recognition = array('type' => 4, 'align' => 1, 'grade' => count($exRelatiiObj[1])+1);
					$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
					// verificam pentru fiecare user ce ascendenti si ce descendenti are
					$this_fam_obj->setAscDescMembers($familyArrayChildren, $familyArrayParents, $familyArrayIdentif, $arrayFamilyObj);
					// se cere calcularea coordonatelor membrilor
					$this_fam_obj->calculateMembersCoord();
					// setam conexiunile dintre famili
					$conectToIdFamily = $AGmyIDFamily;
					$conectToIdUser = $arrayFamilyObj[$AGmyIDFamily]->members_ref[1]->member_id();
					if($conectToIdFamily && $conectToIdUser)
						$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
					
					//print '<pre>'; var_export($this_fam_obj); exit;
					// calculam pozitia familiei
					$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
					// exRelatii
					$this_fam_obj->exRelatii = count($exRelatiiDB[1]);
					$this_fam_obj->exRelatieActiva = $key;
					// se introduce obiectul in vector
					$exRelatiiObj[1][$familyInfo[DBT_FAM_C1]] = $this_fam_obj;
					unset($members_ref);
					// introducem ex relatia la butoane
					$arrayFamilyObj[$AGmyIDFamily]->exRelatiiButtons[1][] = $familyInfo[DBT_FAM_C1];
				}
				// pentru modul administrare (daca nr de ex relatii este < 5 se va adauga o ex relatie de tip sablon)
				// verificam (1) sa fie modul administrare activat, (2) ex realtiele sa nu depaseasca numarul de 5, (3) id userul caruia vrei sa-i adaugam o ex realtie sa nu fie 0
				$cnt = count($exRelatiiObj[1]);
				if($AGmyAdmin && ($cnt < 6) && $arrayFamilyObj[$AGmyIDFamily]->members_ref[1]->member_id())
				{
					$this_fam_obj = new AG_FamilyBox();
					$familyInfo = array(DBT_FAM_C1 => 0);
					$this_fam_obj->setInfo($familyInfo);
					// #1 start Se creaza obiecte pentru fiecare membru al familiei ------------------------------
					$members_ref = array();
					
					$this_obj = new AG_UserBox(0, 3);
					$this_obj->setInternalRelation(2);
					$this_obj->ascFamily['id'] = $AGmyIDFamily;
					$this_obj->ascFamily['identifier'] = '0';
					
					$members_ref[1] = NULL;
					$members_ref[2] = $this_obj;
					
					$this_obj = new AG_UserBox(0, 3);
					$this_obj->setInternalRelation(3);
					$this_obj->ascFamily['id'] = $AGmyIDFamily;
					$this_obj->ascFamily['identifier'] = '0';
					
					$members_ref[3] = array($this_obj);
					$familyInfo['count_copii'] = 1;
					// #1 end ------------------------------------------------------------------------------------
					//
					// se creaza obiectul familiei
					// DBT_FAM_C1 = 'family_id'
					$this_fam_obj->setMembers($members_ref);
					// setam tipul familiei
					$this_identifier = array('this' => 'EX1'.(count($exRelatiiObj[1])+1), 'asc' => '0', 'desc' => array(1 => NULL, 2 => NULL));
					$this_ids = array('this' => 0, 'asc' => $AGmyIDFamily, 'desc' => array(1 => 0, 2 => 0));
					$this_recognition = array('type' => 4, 'align' => 1, 'grade' => count($exRelatiiObj[1])+1);
					$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
					// verificam pentru fiecare user ce ascendenti si ce descendenti are
					$this_fam_obj->setAscDescMembers($familyArrayChildren, $familyArrayParents, $familyArrayIdentif, $arrayFamilyObj);
					// se cere calcularea coordonatelor membrilor
					$this_fam_obj->calculateMembersCoord();
					// setam conexiunile dintre famili
					$conectToIdFamily = $AGmyIDFamily;
					$conectToIdUser = $arrayFamilyObj[$AGmyIDFamily]->members_ref[1]->member_id();
					if($conectToIdFamily && $conectToIdUser)
						$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
					
					//print '<pre>'; var_export($this_fam_obj); exit;
					// calculam pozitia familiei
					$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
					// exRelatii
					$this_fam_obj->exRelatii = count($exRelatiiDB[1])+1;
					$this_fam_obj->exRelatieActiva = count($exRelatiiDB[1])+1;
					// se introduce obiectul in vector
					$exRelatiiObj[1][0] = $this_fam_obj;
					unset($members_ref);
					// introducem ex relatia la butoane
					$arrayFamilyObj[$AGmyIDFamily]->exRelatiiButtons[1][] = 0;
				}
				
				foreach($exRelatiiDB[2] as $key => $familyInfo)
				{
					$this_fam_obj = new AG_FamilyBox();
					$this_fam_obj->setInfo($familyInfo);
					// #2 start Se creaza obiecte pentru fiecare membru al familiei ------------------------------
					$members_ref = array();
					//
					// DBT_FAM_C6 // 'id_parinte1' --------------------------
					$local_id_user = $familyInfo[DBT_FAM_C6];
					
					if($local_id_user > 0)
						$this_obj = new AG_UserBox($local_id_user, 1);
					elseif($AGmyAdmin)
					{
						$this_obj = new AG_UserBox(0, 3);
						$this_obj->ascFamily['id'] = $AGmyIDFamily;
						$this_obj->ascFamily['identifier'] = '0';
					}
					else
					{
						$this_obj = new AG_UserBox(0, 2);
						$this_obj->ascFamily['id'] = $AGmyIDFamily;
						$this_obj->ascFamily['identifier'] = '0';
					}
					
					$this_obj->setInternalRelation(1);
					$members_ref[1] = $this_obj;
					//
					// DBT_FAM_C7 // 'id_parinte2' --------------------------
					$members_ref[2] = NULL;
					//
					// DBT_FAM_C8 // 'id_copii' -----------------------------
					$members_ref[3] = array();
					$familyInfo['count_copii'] = 0;
					if($familyInfo[DBT_FAM_C8])
					{
						$exp = explode(',', $familyInfo[DBT_FAM_C8]);
						$familyInfo['count_copii'] = count($exp);
						if($familyInfo['count_copii'] > 1)
						{
							foreach($exp as $exp_key => $local_id_user)
							{
								$local_id_user = intval(str_replace('-', '', $local_id_user));
								$this_obj = new AG_UserBox($local_id_user, 1);
								$this_obj->setInternalRelation(3, $exp_key);
								$members_ref[3][] = $this_obj;
							}
						}
						else
						{
							$local_id_user = intval(str_replace('-', '', $familyInfo[DBT_FAM_C8]));
							if($local_id_user > 0)
							{
								$familyInfo['count_copii'] = 1;
								$this_obj = new AG_UserBox($local_id_user, 1);
								$this_obj->setInternalRelation(3);
								$members_ref[3][] = $this_obj;
							}
							else
								$familyInfo['count_copii'] = 0;
						}
					}
					
					// adaugam un copil sablon daca este pe modul administrare
					if($AGmyAdmin)
					{
						$this_obj = new AG_UserBox(0, 3);
						$this_obj->setInternalRelation(3, count($members_ref[3]));
						$this_obj->ascFamily['id'] = $AGmyIDFamily;
						$this_obj->ascFamily['identifier'] = '0';
								
						$members_ref[3][] = $this_obj;
						$familyInfo['count_copii']++;
					}
					// #2 end ------------------------------------------------------------------------------------
					//
					// se creaza obiectul familiei
					// DBT_FAM_C1 = 'family_id'
					$this_fam_obj->setMembers($members_ref);
					// setam tipul familiei
					$this_identifier = array('this' => 'EX2'.(count($exRelatiiObj[2])+1), 'asc' => '0', 'desc' => array(1 => NULL, 2 => NULL));
					$this_ids = array('this' => $familyInfo[DBT_FAM_C1], 'asc' => $AGmyIDFamily, 'desc' => array(1 => 0, 2 => 0));
					$this_recognition = array('type' => 4, 'align' => 2, 'grade' => count($exRelatiiObj[2])+1);
					$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
					// verificam pentru fiecare user ce ascendenti si ce descendenti are
					$this_fam_obj->setAscDescMembers($familyArrayChildren, $familyArrayParents, $familyArrayIdentif, $arrayFamilyObj);
					// se cere calcularea coordonatelor membrilor
					$this_fam_obj->calculateMembersCoord();
					// setam conexiunile dintre famili
					$conectToIdFamily = $AGmyIDFamily;
					$conectToIdUser = $arrayFamilyObj[$AGmyIDFamily]->members_ref[2]->member_id();
					if($conectToIdFamily && $conectToIdUser)
						$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
					//
					// calculam pozitia familiei
					$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
					// exRelatii
					$this_fam_obj->exRelatii = count($exRelatiiDB[2]);
					$this_fam_obj->exRelatieActiva = $key;
					// se introduce obiectul in vector
					$exRelatiiObj[2][$familyInfo[DBT_FAM_C1]] = $this_fam_obj;
					unset($members_ref);
					// introducem ex relatia la butoane
					$arrayFamilyObj[$AGmyIDFamily]->exRelatiiButtons[2][] = $familyInfo[DBT_FAM_C1];
				}
				// verificam (1) sa fie modul administrare activat, (2) ex realtiele sa nu depaseasca numarul de 5, (3) id userul caruia vrei sa-i adaugam o ex realtie sa nu fie 0
				if($AGmyAdmin && count($exRelatiiObj[2]) < 6 && $arrayFamilyObj[$AGmyIDFamily]->members_ref[2]->member_id())
				{
					$this_fam_obj = new AG_FamilyBox();
					$familyInfo = array(DBT_FAM_C1 => 0);
					$this_fam_obj->setInfo($familyInfo);
					// #1 start Se creaza obiecte pentru fiecare membru al familiei ------------------------------
					$members_ref = array();
					
					$this_obj = new AG_UserBox(0, 3);
					$this_obj->setInternalRelation(1);
					$this_obj->ascFamily['id'] = $AGmyIDFamily;
					$this_obj->ascFamily['identifier'] = '0';
					
					$members_ref[1] = $this_obj;
					$members_ref[2] = NULL;
					
					$this_obj = new AG_UserBox(0, 3);
					$this_obj->setInternalRelation(3);
					$this_obj->ascFamily['id'] = $AGmyIDFamily;
					$this_obj->ascFamily['identifier'] = '0';
					
					$members_ref[3] = array($this_obj);
					$familyInfo['count_copii'] = 1;
					// #1 end ------------------------------------------------------------------------------------
					//
					// se creaza obiectul familiei
					// DBT_FAM_C1 = 'family_id'
					$this_fam_obj->setMembers($members_ref);
					// setam tipul familiei
					$this_identifier = array('this' => 'EX2'.(count($exRelatiiObj[2])+1), 'asc' => '0', 'desc' => array(1 => NULL, 2 => NULL));
					$this_ids = array('this' => 0, 'asc' => $AGmyIDFamily, 'desc' => array(1 => 0, 2 => 0));
					$this_recognition = array('type' => 4, 'align' => 2, 'grade' => count($exRelatiiObj[2])+1);
					$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
					// verificam pentru fiecare user ce ascendenti si ce descendenti are
					$this_fam_obj->setAscDescMembers($familyArrayChildren, $familyArrayParents, $familyArrayIdentif, $arrayFamilyObj);
					// se cere calcularea coordonatelor membrilor
					$this_fam_obj->calculateMembersCoord();
					// setam conexiunile dintre famili
					$conectToIdFamily = $AGmyIDFamily;
					$conectToIdUser = $arrayFamilyObj[$AGmyIDFamily]->members_ref[2]->member_id();
					if($conectToIdFamily && $conectToIdUser)
						$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
					
					//print '<pre>'; var_export($this_fam_obj); exit;
					// calculam pozitia familiei
					$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
					// exRelatii
					$this_fam_obj->exRelatii = count($exRelatiiDB[2])+1;
					$this_fam_obj->exRelatieActiva = count($exRelatiiDB[2])+1;
					// se introduce obiectul in vector
					$exRelatiiObj[2][0] = $this_fam_obj;
					unset($members_ref);
					// introducem ex relatia la butoane
					$arrayFamilyObj[$AGmyIDFamily]->exRelatiiButtons[2][] = 0;
				}
				unset($exRelatiiDB);
				
				$pageContent = NULL;
				// introducem spre afisare familiile arborelui
				//print '<pre>'; var_export(count($arrayFamilyObj));
				foreach($arrayFamilyObj as $this_family_id => $family_obj)
				{
					if(isset($familiesPosition[$this_family_id]))
					{
						// setam conexiunile dintre famili
						$conectToIdFamily = $familiesPosition[$this_family_id]['conectTo']['family_id'];
						$conectToIdUser = $familiesPosition[$this_family_id]['conectTo']['id_user'];
						if($conectToIdFamily && $conectToIdUser)
							$family_obj->setConectTo($familiesPosition[$this_family_id]['conectTo'], $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
						//
						// calculam pozitia familiei
						$family_obj->calculateFamilyCoord($arrayFamilyObj);
						//
						// afisam familia
						$pageContent .= $family_obj->HTMLcode();
					}
					if($this_family_id == 1)
					{
						//print '<pre>'; var_export($family_obj); exit;
					}
					if($this_family_id == 2)
					{
						//print '<pre>'; var_export($family_obj); exit;
					}
				}
				// introducem spre afisare Ex relatiile parintelui 1
				foreach($exRelatiiObj[1] as $this_family_id => $family_obj)
				{
					$arrayMembersHover[$family_obj->members_ref[2]->member_id().'p'] = array('marginLeft' => $family_obj->members_ref[2]->marginLeft);
					foreach($family_obj->members_ref[3] as $userbox)
					{
						if(!isset($arrayMembersHover[$userbox->member_id()]))
							$arrayMembersHover[$userbox->member_id().'c'] = array('marginLeft' => $userbox->marginLeft);
						
					}
					$pageContent .= $family_obj->HTMLcode();
				}
				// introducem spre afisare Ex relatiile parintelui 2
				foreach($exRelatiiObj[2] as $this_family_id => $family_obj)
				{
					$arrayMembersHover[$family_obj->members_ref[1]->member_id().'p'] = array('marginLeft' => $family_obj->members_ref[1]->marginLeft);
					foreach($family_obj->members_ref[3] as $userbox)
					{
						if(!isset($arrayMembersHover[$userbox->member_id()]))
							$arrayMembersHover[$userbox->member_id().'c'] = array('marginLeft' => $userbox->marginLeft);
					}
					$pageContent .= $family_obj->HTMLcode();
				}
				//
				// introducem FAMILII SABLON ---------------------------------------------------------------
				if($AGmyAdmin)
				{
					$FamilyNoDesc = array();
					$FamilyNoAsc = array();
					
					foreach($arrayFamilyObj as $this_family_id => $family_obj)
					{
						// adaugam famili sablon descendente (doar daca tipul familiei este 1, 2 sau 3)
						if($family_obj->members_ref[1] && in_array($family_obj->recognition['type'], array(1, 2, 3)))
						{
							if(!$family_obj->members_ref[1]->descFamily['id'])
							{
								$this_family_identifier = $family_obj->identifier['this'].'0';
								// se creaza obiectul familiei
								// DBT_FAM_C1 = 'family_id'
								$this_fam_obj = new AG_FamilyBox();
								$familyInfo = array(DBT_FAM_C1 => 0);
								$this_fam_obj->setInfo($familyInfo);
								$this_fam_obj->box_type = 3;// family tip sablon
								// memebres ----------------------------
								$members_ref = array();
								
								$this_obj = new AG_UserBox(0, 3);
								$this_obj->setInternalRelation(1);
								$this_obj->ascFamily['id'] = $this_family_id;
								$this_obj->ascFamily['identifier'] = $family_obj->identifier['this'];
								
								$members_ref[1] = $this_obj;
								
								$this_obj = new AG_UserBox(0, 3);
								$this_obj->setInternalRelation(2);
								$this_obj->ascFamily['id'] = $this_family_id;
								$this_obj->ascFamily['identifier'] = $family_obj->identifier['this'];
								
								$members_ref[2] = $this_obj;
								
								$members_ref[3] = array();
								
								$this_fam_obj->setMembers($members_ref);
								// end members -------------------------
								//
								// setam tipul familiei
								$this_identifier = array('this' => $this_family_identifier, 'asc' => $family_obj->identifier['this'], 'desc' => array(1 => NULL, 2 => NULL));
								$this_ids = array('this' => 0, 'asc' => $this_family_id, 'desc' => array(1 => 0, 2 => 0));
								switch($family_obj->recognition['type'])
								{
									case 1:
										$new_type = -2;
									case 2:
									case 3:
										$new_type = -3;
										break;
								}
								$this_recognition = array('type' => $new_type, 'align' => 0, 'grade' => $family_obj->recognition['grade']+1);
								$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
								// se cere calcularea coordonatelor membrilor
								$this_fam_obj->calculateMembersCoord();
								// setam conexiunile dintre famili
								$conectToIdFamily = $this_family_id;
								$conectToIdUser = $family_obj->members_ref[1]->member_id();
								if($conectToIdFamily && $conectToIdUser)
									$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
								// calculam pozitia familiei
								$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
								//print '<pre>('.$conectToIdFamily.') '; var_export($this_fam_obj);
								// introducem in vector
								$arrayFamilyObj[] = $this_fam_obj;
								$pageContent .= $this_fam_obj->HTMLcode();
								unset($this_fam_obj, $this_identifier, $this_ids, $this_recognition);
							}
						}
						if($family_obj->members_ref[2] && in_array($family_obj->recognition['type'], array(1, 2, 3)))
						{
							if(!$family_obj->members_ref[2]->descFamily['id'])
							{
								$this_family_identifier = $family_obj->identifier['this'].'1';
								// se creaza obiectul familiei
								// DBT_FAM_C1 = 'family_id'
								$this_fam_obj = new AG_FamilyBox();
								$familyInfo = array(DBT_FAM_C1 => 0);
								$this_fam_obj->setInfo($familyInfo);
								$this_fam_obj->box_type = 3;// family tip sablon
								// memebres ----------------------------
								$members_ref = array();
								
								$this_obj = new AG_UserBox(0, 3);
								$this_obj->setInternalRelation(1);
								$this_obj->ascFamily['id'] = $this_family_id;
								$this_obj->ascFamily['identifier'] = $family_obj->identifier['this'];
								
								$members_ref[1] = $this_obj;
								
								$this_obj = new AG_UserBox(0, 3);
								$this_obj->setInternalRelation(2);
								$this_obj->ascFamily['id'] = $this_family_id;
								$this_obj->ascFamily['identifier'] = $family_obj->identifier['this'];
								
								$members_ref[2] = $this_obj;
								
								$members_ref[3] = array();
								
								$this_fam_obj->setMembers($members_ref);
								// end members -------------------------
								//
								// setam tipul familiei
								$this_identifier = array('this' => $this_family_identifier, 'asc' => $family_obj->identifier['this'], 'desc' => array(1 => NULL, 2 => NULL));
								$this_ids = array('this' => 0, 'asc' => $this_family_id, 'desc' => array(1 => 0, 2 => 0));
								switch($family_obj->recognition['type'])
								{
									case 1:
										$new_type = -2;
									case 2:
									case 3:
										$new_type = -3;
										break;
								}
								$this_recognition = array('type' => $new_type, 'align' => 0, 'grade' => $family_obj->recognition['grade']+1);
								$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
								// se cere calcularea coordonatelor membrilor
								$this_fam_obj->calculateMembersCoord();
								// setam conexiunile dintre famili
								$conectToIdFamily = $this_family_id;
								$conectToIdUser = $family_obj->members_ref[2]->member_id();
								if($conectToIdFamily && $conectToIdUser)
									$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
								// calculam pozitia familiei
								$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
								//print '<pre>('.$conectToIdFamily.') '; var_export($this_fam_obj);
								// introducem in vector
								$arrayFamilyObj[] = $this_fam_obj;
								$pageContent .= $this_fam_obj->HTMLcode();
								unset($this_fam_obj, $this_identifier, $this_ids, $this_recognition);
							}
						}
						// adaugam famili sablon ascendente (doar daca tipul familiei este 1 sau 5)
						if($family_obj->members_ref[3] && in_array($family_obj->recognition['type'], array(1, 5)))
						{
							foreach($family_obj->members_ref[3] as $key => $children_obj)// rulam copii familiei
							{
								if($children_obj->member_id() && !$children_obj->ascFamily['id'])
								{
									if(($family_obj->identifier['this'] === '0' || substr($family_obj->identifier['this'], 0, 1) == '1') && $children_obj->member_id() > 0)// permitem afisarea famililor sablon ascendente doar copiilor din familia principala si a copiilor familiilor acestora DACA id_user > 0
									{
										$this_family_identifier = ($family_obj->identifier['this'] === '0') ? '1' : $family_obj->identifier['this'];
										$this_family_identifier .= $key+1;
										// se creaza obiectul familiei
										// DBT_FAM_C1 = 'family_id'
										$this_fam_obj = new AG_FamilyBox();
										$familyInfo = array(DBT_FAM_C1 => 0);
										$this_fam_obj->setInfo($familyInfo);
										$this_fam_obj->box_type = 3;// family tip sablon
										// memebres ----------------------------
										$members_ref = array();
										
										if($children_obj->info[DBT_USER_INFO_C4] == 2)// feminin
										{
											$this_obj = new AG_UserBox(0, 3);
											$this_obj->setInternalRelation(1);
											$this_obj->descFamily['id'] = $this_family_id;
											$this_obj->descFamily['identifier'] = $family_obj->identifier['this'];
											
											$members_ref[1] = $this_obj;
											$members_ref[2] = NULL;
										}
										else
										{
											$this_obj = new AG_UserBox(0, 3);
											$this_obj->setInternalRelation(2);
											$this_obj->descFamily['id'] = $this_family_id;
											$this_obj->descFamily['identifier'] = $family_obj->identifier['this'];
											
											$members_ref[1] = NULL;
											$members_ref[2] = $this_obj;
										}
										
										$this_obj = new AG_UserBox(0, 3);
										$this_obj->setInternalRelation(3);
										$this_obj->descFamily['id'] = $this_family_id;
										$this_obj->descFamily['identifier'] = $family_obj->identifier['this'];
										
										$members_ref[3] = array();
										$members_ref[3][] = $this_obj;
										
										$this_fam_obj->setMembers($members_ref);
										// end members -------------------------
										//
										// setam tipul familiei
										if($children_obj->info[DBT_USER_INFO_C4] == 2)// feminin
										{
											$this_identifier = array('this' => $this_family_identifier, 'asc' => NULL, 'desc' => array(1 => NULL, 2 => $family_obj->identifier['this']));
											$this_ids = array('this' => 0, 'asc' => 0, 'desc' => array(1 => 0, 2 => $this_family_id));
											$this_recognition = array('type' => -5, 'align' => 2, 'grade' => $family_obj->recognition['grade']+1);
										}
										else
										{
											$this_identifier = array('this' => $this_family_identifier, 'asc' => NULL, 'desc' => array(1 => $family_obj->identifier['this'], 2 => NULL));
											$this_ids = array('this' => 0, 'asc' => 0, 'desc' => array(1 => $this_family_id, 2 => 0));
											$this_recognition = array('type' => -5, 'align' => 1, 'grade' => $family_obj->recognition['grade']+1);
										}
										$this_fam_obj->setPosition($this_identifier, $this_ids, $this_recognition);
										// se cere calcularea coordonatelor membrilor
										$this_fam_obj->calculateMembersCoord();
										// setam conexiunile dintre famili
										$conectToIdFamily = $this_family_id;
										$conectToIdUser = $children_obj->member_id();
										if($conectToIdFamily && $conectToIdUser)
											$this_fam_obj->setConectTo(array('family_id' => $conectToIdFamily, 'id_user' => $conectToIdUser), $arrayMembersCoord[$conectToIdFamily][$conectToIdUser]);
										// calculam pozitia familiei
										$this_fam_obj->calculateFamilyCoord($arrayFamilyObj);
										//print '<pre>('.$conectToIdFamily.') '; var_export($this_fam_obj);
										// introducem in vector
										$arrayFamilyObj[] = $this_fam_obj;
										$pageContent .= $this_fam_obj->HTMLcode();
										unset($this_fam_obj, $this_identifier, $this_ids, $this_recognition);
									}
								}
							}
						}
					}
				}
				// end FAMILII SABLON ----------------------------------------------------------------------
				//
				//
				// stilul pentru extindere casutei utilizatorului
				$pageStyle = '<style>'."\n";
				$MLdiff = ceil((AGFORMAT_T1_UBW_ - AGFORMAT_T1_UBW)/2);
				foreach($arrayMembersHover as $member_id => $option)
				{
						$pageStyle .= '#AGuserBox_'.$member_id.' { margin-left:'.$option['marginLeft'].'px !important; width:'.AGFORMAT_T1_UBW.'px !important; height:'.AGFORMAT_T1_UBH.'px !important; }'."\n";
						$pageStyle .= '#AGuserBox_'.$member_id.':hover { margin-left:'.($option['marginLeft']-$MLdiff).'px !important; width:'.AGFORMAT_T1_UBW_.'px !important; }'."\n";
				}
				$pageStyle .= '</style>'."\n";
				unset($familiesPosition);
			}
			
			
			$ag_array = array('AGmyAdmin' => $AGmyAdmin, 'AGmyIDUser' => $AGmyIDUser, 'AGmyIDTree' => $AGmyIDTree, 'AGmyIDFamily' => $AGmyIDFamily, 'AGmyIDRel' => $AGmyIDRel, 'AGmyPreview' => 'AGmyPreview');
			
			$html_head = array('title' => 'Organigrama');
			$for_head_end = array('pageStyle' => $pageStyle, 'arrayFamilyObj' => $arrayFamilyObj);
			$for_page = array('pageContent' => $pageContent, 'AGPlanW' => $AGPlanW, 'AGPlanH' => $AGPlanH, 'topMinus' => $topMinus);
			$this->load_view('templates/harmony/head', $html_head);
			$this->load_view('tree/head_end', array_merge($for_head_end, $ag_array));
			$this->load_view('templates/harmony/header');
			$this->load_view('tree/p_index', array_merge($for_page, $ag_array));
			$this->load_view('templates/harmony/footer');
		}
		else
		{
			$this->load_view('templates/harmony/head', array('title' => 'Tree select'));
			$this->load_view('tree/head_end', array());
			$this->load_view('templates/harmony/header');
			$this->load_view('tree/p_tree_list', array());
			$this->load_view('templates/harmony/footer');
		}
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function overview()
	{
		global $MyUser;
		$AGmyIDTree		= (defined('arg1')) ? arg1 : 0;
		$AGmyIDUser		= (defined('arg2')) ? arg2 : 0;
		$AGmyIDFamily	= 0;
		$AGmyIDRel		= 0;
		
		
		$this->load_library('Tree');
		
		$AGmyDirection = NULL;
		$AGmyIDUser = (!$AGmyIDUser) ? AG_Operation::myDefaultUser($AGmyIDTree) : $AGmyIDUser;
		$AGmyIDFamily = (!$AGmyIDFamily) ? AG_Operation::myFamily($AGmyIDUser, $AGmyIDTree, $AGmyDirection) : $AGmyIDFamily;
		$AGmyIDRel = (!$AGmyIDRel) ? AG_Operation::myRel($AGmyIDFamily, $AGmyIDUser) : $AGmyIDRel;
		
		$AGmyAdmin   = FALSE;
		$AGmyPreview = (isset($_GET['preview'])) ? TRUE :  FALSE;
		$tree_admin  = AG_Operation::tree_get_admin($AGmyIDTree);
		
		$ag_array = array('AGmyAdmin' => $AGmyAdmin, 'AGmyIDUser' => $AGmyIDUser, 'AGmyIDTree' => $AGmyIDTree, 'AGmyIDFamily' => $AGmyIDFamily, 'AGmyIDRel' => $AGmyIDRel, 'AGmyPreview' => 'AGmyPreview');
		$for_head = array('title' => 'Organigrama');
		$for_page = array();
		$this->load_view('templates/harmony/head', $for_head);
		$this->load_view('templates/harmony/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_overview', array_merge($for_page, $ag_array));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function facts()
	{
		global $MyUser;
		$AGmyIDTree		= (defined('arg1')) ? arg1 : 0;
		$AGmyIDUser		= (defined('arg2')) ? arg2 : 0;
		$AGmyIDFamily	= 0;
		$AGmyIDRel		= 0;
		
		
		$this->load_library('Tree');
		
		$AGmyDirection = NULL;
		$AGmyIDUser = (!$AGmyIDUser) ? AG_Operation::myDefaultUser($AGmyIDTree) : $AGmyIDUser;
		$AGmyIDFamily = (!$AGmyIDFamily) ? AG_Operation::myFamily($AGmyIDUser, $AGmyIDTree, $AGmyDirection) : $AGmyIDFamily;
		$AGmyIDRel = (!$AGmyIDRel) ? AG_Operation::myRel($AGmyIDFamily, $AGmyIDUser) : $AGmyIDRel;
		
		$AGmyAdmin   = FALSE;
		$AGmyPreview = (isset($_GET['preview'])) ? TRUE :  FALSE;
		$tree_admin  = AG_Operation::tree_get_admin($AGmyIDTree);
		
		$ag_array = array('AGmyAdmin' => $AGmyAdmin, 'AGmyIDUser' => $AGmyIDUser, 'AGmyIDTree' => $AGmyIDTree, 'AGmyIDFamily' => $AGmyIDFamily, 'AGmyIDRel' => $AGmyIDRel, 'AGmyPreview' => 'AGmyPreview');
		$for_head = array('title' => 'Organigrama');
		$for_page = array();
		$this->load_view('templates/harmony/head', $for_head);
		$this->load_view('templates/harmony/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_facts', array_merge($for_page, $ag_array));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function media()
	{
		global $MyUser;
		$AGmyIDTree		= (defined('arg1')) ? arg1 : 0;
		$AGmyIDUser		= (defined('arg2')) ? arg2 : 0;
		$AGmyIDFamily	= 0;
		$AGmyIDRel		= 0;
		
		
		$this->load_library('Tree');
		
		$AGmyDirection = NULL;
		$AGmyIDUser = (!$AGmyIDUser) ? AG_Operation::myDefaultUser($AGmyIDTree) : $AGmyIDUser;
		$AGmyIDFamily = (!$AGmyIDFamily) ? AG_Operation::myFamily($AGmyIDUser, $AGmyIDTree, $AGmyDirection) : $AGmyIDFamily;
		$AGmyIDRel = (!$AGmyIDRel) ? AG_Operation::myRel($AGmyIDFamily, $AGmyIDUser) : $AGmyIDRel;
		
		$AGmyAdmin   = FALSE;
		$AGmyPreview = (isset($_GET['preview'])) ? TRUE :  FALSE;
		$tree_admin  = AG_Operation::tree_get_admin($AGmyIDTree);
		
		$ag_array = array('AGmyAdmin' => $AGmyAdmin, 'AGmyIDUser' => $AGmyIDUser, 'AGmyIDTree' => $AGmyIDTree, 'AGmyIDFamily' => $AGmyIDFamily, 'AGmyIDRel' => $AGmyIDRel, 'AGmyPreview' => 'AGmyPreview');
		$for_head = array('title' => 'Organigrama');
		$for_page = array();
		$this->load_view('templates/harmony/head', $for_head);
		$this->load_view('templates/harmony/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_media', array_merge($for_page, $ag_array));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
	//
	//
	//
	// -----------------------------------------------------------------------------
	public function comments()
	{
		global $MyUser;
		$AGmyIDTree		= (defined('arg1')) ? arg1 : 0;
		$AGmyIDUser		= (defined('arg2')) ? arg2 : 0;
		$AGmyIDFamily	= 0;
		$AGmyIDRel		= 0;
		
		
		$this->load_library('Tree');
		
		$AGmyDirection = NULL;
		$AGmyIDUser = (!$AGmyIDUser) ? AG_Operation::myDefaultUser($AGmyIDTree) : $AGmyIDUser;
		$AGmyIDFamily = (!$AGmyIDFamily) ? AG_Operation::myFamily($AGmyIDUser, $AGmyIDTree, $AGmyDirection) : $AGmyIDFamily;
		$AGmyIDRel = (!$AGmyIDRel) ? AG_Operation::myRel($AGmyIDFamily, $AGmyIDUser) : $AGmyIDRel;
		
		$AGmyAdmin   = FALSE;
		$AGmyPreview = (isset($_GET['preview'])) ? TRUE :  FALSE;
		$tree_admin  = AG_Operation::tree_get_admin($AGmyIDTree);
		
		$ag_array = array('AGmyAdmin' => $AGmyAdmin, 'AGmyIDUser' => $AGmyIDUser, 'AGmyIDTree' => $AGmyIDTree, 'AGmyIDFamily' => $AGmyIDFamily, 'AGmyIDRel' => $AGmyIDRel, 'AGmyPreview' => 'AGmyPreview');
		$for_head = array('title' => 'Organigrama');
		$for_page = array();
		$this->load_view('templates/harmony/head', $for_head);
		$this->load_view('templates/harmony/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('tree/p_comments', array_merge($for_page, $ag_array));
		$this->load_view('templates/harmony/footer');
	}
	// -----------------------------------------------------------------------------
}



/* End of file Tree.php */
/* Location: ./controllers/Tree.php */?>