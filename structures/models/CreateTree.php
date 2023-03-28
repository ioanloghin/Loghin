<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class CreateTree extends SQL_DB
{
	private $info_child; // (array) informatii despre copil (userul care creaza arborele)
	private $info_parent1; // (array) informatii despre primul parinte
	private $info_parent2; // (array) informatii despre al doilea parinte
	
	public function __construct()
	{
		
		
	}
	
	public function set_child_info($info)
	{
		if(is_array($info))
		{
			$this->info_child = $info;
			return true;
		}
		else
			return false;
	}
	
	public function set_parent1_info($info)
	{
		if(is_array($info))
		{
			$this->info_parent1 = $info;
			return true;
		}
		else
			return false;
	}
	
	public function set_parent2_info($info)
	{
		if(is_array($info))
		{
			$this->info_parent2 = $info;
			return true;
		}
		else
			return false;
	}
	
	public function get_var($member, $var)
	{
		$array_name = 'info_'.$member;
		return (isset($this->$array_name) && isset($this->$array_name[$var])) ? $this->$array_name[$var] : NULL;
	}
	
}