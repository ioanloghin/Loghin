<?php

/* Set default template */
$TEMPLATE->setTemplate('layout.tpl');

/* Get variables */
$m = isset($_GET['m']) && file_exists(SYS_SYS_PATH .'libs/sys.'. $_GET['m'] .'.php') ? $_GET['m'] : (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ? 'ajax' : 'home');
$p = isset($_GET['p']) ? $_GET['p'] : '';

/* Check if exist language for current page */
if (file_exists(SYS_PATH .'includes/languages/'. SYS_LANG .'/lang.sys.'. $m .'.php')) {
	/* include language */
	require_once SYS_LANG .'/lang.sys.'. $m .'.php';
}

/* Include page functions */
require_once 'sys.'. $m .'.php';

/* Assign active page */
$TEMPLATE->assign('activePage', $m);
$TEMPLATE->assign('activeAction', $p);