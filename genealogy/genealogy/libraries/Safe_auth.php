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
	private $id;		  // (integer) daca datele sunt corecte, vom salva id-ul userului spre al returna
	public  $username;    // (string) valoare POST
	public  $password;    // (string) valoare POST
	private $antirefresh; // (integer) valoare POST
	private $antilocal;   // (string) valoare POST
	private $captcha;     // (string) valoare POST
	private $db_info;	  // (array) informatii despre tabelul si campurile din baza de date
	private $lang;
	private $error;		  // (string) eroarea pentru care nu s-a putut realiza logarea
	//
	// ========================================================================
	public function __construct($key_sess = 'auth')
	{
		$this->id		= 0;
		$this->key_sess = $key_sess;
		$this->lang		= array();
		$this->error	= NULL;
		// daca col_email este NULL, autentificarea cu ajutorul email-ului nu se va mai realiza
		$this->db_info = array('table' => 'gen_users', 'col_id' => 'UserID', 'col_usr' => 'Username', 'col_email' => '', 'col_psw' => 'Password');
		
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
	public function id()
	{
		return $this->id;
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
			9 => 'Datele introduse nu sunt corecte'
			
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
		$this->password = trim($password);
		// codul antirefresh poate contine doar numere intregi
		if($antirefresh)
			$this->antirefresh = intval($antirefresh);
		// codul de securitate poate contine doar numere intregi si litere
		if($captcha && ctype_alnum($captcha))
			$captcha = preg_replace("/[^a-zA-Z0-9\s]/", "", $captcha);
		// antilocal
		$this->antilocal = $antilocal;
		
		if(empty($this->username))
			$this->error = (isset($this->lang[1])) ? $this->lang[1] : $this->default_lang(1);
		else
		if($this->username != $username)
			$this->error = (isset($this->lang[3])) ? $this->lang[3] : $this->default_lang(3);
		else
		if(empty($this->password))
			$this->error = (isset($this->lang[2])) ? $this->lang[2] : $this->default_lang(2);
		else
		if($this->antilocal('check'))
			$this->error = (isset($this->lang[5])) ? $this->lang[5] : $this->default_lang(5);
		else
		if($this->antirefresh('check'))
			$this->error = (isset($this->lang[6])) ? $this->lang[6] : $this->default_lang(6);
		else
		if($_SESSION[SESSION][$this->key_sess]['attempts'] > $attempts_limit)
			$this->error = (isset($this->lang[7])) ? $this->lang[7] : $this->default_lang(7);
		else
		{
			// se poate loga atat cu username cat si cu email
			// daca stringul user se potriveste ca forma cu o adresa de email setam pe logare prin email
			if($this->db_info['col_email'] && preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])'.'(([a-z0-9-])*([a-z0-9]))+'.'(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', $this->username))
				$field = $this->db_info['col_email'];
			// in caz contrat incercam logarea cu username
			else
				$field = $this->db_info['col_usr'];
			// selectam id-ul si parola
			$temp = SQL_DB::sql_select($this->db_info['table'], "`$field` = '".$this->username."'", NULL, 0, 1, array($this->db_info['col_id'], $this->db_info['col_psw']));
			// verificam daca parola se potriveste
			// parola este formata din caracterele 22-30 ale codului md5; substr(md5('password'), 22, 8)
			if(isset($temp[1][$this->db_info['col_psw']]) && $temp[1][$this->db_info['col_psw']] == substr(md5($this->password), 22, 8))
				$this->id = $temp[1][$this->db_info['col_id']];
			else
				$this->error = (isset($this->lang[9])) ? $this->lang[9] : $this->default_lang(9);
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function error()
	{
		return $this->error;
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