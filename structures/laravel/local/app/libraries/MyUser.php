<?php

class MyUser {
	private $account_id;
	
	function __construct($account_id)
	{
		$this->account_id = $account_id;
		
		$this->init();
	}
	
	public function getAccountId()
	{
		return $this->account_id;
	}
	
	private function init()
	{
		
	}
}