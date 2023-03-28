<?php  if (!defined('SYS_PATH')) exit('No direct script access allowed');

class CI_SESS
{
	// set data
	public function set_userdata($data) {
		if(!is_array($data)) {
			return false;
		}
		foreach($data as $key => $val) {
			$_SESSION[$key] =$val;
		}
	}
	
	// get data
	public function userdata($key) {
		return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : NULL;
	}
	
	public function unset_userdata($key) {
		if(array_key_exists($key, $_SESSION)) {
			unset($_SESSION[$key]);
		}
	}
}
//
//
// END CI_SESS class

/* End of file CI_SESS.php */
/* Location: ./libraries/CI_SESS.php */