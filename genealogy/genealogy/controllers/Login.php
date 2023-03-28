<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Login extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function in()
	{
		global $lang, $MyUser;
		
		$succesful = false;
		$POST = new Form_data;
		$POST->set_var('usr', 'Username', NULL, 'trim', 'required|valid_username');
		$POST->set_var('psw', 'Password', NULL, 'trim', 'required');
		
		if(isset($_POST['auth']))
		{
			//if($POST->check_antirefresh())// verifica daca s-a dat refresh dupa inregistrare
			//{
				// verifica daca sunt corecte informatiile trimise
				$POST->validation();
				
				if(!$POST->errors())// daca nu sunt probleme
				{
					
					if($MyUser->sign_in($POST->get_var('usr'), $POST->get_var('psw')))
						redirect(base_url(''));
					else
						$POST->set_error('usr', 'Invalid account!');
				}
			//}
			//else
				// inregistrarea s-a realizat cu success si utilizatorul a dat refresh
			//	$POST->set_successful(2);
		}
		
		$html_head = array('title' => 'Login Page');
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('index/head_end');
		$this->load_view('templates/harmony/header', array('POST' => $POST));
		$this->load_view('index/p_index');
		$this->load_view('templates/harmony/footer');
	}
	
	public function out()
	{
		global $MyUser;
		$MyUser->sign_out();
		redirect(base_url(''));
	}
	
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */?>