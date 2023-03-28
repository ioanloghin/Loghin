<?php

/* Start session and turn off runtime magic quotes */
ob_start();
session_start();


/* Turn off script execution time limit */
if (function_exists('set_time_limit') == 1  &&  @ini_get('safe_mode') == 0) {
	@set_time_limit(0);
}

/* Fetch config file */
require_once dirname(__FILE__) .'/../includes/config.php';

/* Check if system installed */
if (!defined('SYS_PATH') || !defined('VIR_PATH')) {
	exit('The system does not appear to be installed.');
}

/* Set error reporting to "ALL" if specified in the config file */
if (SYS_DEBUG >= 1) {
	error_reporting(E_ALL);
}

/* Get includes path */
$incPath = get_include_path();

/* Set includes path */
set_include_path(SYS_PATH .'admin/cp/'. PATH_SEPARATOR . SYS_PATH .'includes/'. PATH_SEPARATOR . CORE_PATH .'fns/'. PATH_SEPARATOR . CORE_PATH .'core/'. PATH_SEPARATOR . $incPath);

/* Includes files */
include 'fns/fns.misc.php';
include 'fns.misc.php';
include 'class.mysql.php';
include 'core.session.php';
include 'core.template.php';
include 'core.language.php';

/* Set header with encoding */
header('Content-Type: text/html; charset=utf-8'); 

/* Declare smarty class and set template values */
$TEMPLATE = new TEMPLATE(SYS_CP_TPL_PATH, SYS_CP_TPL_PATH .'temp/');

/* Set language */
define('SYS_LANG', Language::getInstance()->language);

/* Require default language */
require_once 'languages/'. SYS_LANG .'/lang.cp.core.php';

/* Set preferances */
include 'class.prefs.php';
$PREFS->setDefaults(true);

/* Template set defaults */
$TEMPLATE->setStylesheet(VIR_CP_TPL_PATH .'media/style.css');
$TEMPLATE->setScript(array(VIR_JS_PATH .'jquery.js', VIR_PATH .'js/misc.cp.js'));


/* Authenticate user */
if (($SESSION->login() || $SESSION->is_loggedin()) && isset($SESSION->conf['can_access_cp'])/* && $SESSION->conf['can_www_cp']*/)
{
	/* Set default session */
	$TEMPLATE->assign('loggedin', true);

	/* Set default session vars */
	$TEMPLATE->assign('session', $SESSION->conf);

	/* Include functions selector */
	include 'cp.php';
}
else
{
	/* Set default session */
	$TEMPLATE->assign("loggedin", false);

	/* Set Login file */
	include_once 'cp.login.php';
}

/* Display template */
$TEMPLATE->display();

/* Disconnect from the database */
$DB->disconnect_db();

/* If searching in directories, reset include_path */
if ($incPath) {
	set_include_path($incPath);
}