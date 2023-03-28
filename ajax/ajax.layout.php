<?php
/**
 * Created by Quber.
 * Date: 10/29/12
 * Time: 10:48 AM
 */
function layout() {
	global $TEMPLATE;

	/* Create Json class */
	$Json = new Json;

	/* Set default var */
	$favorites = getFavorites(cookie('layout'), cookie('memberLayout'));
	$fields = array(
		'groups' => getLayoutsGroups(cookie('systemMenu')),
		'layouts' => getLayouts(cookie('layout')),
		'favorites' => &$favorites,
		'defaults' => array('menu' => cookie('systemMenu'), 'layout' => cookie('layout')),
		'globe' => getLayoutTextes(cookie('layout'), $favorites)
	);



	/* Assign template vars */
	$TEMPLATE->assign('response', $Json->Encode($fields));
}