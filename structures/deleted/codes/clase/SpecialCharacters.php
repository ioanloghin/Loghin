<?php
// Versiune 1.2
// Last edit 12-07-2011
//
// --------------------------------------------------------------------------
if(!defined('ANTIHACK')) { header('HTTP/1.0 403 Forbidden'); header('Status: 403 Forbidden'); die(include_once("../../module/e_403.php")); }
// --------------------------------------------------------------------------
class SpecialCharacters
{
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function no_special($string)
	{
		$array = array(
		// romanian
		'Ă' => 'A',
		'ă' => 'a',
		'Â' => 'A',
		'â' => 'a',
		'Î' => 'I',
		'î' => 'i',
		'Ş' => 'S',
		'ş' => 's',
		'Ţ' => 'T',
		'ţ' => 't',
		'&#258;' => 'A',
		'&#259;' => 'a',
		'&Acirc;' => 'A',
		'&acirc;' => 'a',
		'&Icirc;' => 'I',
		'&icirc;' => 'i',
		'&#350;' => 'S',
		'&#351;' => 's',
		'&#354;' => 'T',
		'&#355;' => 't',
		// spanish
		'Á' => 'A',
		'á' => 'a',
		'É' => 'E',
		'é' => 'e',
		'Í' => 'I',
		'í' => 'i',
		'Ñ' => 'N',
		'ñ' => 'n',
		'Ó' => 'O',
		'ó' => 'n',
		'Ú' => 'U;',
		'ú' => 'u',
		'Ü' => 'U',
		'ü' => 'u',
		// italian
		'À' => 'A',
		'à' => 'a',
		'Á' => 'A',
		'á' => 'a',
		'È' => 'E',
		'è' => 'e',
		'É' => 'E',
		'é' => 'e',
		'Ì' => 'I',
		'ì' => 'i',
		'Í' => 'I',
		'í' => 'i',
		'Ò' => 'O',
		'ò' => 'o',
		'Ó' => 'O',
		'ó' => 'o',
		'Ù' => 'U',
		'ù' => 'u',
		'Ú' => 'U',
		'ú' => 'u',
		);
		
		foreach($array as $key => $value) {
		$string = str_replace($key, $value, $string);
		}
		
		return $string;
	}
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    function romanian($string, $action = 'encode')
	{
		$array = array(
		'Ă' => '&#258;',
		'ă' => '&#259;',
		'Â' => '&Acirc;',
		'â' => '&acirc;',
		'Î' => '&Icirc;',
		'î' => '&icirc;',
		'Ş' => '&#350;',
		'ş' => '&#351;',
		'Ţ' => '&#354;',
		'ţ' => '&#355;'
		);
		
		foreach($array as $key => $value)
		{
			if($action == 'encode')
				$string = str_replace($key, $value, $string);
			elseif($action == 'decode')
				$string = str_replace($value, $key, $string);
		}
		
		return $string;
	}
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    function spanish($string, $action = 'encode')
	{
		$array = array(
		'Á' => '&Aacute;',
		'á' => '&aacute;',
		'É' => '&Eacute;',
		'é' => '&eacute;',
		'Í' => '&Iacute;',
		'í' => '&iacute;',
		'Ñ' => '&#209;',
		'ñ' => '&#241;',
		'Ó' => '&#211;',
		'ó' => '&#243;',
		'Ú' => '&#218;',
		'ú' => '&#250;',
		'Ü' => '&#220;',
		'ü' => '&#252;',
		'«' => '&#171;',
		'»' => '&#187;',
		'¿' => '&#191;',
		'¡' => '&#161;',
		'€' => '&#128;',
		'₧' => '&#8359;'
		);
		
		foreach($array as $key => $value)
		{
			if($action == 'encode')
				$string = str_replace($key, $value, $string);
			elseif($action == 'decode')
				$string = str_replace($value, $key, $string);
		}
		
		return $string;
	}
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    function italian($string, $action = 'encode')
	{
		$array = array(
		'À' => '&Agrave;',
		'à' => '&agrave;',
		'Á' => '&Aacute;',
		'á' => '&aacute;',
		'È' => '&Egrave;',
		'è' => '&egrave;',
		'É' => '&Eacute;',
		'é' => '&eacute;',
		'Ì' => '&Igrave;',
		'ì' => '&igrave;',
		'Í' => '&Iacute;',
		'í' => '&iacute;',
		'Ò' => '&Ograve;',
		'ò' => '&ograve;',
		'Ó' => '&Oacute;',
		'ó' => '&oacute;',
		'Ù' => '&Ugrave;',
		'ù' => '&ugrave;',
		'Ú' => '&Uacute;',
		'ú' => '&uacute;',
		'«' => '&laquo;',
		'»' => '&raquo;',
		'€' => '&euro;',
		'₤' => '&#x20A4;'
		);
		
		foreach($array as $key => $value)
		{
			if($action == 'encode')
				$string = str_replace($key, $value, $string);
			elseif($action == 'decode')
				$string = str_replace($value, $key, $string);
		}
		
		return $string;
	}
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    function punctuation($string, $action = 'encode')
	{
		$array = array(
		'"' => '&quot;',
		"'" => '&#39;',
		'<' => '&lt;',
		'>' => '&gt;'
		);
		
		foreach($array as $key => $value)
		{
			if($action == 'encode')
				$string = str_replace($key, $value, $string);
			elseif($action == 'decode')
				$string = str_replace($value, $key, $string);
		}
		
		return $string;
	}
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function all($string, $action = 'encode')
	{
		$string = SpecialCharacters::romanian($string, 'encode');
		$string = SpecialCharacters::italian($string, 'encode');
		$string = SpecialCharacters::spanish($string, 'encode');
		$string = SpecialCharacters::punctuation($string, 'encode');
		return $string;
	}
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
}
?>