<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resourcespage extends MY_Restrictedzone {
	
	public function layout($item_key = NULL, $form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Pagelayout_model', 'Layout');
		
		$data = array(
			'controller' => 'resourcespage',
			'page' => 'layout',
			'title' => 'Resources - Layout',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs'] = $this->LangModel->get();
		$data['item_key']=$item_key;
		$data['successful'] = false;
		
		$this->form_validation->set_rules('save', 'Save button', '');
		$this->form_validation->set_rules('field_visible', 'Visible', 'numeric');
			
		if ($this->form_validation->run() !== FALSE)
		{
			$this->Layout->update_visible('resources', $item_key, $this->input->post('field_visible')=='1'?'1':'0');
			
			switch($item_key)
			{
				case 'content':
				{
					
					break;
				}
				case 'leftmenu':
				{
					$this->LangModel->save_content('resources-leftmenu-title', $form_lang, $this->input->post('field_title'));
					break;
				}
			}
			
			$data['successful'] = true;
		}
		
		$data['field_visible'] = isset($_POST['field_visible'])
							? $this->input->post('field_visible')
							: $this->Layout->get_visible('resources', $item_key);
		switch($item_key)
		{
			case 'content':
			{
				
				break;
			}
			case 'leftmenu':
			{
				$data['field_title'] = isset($_POST['field_title'])
							? $this->input->post('field_title')
							: $this->LangModel->get_content('resources-leftmenu-title', $form_lang);
				break;
			}
		}
		
		$data['visible_content'] = $this->Layout->get_visible('resources', 'content');
		$data['visible_leftmenu'] = $this->Layout->get_visible('resources', 'leftmenu');
		
		$this->load->view('admin/page-resources-layout', $data);
	}
}
