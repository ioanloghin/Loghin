<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
//

function config_item($name)
{
	global $config;
	return array_key_exists($name, $config) ? $config[$name] : false;
}

/* End of file config.php */
/* Location: ./system/helpers/config.php */?>