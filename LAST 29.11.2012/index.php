<?php

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

/* Start script time */
$time_start = microtime_float();

/* Start session */
ob_start();
session_start();

/* Turn off script execution time limit */
if (function_exists('set_time_limit') == 1  &&  @ini_get('safe_mode') == 0) {
	@set_time_limit(0);
}

/* Fetch config file */
require_once dirname(__FILE__) .'/includes/config.php';

/* Set Vir Path */
define('VIR_PATH', SITE_PATH);

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
set_include_path(CORE_PATH . PATH_SEPARATOR . SYS_PATH .'libs/'. PATH_SEPARATOR . SYS_PATH .'includes/core/'. PATH_SEPARATOR . SYS_PATH .'includes/fns/'. PATH_SEPARATOR . SYS_PATH .'includes/languages/'. PATH_SEPARATOR . $incPath);

/* Set header with encoding */
header("Content-Type: text/html; charset=UTF-8"); 

/* Includes files */
include 'fns/fns.misc.php';
include 'fns.misc.php';
include 'core/class.mysql.php';

/* Include last files */
include 'core/core.session.php';
include 'core/core.template.php';
include 'core/core.language.php';

/* Declare smarty class and set template values */
$TEMPLATE = new TEMPLATE(SYS_TPL_PATH, SYS_TPL_PATH .'temp/');

/* Set language */
define('SYS_LANG', Language::getInstance()->language);

/* Require default language */
require_once SYS_LANG .'/lang.lib.core.php';

/* Set preferances */
include 'core/class.prefs.php';

/* Assign default template vars */
$PREFS->setDefaults();


/* Set Stylesheets and Scripts */
$TEMPLATE->setStylesheet(array(VIR_TPL_PATH .'media/style.css', VIR_TPL_PATH .'media/loghin/style.css', VIR_PATH .'js/fancybox/fancybox.css'));
$TEMPLATE->setScript(array('/js/jquery.js', '/js/fancybox/fancybox.js', '/js/jquery.scrollTo.js', '/js/mousewheel.js', '/js/scrollpane.js', '/js/misc.js'));


/* Authenticate user */
if ($SESSION->login() || $SESSION->is_loggedin())
{
	/* Set default session */
	$TEMPLATE->assign('loggedin', true);

	/* Set default session vars */
	$TEMPLATE->assign('session', $SESSION->conf);
}
else {
	/* Set default session */
	$TEMPLATE->assign('loggedin', false);
}


/* Include functions selector */
include 'libs.php';

/* Display template */
$TEMPLATE->display();

/* Disconnect from the database */
$DB->disconnect_db();

/* If searching in directories, reset include_path */
if ($incPath) {
	set_include_path($incPath);
}

$time_end = microtime_float();
$time = $time_end - $time_start;

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ? false : true) {
	echo "<!--// ". $time ." seconds //-->";
}