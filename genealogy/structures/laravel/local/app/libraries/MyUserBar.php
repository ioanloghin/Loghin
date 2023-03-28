<?php

class MyUserBar {
	private static $list = array();
	private static $currentKey = -1;


	function __construct()
	{

	}
	
	public static function getTypes()
	{
		return DB::table('profiles_types')->orderBy('orderid')->get();// db list objects
	}
	
	public static function getTypesFrom($accounts_assoc)
	{
		$types = array();
		foreach($accounts_assoc as $row)
			$types[$row[0][0]] = $row[0][1];
		
		return $types;
	}
	
	public static function getAccountsAssoc($account_id)
	{
		// Get informations from db --------------------------------------------
		// Adults
		MyUserBar::insertAll(MyUserBar::getAdultsVisible($account_id));// Accounts Vizibile
		MyUserBar::insertAll(MyUserBar::getAdultsHidden($account_id));// Accounts Ascunse
		MyUserBar::insertAll(MyUserBar::getAdultsPrivate($account_id));// Accounts Private
		MyUserBar::insertAll(MyUserBar::getAdultsTutor($account_id));// Accounts Tutor
		MyUserBar::insertAll(MyUserBar::getAdultsImported($account_id));// Accounts Importate
		
		// Teenagers
		MyUserBar::insertAll(MyUserBar::getTeenagersVisible($account_id));// Accounts Vizibile
		MyUserBar::insertAll(MyUserBar::getTeenagersHidden($account_id));// Accounts Ascunse
		MyUserBar::insertAll(MyUserBar::getTeenagersPrivate($account_id));// Accounts Private
		MyUserBar::insertAll(MyUserBar::getTeenagersImported($account_id));// Accounts Importate

		// Business
		MyUserBar::insertAll(MyUserBar::getBusinessActivities($account_id));// Accounts Activitati
		MyUserBar::insertAll(MyUserBar::getBusinessManagers($account_id));// Accounts Manageri
		MyUserBar::insertAll(MyUserBar::getBusinessResponsable($account_id));// Accounts Responsabili
		MyUserBar::insertAll(MyUserBar::getBusinessEmployees($account_id));// Accounts Angajati
		MyUserBar::insertAll(MyUserBar::getBusinessPrivate($account_id));// Accounts Private

		// Institutions
		MyUserBar::insertAll(MyUserBar::getInstitutionsVisible($account_id));// Accounts Institutii


		// Return assoc array --------------------------------------------------
		return MyUserBar::$list;
	}
	
	
	
	
	// ----------------------------------------
	// Operation with rows
	private static function insertAll($options)
	{
		foreach($options as $option)
		{
			// SET ROW ---------------------------------------
			MyUserBar::newRow($option[0][0], $option[0][1]);
			MyUserBar::setRowOption(1, $option[1][0], $option[1][1]);
			MyUserBar::setRowOption(2, $option[2][0], $option[2][1]);
			MyUserBar::setRowOption(3, $option[3][0], $option[3][1]);
			// -----------------------------------------------
		}
	}
	
	// Create new row
	private static function newRow($type_id, $type_name)
	{
		MyUserBar::$list[++MyUserBar::$currentKey] = array(
			0 => array($type_id, $type_name),
		);
	}
	
