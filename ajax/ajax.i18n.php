<?php

function i18n()
{
	global $TEMPLATE;

	/* Create Json class */
	$Json = new Json;

	/* Check if exist language file */
	if (file_exists(SYS_PATH .'includes/languages/'. SYS_LANG .'/lang.JavaScript.php')) {
		/* Include nedded file */
		include SYS_LANG .'/lang.JavaScript.php';
	}
	else {
		/* Set error */
		$Json->setError(__('no_language'));
	}

	/* Assign template data */
	$TEMPLATE->assign('response', $Json->isError() ? $Json->Encode(null, true) : $Json->Encode($i18n, true));

	return true;
}