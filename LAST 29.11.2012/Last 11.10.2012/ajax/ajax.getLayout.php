<?php
/**
 * Created by Quber.
 * Date: 9/24/12
 * Time: 1:46 PM
 */
function getLayout() {
	global $DB, $TEMPLATE;

	/* Load Plugin */
	loadPlugin('getSites');

	/* Require Json class */
	$Json = new Json;

	/* Get layout id */
	$id = isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : 0;
	isset($_POST['id']) && $id == 0 ? @parse_str($_POST['id'], $ids) : false;

	/* Check if delete layout */
	if (isset($ids['layout']) && is_array($ids['layout'])) {
		/* Parse each layout */
		foreach ($ids['layout'] AS $_id) {
			/* Delete layout from database */
			$DB->query("DELETE FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $_id ."' LIMIT 1");
		}

		/* Return deleted id's */
		$TEMPLATE->assign('response', $Json->Encode($ids['layout']));
		return true;
	}

	/* Get Layout data */
	$layout = getLayouts($id);

	/* Check if layout id is valid */
	if ($layout['id'] == $id) {
		/* Encode */
		$TEMPLATE->assign('response', $Json->Encode($layout));

		/* Check if need to set this layout */
		if (isset($_POST['set']) && $_POST['set']) {
			Set_Cookie('layout', $id, strtotime('+1 year'));

			/* Get sites */
			$TEMPLATE->assign('response', $Json->Encode(getSites($id)));
		}
	}

	return true;
}