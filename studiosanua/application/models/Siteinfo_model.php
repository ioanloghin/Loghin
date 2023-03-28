<?php

class Siteinfo_model extends CI_Model {

        public function get($key)
        {
			$query = $this->db->get_where('siteinfo', array('id' => $key));
			if ($query->num_rows() > 0)
			{
				return $query->row()->value;
			}
			return NULL;
        }

        public function insert_entry()
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function update($key, $value)
        {
        	$this->db->update('siteinfo', array('value' => $value), array('id' => $key));
        }

}