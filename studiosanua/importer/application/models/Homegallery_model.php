<?php

class Homegallery_model extends CI_Model {

	public function gallery_item_field_mask($item_id, $field)
	{
		return 'homegallery-item-'.$item_id.'-'.$field;
	}
	
	public function gallery_subitem_field_mask($slideshow_id, $field)
	{
		return 'homegallery-subitem-'.$slideshow_id.'-'.$field;
	}

	public function get_item($item_id)
	{
		$this->db->limit(1);
		$this->db->where('category_id', $item_id);
		$query = $this->db->get('slideshow_categories');
		return $query->row_array();
	}
	
	public function get_subitem($slideshow_id)
	{
		$this->db->limit(1);
		$this->db->where('slideshow_id', $slideshow_id);
		$query = $this->db->get('slideshow');
		return $query->row_array();
	}

	public function get_items()
	{
		$this->db->order_by('orderid', 'asc');
		$query = $this->db->get('slideshow_categories');
		return $query->result_array();
	}
	
	public function get_subitems($item_id)
	{
		$this->db->order_by('orderid', 'asc');
		$this->db->where('category_id', $item_id);
		$query = $this->db->get('slideshow');
		return $query->result_array();
	}
	
	public function insert_item()
	{
		$this->db->insert('slideshow_categories', array('orderid' => $this->get_item_max_orderid()+1));
		return $this->db->insert_id();
	}
	
	public function insert_subitem($item_id)
	{
		$this->db->insert('slideshow', array('category_id' => $item_id, 'orderid' => $this->get_subitem_max_orderid($item_id)+1));
		return $this->db->insert_id();
	}
	
	public function update_item_link($item_id, $link)
	{
		$this->db->update('slideshow_categories', array('url' => $link),  array('category_id' => $item_id));
	}
	
	public function update_subitem_link($slideshow_id, $link)
	{
		$this->db->update('slideshow', array('url' => $link),  array('slideshow_id' => $slideshow_id));
	}
	
	public function update_subitem_image($slideshow_id, $image_src)
	{
		$subitem = $this->get_subitem($slideshow_id);
		if ($subitem['image'] && $subitem['image'] != $image_src) {
			$path=parse_url($subitem['image'], PHP_URL_PATH);
			@unlink($path);
		}
		return $this->db->update('slideshow', array('image' => $image_src),  array('slideshow_id' => $slideshow_id));
	}
	
	public function item_orderid_up($item_id)
	{
		$item = $this->get_item($item_id);
		
		$this->db->where('orderid <', $item['orderid']);
		$this->db->order_by("orderid", "desc");
		$query = $this->db->get('slideshow_categories');
		$target = $query->row_array();
		
		$this->switch_items_orderid($item_id, $target['category_id']);
	}
	
	public function item_orderid_down($item_id)
	{
		$item = $this->get_item($item_id);
		
		$this->db->where('orderid >', $item['orderid']);
		$this->db->order_by("orderid", "asc");
		$query = $this->db->get('slideshow_categories');
		$target = $query->row_array();
		
		$this->switch_items_orderid($item_id, $target['category_id']);
	}
	
	public function subitem_orderid_up($subitem_id)
	{
		$subitem = $this->get_subitem($subitem_id);
		
		$this->db->where('orderid <', $subitem['orderid']);
		$this->db->where('category_id', $subitem['category_id']);
		$this->db->order_by("orderid", "desc");
		$query = $this->db->get('slideshow');
		$target = $query->row_array();
		
		$this->switch_subitems_orderid($subitem_id, $target['slideshow_id']);
	}
	
	public function subitem_orderid_down($subitem_id)
	{
		$subitem = $this->get_subitem($subitem_id);
		
		$this->db->where('orderid >', $subitem['orderid']);
		$this->db->where('category_id', $subitem['category_id']);
		$this->db->order_by("orderid", "asc");
		$query = $this->db->get('slideshow');
		$target = $query->row_array();
		
		$this->switch_subitems_orderid($subitem_id, $target['slideshow_id']);
	}
	
	
	public function remove_item($item_id)
	{
		$this->db->delete('slideshow', array('category_id' => $item_id));
		$this->db->delete('slideshow_categories', array('category_id' => $item_id));
	}
	
	public function remove_subitem($slideshow_id)
	{
		$this->db->delete('slideshow', array('slideshow_id' => $slideshow_id));
	}
	
	private function switch_items_orderid($item_id1, $item_id2)
	{
		$item1 = $this->get_item($item_id1);
		$item2 = $this->get_item($item_id2);
		
		$this->db->update('slideshow_categories', array('orderid' => $item2['orderid']),  array('category_id' => $item_id1));
		$this->db->update('slideshow_categories', array('orderid' => $item1['orderid']),  array('category_id' => $item_id2));
	}
	
	private function switch_subitems_orderid($slideshow_id1, $slideshow_id2)
	{
		$subitem1 = $this->get_subitem($slideshow_id1);
		$subitem2 = $this->get_subitem($slideshow_id2);
		
		$this->db->update('slideshow', array('orderid' => $subitem2['orderid']),  array('slideshow_id' => $slideshow_id1));
		$this->db->update('slideshow', array('orderid' => $subitem1['orderid']),  array('slideshow_id' => $slideshow_id2));
	}
	
	private function get_item_max_orderid()
	{
		$this->db->select_max('orderid');
		$query = $this->db->get('slideshow_categories');
		return $query->row()->orderid;
	}
	
	private function get_subitem_max_orderid($item_id)
	{
		$this->db->select_max('orderid');
		$this->db->where('category_id', $item_id);
		$query = $this->db->get('slideshow');
		return $query->row()->orderid;
	}

}