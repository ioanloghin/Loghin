<?php

/* Get vars */
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] : 1;
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$p = isset($_GET['p']) ? $_GET['p'] : '';


/* Choose action */
switch ($p)
{
	case 'add':
	case 'edit':
		editSite($id);
	break;

	case 'delete':
		deleteSite($id, $page);
	break;

	default:
		showSites($id, $page);
	break;
}


/**
 * Edit page function
 * 
 * @param number $id - unique site id
 * @return display site form, for edit or add
 */
function editSite($id)
{
	global $DB, $TEMPLATE;

	/* Set template */
	$TEMPLATE->setTemplate('siteEdit.tpl');

	/* Assign page name */
	$TEMPLATE->assign('appPage', $id ? __('edit_site') : __('add_site'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH ."index.php?m=sites&p=add", 'optname' => __('add_site')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites\">". __('manage_sites') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_site') : __('add_site')) ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Set default fields var */
	$fields = array('id' => $id, 'parent' => array('site' => array(), 'application' => array()), 'types' => array('site' => __('site'), 'application' => __('application')), 'memberTypes' => getMemberTypes());
	$data = array();
	
	/* Check if site need to be edited */
	if ($id)
	{
		/* Result site data */
		$result = $DB->query("SELECT `s`.*, `p`.`name`, `ss`.`site_id` AS `subsite` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `p` ON `p`.`site_id` = `s`.`parent_id` AND `p`.`language` = '". SYS_LANG ."' LEFT JOIN `". DB_PREFIX ."sites` AS `ss` ON `ss`.`parent_id` = `s`.`site_id` WHERE `s`.`site_id` = '". $id ."' LIMIT 1");

		/* Fetch resultset */
		if (!$obj = $DB->fetchObject($result)) {
			/* Set message */
			$TEMPLATE->setMessage('error', __('no_site'));
			return;
		}

		/* Free result */
		$DB->freeResult($result);

		/* Check if exist parent site for this site */
		if ($obj->parent_id) {
			/* Set parent infor in navlink */
			$navlinks = array(
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites\">". __('manage_sites') ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&p=edit&id=". $obj->parent_id ."\">". $obj->name ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&id=". $obj->parent_id ."\">". __('manage_subsites') ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&p=". ($id ? "edit&id=" . $id : 'add') ."\">". ($id ? __('edit_site') : __('add_site')) ."</a>")
			);
			$TEMPLATE->assign('navlinks', $navlinks);
		}

		/* Result sites data */
		$_result = $DB->query("SELECT `language`, `name`, `details` FROM `". DB_PREFIX ."sites_data` WHERE `site_id` = '". $id ."'");

		/* Fetch resultset */
		while ($_obj = $DB->fetchObject($_result)) {
			/* Set data */
			$data[$_obj->language] = array('name' => $_obj->name, 'details' => $_obj->details);
		}

		/* Free result */
		$DB->freeResult($_result);
	}

	/* Parsing post data */
	$fields['showParent'] = $id && $obj->subsite ? false : true;
	$fields['lastImage'] = $id ? $obj->image : '';
	$fields['image'] = false === empty($_FILES['image']['name']) ? $_FILES['image'] : '';
	$fields['type'] = isset($_POST['type']) && array_key_exists($_POST['type'], $fields['types']) ? $_POST['type'] : ($id ? $obj->type : key($fields['types']));
	$fields['member_type'] = isset($_POST['member_type']) ? (array_key_exists($_POST['member_type'], $fields['memberTypes']) ? $_POST['member_type'] : 0) : ($id ? $obj->member_type : 0);
	$fields['url'] = isset($_POST['url']) ? $_POST['url'] : ($id ? $obj->url : '');
	$fields['status'] = isset($_POST['status']) ? ($_POST['status'] ? 1 : 0) : ($id ? $obj->status : '');

	/* Results parents */
	$result = $DB->query("SELECT `s`.`site_id`, `s`.`type`, `d`.`name` FROM `". DB_PREFIX ."sites` AS `s` LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."' WHERE `s`.`parent_id` = '0' AND `s`.`site_id` != '". $id ."' ORDER BY `d`.`name` ASC");

	/* Fetch resultset */
	while ($_obj = $DB->fetchObject($result)) {
		$fields['parents'][$_obj->type][$_obj->site_id] = $_obj->name;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Set parent id */
	$fields['parent'] = isset($_POST['parent'][$fields['type']]) ? (array_key_exists($_POST['parent'][$fields['type']], $fields['parents'][$fields['type']]) ? $_POST['parent'][$fields['type']] : 0) : ($id ? $obj->parent_id : 0);

	/* Parse data for each language */
	foreach (Language::getInstance()->list AS $lang => $language) {
		$fields['name'][$lang] = isset($_POST['name'][$lang]) ? $DB->stripSlashes(htmlentities2utf8($_POST['name'][$lang])) : ($id && isset($data[$lang]) ? $data[$lang]['name'] : '');
		$fields['details'][$lang] = isset($_POST['details'][$lang]) ? $DB->stripSlashes(htmlentities2utf8($_POST['details'][$lang])) : ($id && isset($data[$lang]) ? $data[$lang]['details'] : '');
	}

	/* Check if site form is submited */
	if (isset($_POST['isSite']) && $_POST['isSite']) {
		saveSite($id, $fields);
	}

	/* Active / Inactive box */
	$fields['statuse'][1] = __('active');
	$fields['statuse'][0] = __('inactive');

	/* Assign template vars */
	$TEMPLATE->assign($fields);

	return true;
}


/**
 * Save page function
 * 
 * @param number $id - unique page id for edit
 * @param array $fields - page data sent by form
 * @return update page data and redirect to edit page
 */
function saveSite($id, $fields)
{
	global $DB, $TEMPLATE;

	/* Create Image class */
	require 'core/Image.class.php';

	/* Set default vars */
	$items = array();
	$_items = array();
	$errors = array();

	/* Validate member type */
	if ($fields['member_type'] == 0) {
		$errors['member_type'] = __('member_type_invalid');
	}

	/* Parse data for each language */
	foreach (Language::getInstance()->list AS $lang => $language)
	{
		/* Set default var */
		$status = 0;

		/* Validate page content */
		if (empty($fields['name'][$lang]) !== true) {
			/* Set fill tru and status 1 */
			$is_fill = true;
			$status = 1;
		}

		/* Set items */
		$items[$lang] = "`language` = '". $lang ."', `name` = '". $DB->escapeData($fields['name'][$lang]) ."', `details` = '". $DB->escapeData($fields['details'][$lang]) ."', `status` = '". $status ."'";
	}

	/* Check if exist content for minimum one language */
	if (empty($is_fill) !== false) {
		/* Set messages */
		$errors['content'] = __('fill_content');
	}

	/* Check if url is valid */
	if($fields['url'] && filter_var($fields['url'], FILTER_VALIDATE_URL) === false) {
		$errors['url'] = __('no_valid_url');
	}

	/* Check if thumbnail image was selected */
	if ('' != $fields['image'])
	{
		/* Get image and image error */
		list($fields['_image'], $errors['image']) = Image::uploadImage($fields['image'], array
		(
			'dir' => SYS_PIC_PATH .'www/sites/',
			'fileSize' => 1024,
    		'resize' => array
    		(
    			array
    			(
	    			'dir' => SYS_PIC_PATH .'www/sites/',
	    			'prefix' => '',
	    			'cutoff' => 1,
	    			'width' => 48,
	    			'height' => 48
    			)
    		)
    	));

    	/* Check if is empty image error unset it */
    	if (false !== empty($errors['image'])) {
    		unset($errors['image']);
    	}
	}

	/* Check if exist errors */
	if (false == empty($errors))
	{
		/* Check if uploded image */
		if (false == empty($fields['_image'])) {
			@unlink(SYS_PIC_PATH .'sites/'. $fields['_image']);
		}

		/* Set message */
		$TEMPLATE->setMessage('errors', $errors);
		return false;
	}

	/* Check if exist site thumbnail image */
	if ($fields['lastImage'] && false == empty($fields['_image'])) {
		@unlink(SYS_PIC_PATH .'sites/'. $fields['lastImage']);
	}

	/* Set status */
	false == empty($fields['_image']) ? $_items[] = "`image` = '". $fields['_image'] ."'" : false;
	$_items[] = "`type` = '". $DB->escapeData($fields['type']) ."'";
	$_items[] = "`member_type` = '". $DB->escapeData($fields['member_type']) ."'";
	$_items[] = "`url` = '". $DB->escapeData($fields['url']) ."'";
	$fields['showParent'] ? $_items[] = "`parent_id` = '". $DB->escapeData($fields['parent']) ."'" : false;
	$_items[] = "`status` = '". $fields['status'] ."'";

	/* Check if isset id */
	if ($id)
	{
		/* Update */
		$DB->query("UPDATE `". DB_PREFIX ."sites` SET ". implode(', ', $_items) ." WHERE `site_id` = '". $id ."' LIMIT 1");

		/* Set message */
		$TEMPLATE->setMessage('info', __('site_updated'));
	}
	/* Add new site in database */
	else
	{
		/* Insert */
		$DB->query("INSERT INTO `". DB_PREFIX ."sites` SET `postdate` = '". time() ."', ". implode(', ', $_items));

		/* Get inserted id */
		$id = $DB->getInsertId();

		/* Set message */
		$TEMPLATE->setMessage('info', __('site_added'));
	}

	/* Update sites data */
	foreach ($items AS $lang => $data)
	{
		/* Check if exist page data */
		$result = $DB->query("SELECT `data_id` FROM `". DB_PREFIX ."sites_data` WHERE `site_id` = '". $id ."' AND `language` = '". $lang ."' LIMIT 1");

		/* Check if resultset contain any row */
		if ($obj = $DB->fetchObject($result)) {
			$DB->query("UPDATE `". DB_PREFIX ."sites_data` SET ". $data ." WHERE `data_id` = '". $obj->data_id ."' LIMIT 1");
		}
		else {
			$DB->query("INSERT INTO `". DB_PREFIX ."sites_data` SET `site_id` = '". $id ."', ". $data);
		}
	}

	/* Redirect */
	redirect(VIR_CP_PATH .'index.php?m=sites&p=edit&id='. $id);

	return true;
}


/**
 * Delete site function
 * 
 * @param number $id - unique site id
 * @param number $page - after deleting site redirect to previous page
 * @return delete site and redirect to manage sites
 */
function deleteSite($id, $page)
{
	global $DB, $TEMPLATE, $LANG;

	/* Set template file */
	$TEMPLATE->setTemplate('sites.tpl');

	/* Assign page title */
	$TEMPLATE->assign('appPage', __('app_delete'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH . "index.php?m=sites&p=add", 'optname' => __('add_site')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites\">". __('manage_sites') ."</a>";
	$navlinks[]['navlink'] = "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&p=delete&id=". $id ."\">". __('delete') ."</a>";
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Result page data */
	$result = $DB->query("SELECT `parent_id`, `image` FROM `". DB_PREFIX ."sites` WHERE `site_id` = '". $id ."' LIMIT 1");

	/* Check if resultset contains any rows and resultset it */
	if ($obj = $DB->fetchObject($result))  {
		/* Delete sites images */
		@unlink(SYS_PIC_PATH .'sites/'. $obj->image);
	}
	/* Set message */
	else {
		$TEMPLATE->setMessage("error", __('no_site'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Delete page from database */
	$DB->query("DELETE FROM `". DB_PREFIX ."sites` WHERE `site_id` = '". $id ."' LIMIT 1");
	$DB->query("DELETE FROM `". DB_PREFIX ."sites` WHERE `parent_id` = '". $id ."'");

	/* Set message and redirect */
	$TEMPLATE->setMessage('info', __('site_deleted'));
	redirect(VIR_CP_PATH .'index.php?m=sites'. ($obj->parent_id != '0' ? '&id='. $obj->parent_id : '') .'&page='. $page);

	return true;
}


/**
 * Show sites function
 * 
 * @param number $page - current page number
 * @return display list of all sites
 */
function showSites($id, $page)
{
	global $DB, $TEMPLATE;

	/* Set template */
	$TEMPLATE->setTemplate('sites.tpl');

	/* Assign page name */
	$TEMPLATE->assign('appPage', __('app_sites'));

	/* Assign option links */
	$optlinks = array (array('header' => __('options')),
						array('optlink' => VIR_CP_PATH .'index.php?m=sites&p=add', 'optname' => __('add_site')));
	$TEMPLATE->assign("optlinks", $optlinks);

	/* Navigation bar */
	if ($id)
	{
		/* Result parent data */
		$result = $DB->query("SELECT `site_id`, `name` FROM `". DB_PREFIX ."sites_data` WHERE `site_id` = '". $id ."' AND `language` = '". SYS_LANG ."' LIMIT 1");

		/* Check if resultset contain any row and resultset it */
		if ($obj = $DB->fetchObject($result))
		{
			/* Set parent info in navlink */
			$navlinks = array(
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites\">". __('manage_sites') ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&p=edit&id=". $obj->site_id ."\">". $obj->name ."</a>"),
				array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites&id=". $obj->site_id ."\">". __('manage_subsites') ."</a>")
			);
			$TEMPLATE->assign('navlinks', $navlinks);
		}	
	}
	else {
		$navlinks = array(
			array('navlink' => "<a class=\"nav\" href=\"". VIR_CP_PATH ."index.php?m=sites\">". __('manage_sites') ."</a>")
		);
	}
	$TEMPLATE->assign('navlinks', $navlinks);

	/* Set default vars */
	$fields = array('id' => $id, 'items' => array());

	/* Set results per page */
	if (isset($_GET['results']) && is_numeric($_GET['results']) && $_GET['results'])
	{
		$fields['results'] = intval($_GET['results']);
		$_SESSION['results_sites'] = $fields['results'];
	}
	elseif (isset($_SESSION['results_sites']) && is_numeric($_SESSION['results_sites'])&& $_SESSION['results_sites']) {
		$fields['results'] = intval($_SESSION['results_sites']);
	}
	else {
		$fields['results'] = 25;
	}

	/* Result total sites */
	$result = $DB->query("SELECT COUNT(`site_id`) FROM `". DB_PREFIX ."sites`");

	/* Set totalpages */
	$totalitems = $DB->result($result);

	/* Free result */
	$DB->freeResult($result);

	/* Get pagination */
	list($fields['pages'], $LIMIT) = pagination($totalitems, $fields['results'], "<a href=\"". VIR_CP_PATH ."index.php?m=sites&page=%page%\">%name%</a> ", $page, "<strong>%page%</strong>", "<span>...</span>", true);

	/* Result sites data */
	$result = $DB->query("SELECT `s`.`site_id`, `s`.`parent_id`, `s`.`type`, `s`.`member_type`, `s`.`status`, `d`.`name`, (SELECT GROUP_CONCAT(`language`) FROM `". DB_PREFIX ."sites_data` WHERE `site_id` = `s`.`site_id` AND `status` = '1') AS `languages`
						FROM `". DB_PREFIX ."sites` AS `s`
						LEFT JOIN `". DB_PREFIX ."sites_data` AS `d` ON `d`.`site_id` = `s`.`site_id` AND `d`.`language` = '". SYS_LANG ."'
						WHERE `s`.`parent_id` = '". $id ."'
						ORDER BY `s`.`type` ASC, `d`.`name` ASC ". $LIMIT);


	/* Check if resultset contain any rows */
	if ($DB->numRows($result) > 0) {
		/* Set sites data */
		while ($obj = $DB->fetchObject($result)) {
			/* Set items */
			$fields['items'][$obj->site_id] = array(
				'name' => $obj->name,
				'type' => __($obj->type),
				'member_type' => getMemberTypes($obj->member_type),
				'languages' => str_replace(',', ', ', strtoupper($obj->languages)),
				'status' => $obj->status ? __('active') : __('inactive')
			);
		}
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_sites'), 1);
		return;
	}

	/* Free result */
	$DB->freeResult($result);

	/* Assign template vars */
	$TEMPLATE->assign($fields);
	$TEMPLATE->assign('page', $page);

	return true;
}