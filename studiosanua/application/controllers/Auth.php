<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$data = array(
			'controller' => 'auth',
			'page' => 'login',
			'title' => 'Signin',
		);
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		
		if ($this->form_validation->run() !== FALSE)
		{
			//Go to private area
			redirect('template/topmenu', 'refresh');
		}
		
		$this->load->view('admin/page-login', $data);
	}
	
	public function logout()
	{
		$this->user_model->logout();
		
		redirect('/admin', 'refresh');
	}
	
	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
		
		//query the database
		$result = $this->user_model->login($username, $password);
		
		if($result)
		{
			$sess_array = array(
				'account_id' => $result['account_id'],
				'username' => $result['username']
			);
			$this->session->set_userdata('logged_in', $sess_array);
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

}
