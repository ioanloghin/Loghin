<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicepage extends MY_Restrictedzone {

	public function pageinfo($form_lang = NULL)
	{
		$this->load->model('Metainfo_model', 'Metainfo');
		$this->load->model('Languages_model', 'LangModel');
	
		$page_name = 'service';
	
		$data = array(
			'controller' => $page_name.'page',
			'page' => 'pageinfo',
			'title' => ucfirst($page_name).' - Page info',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		
		$data['successful'] = false;
		$data['meta_lang'] = isset($_POST['meta_lang']) ? $this->input->post('meta_lang') : $form_lang;
		$data['meta_title'] = isset($_POST['meta_title']) ? $this->input->post('meta_title') : $this->Metainfo->get($page_name, 'title', $form_lang);
		$data['meta_description'] = isset($_POST['meta_description']) ? $this->input->post('meta_description') : $this->Metainfo->get($page_name, 'description', $form_lang);
		$data['meta_keywords'] = isset($_POST['meta_keywords']) ? $this->input->post('meta_keywords') : $this->Metainfo->get($page_name, 'keywords', $form_lang);
		
		$this->form_validation->set_rules('meta_lang', 'Meta lang', 'required');
		$this->form_validation->set_rules('meta_title', 'Title', 'required');
		$this->form_validation->set_rules('meta_description', 'Description', '');
		$this->form_validation->set_rules('meta_keywords', 'Keywords', '');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$this->Metainfo->update($page_name, 'title', $this->input->post('meta_lang'), $this->input->post('meta_title'), $this->input->post('meta_lang'));
			$this->Metainfo->update($page_name, 'description', $this->input->post('meta_lang'), $this->input->post('meta_description'), $this->input->post('meta_lang'));
			$this->Metainfo->update($page_name, 'keywords', $this->input->post('meta_lang'), $this->input->post('meta_keywords'), $this->input->post('meta_lang'));
			$data['successful'] = true;
		}
		
		$content_langs=$this->LangModel->get();
		foreach($content_langs as $k => $v)
		{
			$content_langs[$k]['fill'] = !empty($this->Metainfo->get($page_name, 'title', $v['lang']));
		}
		$data['content_langs'] = $content_langs;
		
		$this->load->view('admin/page-generic-pageinfo', $data);
	}
	
	public function layout($item_key = NULL, $form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Pagelayout_model', 'Layout');
		
		$data = array(
			'controller' => 'servicepage',
			'page' => 'layout',
			'title' => 'Service - Layout',
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
			$this->Layout->update_visible('service', $item_key, $this->input->post('field_visible')=='1'?'1':'0');
			
			switch($item_key)
			{
				case 'content':
				{
					
					break;
				}
				case 'leftmenu':
				{
					$this->LangModel->save_content('service-leftmenu-title', $form_lang, $this->input->post('field_title'));
					break;
				}
				case 'publications':
				{
					$this->LangModel->save_content('service-publications-title', $form_lang, $this->input->post('field_title'));
					break;
				}
			}
			
			$data['successful'] = true;
		}
		
		$data['field_visible'] = isset($_POST['field_visible'])
							? $this->input->post('field_visible')
							: $this->Layout->get_visible('service', $item_key);
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
							: $this->LangModel->get_content('service-leftmenu-title', $form_lang);
				break;
			}
			case 'publications':
			{
				$data['field_title'] = isset($_POST['field_title'])
							? $this->input->post('field_title')
							: $this->LangModel->get_content('service-publications-title', $form_lang);
				break;
			}
		}
		
		$data['visible_content'] = $this->Layout->get_visible('service', 'content');
		$data['visible_leftmenu'] = $this->Layout->get_visible('service', 'leftmenu');
		$data['visible_publications'] = $this->Layout->get_visible('service', 'publications');
		
		$this->load->view('admin/page-service-layout', $data);
	}
}
