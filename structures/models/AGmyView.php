<?php
//------------------------------------------------------------------------------------------------------------------------ //
define('ANTIHACK', TRUE);
include_once('../system/helpers/includes.php');
include_once('../system/helpers/url.php');
script_include('[vital]', '../');
//------------------------------------------------------------------------------------------------------------------------ //
//
$GET = array();
$GET['AGmyIDTree']		= (isset($_GET['AGmyIDTree']))		? $_GET['AGmyIDTree']		: NULL;
$GET['action']			= (isset($_GET['action']))			? $_GET['action']			: NULL;
$GET['direction']		= (isset($_GET['direction']))		? $_GET['direction']		: NULL;
$GET['identif_family']	= (isset($_GET['identif_family']))	? $_GET['identif_family']	: NULL;

if($GET['action'] == 'in')
{
	if($GET['direction'] == 'asc')
		$_SESSION[SESSION]['AGmyView'][$GET['AGmyIDTree']]['asc'][] = $GET['identif_family'];
	else
	if($GET['direction'] == 'desc')
		$_SESSION[SESSION]['AGmyView'][$GET['AGmyIDTree']]['desc'][] = $GET['identif_family'];
}
else
if($GET['action'] == 'out')
{
	if($GET['direction'] == 'asc')
	{
		foreach($_SESSION[SESSION]['AGmyView'][$GET['AGmyIDTree']]['asc'] as $key => $value)
		{
			if($GET['identif_family'] === $value)
				unset($_SESSION[SESSION]['AGmyView'][$GET['AGmyIDTree']]['asc'][$key]);
		}
	}
	else
	if($GET['direction'] == 'desc')
	{
		foreach($_SESSION[SESSION]['AGmyView'][$GET['AGmyIDTree']]['desc'] as $key => $value)
		{
			if($GET['identif_family'] === $value)
				unset($_SESSION[SESSION]['AGmyView'][$GET['AGmyIDTree']]['desc'][$key]);
		}
	}
}
SQL_DB::sql_close();
?>