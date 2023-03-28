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

	/* Check if is changed member type */
	$result = $DB->query("SELECT `member_type` FROM `". DB_PREFIX ."layouts` WHERE `layout_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contain any row */
	if (($type = $DB->result($result)) != cookie('_type')) {
		cookie('_type', $type, strtotime('+1 year'));

		/* Set fields */
		$fields = getSites($id);

		/* Set sites order */
		if (isset($fields['sites']) && is_array($fields['sites'])) {
			/* Set default vars */
			$fields['_sites'] = array();

			/* Parse each site */
			foreach ($fields['sites'] AS $key => $value) {
				foreach ($value AS $id => $data) {
					$fields['_sites'][$key][] = $id;
				}
			}
		}

		/* Get layouts */
		$fields['layouts'] = getLayouts(0, false, 0);

		/* Set response */
		$TEMPLATE->assign('response', $Json->Encode($fields));

		/* Free result */
		$DB->freeResult($result);
	}
	else {
		/* Get Layout data */
		$fields = getLayouts($id);

		/* Check if layout id is valid */
		if ($fields['id'] == $id) {
			/* Encode */
			$TEMPLATE->assign('response', $Json->Encode($fields));

			/* Check if need to set this layout */
			if (isset($_POST['set']) && $_POST['set'] == 1) {
				//cookie('layout', $id, strtotime('+1 year'));

				/* Get sites */
				$TEMPLATE->assign('response', $Json->Encode(getSites($id)));
			}
		}
	}

	return true;
}