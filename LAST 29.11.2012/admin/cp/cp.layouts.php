<?php

/* Get vars */
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';


/* Choose action */
switch ($p)
{
	case 'add':
	case 'edit':
		editLayout($id);
	break;

	case 'delete':
		deleteLayout($id, $page);
	break;

	case 'items':
		if (isAjax) {
			/* Set template file */
			$TEMPLATE->setTemplate('response.tpl');

			/* Get post vars */
			$id = isset($_POST['id']) && is_numeric($_POST['id']) ? $_POST['id'] : 0;

			/* Response */
			$TEMPLATE->assign('response', json_encode(sitesApplications($id)));
		}
	break;

	default:
		showLayouts($id, $page);
	break;
}


/**
 * Edit page function
 * 
 * @param number $id - unique layout id
 * @return display layout form, for edit or add
 */
function editLayout($id)
{
	global $DB, $TEMPLATE;

	/* Set template */
	$TEMPLATE->setTemplate('layoutEdit.tpl');

	/* Assign page name */
	$TEMPLATE->assign('appPage', $id ? __('edit_layout') : __('add_layout'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH ."index.php?m=layouts&p=add", 'optname' => __('add_layout')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts\">". __('manage_layouts') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_layout') : __('add_layout')) ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Set default fields var */
	$fields = array('id' => $id, 'parent' => array('layout' => array(), 'application' => array()), 'types' => array('layout' => __('layout'), 'application' => __('application')), 'memberTypes' => getMemberTypes());
	$data = array();
	
	/* Check if layout need to be edited */
	if ($id) {
		/* Result layout data */
		$result = $DB->query("SELECT `l`.*, `d`.`name` FROM `". DB_PREFIX ."layouts` AS `l` LEFT JOIN `". DB_PREFIX ."layouts_data` AS `d` ON `d`.`layout_id` = `l`.`layout_id` AND `d`.`lang` = '". SYS_LANG ."' WHERE `l`.`layout_id` = '". $id ."' AND `l`.`default` = '1' LIMIT 1");

		/* Fetch resultset */
		if (!$obj = $DB->fetchObject($result)) {
			/* Set message */
			$TEMPLATE->setMessage('error', __('no_layout'));
			return;
		}

		/* Free result */
		$DB->freeResult($result);

		/* Result layouts data */
		$_result = $DB->query("SELECT `lang`, `name` FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = '". $id ."'");

		/* Fetch resultset */
		while ($_obj = $DB->fetchObject($_result)) {
			/* Set data */
			$data[$_obj->lang] = array('name' => $_obj->name);
		}

		/* Free result */
		$DB->freeResult($_result);
	}

	/* Parsing post data */
	$fields['member_type'] = isset($_POST['member_type']) ? (array_key_exists($_POST['member_type'], $fields['memberTypes']) ? $_POST['member_type'] : 0) : ($id ? $obj->member_type : 0);
	$fields['items'] = isset($_POST['items']) && is_array($_POST['items']) ? $_POST['items'] : ($id ? explode(',', $obj->sites) : array());
	$fields['status'] = isset($_POST['status']) ? ($_POST['status'] ? 1 : 0) : ($id ? $obj->status : '');
	$fields['_items'] = $fields['member_type'] ? sitesApplications($fields['member_type']) : false;

	/* Parse data for each language */
	foreach (Language::getInstance()->list AS $lang => $language) {
		$fields['name'][$lang] = isset($_POST['name'][$lang]) ? $DB->stripSlashes(htmlentities2utf8($_POST['name'][$lang])) : ($id && isset($data[$lang]) ? $data[$lang]['name'] : '');
	}

	/* Check if layout form is submited */
	if (isset($_POST['isLayout']) && $_POST['isLayout']) {
		saveLayout($id, $fields);
	}

	/* Active / Inactive box */
	$fields['statuse'][1] = __('active');
	$fields['statuse'][0] = __('inactive');

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save page function
 * 
 * @param number $id - unique page id for edit
 * @param array $fields - page data sent by form
 * @return update page data and redirect to edit page
 */
function saveLayout($id, $fields) {
	global $DB, $TEMPLATE;

	/* Set default vars */
	$items = array();
	$_items = array();
	$errors = array();

	/* Validate member type */
	if ($fields['member_type'] == 0) {
		$errors['member_type'] = __('member_type_invalid');
	}

	/* Parse data for each language */
	foreach (Language::getInstance()->list AS $lang => $language) if (empty($fields['name'][$lang]) !== true) {
		/* Set items */
		$items[$lang] = "`lang` = '". $lang ."', `name` = '". $DB->escapeData($fields['name'][$lang]) ."'";
	}

	/* Check if exist content for minimum one language */
	if (empty($items) !== false) {
		/* Set messages */
		$errors['content'] = __('fill_content');
	}

	/* Validate items */
	foreach ($fields['items'] AS $key => $item) {
		if (!array_key_exists($item, $fields['_items']['site']) && !array_key_exists($item, $fields['_items']['application'])) {
			unset($fields['items'][$key]);
		}
	}
	if (count($fields['items']) < 12) {
		$errors['items'] = __('items_invalid');
	}

	/* Check if exist errors */
	if (false == empty($errors)) {
		/* Set message */
		$TEMPLATE->setMessage('errors', $errors);
		return false;
	}

	/* Set status */
	$_items[] = "`member_type` = '". $DB->escapeData($fields['member_type']) ."'";
	$_items[] = "`sites` = '". $DB->escapeData(implode(',', $fields['items'])) ."'";
	$_items[] = "`status` = '". $fields['status'] ."'";
	$_items[] = "`default` = '1'";

	/* Check if isset id */
	if ($id) {
		/* Update */
		$DB->query("UPDATE `". DB_PREFIX ."layouts` SET ". implode(', ', $_items) ." WHERE `layout_id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('layout_updated'));
	}
	/* Add new layout in database */
	else {
		/* Insert */
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts` SET `postdate` = '". time() ."', ". implode(', ', $_items));

		/* Get inserted id */
		$id = $DB->getInsertId();

		/* Set message */
		$TEMPLATE->setMessage('info', __('layout_added'));
	}

	/* Delete layout data */
	$DB->query("DELETE FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = '". $id ."'");

	/* Insertlayouts data */
	foreach ($items AS $lang => $data) {
		/* Insert new layout in database */
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts_data` SET `layout_id` = '". $id ."', ". $data);
	}

	/* Redirect */
	redirect(VIR_CP_PATH .'index.php?m=layouts&p=edit&id='. $id);

	return true;
}


/**
 * Delete layout function
 * 
 * @param number $id - unique layout id
 * @param number $page - after deleting layout redirect to previous page
 * @return delete layout and redirect to manage layouts
 */
function deleteLayout($id, $page)
{
	global $DB, $TEMPLATE, $LANG;

	/* Set template file */
	$TEMPLATE->setTemplate('layouts.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('app_delete'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=layouts&p=add", 'optname' => __('add_layout')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts\">". __('manage_layouts') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&p=delete&id=". $id ."\">". __('delete') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Result page data */
	$result = $DB->query("SELECT `layout_id` FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contains any rows and resultset it */
	if (!$obj = $DB->fetchObject($result))  {
		$TEMPLATE->setMessage("error", __('no_layout'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Delete page from database */
	$DB->query("DELETE FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $id ."' LIMIT 1");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('layout_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=layouts&page='. $page);

	return true;
}


/**
 * Show layouts function
 * 
 * @param number $page - current page number
 * @return display list of all layouts
 */
function showLayouts($page)
{
	global $DB, $TEMPLATE;

	/* Set template */
	$TEMPLATE->setTemplate('layouts.tpl');

	/* Assign page name */
	$TEMPLATE->assign('appPage', __('app_layouts'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH .'index.php?m=layouts&p=add', 'optname' => __('add_layout')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks = array(
		array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts\">". __('manage_layouts') ."</a>")
	);
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Set default vars */
	$fields = array('items' => array());

	/* Set results per page */
	if (isset($_GET['results']) && is_numeric($_GET['results']) && $_GET['results'])
	{
		$fields['results'] = intval($_GET['results']);
		$_SESSION['results_layouts'] = $fields['results'];
	}
	elseif (isset($_SESSION['results_layouts']) && is_numeric($_SESSION['results_layouts']) && $_SESSION['results_layouts']) {
		$fields['results'] = intval($_SESSION['results_layouts']);
	}
	else {
		$fields['results'] = 25;
	}

	/* Result total layouts */
	$result = $DB->query("SELECT COUNT(`layout_id`) FROM `". DB_PREFIX ."layouts` WHERE `default` = '1'");

	/* Set totalpages */
	$totalitems = $DB->result($result);

	/* Free result */
	$DB->freeResult($result);

	/* Get pagination */
	list($fields['pages'], $LIMIT) = pagination($totalitems, $fields['results'], "<a href=\"". VIR_CP_PATH ."index.php?m=layouts&page=%page%\">%name%</a> ", $page, "<strong>%page%</strong>", "<span>...</span>", true);

	/* Result layouts data */
	$result = $DB->query("SELECT `l`.`layout_id`, `l`.`member_type`, `d`.`name`, `l`.`status`, (SELECT GROUP_CONCAT(`lang`) FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = `l`.`layout_id`) AS `languages` FROM `". DB_PREFIX ."layouts` AS `l` LEFT JOIN `". DB_PREFIX ."layouts_data` AS `d` ON `d`.`layout_id` = `l`.`layout_id` AND `d`.`lang` = '". SYS_LANG ."' WHERE `l`.`default` = '1' ORDER BY `l`.`layout_id` ASC ". $LIMIT);

	/* Check if resultset contain any rows */
	if ($DB->numRows($result) > 0) {
		/* Set layouts data */
		while ($obj = $DB->fetchObject($result)) {
			/* Set items */
			$fields['items'][$obj->layout_id] = array(
				'name' => $obj->name,
				'member_type' => getMemberTypes($obj->member_type),
				'languages' => str_replace(',', ', ', strtoupper($obj->languages)),
				'status' => $obj->status ? __('active') : __('inactive')
			);
		}
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_layouts'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);
	$TEMPLATE->assign('page', $page);

	return true;
}
