<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactpage extends MY_Restrictedzone {

	public function contactinfo($form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Contact_model', 'ContactModel');
	
		$data = array(
			'controller' => 'contactpage',
			'page' => 'contactinfo',
			'title' => 'Contact content',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs']=$this->LangModel->get();
		$data['successful'] = false;
		
		$this->form_validation->set_rules('save', 'Save button', 'required');
		$this->form_validation->set_rules('email', 'Email', '');
		$this->form_validation->set_rules('email_cc', 'Email CC', '');
		$this->form_validation->set_rules('meta_title1', 'Title1', '');
		$this->form_validation->set_rules('meta_title2', 'Title2', '');
		$this->form_validation->set_rules('meta_title3', 'Title3', '');
		$this->form_validation->set_rules('meta_title4', 'Title4', '');
		$this->form_validation->set_rules('meta_content1', 'Content1', '');
		$this->form_validation->set_rules('meta_content2', 'Content2', '');
		$this->form_validation->set_rules('meta_content3', 'Content3', '');
		$this->form_validation->set_rules('contact_placeholder_fullname', 'Placeholder fullname', '');
		$this->form_validation->set_rules('contact_placeholder_phone', 'Placeholder phone', '');
		$this->form_validation->set_rules('contact_placeholder_email', 'Placeholder email', '');
		$this->form_validation->set_rules('contact_placeholder_message', 'Placeholder message', '');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$this->LangModel->save_content('contactinfo-section-title1', $form_lang, $this->input->post('meta_title1'));
			$this->LangModel->save_content('contactinfo-section-title2', $form_lang, $this->input->post('meta_title2'));
			$this->LangModel->save_content('contactinfo-section-title3', $form_lang, $this->input->post('meta_title3'));
			$this->LangModel->save_content('contactinfo-section-title4', $form_lang, $this->input->post('meta_title4'));
			$this->LangModel->save_content('contactinfo-section-content2', $form_lang, $this->input->post('meta_content2'));
			$this->LangModel->save_content('contactinfo-section-content3', $form_lang, $this->input->post('meta_content3'));
			$this->LangModel->save_content('contactinfo-placeholder-fullname', $form_lang, $this->input->post('contact_placeholder_fullname'));
			$this->LangModel->save_content('contactinfo-placeholder-phone', $form_lang, $this->input->post('contact_placeholder_phone'));
			$this->LangModel->save_content('contactinfo-placeholder-email', $form_lang, $this->input->post('contact_placeholder_email'));
			$this->LangModel->save_content('contactinfo-placeholder-message', $form_lang, $this->input->post('contact_placeholder_message'));
			$this->LangModel->save_content('contactinfo-button-send', $form_lang, $this->input->post('contact_button_send'));
			
			$this->ContactModel->update_email($this->input->post('email'));
			$this->ContactModel->update_email_cc($this->input->post('email_cc'));
			$this->ContactModel->update_map($this->input->post('meta_content1'));
			$data['successful'] = true;
		}
		
		$data['email'] = isset($_POST['email'])
							? $this->input->post('email')
							: $this->ContactModel->get_email();
		$data['email_cc'] = isset($_POST['email_cc'])
							? $this->input->post('email_cc')
							: $this->ContactModel->get_email_cc();
		$data['meta_title1'] = isset($_POST['meta_title1'])
							? $this->input->post('meta_title1')
							: $this->LangModel->get_content('contactinfo-section-title1', $form_lang);
		$data['meta_title2'] = isset($_POST['meta_title2'])
							? $this->input->post('meta_title2')
							: $this->LangModel->get_content('contactinfo-section-title2', $form_lang);
		$data['meta_title3'] = isset($_POST['meta_title3'])
							? $this->input->post('meta_title3')
							: $this->LangModel->get_content('contactinfo-section-title3', $form_lang);
		$data['meta_title4'] = isset($_POST['meta_title4'])
							? $this->input->post('meta_title4')
							: $this->LangModel->get_content('contactinfo-section-title4', $form_lang);
		$data['meta_content1'] = $this->ContactModel->get_map();
		$data['meta_content2'] = isset($_POST['meta_content2'])
							? $this->input->post('meta_content2')
							: $this->LangModel->get_content('contactinfo-section-content2', $form_lang);
		$data['meta_content3'] = isset($_POST['meta_content3'])
							? $this->input->post('meta_content3')
							: $this->LangModel->get_content('contactinfo-section-content3', $form_lang);
		$data['contact_placeholder_fullname'] = isset($_POST['contact_placeholder_fullname'])
							? $this->input->post('contact_placeholder_fullname')
							: $this->LangModel->get_content('contactinfo-placeholder-fullname', $form_lang);
		$data['contact_placeholder_phone'] = isset($_POST['contact_placeholder_phone'])
							? $this->input->post('contact_placeholder_phone')
							: $this->LangModel->get_content('contactinfo-placeholder-phone', $form_lang);
		$data['contact_placeholder_email'] = isset($_POST['contact_placeholder_email'])
							? $this->input->post('contact_placeholder_email')
							: $this->LangModel->get_content('contactinfo-placeholder-email', $form_lang);
		$data['contact_placeholder_message'] = isset($_POST['contact_placeholder_message'])
							? $this->input->post('contact_placeholder_message')
							: $this->LangModel->get_content('contactinfo-placeholder-message', $form_lang);
		$data['contact_button_send'] = isset($_POST['contact_button_send'])
							? $this->input->post('contact_button_send')
							: $this->LangModel->get_content('contactinfo-button-send', $form_lang);
		
		$this->load->view('admin/page-contactpage-contactinfo', $data);
	}
}
