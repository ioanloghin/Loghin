<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Publiczone {

	public $global_data = array();
	public $current_lang;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Languages_model', 'LangModel');
		$this->load->library('Autologin');
		
		$this->current_lang = $this->session->userdata('lang');
		$this->current_lang = $this->current_lang ? $this->current_lang : $this->LangModel->get_primary()['lang'];
		$this->global_data['current_lang'] = $this->current_lang;
		
		$this->global_data['languages']=$this->LangModel->get();
		
		
		// AUTOLOGIN
		$alogin = $this->autologin->autologin();
		$this->global_data['logged'] = ($alogin>0);
	}
	
	public function restricted() {
		if ($this->global_data['logged']>0) {
			redirect(base_url('/page/home'));
		}
		$this->load->view('page-restricted');
	}
	
	public function permissions() {
		if ($this->global_data['logged']>0 && true) {
			redirect(base_url('/page/home'));
		}
		$this->load->view('page-permissions');
	}
	
	public function autologin($rawtoken) {
		$token = rawurldecode($rawtoken);
		$this->session->set_userdata("autologin_token", $token);
	}

	public function home()
	{
		$this->load->model('Languages_model', 'LangModel');
		
		$this->session->set_userdata('url_path', 'home');
	
		$this->global_data['controller'] = 'page';
		$this->global_data['page'] 		 = 'home';
		
		$this->global_data['meta_title'] = 'LOGHIN © Importer';
		
		$this->global_data['DataInSheet'] = array();
		if (isset($_FILES['file'])) {
			
			// Upload file
			$config['upload_path']   = './tmp/'; 
			$config['allowed_types'] = 'xlsx'; 
			$config['max_size']      = 100; 
//			$config['max_width']     = 1024; 
//			$config['max_height']    = 768;  
			$this->load->library('upload', $config);
			
			if ( $this->upload->do_upload('file')) {
				$data = array('upload_data' => $this->upload->data());
				$file_path =  './tmp/'.$data['upload_data']['file_name'];
				
				// Parse file
				include 'phpexcel-master/Classes/PHPExcel/IOFactory.php';
				$inputFileName = $file_path; 
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
				
				// Save and remove file
				$this->session->set_userdata("DataInSheet", $allDataInSheet);
				unlink($file_path);
				
				// Sent to view
				$this->global_data['DataInSheet'] = $this->session->userdata('DataInSheet');
	//			for($i=1;$i<=$arrayCount;$i++)
	//			{
	//				printf("<strong>%d</strong> %s<br>", $i, $allDataInSheet[$i]["A"]);
	//				//'product'=$allDataInSheet[$i]["C"],
	//				//'brand'=$allDataInSheet[$i]["I"],
	//				//'standard'=$allDataInSheet[$i]["J"],
	//			}
				
			}
			else { 
				
				$error = array('error' => $this->upload->display_errors()); 
				var_export($error);
			} 
			
			
			
		}
		
		if ($this->global_data['logged']>0 && true) {
			$this->load->view('page-import', $this->global_data);
		}
		else if ($this->global_data['logged']==0) {
			redirect(base_url('/page/restricted'));
		}
		else if(false) {
			redirect(base_url('/page/permissions'));
		}
	}
}
