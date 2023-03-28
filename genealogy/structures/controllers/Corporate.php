<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Corporate extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function graph()
	{
		global $MyUser;
		$this->load_library('company');
		
		if(!class_exists('CO_Plan'))
			die('clasa CO_Plan nu exista');
		
		$plan = new CO_Plan(1);
		
		$html_head = array('title' => 'Organigrama');
		$for_page = array('plan' => $plan);
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('struct/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('corporate/p_index', $for_page);
		$this->load_view('templates/harmony/footer');
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */