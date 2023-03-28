<?php

class Myaccount_model extends CI_Model {
	
	public function get($account_id=NULL,$field=NULL) {
		
		if(!$this->logged()) {
			return false;
		}
		
		if($account_id==NULL) {
			$account_id = $this->getAccountId();
		}
		
		if($field) {
			$this->db->select($field);
		}
		$this->db->where('account_id', $account_id);
		$this->db->limit(1);
		$query = $this->db->get('accounts');
		$temp = $query->row_array();
		
		if($field) {
			return $temp[$field];
		}
		return $temp;
	}
	
	function logged() {
		$logged_in = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : false;
		$logged_in = ($logged_in != false) ? ($logged_in['account_id'] > 0) : false;
		return $logged_in;
	}
	
	function getAccountId() {
		$logged_in = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : false;
		return ($logged_in != false) ? $logged_in['account_id'] : 0;
	}
	
	function getRootId() {
		$logged_in = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : false;
		return ($logged_in != false) ? $logged_in['root_id'] : 0;
	}
	
	function login($username) {
		
		$this->db->select('accounts.account_id as account_id, root_id');
		$this->db->where('loghin_id', $username);
		$this->db->limit(1);
		$this->db->join('roots_accounts', 'roots_accounts.account_id = accounts.account_id');
		$query = $this->db->get('accounts');
		$data = $query->row_array();

		$this->session->set_userdata(array(
			'logged_in'  => array(
				'root_id' => $data['root_id'],
				'account_id' => $data['account_id'],
			)
		));
	}
	
	function getPwd($username) {
		
		$this->db->select('password');
		$this->db->where('loghin_id', $username);
		$this->db->limit(1);
		
		$query = $this->db->get('accounts');
		if($query->num_rows() == 1) {
			$data = $query->row_array();
			return $data['password'];
		}

		return false;
	}
	
	function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
	}
	
	function setError($error) {
		$this->session->set_userdata(array(
			'logged_err'  => array(
				'error' => $error,
			)
		));
	}
	
	function getError() {
		$logged_err = $this->session->userdata('logged_err') ? $this->session->userdata('logged_err') : false;
		return ($logged_err != false) ? $logged_err['error'] : NULL;
	}
	
	function cleanError() {
		$this->session->unset_userdata('logged_err');
	}
}