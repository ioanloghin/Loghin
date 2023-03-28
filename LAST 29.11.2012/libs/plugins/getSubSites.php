<?php

/**
 * Get subsites
 * Get all subsites for the parent site $id
 * 
 * @param number $id
 */
function getSubSites($id)
{
	global $DB;

	/* Set default static var */
	static $sites = array();
	$_id = is_array($id) ? implode("', '", $id) : "'". $id ."'"; 

	/* Check if exist for this site data */
	if (false === empty($sites[$_id])) {
		return $sites[$_id];
	}

	/* Set default data */
	$sites[$_id] = array();

	/* Result all subsites */
	$result = $DB->query("SELECT `s`.`site_id`, `s`.`type`, `s`.`url`, `s`.`image`, `d`.`name`, `d`.`details` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`parent_id` IN ('". $_id ."') AND `s`.`status` = '1' ORDER BY `d`.`name` ASC");

	/* Fetch resultset */
	while ($obj = $DB->fetchObject($result))
	{
		/* Set data */
		$sites[$_id][$obj->site_id] = array
		(
			'name' => $obj->name,
			'image' => $obj->image,
			'url' => $obj->url,
			'type' => $obj->type,
			'details' => $obj->details
		);
	}

	/* Free result */
	$DB->freeResult($result);

	return $sites[$_id];
}