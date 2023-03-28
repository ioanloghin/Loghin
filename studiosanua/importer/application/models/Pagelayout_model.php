<?php

class Pagelayout_model extends CI_Model {

	public function get_visible($page_name, $item_key)
	{
		$this->db->limit(1);
		$this->db->where('page_name', $page_name);
		$this->db->where('item_key', $item_key);
		$query = $this->db->get('layout_visibility');
		return ($query->num_rows() > 0) ? $query->row()->visible : NULL;
	}
	
	public function update_visible($page_name, $item_key, $val)
	{
		if ($this->exists($page_name, $item_key))
		{
			$this->db->update('layout_visibility', array('visible' => $val),  array('page_name' => $page_name, 'item_key' => $item_key));
		}
		else
		{
			$this->db->insert('layout_visibility', array('visible' => $val, 'page_name' => $page_name, 'item_key' => $item_key));
		}
	}
	
	public function exists($page_name, $item_key)
	{
		$this->db->where('page_name', $page_name);
		$this->db->where('item_key', $item_key);
		$query = $this->db->get('layout_visibility');
		return ($query->num_rows() > 0);
	}
}