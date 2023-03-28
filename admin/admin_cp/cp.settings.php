<?php

/* Includes */
include 'fns/fns.validate.php';
 
/* GET values */
$id = isset($_GET['id']) ? $_GET['id'] : '';

/* Show settings */
settingsEdit($id);

/**
 * Show settings function
 * 
 * @param number $id - unique setting group id
 */
function settingsEdit($id)
{
	global $DB, $PREFS, $TEMPLATE, $SESSION;

	/* Set template file */
	$TEMPLATE->setTemplate("settings.tpl");

	/* Assign page title */
	$TEMPLATE->assign('app_page', __('app_settings'));

	/* Check if user has access to this page */
	if (!$SESSION->conf['can_manage_settings']) {
		$TEMPLATE->setMessage('error', __('no_access'), 1);
		return;
	}

	/* Set default vars */
	$fields = array();
	$optlinks = array();
	$group_name = "";
	$groups = array();
	$i = 0;

	/* Get groups */
	$result = $DB->query("SELECT group_id, label FROM " . DB_PREFIX . "settings_groups ORDER BY orderid ASC");

	/* Check if resultset contains any rows */
	if ($DB->numRows($result))
	{
		/* Create a new box */
		array_push($optlinks, array('header' => __('categories')));

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
			/* Set values */
			$groups['optlink'] = "index.php?m=settings&id=" . $obj->label;
			$groups['optname'] = __($obj->label);
			array_push($optlinks, $groups);

			/* Set group name */
			if ($obj->label == $id || !$id)
			{
				/* Set values */
				$id = $id ? $id : $obj->label;
				$group_name = __($obj->label);
			}

			$i++;
		}

		/* Assign template opt links */
		$TEMPLATE->assign('optlinks', $optlinks);
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage("error", __('no_groups_exist'), 1);
		return;
	}
	
	/* Free result */
	$DB->freeResult($result);

	/* Check group id */
	if (!$group_name) {
		$TEMPLATE->setMessage("error", __('invalid_group_id'), 1);
		return;
	}

	/* Get languages */
	$fields['languages'] = Language::getInstance()->list;

	/* Result group data */
	$result = $DB->query("SELECT * FROM " . DB_PREFIX . "settings WHERE group_id = '". $id ."' ORDER BY orderid ASC");

	/* Check if resultset contains any rows */
	if ($DB->numRows($result))
	{
		/* Set default vars */
		$i = 0;
		$empty = true;

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
			if ($obj->type == "text_ln" || $obj->type == "textarea_ln")
			{
				foreach ($fields['languages'] AS $lang => $language)
				{
					/* Set default value */
					$value = unserialize($obj->value);

					/* Parse post data */
					$fields['fields'][$i]['value'][$lang] = isset($_POST[$obj->label][$lang]) ? $DB->stripSlashes($_POST[$obj->label][$lang]) : (isset($value[$lang]) ? $value[$lang] : '');
				}
				$empty = false;
			}
			else {
				$fields['fields'][$i]['value'] = isset($_POST[$obj->label]) ? $DB->stripSlashes($_POST[$obj->label]) : $obj->value;
			}
			$fields['fields'][$i]['name'] = __($obj->label);
			$fields['fields'][$i]['label'] = $obj->label;
			$fields['fields'][$i]['type'] = $obj->type;
			$i++;
		}
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage("error", __('no_groups_exist'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Check if user submitted the form */
	if (isset($_POST['issettings'])  &&  $_POST['issettings'])
	{
		/* Save settings */
		settingsSave($id, $fields['fields'], count($fields['fields']), $fields['languages']);
	}


	/* Create yes/no array */
	$fields['yesnobox'][1] = __('yes');
	$fields['yesnobox'][0] = __('no');

	/* Assign template vars */
	$TEMPLATE->assign("group_name", $group_name);
	$TEMPLATE->assign($fields);
	$TEMPLATE->assign("empty", $empty);

	return 1;
}


/**
 * Save settings function
 * 
 * @param number $id - unique settings group id
 * @param array $fields - settings data
 * @param number $totalsettings - count of settings
 */
function settingsSave($id, $fields, $totalsettings, $languages)
{
	global $DB, $LANG, $TEMPLATE;

	/* Validate values */
	for ($i = 0;  $i < $totalsettings; $i++)
	{
		if ($fields[$i]['type'] == 'number' && !is_numeric($fields[$i]['value'])) {
			$TEMPLATE->setMessage("error", str_replace('%1%', $fields[$i]['name'], __('non_numeric')));
			return;
		}
		elseif ($fields[$i]['type'] == 'email' && validate_email($fields[$i]['value'])) {
			$TEMPLATE->setMessage("error", str_replace('%1%', $fields[$i]['name'], __('non_email')));
			return;
		}
		elseif ($fields[$i]['type'] == 'boolean' && $fields[$i]['value'] != 1 && $fields[$i]['value'] != 0) {
			$TEMPLATE->setMessage("error", str_replace('%1%', $fields[$i]['name'], __('non_boolean')));
			return;
		}
		if ($fields[$i]['type'] == "text_ln" || $fields[$i]['type'] == "textarea_ln")
		{
			/* Set default var */
			$items = array();

			/* Parse for each language */
			foreach ($languages AS $lang => $language) {
				$items[$lang] = htmlentities2utf8($fields[$i]['value'][$lang]);
			}

			/* Serialize items */
			$fields[$i]['value'] = serialize($items);
		}
		else {
			$fields[$i]['value'] = htmlentities2utf8($fields[$i]['value']);
		}


		/* Escape the value */
		$fields[$i]['label'] = $DB->escapeData($fields[$i]['label']);
		$fields[$i]['value'] = $DB->escapeData($fields[$i]['value']);

		/* Build queries */
		$sql_query[] = "UPDATE " . DB_PREFIX . "settings SET value = '" . $fields[$i]['value'] . "' WHERE label = '" . $fields[$i]['label'] . "' LIMIT 1";
	}

	/* Count total queris */
	$totalupdates = count($sql_query);

	/* Update settings in the database */
	for ($i = 0;  $i < $totalupdates;  $i++) {
		$DB->query($sql_query[$i]);
	}

	/* Set message and redirect to settings */
	$TEMPLATE->setMessage("info", __('settings_saved'));
	redirect(VIR_CP_PATH .'index.php?m=settings&id='. $id);

	return true;
}