<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Privat extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Private Page');
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('privat/head_end');
		$this->load_view('privat/header');
		$this->load_view('index/p_index');
		$this->load_view('templates/harmony/footer');
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */