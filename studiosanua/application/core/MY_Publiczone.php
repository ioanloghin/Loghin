<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Publiczone extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('Autologin');

		//$this->autologin->autologin();

		// Only authenticated users can access it
		//if(!$this->user_model->logged()) {
			//If no session, redirect to login page
		//	redirect('auth/login', 'refresh');
		//}
	}
}
