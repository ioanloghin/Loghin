<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
define('DB_PREFIX', 'l_');

class Accounts_API
{
	private $db_link;
	private $fields = array();
	public  $owner_id;
	public  $family_id;
	
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
		$this->db_link = mysql_connect('localhost', 'loghin_register', 'WZOKyMSe^bGy', true); 
		mysql_select_db('loghin_register', $this->db_link);
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
	public function family_insert()
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
		
		if($this->owner_id==0)
			return false;
		
		if(!array_key_exists('l_families', $this->fields))
			$this->fields['l_families'] = array();
		
		if(!array_key_exists('name', $this->fields['l_families']))
			$this->fields['l_families']['name'] = '';
		
		if(!array_key_exists('lastname', $this->fields['l_families']))
			$this->fields['l_families']['lastname'] = '';
		
		if(!array_key_exists('country', $this->fields['l_families']))
			$this->fields['l_families']['country'] = '';
		
		if(!array_key_exists('location', $this->fields['l_families']))
			$this->fields['l_families']['location'] = '';
		
		if(!array_key_exists('zip', $this->fields['l_families']))
			$this->fields['l_families']['zip'] = '';
		
		if(!array_key_exists('aniversary', $this->fields['l_families']))
			$this->fields['l_families']['aniversary'] = '0000-00-00';
		
		if(!array_key_exists('type', $this->fields['l_families']))
			$this->fields['l_families']['type'] = 'public';
		
		mysql_query("INSERT INTO ".DB_PREFIX."families (`family_id`, `account_id`, `name`, `lastname`, `country`, `location`, `zip`, `aniversary`, `type`) VALUES (NULL, '".$this->owner_id."', '".$this->fields['l_families']['name']."', '".$this->fields['l_families']['lastname']."', '".$this->fields['l_families']['country']."', '".$this->fields['l_families']['location']."', '".$this->fields['l_families']['zip']."', '".$this->fields['l_families']['aniversary']."', '".$this->fields['l_families']['type']."')", $this->db_link);
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
		/* Optional sets:
		 *  $obj->set_field('l_families_members.adopted',		'');
		 *  $obj->set_field('l_families_members.father_name',	'');
		 *  $obj->set_field('l_families_members.mother_name',	'');
		 */
		
		if($family_id==0 || $account_id==0 || !in_array($grade, array('parent','child')))
			return false;
		
		if(!array_key_exists('l_families_members', $this->fields))
			$this->fields['l_families_members'] = array();
		
		if(!array_key_exists('adopted', $this->fields['l_families_members']))
			$this->fields['l_families_members']['adopted'] = '0';
		
		if(!array_key_exists('father_name', $this->fields['l_families_members']))
			$this->fields['l_families_members']['father_name'] = '';
		
		if(!array_key_exists('mother_name', $this->fields['l_families_members']))
			$this->fields['l_families_members']['mother_name'] = '';
		
		return mysql_query("INSERT INTO ".DB_PREFIX."families_members (`account_id`, `family_id`, `grade`, `adopted`, `father_name`, `mother_name`) VALUES ('$account_id', '$family_id', '$grade', '".$this->fields['l_families_members']['adopted']."', '".$this->fields['l_families_members']['father_name']."', '".$this->fields['l_families_members']['mother_name']."')", $this->db_link);
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
}
?>