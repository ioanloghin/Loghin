<?php

$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;

$p = isset($_GET['p']) ? $_GET['p'] : '';




/* Choose action */
switch ($p)
{
	case 'add':
    case 'edit':
		editContent($id);
	break;

	case 'delete':
		deleteContent($id, $page);
	break;
	
	default:
		manageContent($id, $page);
	break;
}


 function editContent($id)
 {
     	global $DB,  $TEMPLATE;
    
    	/* Set template */
    	$TEMPLATE->setTemplate('editContent.tpl');
    	
    		/* Assign page name */
	$TEMPLATE->assign('appPage', $id ? __('edit_content') : __('Add Pages'));
	
		
	
		/* Navigation bar */
		    $navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=langContent\">". __('Content') ."</a>";
		    $navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=langContent&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_content') : __('add_content')) ."</a>";
	        $TEMPLATE->assign('navlinks', $navlinks);
	        
	        
        	 
        		$navlinks = array(
        			array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=langContent&p=add&id=$id\">". __('add_content') ."</a>")
        			
        		);
        	
        	$TEMPLATE->assign('navlinks', $navlinks);
        	
        		/* Parsing post data */
        	$item_data = array();
	
	
    	
         	$item_data['item1'] = isset($_POST['item1']) ? htmlentities2utf8($_POST['item1']) : ($id ? $obj->item1 : '');
         	$item_data['item2'] = isset($_POST['item2']) ? htmlentities2utf8($_POST['item2']) : ($id ? $obj->item2 : '');
         	$item_data['item3'] = isset($_POST['item3']) ? htmlentities2utf8($_POST['item3']) : ($id ? $obj->item3 : '');
         	$item_data['item4'] = isset($_POST['item4']) ? htmlentities2utf8($_POST['item4']) : ($id ? $obj->item4 : '');
         	$item_data['item5'] = isset($_POST['item5']) ? htmlentities2utf8($_POST['item5']) : ($id ? $obj->item5 : '');
	        $item_data['language_id'] = isset($_POST['language_id']) ? htmlentities2utf8($_POST['language_id']) : ($id ? $obj->language_id : '');
         
        	
        		/* Check if submited form */
        	if (isset($_POST['isitem']) && $_POST['isitem']) {
        		saveContent($id,$item_data);
        	}
        	
        	$result = $DB->query("SELECT  * FROM `". DB_DATA ."`.`". DATA_PREFIX ."language1` WHERE `id` = '". $id ."'");
        	
        	if ($DB->numRows($result))
        	{
        		$lang['lang'] = array();
        
        		/* Fetch resultset */
        		while ($obj = $DB->fetchObject($result))
        		{
        			$lang['lang'][$obj->id]['language'] = $obj->language;
        		
        		}
        	}
       
        		/* Assign template vars */
        	$TEMPLATE->assign($item_data);
        	$TEMPLATE->assign($lang);
        	return true;     
	        
 }


    
    


    function manageContent($id,$page)
         {
             	global $DB,  $TEMPLATE;
            
            	/* Set template */
            	$TEMPLATE->setTemplate('langContent.tpl');
            
            
            	/* Assign page title */
            	$TEMPLATE->assign('appPage', __('Pages'));
            	
           
        	/* Assign option links */
// 	$optlinks = array (array('header' => __('options')),
// 						array('optlink' => VIR_CP_PATH ."index.php?m=langContent&p=add", 'optname' => __('Add Pages')));
						
// 	$TEMPLATE->assign("optlinks", $optlinks);
                	
        		/* Result data */
        	$result = $DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."content`");
        
        	/* Check if exist member */
        	if ($DB->numRows($result))
        	{
        	    $item_data['item_data'] = array();
        
        		/* Fetch resultset */
        		while ($obj = $DB->fetchObject($result))
        		{
        			$item_data['item_data'][$obj->id]['item1'] = $obj->item1;
        			$item_data['item_data'][$obj->id]['item2'] = $obj->item2;
        			$item_data['item_data'][$obj->id]['item3'] = $obj->item3;
        			$item_data['item_data'][$obj->id]['item4'] = $obj->item4;
        	        $item_data['item_data'][$obj->id]['item5'] = $obj->item5;
        	        $item_data['item_data'][$obj->id]['language_id'] = $obj->language_id;
        			
        		}
        	}
        	else {
        		/* Set message */
        		$TEMPLATE->setMessage('error', __('no_content'), 1);
        		return;
        	}
        
        
        	$resultt = $DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."language1`");
        	
        	if($DB->numRows($resultt))
        	{
        	     $language_code['language_code'] = array();
        
        		/* Fetch resultset */
        		while ($obj = $DB->fetchObject($resultt))
        		{
        			
        	        $language_code['language_code'][$obj->id]['language'] = $obj->language;
        			
        		}
        	}
        
        
        	
        		/* Assign template vars */
        	$TEMPLATE->assign($item_data);
        	$TEMPLATE->assign($language_code);
        	$TEMPLATE->assign('page', $page);
        	
        	$TEMPLATE->assign('navlinks', $navlinks);
                	
        	
         }
 
 
     function saveContent($id,$item_data)
         {
             
               global $DB, $TEMPLATE;
        	
                foreach ($item_data AS $key => $value)
            	{
            		if (in_array($key, array('item1', 'item2', 'item3', 'item4', 'item5','language_id'))) {
            			$items[] = "`". $key ."` = '". $DB->escapeData($value) ."'";
            		}
            		
              	}
              	
              		/* Check if isset id */
            	if ($id) {
            		/* Insert member */
            			$DB->query("INSERT INTO `". DB_DATA ."`.`". DATA_PREFIX ."content` SET ". implode(',', $items));
                
                		/* Get insert id */
                		$id = $DB->get_insert_id();
            
            		/* Set message */
            		$TEMPLATE->setMessage('info', __('data_added'));
            	
              	
              
                	/* Redirect */
            
            		redirect(VIR_CP_PATH .'index.php?m=langContent');
            		return true;
            	}
             
         }

?>