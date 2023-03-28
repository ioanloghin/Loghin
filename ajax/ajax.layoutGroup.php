<?php
/**
 * Created by Quber.
 * Date: 10/24/12
 * Time: 12:22 PM
 */
function layoutGroup() {
	global $TEMPLATE, $DB, $PREFS;

	/* Post ID */
	$id = isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : cookie('layout');

	/* Create Json class */
	$Json = new Json;

	/* Set default var */
	$favorites = getFavorites($id);
	$fields = array(
		'layouts' => getLayouts($id),
		'favorites' => &$favorites,
		'defaults' => array('menu' => cookie('systemMenu'), 'layout' => $id),
		'globe' => getLayoutTextes($id, $favorites)
	);


	/* Assign template vars */
	$TEMPLATE->assign('response', $Json->Encode($fields));

	/* Set cookie layout */
	if ($id !== cookie('layout')) {
		cookie('layout', $id, strtotime('+1 year'));
	}

	return true;
}