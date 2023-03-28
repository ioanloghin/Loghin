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
				script_include('[clase]', $baks);
				script_include('[functii]', $baks);
				break;
			case '[clase]':
			case '[libraries]':
				script_include($baks.'system/libraries/SQL_DB.php');
				script_include($baks.'system/libraries/Datatime.php');
				script_include($baks.'system/libraries/Files.php');
				script_include($baks.'system/libraries/Safe_post.php');
				script_include($baks.'system/libraries/Safe_get.php');
				break;
			case '[AG]':
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