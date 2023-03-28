<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Error extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function e404()
	{
		header("HTTP/1.0 404 Not Found");
		
		$for_head = array('title' => 'Error 404 - Not Found', 'canonical' => SITE_ROOT);
		$this->load_view('templates/'.template.'/head', $for_head);
		$this->load_view('templates/'.template.'/head_end');
		$this->load_view('templates/'.template.'/header');
		$this->load_view('error/Sp_e404');
		//$this->load_view('error/music');
	}
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */