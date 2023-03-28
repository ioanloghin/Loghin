<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Restrictedzone extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Only authenticated users can access it
		if(!$this->user_model->logged()) {
			//If no session, redirect to login page
			redirect('auth/login', 'refresh');
		}
	}
}
