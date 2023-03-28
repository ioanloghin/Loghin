<?php
//------------------------------------------------------------------------------------------------------------------------ //
define('ANTIHACK', TRUE);
include_once('../system/helpers/includes.php');
include_once('../system/helpers/url.php');
script_include('[vital]', '../');
//------------------------------------------------------------------------------------------------------------------------ //
//
$word = (isset($_GET['word'])) ? AntiHack::filtru($_GET['word'], 3) : NULL;
// ------------------------------------------------------------------------------------------------------------------------ //
$array1 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C3."` LIKE '$word%'", "ORDER BY `".DBT_USER_INFO_C4."` ASC");
$array2 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C3."` LIKE '%$word%'", "ORDER BY `".DBT_USER_INFO_C4."` ASC");

$total_array = array();
$legaturi1 = array();
$legaturi2 = array();
foreach($array1 as $key => $row)
{
	if(!in_array($row[DBT_USER_INFO_C1], $total_array))
	{
		$total_array[] = $row[DBT_USER_INFO_C1];
		$legaturi1[$row[DBT_USER_INFO_C1]] = $key;
	}
}
foreach($array2 as $key => $row)
{
	if(!in_array($row[DBT_USER_INFO_C1], $total_array))
	{
		$total_array[] = $row[DBT_USER_INFO_C1];
		$legaturi2[$row[DBT_USER_INFO_C1]] = $key;
	}
}

foreach($total_array as $id_user)
{
	if(isset($legaturi1[$id_user]) and isset($array1[$legaturi1[$id_user]])) $row = $array1[$legaturi1[$id_user]];
	if(isset($legaturi2[$id_user]) and isset($array2[$legaturi2[$id_user]])) $row = $array2[$legaturi2[$id_user]];
	
	$name = str_ireplace("$word", "<span style=\"background-color:#FFC; color:#03C;\">$word</span>", $row[DBT_USER_INFO_C3]);
	$key = strtolower(strip_tags($name));
	$key = str_replace(array(" ", "-"), "_", $key);
	
	echo '<div class="SearchRecomItem">';
    echo '<img class="SRI_img" src="'.ROOT.$row[DBT_USER_INFO_C5].'" />';
    echo '<div class="SRI_details">';
    echo '<a href="'.ROOT.'user/'.$key.'-'.$row[DBT_USER_INFO_C1].'/">'.$row[DBT_USER_INFO_C2].' '.$name.'</a>';
    echo '</div>';
    echo '</div>';
	echo '<div class="cboth"></div>';
}
?>