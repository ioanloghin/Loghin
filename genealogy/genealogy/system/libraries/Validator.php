<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
/**
 * Validator Class v1.1
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
 * Required ./system/language/[en|ro]/validator.php
 */

class Validator
{
	// --------------------------------------------------------------------
	/**
	 * Required
	 *
	 * @access	public
	 * @param	string, string
	 * @return	void
	 */
	static function check($value, $rule)
	{
		// pregateste datele in cazul in care se cere o regula cu parametrii
		$params = array($value);
		if(strpos($rule, '[') !== FALSE && preg_match_all('/^(?P<rule>[A-Za-z0-9_]+)\[(?P<params>.*?)\]$/', $rule, $matches))
		{
			if(isset($matches['rule'][0]))
			{
				$rule = $matches['rule'][0];
				if(isset($matches['params'][0]))
				{
					$array = explode(',', $matches['params'][0]);
					foreach($array as $param)
						$params[] = (ctype_digit($param)) ? (int)$param : $param;
				}
			}
		}
		
		
		
		// verifica daca exista functia ceruta
		$handler = array('Validator', $rule);
		if(is_callable($handler))
		{
			// apeleaza functia
			if(!call_user_func_array($handler, $params))// daca validarea returneaza FALSE
				return self::get_error($rule, $params);
		}
		else
		{
			// Afisam eroarea
			print "Eroare la Validator::check(). Ceva nu este corect la apelul functiei: $rule(";
			$i=0;
			foreach($params as $param)
				print (($i++) ? ', ' : '').$param;
			print "). Consultati regulile de mai jos:<br />";
			self::help(TRUE);
		}
	}
	// --------------------------------------------------------------------
	//
	//
	// --------------------------------------------------------------------
	static function help($print = FALSE)
	{
		$html = "<br /><pre>
	// Rule                 - Parameter - Description                                                                       - Example
	//                      -     -                                                                                         -
	// required             - Nu  - Returns FALSE daca elementul este gol.                                                  -
	// matches              - Da  - Returns FALSE if the form element does not match the one in the parameter.              - matches[form_item]
	// min_length           - Da  - Returns FALSE if the form element is shorter then the parameter value.                  - min_length[6]
	// max_length           - Da  - Returns FALSE if the form element is longer then the parameter value.                   - max_length[12]
	// exact_length         - Da  - Returns FALSE if the form element is not exactly the parameter value.                   - exact_length[8]
	// greater_than         - Da  - Returns FALSE if the form element is less than the parameter value or not numeric.      - greater_than[8]
	// less_than            - Da  - Returns FALSE if the form element is greater than the parameter value or not numeric.   - less_than[8]
	// alpha                - Nu  - Returns FALSE if the form element contains anything other than alphabetical characters. -
	// alpha_numeric        - Nu  - Returns FALSE if the form element contains anything other than alpha-numeric characters.-
	// alpha_dash           - Nu  - Returns FALSE daca elementul contine altceva decat \"litere cifre _ - . ,\"             -
	// numeric              - Nu  - Returns FALSE if the form element contains anything other than numeric characters.      -
	// integer              - Nu  - Returns FALSE daca elementul contine altceva decat numere intregi.                      -
	// decimal              - Da  - Returns FALSE if the form element is not exactly the parameter value.                   -
	// is_natural           - Nu  - Returns FALSE daca elementul contine altceva decat nr. naturale: 0, 1, 2, 3, etc.       -
	// is_natural_no_zero   - Nu  - Returns FALSE daca elementul contine altceva decat nr. naturale nenule: 1, 2, 3, etc.   -
	// is_unique            - Da  - Returns FALSE daca elementul exista in baza de date                                     - is_unique[tabel.coloana]
	// valid_username       - No  - Returns FALSE daca elementul contine altceva decat \"litere cifre _ - si un singur .    -
	// valid_email          - No  - Returns FALSE if the form element does not contain a valid email address.               -
	// valid_emails         - No  - Returns FALSE if any value provided in a comma separated list is not a valid email.     -
	// valid_ip             - No  - Returns FALSE if the supplied IP is not valid.                                          -
	// valid_base64         - No  - Returns FALSE if the supplied string contains anything other than valid Base64 characters.-
	// enum                 - Da  - Returns FALSE daca elementul nu se afla in lista predefinita                            - enum[item1,item2,item3,...]
	// set                  - Da  - Returns FALSE daca elementul nu se afla in lista predefinita (selectare multipla)       - set[item1,item2,item3,...]
	// 
	// xss_clean            - No  - Runs the data through the XSS filtering function, described in the Input Class page.
	// prep_for_form        - No  - Converts special characters so that HTML data can be shown in a form field without breaking it.
	// prep_url             - No  - Adds \"http://\" to URLs if missing.
	// strip_image_tags     - No  - Strips the HTML from image tags leaving the raw URL.
	// encode_php_tags      - No  - Converts PHP tags to entities.</pre><br />";
		
		if($print)
			echo $html;
		else
			return $html;
	}
	// --------------------------------------------------------------------
	//
	//
	// --------------------------------------------------------------------
	/**
	 * Required
	 *
	 * @access	public
	 * @param	string, array
	 * @return	string
	 */
	private function get_error($rule, $params)
	{
		$tlang = array();
		// with ../structures for compatibility with shared mode
		include('../structures/system/language/'.lang.'/validator.php');
		if(array_key_exists($rule, $tlang))
		{
			switch($rule)
			{
				default:
				case 'required':
				case 'isset':
				case 'valid_username':
				case 'valid_email':
				case 'valid_emails':
				case 'valid_url':
				case 'valid_ip':
				case 'alpha':
				case 'alpha_numeric':
				case 'alpha_dash':
				case 'numeric':
				case 'is_numeric':
				case 'integer':
				case 'regex_match':
				case 'is_unique':
				case 'is_natural':
				case 'is_natural_no_zero':
				case 'decimal': return $tlang[$rule]; break;
				case 'min_length':
				case 'max_length':
				case 'exact_length':
				case 'matches':
				case 'less_than':
				case 'greater_than': return sprintf($tlang[$rule], '%s', (isset($params[1]) ? $params[1] : 'Undefined')); break;
			}
		}
		
		return "$rule nu are text definit pentru eroare.";
	}
	// --------------------------------------------------------------------
	//
	//
	// --------------------------------------------------------------------

