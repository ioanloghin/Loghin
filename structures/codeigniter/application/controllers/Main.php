<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		
	}

	public function changeentity($entity) {
		
		$this->load->model('User_model');
		
		$this->User_model->setEntity($entity);

		redirect(base_url('main/index/'));
		
	}
	
	public function change($account, $user, $nickname, $profile, $type, $cKey=0) {
		
		$this->load->model('User_model');
		
		// Save current key
		$this->session->set_userdata(array('cKey' => $cKey));
		
		$this->User_model->setAccount($account, $user, $nickname, $profile, $type);
		redirect(base_url('main/index/'));
		
	}
	
	// Change Only Account_id
	public function change_oac($account_id, $type) {
		
		$this->load->model('User_model');
		
		$this->User_model->changeAccount($account_id, $type);
		redirect(base_url('main/index/'));
		
	}
	
	// Change Only Nickname_id
	public function change_oni($nickname_id) {
		
		$this->load->model('User_model');
		
		$this->User_model->changeNickname($nickname_id);
		redirect(base_url('main/index/'));
		
	}
	

	public function index() {
	
		// Initializeaza Obiectul utilizatorului
		//$MyUser = new MyUser(2);
		
		$data = array();
		$accounts_types = array();
		$records = array();

		$this->load->model('User_model');
		$this->load->model('Myaccount_model');
		$this->load->model('Userbar_model');

		$me=array();
		$records = array();
		$accountsList = array();
		$nicknamesList = array();
		
		// Set current Key
		$cKey = $this->session->userdata('cKey');
		if($cKey) {
			$cKey=(int)$cKey;
		}
		else {
			$this->session->set_userdata(array('cKey' => 0));
			$cKey=0;
		}
		
		if($this->Myaccount_model->logged()) {
			$me = $this->Myaccount_model->get();
			$currentMe = $this->Myaccount_model->get($this->User_model->getCurrentAccount());
			$root_id = $this->Myaccount_model->getRootId();
			if($root_id) {
				$accountsList = $this->Userbar_model->getAccounts($root_id);
				$nicknamesList = $this->Userbar_model->getNicknames($currentAccountId);
				
				// Send data for user bar menu
				$accounts_id = $this->Userbar_model->getAccountsId($root_id);
				foreach($accounts_id as $account_id) {
					$records = array_merge($records, $this->Userbar_model->getRecords($account_id));
				}
			}
			
			// Get prev and next profile
			$pKey=($cKey==0)?count($records)-1:$cKey-1;
			$nKey=($cKey==count($records)-1)?0:$cKey+1;
			$prevRecord = $records[$pKey];
			$nextRecord = $records[$nKey];
			
			$data['url_prev_profile']	= 'main/change/'.$prevRecord->getAccount()[0].'/'.(int)$prevRecord->getUser()[0].'/'.(int)$prevRecord->getNickname()[0].'/'.(int)$prevRecord->getProfile()[0].'/'.$prevRecord->getType().'/'.$pKey;
			$data['url_next_profile']	= 'main/change/'.$nextRecord->getAccount()[0].'/'.(int)$nextRecord->getUser()[0].'/'.(int)$nextRecord->getNickname()[0].'/'.(int)$nextRecord->getProfile()[0].'/'.$nextRecord->getType().'/'.$nKey;
		}
		else {
			$data['url_prev_profile'] = '#';
			$data['url_next_profile'] = '#';
		}
		
		$currentAccountId = $this->User_model->getCurrentAccount();
		
		$data['records'] 			= $records;
		$data['accounts_types']		= $accounts_types;
		$data['chatStatus']			= $this->User_model->getChatStatus();
		$data['currentType'] 		= $this->User_model->getType();
		$data['accountsList'] 		= $accountsList;
		$data['nicknamesList'] 		= $nicknamesList;
		$data['currentAccountId'] 	= $currentAccountId;
		$data['currentUserId'] 		= $this->User_model->getCurrentUser();
		$data['currentNicknameId'] 	= $this->User_model->getCurrentNickname();
		$data['currentProfileId'] 	= $this->User_model->getCurrentProfile();
		$data['currentAccount'] 	= $this->User_model->getCurrentAccount(true);
		$data['currentUser'] 		= $this->User_model->getCurrentUser(true);
		$data['currentNickname']	= $this->User_model->getCurrentNickname(true);
		$data['currentProfile'] 	= $this->User_model->getCurrentProfile(true);
		$data['logged']				= $this->Myaccount_model->logged();
		$data['me']					= $me;
		$data['currentMe']			= $currentMe;
		$data['auth_err']			= $this->Myaccount_model->getError();
		
		// Reset auth error
		$this->Myaccount_model->cleanError();
		
		$this->load->view('user-bar', $data);
	}
}
