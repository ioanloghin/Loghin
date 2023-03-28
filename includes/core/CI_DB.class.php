<?php  if (!defined('SYS_PATH')) exit('No direct script access allowed');

class CI_RESULT {
	
	private $query;
	
	public function __construct($sql, $db) {
		$this->query = $db->query($sql);
	}
	
	public function result_array() {
		$result=array();
		if($this->query) {
			foreach($this->query as $row) {
				$result[]=$row;
			}
			return $result;
		}
		return false;
	}
	
	public function row_array() {
		if($this->query) {
			foreach($this->query as $row) {
				return $row;
			}
		}
		return false;
	}
	
}

class CI_DB
{
	private $_select;
	private $_where;
	private $_order_by;
	private $_limit;
	private $offset;
	private $_join;
	private static $db;
	private $_prefix = 'l_';
	
	public function __construct() {
		CI_DB::$db = new PDO('mysql:host=localhost;dbname=loghin_register;charset=utf8mb4', 'loghin_structure', 'IVT5fvIyC5xuVbF');
	}
	
	public function select($val) {
		$this->_select=$val;
	}
	
	public function where($key, $val) {
		if($this->_where) {
			$this->_where.=" AND ";
		}
		else {
			$this->_where="";
		}
		$this->_where.= "$key = '$val'";
	}
	
	public function order_by($key, $val='asc') {
		if($this->_order_by) {
			$this->_order_by.=",";
		}
		else {
			$this->_order_by="";
		}
		$this->_order_by.=$key.' '.$val;
	}
	
	public function limit($_limit, $offset=0) {
		$this->_limit = $_limit;
		$this->offset = $offset;
	}
	
	public function join($table, $using) {
		$this->_join = "LEFT JOIN ".$this->_prefix."$table ON $using";
	}
	
	public function get($table) {
		
		$sql = "SELECT ".(($this->_select)?$this->_select:'*')." FROM ".$this->_prefix."$table ";
		if($this->_join) {
			$sql .= " ".$this->_join;
		}
		if($this->_where) {
			$sql .= " WHERE ".$this->_where;
		}
		if($this->_order_by) {
			$sql .= " ORDER BY ".$this->_order_by;
		}
		if($this->_limit) {
			$sql .= " LIMIT ".$this->offset.",".$this->_limit;
		}
		
		$this->reset();
		return new CI_RESULT($sql, CI_DB::$db);
	}
	
	private function reset() {
		$this->_select = NULL;
		$this->_where = NULL;
		$this->_order_by = NULL;
		$this->_limit = NULL;
		$this->offset = NULL;
		$this->_join = NULL;
	}
	
}
//
//
// END CI_DB class

/* End of file CI_DB.php */
/* Location: ./libraries/CI_DB.php */