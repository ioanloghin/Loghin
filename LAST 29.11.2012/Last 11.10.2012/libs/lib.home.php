<?php

/* Show home page */
showHome();

/**
 * Show home page function
 * 
 */
function showHome()
{
	global $DB, $TEMPLATE, $PREFS;

	/* Set template file */
	$TEMPLATE->setTemplate('home.tpl');

	/* Create Json Class */
	require_once 'core/core.json.php';
	$Json = new Json;

	/* Load plugins */
	loadPlugin('getSites');

	/* Get all sites */
	$fields = getSites();
	//echo "<pre>";print_r($fields);echo "</pre>";

	/* Set json for all sities */
	$fields['JsSites'] = $Json->Encode($fields['sites']);

	/* Get layouts */
	$fields['layouts'] = getLayouts();

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}