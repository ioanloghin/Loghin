<?php


/* Include language file */
require_once 'languages/'. SYS_LANG .'/lang.cp.login.php';

/* Set template file */
$TEMPLATE->setTemplate('login.tpl');

/* Assign template vars */
$TEMPLATE->assign('app_page', __('app_login'));

/* Check if form has been submitted */
if (isset($_POST['islogin']))
{
	/* Check if login attemps are exceeded and set new time */
	if (isset($_POST['islogin']) && $_POST['islogin'] && !$SESSION->auth)
	{
		if ($_SESSION['logincount'] >= $PREFS->conf['lockout_tries']) {
			$TEMPLATE->setMessage('error', sprintf(__('login_attemts'), $PREFS->conf['lockout_time']));
		}
		else {
			$TEMPLATE->setMessage("error", __('user_pass_invalid'), 0);
		}
	}
	elseif (isset($_POST['islogin']) && $_POST['islogin'] && $SESSION->auth)
	{
		/* Check if exists get vars */
		$gets = array();
		if (isset($_GET) && $_GET)
		{
			foreach ($_GET as $key => $value) {
				$gets[] = $key . "=" . $value;
			}
		}

		/* Set message and redirect */
		$TEMPLATE->setMessage('info', __('logged_in'));
		redirect(VIR_CP_PATH . "index.php" . ($gets ? '?' . implode('&', $gets) : ''));
	}
}