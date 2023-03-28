<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include_once("../../module/e_403.php"));
}
//
//
//
//------------------------------------------------------------------------------------------------------------------------ //
function script_include($file_or_mod, $baks = NULL)
{
	if(preg_match("/\[[a-z0-9_\-]+\]/i", $file_or_mod))
	{
		switch($file_or_mod)
		{
			case '[vital]':
				script_include('[setari]', $baks);
				script_include('[clase]', $baks);
				script_include('[functii]', $baks);
				break;
			case '[setari]':
				script_include($baks.'config/ini_set.php');
				script_include($baks.'config/server.php');
				script_include($baks.'config/email.php');
				script_include($baks.'config/database.php');
				script_include($baks.'config/script.php');
				script_include($baks.'config/crypt.php');
				break;
			case '[clase]':
				script_include($baks.'codes/clase/SQL_DB.php');
				script_include($baks.'codes/clase/AntiHack.php');
				script_include($baks.'codes/clase/DataTime.php');
				script_include($baks.'codes/clase/Files.php');
				script_include($baks.'codes/clase/safe_post.php');
				script_include($baks.'codes/clase/safe_get.php');
				script_include($baks.'codes/clase/safe_session.php');
				script_include($baks.'codes/clase/safe_auth.php');
				script_include($baks.'codes/clase/INFOuser.php');
				script_include($baks.'codes/clase/AG_Operation.php');
				script_include($baks.'codes/clase/AG_View.php');
				script_include($baks.'codes/clase/AG_UserBox.php');
				script_include($baks.'codes/clase/AG_FamilyBox.php');
				script_include($baks.'codes/clase/AG_PoP2.php');
				break;
			case '[functii]':
				script_include($baks.'codes/functii/fullname.php');
				script_include($baks.'codes/functii/item_profil_3.php');
				break;
		}
	}
	else
	if($file_or_mod)
		include($file_or_mod);
}
//------------------------------------------------------------------------------------------------------------------------ //
//:::UPDATE[2012-01-21]::: A nu se indeparta!
?>