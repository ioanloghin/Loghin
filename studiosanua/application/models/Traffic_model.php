<?php

class Traffic_model extends CI_Model {

	public function countPerDay($date)
	{
		$this->db->where('dateinsert', $date);
		return $this->db->count_all_results('traffic');
	}
	
	public function countTotal()
	{
		return $this->db->count_all_results('traffic');
	}
	
	public function insertVisit($ipAddress, $dateinsert)
	{
		$this->db->limit(1);
		$query = $this->db->get_where('traffic', array('ip' => $ipAddress, 'dateinsert' => $dateinsert));
		if ($query->num_rows() == 0) {
			$this->db->insert('traffic', array('ip' => $ipAddress, 'dateinsert' => $dateinsert));
		}
	}
	
	/*
	 * Will remove all records where < $startDate-$valabilityRange
	 */
	public function clean($startDate, $valabilityRange)
	{
		
	}

}