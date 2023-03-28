<?php

/**
 * Set current member type
 *
 * @return bool
 */
function memberType() {
	global $TEMPLATE;

	/* Load Plugin */
	loadPlugin('getSites');

	/* Require Json class */
	$Json = new Json;

	/* Post ID */
	$id = isset($_POST['id']) && array_key_exists($_POST['id'], getMemberTypes()) ? $_POST['id'] : (isset($_COOKIE['_type']) && array_key_exists($_COOKIE['_type'], getMemberTypes()) ? $_COOKIE['_type'] : current(array_keys(getMemberTypes())));

	/* Set cookie */
	//cookie('_type', $id, strtotime('+1 year'));

	/* Data for all sites */
	$fields = getLayouts(0, $id, true);

	/* Parse check if exist sites /
	if (isset($fields['sites']) && is_array($fields['sites'])) {
		/* Set default vars /
		$fields['_sites'] = array();

		/* Parse each site /
		foreach ($fields['sites'] AS $key => $value) {
			foreach ($value AS $id => $data) {
				$fields['_sites'][$key][] = $id;
			}
		}
	}*/

	/* Get Sites */
	$TEMPLATE->assign('response', $Json->Encode($fields));

	return true;
}