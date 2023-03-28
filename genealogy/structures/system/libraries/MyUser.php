<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
//print_r($_COOKIE);
class MyUser
{
	private $db_info;		// sintax: $info[table][field];
	private $acc_api;		// Accounts_API reference
	private $input;			// Input class
	
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
		
		// Input Class
		global $Input;
		$this->input = &$Input;
		
		// db data array initialize
		$this->db_info		= array();
		
		// user info initialize
		$this->account_id	= 0;
		$this->loghin_id	= 0;
		$this->firstname	= '';
		$this->lastname		= '';
		$this->email		= '';
		
		// autologin
		if(!$this->logged())
			$this->autologin();
		
		// refersh object
		$this->refresh();
		
		log_message('cookie_value', '"'.$this->input->cookie('loghin_account').'"');
		//echo '='.$this->input->cookie('loghin_account');
	}
	// ========================================================================
	public function refresh()
	{
		$this->account_id = $_SESSION[SESSION]['user']['id'];
		
		// only if logged in
		if($this->logged())
		{
			$this->db_info['accounts'] = array();
			$this->db_info['accounts'] = $this->acc_api->get_account($this->account_id);
			
			$this->loghin_id	= $this->get_db('accounts', 'loghin_id', 0);
			$this->firstname	= $this->get_db('accounts', 'firstname', '');
			$this->lastname		= $this->get_db('accounts', 'lastname', '');
			$this->email		= $this->get_db('accounts', 'email', '');
			//print $this->account_id;
			
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
	
	// ========================================================================
	//
	//
	// ========================================================================
	public function autologin()
	{
		// verifica cookie
		/*if($this->input->cookie('loghin_com_accounts') != NULL) {
			$sess_hash  = preg_replace("/[^A-Za-z0-9 ]/", '', $this->input->cookie('loghin_com_accounts'));// parse session hash
			if($account_id = $this->acc_api->session_check($sess_hash, $this->input->ip_address())) {// check session hash
				$_SESSION[SESSION]['user']['id'] = (int)$account_id;// save account_id (login)
			}
		}*/
		/* Check if there is someone loggedin from register.loghin.com */
		if (NULL != ($sessdata = $this->input->cookie('sessdata')))
		{
			$sessdata = @unserialize(base64_decode($sessdata));
			if(is_array($sessdata) && isset($sessdata['account_id']) && isset($sessdata['hash']))
				$_SESSION[SESSION]['user']['id'] = $this->acc_api->session_check($sessdata['hash'], null, $sessdata['account_id']);
		}
		elseif($this->logged())
			$this->sign_out();
	}
	
	
	// input: (string) $user, (string) $pass
	// output: (bool)
	public function sign_in($user, $pass)
	{
		if($account_id = $this->acc_api->auth($user, $pass))
		{
			$_SESSION[SESSION]['user']['id'] = (int)$account_id;
			
			// set cookie
			//$this->input->set_cookie('loghin_com_accounts', session_id(), time() + 6000);
			$this->input->set_cookie('sessdata', base64_encode(serialize(array('account_id' => (int)$account_id, 'hash' => $this->acc_api->get_sessionhash($account_id)))), time() + 6000, 'loghin.com');
			//log_message('sign_in after_set_cookie', '"'.$this->input->cookie('loghin_account').'"');
			$this->acc_api->set_session($this->account_id, session_id(), $this->input->ip_address());
			//log_message('set_session', '"'.$this->account_id.', '.session_id().', '.$this->input->ip_address().'"');
			
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
		$this->input->set_cookie('loghin_com_accounts');// delete cookie
		$this->input->set_cookie('sessdata');// delete register.loghin.com cookie
		//$this->refresh();// unnecessary now
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function logged()
	{
		return ($_SESSION[SESSION]['user']['id'] != 0) ? true : false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function account_id()
	{
		return $this->account_id;
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
	public function get_profile_name()	{ return (!$this->firstname && !$this->lastname) ? $this->loghin_id : $this->firstname.' '.$this->lastname; }
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
/* Location: ./system/libraries/MyUser.php */?>