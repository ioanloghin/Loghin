<?php

/**
 * Site Preference Settings
 *
 * @category   Preferences
 * @package    Preferences
 */
class Preferences
{
	/**
	 * Settings data
	 * 
	 * @var array $conf
	 */
	public $conf = array();

	/* template class */
	public $TEMPLATE = null;

	/* database class */
	public $DB = null;

	/**
	 * Fetch settings
	 */
	function __construct()
	{
		global $DB, $TEMPLATE;

		/* Set template class */
		$this->TEMPLATE = $TEMPLATE;

		/* Set database class */
		$this->DB = $DB;

		/**
		 * Result settings data from the database
		 */
		$result = $DB->query("SELECT `label`, `type`, `value` FROM `". DB_DATA ."`.`". DATA_PREFIX ."settings` UNION SELECT `label`, `type`, `value` FROM `". DB_PREFIX ."settings`");

		/* Check if result contains rows */
		if($DB->numRows($result))
		{
			/* Fetch result set into object and assign it */
			while ($obj = $DB->fetchObject($result))
			{
				/* Check if settings in multi language */
				if ($obj->type == "text_ln" || $obj->type == "textarea_ln")
				{
					/* Parse val for each language */
					foreach (unserialize($obj->value) as $key => $val) {
						$this->conf[$obj->label .'_'. $key] = $val;
					}
				}
				else {
					$this->conf[$obj->label] = $obj->value;
				}
			}
		}
		/* if do not exist settings */
		else {
			die("Unable to fetch application settingss.");
		}

		/* Clean up */
		$DB->freeResult($result);

		/* Assign template prefs var */
		$TEMPLATE->assign('prefs', $this->conf);
		
	}

	/**
	 * Default get elements
	 * 
	 * @var string $name
	 * return boolean;
	 */
	public function __call($name, $args)
	{
		/* Set name and function name */
		$_name = 'Prefs_'. ($name = str_replace('_', '', $name));

		/* Check if exist class name */
		if (!function_exists($_name))
		{
			/* Check if exist pref filename */
			if (file_exists(SYS_PATH .'includes/core/Prefs/'. $name .'.php')) {
				/* Include class file */
				require_once SYS_PATH .'includes/core/Prefs/'. $name .'.php';

				/* Check if exist this class */
				if (!function_exists($_name)) {
					return false;
				}
			}
			elseif (file_exists(CORE_PATH .'core/Prefs/'. $name .'.php')) {
				/* Include class file */
				require_once CORE_PATH .'core/Prefs/'. $name .'.php';

				/* Check if exist this class */
				if (!function_exists($_name)) {
					return false;
				}
			}
		}

		/* Get class */
		call_user_func_array($_name, array_merge(array($this), $args));
	}
}

/**
 * Make sure everything is set up
 */
if (defined('VIR_PATH') == false || defined('VIR_CP_PATH') == false || defined('SYS_PATH') == false) {
	exit('The system does not appear to be properly installed.');
}

/* Create PREFS */
$PREFS = new Preferences();