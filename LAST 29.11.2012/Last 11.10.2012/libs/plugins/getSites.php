<?php


function getSites($id = 0)
{
	global $DB;

	/* Get all sites */
	$fields = array('sites' => array('site' => array(), 'application' => array()), 'id' => 0, 'name' => '', 'items' => array(), 'order' => 1);
	$fields['favorites'] = $fields['fav'] = $fields['sites'];
	$id = $id > 0 ? $id : (isset($_COOKIE['layout']) && is_numeric($_COOKIE['layout']) && $_COOKIE['layout'] > 0 ? $_COOKIE['layout'] : 1);

	/* Get favorites */
	$fields = array_merge($fields, getLayouts($id));

	/* Result all sites */
	$result = $DB->query("SELECT `s`.`site_id`, `s`.`type`, `s`.`url`, `s`.`image`, `d`.`name`, `d`.`details` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`parent_id` = '0' AND `s`.`status` = '1' ORDER BY `s`.`type` ASC, `d`.`name` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result)) {
		/* Set sites data */
		$fields['sites'][$obj->type][$obj->site_id] = array(
			'name' => $obj->name,
			'image' => $obj->image ? $obj->image : 'default.png',
			'details' => $obj->details,
			'url' => $obj->url
		);

		/* Set favorites */
		if ((false == empty($fields['items']) && in_array($obj->site_id, $fields['items'])) || (empty($fields['items']) && count($fields['favorites'][$obj->type]) < 5)) {
			$fields['favorites'][$obj->type][$obj->site_id] = $obj->name;
		}
	}

	/* Free result */
	$DB->freeResult($result);

	/* Sort favorites */
	asort($fields['favorites']['site']);
	asort($fields['favorites']['application']);

	/* Set Json favorites */
	foreach ($fields['favorites'] AS $_t => $_id) {
		foreach ($_id AS $_key => $value) {
			$fields['fav'][$_t][] = array('id' => $_key);
		}
	}

	return $fields;
}


/**
 * Save favorite sites
 * 
 */
function saveLayout($items) {
	global $DB, $SESSION;

	/* Check if is new layout */
	if (!isset($items['id']) && !empty($items['site']) && !empty($items['application'])) {
		$items = array('id' => 0, 'name' => "", 'items' => array_merge(array_keys($items['site']), array_keys($items['application'])));
	}

	/* Set default vars */
	$sites = implode(',', $items['items']);
	$name = $DB->escapeData(substr($items['name'], 0, 30));

	/* Insert new layout in database */
	if ($items['id'] == 0) {
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts` SET `member_id` = '". $SESSION->conf['member_id'] ."', `name` = '". $name ."', `sites` = '". $DB->escapeData($sites) ."', `postdate` = '". time() ."'");

		/* Get layout id */
		$items['id'] = $DB->getInsertId();
	}
	/* Update layout in dabatase */
	else {
		$DB->query("UPDATE `". DB_PREFIX ."layouts` SET `name` = '". $name ."', `sites` = '". $DB->escapeData($sites) ."' WHERE `layout_id` = '". $items['id'] ."' LIMIT 1");
	}

	/* Set as current layout */
	Set_Cookie('layout', $items['id'], strtotime('+1 year'));
	$_COOKIE['layout'] = $items['id'];
}

/**
 * Get layouts
 *
 * @param int $id
 * @return mixed
 */
function getLayouts($id = 0) {
	global $DB;

	/* Set default vars */
	static $layouts = array();
	$ii = 0;

	/* Check if layouts is empty */
	if (empty($layouts)) {
		/* Result layout data */
		$result = $DB->query("SELECT `layout_id`, `name`, `sites` FROM `". DB_PREFIX ."layouts` WHERE `status` = '1'");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			$layouts[$obj->layout_id] = array(
				'id' => $obj->layout_id,
				'name' => $obj->name,
				'items' => explode(',', $obj->sites),
				'order' => ++$ii
			);
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return $id ? (isset($layouts[$id]) ? $layouts[$id] : (empty($layouts) ? array() : current($layouts))) : $layouts;
}