	// Set option at current row
	private static function setRowOption($opt_pos, $opt_id, $opt_name)
	{
		MyUserBar::$list[MyUserBar::$currentKey][$opt_pos] = array($opt_id, $opt_name);
	}
	
	
	// ------------------------------------
	// Adults accounts
	private static function getAdultsVisible($account_id)
	{
		// config ------
		$type_id = 1;
		// end config ---
		
		$options = array();
		$i_options=-1;
		$type_name = DB::table('profiles_types')->where('type_id', $type_id)->pluck('name');
		$type_name .= ' Vizibil';
		
		// Parcurge accounturile
		$accounts = DB::table('accounts')
			->where('account_id',$account_id)
			->where('active','1')
			->get();
		foreach($accounts as $k => $acc)
		{
			// NEW ROW ---------------------------------------
			++$i_options;
			$options[$i_options][0] = array($type_id, $type_name);
			// -----------------------------------------------
			
			// SET ROW OPTION --------------------------------
			$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
			// -----------------------------------------------
			
			$nicknames = DB::table('accounts_nicknames')->where('account_id',$acc->account_id)->get();
			
			$i=0;
			$len=count($nicknames);
			foreach($nicknames as $nic)
			{
				// SET ROW OPTION --------------------------------
				$options[$i_options][2] = array($nic->nickname_id, $nic->nickname);
				// -----------------------------------------------
				
				$profile = DB::table('accounts_profiles')
								->join('profiles', 'accounts_profiles.profile_id', '=', 'profiles.profile_id')
								->where('nickname_id',$nic->nickname_id)
								->select('profiles.profile_id AS profile_id', 'profiles.name AS name')
								->first();
				
				// SET ROW OPTION --------------------------------
				$options[$i_options][3] = array($profile->profile_id, $profile->name);
				// -----------------------------------------------
				
				if ($i++ < $len-1)
				{
					// NEW ROW ---------------------------------------
					++$i_options;
					$options[$i_options][0] = array($type_id, $type_name);
					// -----------------------------------------------
					// SET ROW OPTION --------------------------------
					$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
					// -----------------------------------------------
				}
			}
		}
		
		return $options;
	}
	
	private static function getAdultsHidden($account_id)
	{
		// config ------
		$type_id = 1;
		// end config ---
		
		$options = array();
		$i_options=-1;
		$type_name = DB::table('profiles_types')->where('type_id', $type_id)->pluck('name');
		$type_name .= ' Ascuns';
		
		// Parcurge accounturile
		$accounts = DB::table('accounts')
			->where('account_id',$account_id)
			->where('active','0')
			->get();
		foreach($accounts as $k => $acc)
		{
			// NEW ROW ---------------------------------------
			++$i_options;
			$options[$i_options][0] = array($type_id, $type_name);
			// -----------------------------------------------
			
			// SET ROW OPTION --------------------------------
			$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
			// -----------------------------------------------
			
			$nicknames = DB::table('accounts_nicknames')->where('account_id',$acc->account_id)->get();
			
			$i=0;
			$len=count($nicknames);
			foreach($nicknames as $nic)
			{
				// SET ROW OPTION --------------------------------
				$options[$i_options][2] = array($nic->nickname_id, $nic->nickname);
				// -----------------------------------------------
				
				$profile = DB::table('accounts_profiles')
								->join('profiles', 'accounts_profiles.profile_id', '=', 'profiles.profile_id')
								->where('nickname_id',$nic->nickname_id)
								->select('profiles.profile_id AS profile_id', 'profiles.name AS name')
								->first();
				
				// SET ROW OPTION --------------------------------
				$options[$i_options][3] = array($profile->profile_id, $profile->name);
				// -----------------------------------------------
				
				if ($i++ < $len-1)
				{
					// NEW ROW ---------------------------------------
					++$i_options;
					$options[$i_options][0] = array($type_id, $type_name);
					// -----------------------------------------------
					// SET ROW OPTION --------------------------------
					$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
					// -----------------------------------------------
				}
			}
		}
		
		return $options;
	}
	
