<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Search extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Search Page');
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('search/head_end');
		$this->load_view('search/header');
		$this->load_view('search/p_index');
		$this->load_view('templates/harmony/footer');
	}
	
	public function images()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Search Images');
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('search/head_end');
		$this->load_view('search/header');
		$this->load_view('search/p_images');
		$this->load_view('templates/harmony/footer');
	}
	
	public function videos()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Search Videos');
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('search/head_end');
		$this->load_view('search/header');
		$this->load_view('search/p_index');
		$this->load_view('templates/harmony/footer');
	}
	
	public function text()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Search Text');
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('search/head_end');
		$this->load_view('search/header');
		$this->load_view('search/p_index');
		$this->load_view('templates/harmony/footer');
	}
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */