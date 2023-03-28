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
define('lang', (isset($_GET['lang'])) ? $_GET['lang'] : 'en');

// controller sets ------------------------------------------------------------------------------------------------------- //
$temp = (isset($exp[$i]) && $exp[$i] && !preg_match("/(\W)/i", $exp[$i])) ? strtolower($exp[$i]) : 'index';
define('controller', (isset($_alias[$temp]) && is_string($_alias[$temp])) ? $_alias[$temp] : $temp);
$i++;

// page sets ------------------------------------------------------------------------------------------------------------- //
$temp = (isset($exp[$i]) && $exp[$i] && !preg_match("/(\W)/i", $exp[$i])) ? strtolower($exp[$i]) : DEFAULT_PAGE;
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
$acc_api = new Accounts_API($MyUser->account_id());

ob_end_flush();
//------------------------------------------------------------------------------------------------------------------------ //
// END index site

/* End of file index.php */
/* Location: ./index.php */

$array = SQL_DB::sql_querry("SELECT *,
							sez.id AS sez_id,
							sez.codice AS sez_code,
							sez.titolo AS sez_title,
							sez.descrizione AS sez_desc,
							div.id AS div_id,
							div.codice AS div_code,
							div.titolo AS div_title,
							div.descrizione AS div_desc,
							grup.id AS grup_id,
							grup.codice AS grup_code,
							grup.titolo AS grup_title,
							grup.descrizione AS grup_desc,
							clas.id AS clas_id,
							clas.codice AS clas_code,
							clas.titolo AS clas_title,
							clas.descrizione AS clas_desc,
							cat.id AS cat_id,
							cat.codice AS cat_code,
							cat.titolo AS cat_title,
							cat.descrizione AS cat_desc,
							subcat.id AS subcat_id,
							subcat.codice AS subcat_code,
							subcat.titolo AS subcat_title,
							subcat.descrizione AS subcat_desc
FROM `ateco_relation` AS `rel`
							LEFT JOIN `ateco_".lang."_sezione` as `sez`
								ON sez.id = rel.id_sezione
							LEFT JOIN `ateco_".lang."_divisione` as `div`
								ON div.id = rel.id_divisione
							LEFT JOIN `ateco_".lang."_gruppo` as `grup`
								ON grup.id = rel.id_gruppo
							LEFT JOIN `ateco_".lang."_classe` as `clas`
								ON clas.id = rel.id_classe
							LEFT JOIN `ateco_".lang."_categoria` as `cat`
								ON cat.id = rel.id_categoria
							LEFT JOIN `ateco_".lang."_sottocategoria` as `subcat`
								ON subcat.id = rel.id_sottocategoria
WHERE sez.id = '16'");
echo '<pre>';
while($row = mysql_fetch_assoc($array))
{
	//print_r($row);
	$title = NULL;
	if($row['subcat_title'])
		$title = $row['subcat_title'];
	else if($row['cat_title'])
		$title = $row['cat_title'];
	else if($row['clas_title'])
		$title = $row['clas_title'];
	else if($row['grup_title'])
		$title = $row['grup_title'];
	else if($row['div_title'])
		$title = $row['div_title'];
	else if($row['sez_title'])
		$title = $row['sez_title'];
	
	$code = sprintf("%s.%d.%d%d.%d.%d", $row['sez_code'], $row['div_code'], $row['grup_code'], $row['clas_code'], $row['cat_code'], $row['subcat_code']);
	
	printf("%s %s", $code, $title);
	echo "<br />";
	
	// verifica daca exista
	$exista = $acc_api->sql_count("l_categories", "`code` = '$code'", 1);
	if(!$exista)
	{
		$category_id = $acc_api->sql_insert("l_categories", array('id' => 'NULL', 'code' => $code));
		$acc_api->sql_insert("l_categories_data", array('category_id' => $category_id, 'lang' => lang, 'category' => $title));
	}
	else
	{
		$exista = $acc_api->sql_count("l_categories_data", "`category` = '$title' AND `lang` = '".lang."'", 1);
		if(!$exista)
		{
			$temp = $acc_api->sql_select("l_categories", "`code` = '$code'");
			if(isset($temp[0]))
			{
				$category_id = $temp[0]['id'];
				$acc_api->sql_insert("l_categories_data", array('category_id' => $category_id, 'lang' => lang, 'category' => $title));
			}
		}
	}
	
}
echo '</pre>';

//$acc_api->sql_querry("INSERT INTO `l_accounts_institutions` (`institution_id`, `account_id`, `type`, `country`, `location`, `category`, `institution`, `group`, `specialty`, `from`, `to`, `status`) VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '')");
?>