	/**
	 * Required
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function required($str)
	{
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Performs a Regular Expression match test.
	 *
	 * @access	public
	 * @param	string
	 * @param	regex
	 * @return	bool
	 */
	static function regex_match($str, $regex)
	{
		if ( ! preg_match($regex, $str))
		{
			return FALSE;
		}

		return  TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	static function matches($str, $field)
	{// TODO: daca prima parola sufera modificari in urma filtrelor, nu se vor mai potrivi
		if ( ! isset($_POST[$field]))
		{
			return FALSE;
		}

		$field = $_POST[$field];

		return ($str !== $field) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	static function is_unique($str, $field)
	{
		return !SQL_DB::sql_exist($field, $str);
    }

	// --------------------------------------------------------------------

	/**
	 * Minimum Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	static function min_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) < $val) ? FALSE : TRUE;
		}

		return (strlen($str) < $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Max Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	static function max_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) > $val) ? FALSE : TRUE;
		}

		return (strlen($str) > $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Exact Length
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */
	static function exact_length($str, $val)
	{
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}

		if (function_exists('mb_strlen'))
		{
			return (mb_strlen($str) != $val) ? FALSE : TRUE;
		}

		return (strlen($str) != $val) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Username
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function valid_username($str)
	{
		return ( ! preg_match("/^([a-z0-9_\-]+)(\.[a-z0-9_\-]+)*$/ix", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Valid Email
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Emails
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function valid_emails($str)
	{
		if (strpos($str, ',') === FALSE)
		{
			return $this->valid_email(trim($str));
		}

		foreach (explode(',', $str) as $email)
		{
			if (trim($email) != '' && $this->valid_email(trim($email)) === FALSE)
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Validate IP Address
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	static function valid_ip($ip)
	{
		return Input::valid_ip($ip);
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function alpha($str)
	{
		return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function alpha_numeric($str)
	{
		return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Alpha-numeric cu _ (underscore) - (minus) . (punct) , (virgula)  (spatiu)
	 * utilizata pentru validare: nume de persoane, institutii, localitati
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function alpha_dash($str)
	{
		return ( ! preg_match("/^([a-z0-9_\-\., ])+$/i", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}

	// --------------------------------------------------------------------

	/**
	 * Is Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function is_numeric($str)
	{
		return ( ! is_numeric($str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Integer
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function integer($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Decimal number
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function decimal($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Greather than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function greater_than($str, $min)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str > $min;
	}

	// --------------------------------------------------------------------

	/**
	 * Less than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function less_than($str, $max)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str < $max;
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number  (0,1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function is_natural($str)
	{
		return (bool) preg_match( '/^[0-9]+$/', $str);
	}

	// --------------------------------------------------------------------

	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function is_natural_no_zero($str)
	{
		if ( ! preg_match( '/^[0-9]+$/', $str))
		{
			return FALSE;
		}

		if ($str == 0)
		{
			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Valid Base64
	 *
	 * Tests a string for characters outside of the Base64 alphabet
	 * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	static function valid_base64($str)
	{
		return (bool) ! preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Enum
	 *
	 * Lista trebuie sa contina cel putin un item definit
	 * primul argument este valoarea campului din formular
	 * apoi urmeaza elementele listei
	 *
	 * @access	public
	 * @param	string, string, string(optional), ...
	 * @return	bool
	 */
	static function enum($str, $item)
	{
		$items = func_get_args();
		unset($items[0]);// elimina primul element
		foreach($items as $item)
			if($str == $item)
				return true;
		
		return false;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Enum
	 *
	 * Lista trebuie sa contina cel putin un item definit
	 * primul argument este valoarea campului din formular (array)
	 * apoi urmeaza elementele listei
	 *
	 * @access	public
	 * @param	array, string, string(optional), ...
	 * @return	bool
	 */
	static function set($arr, $item)
	{
		if(!is_array($arr) || empty($arr))
			return false;
		
		$items = func_get_args();
		unset($items[0]);// elimina primul element
		foreach($arr as $val)
			if(!in_array($val, $items))
				return false;
		
		return true;
	}

	// --------------------------------------------------------------------

	/**
	 * Prep URL
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	static function prep_url($str = '')
	{
		if ($str == 'http://' OR $str == '')
		{
			return '';
		}

		if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://')
		{
			$str = 'http://'.$str;
		}

		return $str;
	}

	// --------------------------------------------------------------------

	/**
	 * Strip Image Tags
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	static function strip_image_tags($str)
	{
		return Input::strip_image_tags($str);
	}

	// --------------------------------------------------------------------

	/**
	 * XSS Clean
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	static function xss_clean($str)
	{
		return Security::xss_clean($str);
	}

	// --------------------------------------------------------------------

	/**
	 * Convert PHP tags to entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	static function encode_php_tags($str)
	{
		return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
	}

}
// END Form Validation Class

/* End of file Form_validation.php */
/* Location: ./system/libraries/Form_validation.php */
