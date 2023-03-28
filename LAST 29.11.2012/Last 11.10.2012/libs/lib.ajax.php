<?php

/* Require json class */
require_once 'core/core.json.php';

/* Open Ajax */
new Ajax();

/**
 * Ajax class for open last requiests
 * 
 * @author
 */
class Ajax
{
	/**
	 * Constructor of ajax class
	 * 
	 * @return show choose action
	 */
	function __construct()
	{
		/* Get vars */
		if ($p = isset($_POST['m']) && $_POST['m'] ? $_POST['m'] : false) {
			$this->$p();
		}
	}

	/**
	 * Call ajax function
	 */
	public function __call($name, $args) {
		/* Set file name */
		$function_name = $name;

		/* Check if not callable this function */
		if (!is_callable($function_name))
		{
			/* Check if exist this file */
			if (!file_exists(SYS_PATH .'ajax/ajax.'. $name .'.php')) {
				return;
			}

			/* Require file with function */
			require_once 'ajax/ajax.'. $name .'.php';
		}

		return call_user_func_array($function_name, $args);
	}
}