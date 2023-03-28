<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
	}


	public function change($lang_key)
	{
		
		$this->load->model('Languages_model', 'LangModel');
		
		$lang_key = ($lang_key != "") ? $lang_key : $this->LangModel->get_primary()['lang'];
        $this->session->set_userdata('lang', $lang_key);
		
		// go back
		$url_path = $this->session->userdata('url_path');
		if(!empty($url_path)) {
			redirect($url_path);
		}
	}
}
