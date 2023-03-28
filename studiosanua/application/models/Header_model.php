<?php

class Header_model extends CI_Model {

	public function get_logo_img()
	{
		$this->db->limit(1);
		$this->db->where('h_key', 'logo_img');
		$query = $this->db->get('header');
		return ($query->num_rows() > 0) ? $query->row()->value : NULL;
	}
	
	public function get_brand_img()
	{
		$this->db->limit(1);
		$this->db->where('h_key', 'brand_img');
		$query = $this->db->get('header');
		return ($query->num_rows() > 0) ? $query->row()->value : NULL;
	}
	
	public function update_logo_img($image_src)
	{
		if ($this->exists('logo_img'))
		{
			$old_image = $this->get_logo_img();
			if ($old_image && $old_image != $image_src) {
				$path=parse_url($old_image, PHP_URL_PATH);
				@unlink($path);
			}
			
			$this->db->update('header', array('value' => $image_src),  array('h_key' => 'logo_img'));
		}
		else
		{
			$this->db->insert('header', array('value' => $image_src, 'h_key' => 'logo_img'));
		}
	}
	
	public function update_brand_img($image_src)
	{
		if ($this->exists('brand_img'))
		{
			$old_image = $this->get_brand_img();
			if ($old_image && $old_image != $image_src) {
				$path=parse_url($old_image, PHP_URL_PATH);
				@unlink($path);
			}
			
			$this->db->update('header', array('value' => $image_src),  array('h_key' => 'brand_img'));
		}
		else
		{
			$this->db->insert('header', array('value' => $image_src, 'h_key' => 'brand_img'));
		}
	}
	
	public function exists($h_key)
	{
		$this->db->where('h_key', $h_key);
		$query = $this->db->get('header');
		return ($query->num_rows() > 0);
	}
}