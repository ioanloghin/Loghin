<?php
//------------------------------------------------------------------------------------------------------------------------ //
	define('ANTIHACK', TRUE);
	require_once('../../config/_autoload.php');
//------------------------------------------------------------------------------------------------------------------------ //
	include_once('../../system/libraries/SQL_DB.php'); // clasa sql
	include_once('../../system/libraries/Safe_get.php');
//------------------------------------------------------------------------------------------------------------------------ //
//
// extragere din baza de date --------------------------------------
$GET = new safe_get();
$GET->set_var('query', NULL, 'strip_tags|trim|htmlentities');

echo "{";
echo "query:'".$GET->get_var('query')."',";
echo "suggestions:[";
if(strlen($GET->get_var('query')) <= 1)
	$results = SQL_DB::sql_querry("SELECT b_lang.en AS label, b.code AS code FROM ".MYSQL_PRE."blocks AS b, `".MYSQL_PRE."blocks_lang` AS b_lang
		WHERE b.id = b_lang.block_id AND (`code` LIKE '".$GET->get_var('query')."%' AND LENGTH(code) < 4)
		ORDER BY `code` ASC, `label` ASC");
else
if(strlen($GET->get_var('query')) <= 2 && preg_match("/^([a-z])([0-9])$/i", $GET->get_var('query')))
	$results = SQL_DB::sql_querry("SELECT b_lang.en AS label, b.code AS code FROM ".MYSQL_PRE."blocks AS b, `".MYSQL_PRE."blocks_lang` AS b_lang
		WHERE b.id = b_lang.block_id AND (`code` LIKE '".$GET->get_var('query')."%' AND LENGTH(code) < 6)
		ORDER BY `code` ASC, `label` ASC");
else
if(strlen($GET->get_var('query')) <= 3)
	$results = SQL_DB::sql_querry("SELECT b_lang.en AS label, b.code AS code FROM ".MYSQL_PRE."blocks AS b, `".MYSQL_PRE."blocks_lang` AS b_lang
		WHERE b.id = b_lang.block_id AND (`code` LIKE '".$GET->get_var('query')."%' OR b_lang.en LIKE '".$GET->get_var('query')."%')
		ORDER BY `code` ASC, `label` ASC");
else
	$results = SQL_DB::sql_querry("SELECT b_lang.en AS label, b.code AS code FROM ".MYSQL_PRE."blocks AS b, `".MYSQL_PRE."blocks_lang` AS b_lang
		WHERE b.id = b_lang.block_id AND (`code` LIKE '".$GET->get_var('query')."%' OR b_lang.en LIKE '%".$GET->get_var('query')."%')
		ORDER BY `code` ASC, `label` ASC");
	
$counter = 0;
while($row = mysql_fetch_assoc($results))
{
	if($counter++)
		echo ",";
	
	echo "'".$row["code"]." - ".$row['label']."'";
}
echo "],}";
?>