<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../../module/e_403.php"));
}
//
//
//
//
class INFOuser
{
	private $id;
	private $info;
	//
	// ========================================================================
	public function __construct($id)
	{
		$this->id = intval($id);
		if($this->id > 0)
		{
			$temp = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '".$this->id."'", NULL, 0, 1);
			if(isset($temp[1]))
			{
				foreach($temp[1] as $key=>$value)
					$this->info[$key] = $value;
			}
			unset($temp);
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function __destruct()
	{
		
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function info($key, $default = NULL)
	{
		return (isset($this->info[$key])) ? $this->info[$key] : $default;
	}
	// ========================================================================
	// FUNCTII ADITIONALE SPECIFICE FIECARUI PROIECT IN PARTE 
	// ========================================================================
	public function span_age()
	{
		// daca nu s-a inregistrat decesul va afisa varsta in ani (25 ani)
		// in caz contrat va afisa perioana anilor (1988-2003)
		if(isset($this->info[DBT_USER_INFO_C6]) && isset($this->info[DBT_USER_INFO_C7]))
		{
			if(($this->info[DBT_USER_INFO_C6]) && ($this->info[DBT_USER_INFO_C6] != '0000-00-00') && ($this->info[DBT_USER_INFO_C7]) && ($this->info[DBT_USER_INFO_C7] != '0000-00-00'))
				return DataTime::format($this->info[DBT_USER_INFO_C6], 'Y').' - '.DataTime::format($this->info[DBT_USER_INFO_C7], 'Y');
			else
			if(($this->info[DBT_USER_INFO_C6]) && ($this->info[DBT_USER_INFO_C6] != '0000-00-00'))
				return DataTime::age($this->info[DBT_USER_INFO_C6]).' ani';
		}
		else
			return NULL;
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/INFOuser.html
?>