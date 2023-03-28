<?php

$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';





/* Choose action */
switch ($p)
{
	case 'add':
    case 'edit':
		editLanguage($id);
	break;

	case 'delete':
		deleteLanguage($id, $page);
	break;
	
	default:
		manageLanguage($id,$page);
	break;
}



    function editLanguage($id)
    {
        	global $DB, $TEMPLATE;

	        /* Set template */
    	$TEMPLATE->setTemplate('editLanguage.tpl');
	
    	/* Assign page name */
    	$TEMPLATE->assign('appPage', $id ? __('edit_language') : __('add_language'));

	
        /* Assign option links */
        	$optlinks = array (array('header' => __('options')),
        						array('optlink' => VIR_CP_PATH ."index.php?m=layoutsLanguage&p=add", 'optname' => __('add_language')));
        	$TEMPLATE->assign("optlinks", $optlinks);
	
	
		/* Navigation bar */
		    $navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsLanguage\">". __('Language') ."</a>";
			$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsLanguage&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_language') : __('add_language')) ."</a>";
	        $TEMPLATE->assign('navlinks', $navlinks);
	        
	        if($id)
	        {
	            		/* Result layouts data */
	             	   $_result = $DB->query("SELECT  `language`, `language_code` FROM `". DB_DATA ."`.`". DATA_PREFIX ."language1` WHERE `id` = '". $id ."'");
	             	
	             	
                	       	/* Fetch resultset */
                		if (!$obj = $DB->fetchObject($_result)) {
                			/* Set message */
                			$TEMPLATE->setMessage("error", __('no_language'));
                			return;
                		}
		
	        }
	        else{
	            	$navlinks = array(
		        	   array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsLanguage&p=add\">". __('add_language') ."</a>")
	         	    );
	        }
	        
	        $TEMPLATE->assign('navlinks', $navlinks);
	        
 	        	/* Parsing post data */
            	$language = array();
            	
            	
    		$language['language'] = isset($_POST['language']) ? htmlentities2utf8($_POST['language']) : ($id ? $obj->language : '');
         	$language['language_code'] = isset($_POST['language_code']) ? htmlentities2utf8($_POST['language_code']) : ($id ? $obj->language_code : '');
    	   	$language['status'] = isset($_POST['status']) ? ($_POST['status'] ? 1 : 0) : ($id ? $obj->status : '');
	   	
	   	
	   			/* Check if submited form */
        	if (isset($_POST['islanguage']) && $_POST['islanguage']) {
        		saveLanguage($id,$language);
        	}
        	
        	/* Active / Inactive box */
        	$language['status'][1] = __('active');
        	$language['status'][0] = __('inactive');
	
            	
            	
        		/* Assign template vars */
        	$TEMPLATE->assign($language);
        
        	return true;
            	
	        
    }

    
    function manageLanguage($id,$page)
    {
    	global $DB,  $TEMPLATE;
    
    	/* Set template */
    	$TEMPLATE->setTemplate('layoutsLanguage.tpl');
    
    		/* Assign page title */
    	$TEMPLATE->assign('appPage', __('layouts_language'));
    	
    
        /* Assign option links */
        	$optlinks = array (array('header' => __('options')),
        						array('optlink' => VIR_CP_PATH ."index.php?m=layoutsLanguage&p=add", 'optname' => __('add_language')));
        	$TEMPLATE->assign("optlinks", $optlinks);
        	
        	
        /* Result data */
        	$result = $DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."language1` ORDER BY `language` ASC ". $LIMIT);
        	
        	/* Check if exist member */
        	if ($DB->numRows($result))
        	{
        		$language['language'] = array();
        
        		/* Fetch resultset */
        		while ($obj = $DB->fetchObject($result))
        		{
        			$language['language'][$obj->id]['language'] = $obj->language;
        			$language['language'][$obj->id]['language_code'] = $obj->language_code;
        		    $language['language'][$obj->id]['status'] = $obj->status ? __('active') : __('inactive');
        			
        		}
        	}
        	else {
        		/* Set message */
        		$TEMPLATE->setMessage('error', __('no_language'), 1);
        		return;
        	}
        
        	/* Free result */
        	$DB->freeResult($result);
        	
        		/* Assign template vars */
        	$TEMPLATE->assign($language);
        	$TEMPLATE->assign('page', $page);
        	
        	$TEMPLATE->assign('navlinks', $navlinks);
                	
        	
    
        	
    
    }
    
    
    
    function saveLanguage($id,$language)
    {  
         global $DB, $TEMPLATE;
         
             foreach ($language AS $key => $value)
          	{
        		if (in_array($key, array('language', 'language_code', 'status'))) {
        			$items[] = "`". $key ."` = '". $DB->escapeData($value) ."'";
        		}
        		
          	}
          	
          			/* Check if isset id */
                	if ($id) {
                		/* Update member info */
                		$DB->query("UPDATE `". DB_DATA ."`.`". DATA_PREFIX ."language1` SET ". implode(', ', $items) ." WHERE `id` = '". $id ."' LIMIT 1");
                
                		/* Set message */
                		$TEMPLATE->setMessage('info', __('language_updated'));
                	}
                	/* Add new layout in database */
                	else {
                	    	/* Insert member */
                		$DB->query("INSERT INTO `". DB_DATA ."`.`". DATA_PREFIX ."language1` SET ". implode(',', $items));
                
                		/* Get insert id */
                		$id = $DB->get_insert_id();
                
                		/* Set message */
                		$TEMPLATE->setMessage('info', __('data_added'));
                	}
                	
                	
                		/* Redirect */

                		redirect(VIR_CP_PATH .'index.php?m=layoutsLanguage');
                		return true;
                          	
        
    }
    
    	
    function deleteLanguage($id, $page)
    {
            global $DB, $TEMPLATE;
            
            	/* Assign page title */
	           $TEMPLATE->assign('appPage', __('language_delete'));

                      
              /* Assign option links */
            	$optlinks = array (array('header' => __('options')),
            						array('optlink' => VIR_CP_PATH ."index.php?m=layoutsLanguage&p=add", 'optname' => __('add_language')));
            	$TEMPLATE->assign("optlinks", $optlinks);
            	
            	
        	/* Navigation bar */
        	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsLanguage\">". __('language_layouts') ."</a>";
        	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layoutsLanguage&p=delete&id=". $id ."\">". __('delete') ."</a>";
        	$TEMPLATE->assign('navlinks', $navlinks);
            	
            	
            	
            		/* Delete page from database */
            	$DB->query("DELETE FROM `". DB_DATA ."`.`". DATA_PREFIX ."country` WHERE `id` = '". $id ."' LIMIT 1");
            
            
            	/* Set message and redirect */
            	$TEMPLATE->setMessage('info', __('language_deleted'));
            	redirect(VIR_CP_PATH .'index.php?m=layoutsLanguage');
            
            	return true;

    }
	
    
    
?>