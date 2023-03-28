<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		
	}

	public function in() {
		
		$this->load->model('User_model');
		$this->load->model('Myaccount_model');
		$this->load->library('form_validation');
		$this->load->library('Hash');
		
		$this->form_validation->set_rules('usr', 'Username', 'required');
		$this->form_validation->set_rules('psw', 'Password', 'required');
		if($this->form_validation->run() != FALSE) {
			
			$pwdHash = $this->Myaccount_model->getPwd($this->input->post('usr'));
			if($pwdHash && Hash::check($this->input->post('psw'), $pwdHash)) {
				// Save login
				$this->Myaccount_model->login($this->input->post('usr'));
				
				// Set current userBar
				$account_id = $this->Myaccount_model->getAccountId();
				$user = '';
				$nickname = '';
				$profile = '';
				$type = '';
				$this->User_model->setAccount($account_id, $user, $nickname, $profile, $type);
				
				redirect(base_url('main/index/'));
				exit;
			}
			else {
				$this->Myaccount_model->setError("Invalid credentials!");
			}
		}
		else {
			$this->Myaccount_model->setError("Wrong type of data!");
		}
		
		redirect(base_url('main/index/'));
		exit;
	}
	
	
	public function out()
	{
		$this->load->model('Myaccount_model');
		$this->load->model('User_model');
		
		$this->Myaccount_model->logout();
		$this->User_model->cleanAccount();
		redirect(base_url('main/index/'));
	}
	
	
}
