<?php

/* GET values */
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';

/* Ajax change status */
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	ajaxChangeValue();
}
else {
	/* Choose Method */
	switch ($p)
	{
		case 'add':
		case 'edit':
			groupsEdit($id);
		break;
	
		case 'delete':
			groupsDelete($id);
		break;
	
		case 'addAction':
		case 'editAction':
			editGroupAction($id);
		break;
	
		case 'actions':
			showActions();
		break;
	
		case 'deleteAction':
			deleteAction($id);
		break;

		default:
			groupsView();
		break;
	}
}


/**
 * Show add and edit group form
 * 
 * @param number $id - unique member id
 * @return display edit member group
 */
function groupsEdit($id)
{
	global $DB, $TEMPLATE, $SESSION, $PREFS;

	/* Set template file */
	$TEMPLATE->setTemplate('membergroupsEdit.tpl');

	/* Assign page title */
	$TEMPLATE->assign('app_page', $id ? __('app_edit') : __('app_add'));

	/* Assign option links */
	$optlinks = array(array('header' => __('options')),
						array('optlink' => 'index.php?m=membergroups&p=add', 'optname' => __('add_group')),
						array('optlink' => 'index.php?m=membergroups&p=actions', 'optname' => __('manage_actions')),
						array('optlink' => 'index.php?m=membergroups&p=addAction', 'optname' => __('add_action')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a href=\"" . VIR_CP_PATH . "index.php?m=membergroups\">". __('manage_membergroups') ."</a>";
	$navlinks[]['navlink'] = "<a href=\"" . VIR_CP_PATH . "index.php?m=membergroups&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_group') : __('add_group')) ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Check if user has access to this page /
	if (!$SESSION->conf['can_manage_forum_members_groups']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}*/

	/* Set default vars */
	$fields = array('id' => $id, 'groups' => get_members_groups());

	/* Get group */
	$result = $DB->query("SELECT `name` FROM `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` WHERE `group_id` = '" . ($id ? $id : $PREFS->conf['regular_member_group']) . "' LIMIT 1");

	/* Fetch resultset */
	if (!$obj = $DB->fetchObject($result)) {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_group'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Parse Post data */
	$fields["name"] = isset($_POST['name']) ? htmlentities2utf8($_POST['name']) : ($id ? $obj->name : '');
	$fields['duplicate'] = isset($_POST['duplicate']) && array_key_exists($_POST['duplicate'], $fields['groups']) ? $_POST['duplicate'] : ($PREFS->conf['regular_member_group']);

	/* Check if user submitted the form */
	if (isset($_POST['isGroup']) && $_POST['isGroup']) {
		groupsSave($id, $fields);
	}

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save group function
 * 
 * @param number $id - unique member group id
 * @param array $fields - member group data
 * @return save member group, and redirect to edit member goup
 */
//------------------------------------------------
// Save group
//------------------------------------------------
function groupsSave($id, $fields)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set default vars */
	$permissions = serialize(array());
	$_permissions = serialize(array());

	/* Validate values */
	if (empty($fields['name']) !== false) {
		$TEMPLATE->setMessage('error', __('empty_name'));
		return;
	}

	/* Escape name */
	$fields['name'] = $DB->escapeData($fields['name']);

	/* Check if dublicate member group */
	if (!$id && $fields['duplicate'])
	{
		/* Select general group permissions */
		$result = $DB->query("SELECT `permissions` FROM `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` WHERE `group_id` = '". $fields['duplicate'] ."' LIMIT 1");

		/* Check if resultset contains rows */
		if ($obj = $DB->fetchObject($result)) {
			$permissions = $DB->escapeData($obj->permissions);
		}
		else {
			/* Set message */
			$TEMPLATE->setMessage('error', __('no_group'), 1);
			return;
		}

		/* Free result */
		$DB->freeResult($result);

		/* Select site group permissions */
		$result = $DB->query("SELECT `permissions` FROM `". DB_PREFIX ."members_groups` WHERE `group_id` = '". $fields['duplicate'] ."' LIMIT 1");

		/* Check if resultset contains any rows */
		if ($obj = $DB->fetchObject($result)) {
			$_permissions = $DB->escapeData($obj->permissions);
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Select group name */
	$result = $DB->query("SELECT `name` FROM `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` WHERE `name` = '". $fields['name'] ."' AND `group_id` != '". $id ."' LIMIT 1");

	/* Check if resultset contains rows */
	if ($DB->numRows($result)) {
		/* Display message */
		$TEMPLATE->setMessage('error', __('existing_name'), 0);
		return;
	}

	/* Free result */
	$DB->freeResult($result);


	/* Insert group */
	if (!$id)
	{
		/* Insert groups into the database */
		$DB->query("INSERT INTO `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` (`name`, `permissions`) VALUES ('". $fields['name'] ."', '". $permissions ."')");

		/* Get insert id */
		$id = $DB->getInsertId();

		/* Result site groups data */
		$DB->query("UPDATE `". DB_PREFIX ."members_groups` SET `permissions` = '". $_permissions ."' WHERE `group_id` = '". $id ."' LIMIT 1");

		/* Check if site groups updated */
		if ($DB->affectedRows() < 1) {
			/* Insert site group in the database */
			$DB->query("INSERT INTO `". DB_PREFIX ."members_groups` (`group_id`, `permissions`) VALUES ('". $id ."', '". $_permissions ."')");
		}

		/* Set message */
		$TEMPLATE->setMessage('info', __('group_added'));
	}
	/* Update group */
	else
	{
		/* Update group in the database */
		$DB->query("UPDATE `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` SET `name` = '". $fields['name'] ."' WHERE `group_id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('group_updated'));
	}

	/* Redirect to edit group */
	redirect(VIR_CP_PATH .'index.php?m=membergroups&p=edit&id='. $id);

	return true;
}


/**
 * Save ajax value
 * 
 */
function ajaxChangeValue()
{
	global $DB, $TEMPLATE;

	/* Require Json class */
	require_once 'core.json.php';

	/* Create Json class */
	$Json = new Json();

	/* Get post data */
	$permissions = $fields = $permss = array();
	list ($label, $id) = isset($_POST['id']) && strpos($_POST['id'], '|') !== false ? explode('|', $_POST['id']) : array('', '');
	$e = isset($_POST['e']) && $_POST['e'] == 'true' ? 1 : 0;

	/* Get groups */
	$result = $DB->query("SELECT `g`.`permissions` FROM `". DB_PREFIX ."members_groups` AS `g` WHERE `g`.`group_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contains any rows, if contain fetch resultset */
	if ($obj = $DB->fetchObject($result)) {
		/* Set values */
		$permissions = unserialize($obj->permissions);
	}
	else {
		/* Set message */
		$Json->setError(__('no_groups_exist'));
	}

	if (!$Json->isError())
	{
		/* Result actions */
		$result = $DB->query("SELECT `a`.`label` FROM `". DB_PREFIX ."members_groups_actions` AS `a` WHERE `a`.`parent_id` != '0'");
	
		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			$permss[$obj->label] = ($label == $obj->label) ? $e : (isset($permissions[$obj->label]) ? $permissions[$obj->label] : 0);
		}
		
		/* Free result */
		$DB->freeResult($result);
	
		/* Update member group */
		$DB->query("UPDATE `". DB_PREFIX ."members_groups` SET `permissions` = '". $DB->escapeData(serialize($permss)) ."' WHERE `group_id` = '". $id ."' LIMIT 1");

		/* Set response var */
		$fields['img'] = VIR_CP_TPL_PATH .'media/'. ($e ? 'tick' : 'cross') .'.png'; 
	}

	/* Assging template vars */
	$TEMPLATE->assign('response', $Json->Encode($fields, true));

	return true;
}


/**
 * Delete group function
 * 
 * @param number $id - unique member group id
 * @return remove member group from database and redirect to member groups page
 */
function groupsDelete($id)
{
	global $DB, $TEMPLATE, $SESSION, $PREFS;

	/* Set template file */
	$TEMPLATE->setTemplate('membergroups.tpl');

	/* Assign page title */
	$TEMPLATE->assign("app_page", __('app_membergroups'));

	/* Assign option links */
	$optlinks = array(array('header' => __('options')),
					array('optlink' => 'index.php?m=membergroups&p=add', 'optname' => __('add_group')),
					array('optlink' => 'index.php?m=membergroups&p=actions', 'optname' => __('manage_actions')),
					array('optlink' => 'index.php?m=membergroups&p=addAction', 'optname' => __('add_action')));
	$TEMPLATE->assign('optlinks', $optlinks);


	/* Check if user has access to this page /
	if (!$SESSION->conf['can_manage_forum_members_groups']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}*/

	/* Make sure its not current user's group */
	if ($id == $SESSION->conf['group_id']) {
		$TEMPLATE->setMessage('error', __('enrolled_group'), 1);
		return;
	}

	/* Make sure its not current user's group */
	if ($id == $PREFS->conf['regular_member_group'] || $id == $PREFS->conf['guest_member_group']) {
		$TEMPLATE->setMessage("error", __('used_group'), 1);
		return;
	}

	/* Update members groups */
	$DB->query("UPDATE `". DB_DATA ."`.`". DATA_PREFIX ."members` SET `group_id` = '". $PREFS->conf['regular_member_group'] ."' WHERE `group_id` = '". $id ."'");

	/* Delete group */
	$DB->query("DELETE FROM `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` WHERE `group_id` = '". $id ."' LIMIT 1");
	$DB->query("DELETE FROM `". DB_PREFIX ."members_groups` WHERE `group_id` = '". $id ."' LIMIT 1");
	
	/* Set message and redirect to groups */
	$TEMPLATE->setMessage('info', __('group_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=membergroups');
}


/**
 * Show member groups function
 * 
 * @return display all members groups list
 */
function groupsView()
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate("membergroups.tpl");

	/* Assign page title */
	$TEMPLATE->assign("app_page", __('app_membergroups'));

	/* Assign option links */
	$optlinks = array(array('header' => __('options')),
						array('optlink' => 'index.php?m=membergroups&p=add', 'optname' => __('add_group')),
						array('optlink' => 'index.php?m=membergroups&p=actions', 'optname' => __('manage_actions')),
						array('optlink' => 'index.php?m=membergroups&p=addAction', 'optname' => __('add_action')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a href=\"" . VIR_CP_PATH . "index.php?m=membergroups\">". __('manage_membergroups') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Check if user has access to this page /
	if (!$SESSION->conf['can_manage_forum_members_groups']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}*/

	/* Set default vars */
	$fields = array('actions' => array(), 'fields' => array());
	$members = array();

	/* Count members */
	$result = $DB->query("SELECT `group_id`, COUNT(`member_id`) AS totalmembers FROM `". DB_DATA ."`.`". DATA_PREFIX ."members` GROUP BY `group_id`");

	/* Fetch resultset */
	while($obj = $DB->fetchObject($result)) {
		$members[$obj->group_id] = $obj->totalmembers;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Result actions */
	$result = $DB->query("SELECT `a`.`action_id`, `d`.`name`, `a1`.`action_id` AS `option_id`, `a1`.`label`, `d1`.`name` AS `option` FROM `". DB_PREFIX ."members_groups_actions` AS `a` LEFT JOIN `". DB_PREFIX ."members_groups_actions_data` AS `d` ON `d`.`action_id` = `a`.`action_id` AND ((`d`.`lang` = '". SYS_LANG ."' AND `status` = '1') OR `d`.`lang` = '". _LANGUAGE_ ."') LEFT OUTER JOIN `". DB_PREFIX ."members_groups_actions` AS `a1` ON `a1`.`parent_id` = `a`.`action_id` LEFT JOIN `". DB_PREFIX ."members_groups_actions_data` AS `d1` ON `d1`.`action_id` = `a1`.`action_id` AND ((`d1`.`lang` = '". SYS_LANG ."' AND `d1`.`status` = '1') OR `d1`.`lang` = '". _LANGUAGE_ ."') WHERE `a`.`parent_id` = '0' ORDER BY `a`.`orderid` ASC, `a1`.`orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result))
	{
		/* Set primary */
		if (false !== empty($fields['actions'][$obj->action_id])) {
			$fields['actions'][$obj->action_id] = array('name' => $obj->name, 'items' => array());
		}

		/* Set items */
		$fields['actions'][$obj->action_id]['items'][$obj->option_id] = array('label' => $obj->label, 'name' => $obj->option);
	}
	
	/* Free result */
	$DB->freeResult($result);

	/* Get groups */
	$result = $DB->query("SELECT `d`.`group_id`, `d`.`name`, `g`.`permissions` FROM `". DB_DATA ."`.`". DATA_PREFIX ."members_groups` AS `d` LEFT JOIN `". DB_PREFIX ."members_groups` AS `g` ON `g`.`group_id` = `d`.`group_id` ORDER BY `name` ASC");

	/* Check if resultset contains any rows */
	if ($DB->numRows($result))
	{
		/* Fetch resultset */
		while($obj = $DB->fetchObject($result))
		{
			/* Set values */
			$fields['fields'][$obj->group_id] = array
			(
				'name' => $obj->name,
				'members' => isset($members[$obj->group_id]) ? $members[$obj->group_id] : 0,
				'permiss' => unserialize($obj->permissions)
			);
		}
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_groups_exist'));
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}







/**
 * Edit group action
 *  
 */
function editGroupAction($id)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('memberGroupsActionEdit.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __($id ? 'edit_action' : 'add_action'));

	/* Assign option links */
	$optlinks = array(array('header' => __('options')),
						array('optlink' => 'index.php?m=membergroups&p=add', 'optname' => __('add_group')),
						array('optlink' => 'index.php?m=membergroups&p=actions', 'optname' => __('manage_actions')),
						array('optlink' => 'index.php?m=membergroups&p=addAction', 'optname' => __('add_action')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Set default vars */
	$fields = array('id' => $id, 'languages' => Language::getInstance()->list, 'parents' => array(), 'data' => array());

	/* Check if is edit group action */
	if ($id)
	{
		/* Result action data */
		$result = $DB->query("SELECT `parent_id`, `label` FROM `". DB_PREFIX ."members_groups_actions` WHERE `action_id` = '". $id ."' LIMIT 1");

		/* Check if resultset contain any rows and fetch resultset */
		if (!$obj = $DB->fetchObject($result)) {
			$TEMPLATE->setMessage('error', __('no_action'), 1);
			return;
		}

		/* Free result */
		$DB->freeResult($result);

		/* Result action data */
		$result = $DB->query("SELECT `lang`, `name` FROM `". DB_PREFIX ."members_groups_actions_data` WHERE `action_id` = '". $id ."'");

		/* Fetch resultset */
		while ($_obj = $DB->fetchObject($result)) {
			/* Set data */
			$fields['data'][$_obj->lang] = $_obj->name;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Select parents */
	$result = $DB->query("SELECT `a`.`action_id`, `d`.`name` FROM `". DB_PREFIX ."members_groups_actions` AS `a` LEFT JOIN `". DB_PREFIX ."members_groups_actions_data` AS `d` ON `d`.`action_id` = `a`.`action_id` AND `d`.`lang` = '". SYS_LANG ."' WHERE `a`.`parent_id` = '0' AND `a`.`action_id` != '". $id ."'");

	/* Fetch resultset */
	while ($_obj = $DB->fetchObject($result)) {
		$fields['parents'][$_obj->action_id] = $_obj->name;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Parse post data */
	$fields['parent'] = isset($_POST['parent']) ? (array_key_exists($_POST['parent'], $fields['parents']) ? $_POST['parent'] : 0) : ($id ? $obj->parent_id : 0);
	$fields['label'] = isset($_POST['label']) ? htmlentities2utf8($_POST['label']) : ($id ? $obj->label : '');

	/* Parse language data */
	foreach ($fields['languages'] AS $lang => $language) {
		$fields['name'][$lang] = isset($_POST['name'][$lang]) ? htmlentities2utf8($_POST['name'][$lang]) : ($id && isset($fields['data'][$lang]) ? $fields['data'][$lang] : '');
	}

	/* Check if submited form */
	if (isset($_POST['isGroupAction']) && $_POST['isGroupAction']) {
		saveGroupAction($id, $fields);
	}

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save group action function
 * 
 */
function saveGroupAction($id, $fields)
{
	global $DB, $TEMPLATE;

	/* Set default vars */
	$errors = $items = array();
	$is_fill = false;

	/* Validate label */
	if ($fields['parent'] != 0 && !preg_match("/^([_a-z]+)$/i", $fields['label'])) {
		$errors['label'] = __('fill_label');
	}

	/* Parse data for each language */
	foreach ($fields['languages'] AS $lang => $language)
	{
		/* Set default status var */
		$status = 0;

		/* Validate content content */
		if (false === empty($fields['name'][$lang])) {
			/* Set is fill to true */
			$is_fill = true;
			$status = 1;
		}

		/* Set items */
		$items[$lang] = "`lang` = '". $lang ."', `name` = '". $DB->escapeData($fields['name'][$lang]) ."', `status` = '". $status ."'";
	}

	/* Check if exist content for minimum one language */
	if (empty($is_fill) !== false) {
		/* Set messages */
		$errors['name'] = __('fill_action_name');
	}

	/* Check if exist errors */
	if (count($errors) >= 1) {
		$TEMPLATE->setMessage('error', $errors);
		return;
	}

	/* Check if is new action */
	if ($id == 0)
	{
		/* Insert new action */
		$DB->query("INSERT INTO `". DB_PREFIX ."members_groups_actions` SET `parent_id` = '". $fields['parent'] ."', `label` = '". $DB->escapeData($fields['label']) ."'");

		/* Get id */
		$id = $DB->getInsertId();

		/* Set message */
		$TEMPLATE->setMessage('info', __('action_added'));
	}
	else
	{
		/* Update action data */
		$DB->query("UPDATE `". DB_PREFIX ."members_groups_actions` SET `parent_id` = '". $fields['parent'] ."', `label` = '". $DB->escapeData($fields['label']) ."' WHERE `action_id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('action_updated'));
	}

	/* Update actions data */
	foreach ($items AS $lang => $data)
	{
		/* Check if exist action data */
		$result = $DB->query("SELECT `data_id` FROM `". DB_PREFIX ."members_groups_actions_data` WHERE `action_id` = '". $id ."' AND `lang` = '". $lang ."' LIMIT 1");

		/* Check if resultset contain any row */
		if ($obj = $DB->fetchObject($result)) {
			$DB->query("UPDATE `". DB_PREFIX ."members_groups_actions_data` SET ". $data ." WHERE `data_id` = '". $obj->data_id ."'");
		}
		else {
			$DB->query("INSERT INTO `". DB_PREFIX ."members_groups_actions_data` SET `action_id` = '". $id ."', ". $data);
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Redirect */
	redirect(VIR_CP_PATH .'index.php?m=membergroups&p=editAction&id='. $id);

	return true;
}

/**
 * Delete action
 * 
 */
function deleteAction($id)
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('memberGroupsActions.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('delete_action'));

	/* Assign option links */
	$optlinks = array(array('header' => __('options')),
						array('optlink' => 'index.php?m=membergroups&p=add', 'optname' => __('add_group')),
						array('optlink' => 'index.php?m=membergroups&p=actions', 'optname' => __('manage_actions')),
						array('optlink' => 'index.php?m=membergroups&p=addAction', 'optname' => __('add_action')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Result action data */
	$result = $DB->query("SELECT `parent_id` FROM `". DB_PREFIX ."members_groups_actions` WHERE `action_id` = '". $id ."' LIMIT 1");

	/* Check if resultset don't contain any rows set error */
	if (!$obj = $DB->fetchObject($result)) { 
		$TEMPLATE->setMessage('error', __('no_action'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Check if is primary action delete secundary */
	if ($obj->parent_id == 0)
	{
		/* Result secundary */
		$result = $DB->query("SELECT `action_id` FROM `". DB_PREFIX ."members_groups_actions` WHERE `parent_id` = '". $id ."'");

		/* Fetch resultset */
		while ($_obj = $DB->fetchObject($result)) {
			/* Delete secundary */
			$DB->query("DELETE FROM `". DB_PREFIX ."members_groups_actions` WHERE `action_id` = '". $_obj->action_id ."'");
			$DB->query("DELETE FROM `". DB_PREFIX ."members_groups_actions_data` WHERE `action_id` = '". $_obj->action_id ."'");
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Delete action */
	$DB->query("DELETE FROM `". DB_PREFIX ."members_groups_actions` WHERE `action_id` = '". $id ."' LIMIT 1");
	$DB->query("DELETE FROM `". DB_PREFIX ."members_groups_actions_data` WHERE `action_id` = '". $id ."' LIMIT 1");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('action_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=membergroups&p=actions');

	return true;
}


/**
 * Show actions list
 * 
 */
function showActions()
{
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('memberGroupsActions.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('actions'));

	/* Assign option links */
	$optlinks = array(array('header' => __('options')),
						array('optlink' => 'index.php?m=membergroups&p=add', 'optname' => __('add_group')),
						array('optlink' => 'index.php?m=membergroups&p=actions', 'optname' => __('manage_actions')),
						array('optlink' => 'index.php?m=membergroups&p=addAction', 'optname' => __('add_action')));
		$TEMPLATE->assign("optlinks", $optlinks);

	/* Set default vars */
	$fields = array('fields' => array());

	/* Result actions */
	$result = $DB->query("SELECT `a`.`action_id`, `d`.`name`, `a1`.`action_id` AS `option_id`, `a1`.`label`, `d1`.`name` AS `option` FROM `". DB_PREFIX ."members_groups_actions` AS `a` LEFT JOIN `". DB_PREFIX ."members_groups_actions_data` AS `d` ON `d`.`action_id` = `a`.`action_id` AND ((`d`.`lang` = '". SYS_LANG ."' AND `status` = '1') OR `d`.`lang` = '". _LANGUAGE_ ."') LEFT OUTER JOIN `". DB_PREFIX ."members_groups_actions` AS `a1` ON `a1`.`parent_id` = `a`.`action_id` LEFT JOIN `". DB_PREFIX ."members_groups_actions_data` AS `d1` ON `d1`.`action_id` = `a1`.`action_id` AND ((`d1`.`lang` = '". SYS_LANG ."' AND `d1`.`status` = '1') OR `d1`.`lang` = '". _LANGUAGE_ ."') WHERE `a`.`parent_id` = '0' ORDER BY `a`.`orderid` ASC, `a1`.`orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result))
	{
		/* Set primary */
		if (false !== empty($fields['fields'][$obj->action_id])) {
			$fields['fields'][$obj->action_id] = array('name' => $obj->name, 'items' => array());
		}

		/* Set items */
		$fields['fields'][$obj->action_id]['items'][$obj->option_id] = array('label' => $obj->label, 'name' => $obj->option);
	}
	
	/* Free result */
	$DB->freeResult($result);

	/* Assign template fields */
	$TEMPLATE->assign($fields);

	return true;
}
