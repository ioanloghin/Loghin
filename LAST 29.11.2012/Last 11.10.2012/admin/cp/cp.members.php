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

	case 'active':
		statusSwitch($id, $page, 0);
	break;

	case 'inactive':
		statusSwitch($id, $page, 1);
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
	$TEMPLATE->setTemplate('member_edit.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', $id ? __('edit_member') : __('add_member'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=members&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=members\">". __('members') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=members&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_member') : __('add_member')) ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);


	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_forum_members']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Check if edit member */
	if ($id)
	{
		/* Result member data */
		$result = $DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` WHERE `member_id` = '". $id ."' LIMIT 1");

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
	$fields['username'] = isset($_POST['username']) ? htmlentities2utf8($_POST['username']) : ($id ? $obj->username : '');
	$fields['email'] = isset($_POST['email']) ? htmlentities2utf8($_POST['email']) : ($id ? $obj->email : '');
	$fields['password'] = isset($_POST['password']) ? $_POST['password'] : '';
	$fields['password2'] = isset($_POST['password2']) ? $_POST['password2'] : '';
	$fields['group_id'] = isset($_POST['group']) && is_numeric($_POST['group']) ? $_POST['group'] : ($id ? $obj->group_id : 1);
	//$fields['forum_active'] = isset($_POST['forum_active']) ? ($_POST['forum_active'] ? 1 : 0) : ($id ? $obj->forum_active : 1);
	$fields['active'] = isset($_POST['active']) ? ($_POST['active'] ? 1 : 0) : ($id ? $obj->active : 1);
	$fields['joindate'] = $id ? get_date($obj->joindate, 'date') : '';
	$fields['lastvisit'] = $id ? get_date($obj->lastvisit, 'full') : '';

	/* Check if submited form */
	if (isset($_POST['ismember']) && $_POST['ismember']) {
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

	/* Include validation functions */
	require_once 'fns.validate.php';
	
	/* Set default vars */
	$items = $errors = array();

	/* Check username */
	if (validate_username($fields['username'], 4, 32)) {
		$errors['username'] = str_replace(array('%min%', '%max%'), array(4, 32), __('error_username'));
	}
	else
	{
		/* Result member data */
		$result = $DB->query("SELECT `member_id` FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` WHERE `username` = '". $DB->escapeData($fields['username']) ."' AND `member_id` != '". $id ."' LIMIT 1");

		/* Check if resultset contain any row */
		if ($DB->numRows($result)) {
			/* Set message */
			$errors['username'] = __('username_taken');
		}

		/* Free Result */
		$DB->freeResult($result);
	}

	/* Check email */
	if (validate_email($fields['email'])) {
		$errors['email'] = __('error_email');
	}
	else
	{
		/* Result email data */
		$result = $DB->query("SELECT member_id FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` WHERE `email` = '". $DB->escapeData($fields['email']) ."' AND `member_id` != '". $id ."' LIMIT 1");

		/* Check if resultset contain any row */
		if ($DB->numRows($result)) {
			$errors['email'] = __('email_taken');
		}

		/* Free Result */
		$DB->freeResult($result);
	}

	/* Check if send password and re-type password for change it */
	if ($id ? ($fields['password'] || $fields['password2']) : true)
	{
		/* Check password */
		if (validate_password($fields['password'], $fields['username'], 4, 20)) {
			$errors['password'] = str_replace(array('%min%', '%max%'), array(4, 20), __('error_password'));
		}
	
		/* Check retype password */
		if ($fields['password2'] == '' || $fields['password2'] != $fields['password']) {
			$errors['password2'] = __('error_rpoassword');
		}
	}


	/* Check if exist fields */
	if (empty($errors) !== true) {
		/* Set messages */
		$TEMPLATE->setMessage('error', $errors);
		return;
	}


	/* Set items for update member profile */
	foreach ($fields AS $key => $value)
	{
		if (in_array($key, array('group_id', 'username', 'email', 'forum_active', 'active'))) {
			$items[] = "`". $key ."` = '". $DB->escapeData($value) ."'";
		}
		elseif ($key == 'password' && $value != '') {
			$items[] = "`". $key ."` = '". $DB->escapeData(md5($value . md5('login.com'))) ."'";
		}
	}

	/* Check if this is a new member */
	if (!$id)
	{
		/* Insert member */
		$DB->query("INSERT INTO `". DB_DATA ."`.`". DATA_PREFIX ."members` SET `joindate` = '". time() ."', ". implode(',', $items));

		/* Get insert id */
		$id = $DB->get_insert_id();

		/* Set message */
		$TEMPLATE->setMessage('info', __('member_added'));
	}
	else
	{
		/* Update member info */
		$DB->query("UPDATE `". DB_DATA ."`.`". DATA_PREFIX ."members` SET ". implode(', ', $items) ." WHERE `member_id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('member_updated'));
	}

	/* Redirect */
	redirect(VIR_CP_PATH .'index.php?m=members&p=edit&id='. $id);

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
	$TEMPLATE->setTemplate('members.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', __('delete_member'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=members&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=members\">". __('members') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);


	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_forum_members']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Check delete own account */
	if ($id == $SESSION->conf['member_id']) {
		$TEMPLATE->setMessage('error', __('delete_own'), 1);
		return;
	}

	/* Result member data */
	$result = $DB->query("SELECT member_id FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` WHERE `member_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contains any rows */
	if ($DB->numRows($result) < 1) {
		/* Set message */
		$TEMPLATE->setMessage("error", __('no_member'), 1);
		return;
	}

	/* Clean up */
	$DB->freeResult($result);


	/* Delete member from database */
	$DB->query("DELETE FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` WHERE `member_id` = '". $id ."' LIMIT 1");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('member_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=members&page='. $page);

	return true;
}


/**
 * Member's properties switch
 * 
 * @param number $id - unique member id
 * @param number $page - number of page to redirect
 * @param boolean $s - member status
 */
function statusSwitch($id, $page, $s)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate("members.tpl");

	/* Assign page title */
	$TEMPLATE->assign("app_page", __('members'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=members&p=add", 'optname' => __('add_member')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"" . VIR_CP_PATH . "index.php?m=members\">". __('members') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);


	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_forum_members']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Get member status */
	$result = $DB->query("SELECT `active` FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` WHERE `member_id` = '". $id ."' LIMIT 1");

	/* Fetch resultset */
	if ($obj = $DB->fetchObject($result)) {
		/* Set values */
		$active = $obj->active;
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage("error", __('no_member'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Change status */
	if ($active != $s)
	{
		/* Check if member not your own member */
		if ($id != $SESSION->conf['member_id'])
		{
			/* chenge status */
			$DB->query("UPDATE `". DB_DATA ."`.`". DATA_PREFIX ."members` SET `active` = '". $s ."' WHERE `member_id` = '". $id ."' LIMIT 1");

			/* Set message */
			$TEMPLATE->setMessage('info', __('status_changed'));
		}
		/* Set message */
		else {
			$TEMPLATE->setMessage('error', __('no_change_own'));
		}
	}

	/* Redirect to members */
	redirect(VIR_CP_PATH . "index.php?m=members&page=". $page);

	return true;
}


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
	$TEMPLATE->setTemplate('members.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', __('app_members'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=members&p=add", 'optname' => __('add_member')));
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
	$result = $DB->query("SELECT * FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` ORDER BY `joindate` ASC ". $LIMIT);

	/* Check if exist member */
	if ($DB->numRows($result))
	{
		$fields['fields'] = array();

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
			$fields['fields'][$obj->member_id]['email'] = $obj->email;
			$fields['fields'][$obj->member_id]['group'] = isset($fields['groups'][$obj->group_id]) ? $fields['groups'][$obj->group_id] : $obj->group_id;
			$fields['fields'][$obj->member_id]['joindate'] = get_date($obj->joindate, 'full');
			$fields['fields'][$obj->member_id]['active'] = $obj->active;
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