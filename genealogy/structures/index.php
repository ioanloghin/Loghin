<?php
/**
 * Index
 *
 * Aplicatie dezvoltata pentru PHP 5.1.6 sau mai nou
 *
 * @package		AFramework
 * @subpackage	Libraries
 * @author		Adry
 * @link		
 * @since		Version 1.0
 *
 * Shared file with genealogy.loghin.com
 *     Fisierele shared trebuie sa contina NUMAI INSTRUCTIUNI GENERALE pentru a nu influenta functionarea
 *     site-urilor care le folosesc.
 */

// ------------------------------------------------------------------------

/**
 * Required config/_autoload.php
 * Required system/core/_autoload.php
 * Required system/libraries/_autoload.php
 * Required system/helpers/_autoload.php
 */


// trimite tipul MIME si codarea caracterelor
ob_start();
header("Content-Type: text/html; charset=utf-8");
//------------------------------------------------------------------------------------------------------------------------ //
define('ANTIHACK', TRUE);
require_once('config/_autoload.php');
//------------------------------------------------------------------------------------------------------------------------ //
$patch_info = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : NULL; // Returns "/Mod_rewrite/edit/1/"
$exp = explode('/', $patch_info); // Break into an array

// parametri de baza ----------------------------------------------------------------------------------------------------- //
// pe local host, nr. implicit este in functie de directoarele pana la root
// ex. pentru localhost/nume_site/ in va corespunde 1
// ex. pentru localhost/clienti/nume_site/ in va corespunde 2
$i = ($_SERVER['HTTP_HOST'] == 'localhost') ? 2 : 0;
$i++;

// lang sets ------------------------------------------------------------------------------------------------------------- //
if(LANG_IN_URL)
{
	define('lang', (isset($exp[$i]) && $exp[$i] && !preg_match("/(\W)/i", $exp[$i])) ? strtolower($exp[$i]) : DEFAULT_LANG);
	$i++;
}
else
	define('lang', DEFAULT_LANG);

// controller sets ------------------------------------------------------------------------------------------------------- //
$temp = (isset($exp[$i]) && $exp[$i] && !preg_match("/(\W)/i", $exp[$i])) ? strtolower($exp[$i]) : 'index';
define('controller', (isset($_alias[$temp]) && is_string($_alias[$temp])) ? $_alias[$temp] : $temp);
$i++;

// page sets ------------------------------------------------------------------------------------------------------------- //
$temp = (isset($exp[$i]) && $exp[$i] && !preg_match("/(\W)/i", $exp[$i])) ? strtolower($exp[$i]) : 'index';
define('page', (array_key_exists(controller, $_alias) && isset($_alias[controller][$temp]) && is_string($_alias[controller][$temp])) ? $_alias[controller][$temp] : $temp);
$i++;

// argumente ------------------------------------------------------------------------------------------------------------- //
$n=1;
while(isset($exp[$i]) && ($exp[$i] != NULL))
	define('arg'.($n++), (ctype_digit($exp[$i])) ? intval($exp[$i++]) : $exp[$i++]);
//------------------------------------------------------------------------------------------------------------------------ //
//
//
//
// system includes ------------------------------------------------------------------------------------------------------- //
include_once('system/core/_autoload.php');
include_once('system/libraries/_autoload.php');
include_once('system/helpers/_autoload.php');

//log_reset();// reset debug file
log_message('refresh', '----------------------------------------');

//include_once('language/'.lang.'/application.php');
$Input = new Input;
$lang = new Language(lang/*, $words*/);
$MyUser = new MyUser();// se creaza obiectul utilizatorului logat
$acc_api = new Accounts_API();
$className = ucfirst(controller);

// verifica daca controllerul si pagina exista
if(!file_exists('controllers/'.$className.'.php'))
{
	define('e_arg1', $className);
	define('e_arg2', page);
	include_once('controllers/Error.php');
	$obj = new Error();
	$obj->e404();
	exit;
}

include_once('controllers/'.$className.'.php');
$obj = new $className();
$functionName = page;
$obj->$functionName();
ob_end_flush();
//------------------------------------------------------------------------------------------------------------------------ //
// END index site

/* End of file index.php */
/* Location: ./index.php */
?>