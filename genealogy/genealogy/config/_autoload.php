<?php  if( ! defined('ANTIHACK')) exit('No direct script access allowed');

//require_once('ini_set.php');
if($_SERVER["SERVER_ADDR"] == "::1" || $_SERVER["SERVER_ADDR"] == "127.0.0.1")
	require_once('variables_localhost.php');
else
	require_once('variables.php');


require_once('crypt.php');
require_once('database.php');
/*require_once('email.php');
require_once('foreign_chars.php');*/
require_once('script.php');
require_once('route.php');

/* End of file _autoload.php */
/* Location: ./config/_autoload.php */
?>