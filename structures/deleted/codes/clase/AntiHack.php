<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include_once("../../module/e_403.php"));
}
//
//
//
class AntiHack
{
	// ========================================================================
	function filtru($var, $filtru1 = 0, $filtru2 = 0, $filtru3 = 0, $filtru4 = 0)
	{
		// pentru cazurile unde am folosit forma veche a functiei
		if($filtru1 == 3)
		{
			$filtru1 = 1;
			$filtru2 = 1;
			$filtru3 = 1;
			$filtru4 = 1;
		}
		//
		//
		if($filtru2 == 1)
			$var = strip_tags($var);
			
		if($filtru3 == 1)
			$var = htmlentities($var);
			
		if($filtru4 == 1)
			$var = htmlspecialchars($var);
		
		if($filtru1 == 1)
			$var = trim($var);
		
		return $var;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	
	// ========================================================================
}
?>