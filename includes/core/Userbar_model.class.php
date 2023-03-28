<?php  if (!defined('SYS_PATH')) exit('No direct script access allowed');

class Userbar_model extends CI_Model
{
	private $list = array();
	private $currentKey=0;// folosit pentru a genera next and prev profile
	
	public static function getTypes() {
		return DB::table('profiles_types')->orderBy('orderid')->get();// db list objects
	}
	
	
	public function getTypesFrom($accounts_assoc) {
		$types = array();
		foreach($accounts_assoc as $row)
			$types[$row[0][0]] = $row[0][1];
		
		return $types;
	}
	
	public function getAccountsId($root_id) {
		$this->db->select('account_id');  
		$this->db->where('root_id',$root_id);
		$this->db->order_by('account_id','asc');
		$query = $this->db->get('roots_accounts');
		$ids = array();
		foreach($query->result_array() as $row) {
			$ids[] = $row['account_id'];
		}
		
		return $ids;
	}
	
	public function getAccounts($root_id) {
		
		$this->db->select('ra.account_id as account_id, firstname, lastname');  
		$this->db->where('root_id',$root_id);
		$this->db->order_by('ra.account_id','asc');
		$this->db->join('accounts a','a.account_id = ra.account_id');
		$query = $this->db->get('roots_accounts ra');
		return $query->result_array();
		
	}
	
	public function getNicknames($account_id) {
		
		$this->db->select('nickname_id, nickname'); 
		$this->db->where('account_id',$account_id);
		$query = $this->db->get('accounts_nicknames'); 
		return $query->result_array();
		
	}
	
	public function getPrevRecord() {
		
		$this_key = ($this->currentKey==0)?count($this->list)-1:$this->currentKey-1;
		$record = $this->list[$this_key];
		
		return $record;
	}
	
	public function getNextRecord() {
		
		$this_key = ($this->currentKey==count($this->list)-1)?0:$this->currentKey+1;
		$record = $this->list[$this_key];
		
		return $record;
	}
	
