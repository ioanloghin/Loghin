<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Index extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		global $MyUser;
		
		$this->load_library('Tree');
		
		$html_head = array('title' => 'Index Page');
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('index/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('index/p_index');
		$this->load_view('index/footer');
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */