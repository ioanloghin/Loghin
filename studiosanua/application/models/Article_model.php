<?php

class Article_model extends CI_Model {

	public function article_item_field_mask($identifier, $item_id, $field)
	{
		return 'article-'.$identifier.'-item-'.$item_id.'-'.$field;
	}

	public function insert_item($identifier)
	{
		$this->db->insert('articles', array('identifier'=>$identifier, 'dateinsert'=>date('Y-m-d H:i:s')));
		return $this->db->insert_id();
	}
	
	public function exists($identifier)
	{
		$this->db->where('identifier', $identifier);
		$query = $this->db->get('articles');
		return ($query->num_rows() > 0);
	}
	
	public function get_item($article_id)
	{
		$this->db->limit(1);
		$this->db->where('article_id', $article_id);
		$query = $this->db->get('articles');
		return $query->row_array();
	}

	public function get_items($identifier, $keyword=NULL, $lang=NULL, $public='1', $index=0, $limit=0)
	{
		if ($identifier) {
			$this->db->where('identifier', $identifier);
		}
		if ($public !== NULL) {
			$this->db->where('public', $public);
		}
		$this->db->order_by('dateinsert', 'desc');
		$this->db->limit($limit, $index);
		$query = $this->db->get('articles');
		
		// Filter by keyword
		if ($keyword !== NULL && !empty($keyword))
		{
			$results=array();
			foreach($query->result_array() as $row)
			{
				$this->db->limit(1);
				$this->db->select('value');
				$this->db->where('lang', $lang);
				$this->db->where('field_key', $this->article_item_field_mask($row['identifier'], $row['article_id'], 'title'));
				$query2 = $this->db->get('languages_content');
				$title = ($query2->num_rows()==1)?$query2->row()->value:NULL;
				if($title && strpos($title, $keyword) !== false) {
					$results[$row['article_id']]=$row;
				}
			}
			return array_values($results);
		}
		
		return $query->result_array();
	}
	
	public function update_item_public($article_id, $val)
	{
		$this->db->update('articles', array('public' => $val),  array('article_id' => $article_id));
	}
	
	public function update_item_identifier($article_id, $val)
	{
		$this->db->update('articles', array('identifier' => $val),  array('article_id' => $article_id));
	}
	
	public function update_item_date($article_id, $val)
	{
		$this->db->update('articles', array('dateinsert' => $val),  array('article_id' => $article_id));
	}
	
	public function remove_item($article_id)
	{
		$this->db->delete('articles', array('article_id' => $article_id));
	}
}