	public function getRecords($account_id) {
		// Get informations from db --------------------------------------------
		$records = array();
		// Adults
		$temp = $this->_getAdultsVisible($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}
		//Userbar_model::insertAll(Userbar_model::_getAdultsHidden($account_id));// Accounts Ascunse
		$temp = $this->_getAdultsPrivate($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}
		/*Userbar_model::insertAll(Userbar_model::getAdultsTutor($account_id));// Accounts Tutor
		Userbar_model::insertAll(Userbar_model::getAdultsImported($account_id));// Accounts Importate*/
		
		// Teenagers
		$temp = $this->_getTeenagersVisible($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}
		//Userbar_model::insertAll(Userbar_model::getTeenagersHidden($account_id));// Accounts Ascunse
		$temp = $this->_getTeenagersPrivate($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}
		/*Userbar_model::insertAll(Userbar_model::getTeenagersPrivate($account_id));// Accounts Private
		Userbar_model::insertAll(Userbar_model::getTeenagersImported($account_id));// Accounts Importate*/

		// Business
		$temp = $this->_getBusinessActivities($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}
		/*Userbar_model::insertAll(Userbar_model::getBusinessManagers($account_id));// Accounts Manageri
		Userbar_model::insertAll(Userbar_model::getBusinessResponsable($account_id));// Accounts Responsabili
		Userbar_model::insertAll(Userbar_model::getBusinessEmployees($account_id));// Accounts Angajati*/
		$temp = $this->_getBusinessPrivate($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}

		// Institutions
		$temp = $this->_getInstitutionsVisible($account_id);
		if($temp) {
			foreach($temp as $rec) {
				$records[] = $rec;
			}
		}
		//$this->list = array_merge($this->list, $options);
		// Return assoc array --------------------------------------------------
		return $records;
	}
	
	
	// Operation with rows
	private function _insertAll($options) {
		foreach($options as $option)
		{
			// SET ROW ---------------------------------------
			$this->_newRow($option[0][0], $option[0][1]);
			
			for($k=1;$k<=3;++$k) {
				if(isset($option[$k][0]) && $option[$k][1]) {
					$this->_setRowOption($k, $option[$k][0], $option[$k][1]);
				}
				else {
					$this->_setRowOption($k, '', '');
				}
			}
			// -----------------------------------------------
		}
	}
	
	
	// Create new row
	//private function _newRow($type_id, $type_name) {
	//	$this->list[++$this->currentKey] = array(
	//		0 => array($type_id, $type_name),
	//	);
	//}
	
	
	// Set option at current row
	//private function _setRowOption($opt_pos, $opt_id, $opt_name) {
	//	$this->list[$this->currentKey][$opt_pos] = array($opt_id, $opt_name);
	//}
	
	
	// Adults accounts
	private function _getAdultsVisible($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		//$this->db->select('account_id,firstname,lastname,loghin_id'); 
		$this->db->order_by('a.firstname','asc');
		$this->db->join('profiles p', 'a.account_id = p.account_id');
		$this->db->where('a.account_id',$account_id);
		$this->db->where('a.type','public');
		$this->db->where('p.type_id','1');
		
		$query = $this->db->get('accounts a');
		foreach($query->result_array() as $k => $account){
			$record = new UserBarRecord(UserBarRecord::ADULT);
			
			// Set Account
			$record->setAccount($account['account_id'], $account['firstname'].' '.$account['lastname']);
			
			// Set User
			$record->setUser($account['loghin_id'], $account['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}
			
			// Set Profiles
			$this->db->select('profile_id, name'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('profiles');
			
			foreach ($query->result_array() as $row) {
				$record->setProfile($row['profile_id'], $row['name']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}
	
	private static function _getAdultsHidden($account_id) {
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
	
	private function _getAdultsPrivate($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		//$this->db->select('account_id,firstname,lastname,loghin_id'); 
		$this->db->order_by('a.firstname','asc');
		$this->db->join('profiles p', 'a.account_id = p.account_id');
		$this->db->where('a.account_id',$account_id);
		$this->db->where('a.type','private');
		$this->db->where('p.type_id','1');
		
		$query = $this->db->get('accounts a');
		foreach($query->result_array() as $k => $account){
			$record = new UserBarRecord(UserBarRecord::ADULT);
			
			// Set Account
			$record->setAccount($account['account_id'], $account['firstname'].' '.$account['lastname']);
			
			// Set User
			$record->setUser($account['loghin_id'], $account['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}

			// Set Profiles
			$this->db->select('profile_id, name'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('profiles');
			
			foreach ($query->result_array() as $row) {
				$record->setProfile($row['profile_id'], $row['name']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}
	
	private static function getAdultsTutor($account_id) {
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
	
	private static function getAdultsImported($account_id) {
		return array();
	}
	
	// ------------------------------------
	// Teenagers accounts
	private function _getTeenagersVisible($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		//$this->db->select('account_id,firstname,lastname,loghin_id'); 
		$this->db->order_by('a.firstname','asc');
		$this->db->join('profiles p', 'a.account_id = p.account_id');
		$this->db->where('a.account_id',$account_id);
		$this->db->where('a.type','public');
		$this->db->where('p.type_id','2');
		
		$query = $this->db->get('accounts a');
		foreach($query->result_array() as $k => $account) {
			$record = new UserBarRecord(UserBarRecord::TEENAGER);
			
			// Set Account
			$record->setAccount($account['account_id'], $account['firstname'].' '.$account['lastname']);
			
			// Set User
			$record->setUser($account['loghin_id'], $account['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}
			
			// Set Profiles
			$this->db->select('profile_id, name'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('profiles');
			
			foreach ($query->result_array() as $row) {
				$record->setProfile($row['profile_id'], $row['name']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}
	
	private static function getTeenagersHidden($account_id) {
		return array();
	}
	
	private function _getTeenagersPrivate($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		//$this->db->select('account_id,firstname,lastname,loghin_id'); 
		$this->db->order_by('a.firstname','asc');
		$this->db->join('profiles p', 'a.account_id = p.account_id');
		$this->db->where('a.account_id',$account_id);
		$this->db->where('a.type','private');
		$this->db->where('p.type_id','2');
		
		$query = $this->db->get('accounts a');
		foreach($query->result_array() as $k => $account) {
			$record = new UserBarRecord(UserBarRecord::TEENAGER);
			
			// Set Account
			$record->setAccount($account['account_id'], $account['firstname'].' '.$account['lastname']);
			
			// Set User
			$record->setUser($account['loghin_id'], $account['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}
			
			// Set Profiles
			$this->db->select('profile_id, name'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('profiles');
			
			foreach ($query->result_array() as $row) {
				$record->setProfile($row['profile_id'], $row['name']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}
	
	private static function getTeenagersImported($account_id) {
		return array();
	}
	
	// ------------------------------------
	// Bussiness accounts
	private function _getBusinessActivities($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		//$this->db->select('account_id,firstname,lastname,loghin_id'); 
		$this->db->order_by('a.firstname','asc');
		$this->db->join('profiles p', 'a.account_id = p.account_id');
		$this->db->where('a.account_id',$account_id);
		$this->db->where('a.type','public');
		$this->db->where('p.type_id','3');
		
		$query = $this->db->get('accounts a');
		foreach($query->result_array() as $k => $account){
			$record = new UserBarRecord(UserBarRecord::BUSINESS);
			
			// Set Account
			$record->setAccount($account['account_id'], $account['firstname'].' '.$account['lastname']);
			
			// Set User
			$record->setUser($account['loghin_id'], $account['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}
			
			// Set Profiles
			$this->db->select('profile_id, name'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('profiles');
			
			foreach ($query->result_array() as $row) {
				$record->setProfile($row['profile_id'], $row['name']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}
	
	private static function getBusinessManagers($account_id) {
		return array();
	}
	
	private static function getBusinessResponsable($account_id) {
		return array();
	}
	
	private static function getBusinessEmployees($account_id) {
		return array();
	}
	
	private function _getBusinessPrivate($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		//$this->db->select('account_id,firstname,lastname,loghin_id'); 
		$this->db->order_by('a.firstname','asc');
		$this->db->join('profiles p', 'a.account_id = p.account_id');
		$this->db->where('a.account_id',$account_id);
		$this->db->where('a.type','private');
		$this->db->where('p.type_id','3');
		
		$query = $this->db->get('accounts a');
		foreach($query->result_array() as $k => $account){
			$record = new UserBarRecord(UserBarRecord::BUSINESS);
			
			// Set Account
			$record->setAccount($account['account_id'], $account['firstname'].' '.$account['lastname']);
			
			// Set User
			$record->setUser($account['loghin_id'], $account['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}
			
			// Set Profiles
			$this->db->select('profile_id, name'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('profiles');
			
			foreach ($query->result_array() as $row) {
				$record->setProfile($row['profile_id'], $row['name']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}



	// ------------------------------------
	// Institutions accounts
	private function _getInstitutionsVisible($account_id) {
		
		$records = array();
		
		// Parcurge accounturile
		$this->db->select('*'); 
        $this->db->join('institutions i', 'i.institution_id=ia.institution_id', 'left');
		$this->db->where('ia.account_id',$account_id);
		$this->db->order_by('i.name','asc');
		$query = $this->db->get('institutions_admins ia');
		foreach($query->result_array() as $k => $instit) {
			$record = new UserBarRecord(UserBarRecord::INSTITUTION);
			
			// Set Account
			$record->setAccount($instit['institution_id'], $instit['name']);
			
			// Set User
			$this->db->select('loghin_id'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts');
			$row = $query->row_array();
			
			$record->setUser($row['loghin_id'], $row['loghin_id']);
			
			
			// Set Nickname
			$this->db->select('nickname_id, nickname'); 
			$this->db->where('account_id',$account_id);
			$query = $this->db->get('accounts_nicknames');
			
			foreach ($query->result_array() as $row) {
				$record->setNickname($row['nickname_id'], $row['nickname']);
			}
			
			// Prepare to insert in Records Manager
			$record->prepare();
			
			// Convert to Array for options
			$records[] = $record;
		}
		
		return $records;
	}
	
	
}

class UserBarRecord {

	const TEENAGER 		= 0x001;
	const ADULT 		= 0x002;
	const BUSINESS 		= 0x003;
	const INSTITUTION 	= 0x004;
	

	private $_type;
	private $_account;
	private $_user;
	private $_nickname;
	private $_profile;
	private $_default;
	
	public function __construct($type) {
		$this->_type = $type;
		$this->_account = array();
		$this->_user = array();
		$this->_nickname = array();
		$this->_profile = array();
		$this->_default = array(0,'-');
	}

	public function setAccount($id, $name) {
		$this->_account[] = array($id, $name);
	}
	
	public function setUser($id, $name) {
		$this->_user[] = array($id, $name);
	}
	
	public function setNickname($id, $name) {
		$this->_nickname[] = array($id, $name);
	}
	
	public function setProfile($id, $name) {
		$this->_profile[] = array($id, $name);
	}
	
	public function prepare() {
		if(count($this->_account) == 0) {
			$this->_account[] = $this->_default;
		}
		if(count($this->_user) == 0) {
			$this->_user[] = $this->_default;
		}
		if(count($this->_nickname) == 0) {
			$this->_nickname[] = $this->_default;
		}
		if(count($this->_profile) == 0) {
			$this->_profile[] = $this->_default;
		}
	}
	
	public function maxRows() {
		$max = 0;
		
		if($max < count($this->_account)) {
			$max = count($this->_account);
		}
		if($max < count($this->_user)) {
			$max = count($this->_user);
		}
		if($max < count($this->_nickname)) {
			$max = count($this->_nickname);
		}
		if($max < count($this->_profile)) {
			$max = count($this->_profile);
		}
		
		return $max;
	}
	
	public function getAccount($index=0) {
		return (array_key_exists($index, $this->_account)) ? $this->_account[$index] : $this->_default;
	}
	
	public function getUser($index=0) {
		return (array_key_exists($index, $this->_user)) ? $this->_user[$index] : $this->_default;
	}
	
	public function getNickname($index=0) {
		return (array_key_exists($index, $this->_nickname)) ? $this->_nickname[$index] : $this->_default;
	}
	
	public function getProfile($index=0) {
		return (array_key_exists($index, $this->_profile)) ? $this->_profile[$index] : $this->_default;
	}
	
	public function getType() {
		return $this->_type;
	}

}
//
//
// END Circular class

/* End of file Circular.php */
/* Location: ./libraries/Circular.php */