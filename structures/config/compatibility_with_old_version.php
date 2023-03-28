<?php
// ANTIHACK verificare access din exterior ------------------------------------------------------------------------------- //
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../module/e_403.php"));
}
//------------------------------------------------------------------------------------------------------------------------ //
//
//------------------------------------------------------------------------------------------------------------------------ //
	define("PROIECT",	"LoghinStructures");
	define("DOMAIN",	"structures.loghin.com");
//------------------------------------------------------------------------------------------------------------------------ //
//
//------------------------------------------------------------------------------------------------------------------------ //
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	define("SITE_ROOT",		"http://localhost/clienti/structures/");
	define("ADMIN_ROOT",	SITE_ROOT."administrator/");
	define("ROOT",			"http://localhost/clienti/structures/");
}
else
if($_SERVER['HTTP_HOST'] == 'www.loghin.com' || $_SERVER['HTTP_HOST'] == 'loghin.com')
{
	define("SITE_ROOT",		"http://loghin.com/structures/");
	define("ADMIN_ROOT",	SITE_ROOT."administrator/");
	define("ROOT",			"http://loghin.com/structures/");
}
else
if($_SERVER['HTTP_HOST'] == 'www.structures.loghin.com' || $_SERVER['HTTP_HOST'] == 'structures.loghin.com')
{
	define("SITE_ROOT",		"http://structures.loghin.com/");
	define("ADMIN_ROOT",	SITE_ROOT."administrator/");
	define("ROOT",			"/");
}
?>