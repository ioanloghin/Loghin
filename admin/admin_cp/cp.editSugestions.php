<?php


/* Get vars */
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';


/* Chaose action */
switch ($p)
{
	case 'add':
	case 'edit':
		editMember($id);
	break;

	case 'delete':
		deleteMember($id, $page);
	break;

	default:
		showMembers($page);
	break;
}


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
	$TEMPLATE->assign('app_page', $id ? __('edit_member') : __('add_member'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=editSuggestions&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=editSuggestions\">". __('members') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=editSuggestions&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_member') : __('add_member')) ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);


	/* Check if user has access to this page */
// 	if (!$SESSION->conf['can_manage_members']) {
// 		$TEMPLATE->setMessage('error', __('no_access'), 1);
// 		return;
// 	}

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

	$fields['discription'] = isset($_POST['discription']) ? htmlentities2utf8($_POST['discription']) : ($id ? $obj->discription : '');
	
	/* Check if submited form */
	if (isset($_POST['issuggest']) && $_POST['issuggest']) {
		saveMember($id, $fields);
	}

	/* Set member groups */
	$fields['groups'] = get_members_groups();

	/* Set yes / no var */
	$fields['yesno'][1] = __('yes');
	$fields['yesno'][0] = __('no');

	/* Set status var */
	$fields['status'][1] = __('active');
	$fields['status'][0] = __('inactive');

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
		if (in_array($key, array('cheading', 'discription', 'image'))) {
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
//	redirect(VIR_CP_PATH .'index.php?m=editSugestions&p=edit&id='. $id);

	return true;
}


/**
 * Delete member function
 * 
 * @param number $id - unique member id
 * @param number $page - after deleting member redirect to members with this page 
 * @return delete member and redirect to members page
 */
function deleteMember($id, $page)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('editSugestions.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', __('delete_member'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
				array('optlink' => VIR_CP_PATH . "index.php?m=editSugestions&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=editSugestions\">". __('editSugestions') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);


	/* Check if user has access to this page */

	/* Check delete own account */
	if ($id == $SESSION->conf['id']) {
		$TEMPLATE->setMessage('error', __('delete_own'), 1);
		return;
	}

	/* Result member data */
	$result = $DB->query("SELECT * FROM loghin_www .lg_contentsave  WHERE `id` = '". $id ."' LIMIT 1");

	/* Check if resultset contains any rows */
	if ($DB->numRows($result) < 1) {
		/* Set message */
		$TEMPLATE->setMessage("error", __('no_member'), 1);
		return;
	}

	/* Clean up */
	$DB->freeResult($result);


	/* Delete member from database */
	$DB->query("DELETE FROM loghin_www .lg_contentsave WHERE `id` = '". $id ."' LIMIT 1");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('Sugestions_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=editSugestions&page='. $page);

	return true;
}


/**
 * Member's properties switch
 * 
 * @param number $id - unique member id
 * @param number $page - number of page to redirect
 * @param boolean $s - member status
 */


/**
 * Show members function
 * 
 * @param number $page - page number
 * @return displey all members data
 */
function showMembers($page)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template */
	$TEMPLATE->setTemplate('editSugestions.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', __('app_members'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=editSugestions&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);


	/* Check if user has access to this page /
	if (!$SESSION->conf['can_manage_forum_members']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}*/

	/* Set default vars */
	$fields = array();
	$fields['groups'] = get_members_groups();

	/* Set results per page */
	if (isset($_GET['results']) && is_numeric($_GET['results']) && $_GET['results'])
	{
		$fields['results'] = intval($_GET['results']);
		$_SESSION['results_members'] = $fields['results'];
	}
	elseif (isset($_SESSION['results_members']) && is_numeric($_SESSION['results_members'])&& $_SESSION['results_members']) {
		$fields['results'] = intval($_SESSION['results_members']);
	}
	else {
		$fields['results'] = 15;
	}

	/* Result total members */
	$result = $DB->query("SELECT COUNT(`member_id`) FROM `". DB_DATA ."`.`". DATA_PREFIX ."members`");
	$totalitems = $DB->result($result);

	/* Free Result */
	$DB->freeResult($result);
	
	/* Get pagination */
	list($fields['pages'], $LIMIT) = pagination($totalitems, $fields['results'], "<a href=\"". VIR_CP_PATH ."index.php?m=members&page=%page%\">%name%</a>", $page, "<strong>%page%</strong>", "<span>...</span>", true);

	/* Result data */
	$result = $DB->query("SELECT * FROM loghin_www .lg_contentsave");

	/* Check if exist member */
	if ($DB->numRows($result))
	{
		$fields['fields'] = array();

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
		   $fields['fields'][$obj->id]['heading'] = $obj->heading;
		   $fields['fields'][$obj->id]['discription'] = $obj->discription;
		   $fields['fields'][$obj->id]['image'] = $obj->image;
		   $fields['fields'][$obj->id]['ctime'] = $obj->ctime;

			
		}
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_members'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);
	$TEMPLATE->assign('page', $page);

	return true;
}