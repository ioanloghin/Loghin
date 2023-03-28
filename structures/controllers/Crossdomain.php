<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Crossdomain extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function login()
	{
		$rawurl = isset($_GET['ref']) ? $_GET['ref'] : NULL;
		$url = rawurldecode($rawurl);
		
		$sessdata = isset($_COOKIE['sessdata']) ? $_COOKIE['sessdata'] : NULL;
		
		//var_export($url);
		//var_export($_COOKIE);
		
		$url = rtrim($url, '/');
		$url .= '/'.rawurlencode($sessdata);
		
		header('Location: '.$url);
	}
	
	public function remote_login()
	{
		global $MyUser;
		
		$username_base64 = isset($_GET['u']) ? $_GET['u'] : NULL;
		$password_base64 = isset($_GET['p']) ? $_GET['p'] : NULL;
		
		$username = base64_decode($username_base64);
		$password = base64_decode($password_base64);
		
		$rawurl = isset($_GET['ref']) ? $_GET['ref'] : NULL;
		$url = rawurldecode($rawurl);
		
		$sessdata = 0;
		if($MyUser->sign_in($username, $password))
		{
			$sessdata = isset($_COOKIE['sessdata']) ? $_COOKIE['sessdata'] : NULL;
		}
		if (empty($sessdata)) {
			$sessdata = 0;
		}
		
		$url = rtrim($url, '/');
		$url .= '/'.rawurlencode($sessdata);
		
		header('Location: '.$url);
	}
	
	public function remote_logout()
	{
		global $MyUser;
		$MyUser->sign_out();
		
		$rawurl = isset($_GET['ref']) ? $_GET['ref'] : NULL;
		$url = rawurldecode($rawurl);
		
		header('Location: '.$url);
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */