<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
/**
 * Form Data Class v1.2
 *
 * Aplicatie dezvoltata pentru PHP 5.1.6 sau mai nou
 *
 * @package		AFramework
 * @subpackage	Libraries
 * @author		Adry
 * @link		
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/**
 * Required Validator Class
 */

class Form_data
{
	private $POST;// array(field_name => valoare_din_$_POST)
	private $SESS;// array(field_name => valoare_din_sesiune)
	private $DB;// array(field_name => valoare_din_db)
	private $rules;// array(field_name => array(regula, regula))
	private $labels;// array(field_name => label)
	private $status;// array(field_name => bool)// FALSE - campul are eroare, TRUE - este corect, NULL - stare normala
	private $sess_key;// string - cheia de sesiune
	private $errors = array();// array(field_name => string_eroare)
	private $successful = 0;// 0-no successful, 1-successful, 2-successful urmat de refresh
	//
	// ========================================================================
	public function __construct($sess_key = 'default')
	{
		// daca #sess_key == NULL nu se vor putea folosi optiunile de sessiune
		$this->POST = array();
		$this->POST = $_POST;
		$this->DB = array();
		$this->sess_key = $sess_key;
		
		// initiaza variabila de sesiune antirefresh
		if(!isset($_SESSION[SESSION]['antirefresh']))
			$_SESSION[SESSION]['antirefresh'] = 1;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	void
	 * @return	int
	 */
	public function antirefresh()
	{
		return $_SESSION[SESSION]['antirefresh'];
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	void
	 * @return	bool
	 */
	public function check_antirefresh()
	{
		return (isset($_POST['antirefresh']) && ($_POST['antirefresh'] != $_SESSION[SESSION]['antirefresh'])) ? false : true;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	int
	 * @return	void
	 */
	public function set_successful($int)
	{
		$this->successful = (int)$int;
		
		if($int == 1)
			$_SESSION[SESSION]['antirefresh']++;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	bool
	 * @return	void
	 */
	public function get_successful()
	{
		return $this->successful;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
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
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string, string
	 * @return	void
	 */
	public function force_set($key, $value)
	{
		$this->POST[$key] = $value;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string, string, string, string, string
	 * @return	void
	 */
	public function set_var($field_name, $label, $default = NULL, $filters = NULL, $rules = NULL)
	{
		// daca $field_name numele campului din formular
		// daca $filters filtre specificate (filtrele se scriu despartite de | sub forma de string)
		// daca $rules reguli de validare (regulile se scriu despartite de | sub forma de string)
		
		// setare valoare implicita
		if(!isset($this->POST[$field_name]))
			$this->POST[$field_name] = $default;
		
		// aplicarea filtrelor
		if($filters)
		{
			$array = explode('|', $filters);
			foreach($array as $exec)
			{
				switch($exec)
				{
					case'trim':
						$this->POST[$field_name] = trim($this->POST[$field_name]);
						break;
					case'strip_tags':
						$this->POST[$field_name] = strip_tags($this->POST[$field_name]);
						break;
					case'htmlentities':
						$this->POST[$field_name] = htmlentities($this->POST[$field_name]);
						break;
					case'intval':
						$this->POST[$field_name] = intval($this->POST[$field_name]);
						break;
					case'strtoupper':
						$this->POST[$field_name] = strtoupper($this->POST[$field_name]);
						break;
					case'strtolower':
						$this->POST[$field_name] = strtolower($this->POST[$field_name]);
						break;
					case'clean':
						$this->POST[$field_name] = preg_replace("/[^a-zA-Z0-9\s_\-]/", "", $this->POST[$field_name]);
						break;
					case'alnumspace':
						$this->POST[$field_name] = preg_replace("/[^a-zA-Z0-9\s]/", "", $this->POST[$field_name]);
						break;
					case'alnum':
						$this->POST[$field_name] = preg_replace("/[^a-zA-Z0-9]/", "", $this->POST[$field_name]);
						break;
				}
			}
		}
		
		// salvare label
		$this->labels[$field_name] = $label;
		
		// salvare reguli
		$this->rules[$field_name] = array();
		if($rules)// daca s-au defnit reguli
		{
			$array = explode('|', $rules);
			foreach($array as $rule)
				$this->rules[$field_name][] = $rule;// salveaza regula
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string, string
	 * @return	string
	 */
	public function get_var($key = NULL, $priority = 'post', $safety_print = FALSE)
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
			
			// converteste caracterele speciale pentru a afisa in siguranta valoarea
			if($safety_print)
				$return_value = str_replace(array("'", '"', '<', '>'), array("&#39;", "&quot;", '&lt;', '&gt;'), stripslashes($return_value));
			
			// returneaza valoarea
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
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string, string
	 * @return	string
	 */
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
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string, string
	 * @return	void
	 */
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
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function destroy()
	{
		unset($_SESSION[SESSION][$this->sess_key]);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required Validator class
	 *
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function validation()
	{
		// parcurge toate campurile
		foreach($this->rules as $field_name => $rules)
		{
			// initializam statusul
			$this->status[$field_name] = true;
			
			// in cazul in care campul este gol si nu exista regula required in lista cu reguli
			if(empty($this->POST[$field_name]) && !in_array('required', $rules))
				continue;// nu are ce verifica asa ca trece la urmatorul camp
			
			
			// pargurge toare regulile
			foreach($rules as $rule)
			{
				if($err = Validator::check($this->POST[$field_name], $rule))// returneaza NULL daca este valid
				{
					// stocheaza eroarea
					$this->errors[$field_name] = sprintf($err, '<strong>'.$this->labels[$field_name].'</strong>');
					
					// modifica statusul
					$this->status[$field_name] = false;
					
					break;// nu mai continua cu celelate reguli ale acestul camp
				}
			}
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string
	 * @return	bool or null
	 */
	public function get_status($field_name)
	{
		return (array_key_exists($field_name, $this->status)) ? (bool)$this->status[$field_name] : NULL;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string, string
	 * @return	void
	 */
	public function set_error($field_name, $error_string)
	{
		$this->errors[$field_name] = $error_string;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function get_error($field_name)
	{
		return (array_key_exists($field_name, $this->errors)) ? (string)$this->errors[$field_name] : FALSE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * Required -
	 *
	 * @access	public
	 * @param	void
	 * @return	array
	 */
	public function errors()
	{
		return $this->errors;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * In cazul in care valoarea campului corespunde cu valoarea parametrului 2
	 * va fi returnat stringul ' checked="checked"'
	 *
	 * Required -
	 *
	 * @access	public
	 * @param	string or array, string
	 * @return	string
	 */
	public function is_checked($field_name, $value)
	{
		// verifica daca elementul este array
		if(is_array($this->POST[$field_name]))
			$cond = (in_array($value, $this->POST[$field_name]));
		else
			$cond = ($this->POST[$field_name] == $value);
		
		return ($cond);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * In cazul in care valoarea campului corespunde cu valoarea parametrului 2
	 * va fi returnat stringul ' checked="checked"'
	 *
	 * Required -
	 *
	 * @access	public
	 * @param	string or array, string
	 * @return	string
	 */
	public function checked($field_name, $value)
	{
		return ($this->is_checked($field_name, $value)) ? ' checked="checked"' : NULL;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	/**
	 * In cazul in care valoarea campului corespunde cu valoarea parametrului 2
	 * va fi returnat stringul ' selected="selected"'
	 *
	 * Required -
	 *
	 * @access	public
	 * @param	string, string
	 * @return	string
	 */
	public function selected($field_name, $value)
	{
		return ($this->is_checked($field_name, $value)) ? ' selected="selected"' : NULL;
	}
	// ========================================================================
}
// END safe_post class

/* End of file Form_data.php */
/* Location: ./system/libraries/Form_data.php */