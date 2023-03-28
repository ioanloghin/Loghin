<?php
/**
 * Created by Quber.
 * Date: 10/20/12
 * Time: 9:55 AM
 */

/* Manage Layouts Menus */
manageLayoutsMenus();


/**
 * Manage layoutsMenus function
 *
 */
function manageLayoutsMenus() {
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('layoutsMenus.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('manage_layouts_menus'));

	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_layouts_menus']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Check if submited form */
	if (isset($_POST['isLayoutsMenus']) && $_POST['isLayoutsMenus']) {
		/* Save Layouts Menus */
		saveLayoutsMenu(isset($_POST['items']['left']) && is_array($_POST['items']['left']) ? $_POST['items']['left'] : array(), 'left');
		saveLayoutsMenu(isset($_POST['items']['right']) && is_array($_POST['items']['right']) ? $_POST['items']['right'] : array(), 'right');

		/* Set message and redirect */
		$TEMPLATE->setMessage('info', __('updated'));
		redirect(VIR_CP_PATH .'index.php?m=layoutsmenus');
	}

	/* Set default vars */
	$fields = array('fields' => array('left' => array(), 'right' => array()), 'items' => array());

	/* Result menus from database */
	$result = $DB->query("SELECT `menu_id`, `type`, `name` FROM `". DB_PREFIX ."layouts_menus` WHERE `parent_id` = '0' ORDER BY `orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result)) {
		$fields['fields'][$obj->type][$obj->menu_id] = $obj->name;
		$fields['items'][$obj->menu_id] = array();
	}

	/* Free result */
	$DB->freeResult($result);

	/* Result submenus */
	$result = $DB->query("SELECT `menu_id`, `parent_id`, `name` FROM `". DB_PREFIX ."layouts_menus` WHERE `parent_id` IN('". implode("', '", array_merge(array_keys($fields['fields']['left']), array_keys($fields['fields']['right']))) ."') ORDER BY `orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result)) {
		$fields['items'][$obj->parent_id][$obj->menu_id] = $obj->name;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save layoutsMenus function
 *
 */
function saveLayoutsMenu($items, $type = '', $id = 0) {
	global $DB, $TEMPLATE;

	/* Set default vars */
	$_exists = array();
	$orderid = 1;

	/* Parse each menu item and check if is array items */
	foreach ($items AS $_items) if (is_array($_items) && count($_items) > 0) {
		/* Parse each item */
		foreach ($_items AS $_id => $item) {
			/* Check if item isn't empty */
			if (!preg_match('/[a-zA-Z]/', $item)) {
				continue;
			}

			/* Set default updated */
			$_updated = false;

			/* Check if exist this layoutMenu in database */
			if ($_id > 0) {
				/* Check if layoutMenu exist in database */
				$result = $DB->query("SELECT `menu_id` FROM `". DB_PREFIX ."layouts_menus` WHERE `menu_id` = '". $_id ."' AND `parent_id` = '". $id ."' LIMIT 1");

				/* Check if resultset contain any row */
				if ($DB->numRows($result)) {
					/* Update layoutMenu */
					$DB->query("UPDATE `". DB_PREFIX ."layouts_menus` SET `name` = '". $DB->escapeData($item) ."', `orderid` = '". $orderid++ ."' WHERE `menu_id` = '". $_id ."'");

					/* Set updated true */
					$_updated = true;

					/* Check if exists submenus and save them */
					if (isset($_POST['items'][$_id]) && is_array($_POST['items'][$_id])) {
						saveLayoutsMenu($_POST['items'][$_id], '', $_id);
					}
				}

				/* Free result */
				$DB->freeResult($result);
			}

			/* Check if is not updated this layoutMenu */
			if (false === $_updated) {
				/* Insert menu in database */
				$DB->query("INSERT INTO `". DB_PREFIX ."layouts_menus` SET `parent_id` = '". $id ."', `name` = '". $DB->escapeData($item) ."', `type` = '". $type ."', `orderid` = '". $orderid++ ."'");

				/* Get inserted id */
				$_id = $DB->getInsertId();
			}

			/* Set new exist id */
			$_exists[] = $_id;
		}
	}

	/* Delete layoutsMenus from database */
	$DB->query("DELETE FROM `". DB_PREFIX ."layouts_menus` WHERE `menu_id` NOT IN ('0', '". implode("', '", $_exists) ."') AND `parent_id` = '". $id ."' AND `type` = '". $type ."'");

	return true;
}