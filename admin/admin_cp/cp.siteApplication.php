
<?php

$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;

$p = isset($_GET['p']) ? $_GET['p'] : '';






/* Choose action */
switch ($p)
{
	case 'add':
    case 'edit':
		editSite($id);
	break;

	case 'delete':
		deleteCountry($id, $page);
	break;
	
	default:
		manageSite($id, $page);
	break;
}


    function editSite($id)
         {
             global $DB, $TEMPLATE;
             
             /* Set template */
	         $TEMPLATE->setTemplate('editSiteApplication.tpl');
            
            	/* Assign page name */
        	     $TEMPLATE->assign('appPage', $id ? __('Edit siteApplication') : __('Add siteApplication'));
        	     
        	     /* Assign option links */
	          $optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH ."index.php?m=siteApplication&p=add", 'optname' => __('Add siteApplication')));
						
						
	          $TEMPLATE->assign("optlinks", $optlinks);
	
    		/* Navigation bar */
    		    $navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=siteApplication\">". __('siteApplication') ."</a>";
    	        $navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=siteApplication&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('Edit siteApplication') : __('Add siteApplication')) ."</a>";
    	        $TEMPLATE->assign('navlinks', $navlinks);
    	        
    	        
    	        	if ($id) 
    	        	{
	
	
            			/* Result layouts data */
            		    $_result = $DB->query("SELECT * FROM `". DB_PREFIX ."layouts_data`  WHERE `id` = '". $id ."'");
            
                    	/* Fetch resultset */
            		    if (!$obj = $DB->fetchObject($_result)) 
            		    {
            			/* Set message */
            			$TEMPLATE->setMessage("error", __('No Site&Appication'));
            			return;
            	    	}
		
		
                	}
                	else {
                		$navlinks = array(
                			array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=siteApplication&p=add\">". __('Add siteApplication') ."</a>")
                			
                		);
                	}
            	   $TEMPLATE->assign('navlinks', $navlinks);
            	   
            	   
            	   	/* Parsing post data */
            	    $fields = array();
	
	
	
            		$fields['name'] = isset($_POST['name']) ? htmlentities2utf8($_POST['name']) : ($id ? $obj->name : '');
                    $fields['details'] = isset($_POST['details']) ? htmlentities2utf8($_POST['details']) : ($id ? $obj->details : '');
                   
            	
            		/* Check if submited form */
            	if (isset($_POST['islayout_data']) && $_POST['islayout_data']) {
            		saveSite($id,$fields);
            	}
            	
            	/* Active / Inactive box */
            	$fields['status'][1] = __('active');
            	$fields['status'][0] = __('inactive');
            	
            		/* Assign template vars */
            	$TEMPLATE->assign($fields);
            
            	return true;
        	   
                    
        }






     function manageSite()
            {
             	global $DB,  $TEMPLATE;
            
            	/* Set template */
            	$TEMPLATE->setTemplate('siteApplication.tpl');
            	
            			/* Assign page title */
             	$TEMPLATE->assign('appPage', __('siteApplication'));
             	
             	
             	/* Assign option links */
            	$optlinks = array (array('header' => __('options')),
            						array('optlink' => VIR_CP_PATH ."index.php?m=siteApplication&p=add", 'optname' => __('Add Site&Application')));
            						
            	$TEMPLATE->assign("optlinks", $optlinks);
	
	
	
		    	/* Result data */
            	$result = $DB->query("SELECT * FROM `". DB_PREFIX ."layouts_data` ");
            
            	/* Check if exist member */
            	if ($DB->numRows($result))
            	{
	

	
            		while ($obj = $DB->fetchObject($result))
            		{
            			$fields['fields'][$obj->id]['name'] = $obj->name;
            			$fields['fields'][$obj->id]['details'] = $obj->details;
            		
            			
            		}
	            }


            	/* Free result */
            	$DB->freeResult($result);
            	
            		/* Assign template vars */
            	$TEMPLATE->assign($fields);
            	$TEMPLATE->assign('page', $page);
            	
            	$TEMPLATE->assign('navlinks', $navlinks);
        	
        	

        }
        
        
        
	function saveSite($id,$fields)
	{
	   global $DB, $TEMPLATE;
        	
     foreach ($fields AS $key => $value)
	{
		if (in_array($key, array('name', 'details'))) {
			$items[] = "`". $key ."` = '". $DB->escapeData($value) ."'";
		}
		
  	}
  	
  		/* Check if isset id */
	if ($id) {
		/* Update member info */
		$DB->query("UPDATE `". DB_PREFIX ."layouts_data` SET ". implode(', ', $items) ." WHERE `id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('Site&Application Updated'));
	}
	/* Add new layout in database */
	else {
	    	/* Insert member */
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts_data` SET ". implode(',', $items));

		/* Get insert id */
		$id = $DB->get_insert_id();

		/* Set message */
		$TEMPLATE->setMessage('info', __('data_added'));
	}
  	
  
    	/* Redirect */

		redirect(VIR_CP_PATH .'index.php?m=siteApplication');
		return true;
	}
	
	
    function deleteCountry($id, $page)
    {
            global $DB, $TEMPLATE;
            
            	/* Assign page title */
	           $TEMPLATE->assign('appPage', __('siteApplication delete'));

                      
              /* Assign option links */
            	$optlinks = array (array('header' => __('options')),
            						array('optlink' => VIR_CP_PATH ."index.php?m=siteApplication&p=add", 'optname' => __('Add siteApplication')));
            	$TEMPLATE->assign("optlinks", $optlinks);
            	
                	
    	/* Navigation bar */
    	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=siteApplication\">". __('siteApplication') ."</a>";
    	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=siteApplication&p=delete&id=". $id ."\">". __('delete') ."</a>";
    	$TEMPLATE->assign('navlinks', $navlinks);
            	
            	
            	
            		/* Delete page from database */
            	$DB->query("DELETE FROM `". DB_PREFIX ."layouts_data` WHERE `id` = '". $id ."' LIMIT 1");
            
            
            	/* Set message and redirect */
            	$TEMPLATE->setMessage('info', __('siteApplication deleted'));
            	redirect(VIR_CP_PATH .'index.php?m=siteApplication');
            
            	return true;

    }
?>


