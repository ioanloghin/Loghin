<?php 

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}



/* Start script time */
$time_start = microtime_float();



/* Start session */
ob_start();
session_start();

// ---------------------------------------------------------------------------
// START BASIC AUTH
// Status flag:
$LoginSuccessful = false;
 
// Check username and password:
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
 
    $Username = $_SERVER['PHP_AUTH_USER'];
    $Password = $_SERVER['PHP_AUTH_PW'];
 
    if ($Username == 'guest' && $Password == 'Karla'){
        $LoginSuccessful = true;
    }
}

//this code to remove prompt from windows
 $LoginSuccessful = true;
 //remove above code

// Login passed successful?
if (!$LoginSuccessful){
 
    /* 
    ** The user gets here if:
    ** 
    ** 1. The user entered incorrect login data (three times)
    **     --> User will see the error message from below
    **
    ** 2. Or the user requested the page for the first time
    **     --> Then the 401 headers apply and the "login box" will
    **         be shown
    */
 
    // The text inside the realm section will be visible for the 
    // user in the login box
    header('WWW-Authenticate: Basic realm="Secret page"');
    header('HTTP/1.0 401 Unauthorized');
 
    print "Login failed!\n";
 
}



// END BASIC AUTH
// ---------------------------------------------------------------------------


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
//	error_reporting(E_ALL);
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
include 'core/core.prefs.php';


/* Assign default template vars */
$PREFS->setDefaults();




/* Set Stylesheets and Scripts */
$TEMPLATE->setStylesheet(array(VIR_TPL_PATH .'media/style.css', VIR_TPL_PATH .'media/loghin/style.css', VIR_PATH .'js/fancybox/fancybox.css'));
$TEMPLATE->setScript(array('/js/jquery.js', '/js/fancybox/fancybox.js', '/js/jquery.scrollTo.js', '/js/mousewheel.js', '/js/scrollpane.js', '/js/misc.js'));


/* Auto-login */
if ($SESSION->is_loggedin()==false) {
	
	// check cookie
	/*if($this->input->cookie('loghin_com_accounts') != NULL) {
		$sess_hash  = preg_replace("/[^A-Za-z0-9 ]/", '', $this->input->cookie('loghin_com_accounts'));// parse session hash
		if($account_id = $this->acc_api->session_check($sess_hash, $this->input->ip_address())) {// check session hash
			$_SESSION[SESSION]['user']['id'] = (int)$account_id;// save account_id (login)
		}
	}*/
	/* Check if there is someone loggedin from register.loghin.com */
	if (isset($_COOKIE['sessdata']) && NULL != ($sessdata = $_COOKIE['sessdata'])) {
		$sessdata = @unserialize(base64_decode($sessdata));
		if(is_array($sessdata) && isset($sessdata['account_id']) && isset($sessdata['hash'])) {
		
			// Db working
			$db_link = mysql_connect('localhost', 'loghin_structure', 'IVT5fvIyC5xuVbF', true); 
			mysql_select_db('loghin_register', $db_link);
			$ip_address=NULL;
			$query = mysql_query("SELECT account_id, loghin_id FROM l_accounts WHERE `sessionhash` = '" .$sessdata['hash']. "' AND ". ($sessdata['account_id'] != NULL ? "`account_id` = '". $sessdata['account_id'] ."'" : "`ip` = '$ip_address'") ." LIMIT 1", $db_link);
			$account = mysql_fetch_assoc($query);
			mysql_close($db_link);
			
			// Save in session
			$SESSION->auth = true;
			$SESSION->conf['member_id'] = $account['account_id'];
			$SESSION->conf['username']  = $account['loghin_id'];
		}
	}
	
}



/* Authenticate user */
if ($SESSION->login() || $SESSION->is_loggedin()) {
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
