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
	session_start();
	set_time_limit(300);
	if($_SERVER['HTTP_HOST'] == 'localhost') error_reporting(E_ALL); else error_reporting(0);
//------------------------------------------------------------------------------------------------------------------------ //
	@ini_set("session.save_handler", "files");
	ini_set('register_global', 0);
	ini_set('log_errors', '1');
	ini_set('ignore_repeated_errors', '1');
	ini_set('ignore_repeated_source', '1');
	ini_set('log_errors_max_len', '1024');
	ini_set('arg_separator.input', '&');
	ini_set('arg_separator.output', '&');
//------------------------------------------------------------------------------------------------------------------------ //
?>