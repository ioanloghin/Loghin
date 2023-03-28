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
	$TEMPLATE->setTemplate('video_page.tpl');

	/* Set css file */

	$TEMPLATE->setScript(VIR_PATH .'js/jquery.ui.js');

	$TEMPLATE->setScript(VIR_PATH .'js/scroll.js');

	$TEMPLATE->setStylesheet(VIR_TPL_PATH .'media/nav100.css');



	/* Set default fields var and System Menus */

	$fields = array('systemMenus' => getLayoutsMenus(), 'ArchTop' => new Circular('top', $PREFS->conf['globe_text_top_'. SYS_LANG], 145, 'top', 'Monaco-22'), 'ArchBottom' => new Circular('bottom', $PREFS->conf['globe_text_bottom_'. SYS_LANG], 160, 'bottom', 'Monaco-22'));


	$result = $PREFS->DB->query("SELECT * FROM `". DB_PREFIX ."countries`");
	if ($PREFS->DB->numRows($result))
	{
		$fields['item'] = array();

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result))
		{
			$fields['item'][$obj->country_id]['country'] = $obj->country;
		
			
		}
	}
	
	$result1 = $PREFS->DB->query("SELECT * FROM `". DB_PREFIX ."languages`");
	if ($PREFS->DB->numRows($result1))
	{
		$fields['item1'] = array();

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result1))
		{
			$fields['item1'][$obj->id]['language_directory'] = $obj->language_directory;
		
			
		}
	}

    

	/* Assign template vars */

	$TEMPLATE->assign($fields);
    $TEMPLATE->assign($item);
    $TEMPLATE->assign($item1);
	return true;

}


