
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
	$TEMPLATE->setTemplate('home.tpl');

	/* Set css file */

	$TEMPLATE->setScript(VIR_PATH .'js/jquery.ui.js');

	$TEMPLATE->setScript(VIR_PATH .'js/scroll.js');

	$TEMPLATE->setStylesheet(VIR_TPL_PATH .'media/nav100.css');



	/* Set default fields var and System Menus */

	$fields = array('systemMenus' => getLayoutsMenus(), 'ArchTop' => new Circular('top', $PREFS->conf['globe_text_top_'. SYS_LANG], 145, 'top', 'Monaco-22'), 'ArchBottom' => new Circular('bottom', $PREFS->conf['globe_text_bottom_'. SYS_LANG], 160, 'bottom', 'Monaco-22'));


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
	

	 $result1 = $PREFS->DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` WHERE `status` = '1'ORDER BY `name` ASC");
	
	if ($PREFS->DB->numRows($result1))
	{
		$fields['item1'] = array();

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result1))
		{
			$fields['item1'][$obj->id]['name'] = $obj->name;
		
			
		}
	}

  $result1 = $PREFS->DB->query("SELECT * FROM `loghin_www`.`lg_contentsave` ");
	
	if ($PREFS->DB->numRows($result1))
	{
		$fields['item2'] = array();
		

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result1))
		{
		    $fields['item2'][$obj->id]['id'] = $obj->id;
			$fields['item2'][$obj->id]['heading'] = $obj->heading;
			$fields['item2'][$obj->id]['discription'] = $obj->discription;
			$fields['item2'][$obj->id]['ctime'] = $obj->ctime;
		   $fields['item2'][$obj->id]['image'] = $obj->image;

		
			}
	}

   $result1 = $PREFS->DB->query("SELECT * FROM `loghin_www`.`lg_contentsave` ");
	
	if ($PREFS->DB->numRows($result1))
	{
		$fields['item3'] = array();
		

		/* Fetch resultset */
		while ($obj = $PREFS->DB->fetchObject($result1))
		{
		    $fields['item3'][$obj->id]['id'] = $obj->id;
			$fields['item3'][$obj->id]['heading'] = $obj->heading;
			$fields['item3'][$obj->id]['discription'] = $obj->discription;
			$fields['item3'][$obj->id]['ctime'] = $obj->ctime;
		   $fields['item3'][$obj->id]['image'] = $obj->image;

		
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


      $sql2 = $PREFS->DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."language1`");

        if ($PREFS->DB->numRows($sql2))
        {
              $fields['country_languages'] = array();

              /* Fetch resultset */
              while ($obj = $PREFS->DB->fetchObject($sql2))
              {
                  $fields['country_languages'][$obj->language] = $obj->language_code;
              }
        } 

    //var_dump($fields); die();


    // ?? SET THIS VALUE GLOBAL
    $browser_lang['browser_lang'] = substr(getenv('HTTP_ACCEPT_LANGUAGE'), 0, 2); 

    /* Assign template vars */

    $TEMPLATE->assign($Country_Name);
    $TEMPLATE->assign($ip_lang);
    $TEMPLATE->assign($browser_lang);
    $TEMPLATE->assign($fields);
    $TEMPLATE->assign($item);
    $TEMPLATE->assign($item1);
    $TEMPLATE->assign($item2);
    $TEMPLATE->assign($item3);
    return true;

}

?>
