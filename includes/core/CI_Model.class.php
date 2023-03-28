<?php  if (!defined('SYS_PATH')) exit('No direct script access allowed');

class CI_Model
{
	protected $db;
	protected $session;
	
	public function __construct() {
		$this->db = new CI_DB();
		$this->session = new CI_SESS();
	}
}
//
//
// END Circular class

/* End of file Circular.php */
/* Location: ./libraries/Circular.php */