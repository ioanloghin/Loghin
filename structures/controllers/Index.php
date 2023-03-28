<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Index extends Controllers
{
	function __construct()
	{
		
	}
	
	
	public function index()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Index Page');
		$this->load_view('templates/'.template.'/head', $html_head);
		$this->load_view('index/head_end');
		$this->load_view('templates/'.template.'/header');
		$this->load_view('index/p_index');
		$this->load_view('templates/'.template.'/footer');
	}
	
	public function people()
	{
		global $MyUser;
		
		$html_head = array('title' => 'People');
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('index/head_end', array('theme' => 'people'));
		$this->load_view('templates/harmony/header');
		$this->load_view('index/p_index');
		$this->load_view('templates/'.template.'/footer');
	}
	
	public function business()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Business');
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('index/head_end', array('theme' => 'business'));
		$this->load_view('templates/harmony/header');
		$this->load_view('index/p_index');
		$this->load_view('templates/'.template.'/footer');
	}
	
	public function institutions()
	{
		global $MyUser;
		
		$html_head = array('title' => 'Institutions');
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('index/head_end', array('theme' => 'institutions'));
		$this->load_view('templates/harmony/header');
		$this->load_view('index/p_index');
		$this->load_view('templates/'.template.'/footer');
	}
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */