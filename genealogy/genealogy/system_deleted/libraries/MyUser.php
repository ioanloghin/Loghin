<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

class MyUser
{
	private $db_info;		// sintax: $info[table][field];
	private $acc_api;		// Accounts_API reference
	
	private $account_id;	// important!
	private $loghin_id;
	private $firstname;
	private $lastname;
	private $email;
	//
	// ========================================================================
	public function __construct()
	{
		// user session initialize
		if(!isset($_SESSION[SESSION]['user']['id']))
			$_SESSION[SESSION]['user']['id'] = 0;
		
		// Accounts_API initialize
		$this->acc_api = new Accounts_API();
		
		// db data array initialize
		$this->db_info		= array();
		
		// user info initialize
		$this->account_id	= 0;
		$this->loghin_id	= 0;
		$this->firstname	= '';
		$this->lastname		= '';
		$this->email		= '';
		
		// refersh object
		$this->refresh();
	}
	// ========================================================================
	public function refresh()
	{
		$this->account_id = $_SESSION[SESSION]['user']['id'];
		
		// only if logged in
		if($this->account_id)
		{
			$this->db_info['accounts'] = array();
			$this->db_info['accounts'] = $this->acc_api->get_account($this->account_id);
			
			$this->loghin_id	= $this->get_db('accounts', 'loghin_id', 0);
			$this->firstname	= $this->get_db('accounts', 'firstname', '');
			$this->lastname		= $this->get_db('accounts', 'lastname', '');
			$this->email		= $this->get_db('accounts', 'email', '');
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function __destruct()
	{
		// do nothing :)
	}
	
	
	// input: (string) $user, (string) $pass
	// output: (bool)
	public function sign_in($user, $pass)
	{
		if($account_id = $this->acc_api->auth($user, $pass))
		{
			$_SESSION[SESSION]['user']['id'] = (int)$account_id;
			$this->refresh();
			return true;
		}
		
		return false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function sign_out()
	{
		$_SESSION[SESSION]['user']['id'] = 0;
		
		$this->refresh();
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function logged()
	{
		return ($this->account_id) ? true : false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function info($key = NULL, $default = NULL)// deprecated.
	{
		if($key)
			return (isset($this->db_info[$key])) ? $this->db_info[$key] : $default;
		else
			return $this->db_info;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_db($table, $field, $default = NULL)
	{
		if(array_key_exists($table, $this->db_info) && array_key_exists($field, $this->db_info[$table]))
			return $this->db_info[$table][$field];
		
		return $default;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_all()
	{
		return $this->db_info;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_account_id()	{ return $this->account_id; }
	public function get_loghin_id()		{ return $this->loghin_id; }
	public function get_firstname()		{ return $this->firstname; }
	public function get_lastname()		{ return $this->lastname; }
	public function get_email()			{ return $this->email; }
	// ========================================================================
	// FUNCTII ADITIONALE SPECIFICE FIECARUI PROIECT IN PARTE 
	// ========================================================================
	public function span_age()
	{
		// daca nu s-a inregistrat decesul va afisa varsta in ani (25 ani)
		// in caz contrat va afisa perioana anilor (1988-2003)
		if(isset($this->info[DBT_USER_INFO_C6]) && isset($this->info[DBT_USER_INFO_C7]))
		{
			if(($this->info[DBT_USER_INFO_C6]) && ($this->info[DBT_USER_INFO_C6] != '0000-00-00') && ($this->info[DBT_USER_INFO_C7]) && ($this->info[DBT_USER_INFO_C7] != '0000-00-00'))
				return DataTime::format($this->info[DBT_USER_INFO_C6], 'Y').' - '.DataTime::format($this->info[DBT_USER_INFO_C7], 'Y');
			else
			if(($this->info[DBT_USER_INFO_C6]) && ($this->info[DBT_USER_INFO_C6] != '0000-00-00'))
				return DataTime::age($this->info[DBT_USER_INFO_C6]).' ani';
		}
		else
			return NULL;
	}
	// ========================================================================
}
// END Controller class

/* End of file MyUser.php */
/* Location: ./system/libraries/MyUser.php */