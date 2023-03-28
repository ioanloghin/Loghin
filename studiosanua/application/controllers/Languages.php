<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends MY_Restrictedzone {

	public function index()
	{
		$this->load->model('Languages_model', 'LangModel');
	
		$data = array(
			'controller' => 'languages',
			'page' => 'index',
			'title' => 'Languages',
		);
		
		$data['successful'] = false;
		$langs=$this->LangModel->get();
		
		if (isset($_POST['add']))
		{
			$this->form_validation->set_rules('new_lang', 'Lang', 'required|is_unique[languages.lang]');
			$this->form_validation->set_rules('new_label', 'Label', '');
		
			if ($this->form_validation->run() !== FALSE)
			{
				$this->LangModel->insert($this->input->post('new_lang'), $this->input->post('new_label'));
				$langs=$this->LangModel->get();
				$data['successful'] = true;
			}
		}
		
		if (isset($_POST['save']))
		{
			foreach($langs as $l)
			{
				$this->LangModel->update($l['lang'], $this->input->post('label-'.$l['lang']));
			}
			
			$langs=$this->LangModel->get();
			$data['successful'] = true;
		}
		
		$data['langs'] = $langs;
		
		$this->load->view('admin/page-languages', $data);
	}
	
	public function remove($lang)
	{
		$this->load->model('Languages_model', 'LangModel');
		if ($this->LangModel->get_primary()['lang'] != $lang)
		{
			$this->LangModel->remove($lang);
		}
		redirect('languages/index', 'refresh');
	}
}
