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
class safe_session
{
	private $SESS;
	private $sess_key;
	//
	// ========================================================================
	public function __construct($sess_key)
	{
		$this->sess_key = $sess_key;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_var($key = NULL, $default = NULL, $filter = NULL)
	{
		// daca $key != NULL se va seta doar variabila $this->POST[$key]
		// daca $key == NULL se vor seta toate variabilele din $this->POST
		// daca $filter != NULL se vor aplica filtrele specificate (filtrele se scriu despartite de | sub forma de string)
		// daca $filter == NULL nu se vor aplica filtre
		//
		$set_array = array();
		if($key)
			$set_array[] = $key;
		else
		{
			foreach($this->SESS as $row_key => $row_value)
				$set_array[] = $row_key;
		}
		
		foreach($set_array as $row_key)
		{
			if(!isset($this->SESS[$row_key]))
				$this->SESS[$row_key] = $default;
			
			if($filter)
			{
				$exp = explode('|', $filter);
				foreach($exp as $exec)
				{
					switch($exec)
					{
						case'trim':
							$this->SESS[$row_key] = trim($this->POST[$row_key]);
							break;
						case'strip_tags':
							$this->SESS[$row_key] = strip_tags($this->POST[$row_key]);
							break;
						case'htmlentities':
							$this->SESS[$row_key] = htmlentities($this->POST[$row_key]);
							break;
						case'intval':
							$this->SESS[$row_key] = intval($this->POST[$row_key]);
							break;
						case'strtoupper':
							$this->SESS[$row_key] = strtoupper($this->POST[$row_key]);
							break;
						case'strtolower':
							$this->SESS[$row_key] = strtolower($this->POST[$row_key]);
							break;
					}
				}
			}
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_var($key = NULL, $default = NULL)
	{
		// daca $key != NULL va fi returnata doar variabila $_SESSION[SESSION][$this->sess_key][$key]
		// daca $key == NULL va fi returnat un array cu toate variabilele din $_SESSION[SESSION][$this->sess_key]
		//
		if(!$this->sess_key)
			return NULL;
		
		if($key)
			return (isset($_SESSION[SESSION][$this->sess_key][$key])) ? $_SESSION[SESSION][$this->sess_key][$key] : NULL;
		else
		{
			$sess_array = array();
			foreach($_SESSION[SESSION][$this->sess_key] as $row_key => $row_value)
				$sess_array[$row_key] = $_SESSION[SESSION][$this->sess_key][$row_key];
			
			return $sess_array;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function copy_in_sess($key = NULL, $default = NULL)
	{
		// daca $key != NULL se va copia in sessiune doar variabila $this->POST[$key]
		// daca $key == NULL se vor copia in sessiune toate variabilele din $this->POST
		//
		if($this->sess_key)
		{
			if(!isset($_SESSION[SESSION][$this->sess_key])) $_SESSION[SESSION][$this->sess_key] = array();
		}
		
		if($key)
			$_SESSION[SESSION][$this->sess_key][$key] = (isset($this->POST[$key])) ? $this->POST[$key] : $default;
		else
		{
			foreach($this->POST as $row_key => $row_value)
				$_SESSION[SESSION][$this->sess_key][$row_key] = $this->POST[$row_key];
		}
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/safe_session.html
?>