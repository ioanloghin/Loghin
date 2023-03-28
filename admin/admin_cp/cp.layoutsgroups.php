<?php

/* Get vars */
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;

/* Choose action */
switch (isset($_GET['p']) ? $_GET['p'] : '') {
	case 'edit':
		/* Edit layouts group */
		editLayoutsGroup($id);
	break;

	default:
		/* Manage Layouts Groups */
		manageLayoutsGroups($id);
	break;
}


function editLayoutsGroup($id) {
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('layoutsGroupEdit.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('manage_layouts_groups'));

	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_layouts_groups']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Result layout group */
	$result = $DB->query("SELECT * FROM `". DB_PREFIX ."layouts_groups` WHERE `group_id` = '". $id ."' AND `parent_id` != '0' LIMIT 1");

	/* Check if resultset doesn't contain any rows, if contains, resultset it */
	if (!$obj = $DB->fetchObject($result)) {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_layouts_group'));
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Parse post data */
	$extensions = getExtensions();
	$fields = array(
		'extensions' => $extensions,
		'name' => isset($_POST['name']) ? htmlentities2utf8($_POST['name']) : $obj->name,
		'info' => isset($_POST['info']) ? htmlentities2utf8($_POST['info']) : $obj->info,
		'url' => isset($_POST['url']) ? $_POST['url'] : $obj->url,
		'text_top' => isset($_POST['text_top']) ? substr(htmlentities2utf8($_POST['text_top']), 0, 33) : $obj->text_top,
		'text_bottom' => isset($_POST['text_bottom']) ? substr(htmlentities2utf8($_POST['text_bottom']), 0, 20) : $obj->text_bottom,
		'extension_id' => isset($_POST['extension']) ? (array_key_exists($_POST['extension'], $extensions) ? $_POST['extension'] : key($extensions)) : $obj->extension_id
	);

	/* Check if form was submited */
	if (isset($_POST['isLayoutGroup']) && $_POST['isLayoutGroup']) {
		saveLayout($id, $fields);
	}

	/* Assign template vars */
	$TEMPLATE->assign($fields);
}


function saveLayout($id, $fields) {
	global $DB, $TEMPLATE;

	/* Set default vars */
	$errors = array();
	$items = array();

	/* Validate name */
	if (!preg_match('/[a-zA-Z]/', $fields['name'])) {
		$errors['name'] = __('name_invalid');
	}

	/* Validate url */
	if ($fields['url'] && !filter_var($fields['url'], FILTER_VALIDATE_URL)) {
		$errors['url'] = __('url_invalid');
	}

	/* Check if exists any error and set it */
	if (empty($errors) !== true) {
		/* Set messages */
		$TEMPLATE->setMessage('error', $errors);
		return;
	}

	/* Parse each data */
	foreach ($fields AS $key => $value) if (in_array($key, array('name', 'info', 'url', 'text_top', 'text_bottom', 'extension_id'))) {
		$items[$key] = "`". $key ."` = '". $DB->escapeData($value) ."'";
	}

	/* Update layout information */
	$DB->query("UPDATE `". DB_PREFIX ."layouts_groups` SET ". implode(', ', $items) ." WHERE `group_id` = '". $id ."' LIMIT 1");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('layout_updated'));
	redirect(VIR_CP_PATH .'index.php?m=layoutsgroups&p=edit&id='. $id);

	return true;
}



/**
 * Manage layoutsGroups function
 *
 */
function manageLayoutsGroups($id) {
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('layoutsGroups.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('manage_layouts_groups'));

	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_layouts_groups']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Set default vars */
	$layoutsMenus = getLayoutsMenus();
	$id = $id ? $id : key($layoutsMenus[key($layoutsMenus)]['items']);
	$fields = array('id' => $id, 'layoutsMenus' => $layoutsMenus, 'fields' => array());

	/* Check if submited form */
	if (isset($_POST['isLayoutsGroups']) && $_POST['isLayoutsGroups']) {
		saveLayoutsGroup((isset($_POST['items']) && is_array($_POST['items']) ? $_POST['items'] : array()), (isset($_POST['url']) && is_array($_POST['url']) ? $_POST['url'] : array()) , $id);

		/* Set message and redirect */
		$TEMPLATE->setMessage('info', __('updated'));
		redirect(VIR_CP_PATH .'index.php?m=layoutsgroups&id='. $id);
	}

	/* Result groups from database */
	$result = $DB->query("SELECT `group_id`, `parent_id`, `name`, `info`, `url` FROM `". DB_PREFIX ."layouts_groups` WHERE `menu_id` = '". $id ."' ORDER BY `parent_id` ASC, `orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result)) {
		/* Set data */
		if ($obj->parent_id == 0) {
			$fields['fields'][$obj->group_id] = array(
				'name' => $obj->name,
				'info' => $obj->info,
				'url' => $obj->url,
				'items' => array()
			);
		}
		else {
			$fields['fields'][$obj->parent_id]['items'][$obj->group_id] = array('name' => $obj->name, 'info' => $obj->info, 'url' => $obj->url);
		}
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save layoutsGroups function
 *
 */
function saveLayoutsGroup($items, $url, $id, $p_id = 0) {
	global $DB;

	/* Set default vars */
	$_exists = array();
	$orderid = 1;

	/* Parse each item and check if value is array */
	foreach ($items AS $key => $_items) if (is_array($_items) && count($_items) > 0) {
		/* Parse each item */
		foreach ($_items AS $_id => $item) {
			/* Check if item isn't empty */
			if (!preg_match('/[a-zA-Z]/', $item)) {
				continue;
			}

			/* Validate url */
			$_url = $DB->escapeData(filter_var(isset($url[$key][$_id]) ? $url[$key][$_id] : '', FILTER_VALIDATE_URL) ? $url[$key][$_id] : '');
			$_info = isset($_POST['_info'][$p_id][$key][$_id]) ? $DB->escapeData($_POST['_info'][$p_id][$key][$_id]) : false;

			/* Set default updated */
			$_updated = false;

			/* Check if exist this layoutGroup in database */
			if ($_id > 0) {
				/* Check if layoutGroup exist in database */
				$result = $DB->query("SELECT `group_id` FROM `". DB_PREFIX ."layouts_groups` WHERE `group_id` = '". $_id ."' AND `parent_id` = '". $p_id ."' AND `menu_id` = '". $id ."' LIMIT 1");

				/* Check if resultset contain any row */
				if ($DB->numRows($result)) {
					/* Update layoutGroup */
					$DB->query("UPDATE `". DB_PREFIX ."layouts_groups` SET `name` = '". $DB->escapeData($item) ."'". ($_info ? " , `info` = '". $_info ."'" : '') .", `url` = '". $_url ."', `orderid` = '". $orderid++ ."' WHERE `group_id` = '". $_id ."' AND `menu_id` = '". $id ."'");

					/* Set updated true */
					$_updated = true;

					/* Set subgroups */
					if ($p_id == 0) {
						saveLayoutsGroup((isset($_POST['_items'][$_id]) && is_array($_POST['_items'][$_id]) ? $_POST['_items'][$_id] : array()), (isset($_POST['_url'][$_id]) && is_array($_POST['_url'][$_id]) ? $_POST['_url'][$_id] : array()) , $id, $_id);
					}
				}

				/* Free result */
				$DB->freeResult($result);
			}

			/* Check if is not updated this layoutGroup */
			if (false === $_updated) {
				/* Insert group in database */
				$DB->query("INSERT INTO `". DB_PREFIX ."layouts_groups` SET `parent_id` = '". $p_id ."', `menu_id` = '". $id ."', `name` = '". $DB->escapeData($item) ."'". ($_info ? ", `info` = '". $_info ."'" : '') .", `url` = '". $_url ."', `orderid` = '". $orderid++ ."'");

				/* Get inserted id */
				$_id = $DB->getInsertId();
			}

			/* Set new exist id */
			$_exists[] = $_id;
		}
	}

	/* Delete layoutsGroups from database */
	$DB->query("DELETE FROM `". DB_PREFIX ."layouts_groups` WHERE `group_id` NOT IN ('0', '". implode("', '", $_exists) ."') AND `parent_id` = '". $p_id ."' AND `menu_id` = '". $id ."'");

	return true;
}