<?php

class User_model extends CI_Model {
	
	public function setEntity($entity) {
		
		$account_id = $this->getCurrentAccount();
		$this->db->where('account_id', $account_id);
		$this->db->set('entity', $entity);
		$this->db->update('accounts');
	}
	
	public function setAccount($account_id, $user, $nickname, $profile, $type) {
		
		$data = array('myaccount' => array(
		   'account_id'		=> $account_id,
		   'user'			=> $user,
		   'nickname'		=> $nickname,
		   'profile'		=> $profile,
		   'type'			=> $type,
	   ));

		$this->session->set_userdata($data);
		
	}
	
	public function cleanAccount() {
		$myaccount = array(
			'account_id'	=> 0,
			'user'			=> '',
			'nickname'		=> 0,
			'profile'		=> '',
			'type'			=> 0,
		);
		$this->session->set_userdata(array('myaccount' => $myaccount));
	}
	
	public function changeAccount($account_id, $type) {
		$myaccount = $this->session->userdata('myaccount');
		if(!$myaccount) {
			$myaccount = array(
				'account_id'	=> 0,
				'user'			=> '',
				'nickname'		=> 0,
				'profile'		=> '',
				'type'			=> 0,
			);
		}
		
		// Try get first user, nick and profile for this account
		$this->db->select('loghin_id');  
		$this->db->where('account_id',$account_id);
		$this->db->limit(1);
		$query = $this->db->get('accounts');
		if($query->num_rows() == 1) {
			$temp = $query->row_array();
			$myaccount['user'] = $temp['loghin_id'];
		}
		else {
			$myaccount['user'] = 0;
		}
		
		$this->db->select('nickname_id');  
		$this->db->where('account_id',$account_id);
		$this->db->order_by('nickname_id', 'asc');  
		$this->db->limit(1);
		$query = $this->db->get('accounts_nicknames');
		if($query->num_rows() == 1) {
			$temp = $query->row_array();
			$myaccount['nickname'] = $temp['nickname_id'];
		}
		else {
			$myaccount['nickname'] = 0;
		}
		
		// else set null
		//...
		
		// set account
		$myaccount['account_id'] = $account_id;
		
		$this->session->set_userdata(array('myaccount' => $myaccount));
	}
	
	public function changeNickname($nickname_id) {
		$myaccount = $this->session->userdata('myaccount');
		if($myaccount) {
			$myaccount['nickname'] = $nickname_id;
		}
		$this->session->set_userdata(array('myaccount' => $myaccount));
	}
	
	public function getChatStatus() {
		
		$account_id = $this->getCurrentAccount();
		
		$chatdb = $this->load->database('chat', TRUE);
		
		$chatdb->select('status');  
		$chatdb->where('member_id',$account_id);
		$chatdb->limit(1);  
		$query = $chatdb->get('members_status');
		if($query->num_rows() == 1) {
			$temp = $query->row_array();
			return $temp['status'];
		}
		else {
			return NULL;
		}
	}
	
	public function getType() {
		$myaccount = $this->session->userdata('myaccount');
		return isset($myaccount['type']) ? $myaccount['type'] : '-';
	}

	public function getCurrentAccount($label = false) {
		$myaccount = $this->session->userdata('myaccount');
		$account_id = isset($myaccount['account_id']) ? $myaccount['account_id'] : 0;
		if($account_id == 0) {
			return 'Account';
		}
		
		if(!$label) {
			return $account_id;
		}
		else {
			$type=$this->getType();
			if($type == UserBarRecord::INSTITUTION) {
				$this->db->select('name');  
				$this->db->where('institution_id',$account_id);
				$this->db->limit(1);
				$query = $this->db->get('institutions');
				$temp = $query->row_array();
				return $temp['name'];
			}
			else {
				$this->db->select('firstname,lastname');  
				$this->db->where('account_id',$account_id);
				$this->db->limit(1);
				$query = $this->db->get('accounts');
				$temp = $query->row_array();
				return $temp['firstname'].' '.$temp['lastname'];
			}
		}
	}
	
	public function getCurrentUser($label = false) {
		$myaccount = $this->session->userdata('myaccount');
		$user = isset($myaccount['user']) ? $myaccount['user'] : 0;
		if($user == 0) {
			return 'User';
		}
		return $user;
	}
	
	public function getCurrentNickname($label = false) {
		$myaccount = $this->session->userdata('myaccount');
		$nickname_id = isset($myaccount['nickname']) ? $myaccount['nickname'] : 0;
		if($nickname_id == 0) {
			return 'Nick Name';
		}
		
		if(!$label) {
			return $nickname_id;
		}
		else {
			$this->db->select('nickname');  
			$this->db->where('nickname_id',$nickname_id);
			$this->db->limit(1);
			$query = $this->db->get('accounts_nicknames');
			$temp = $query->row_array();
			return $temp['nickname'];
		}
	}
	
	public function getCurrentProfile($label = false) {
		$myaccount = $this->session->userdata('myaccount');
		$profile_id = isset($myaccount['profile']) ? $myaccount['profile'] : 0;
		if($profile_id == 0) {
			return 'Profile';
		}
		if(!$label) {
			return $profile_id;
		}
		else {
			$this->db->select('name');  
			$this->db->where('profile_id',$profile_id);
			$this->db->limit(1);
			$query = $this->db->get('profiles');
			$temp = $query->row_array();
			return $temp['name'];
		}
	}
}