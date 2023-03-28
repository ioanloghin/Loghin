<?php

class Contact_model extends CI_Model {

	public function update_map($value)
	{
		$this->_updateValue('map', $value);
	}
	
	public function update_email($value)
	{
		$this->_updateValue('email', $value);
	}
	
	public function update_email_cc($value)
	{
		$this->_updateValue('email_cc', $value);
	}
	
	public function get_map()
	{
		return $this->_getValue('map');
	}
	
	public function get_email()
	{
		return $this->_getValue('email');
	}
	
	public function get_email_cc()
	{
		return $this->_getValue('email_cc');
	}
	
	private function _updateValue($id, $value)
	{
		$this->db->update('contact', array('value' => $value),  array('id' => $id));
	}
	
	private function _getValue($id)
	{
		$this->db->limit(1);
		$this->db->where('id', $id);
		$query = $this->db->get('contact');
		if ($query->num_rows()==1) {
			return $query->row()->value;
		}
		return NULL;
	}
}