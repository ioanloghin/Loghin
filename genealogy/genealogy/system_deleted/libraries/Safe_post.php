<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class safe_post
{
	private $POST;
	private $SESS;
	private $DB;
	private $sess_key;
	//
	// ========================================================================
	public function __construct($sess_key = NULL)
	{
		// daca #sess_key == NULL nu se vor putea folosi optiunile de sessiune
		$this->POST = array();
		$this->POST = $_POST;
		$this->DB = array();
		$this->sess_key = $sess_key;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_db($sets)
	{
		if(is_array($sets))
		{
			foreach($sets as $key => $value)
				$this->DB[$key] = $value;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function force_set($key, $value)
	{
		$this->POST[$key] = $value;
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
			foreach($this->POST as $row_key => $row_value)
				$set_array[] = $row_key;
		}
		
		foreach($set_array as $row_key)
		{
			if(!isset($this->POST[$row_key]))
				$this->POST[$row_key] = $default;
			
			if($filter)
			{
				$exp = explode('|', $filter);
				foreach($exp as $exec)
				{
					switch($exec)
					{
						case'trim':
							$this->POST[$row_key] = trim($this->POST[$row_key]);
							break;
						case'strip_tags':
							$this->POST[$row_key] = strip_tags($this->POST[$row_key]);
							break;
						case'htmlentities':
							$this->POST[$row_key] = htmlentities($this->POST[$row_key]);
							break;
						case'intval':
							$this->POST[$row_key] = intval($this->POST[$row_key]);
							break;
						case'strtoupper':
							$this->POST[$row_key] = strtoupper($this->POST[$row_key]);
							break;
						case'strtolower':
							$this->POST[$row_key] = strtolower($this->POST[$row_key]);
							break;
						case'clean':
							$this->POST[$row_key] = preg_replace("/[^a-zA-Z0-9\s_\-]/", "", $this->POST[$row_key]);
							break;
						case'alnumspace':
							$this->POST[$row_key] = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->POST[$row_key]);
							break;
						case'alnum':
							$this->POST[$row_key] = preg_replace("/[^a-zA-Z0-9]/", "", $this->POST[$row_key]);
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
	public function get_var($key = NULL, $priority = 'post')
	{
		// daca $key != NULL va fi returnata doar variabila $this->POST[$key]
		// daca $key == NULL va fi returnat un array cu toate variabilele din $this->POST
		// $priority poate lua valorile 'post|sess|db', despartite de | scrise in ordinea prioritatii 
		//
		if($key)
		{
			$return_value = NULL;
			$exp = explode("|", $priority);
			foreach($exp as $type)
			{
				switch($type)
				{
					case 'post':
						if($return_value == NULL)
							$return_value = (isset($_POST[$key]) && isset($this->POST[$key])) ? $this->POST[$key] : NULL;
						break;
					case 'sess':
						if($return_value == NULL)
							$return_value = ($this->sess_key) ? $this->get_sess($key) : NULL;
						break;
					case 'db':
						if($return_value == NULL)
							$return_value = (isset($this->DB[$key])) ? $this->DB[$key] : NULL;
						break;
				}
			}
			return $return_value;
		}
		else
		{
			$get_array = array();
			foreach($this->POST as $row_key => $row_value)
				$get_array[$row_key] = $this->POST[$row_key];
			
			return $get_array;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_sess($key = NULL, $default = NULL)
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
// END safe_post class

/* End of file Safe_post.php */
/* Location: ./libraries/Safe_post.php */