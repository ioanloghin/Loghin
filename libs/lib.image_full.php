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
	$TEMPLATE->setTemplate('image_full.tpl');

	/* Set css file */

	$TEMPLATE->setScript(VIR_PATH .'js/jquery.ui.js');

	$TEMPLATE->setScript(VIR_PATH .'js/scroll.js');

	$TEMPLATE->setStylesheet(VIR_TPL_PATH .'media/nav100.css');



	/* Set default fields var and System Menus */

	$fields = array('systemMenus' => getLayoutsMenus(), 'ArchTop' => new Circular('top', $PREFS->conf['globe_text_top_'. SYS_LANG], 145, 'top', 'Monaco-22'), 'ArchBottom' => new Circular('bottom', $PREFS->conf['globe_text_bottom_'. SYS_LANG], 160, 'bottom', 'Monaco-22'));


 $grouplayout = $PREFS->DB->query("SELECT `group_id`, `parent_id`,`orderid`, `menu_id`, `name` FROM `". DB_PREFIX ."layouts_groups`  ORDER BY `parent_id` ASC, `orderid` ASC");
	
	if ($PREFS->DB->numRows($grouplayout))
	{
		$fields['group_items'] = array();
		

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($grouplayout))
		{
		    
		    if ($obj->parent_id == 0) {
		        
			 $fields['group_items'][$obj->group_id] = array('id' => $obj->group_id, 'name' => $obj->name,'orderid' => $obj->orderid,'menu_id' => $obj->menu_id,'parent_id' => $obj->parent_id, 'group_items' => array());
		    }
		    else{
		        $fields['group_level'][$obj->parent_id][] = array('id' => $obj->group_id, 'name' => $obj->name,'orderid' => $obj->orderid,'menu_id' => $obj->menu_id,'parent_id' => $obj->parent_id, 'group_level' => array());
		    }
		    
			
		}
// 		echo "<pre>";print_r($fields) ;
// 		die();
	}
 
 
   $result = $PREFS->DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."language1` WHERE `status` = '1' ORDER BY `language` ASC");
	
	if ($PREFS->DB->numRows($result))
	{
		$fields['item'] = array();

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result))
		{
			$fields['item'][$obj->id]['language'] = $obj->language;
		
			
		}
	}
	

    $result1 = $PREFS->DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` WHERE `status` = '1' ORDER BY `name` ASC");
	
	if ($PREFS->DB->numRows($result1))
	{
		$fields['item1'] = array();

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result1))
		{
			$fields['item1'][$obj->id]['name'] = $obj->name;
		
			
		}
	}

    $ip = $_SERVER['REMOTE_ADDR'];
  

   $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip));
   
   $fields['Country_Name'] = $ipdat->geoplugin_countryName;

  $sql = $PREFS->DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` WHERE `name` = '".$fields['Country_Name']."'");

	if ($PREFS->DB->numRows($sql))
	{
	    
	    
        $fields['ip_lang'] = array();
        
		$obj = $PREFS->DB->fetchObject($sql);
		
		$fields['ip_lang'][$obj->id]['IP_lang'] = $obj->IP_lang;
		
			
		
	}

	/* Assign template vars */

	$TEMPLATE->assign($fields);
    
   $TEMPLATE->assign($group_level);
    $TEMPLATE->assign($item);
    $TEMPLATE->assign($item1);

   $TEMPLATE->assign($Country_Name);
   
   
  $TEMPLATE->assign($ip_lang);
  $TEMPLATE->assign($group_items);


	return true;

}