<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
global $config;
define('DB_PREFIX', $config['db2_pre']);

class Accounts_API
{
	private $db_link;
	private $fields = array();
	public  $owner_id;
	public  $family_id;
	
	public  $gen;
	
	// ========================================================================================================
	// constructor
	public function __construct($owner_id=0)
	{
		$this->connect();
		$this->owner_id = (int)$owner_id;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// constructor
	public function __destruct()
	{
		mysql_close($this->db_link);// 
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	private function connect()
	{
		global $config;
		$this->db_link = mysql_connect($config['db2_server'], $config['db2_user'], $config['db2_pass'], true); 
		mysql_select_db($config['db2_name'], $this->db_link);
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_start()
	{
		return mysql_query("START TRANSACTION;", $this->db_link); 
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_querry($querry)
	{
		// daca nu exista conexiunea cu db
		if(!$this->db_link)
	    	SQL_DB::sql_connect();
		
		// incearca executia comenzi sql
		if(($result = mysql_query($querry, $this->db_link)))
			return $result;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_count($table, $where = NULL, $limit = 0)
	{
		if($where) $where = "WHERE ($where)";
		
	    $query = mysql_query("SELECT COUNT(*) FROM `$table` $where", $this->db_link);
		$result = mysql_result($query, 0);
		if($limit == 1)
			return (bool)$result;// returneaza TRUE of FALSE
		else
			return $result;// returneaza un numar
	}
	// ========================================================================================================
	
	
	public function getAllApprovals($account_id)
	{
		return $this->sql_select(DB_PREFIX."families_members_approvals", "owner_account_id = '$account_id'", "ORDER BY approval_id DESC");
	}
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_select($table, $where = NULL, $order = NULL, $start = 0, $limit = 0, $keys = array(), $distinct = NULL, $group = NULL)
	{
		
		if(!empty($where)) $where = "WHERE ($where)";
		$sql_keys = NULL;
		if(count($keys))
		{
			foreach($keys as $k)
			{
				if($sql_keys) $sql_keys .= ", ";
				$sql_keys .= "`$k`";
			}
		}
		else
			$sql_keys = '*';
		$sql_distinct = ($distinct) ? "DISTINCT `$distinct`" : $sql_keys;
		
		$sql_group = ($group) ? " GROUP BY `$group`" : NULL;
		
	    $LIMIT = (!$start && !$limit) ? '' : "LIMIT $start, $limit";
		$rezultat = $this->sql_querry("SELECT $sql_distinct FROM `$table` $where $order $LIMIT".$sql_group);

		$list = array();
		while ($rand = mysql_fetch_array($rezultat, MYSQL_ASSOC))
			$list[] = $rand;
		return $list;
	}
	// ========================================================================================================
	
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_insert($table, $keys = array())
	{
		$dbKeys = NULL;
		$dbVals = NULL;
		
		foreach($keys as $k => $v)
		{
			if($dbKeys != NULL) $dbKeys .= ', ';
			if($dbVals != NULL) $dbVals .= ', ';
			
			$dbKeys .= "`$k`";
			
			switch($v)
			{
				case 'NULL':
				case 'NOW()': $dbVals .= $v; break;
				default: $dbVals .= "'".mysql_escape_string($v)."'"; break;
			}
		}
		
		if($this->sql_querry("INSERT INTO `$table` ($dbKeys) VALUES ($dbVals)"))
			return mysql_insert_id($this->db_link);
		else
			return 0;
	}
	// ========================================================================================================
	
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_commit()
	{
		return mysql_query("COMMIT;", $this->db_link); 
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: void
	// output: (bool)
	public function sql_rollback()
	{
		return mysql_query("ROLLBACK;", $this->db_link); 
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (string), (string)
	// output: void
	public function set_field($name, $value)
	{
		$ex = explode('.', $name);
		if(isset($ex[0]) && isset($ex[1]))
		{
			if(!array_key_exists($ex[0], $this->fields))
				$this->fields[$ex[0]] = array();
			
			$this->fields[$ex[0]][$ex[1]] = $value;
		}
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// AVIZE #1
	public function approval_insert($owner_account_id, $family_id, $account_id, $grade)
	{
		if($family_id==0 || $account_id==0 || !in_array($grade, array('parent','child')))
			return false;
		
		return $this->sql_insert(DB_PREFIX."families_members_approvals", array('approval_id' => 'NULL', 'owner_account_id' => $owner_account_id, 'account_id' => $account_id, 'family_id' => $family_id, 'grade' => $grade), array());
	}
	
	// AVIZE #2
	public function approval_delete($approval_id)
	{
		return mysql_query("DELETE FROM `".DB_PREFIX."families_members_approvals` WHERE `approval_id` = '$approval_id'", $this->db_link);
	}
	
	// AVIZE #3
	public function getAllActivateMembers($family_id, $account_id)
	{
		
		$families = $this->gen->compatibility_generate_tree_families($account_id, $family_id);
		$accnts = array();
		foreach($families as $f)
			$accnts[] = $f['account_id'];
		return array_unique($accnts);
	}
	
	// AVIZE #4
	public function approval_select($approval_id)
	{
		$arr = $this->sql_select(DB_PREFIX."families_members_approvals", "`approval_id` = '$approval_id'", "", 0, 1);
		return $arr[0];
	}
	
	
	// AVIZE #5
	public function is_approval($account_id, $family_id)
	{
		$arr = $this->sql_select(DB_PREFIX."families_members_approvals", "`owner_account_id` = '".$this->owner_id."' AND `account_id` = '$account_id' AND `family_id` = '$family_id'", "", 0, 1);
		return (bool)count($arr);
	}
	
	
	// ========================================================================================================
	// input : $username - optional
	// output: bool (true-daca exista)
	public function username_exists($username = NULL)
	{
		if($username == NULL && !isset($this->fields['l_accounts']['loghin_id']))
			return false;
		
		if($username == NULL)
			$username = $this->fields['l_accounts']['loghin_id'];
		
		$q = mysql_query("SELECT * FROM `".DB_PREFIX."accounts` WHERE `loghin_id` = '$username' LIMIT 1", $this->db_link);
		if(mysql_num_rows($q) > 0)
			return true;
		
		return false;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	public function valid()
	{
		if(!isset($this->fields['l_accounts']['loghin_id']))
			return false;
		
		$q = mysql_query("SELECT * FROM ".DB_PREFIX."accounts WHERE `loghin_id` = '".$this->fields['l_accounts']['loghin_id']."' LIMIT 1", $this->db_link);
		if(mysql_num_rows($q) > 0)
			return false;
		
		return true;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: void
	// output: (array) $accounts
	public function get_accounts()
	{
		$accounts=array();
		$query = mysql_query('SELECT * FROM '.DB_PREFIX.'accounts', $this->db_link);
		while($account=mysql_fetch_assoc($query))
				$accounts[] = $account;
		return $accounts;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int)
	// output: (array) $account
	public function get_account($account_id)
	{
		$account = array();
		$query   = mysql_query("SELECT * FROM ".DB_PREFIX."accounts WHERE `account_id` = '$account_id' LIMIT 1", $this->db_link);
		$account = mysql_fetch_assoc($query);
		return $account;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int)
	// output: (array) $account
	public function get_account_u($username)
	{
		$account = array();
		$query   = mysql_query("SELECT * FROM ".DB_PREFIX."accounts WHERE `loghin_id` = '$username' LIMIT 1", $this->db_link);
		$account = mysql_fetch_assoc($query);
		return $account;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (string) $sess_hash, (string) $ip_address
	// output: (int) $account_id
	public function session_check($sesshash, $ip_address = null, $id = null)
	{
		$account = array();
		$query   = mysql_query("SELECT `account_id` FROM ".DB_PREFIX."accounts WHERE `sessionhash` = '$sesshash' AND ". ($id != null ? "`account_id` = '". $id ."'" : "`ip` = '$ip_address'") ." LIMIT 1", $this->db_link);

		/* Check if resultset contain any row and resultset it */
		if ($account = mysql_fetch_assoc($query)) {
			$id = $account['account_id'];
		}
		/* Set default id */
		else {
			$id = 0;
		}

		return $id;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int) $account_id, (string) $sess_hash, (string) $ip_address
	// output: (bool) 
	public function set_session($account_id, $sesshash, $ip_address)
	{
		return (bool)mysql_query("UPDATE `".DB_PREFIX."accounts` SET `sessionhash` = '$sesshash', `ip` = '$ip_address' WHERE `account_id` = '$account_id' LIMIT 1", $this->db_link);
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int) $account_id, (string) $sess_hash, (string) $ip_address
	// output: (bool) 
	public function get_sessionhash($account_id)
	{
		$query = mysql_query("SELECT `sessionhash` FROM `".DB_PREFIX."accounts` WHERE `account_id` = '$account_id' LIMIT 1", $this->db_link);
		$account = mysql_fetch_assoc($query);
		return $account['sessionhash'];
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (array) $sets, (int) $account_id
	// output: (bool)
	public function update_account($sets, $account_id)
	{
		
		
		
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (string) username, (string) password
	// output: (int) $account_id, 0= invalid account
	public function auth($username, $password)
	{   
		$query = mysql_query("SELECT * FROM ".DB_PREFIX."accounts WHERE `loghin_id` = '$username' LIMIT 1", $this->db_link);
		if(mysql_num_rows($query) > 0)
		{
			$r = mysql_fetch_assoc($query);
			if(Hash::check($password, $r['password']))
				return (int)$r['account_id'];
		}
		
		return 0;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (string) loghin_id
	// output: (int) $account_id, 0= account does not exists
	public function get_account_id($loghin_id)
	{
		$query = mysql_query("SELECT account_id FROM ".DB_PREFIX."accounts WHERE `loghin_id` = '$loghin_id' LIMIT 1", $this->db_link);
		if(mysql_num_rows($query) > 0)
		{
			$r = mysql_fetch_assoc($query);
			return (int)$r['account_id'];
		}
		
		return 0;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (array)
	// output: (bool) 
	public function account_insert($sets = array(), $owner_id = 0)
	{
		$primary = ($owner_id == 0) ? 1 : 0;
		$bool = mysql_query("INSERT INTO ".DB_PREFIX."accounts (`loghin_id`, `password`, `email`, `firstname`, `lastname`, `primary`) VALUES ('".$this->fields['l_accounts']['loghin_id']."', '".$this->fields['l_accounts']['password']."', '".$this->fields['l_accounts']['email']."', '".$this->fields['l_accounts']['firstname']."', '".$this->fields['l_accounts']['lastname']."', '$primary')", $this->db_link);
		
		$account_id = $this->get_account_id($this->fields['l_accounts']['loghin_id']);
		
		if($account_id && !$primary && $bool)
			$bool = mysql_query("INSERT INTO ".DB_PREFIX."accounts_owners (`owner_id`, `account_id`) VALUES ('$owner_id', '$account_id')", $this->db_link);
		
		return $bool;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (void)
	// output: (int) $family_id 
	public function family_insert($p_config)
	{
		/* Optional sets:
		 *  $obj->set_field('l_families.name',		'');
		 *  $obj->set_field('l_families.lastname',	'');
		 *  $obj->set_field('l_families.country',	'');
		 *  $obj->set_field('l_families.location',	'');
		 *  $obj->set_field('l_families.zip',		'');
		 *  $obj->set_field('l_families.aniversary', '');
		 *  $obj->set_field('l_families.type',		'');
		 */
		$values = array();
		
		if(!array_key_exists('name', $p_config))
			$values['name'] = '';
		
		if(!array_key_exists('lastname', $p_config))
			$values['lastname'] = '';
		
		if(!array_key_exists('country', $p_config))
			$values['country'] = '';
		
		if(!array_key_exists('location', $p_config))
			$values['location'] = '';
		
		if(!array_key_exists('zip', $p_config))
			$values['zip'] = '';
		
		if(!array_key_exists('aniversary', $p_config))
			$values['aniversary'] = '0000-00-00';
		
		if(!array_key_exists('type', $p_config))
			$values['type'] = 'public';
		
		mysql_query("INSERT INTO ".DB_PREFIX."families (`family_id`, `account_id`, `name`, `lastname`, `country`, `location`, `zip`, `aniversary`, `type`) VALUES (NULL, '".$this->owner_id."', '".$values['name']."', '".$values['lastname']."', '".$values['country']."', '".$values['location']."', '".$values['zip']."', '".$values['aniversary']."', '".$values['type']."')", $this->db_link);
		return mysql_insert_id($this->db_link);
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int) $family_id 
	// output: (bool)
	public function family_delete($family_id)
	{
		if($family_id==0)
			return false;
		
		if(mysql_query("DELETE FROM `".DB_PREFIX."families_members` WHERE `family_id` = '$family_id')", $this->db_link))
			return mysql_query("DELETE FROM `".DB_PREFIX."families` WHERE `id` = '$family_id' LIMIT 1)", $this->db_link);
		else
			return false;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int) $family_id, (int) $account_id, (parent|child) $grade
	// output: (int)  $family_member_id
	public function family_member_insert($family_id, $account_id, $grade)
	{
		if($family_id == 0)// se creaza familie
			$family_id = $this->family_insert(array());
		
		if($family_id==0 || $account_id==0 || !in_array($grade, array('parent','child')))
			return false;
		
		$ret = mysql_query("INSERT INTO ".DB_PREFIX."families_members (`account_id`, `family_id`, `grade`) VALUES ('$account_id', '$family_id', '$grade')", $this->db_link);
		
		// Trimite AVIZE
		$this->send_approvals($account_id, $family_id, $grade);
		
		return $ret;
	}
	
	
	
	private function send_approvals($account_id, $family_id, $grade)
	{
		foreach($this->getAllActivateMembers($family_id, $account_id) as $acc_id)
			new Approval($acc_id, $family_id, $account_id, $grade);
	}
	// ========================================================================================================
	
	
	
	
	// ========================================================================================================
	// input: (int) $family_id, (int) $account_id, (parent|child) $grade
	// output: (int)  $family_member_id
	public function family_member_delete($family_id, $account_id)
	{
		
		if($family_id==0 || $account_id==0)
			return false;
		
		return mysql_query("DELETE FROM `".DB_PREFIX."families_members` WHERE `family_id` = '$family_id' AND `account_id` = '$account_id'", $this->db_link);
	}
	// ========================================================================================================
	
	
	
	
	// ========================================================================================================
	// input: (int) $account_id
	// output: (array(string))  $languages
	/*public function getLanguages($account_id)
	{
		
		$arr = $this->sql_select(DB_PREFIX.'accounts_languages', "`account_id` = '$account_id'");
		return $arr;
	}*/
	// ========================================================================================================
	
	
	
	
	// ========================================================================================================
	// input: (int) $account_id
	// output: (array(string))  $languages
	public function getCountry($account_id)
	{
		
		$arr = $this->sql_select(DB_PREFIX.'accounts_languages', "`account_id` = '$account_id'");
		$arr_c = array();
		foreach($arr as $r)
			$arr_c[$r['country']][] = $r['language'];
		return $arr_c;
	}
	// ========================================================================================================
}
?>