<?php

/**
 * Declare subsites function
 * 
 */
function subsites()
{
	global $DB, $TEMPLATE;

	/* Set default vars */
	$Json = new Json;

	/* Parse vars */
	$id = isset($_POST['searchIn']) && is_array($_POST['searchIn']) ? array_map('intval', $_POST['searchIn']) : (isset($_POST['id']) && is_numeric($_POST['id']) ? array($_POST['id']) : array(0)); 
	$html = isset($_POST['t']) && $_POST['t'] == 'html' ? true : false;
	$fields['sites'] = array();

	/* Check if is html and set current template file */
	if ($html) {
		$TEMPLATE->setTemplate('subSites.tpl');
	}

	/* Result parent site data */
	$result = $DB->query("SELECT `s`.`site_id`, `d`.`name` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`site_id` IN ('". implode("', '", $id) ."') LIMIT 1");

	/* Check if resultset contain any row */
	if ($DB->numRows($result)) {
		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
			/* Set parent site data */
			$fields['id'] = $obj->site_id;
			$fields['siteName'] = $obj->name;
		}
	}
	else {
		/* Check if response is in html */
		if ($html) {
			$TEMPLATE->setMessage('error', __('server_error'), 1);
			return false;
		}
		else {
			$Json->setError(__('server_error'));
		}
	}

	/* Free result */
	$DB->freeResult($result);

	/* Load plugins */
	loadPlugin('getSubSites');

	/* Get sites */
	if (!$Json->isError() && !$fields['sites'] = getSubSites($id))
	{
		/* Check if response is in html */
		if ($html) {
			$TEMPLATE->setMessage('error', __('no_subsites'), 1);
			return false;
		}
		else {
			$Json->setError(__('no_subsites'));
		}
	}

	/* Check if response is in html */
	if ($html) {
		$TEMPLATE->assign($fields);
	}
	else
	{
		/* Set sites orders */
		$fields['orders'] = array();

		/* Parse each item */
		foreach ($fields['sites'] AS $_id => $value) {
			$fields['orders'][] = $_id;
		}

		/* Assign template data */
		$TEMPLATE->assign('response', $Json->Encode($fields, true));
	}

	return true;
}