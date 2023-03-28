<?php



/* Show home page */

showCont();



function showCont() {


	global $TEMPLATE, $PREFS;

     include_once 'Circular.class.php';
	/* Require UserBar classes */
	include_once 'CI_SESS.class.php';
	include_once 'CI_DB.class.php';
	include_once 'CI_Model.class.php';
	include_once 'User_model.class.php';
	include_once 'Myaccount_model.class.php';
	include_once 'Userbar_model.class.php';
	include_once 'Userbar_controller.class.php';
	
	

$TEMPLATE->setTemplate('home.tpl');


}




?>