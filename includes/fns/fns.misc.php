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
 * Get extensions
 *
 * @param int $id
 * @return string
 */
function getExtensions($id = false) {
	global $DB;

	/* Set default extensions */
	static $extensions = array();

	/* Check if don't exist any extensions */
	if (false !== empty($extensions)) {
		/* Result extensions */
		$result = $DB->query("SELECT `extension_id`, `extension` FROM `". DB_PREFIX ."extensions` ORDER BY `orderid` ASC");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			$extensions[$obj->extension_id] = $obj->extension;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return is_bool($id) ? $extensions : (isset($extensions[$id]) ? $extensions[$id] : '');
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


function getLayoutsMenus($id = 0) {
	global $DB;

	/* Set default vars */
	static $items = array();

	/* Check if items are empty */
	if (empty($items)) {
		/* Fetch resultset */
		$result = $DB->query("SELECT `menu_id`, `parent_id`, `name`, `type` FROM `". DB_PREFIX ."layouts_menus` ORDER BY `parent_id` ASC, FIELD(`type`, 'left', 'right'), `orderid` ASC");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			/* Check if is parent */
			if ($obj->parent_id == 0) {
				$items[$obj->menu_id] = array('name' => $obj->name, 'type' => $obj->type, 'menu_id' => $obj->menu_id, 'items' => array());
			}
			else {
				$items[$obj->parent_id]['items'][$obj->menu_id] = $obj->name;
			}
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return $id ? (isset($items[$id]) ? $items[$id] : array()) : $items;
}


/**
 * Get layouts groups
 *
 * @param $id
 * @return mixed
 */
function getLayoutsGroups($id) {
	global $DB, $SESSION;

	/* Set default items */
	static $items = array();

	/* Check if items are empty */
	if (empty($items[$id])) {
		/* Set default items for this menu */
		$items[$id] = array();
		$orders = array();

		/* Result groups */
		$result = $DB->query("SELECT `g`.`group_id`, `g`.`parent_id`, `g`.`name`, `g`.`info`, `g`.`url`, `g`.`orderid`, COUNT(`f`.`favorite_id`) AS `has` FROM `". DB_PREFIX ."layouts_groups` AS `g` LEFT JOIN `". DB_PREFIX ."layouts_favorites` AS `f` ON `f`.`group_id` = `g`.`group_id` AND `f`.`member_id` = ". $SESSION->conf['member_id'] ." WHERE `g`.`menu_id` = '". $id ."' GROUP BY `g`.`group_id` ORDER BY `g`.`parent_id` ASC, `g`.`orderid` ASC");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			/* Set Url */
			$url = $obj->url ? $obj->url : '#';

			/* Set parent data */
			if ($obj->parent_id == 0) {
				$items[$id][$obj->orderid] = array('id' => $obj->group_id, 'name' => $obj->name, 'url' => $url, 'items' => array());
				$orders[$obj->group_id] = $obj->orderid;
			}
			else {
				$items[$id][$orders[$obj->parent_id]]['items'][$obj->orderid] = array('id' => $obj->group_id, 'name' => $obj->name, 'info' => $obj->info, 'url' => $url, 'has' => ($obj->has ? true : false));
			}
		}

		/* Free resultset */
		$DB->freeResult($result);
	}

	return $items[$id];
}


/**
 * Get group layouts
 *
 * @param $id
 * @return mixed
 */
function getLayouts($id) {
	global $DB;

	/* Set default vars */
	static $layouts = array();

	/* Check if have already set this layout */
	if (!isset($layouts[$id])) {
		/* Set default var */
		$layouts[$id] = array('layouts' => array(), 'layoutsOrder' => array());

		/* Result all layouts */
		$result = $DB->query("SELECT `l`.`layout_id`, `l`.`type`, `l`.`url`, `l`.`image`, `d`.`name`, `d`.`details` FROM `". DB_PREFIX ."layouts` AS `l` LEFT JOIN `". DB_PREFIX ."layouts_data` AS `d` ON `d`.`layout_id` = `l`.`layout_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `l`.`parent_id` = '0' AND `group_id` = '". $id ."' AND `l`.`status` = '1' ORDER BY `l`.`type` ASC, `d`.`name` ASC");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			/* Set layouts data */
			$layouts[$id]['layouts'][$obj->type][$obj->layout_id] = array(
				'name' => $obj->name,
				'image' => $obj->image ? $obj->image : 'default.png',
				'details' => $obj->details,
				'url' => $obj->url
			);

			/* Set layouts order */
			$layouts[$id]['layoutsOrder'][$obj->type][] = $obj->layout_id;
		}

		/* Free result */
		$DB->freeResult($result);
	}

	return $layouts[$id];
}


function getLayoutTextes($id, &$favorites = array('id' => 0)) {
	global $DB, $PREFS;

	/* Set default vars */
	$fields = array();

	/* Result layout group */
	$_result = $DB->query("SELECT `l`.`text_top`, `l`.`text_bottom`, `l`.`extension_id` FROM `". DB_PREFIX ."layouts_groups` AS `l` WHERE `group_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contain any row and resultset it */
	if ($_obj = $DB->fetchObject($_result)) {
		/* Require Circular class */
		require_once 'Circular.class.php';

		/* Create top text */
		$ArchTop = new Circular('top', ($_obj->text_top ? $_obj->text_top : $PREFS->conf['globe_text_top_'. SYS_LANG]), 145, 'top', 'Monaco-22');
		$ArchBottom = new Circular('bottom', ($_obj->text_bottom ? $_obj->text_bottom : $PREFS->conf['globe_text_bottom_'. SYS_LANG]), 160, 'bottom', 'Monaco-22');

		/* Set data */
		$fields = array('textes' => array('top' => $ArchTop->getStyle() . $ArchTop->getLetters(), 'bottom' => $ArchBottom->getStyle() . $ArchBottom->getLetters()), 'extension' => $favorites['id'] > 0 ? __('.my') : getExtensions($_obj->extension_id));
	}

	/* Free result */
	$DB->freeResult($_result);

	return $fields;
}


function getFavorites($id, $_id = 0) {
	global $DB;

	/* Set default var */
	static $favorites = array();

	/* Check if have already set favorites for this layout */
	if (!isset($favorites[$id])) {
		/* Set default var */
		$favorites[$id] = array('id' => $_id, 'layouts' => array(), 'items' => array());
		$i = 1;

		/* Result all favorites */
		$result = $DB->query("SELECT `f`.`favorite_id`, `f`.`name`, `f`.`layouts` FROM `". DB_PREFIX ."layouts_favorites` AS `f` WHERE `f`.`group_id` = '". $id ."' AND `f`.`status` = '1' AND `f`.`name` != ''  ORDER BY `f`.`favorite_id` ASC");

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result)) {
			/* Set default favorites */
			$favorites[$id]['items'][$obj->favorite_id] = array(
				'name' => $obj->name,
				'layouts' => array_map('intval', explode(',', $obj->layouts)),
				'order' => $i++
			);

			/* Check if don't exists default layouts and set they */
			if (empty($favorites[$id]['layouts'])) {
				$favorites[$id]['id'] = $obj->favorite_id;
				$favorites[$id]['layouts'] =& $favorites[$id]['items'][$obj->favorite_id]['layouts'];
			}
		}

		/* Free result */
		$DB->freeResult($result);

		/* Check if don't exists default layouts */
		if (empty($favorites[$id]['layouts'])) {
			/* Get all layouts items */
			$layouts = getLayouts($id);

			/* Check if this layout have sites and aplications */
			if (false === empty($layouts['layouts']['site']) && false === empty($layouts['layouts']['application'])) {
				/* Set sites and applications */
				$favorites[$id]['layouts'] = array_merge(array_keys(array_slice($layouts['layouts']['site'], 0, 6, true)), array_keys(array_slice($layouts['layouts']['application'], 0, 6, true)));
			}
		}
	}

	/* Check if exists special member layout */
	if ($_id && isset($favorites[$id]['items'][$_id])) {
		$favorites[$id]['id'] = $_id;
		$favorites[$id]['layouts'] = $favorites[$id]['items'][$_id]['layouts'];
	}
	elseif (empty($favorites[$id]['items'])) {
		$favorites[$id]['id'] = 0;
	}

	return $favorites[$id];
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