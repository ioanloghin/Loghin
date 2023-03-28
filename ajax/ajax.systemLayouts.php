<?php

/**
 * Get system layouts
 *
 * @return bool
 */
function systemLayouts() {
	global $TEMPLATE;

	/* Require Json class */
	$Json = new Json;

	/* Post ID */
	$id = isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : cookie('systemMenu');

	/* Get system menu layouts groups */
	$fields =  array('defaults' => array('menu' => $id, 'layout' => cookie('layout')), 'groups' => getLayoutsGroups($id));

	/* Get Sites */
	$TEMPLATE->assign('response', $Json->Encode($fields));

	/* Set cookie */
	if ($id != cookie('systemMenu')) {
		cookie('systemMenu', $id, strtotime('+1 year'));
	}

	return true;
}