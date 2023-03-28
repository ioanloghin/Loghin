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
class Languages
{
	function Language_lang($language) {
		switch($language) {
			case'romanian': return 'ro'; break;
			case'english':  return 'en'; break;
			case'german':   return 'ge'; break;
			case'italian':  return 'it'; break;
			case'french':   return 'fr'; break;
			case'spanish':  return 'sp'; break;
			case'russian':  return 'ru'; break;
		}
	}
	
	function lang_language($language) {
		switch($language) {
			case'ro':  return 'romanian'; break;
			case'en':  return 'english';  break;
			case'ge':  return 'german';   break;
			case'it':  return 'italian';  break;
			case'fr':  return 'french';   break;
			case'sp':  return 'spanish';  break;
			case'ru':  return 'russian';  break;
		}
	}


}
?>