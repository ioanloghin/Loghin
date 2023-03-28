<?php


/**
 * Create customize function
 * 
 */
function customize()
{
	global $TEMPLATE;

	/* Load plugins */
	loadPlugin('getSites');

	/* Set default vars */
	$Json = new Json;

	/* Set layout data */
	if (isset($_POST['opt'])) {
		/* Parse post data */
		@parse_str($_POST['opt'], $items);

		/* Set default vars */
		$items = array_merge(array('name' => "", 'items' => array(), 'id' => 0), $items);

		/* Save layout */
		saveLayout($items);

		/* Get new data */
		$data = getSites($items['id']);
	}

	/* Count sites */
	if (isset($data['items']) && count($data['items']) == 12) {
		$data = getSites();
	}

	/* Unset favorites list */
	unset($data['favorites']);

	/* Assign template vars */
	$TEMPLATE->assign('response', $Json->Encode($data, true));

	return true;
}


