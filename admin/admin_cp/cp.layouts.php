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
	$fields = array('id' => $id, 'parent' => array('layout' => array(), 'application' => array()), 'types' => array('site' => __('site'), 'application' => __('application')));
	$data = array();

	/* Get Layouts Menus */
	$layoutsMenus = getLayoutsMenus();
	$layoutsIds = $groupsIds = array();

	/* Parse each layout menu */
	foreach ($layoutsMenus AS $key => $data) {
		foreach ($data['items'] AS $_key => $_data) {
			$layoutsIds[$_key] = $key;
			$layoutsMenus[$key]['items'][$_key] = array('name' => $_data, 'items' => array());
		}
	}

	/* result groups */
	$result = $DB->query("SELECT `group_id`, `parent_id`, `menu_id`, `name` FROM `". DB_PREFIX ."layouts_groups` ORDER BY `parent_id` ASC, `orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result)) if (array_key_exists($obj->menu_id, $layoutsIds)) {
		if ($obj->parent_id == 0) {
			$layoutsMenus[$layoutsIds[$obj->menu_id]]['items'][$obj->menu_id]['items'][$obj->group_id] = array('name' => $obj->name, 'items' => array());
		}
		else {
			$layoutsMenus[$layoutsIds[$obj->menu_id]]['items'][$obj->menu_id]['items'][$obj->parent_id]['items'][$obj->group_id] = $obj->name;
			$groupsIds[$obj->group_id] = true;
		}
	}

	/* Free resultset */
	$DB->freeResult($result);


	/* Check if layout need to be edited */
	if ($id) {
		/* Result layout data */
		$result = $DB->query("SELECT `s`.*, `p`.`name`, `ss`.`layout_id` AS `sublayout` FROM `". DB_PREFIX ."layouts` AS `s` LEFT JOIN `". DB_PREFIX ."layouts_data` AS `p` ON `p`.`layout_id` = `s`.`parent_id` AND `p`.`language` = '". SYS_LANG ."' LEFT JOIN `". DB_PREFIX ."layouts` AS `ss` ON `ss`.`parent_id` = `s`.`layout_id` WHERE `s`.`layout_id` = '". $id ."' LIMIT 1");

		/* Fetch resultset */
		if (!$obj = $DB->fetchObject($result)) {
			/* Set message */
			$TEMPLATE->setMessage('error', __('no_layout'));
			return;
		}

		/* Free result */
		$DB->freeResult($result);

		/* Check if exist parent layout for this layout */
		if ($obj->parent_id) {
			/* Set parent infor in navlink */
			$navlinks = array(
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts\">". __('manage_layouts') ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&p=edit&id=". $obj->parent_id ."\">". $obj->name ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&id=". $obj->parent_id ."\">". __('manage_sublayouts') ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_layout') : __('add_layout')) ."</a>")
			);
			$TEMPLATE->assign('navlinks', $navlinks);
		}

		/* Result layouts data */
		$_result = $DB->query("SELECT `language`, `name`, `details` FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = '". $id ."'");

		/* Fetch resultset */
		while ($_obj = $DB->fetchObject($_result)) {
			/* Set data */
			$data[$_obj->language] = array('name' => $_obj->name, 'details' => $_obj->details);
		}

		/* Free result */
		$DB->freeResult($_result);
	}

	/* Parsing post data */
	$fields['groups'] = $layoutsMenus;
	$fields['showParent'] = $id && $obj->sublayout ? false : true;
	$fields['lastImage'] = $id ? $obj->image : '';
	$fields['image'] = false === empty($_FILES['image']['name']) ? $_FILES['image'] : '';
	$fields['type'] = isset($_POST['type']) && array_key_exists($_POST['type'], $fields['types']) ? $_POST['type'] : ($id ? $obj->type : key($fields['types']));
	$fields['group'] = isset($_POST['group']) ? (array_key_exists($_POST['group'], $groupsIds) ? $_POST['group'] : 0) : ($id ? $obj->group_id : 0);
	$fields['url'] = isset($_POST['url']) ? $_POST['url'] : ($id ? $obj->url : '');
	$fields['status'] = isset($_POST['status']) ? ($_POST['status'] ? 1 : 0) : ($id ? $obj->status : '');

	/* Results parents */
	$result = $DB->query("SELECT `s`.`layout_id`, `s`.`type`, `d`.`name` FROM `". DB_PREFIX ."layouts` AS `s` LEFT JOIN `". DB_PREFIX ."layouts_data` AS `d` ON `d`.`layout_id` = `s`.`layout_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`parent_id` = '0' AND `s`.`layout_id` != '". $id ."' ORDER BY `d`.`name` ASC");

	/* Fetch resultset */
	while ($_obj = $DB->fetchObject($result)) {
		$fields['parents'][$_obj->type][$_obj->layout_id] = $_obj->name;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Set parent id */
	$fields['parent'] = isset($_POST['parent'][$fields['type']]) ? (array_key_exists($_POST['parent'][$fields['type']], $fields['parents'][$fields['type']]) ? $_POST['parent'][$fields['type']] : 0) : ($id ? $obj->parent_id : 0);

	/* Parse data for each language */
	foreach (Language::getInstance()->list AS $lang => $language) {
		$fields['name'][$lang] = isset($_POST['name'][$lang]) ? $DB->stripSlashes(htmlentities2utf8($_POST['name'][$lang])) : ($id && isset($data[$lang]) ? $data[$lang]['name'] : '');
		$fields['details'][$lang] = isset($_POST['details'][$lang]) ? $DB->stripSlashes(htmlentities2utf8($_POST['details'][$lang])) : ($id && isset($data[$lang]) ? $data[$lang]['details'] : '');
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
function saveLayout($id, $fields)
{
	global $DB, $TEMPLATE;

	/* Create Image class */
	require 'Image.class.php';

	/* Set default vars */
	$items = array();
	$_items = array();
	$errors = array();

	/* Validate member type */
	if ($fields['group'] == 0 && $fields['parent'] == 0) {
		$errors['member_type'] = __('group_invalid');
	}
	elseif ($fields['parent'] != 0) {
		$fields['group'] = 0;
	}

	/* Parse data for each language */
	foreach (Language::getInstance()->list AS $lang => $language)
	{
		/* Set default var */
		$status = 0;

		/* Validate page content */
		if (empty($fields['name'][$lang]) !== true) {
			/* Set fill tru and status 1 */
			$is_fill = true;
			$status = 1;
		}

		/* Set items */
		$items[$lang] = "`language` = '". $lang ."', `name` = '". $DB->escapeData($fields['name'][$lang]) ."', `details` = '". $DB->escapeData($fields['details'][$lang]) ."', `status` = '". $status ."'";
	}

	/* Check if exist content for minimum one language */
	if (empty($is_fill) !== false) {
		/* Set messages */
		$errors['content'] = __('fill_content');
	}

	/* Check if url is valid */
	if($fields['url'] && filter_var($fields['url'], FILTER_VALIDATE_URL) === false) {
		$errors['url'] = __('no_valid_url');
	}

	/* Check if thumbnail image was selected */
	if ('' != $fields['image'])
	{
		/* Get image and image error */
		list($fields['_image'], $errors['image']) = Image::uploadImage($fields['image'], array
		(
			'dir' => SYS_PIC_PATH .'www/layouts/',
			'fileSize' => 1024,
    		'resize' => array
    		(
    			array
    			(
	    			'dir' => SYS_PIC_PATH .'www/layouts/',
	    			'prefix' => '',
	    			'cutoff' => 1,
	    			'width' => 48,
	    			'height' => 48
    			)
    		)
    	));

    	/* Check if is empty image error unset it */
    	if (false !== empty($errors['image'])) {
    		unset($errors['image']);
    	}
	}

	/* Check if exist errors */
	if (false == empty($errors))
	{
		/* Check if uploded image */
		if (false == empty($fields['_image'])) {
			@unlink(SYS_PIC_PATH .'layouts/'. $fields['_image']);
		}

		/* Set message */
		$TEMPLATE->setMessage('errors', $errors);
		return false;
	}

	/* Check if exist layout thumbnail image */
	if ($fields['lastImage'] && false == empty($fields['_image'])) {
		@unlink(SYS_PIC_PATH .'layouts/'. $fields['lastImage']);
	}

	/* Set status */
	false == empty($fields['_image']) ? $_items[] = "`image` = '". $fields['_image'] ."'" : false;
	$_items[] = "`type` = '". $DB->escapeData($fields['type']) ."'";
	$_items[] = "`group_id` = '". $DB->escapeData($fields['group']) ."'";
	$_items[] = "`url` = '". $DB->escapeData($fields['url']) ."'";
	$fields['showParent'] ? $_items[] = "`parent_id` = '". $DB->escapeData($fields['parent']) ."'" : false;
	$_items[] = "`status` = '". $fields['status'] ."'";

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

	/* Update layouts data */
	foreach ($items AS $lang => $data) {
		/* Check if exist page data */
		$result = $DB->query("SELECT `layout_id` FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = '". $id ."' AND `language` = '". $lang ."' LIMIT 1");

		/* Check if resultset contain any row */
		if ($obj = $DB->fetchObject($result)) {
			$DB->query("UPDATE `". DB_PREFIX ."layouts_data` SET ". $data ." WHERE `layout_id` = '". $id ."' AND `language` = '". $lang ."' LIMIT 1");
		}
		else {
			$DB->query("INSERT INTO `". DB_PREFIX ."layouts_data` SET `layout_id` = '". $id ."', ". $data);
		}
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
	$result = $DB->query("SELECT `parent_id`, `image` FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contains any rows and resultset it */
	if ($obj = $DB->fetchObject($result))  {
		/* Delete layouts images */
		@unlink(SYS_PIC_PATH .'layouts/'. $obj->image);
	}
	/* Set message */
	else {
		$TEMPLATE->setMessage("error", __('no_layout'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Delete page from database */
	$DB->query("DELETE FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $id ."' LIMIT 1");
	$DB->query("DELETE FROM `". DB_PREFIX ."layouts` WHERE `parent_id` = '". $id ."'");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('layout_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=layouts'. ($obj->parent_id != '0' ? '&id='. $obj->parent_id : '') .'&page='. $page);

	return true;
}


/**
 * Show layouts function
 * 
 * @param number $page - current page number
 * @return display list of all layouts
 */
function showLayouts($id, $page)
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
	if ($id) {
		/* Result parent data */
		$result = $DB->query("SELECT `layout_id`, `name` FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = '". $id ."' AND `language` = '". SYS_LANG ."' LIMIT 1");

		/* Check if resultset contain any row and resultset it */
		if ($obj = $DB->fetchObject($result)) {
			/* Set parent info in navlink */
			$navlinks = array(
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts\">". __('manage_layouts') ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&p=edit&id=". $obj->layout_id ."\">". $obj->name ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts&id=". $obj->layout_id ."\">". __('manage_sublayouts') ."</a>")
			);
			$TEMPLATE->assign('navlinks', $navlinks);
		}	
	}
	else {
		$navlinks = array(
			array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=layouts\">". __('manage_layouts') ."</a>")
		);
	}
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Set default vars */
	$fields = array('id' => $id, 'items' => array());

	/* Set results per page */
	if (isset($_GET['results']) && is_numeric($_GET['results']) && $_GET['results'])
	{
		$fields['results'] = intval($_GET['results']);
		$_SESSION['results_layouts'] = $fields['results'];
	}
	elseif (isset($_SESSION['results_layouts']) && is_numeric($_SESSION['results_layouts'])&& $_SESSION['results_layouts']) {
		$fields['results'] = intval($_SESSION['results_layouts']);
	}
	else {
		$fields['results'] = 50;
	}

	/* Result total layouts */
	$result = $DB->query("SELECT COUNT(`layout_id`) FROM `". DB_PREFIX ."layouts`");

	/* Set totalpages */
	$totalitems = $DB->result($result);

	/* Free result */
	$DB->freeResult($result);

	/* Get pagination */
	list($fields['pages'], $LIMIT) = pagination($totalitems, $fields['results'], "<a href=\"". VIR_CP_PATH ."index.php?m=layouts&page=%page%\">%name%</a> ", $page, "<strong>%page%</strong>", "<span>...</span>", true);

	/* Result layouts data */
	$result = $DB->query("SELECT `l`.`layout_id`, `l`.`parent_id`, `l`.`type`, `l`.`group_id`, `pl`.`group_id` AS `sgroup_id`, `l`.`status`, `d`.`name`, (SELECT GROUP_CONCAT(`language`) FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = `l`.`layout_id` AND `status` = '1') AS `languages`
						FROM `". DB_PREFIX ."layouts` AS `l`
						LEFT JOIN `". DB_PREFIX ."layouts_data` AS `d` ON `d`.`layout_id` = `l`.`layout_id` AND `d`.`language` = '". SYS_LANG ."'
						LEFT JOIN `". DB_PREFIX ."layouts` AS `pl` ON `pl`.`layout_id` = `l`.`parent_id`
						WHERE `l`.`parent_id` = '". $id ."'
						ORDER BY `l`.`type` ASC, `d`.`name` ASC ". $LIMIT);


	/* Check if resultset contain any rows */
	if ($DB->numRows($result) > 0) {
		/* Set layouts data */
		while ($obj = $DB->fetchObject($result)) {
			/* Set items */
			$fields['items'][$obj->layout_id] = array(
				'name' => $obj->name,
				'type' => __($obj->type),
				'group' => getLayoutGroup($obj->group_id ? $obj->group_id : $obj->sgroup_id),
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

/**
 * Get group
 *
 * @param $id
 * @return mixed
 */
function getLayoutGroup($id) {
	global $DB;

	/* Set default vars */
	static $items = array();

	/* Check if items isn't empty */
	if (false !== empty($items[$id])) {
		/* Set result */
		$result = $DB->query("SELECT `g`.`group_id`, `g`.`menu_id`, `m`.`parent_id`, `g`.`name`, `pg`.`name` AS `parent` FROM `". DB_PREFIX ."layouts_groups` AS `g` INNER JOIN `". DB_PREFIX ."layouts_groups` AS `pg` ON `pg`.`group_id` = `g`.`parent_id` INNER JOIN `". DB_PREFIX ."layouts_menus` AS `m` ON `m`.`menu_id` = `g`.`menu_id` WHERE `g`.`group_id` = '". $id ."' AND `g`.`parent_id` != '0'");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			$menu = getLayoutsMenus($obj->parent_id);
			$items[$obj->group_id] = $menu['name'] .' > '. $menu['items'][$obj->menu_id] .' > '. $obj->parent .' > '. $obj->name;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return array_key_exists($id, $items) ? $items[$id] : false;
}