<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../../module/e_403.php"));
}
//
//
//
//
class safe_auth
{
	private $key_sess;
	public  $username;    // valoare POST
	public  $password;    // valoare POST
	private $antirefresh; // valoare POST
	private $antilocal;   // valoare POST
	private $captcha;     // valoare POST
	private $lang;
	private $errors;
	//
	// ========================================================================
	public function __construct($key_sess = 'auth')
	{
		$this->key_sess = $key_sess;
		$this->lang		= array();
		$this->errors	= array();
		
		if(!isset($_SESSION[SESSION][$this->key_sess]['antirefresh']))
			$_SESSION[SESSION][$this->key_sess]['antirefresh'] = 0;
		if(!isset($_SESSION[SESSION][$this->key_sess]['antilocal']))
			$_SESSION[SESSION][$this->key_sess]['antilocal'] = NULL;
		if(!isset($_SESSION[SESSION][$this->key_sess]['attempts']))
			$_SESSION[SESSION][$this->key_sess]['attempts'] = 0;
		
		$this->antirefresh = NULL;
		$this->antilocal   = NULL;
		$this->captcha     = NULL;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function __destruct()
	{
		
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function antirefresh($action)
	{
		// $action == 'update' --[return]--> void (doar modifica valoarea lui $antirefresh)
		// $action == 'return' --[return]--> valoarea lui $antirefresh
		// $action == 'check'  --[return]--> bool 
		//
		switch($action)
		{
			case 'update':
				$_SESSION[SESSION][$this->key_sess]['antirefresh']++;
				break;
			case 'return':
				return $_SESSION[SESSION][$this->key_sess]['antirefresh'];
				break;
			case 'check':
				return ($this->antirefresh != $_SESSION[SESSION][$this->key_sess]['antirefresh']) ? true : false;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function attempts($action)
	{
		// $action == 'increment' --[execute]--> va incrementa numarul de incercari
		// $action == 'return'    --[execute]--> va returna numarul de incercari curente
		//
		switch($action)
		{
			case 'update':
				$_SESSION[SESSION][$this->key_sess]['attempts']++;
				break;
			case 'return':
				return $_SESSION[SESSION][$this->key_sess]['attempts'];
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function antilocal($action)
	{
		// $action == 'update' --[execute]--> void (doar modifica valoarea lui $antirefresh)
		// $action == 'return' --[execute]--> valoarea lui $antirefresh
		// $action == 'check'  --[execute]--> va returna true daca s-a trimis de pe alt server
		//
		switch($action)
		{
			case 'update':
				$_SESSION[SESSION][$this->key_sess]['antilocal']++;
				break;
			case 'return':
				return $_SESSION[SESSION][$this->key_sess]['antilocal'];
				break;
			case 'check':
				return ($this->antilocal != $_SESSION[SESSION][$this->key_sess]['antilocal']) ? true : false;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_lang($lang_array)
	{
		if(is_array($lang_array))
		{
			foreach($lang_array as $key=>$value)
				$this->lang[$key] = $value;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function default_lang($key)
	{
		$default_lang = array(
			1 => 'Nu ai scris numele.',
			2 => 'Nu ai scris parola.',
			3 => 'Numele contine caractere invalide.',
			4 => 'Parola contine caractere invalide.',
			5 => 'Nu puteti trimite datele de pe alt server.',
			6 => 'Nu mai dati refresh!',
			7 => 'Numarul de incercari a fost depasit.',
			8 => 'Codul de securitate este incorect.',
			
		);
		return (isset($default_lang[$key])) ? $default_lang[$key] : NULL;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function check($username, $password, $antirefresh = NULL, $antilocal = NULL, $captcha = NULL, $attempts_limit = 5)
	{
		// Protectie MySQL injection
		$this->username = mysql_real_escape_string(stripslashes(trim($username)));
		$this->password = mysql_real_escape_string(stripslashes(trim($password)));
		// codul antirefresh poate contine doar numere intregi
		if($antirefresh)
			$this->antirefresh = intval($antirefresh);
		// codul de securitate poate contine doar numere intregi si litere
		if($captcha && ctype_alnum($captcha))
			$captcha = preg_replace("/[^a-zA-Z0-9\s]/", "", $captcha);
		// antilocal
		$this->antilocal = $antilocal;
		
		if(empty($this->username))
			$this->errors[] = (isset($this->lang[1])) ? $this->lang[1] : $this->default_lang(1);
		if(empty($this->password))
			$this->errors[] = (isset($this->lang[2])) ? $this->lang[2] : $this->default_lang(2);
		if(empty($this->username))
			$this->errors[] = (isset($this->lang[3])) ? $this->lang[3] : $this->default_lang(3);
		if(empty($this->password))
			$this->errors[] = (isset($this->lang[4])) ? $this->lang[4] : $this->default_lang(4);
		if($this->antilocal('check'))
			$this->errors[] = (isset($this->lang[5])) ? $this->lang[5] : $this->default_lang(5);
		if($this->antirefresh('check'))
			$this->errors[] = (isset($this->lang[6])) ? $this->lang[6] : $this->default_lang(6);
		if($_SESSION[SESSION][$this->key_sess]['attempts'] > $attempts_limit)
			$this->errors[] = (isset($this->lang[7])) ? $this->lang[7] : $this->default_lang(7);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function errors($action = NULL)
	{
		switch($action)
		{
			case 'count':
				return count($this->errors);
				break;
			default:
				return $this->errors;
				break;
		}
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/safe_auth.html
/*
Exemplu:

$lang = array(
	1 => '',
	2 => '',
	3 => '',
	4 => '',
	5 => '',
	6 => '',
	7 => '',
	8 => ''
);

$

*/
?>