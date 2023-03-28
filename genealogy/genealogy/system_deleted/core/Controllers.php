<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
class Controllers
{
	public function __construct()
	{
		self::$instance =& $this;
		
	}
	
	function load_view($filename, $variables = array(), $return = FALSE)
	{
		global $MyUser;
		
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
	
	function load_library($_filename, $variables = array(), $return = FALSE)
	{
		global $MyUser;
		
		ob_start();
		$_ext = pathinfo($_filename, PATHINFO_EXTENSION);
		if($_ext == '') $_filename .= '.php';
		
		extract($variables);
		
		$_filename = ucfirst(strtolower($_filename));
		
		include('libraries/'.$_filename);
		
		// Return the file data if requested
		if ($return === TRUE)
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		
		
		ob_end_flush();
		
	}
	
	function load_model($_filename, $variables = array(), $return = FALSE)
	{
		global $MyUser;
		
		ob_start();
		$_ext = pathinfo($_filename, PATHINFO_EXTENSION);
		if($_ext == '') $_filename .= '.php';
		
		extract($variables);
		
		//$_filename = ucfirst(strtolower($_filename));
		
		include('models/'.$_filename);
		
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