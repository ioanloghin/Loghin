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
error_reporting(0);
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
if($config['allow_lang_url'])
{
	define('lang', (isset($exp[$i]) && $exp[$i] && !preg_match("/(\W)/i", $exp[$i])) ? strtolower($exp[$i]) : $config['language']);
	$i++;
}
else
	define('lang', $config['language']);

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
if(!isset($_SESSION[SESSION]['direct_mode']))
	$_SESSION[SESSION]['direct_mode'] = true;
if(isset($_GET['direct_mode']))
	$_SESSION[SESSION]['direct_mode'] = ($_GET['direct_mode'] == 1) ? true : false;
define('DIRECT_MODE', $_SESSION[SESSION]['direct_mode']);// true - va afisa direct din baza de date register
define('template', $config['template']);

include_once($config['patch_system_core'].'_autoload.php');
include_once($config['patch_system_libraries'].'_autoload.php');
include_once($config['patch_system_helpers'].'_autoload.php');

//log_reset();// reset debug file
log_message('refresh', '----------------------------------------');


//include_once('language/'.lang.'/application.php');
$Input = new Input;
$lang = new Language(lang/*, $words*/);
$MyUser = new MyUser();// se creaza obiectul utilizatorului logat
$acc_api = new Accounts_API($MyUser->account_id());

include_once('models/Approval.php');

// Genealogy model
include_once('models/Genealogy_model.php');
$gen = new Genealogy_model();
$gen->acc_api = &$acc_api;
$acc_api->gen = &$gen;

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
<pre style="color:#999; padding:5px;">
<span style="color:#039">Versiunea 4.2
- Limba implicita (Romana)
- Implementare avize pentru arbori
- Inlocuire constanta ROOT cu functia base_url()</span>

Versiunea 4.1
- legatura directa cu baza de date Register
</pre>