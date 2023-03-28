<?php

/* Set default template */
$TEMPLATE->setTemplate('response.tpl');

/* Assign template languages */
$TEMPLATE->assign('languages', Language::getInstance()->list);

/* Get variables */
$m = isset($_GET['m']) && file_exists(SYS_PATH . 'admin/cp/cp.'. $DB->escapeData($_GET['m']) .'.php') ? $DB->escapeData($_GET['m']) : 'members';

/* Check if exist language for current page */
if (file_exists(SYS_PATH .'includes/languages/'. SYS_LANG .'/lang.cp.'. $m .'.php')) {
	/* include language */
	require_once 'languages/'. SYS_LANG .'/lang.cp.'. $m .'.php';
}

/* Include page functions */
require_once 'cp.'. $m .'.php';


/* Assign active page */
switch ($m)
{
	case 'sites':
	case 'layouts':
		$TEMPLATE->assign('activeModule', 'modules');
	break;

	case 'settings':
	case 'emailtemplates':
	case 'membergroups':
		$TEMPLATE->assign('activeModule', 'settings');
	break;

	default:
		$TEMPLATE->assign('activeModule', 'members');
	break;
}