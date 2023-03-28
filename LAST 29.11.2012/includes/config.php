<?php

/* System Debug */
define('SYS_DEBUG', 2);

/* Database Connection */
define('_DATABASE_', serialize(array('hostname' => 'localhost', 'username' => 'loghin_ioanchis', 'password' => 'QAwmnx7|pMC%', 'database' => 'loghin_www')));

/* Database prefix */
define('DB_PREFIX', 'lg_');

/* System path */
define('SYS_PATH', '/home/loghin/public_html/');
define('SITE_PATH', 'http://'. $_SERVER['HTTP_HOST'] .'/');
define('SYS_TPL_PATH', SYS_PATH .'templates/');
define('VIR_TPL_PATH', SITE_PATH .'templates/');

/* Site System path */
define('SYS_SYS_PATH', SYS_PATH .'system/');
define('VIR_SYS_PATH', SITE_PATH .'system/');
define('SYS_SYS_TPL_PATH', SYS_PATH .'system/templates/');
define('VIR_SYS_TPL_PATH', VIR_SYS_PATH .'templates/');

/* System admin path */
define('VIR_CP_PATH', SITE_PATH .'admin/');
define('SYS_CP_TPL_PATH', SYS_PATH .'admin/templates/');
define('VIR_CP_TPL_PATH', SITE_PATH .'admin/templates/');

/* Include global config */
require_once('/home/loghin/sources/config.php');
