<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
class Loader
{
	public function __construct()
	{
		return $this;
	}
	
	function view($filename, $variables = array(), $return = FALSE)
	{
		global $MyUser, $lang;
		
		ob_start();
		$_ext = pathinfo($filename, PATHINFO_EXTENSION);
		if($_ext == '') $filename .= '.php';
		
		extract($variables);
		
		include('views/'.$filename);
		
		// Return the file data if requested
		if ($return === TRUE)
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		
		
		ob_end_flush();
	}
	
	function library($_filename, $variables = array(), $return = FALSE)
	{
		// variabile globale
		global $MyUser, $lang;
		
		ob_start();
		$_ext = pathinfo($_filename, PATHINFO_EXTENSION);
		if($_ext == '') $_filename .= '.php';
		
		// transforma lista de argumente primite in variabile
		extract($variables);
		
		$_filename = ucfirst(strtolower($_filename));
		
		// verifica intai daca este definita de utilizator
		if(file_exists('libraries/'.$_filename))
			include('libraries/'.$_filename);
		else
		// in cazu contrat, verifica daca exista definita de system
		if(file_exists('system/libraries/'.$_filename))
			include('system/libraries/'.$_filename);
		else
		// in caz contrat
			return false;
		
		// Return the file data if requested
		if ($return === TRUE)
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		
		
		ob_end_flush();
		
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */