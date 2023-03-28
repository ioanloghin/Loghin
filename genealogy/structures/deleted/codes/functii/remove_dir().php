<?php
// antihack verificare access din exterior
if(!defined('ANTIHACK'))
   {
   header('HTTP/1.0 403 Forbidden'); header('Status: 403 Forbidden'); die(include_once("../../modules/error_403_Forbidden.php"));
   }
//
//
function rrmdir($dir)
{
	if (is_dir($dir))
	{
		$objects = scandir($dir); 
		foreach ($objects as $object)
		{
			if ($object != "." && $object != "..")
			{
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
			} 
		} 
		reset($objects); 
		rmdir($dir); 
	} 
}
?>