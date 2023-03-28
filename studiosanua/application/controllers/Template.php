<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Restrictedzone {

	public function password()
	{
		$this->load->model('User_model', 'User');
	
		$data = array(
			'controller' => 'template',
			'page' => 'password',
			'title' => 'Site info',
		);
		
		$data['successful'] = false;

		$this->form_validation->set_rules('password_old', 'Old password', 'trim|required|callback_oldpassword_check');
		$this->form_validation->set_rules('password_new', 'New password', 'trim|required');
		$this->form_validation->set_rules('password_re', 'Repeat password', 'trim|required|matches[password_new]');
		if ($this->form_validation->run() !== FALSE)
		{
			$this->User->changePassword($this->User->getAccountId(), $this->input->post('password_new'));
			$data['successful'] = true;
		}
		
		$this->load->view('admin/page-template-password', $data);
	}
	
	public function topmenu($form_lang = NULL)
	{
		$this->load->model('Siteinfo_model', 'Siteinfo');
		$this->load->model('Languages_model', 'LangModel');
	
		$data = array(
			'controller' => 'template',
			'page' => 'topmenu',
			'title' => 'Top menu',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs'] = $this->LangModel->get();
		$data['successful'] = false;
		$data['email'] = isset($_POST['email_contact']) ? $this->input->post('email_contact') : $this->Siteinfo->get('email_contact');
		
		for ($i=1; $i<=5; ++$i) {
			$this->form_validation->set_rules('topmenu-item-'.$i, 'Item '.$i, 'required');
		}
		if ($this->form_validation->run() !== FALSE)
		{
			for ($i=1; $i<=5; ++$i) {
				$this->LangModel->save_content('topmenu-item-'.$i, $form_lang, $this->input->post('topmenu-item-'.$i));
			}
			$data['successful'] = true;
		}
		
		for ($i=1; $i<=5; ++$i) {
			$data['topmenu_item_'.$i] = isset($_POST['topmenu-item-'.$i])
							? $this->input->post('topmenu-item-'.$i)
							: $this->LangModel->get_content('topmenu-item-'.$i, $form_lang);
		}
		
		$this->load->view('admin/page-template-topmenu', $data);
	}
	
	public function footer($form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
	
		$data = array(
			'controller' => 'template',
			'page' => 'footer',
			'title' => 'Template - footer',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		
		$data['successful'] = false;
		$data['content'] = isset($_POST['content'])
							? $this->input->post('content')
							: $this->LangModel->get_content('pagecontent-footer', $form_lang);
		$data['copyright'] = isset($_POST['copyright'])
							? $this->input->post('copyright')
							: $this->LangModel->get_content('pagecontent-copyright', $form_lang);
		
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('copyright', 'Copyright', 'required');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$this->LangModel->save_content('pagecontent-footer', $form_lang, $this->input->post('content'));
			$this->LangModel->save_content('pagecontent-copyright', $form_lang, $this->input->post('copyright'));
			$data['successful'] = true;
		}
		
		$data['content_langs']=$this->LangModel->get();
		
		$this->load->view('admin/page-template-footer', $data);
	}
	
	public function pageheader($form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Header_model', 'Header');
	
		$data = array(
			'controller' => 'template',
			'page' => 'pageheader',
			'title' => 'Template - Header',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		
		$data['successful'] = false;
		
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$this->LangModel->save_content('pagecontent-header', $form_lang, $this->input->post('content'));
			$this->LangModel->save_content('company-name', $form_lang, $this->input->post('company_name'));
			$this->LangModel->save_content('company-domain', $form_lang, $this->input->post('company_domain'));
			$this->LangModel->save_content('company-register', $form_lang, $this->input->post('company_register'));
			$data['successful'] = true;
		}
		
		if (isset($_POST['save']))
		{
			$config=array();
			$config['upload_path']   = './assets/img/header/'; 
			$config['allowed_types'] = 'gif|jpg|png'; 
			$config['max_size']      = 3000; 
			$config['max_width']     = 6000; 
			$config['max_height']    = 6000;  
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload', $config);	
			
			$upload_image=NULL;
			if(isset($_FILES['logo-image']) && !empty($_FILES['logo-image']['name']))
			{
				if ($this->upload->do_upload('logo-image'))
				{
					$upload_info=$this->upload->data();
					$upload_image = base_url('assets/img/header/'.$upload_info['file_name']);
					$this->Header->update_logo_img($upload_image);
				}
				else
				{
					echo $this->upload->display_errors();
					$this->form_validation->set_message('upload_image', $this->upload->display_errors());
				}
			}
			$upload_image=NULL;
			if(isset($_FILES['brand-image']) && !empty($_FILES['brand-image']['name']))
			{
				if ($this->upload->do_upload('brand-image'))
				{
					$upload_info=$this->upload->data();
					$upload_image = base_url('assets/img/header/'.$upload_info['file_name']);
					$this->Header->update_brand_img($upload_image);
				}
				else
				{
					echo $this->upload->display_errors();
					$this->form_validation->set_message('upload_image', $this->upload->display_errors());
				}
			}
		}
		
		$data['logo_img']=$this->Header->get_logo_img();
		$data['content'] = isset($_POST['content'])
							? $this->input->post('content')
							: $this->LangModel->get_content('pagecontent-header', $form_lang);
		$data['company_name'] = isset($_POST['company_name'])
							? $this->input->post('company_name')
							: $this->LangModel->get_content('company-name', $form_lang);
		$data['company_domain'] = isset($_POST['company_domain'])
							? $this->input->post('company_domain')
							: $this->LangModel->get_content('company-domain', $form_lang);
		$data['company_register'] = isset($_POST['company_register'])
							? $this->input->post('company_register')
							: $this->LangModel->get_content('company-register', $form_lang);
							
		
		$data['content_langs']=$this->LangModel->get();
		
		$this->load->view('admin/page-template-header', $data);
	}
	
	public function oldpassword_check($old_password)
	{
		$this->load->model('User_model', 'User');
		
		$old_password_hash = md5($old_password);
		$old_password_db_hash = $this->User->getPassword($this->User->getAccountId());
		if($old_password_hash != $old_password_db_hash)
		{
			$this->form_validation->set_message('oldpassword_check', 'Old password not match');
			return FALSE;
		} 
		return TRUE;
	}
	
	public function traffic()
	{
		$this->load->model('Traffic_model', 'Traffic');
	
		$today=date('Y-m-d');
		$range=10;
		$stats=array();
		for($i=$range; $i>=0; --$i) {
			$day = date('Y-m-d', strtotime('-'.$i.' day', strtotime($today)));
			$stats[$day]=$this->Traffic->countPerDay($day);
		}
		
	
		$data = array(
			'controller' => 'template',
			'page' => 'traffic',
			'title' => 'Site traffic',
			'stats' => $stats
		);
		
		$this->load->view('admin/page-template-traffic', $data);
	}
}
