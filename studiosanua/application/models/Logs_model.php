<?php

class Logs_model extends CI_Model {

	public function addLog($level, $message)
	{
		$this->db->insert('logs', array('level' => $level, 'message' => $message, 'datetime' => date('Y-m-d H:i:s')));
	}
	
}