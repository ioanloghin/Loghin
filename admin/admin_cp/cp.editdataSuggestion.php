<?php


/* Get vars */
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';

editMember($id);



/**
 * Edit member function
 * 
 * @param number $id - unique member id
 * @return display member edit form
 */
function editMember($id)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('editdataSuggestion.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', $id ? __('edit_suggestion') : __('add_suggestion'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=editSuggestions&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=editSuggestions\">". __('sugestions') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=editSuggestions&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_sugestions') : __('add_sugestions')) ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);



	/* Check if edit member */
	if ($id)
	{
		/* Result member data */
		$result = $DB->query("SELECT * FROM loghin_www .lg_contentsave WHERE `id` = '". $id ."' LIMIT 1");

		/* Fetch resultset */
		if (!$obj = $DB->fetchObject($result)) {
			/* Set message */
			$TEMPLATE->setMessage("error", __('no_member'), 1);
			return;
		}
	}

	/* Set default var */
	$fields = array();

	/* Parse post data */
	$fields['id'] = $id;

    $fields['heading'] = isset($_POST['cheading']) ? htmlentities2utf8($_POST['cheading']) : ($id ? $obj->heading : '');
	$fields['discription'] = isset($_POST['discription']) ? htmlentities2utf8($_POST['discription']) : ($id ? $obj->discription : '');

   $fields['image'] = isset($_FILES['image']['name']) ? htmlentities2utf8($_FILES['image']['name']) : ($id ? $obj->image : '');
   
   	$extensions_arr = array("jpg","jpeg","png","gif");
move_uploaded_file($_FILES["image"]["tmp_name"],'uploads/'.$fields['image']);
	
	/* Check if submited form */
	if (isset($_POST['issuggest']) && $_POST['issuggest']) {
		saveMember($id, $fields);
	}

	/* Set member groups */

	

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}
// End function


/**
 * Save member function
 * 
 * @param number $id - unique member id
 * @param array $fields - member data
 * @return save member data or display errors
 */
function saveMember($id, $fields)
{
	global $DB, $TEMPLATE;



	/* Set items for update member profile */
	foreach ($fields AS $key => $value)
	{
		if (in_array($key, array('heading', 'discription', 'image'))) {
			$items[] = "`". $key ."` = '". $DB->escapeData($value) ."'";
		}
		
	}

	/* Check if this is a new member */
	if (!$id)
	{
		/* Insert member */
		$DB->query("INSERT INTO loghin_www .lg_contentsave `ctime` = '". time() ."', ". implode(',', $items));

		/* Get insert id */
		$id = $DB->get_insert_id();

		/* Set message */
		$TEMPLATE->setMessage('info', __('suggestion_added'));
	}
	else
	{
		/* Update member info */
		$DB->query("UPDATE loghin_www .lg_contentsave SET ". implode(', ', $items) ." WHERE `id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('suggestion_updated'));
	}

	/* Redirect */
	redirect(VIR_CP_PATH .'index.php?m=editSugestions');

	return true;
}


