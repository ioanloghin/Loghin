<?php

class Languages_model extends CI_Model {

		public function content_item_field_mask($page_name, $menu1_id=0, $menu2_id=0)
		{
			$content_key='pagecontent-'.$page_name;
			if ($menu1_id!=0) {
				$content_key.='-'.$menu1_id.'-'.$menu2_id;
			}
			return $content_key;
		}

        public function get()
        {
			$this->db->order_by('primary_lang', 'desc');
			$query = $this->db->get('languages');
			return $query->result_array();
        }
		
		public function get_primary()
        {
			$this->db->limit(1);
			$query = $this->db->get_where('languages', array('primary_lang' => '1'));
			return $query->row_array();
        }
		
        public function insert($lang, $label)
        {
        	$this->db->insert('languages', array('lang' => $lang, 'label' => $label));
        }
		
		public function update($lang, $label)
        {
        	$this->db->update('languages', array('label' => $label),  array('lang' => $lang));
        }
		
		public function exists($lang)
        {
			$this->db->where('lang', $lang);
			$query = $this->db->get('languages');
			return ($query->num_rows() > 0);
        }
		
		public function remove($lang)
        {
			$this->db->delete('languages', array('lang' => $lang));
        }
		
		// ----------------------------------------------------------------------
		// Content
		// ----------------------------------------------------------------------
		public function get_content($key, $lang)
		{
			$this->db->limit(1);
			$this->db->select('value');
			$this->db->where('field_key', $key);
			$this->db->where('lang', $lang);
			$query = $this->db->get('languages_content');
			return $query->num_rows()==1?$query->row_array()['value']:NULL;
		}

		public function save_content($key, $lang, $val)
        {
			$this->db->limit(1);
			$this->db->select('value');
			$this->db->where('field_key', $key);
			$this->db->where('lang', $lang);
			$query = $this->db->get('languages_content');
			
			if ($query->num_rows() == 1) {
				$this->db->update('languages_content', array('value' => $val),  array('field_key' => $key, 'lang' => $lang));
			}
			else {
				$this->db->insert('languages_content', array('field_key' => $key, 'lang' => $lang, 'value' => $val));
			}
        }
		
		public function remove_content($key, $lang = NULL)
        {
			$where = array('field_key' => $key);
			if($lang !== NULL) {
				$where['lang'] = $lang;
			}
			$this->db->delete('languages_content', $where);
        }
}