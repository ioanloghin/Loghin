<?php

class Menu_model extends CI_Model {

		public function menu_item_field_mask($identifier, $item_id, $field)
		{
			return 'menu-'.$identifier.'-item-'.$item_id.'-'.$field;
		}
		
		public function menu_subitem_field_mask($identifier, $subitem_id, $field)
		{
			return 'menu-'.$identifier.'-subitem-'.$subitem_id.'-'.$field;
		}

		public function insert_menu($identifier)
        {
			$this->db->insert('menu', array('identifier'=>$identifier));
			return $this->db->insert_id();
        }
		
		public function exists($identifier)
        {
			$this->db->where('identifier', $identifier);
			$query = $this->db->get('menu');
			return ($query->num_rows() > 0);
        }
		
		public function get_item($item_id)
        {
			$this->db->limit(1);
			$this->db->where('item_id', $item_id);
			$query = $this->db->get('menu_items');
			return $query->row_array();
        }
		
		public function get_subitem($subitem_id)
        {
			$this->db->limit(1);
			$this->db->where('subitem_id', $subitem_id);
			$query = $this->db->get('menu_subitems');
			return $query->row_array();
        }

        public function get_items($identifier)
        {
			$this->db->order_by('priority', 'asc');
			$this->db->where('identifier', $identifier);
			$query = $this->db->get('menu_items');
			return $query->result_array();
        }
		
		public function get_subitems($item_id)
        {
			$this->db->order_by('priority', 'asc');
			$this->db->where('item_id', $item_id);
			$query = $this->db->get('menu_subitems');
			return $query->result_array();
        }
		
        public function insert_item($identifier)
        {
			if (!$this->exists($identifier))
			{
				$this->insert_menu($identifier);
			}
			
        	$this->db->insert('menu_items', array('identifier'=>$identifier, 'priority' => $this->get_item_max_priority($identifier)+1));
			return $this->db->insert_id();
        }
		
		public function insert_subitem($item_id)
        {
        	$this->db->insert('menu_subitems', array('item_id' => $item_id, 'priority' => $this->get_subitem_max_priority($item_id)+1));
			return $this->db->insert_id();
        }
		
		public function update_item_link($item_id, $link)
        {
        	$this->db->update('menu_items', array('link' => $link),  array('item_id' => $item_id));
        }
		
		public function update_item_icon($item_id, $icon)
        {
        	$this->db->update('menu_items', array('icon' => $icon),  array('item_id' => $item_id));
        }
		
		public function update_subitem_link($subitem_id, $link)
        {
        	$this->db->update('menu_subitems', array('link' => $link),  array('subitem_id' => $subitem_id));
        }
		
		public function update_subitem_icon($subitem_id, $icon)
        {
        	$this->db->update('menu_subitems', array('icon' => $icon),  array('subitem_id' => $subitem_id));
        }
		
		public function item_priority_up($identifier, $item_id)
		{
			$item = $this->get_item($item_id);
			
			$this->db->where('priority <', $item['priority']);
			$this->db->where('identifier', $identifier);
			$this->db->order_by("priority", "desc");
			$query = $this->db->get('menu_items');
			$target = $query->row_array();
			
			$this->switch_items_priority($item_id, $target['item_id']);
		}
		
		public function item_priority_down($identifier, $item_id)
		{
			$item = $this->get_item($item_id);
			
			$this->db->where('priority >', $item['priority']);
			$this->db->where('identifier', $identifier);
			$this->db->order_by("priority", "asc");
			$query = $this->db->get('menu_items');
			$target = $query->row_array();
			
			$this->switch_items_priority($item_id, $target['item_id']);
		}
		
		
		public function remove_item($item_id)
        {
			$this->db->delete('menu_subitems', array('item_id' => $item_id));
			$this->db->delete('menu_items', array('item_id' => $item_id));
        }
		
		public function remove_subitem($subitem_id)
        {
			$this->db->delete('menu_subitems', array('subitem_id' => $subitem_id));
        }
		
		private function switch_items_priority($item_id1, $item_id2)
        {
			$item1 = $this->get_item($item_id1);
			$item2 = $this->get_item($item_id2);
			
			$this->db->update('menu_items', array('priority' => $item2['priority']),  array('item_id' => $item_id1));
			$this->db->update('menu_items', array('priority' => $item1['priority']),  array('item_id' => $item_id2));
        }
		
		private function switch_subitems_priority($subitem_id1, $subitem_id2)
        {
			$subitem1 = $this->get_subitem($subitem_id1);
			$subitem2 = $this->get_subitem($subitem_id2);
			
			$this->db->update('menu_subitems', array('priority' => $subitem2['priority']),  array('subitem_id' => $subitem_id1));
			$this->db->update('menu_subitems', array('priority' => $subitem1['priority']),  array('subitem_id' => $subitem_id2));
        }
		
		private function get_item_max_priority($identifier)
        {
			$this->db->select_max('priority');
			$this->db->where('identifier', $identifier);
			$query = $this->db->get('menu_items');
			return $query->row()->priority;
        }
		
		private function get_subitem_max_priority($item_id)
        {
			$this->db->select_max('priority');
			$this->db->where('item_id', $item_id);
			$query = $this->db->get('menu_subitems');
			return $query->row()->priority;
        }

}