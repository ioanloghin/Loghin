<?php

/* Set default template */
$TEMPLATE->setTemplate('response.tpl');

/* Assign default member types */
$TEMPLATE->assign('memberTypes', getMemberTypes());

/* Get variables */
$m = isset($_GET['m']) && file_exists(SYS_PATH . 'libs/lib.'. $_GET['m'] .'.php') ? $_GET['m'] : (isAjax ? 'ajax' : 'home');

/* Check if exist language for current page */
if (file_exists(SYS_PATH .'includes/languages/'. SYS_LANG .'/lang.lib.'. $m .'.php')) {
	/* include language */
	require_once SYS_LANG .'/lang.lib.'. $m .'.php';
}

/* Include page functions */
require_once 'lib.'. $m .'.php';

/* Assign active page */
$TEMPLATE->assign('activePage', $m);