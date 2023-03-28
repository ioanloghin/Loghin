<?php
/*
|--------------------------------------------------------------------------
| Loghin Genealogy Config Items
|--------------------------------------------------------------------------
*/
$config['admin_session_type']			= 'cs';
$config['allow_avatar_uploads'] 		= 'n';
$config['allow_dictionary_pw'] 			= 'y';
$config['allow_member_localization'] 	= 'n';
$config['allow_member_registration'] 	= 'y';
$config['allow_multi_emails']			= 'n';
$config['allow_multi_logins']			= 'y';
$config['allow_signatures'] 			= 'y';
$config['allow_username_change'] 		= 'y';
$config['auto_assign_cat_parents']		= 'y';
$config['auto_convert_high_ascii']		= 'y';
$config['autosave_interval_seconds']	= '0';
$config['avatar_max_height'] 			= '100';
$config['avatar_max_kb'] 				= '50';
$config['avatar_max_width']				= '100';
$config['avatar_path'] 					= '/path/images/avatars/';
$config['avatar_url'] 					= 'http://localhost/loghin/genealogy/images/avatars/';

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your Loghin Genealogy root. Typically this will be your base URL,
| WITH a trailing slash:
|
| http://example.com/
|
*/
$config['base_url'] = 'http://localhost/loghin/genealogy/';

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
*/
$config['db_server']	= 'localhost';
$config['db_user']		= 'root';
$config['db_pass']		= '';
$config['db_name']		= 'genealogy';
$config['db_pre']		= 'gen_';

$config['db2_server']	= 'localhost';
$config['db2_user']		= 'root';
$config['db2_pass']		= '';
$config['db2_name']		= 'loghin_register';
$config['db2_pre']		= 'l_';

/*
|--------------------------------------------------------------------------
| Patch Directory Path
|--------------------------------------------------------------------------
|
| includes
|
*/
$config['patch_system_core']		= 'system/core/';
$config['patch_system_helpers']		= 'system/helpers/';
$config['patch_system_libraries']	= 'system/libraries/';

/*
|--------------------------------------------------------------------------
| Template
|--------------------------------------------------------------------------
|
*/
$config['template'] = 'harmony';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not "echo" any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

$config['controller_trigger'] = 'C';
$config['cookie_domain'] = 'loghin.com';
$config['cookie_path'] = '/';
$config['cp_theme'] = 'default';


/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']			= 'english';
$config['allow_lang_url']	= false;// afisarea limbi in url

$config['lockout_time'] = '30';

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

$config['log_email_console_msgs'] = 'y';

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| system/logs/ folder.  Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';

$config['log_referrers'] = 'n';
$config['log_search_terms'] = 'y';

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
|
| 0 = Disables logging, Error logging TURNED OFF
| 1 = Error Messages (including PHP errors)
| 2 = Debug Messages
| 3 = Informational Messages
| 4 = All Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 0;

$config['mail_format'] = 'plain';
$config['mail_protocol'] = '';
$config['mailinglist_enabled'] = 'y';
$config['mailinglist_notify'] = 'n';
$config['mailinglist_notify_emails'] = '';
$config['max_caches'] = '150';
$config['max_logged_searches'] = '500';
$config['max_page_loads'] = '10';
$config['max_referrers'] = '500';
$config['max_tmpl_revisions'] = '5';
$config['mbr_notification_emails'] = '';
$config['member_theme'] = 'default';
$config['memberlist_order_by'] = 'total_posts';
$config['memberlist_row_limit'] = '20';
$config['memberlist_sort_order'] = 'desc';
$config['name_of_dictionary_file'] = '';
$config['new_member_notification'] = 'n';
$config['new_posts_clear_caches'] = 'y';
$config['new_version_check'] = 'y';
$config['output_charset'] = 'utf-8';
$config['password_lockout'] = 'y';
$config['password_lockout_interval'] = '1';

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify which characters are permitted within your URLs.
| When someone tries to submit a URL with disallowed characters they will
| get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars']	= 'a-z 0-9~%.:_\\-';

$config['photo_max_height']		= '100';
$config['photo_max_kb']			= '50';
$config['photo_max_width']		= '100';
$config['photo_path']			= '/path/images/member_photos/';
$config['photo_url']			= 'http://site.com/images/member_photos/';
$config['profile_trigger']		= 'asdflhasdfmnaasdgasfgl87asdg';
$config['protect_javascript']	= 'n';

// Last edit: 27-11-2013
?>