	private static function getAdultsPrivate($account_id)
	{
		// config ------
		$type_id = 1;
		// end config ---
		
		$options = array();
		$i_options=-1;
		$type_name = DB::table('profiles_types')->where('type_id', $type_id)->pluck('name');
		$type_name .= ' Private';
		
		// Parcurge accounturile
		$accounts = DB::table('accounts')
			->where('account_id',$account_id)
			->where('type','private')
			->get();
		foreach($accounts as $k => $acc)
		{
			// NEW ROW ---------------------------------------
			++$i_options;
			$options[$i_options][0] = array($type_id, $type_name);
			// -----------------------------------------------
			
			// SET ROW OPTION --------------------------------
			$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
			// -----------------------------------------------
			
			$nicknames = DB::table('accounts_nicknames')->where('account_id',$acc->account_id)->get();
			
			$i=0;
			$len=count($nicknames);
			foreach($nicknames as $nic)
			{
				// SET ROW OPTION --------------------------------
				$options[$i_options][2] = array($nic->nickname_id, $nic->nickname);
				// -----------------------------------------------
				
				$profile = DB::table('accounts_profiles')
								->join('profiles', 'accounts_profiles.profile_id', '=', 'profiles.profile_id')
								->where('nickname_id',$nic->nickname_id)
								->select('profiles.profile_id AS profile_id', 'profiles.name AS name')
								->first();
				
				// SET ROW OPTION --------------------------------
				$options[$i_options][3] = array($profile->profile_id, $profile->name);
				// -----------------------------------------------
				
				if ($i++ < $len-1)
				{
					// NEW ROW ---------------------------------------
					++$i_options;
					$options[$i_options][0] = array($type_id, $type_name);
					// -----------------------------------------------
					// SET ROW OPTION --------------------------------
					$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
					// -----------------------------------------------
				}
			}
		}
		
		return $options;
	}
	
	private static function getAdultsTutor($account_id)
	{
		// config ------
		$type_id = 1;
		// end config ---
		
		$options = array();
		$i_options=-1;
		$type_name = DB::table('profiles_types')->where('type_id', $type_id)->pluck('name');
		$type_name .= ' Tutor';
		
		// Parcurge accounturile
		$accounts = DB::table('accounts_owners')
			->join('accounts', 'accounts_owners.account_id', '=', 'accounts.account_id')
			->where('owner_id',$account_id)
			->get();
		
		foreach($accounts as $k => $acc)
		{
			// NEW ROW ---------------------------------------
			++$i_options;
			$options[$i_options][0] = array($type_id, $type_name);
			// -----------------------------------------------
			
			// SET ROW OPTION --------------------------------
			$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
			// -----------------------------------------------
			
			$nicknames = DB::table('accounts_owners_nicknames')
				->where('owner_id',$account_id)
				->where('account_id',$acc->account_id)
				->get();
			
			$i=0;
			$len=count($nicknames);
			
			if($len == 0)
			{
				// SET ROW OPTION --------------------------------
				$options[$i_options][2] = array(0, 'N/A');
				// -----------------------------------------------
				
				// SET ROW OPTION --------------------------------
				$options[$i_options][3] = array(0, 'N/A');
				// -----------------------------------------------
			}
			
			foreach($nicknames as $nic)
			{
				// SET ROW OPTION --------------------------------
				$options[$i_options][2] = array($nic->account_id, $nic->nickname);
				// -----------------------------------------------
				
				// SET ROW OPTION --------------------------------
				$options[$i_options][3] = array($nic->account_id, $nic->nickname);
				// -----------------------------------------------
				
				if ($i++ < $len-1)
				{
					// NEW ROW ---------------------------------------
					++$i_options;
					$options[$i_options][0] = array($type_id, $type_name);
					// -----------------------------------------------
					// SET ROW OPTION --------------------------------
					$options[$i_options][1] = array($acc->loghin_id, $acc->loghin_id);
					// -----------------------------------------------
				}
			}
		}
		
		return $options;
	}
	
	private static function getAdultsImported($account_id)
	{
		return array();
	}
	
	// ------------------------------------
	// Teenagers accounts
	private static function getTeenagersVisible($account_id)
	{
		return array();
	}
	
	private static function getTeenagersHidden($account_id)
	{
		return array();
	}
	
	private static function getTeenagersPrivate($account_id)
	{
		return array();
	}
	
	private static function getTeenagersImported($account_id)
	{
		return array();
	}
	
	// ------------------------------------
	// Bussiness accounts
	private static function getBusinessActivities($account_id)
	{
		return array();
	}
	
	private static function getBusinessManagers($account_id)
	{
		return array();
	}
	
	private static function getBusinessResponsable($account_id)
	{
		return array();
	}
	
	private static function getBusinessEmployees($account_id)
	{
		return array();
	}
	
	private static function getBusinessPrivate($account_id)
	{
		return array();
	}
	

	// ------------------------------------
	// Institutions accounts
	private static function getInstitutionsVisible($account_id)
	{
		return array();
	}
}