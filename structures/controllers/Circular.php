<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Circular extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function index()
	{
		$text	= (defined('arg1')) ? arg1 : "Global Search System Tehnology";
		
		global $MyUser;
		
		$this->load_library('Circular_lib');
		$html_head = array('title' => 'Text circular');
		$this->load_view('templates/circular/head', $html_head);
		$this->load_view('templates/circular/head_end');
		$this->load_view('circular/p_index', array("text" => $text));
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */