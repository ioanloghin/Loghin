<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
class Updater
{
	public function __construct($key_string)
	{
		// se conecteaza la server pentru update
		
		// daca nu exista updates
		
		// daca exista updates
		// anunta proprietarul site-ului
		$this->user_alert();
	}
	
	// USER functions ------------------------------------------------ //
	private function user_alert()
	{
		
	}
	
	// CORE functions ------------------------------------------------ //
	function execute($query_string)
	{
		// sintaxa
		// nume_functie(arg1, arg2, ...)
	}
	
	function core_function($function_name, $args = array(), $block_string = NULL)
	{
		
	}
	
	// FILE functions ------------------------------------------------ //
	function file_update($patch)
	{
		$path_parts = pathinfo($patch);
		$dirname	= $path_parts['dirname'];
		$basename	= $path_parts['basename'];// cu extensie
		$extension	= $path_parts['extension'];
		$filename	= $path_parts['filename'];// fara extensie
		
		// salveaza backup fisier vechi
		
		// sterge fisierul vechi
		
		// copiaza fisierul nou
		
	}
	
	function set_header($extension)
	{
		switch($extension)
		{
			case'atom':	header("Content-type: application/atom+xml"); break;
			case'css':	header("Content-type: text/css"); break;
			case'js':	header("Content-type: text/javascript"); break;
			case'jpeg': header("Content-type: image/jpeg"); break;
			case'json': header("Content-type: application/json"); break;
			case'pdf':	header("Content-type: application/pdf"); break;
			case'rss':	header("Content-type: application/rss+xml; charset=ISO-8859-1"); break;
			case'txt':	header("Content-type: text/plain"); break;
			case'xml':	header("Content-type: text/xml"); break;
			case'zip':	header("Content-type: application/zip"); break;
			case'mp3':	header("Content-type: audio/mpeg"); break;
			case'swf':	header("Content-type: application/x-shockwave-flash"); break;
		}
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */