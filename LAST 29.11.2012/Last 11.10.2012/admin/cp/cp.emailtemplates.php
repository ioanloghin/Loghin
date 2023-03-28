<?php


/* GET values */
$id = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;

/* Show emails templates */
emailtemplatesEdit($id);

/**
 * Show emails templates function
 * 
 * @param number $id - unique email id
 * @return show edit email template form
 */ 
function emailtemplatesEdit($id)
{
	global $DB, $TEMPLATE;

	/* Set template file */
	$TEMPLATE->setTemplate("emailtemplates.tpl");

	/* Assign page title */
	$TEMPLATE->assign('app_page', __('app_emailtemplates'));

	/* Add ckeditor */
	$TEMPLATE->setScript(VIR_PATH .'js/ckeditor/ckeditor.js');

	/* Assign default vars */
	$optlinks = array();
	$groups = array();
	$fields = array();

	/* Get groups */
	$result = $DB->query("SELECT * FROM `". DB_PREFIX ."email_templates` ORDER BY `orderid` ASC");

	/* Check if resultset contains any rows */
	if ($DB->numRows($result))
	{
		/* Create a new box */
		array_push($optlinks, array('header' => __('categories')));

		/* Set default vars */
		$i = 0;
		$name = '';

		/* Fetch resultset */
		while ($obj = $DB->fetchObject($result))
		{
			/* Set values */
			$groups['optlink'] = 'index.php?m=emailtemplates&id='. $obj->template_id;
			$groups['optname'] = __($obj->label);
			array_push($optlinks, $groups);

			/* Check if this is the current group */
			if ($obj->template_id == $id || !$id)
			{
				/* Set values */
				$id = $id ? $id : $obj->template_id;
				$fields['name'] = __($obj->label);
				$fields['label'] = $obj->label;
				$data = array();

				/* Result email data */
				$_result = $DB->query("SELECT `language`, `subject`, `body` FROM `". DB_PREFIX ."email_templates_data` WHERE `template_id` = '". $id ."'");

				/* Fetch resultset */
				while ($_obj = $DB->fetchObject($_result))
				{
					/* Set data */
					$data[$_obj->language] = array();
					$data[$_obj->language]['subject'] = $_obj->subject;
					$data[$_obj->language]['body'] = $_obj->body;
				}
	
				/* Free result */
				$DB->freeResult($_result);


				/* Parse post data */
				foreach (Language::getInstance()->list AS $lang => $language)
				{
					$fields['subject'][$lang] = isset($_POST['subject'][$lang]) ? htmlentities2utf8($DB->stripSlashes($_POST['subject'][$lang])) : (isset($data[$lang]) ? $data[$lang]['subject'] : '');
					$fields['body'][$lang] = isset($_POST['body'][$lang]) ? $DB->stripSlashes($_POST['body'][$lang]) : (isset($data[$lang]) ? $data[$lang]['body'] : '');
				}

				/* Assign template vars */
				$TEMPLATE->assign($fields);
				$TEMPLATE->assign('id', $id);
			}
		}

		/* Assign template vars */
		$TEMPLATE->assign('optlinks', $optlinks);
	}
	else {
		/* Set message */
		$TEMPLATE->setMessage('error', __('no_groups_exist'), 1);
		return;
	}
	
	/* Free result */
	$DB->freeResult($result);

	/* Check group id */
	if (!$fields['name']) {
		$TEMPLATE->setMessage("error", __('invalid_group_id'));
		return;
	}

	/* Check if user submitted the form */
	if (isset($_POST['isemailtemplates']) && $_POST['isemailtemplates']) {
		emailtemplatesSave($id, $fields);
	}

	return 1;
}


/**
 * Save email template function
 * 
 * @param number $id - unique email id
 * @param array $fields - email template data
 */
function emailtemplatesSave($id, $fields)
{
	global $DB, $LANG, $TEMPLATE, $PREFS;


	/* Set default vars */
	$items = $errors = array();

	/* Parse with languages */
	foreach (Language::getInstance()->list AS $lang => $language)
	{
		/* Check subject */
		if ($fields['subject'][$lang] == '') {
			$errors[] = sprintf(__('empty_subject'), $language);
		}

		/* Check body */
		if ($fields['body'][$lang] == '') {
			$errors[] = sprintf(__('empty_body'), $language);
		}

		/* Set items */
		$items[$lang] = "`language` = '". $lang ."', `subject` = '". $DB->escapeData($fields['subject'][$lang]) ."', `body` = '". $DB->escapeData($fields['body'][$lang]) ."'";
	}

	/* Check if exist errors */
	if (empty($errors) !== true) {
		/* Set message */
		$TEMPLATE->setMessage('errors', $errors);
		return;
	}

	/* Set language cicle */
	foreach (Language::getInstance()->list AS $lang => $language)
	{
		/* Result data for this language */
		$result = $DB->query("SELECT `data_id` FROM `". DB_PREFIX ."email_templates_data` WHERE `template_id` = '". $id ."' AND `language` = '". $lang ."' LIMIT 1");

		/* Fetch resultset */
		if ($obj = $DB->fetchObject($result)) {
			/* Update email data */
			$DB->query("UPDATE `". DB_PREFIX ."email_templates_data` SET ". $items[$lang] ." WHERE `data_id` = '". $obj->data_id ."' AND `template_id` = '". $id ."' LIMIT 1");
		}
		else {
			/* Insert email data */
			$DB->query("INSERT INTO `". DB_PREFIX ."email_templates_data` SET `template_id` = '". $id ."', ". $items[$lang]);
		}

		/* Free result */
		$DB->freeResult($result);
	}

	/* Set message and redirect to settings */
	$TEMPLATE->setMessage("info", __('emailtemplates_saved'));
	redirect(VIR_CP_PATH .'index.php?m=emailtemplates&id='. $id);

	return 1;
}