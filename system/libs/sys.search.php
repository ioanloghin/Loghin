<?php

/* Get curent page template */
switch ($p) {
	case 'images':
		$tpl = 'images.tpl';
	break;

	case 'videos':
		$tpl = 'videos.tpl';
	break;

	case 'text':
		$tpl = 'text.tpl';
	break;

	default:
		$tpl = 'loghin.tpl';
		$TEMPLATE->assign('activeAction', 'loghin');
	break;
}

$TEMPLATE->assign(array('center' => array("Search Result", 'search/'. $tpl, 'padding')));
