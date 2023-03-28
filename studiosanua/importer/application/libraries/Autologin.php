<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Autologin
{	
	protected $CI;
	private $db_link;
	
	 // We'll use a constructor, as you can't directly call a function
	// from a property definition.
	public function __construct()
	{
			// Assign the CodeIgniter super-object
			$this->CI =& get_instance();
	}
	
	// ========================================================================================================
	public function autologin()
	{
		/* Check if there is someone loggedin from register.loghin.com */
		$token = NULL;
		if (NULL != get_cookie('sessdata'))
		{
			$token = get_cookie('sessdata');
		}
		else if(NULL != $this->CI->session->userdata('autologin_token'))
		{
			$token = $this->CI->session->userdata('autologin_token');
		}
		
		if (NULL != ($sessdata = $token))
		{
			$sessdata = @unserialize(base64_decode($sessdata));
			if(is_array($sessdata) && isset($sessdata['account_id']) && isset($sessdata['hash']))
			{
				return $this->session_check($sessdata['hash'], NULL, $sessdata['account_id']);
			}
		}
		
//		elseif($this->logged())
//		{
//			$this->sign_out();
//		}

		return 0;
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (string) $sess_hash, (string) $ip_address
	// output: (int) $account_id
	public function session_check($sesshash, $ip_address = NULL, $id = NULL)
	{
		// the TRUE paramater tells CI that you'd like to return the database object.
		$loghin_register = $this->CI->load->database('loghin_register', TRUE); 
		
		$loghin_register->select('account_id');
		$loghin_register->limit(1);
		$loghin_register->where('sessionhash', $sesshash);
		if ($id != NULL) {
			$loghin_register->where('account_id', $id);
		}
		else {
			$loghin_register->where('ip', $ip_address);
		}
		
		$query = $loghin_register->get('accounts');
		if ($query->num_rows()==1) {
			return $query->row()->account_id;
		}
		
		return 0;
		
		
		
		
		$account = array();
		$query   = mysql_query("SELECT `account_id` FROM l_accounts WHERE `sessionhash` = '$sesshash' AND ". ($id != NULL ? "`account_id` = '". $id ."'" : "`ip` = '$ip_address'") ." LIMIT 1", $this->db_link);

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
		return (bool)mysql_query("UPDATE `l_accounts` SET `sessionhash` = '$sesshash', `ip` = '$ip_address' WHERE `account_id` = '$account_id' LIMIT 1", $this->db_link);
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (int) $account_id, (string) $sess_hash, (string) $ip_address
	// output: (bool) 
	public function get_sessionhash($account_id)
	{
		$query = mysql_query("SELECT `sessionhash` FROM `l_accounts` WHERE `account_id` = '$account_id' LIMIT 1", $this->db_link);
		$account = mysql_fetch_assoc($query);
		return $account['sessionhash'];
	}
	// ========================================================================================================
	
	
	// ========================================================================================================
	// input: (string) username, (string) password
	// output: (int) $account_id, 0= invalid account
	public function auth($username, $password)
	{
		$this->CI->load->helper('Rhash');
		
		$query = mysql_query("SELECT * FROM l_accounts WHERE `loghin_id` = '$username' LIMIT 1", $this->db_link);
		if(mysql_num_rows($query) > 0)
		{
			$r = mysql_fetch_assoc($query);
			if($this->rhash->check($password, $r['password']))
				return (int)$r['account_id'];
		}
		
		return 0;
	}
	// ========================================================================================================
}