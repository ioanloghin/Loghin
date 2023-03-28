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
		
		$this->ID = ($family_id == 0) ? $id : $this->insert($id, $family_id, $account_id, $grade);
	}
	
	// --------------------------------------------
	
	// int insert(int, int, int, string)
	private function insert($owner_account_id, $family_id, $account_id, $grade)
	{
		Approval::$acc_api->approval_insert($owner_account_id, $family_id, $account_id, $grade);
	}
	
	// --------------------------------------------
	
	// string select()
	public function getdb()
	{
		return Approval::$acc_api->approval_select($this->ID);
	}
	
	// --------------------------------------------
	
	// void delete(int)
	public function delete()
	{
		return Approval::$acc_api->approval_delete($this->ID);
	}
	
	// --------------------------------------------
	
	// array family()
	// returneaza toti membrii familiei
	public function family()
	{
		$families_members_approvals = $this->getdb();
		
		$family = array(0=>0, 1=>0, 2=>array());
		$p=0;
		$arr = Approval::$acc_api->sql_select(DB_PREFIX."families_members", "family_id = '".$families_members_approvals['family_id']."'");
		foreach($arr as $row)
		{
			if($row['grade'] == 'parent')
				$family[$p++] = $row['account_id'];	
		}
		
		foreach($arr as $row)
		{
			if($row['grade'] == 'child')
				$family[2][] = $row['account_id'];	
		}
		return $family;
	}
	
	// --------------------------------------------
}

?>