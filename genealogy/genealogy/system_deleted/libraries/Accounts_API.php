<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

class Accounts_API
{
	private $db_link;
	private $fields = array();
	
	// constructor
	public function __construct()
	{
		$this->connect();
		
	}
	
	
	// input: void
	// output: (bool)
	private function connect()
	{
		$this->db_link = mysql_connect('localhost', 'loghin_register', 'WZOKyMSe^bGy', true); 
		mysql_select_db('loghin_register', $this->db_link);
	}
	
	
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
	
	public function valid()
	{
		if(!isset($this->fields['l_accounts']['loghin_id']))
			return false;
		
		$q = mysql_query("SELECT * FROM l_accounts WHERE `loghin_id` = '".$this->fields['l_accounts']['loghin_id']."' LIMIT 1", $this->db_link);
		if(mysql_num_rows($q) > 0)
			return false;
		
		return true;
	}
	
	
	// input: void
	// output: (array) $accounts
	public function get_accounts()
	{
		$accounts=array();
		$query = mysql_query('SELECT * FROM l_accounts', $this->db_link);
		while($account=mysql_fetch_assoc($query))
				$accounts[] = $account;
		return $accounts;
	}
	
	
	// input: (int)
	// output: (array) $account
	public function get_account($account_id)
	{
		$account = array();
		$query   = mysql_query("SELECT * FROM l_accounts WHERE `account_id` = '$account_id' LIMIT 1", $this->db_link);
		$account = mysql_fetch_assoc($query);
		return $account;
	}
	
	// input: (array) $sets, (int) $account_id
	// output: (bool)
	public function update_account($sets, $account_id)
	{
		
		
		
	}
	
	// input: (string) username, (string) password
	// output: (int) $account_id, 0= invalid account
	public function auth($username, $password)
	{
		$query = mysql_query("SELECT * FROM l_accounts WHERE `loghin_id` = '$username' LIMIT 1", $this->db_link);
		if(mysql_num_rows($query) > 0)
		{
			$r = mysql_fetch_assoc($query);
			if(Hash::check($password, $r['password']))
				return (int)$r['account_id'];
		}
		
		return 0;
	}
	
	
	// input: (array)
	// output: (int) $account_id
	public function insert_account($sets = array())
	{
		$hash_pass = Hash::make($this->fields['l_accounts']['password']);
		return mysql_query("INSERT INTO l_accounts (`loghin_id`, `password`, `email`, `firstname`, `lastname`) VALUES ('".$this->fields['l_accounts']['loghin_id']."', '$hash_pass', '".$this->fields['l_accounts']['email']."', '".$this->fields['l_accounts']['firstname']."', '".$this->fields['l_accounts']['lastname']."')", $this->db_link);
	}
}
?>