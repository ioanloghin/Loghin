<?php
/**
 * Created by Quber.
 * Date: 12/5/12
 * Time: 11:30 AM
 */

/* Manage Extensions */
manageExtensions();


/**
 * Manage Extensions function
 *
 */
function manageExtensions() {
	global $DB, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate('extensions.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('manage_extensions'));

	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_extensions']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Check if submited form */
	if (isset($_POST['isExtensions']) && $_POST['isExtensions']) {
		/* Save Extensions */
		saveExtensions(isset($_POST['items']) && is_array($_POST['items']) ? $_POST['items'] : array());
	}

	/* Set default vars */
	$fields = array('items' => array());

	/* Result extensions from database */
	$result = $DB->query("SELECT `extension_id`, `extension` FROM `". DB_PREFIX ."extensions` ORDER BY `orderid` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result)) {
		$fields['items'][$obj->extension_id] = $obj->extension;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save Extensions function
 *
 */
function saveExtensions($items) {
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

			/* Check if exist this Extension in database */
			if ($_id > 0) {
				/* Check if Extension exist in database */
				$result = $DB->query("SELECT `extension_id` FROM `". DB_PREFIX ."extensions` WHERE `extension_id` = '". $_id ."' LIMIT 1");

				/* Check if resultset contain any row */
				if ($DB->numRows($result)) {
					/* Update Extension */
					$DB->query("UPDATE `". DB_PREFIX ."extensions` SET `extension` = '". $DB->escapeData($item) ."', `orderid` = '". $orderid++ ."' WHERE `extension_id` = '". $_id ."'");

					/* Set updated true */
					$_updated = true;
				}

				/* Free result */
				$DB->freeResult($result);
			}

			/* Check if is not updated this Extension */
			if (false === $_updated) {
				/* Insert menu in database */
				$DB->query("INSERT INTO `". DB_PREFIX ."extensions` SET `extension` = '". $DB->escapeData($item) ."', `orderid` = '". $orderid++ ."'");

				/* Get inserted id */
				$_id = $DB->getInsertId();
			}

			/* Set new exist id */
			$_exists[] = $_id;
		}
	}

	/* Delete Extensions from database */
	$DB->query("DELETE FROM `". DB_PREFIX ."extensions` WHERE `extension_id` NOT IN ('0', '". implode("', '", $_exists) ."')");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('updated'));
	redirect(VIR_CP_PATH .'index.php?m=extensions');

	return true;
}
 