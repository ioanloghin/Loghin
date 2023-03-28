<?php

class Approval
{
	static private $acc_api = false;
	private $ID;
	
	// --------------------------------------------
	
	// Approval(int)
	// Approval(int, int, int, string)
	public function __construct($id, $family_id = 0, $account_id = 0, $grade = '')
	{
		if(!Approval::$acc_api)
			Approval::$acc_api = new Accounts_API();
		
		$this->ID = ($family_id == 0) ? $id : insert($id, $family_id, $account_id, $grade);
	}
	
	// --------------------------------------------
	
	// int insert(int, int, int, string)
	private function insert($owner_account_id, $family_id, $account_id, $grade)
	{
		Approval::$acc_api->approval_insert($owner_account_id, $family_id, $account_id, $grade);
	}
	
	// --------------------------------------------
	
	// string select(int)
	private function select($approval_id)
	{
		Approval::$acc_api->approval_select($approval_id);
	}
	
	// --------------------------------------------
	
	// void delete(int)
	public function delete($approval_id)
	{
		
	}
}

?>