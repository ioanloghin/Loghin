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
// require:
//		clasa DataTime;
//
//
class AG_View
{
	// ========================================================================
	function span_age($born, $deces = NULL)
	{
		$age_format = NULL;
		if((isset($born)) && ($born) && ($born != '0000-00-00') && (isset($deces)) && ($deces) && ($deces != '0000-00-00'))
			$age_format = DataTime::format($born, 'Y').' - '.DataTime::format($deces, 'Y');
		else
		if((isset($born)) && ($born) && ($born != '0000-00-00'))
			$age_format = DataTime::age($born).' ani';
		
		return $age_format;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/AG_UserAdmin.html
?>