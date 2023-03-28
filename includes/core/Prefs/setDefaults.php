<?php

/**
 * Set defaults template vars
 *
 * @category   Preferences
 * @package    setDefaults template vars
 */
function Prefs_setDefaults($PREFS, $_cp = false)
{
	/* Set site info */
	$PREFS->TEMPLATE->assign('app_title', $PREFS->conf['app_title_'. SYS_LANG]);
	$PREFS->TEMPLATE->assign('app_description', $PREFS->conf['app_description_'. SYS_LANG]);
	$PREFS->TEMPLATE->assign('app_keywords', $PREFS->conf['app_keywords_'. SYS_LANG]);

	/* Set current location */
	$PREFS->TEMPLATE->assign('current_location', preg_replace("/(^(\/[^\/]+)?(\/". SYS_LANG .")?\/|\/$)/", "", $_SERVER['REQUEST_URI']));

	/* Set system path */
	$PREFS->TEMPLATE->assign('vir_path', VIR_PATH);
	$PREFS->TEMPLATE->assign('vir_cp_path', VIR_CP_PATH);

	/* Check if is defined css path */
	if (defined('VIR_CSS_PATH')) {
		$PREFS->TEMPLATE->assign('vir_css_path', VIR_CSS_PATH);
	}

	$PREFS->TEMPLATE->assign('vir_tpl_path', $_cp == true ? VIR_CP_TPL_PATH : VIR_TPL_PATH);
	$PREFS->TEMPLATE->assign('vir_pic_path', VIR_PIC_PATH);
	$PREFS->TEMPLATE->assign('sys_domain', SYS_DOMAIN);
	$PREFS->TEMPLATE->assign('sys_lang', SYS_LANG);
	$PREFS->TEMPLATE->assign('_languages', Language::getInstance()->list);

}
