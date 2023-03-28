<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
//
// functia ce include pachete de fisiere
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
				script_include($baks.'system/libraries/SQL_DB.php');
				//script_include($baks.'system/libraries/AntiHack.php');
				script_include($baks.'system/libraries/Datatime.php');
				script_include($baks.'system/libraries/Files.php');
				script_include($baks.'system/libraries/Safe_post.php');
				script_include($baks.'system/libraries/Safe_get.php');
				//script_include($baks.'system/libraries/safe_session.php');
				//script_include($baks.'system/libraries/safe_auth.php');
				//script_include($baks.'system/libraries/INFOuser.php');
				script_include($baks.'libraries/AG/AG_Operation.php');
				script_include($baks.'libraries/AG/AG_View.php');
				script_include($baks.'libraries/AG/AG_UserBox.php');
				script_include($baks.'libraries/AG/AG_FamilyBox.php');
				script_include($baks.'libraries/AG/AG_PoP2.php');
				break;
			case '[functii]':
				//script_include($baks.'codes/functii/fullname.php');
				//script_include($baks.'codes/functii/item_profil_3.php');
				break;
		}
	}
	else
	if($file_or_mod)
		include($file_or_mod);
}
// END url helper

/* End of file url.php */
/* Location: ./system/helpers/url.php */