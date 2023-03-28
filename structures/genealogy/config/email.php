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
	define("EMAIL_SUPORT",		"support@domain.ro");
	define("EMAIL_CONTACT",		"contact@domain.ro");
	define("EMAIL_ADMIN",		"administrator@domain.ro");
	define("EMAIL_NO_REPLY",	"no-reply@domain.ro");
	define("EMAIL_SERVICE",		"service@domain.ro");
//------------------------------------------------------------------------------------------------------------------------ //
//
// --- Conectare SMTP ---------------------------------------------------------------------------------------------------- //
	define("SMTP_AUTH",	TRUE);
	define("SMTP_HOST",	"mail.domain.ro");
	define("SMTP_USER",	"mailuser@domain.ro");
	define("SMTP_PASS",	"password");
	define("SMTP_PORT",	25);//465
//------------------------------------------------------------------------------------------------------------------------ //
?>