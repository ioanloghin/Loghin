<?php


/**
 * Create customize function
 * 
 */
function customize() {
	global $TEMPLATE, $DB;

	/* Set default vars */
	$Json = new Json;

	/* Get layout id */
	$id = isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : 0;
	isset($_POST['id']) && $id == 0 ? @parse_str($_POST['id'], $ids) : false;

	/* Set layout data */
	if (isset($_POST['opt'])) {
		/* Parse post data */
		@parse_str($_POST['opt'], $items);

		/* Set default vars */
		$items = array_merge(array('name' => '', 'items' => array(), 'id' => 0), $items);

		/* Save layout */
		saveLayout($items);
	}
	/* Delete layouts */
	elseif (isset($ids['layout']) && is_array($ids['layout'])) {
		/* Parse each layout */
		foreach ($ids['layout'] AS $_id) {
			/* Delete layout from database */
			$DB->query("DELETE FROM `". DB_PREFIX ."layouts_favorites` WHERE `favorite_id` = '". $_id ."' LIMIT 1");
		}
	}
	/* Sey layout */
	elseif ($id) {
		/* Set favorites */
		cookie('memberLayout', $id, strtotime('+1 year'));
	}

	/* Set default vars */
	$fields = array(
		//'layouts' => getLayouts(cookie('layout')),
		'favorites' => getFavorites(cookie('layout'), cookie('memberLayout'))
	);

	/* Assign template vars */
	$TEMPLATE->assign('response', $Json->Encode($fields, true));

	return true;
}


/**
 * Save favorite sites
 *
 */
function saveLayout($items) {
	global $DB, $SESSION;

	/* Check if is new layout */
	if (!isset($items['id']) && !empty($items['site']) && !empty($items['application'])) {
		$items = array('id' => 0, 'name' => '', 'items' => array_merge(array_keys($items['site']), array_keys($items['application'])));
	}

	/* Set default vars */
	$sites = implode(',', $items['items']);
	$name = $DB->escapeData(substr($items['name'], 0, 30));
	$group = cookie('layout');

	/* Validate id */
	if ($items['id']) {
		/* Result all layout data */
		$result = $DB->query("SELECT `favorite_id` FROM `". DB_PREFIX ."layouts_favorites` WHERE `favorite_id` = '". $items['id'] ."' LIMIT 1");

		/* Check if resultset contain any row */
		if ($DB->numRows($result) <= 0) {
			$items['id'] = 0;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Insert new layout in database */
	if ($items['id'] == 0) {
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts_favorites` SET `member_id` = '". $SESSION->conf['member_id'] ."', `group_id` = '". $group ."', `name` = '". $name ."', `layouts` = '". $DB->escapeData($sites) ."', `postdate` = '". time() ."'");

		/* Get layout id */
		$items['id'] = $DB->getInsertId();
	}
	/* Update layout in dabatase */
	else {
		$DB->query("UPDATE `". DB_PREFIX ."layouts_favorites` SET `name` = '". $name ."', `layouts` = '". $DB->escapeData($sites) ."' WHERE `favorite_id` = '". $items['id'] ."' LIMIT 1");
	}

	/* Set as current layout */
	cookie('memberLayout', $items['id'], strtotime('+1 year'));
}
