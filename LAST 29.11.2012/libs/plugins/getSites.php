<?php


function getSites($layout = 0)
{
	global $DB;

	/* Get all sites */
	$fields = array('sites' => array('site' => array(), 'application' => array()), 'id' => 0, 'name' => '', 'items' => array(), 'order' => 1);
	$fields['favorites'] = $fields['fav'] = $fields['sites'];
	$layout = $layout > 0 ? $layout : cookie('layout');
	$memberType = array_key_exists(cookie('_type'), getMemberTypes()) ? cookie('_type') : current(array_keys(getMemberTypes()));

	/* Get favorites */
	$fields = array_merge($fields, getLayouts($layout, $memberType));

	/* Result all sites */
	$result = $DB->query("SELECT `s`.`site_id`, `s`.`type`, `s`.`url`, `s`.`image`, `d`.`name`, `d`.`details` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`parent_id` = '0' AND `member_type` = '". $memberType ."' AND `s`.`status` = '1' ORDER BY `s`.`type` ASC, `d`.`name` ASC");

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
	$memberType = array_key_exists(cookie('_type'), getMemberTypes()) ? cookie('_type') : current(array_keys(getMemberTypes()));

	/* Validate id */
	if ($items['id']) {
		/* Result all layout data */
		$result = $DB->query("SELECT `layout_id` FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $items['id'] ."' AND `default` != '1' LIMIT 1");

		/* Check if resultset contain any row */
		if ($DB->numRows($result) <= 0) {
			$items['id'] = 0;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Insert new layout in database */
	if ($items['id'] == 0) {
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts` SET `member_id` = '". $SESSION->conf['member_id'] ."', `member_type` = '". $memberType ."', `sites` = '". $DB->escapeData($sites) ."', `postdate` = '". time() ."'");

		/* Get layout id */
		$items['id'] = $DB->getInsertId();
	}
	/* Update layout in dabatase */
	else {
		$DB->query("UPDATE `". DB_PREFIX ."layouts` SET `sites` = '". $DB->escapeData($sites) ."' WHERE `layout_id` = '". $items['id'] ."' LIMIT 1");
	}

	/* Set layout data */
	if ($DB->numRows($DB->query("SELECT `layout_id` FROM `". DB_PREFIX ."layouts_data` WHERE `layout_id` = '". $items['id'] ."' AND `lang` = '". SYS_LANG ."'"))) {
		$DB->query("UPDATE `". DB_PREFIX ."layouts_data` SET `name` = '". $name ."' WHERE `layout_id` = '". $items['id'] ."' AND `lang` = '". SYS_LANG ."'");
	}
	else {
		$DB->query("INSERT INTO `". DB_PREFIX ."layouts_data` SET `layout_id` = '". $items['id'] ."', `lang` = '". SYS_LANG ."', `name` = '". $name ."'");
	}

	/* Set as current layout */
	cookie('layout', $items['id'], strtotime('+1 year'));
}

/**
 * Get layouts
 *
 * @param int $id
 * @return mixed
 */
function getLayouts($id = 0, $_id = false, $default = false) {
	global $DB;

	/* Set default vars */
	static $layouts = array();
	$default = $default === false ? 'false' : ($default ? 1 : 0);
	$_id = $_id ? $_id : (array_key_exists(cookie('_type'), getMemberTypes()) ? cookie('_type') : current(array_keys(getMemberTypes())));
	$ii = 0;

	/* Check if layouts is empty */
	if (empty($layouts[$_id][$default])) {
		/* Set default data */
		$layouts[$_id][$default] = array();

		/* Result layout data */
		$result = $DB->query("SELECT `l`.`layout_id`, `l`.`group_id`, `d`.`name`, `l`.`sites`, `l`.`default`, `g`.`name` AS `group` FROM `". DB_PREFIX ."layouts` AS `l` LEFT JOIN `". DB_PREFIX ."layouts_data` AS `d` ON `d`.`layout_id` = `l`.`layout_id` AND `d`.`lang` = '". SYS_LANG ."' LEFT JOIN `". DB_PREFIX ."layouts_groups` AS `g` ON `g`.`group_id` = `l`.`group_id` WHERE `l`.`member_type` = '". $_id ."' AND `l`.`status` = '1'". ($default !== 'false' ? " AND `l`.`default` = '". $default ."'" : '') ." ORDER BY `g`.`orderid` ASC");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			$layouts[$_id][$default][$obj->layout_id] = array(
				'id' => $obj->layout_id,
				'name' => $obj->name,
				'items' => explode(',', $obj->sites),
				'order' => ++$ii,

				/* Group */
				'group' => array('id' => $obj->group_id, 'name' => $obj->group)
			);
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return $id ? (isset($layouts[$_id][$default][$id]) ? $layouts[$_id][$default][$id] : (empty($layouts[$_id][$default]) ? array() : current($layouts[$_id][$default]))) : $layouts[$_id][$default];
}