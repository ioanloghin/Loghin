<?php

/**
 * Fetch single or multiple email templates from the database
 *
 * @category   Preferences
 * @package    setDefaults template vars
 */
function Prefs_getTemplates($PREFS, $vars, $language = null)
{
	/* Get languages function */
	$languages = get_languages();

	/* Set language */
	$language = $language && isset($languages[$language]) ? $language : SYS_LANG;

	/* Check if this is an array */
	if ((is_array($vars) || is_string($vars)) && empty($vars) !== true)
	{
		/* Get settings data from the database */
		$result = $PREFS->DB->query("SELECT `e`.`label`, `d`.`subject`, `d`.`body` FROM `". DB_PREFIX ."email_templates` AS `e` LEFT JOIN `". DB_PREFIX ."email_templates_data` AS `d` ON `d`.`template_id` = `e`.`template_id` AND `d`.`language` = '". $language ."' WHERE `e`.`label` IN ('". (is_array($vars) ? implode("', '", $vars) : $vars) ."')");

		/* Check if result contains rows */
		if($PREFS->DB->numRows($result))
		{
			/* Fetch result set into object and assign it */
			while ($obj = $PREFS->DB->fetchObject($result))
			{
				$PREFS->conf[$obj->label .'_subject'] = $obj->subject;
				$PREFS->conf[$obj->label .'_body']	= $obj->body;
			}
		}

		/* Free result */
		$PREFS->DB->freeResult($result);
	}
}