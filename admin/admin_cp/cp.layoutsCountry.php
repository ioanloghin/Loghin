 <?php
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';





/* Choose action */
switch ($p)
{
	case 'add':
    case 'edit':
		editCountry($id);
	break;

	case 'delete':
		deleteCountry($id, $page);
	break;
	
	default:
		manageCountry($id, $page);
	break;
}



 function editCountry($id)
	{
	   	global $DB, $TEMPLATE;

	/* Set template */
	$TEMPLATE->setTemplate('editCountry.tpl');
	
	/* Assign page name */
	$TEMPLATE->assign('appPage', $id ? __('edit_country') : __('add_country'));

	
/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH ."index.php?m=layoutsCountry&p=add", 'optname' => __('add_country')));
						

						
	$TEMPLATE->assign("optlinks", $optlinks);
	
	
		/* Navigation bar */
		    $navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsCountry\">". __('Country') ."</a>";
			$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsCountry&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_country') : __('add_country')) ."</a>";
	        $TEMPLATE->assign('navlinks', $navlinks);
		
	if ($id) {
	
	
		
			/* Result layouts data */
		$_result = $DB->query("SELECT  `name`,`multiple_lang`,`IP_lang` FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` WHERE `id` = '". $id ."'");

	/* Fetch resultset */
		if (!$obj = $DB->fetchObject($_result)) {
			/* Set message */
			$TEMPLATE->setMessage("error", __('no_country'));
			return;
		}
		
		
	}
	else {
		$navlinks = array(
			array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsCountry&p=add\">". __('add_country') ."</a>")
			
		);
	}
	$TEMPLATE->assign('navlinks', $navlinks);
	
	
	/* Parsing post data */
	$fields = array();
	
	
	
		$fields['name'] = isset($_POST['name']) ? htmlentities2utf8($_POST['name']) : ($id ? $obj->name : '');
        $fields['multiple_lang'] = isset($_POST['multiple_lang']) ? htmlentities2utf8($_POST['multiple_lang']) : ($id ? $obj->multiple_lang : '');
        $fields['IP_lang'] = isset($_POST['IP_lang']) ? htmlentities2utf8($_POST['IP_lang']) : ($id ? $obj->IP_lang : '');
     
		$fields['status'] = isset($_POST['status']) ? ($_POST['status'] ? 1 : 0) : ($id ? $obj->status : '');

	
		/* Check if submited form */
	if (isset($_POST['iscountry']) && $_POST['iscountry']) {
		saveCountry($id,$fields);
	}
	
	/* Active / Inactive box */
	$fields['status'][1] = __('active');
	$fields['status'][0] = __('inactive');
	
		/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;

	}



function manageCountry($id,$page)
{
	global $DB, $TEMPLATE;

	/* Set template */
	$TEMPLATE->setTemplate('layoutsCountry.tpl');

		/* Assign page title */
	$TEMPLATE->assign('appPage', __('country_layouts'));



/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH ."index.php?m=layoutsCountry&p=add", 'optname' => __('add_country')));
						
	$TEMPLATE->assign("optlinks", $optlinks);
	
	

	
		/* Result data */
	$result = $DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` ORDER BY `name` ASC ". $LIMIT);

	/* Check if exist member */
	if ($DB->numRows($result))
	{
	$fields['fields'] = array();

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
			$fields['fields'][$obj->id]['name'] = $obj->name;
			$fields['fields'][$obj->id]['multiple_lang'] = $obj->multiple_lang;
			$fields['fields'][$obj->id]['IP_lang'] = $obj->IP_lang;
			$fields['fields'][$obj->id]['status'] = $obj->status ? __('active') : __('inactive');
			
		}
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_country'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);
	
		/* Assign template vars */
	$TEMPLATE->assign($fields);
	$TEMPLATE->assign('page', $page);
	
	$TEMPLATE->assign('navlinks', $navlinks);
	
	
	}
	
	
	function saveCountry($id,$fields)
	{
	   global $DB, $TEMPLATE;
        	
     foreach ($fields AS $key => $value)
	{
		if (in_array($key, array('name', 'multiple_lang','IP_lang', 'status'))) {
			$items[] = "`". $key ."` = '". $DB->escapeData($value) ."'";
		}
		
  	}
  	
  		/* Check if isset id */
	if ($id) {
		/* Update member info */
		$DB->query("UPDATE `". DB_DATA ."`.`". DATA_PREFIX ."country` SET ". implode(', ', $items) ." WHERE `id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('country_updated'));
	}
	/* Add new layout in database */
	else {
	    	/* Insert member */
		$DB->query("INSERT INTO `". DB_DATA ."`.`". DATA_PREFIX ."country` SET `postdate` = '". time() ."', ". implode(',', $items));

		/* Get insert id */
		$id = $DB->get_insert_id();

		/* Set message */
		$TEMPLATE->setMessage('info', __('data_added'));
	}
  	
  
    	/* Redirect */

		redirect(VIR_CP_PATH .'index.php?m=layoutsCountry');
		return true;
	}
	
    function deleteCountry($id, $page)
    {
            global $DB, $TEMPLATE;
            
            	/* Assign page title */
	           $TEMPLATE->assign('appPage', __('country_delete'));

                      
              /* Assign option links */
            	$optlinks = array (array('header' => __('options')),
            						array('optlink' => VIR_CP_PATH ."index.php?m=layoutsCountry&p=add", 'optname' => __('add_country')));
            	$TEMPLATE->assign("optlinks", $optlinks);
            	
            	
	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsCountry\">". __('country_layouts') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsCountry&p=delete&id=". $id ."\">". __('delete') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);
            	
            	
            	
            		/* Delete page from database */
            	$DB->query("DELETE FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` WHERE `id` = '". $id ."' LIMIT 1");
            
            
            	/* Set message and redirect */
            	$TEMPLATE->setMessage('info', __('country_deleted'));
            	redirect(VIR_CP_PATH .'index.php?m=layoutsCountry');
            
            	return true;

    }
	
?>