<?php



/* Show home page */

showHome();



/**

 * Show home page function

 * 

 */

function showHome() {

	global $TEMPLATE, $PREFS;



	/* Require Circular class */
	require_once 'Circular.class.php';
	
	
	/* Require UserBar classes */
	require_once 'CI_SESS.class.php';
	require_once 'CI_DB.class.php';
	require_once 'CI_Model.class.php';
	require_once 'User_model.class.php';
	require_once 'Myaccount_model.class.php';
	require_once 'Userbar_model.class.php';
	require_once 'Userbar_controller.class.php';

	/* Create userbar controller */
	$userbar_controller = new Userbar_controller(
		new User_model(),
		new Myaccount_model(),
		new Userbar_model()
	);

	/* Passing variables to view */
	$data = $userbar_controller->index();
	
	$TEMPLATE->assign('data',$data); 


	/* Set template file */
	$TEMPLATE->setTemplate('video.tpl');

	/* Set css file */

	$TEMPLATE->setScript(VIR_PATH .'js/jquery.ui.js');

	$TEMPLATE->setScript(VIR_PATH .'js/scroll.js');

	$TEMPLATE->setStylesheet(VIR_TPL_PATH .'media/nav100.css');



	/* Set default fields var and System Menus */

	$fields = array('systemMenus' => getLayoutsMenus(), 'ArchTop' => new Circular('top', $PREFS->conf['globe_text_top_'. SYS_LANG], 145, 'top', 'Monaco-22'), 'ArchBottom' => new Circular('bottom', $PREFS->conf['globe_text_bottom_'. SYS_LANG], 160, 'bottom', 'Monaco-22'));


}


?>