<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
//

function log_reset()
{
	unlink('debug.txt');
	$fh = fopen('debug.txt', 'w') or die("can't open file");
	fclose($fh);
}

function log_message($name, $value)
{
	$fh = fopen('debug.txt', 'a') or die("can't open file");
	fwrite($fh, "[".date('H:i:s')."][".$_SERVER['REMOTE_ADDR']."] $name: $value\n");
	fclose($fh);
}

/* End of file config.php */
/* Location: ./system/helpers/config.php */?>