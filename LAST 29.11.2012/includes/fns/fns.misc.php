<?php



/**
 * Load libs plugin file
 * 
 */
function loadPlugin($plugin)
{
	/* Check if exist plugin */
	if (file_exists(SYS_PATH .'libs/plugins/'. $plugin .'.php')) {
		require_once SYS_PATH .'libs/plugins/'. $plugin .'.php';
	}
	else {
		throw new Exception('Plugin was not found.');
	}
}


/**
 * Replace keys
 * 
 */
function replaceKeys($content, $fields)
{
	/* Check if need to replace samething */
	if (preg_match_all("/{([-_a-z]+)}/i", $content, $matches))
	{
		/* Parse each math */
		foreach ($matches[1] AS $value)
		{
			/* Check if exist value for this field */
			if (isset($fields[$value])) {
				$content = str_replace('{'. $value .'}', $fields[$value], $content);
			}
		}
	}

	return $content;
}


function randomString($length = 32, $allcases = 1) {
	return random_string($length, $allcases);
}

/**
 * Set cookie default
 *
 *
 */
function cookie($name, $value = '', $expire = false) {
	/* Get cookie */
	if ($value == '' && $expire == false) {
		return isset($_COOKIE[$name]) ? $_COOKIE[$name] : '';
	}
	/* Set cookie */
	else {
		$_COOKIE[$name] = $value;
		return setcookie($name, $value, $expire, '/'/*, '.'. SYS_DOMAIN*/);
	}
}


/**
 * Get all sites and aplication for member type
 *
 * @param $id
 * @return mixed
 */
function sitesApplications($id) {
	global $DB;

	/* Set default data */
	static $items = array();

	/* Check if exists items */
	if (false !== empty($items[$id])) {
		/* Result data */
		$result = $DB->query("SELECT `s`.`site_id`, `s`.`member_type`, `s`.`type`, `d`.`name` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`parent_id` = '0' AND `s`.`status` = '1' ORDER BY `d`.`name`");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			$items[$obj->member_type][$obj->type][$obj->site_id] = $obj->name;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return isset($items[$id]) ? $items[$id] : array();
}


/**
 * Pagination function
 * 
 * @param number $totalitems - number of total items
 * @param number $perpage - items per page
 * @param string $url - url address to open page
 * @param number $page - number of current page
 * @param booblean $js - use javascipt to change page
 * @return array - list of total pages, limit for mysql with LIMIT word, corect current page and total pages!
 */
function pagination($totalitems, $perpage, $html, $page, $_html, $_space, $_separate = false)
{
	global $LANG;

	/* Set default variable */
	$perpage = $perpage < 1 || !is_numeric($perpage) ? 25 : $perpage;
	$totalpages = ceil($totalitems / $perpage);
	$page = $page > $totalpages ? $totalpages : ($page < 1 ? 1 : $page);
	$dotted = 1;
	$dotspace = 4;

	/* Set first page */
	if ($page != 1) {
		$items[1] = str_replace(array('%page%', '%name%'), 1, $html);
	}

	/* Parse pages variable */
	$dotnext = $page <= $dotspace ? (($page + $dotspace) + ($dotspace - $page) + 1) : ($page + $dotspace > $totalpages ? $totalpages : (($page + $dotspace) == ($totalpages - 1) ? ($page + $dotspace + 1) : ($page + $dotspace)));
	$dotback = $page >= $totalpages ? ($totalpages - ($dotspace * 2)) : ($page + ($dotspace) > $totalpages ? ($totalpages - ($dotspace * 2)) : (($page - $dotspace - 1) == 1 ? ($page - $dotspace - 1) : ($page - $dotspace)));

	/* Set more pages */
	for ($i = 1; $i <= $totalpages; $i++)
	{
		if ($i > $dotnext || $i < $dotback)
		{
			if ($dotted) {
				$items[] = " ". $_space ." ";
			}

			$dotted = 0;
			continue;
		}
		if ($page == $i) {
			$items[$i] = ($_separate && $dotted && $i != 1 ? ' | ' : '') . " ". str_replace('%page%', $i, $_html) ." ";
		}
		else {
			$items[$i] = ($_separate && $dotted && $i != 1 ? ' | ' : '') . " ". str_replace(array('%page%', '%name%'), $i, $html);
		}

		$dotted = 1;
	}

	/* Set last page */
	if ($page != $totalpages && !isset($items[$totalpages])) $items[$totalpages] = str_replace(array('%page%', '%name%'), $totalpages, $html);

	/* Set back page */
	$backpage = $page - 1 > 0 ? str_replace(array('%page%', '%name%'), array(($page - 1), $LANG['back_page']), $html) ." " : '';


	/* Set return page */
	$nextpage = $page + 1 <= $totalpages ? " ". str_replace(array('%page%', '%name%'), array(($page + 1), $LANG['next_page']), $html) : '';

	/* Retun pages */
	$return = $totalpages <= 1 ? '' : ($backpage . implode($items) . $nextpage);

	/* Return limit */
	$returnlimit = "LIMIT " .ceil((($page - 1) < 0 ? 0 : $page - 1) * $perpage) . "," . $perpage;

	return array($return, $returnlimit, $page, $totalpages);
}