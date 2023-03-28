<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Organigrame extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function graph()
	{
		global $MyUser;
		$this->load_library('Organigrama');
		
		if(!class_exists('CO_Plan'))
			die('clasa CO_Plan nu exista');
		
		$plan = new CO_Plan(1);
		
		$html_head = array('title' => 'Organigrama');
		$for_page = array('plan' => $plan);
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('struct/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('organigrame/p_index', $for_page);
		$this->load_view('templates/harmony/footer');
	}
	
	
	
	public function timeline()
	{
		global $MyUser;
		$this->load_library('Organigrama');
		
		// preia parametri din get
		$projectID	= (defined('arg1') && (arg1 > 0)) ? intval(arg1) : 0;// id proiect
		$blockID	= (defined('arg2')) ? intval(arg2) : 0;// block-ul care se afla in prim-plan
		
		$timeline = new OR_Timeline($projectID, $blockID);
		
		$html_head = array('title' => 'Organigrama');
		$for_page = array('timeline' => $timeline);
		
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('struct/head_end');
		$this->load_view('templates/harmony/header');
		$this->load_view('organigrame/p_timeline', $for_page);
		$this->load_view('templates/harmony/footer');
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */