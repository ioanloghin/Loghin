<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class safe_get
{
	private $GET;
	//
	// ========================================================================
	public function __construct()
	{
		$this->GET = array();
		$this->GET = $_GET;
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
			foreach($this->GET as $row_key => $row_value)
				$set_array[] = $row_key;
		}
		
		foreach($set_array as $row_key)
		{
			if(!isset($this->GET[$row_key]))
				$this->GET[$row_key] = $default;
			
			if($filter)
			{
				$exp = explode('|', $filter);
				foreach($exp as $exec)
				{
					switch($exec)
					{
						case'trim':
							$this->GET[$row_key] = trim($this->GET[$row_key]);
							break;
						case'strip_tags':
							$this->GET[$row_key] = strip_tags($this->GET[$row_key]);
							break;
						case'htmlentities':
							$this->GET[$row_key] = htmlentities($this->GET[$row_key]);
							break;
						case'intval':
							$this->GET[$row_key] = intval($this->GET[$row_key]);
							break;
						case'strtoupper':
							$this->GET[$row_key] = strtoupper($this->GET[$row_key]);
							break;
						case'strtolower':
							$this->GET[$row_key] = strtolower($this->GET[$row_key]);
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
	public function get_var($key = NULL, $force = FALSE)
	{
		// daca $key != NULL va fi returnata doar variabila $this->GET[$key]
		// daca $key == NULL va fi returnat un array cu toate variabilele din $this->GET
		// daca $force == TRUE va fi returnat valoarea default setata chiar daca $_GET[$key] nu este exista
		//
		if($key)
		{
			return ((isset($_GET[$key]) || $force) && isset($this->GET[$key])) ? $this->GET[$key] : ((is_numeric($this->GET[$key])) ? 0 : NULL);
		}
		else
		{
			$get_array = array();
			foreach($this->GET as $row_key => $row_value)
				$get_array[$row_key] = $this->GET[$row_key];
			
			return $get_array;
		}
	}
	// ========================================================================
}
// END safe_get class

/* End of file Safe_get.php */
/* Location: ./libraries/Safe_get.php */