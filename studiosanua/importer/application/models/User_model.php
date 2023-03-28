<?php
class User_model extends CI_Model
{
	
	function getPassword($account_id) {
		$this->db->select('password');
		$this->db->where('account_id', $account_id);
		$this->db->limit(1);
		$this->db->from('accounts');
		return $this->db->get()->row()->password;
	}
	
	function changePassword($accountId, $password) {
		$this->db->update('accounts', array('password' => md5($password)), array('account_id' => $accountId));
	}
	
	function getAccountId() {
		if ($this->logged()) {
			$logged_in = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : false;
			return $logged_in['account_id'];
		}
		return 0;
	}
	
	function logged()
	{
		$logged_in = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : false;
		$logged_in = ($logged_in != false) ? ($logged_in['account_id'] > 0) : false;
		return $logged_in;
	}
	
	function login($username, $password)
	{
		$this->db->select('account_id, username, password');
		$this->db->from('accounts');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
	}
	
}