<?php
// Some dirty debugging methods
//function pre($_value) { echo "<pre>"; print_r($_value); echo "</pre>"; }
//function predie($_value) { pre($_value); Yii::app()->end(); }
// change the following paths if necessary

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set("display_errors", 0); 
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',8);

require_once($yii);
// Define constants
//define('BASEURL', 'http://localhost/k11');
define('ICONPATH', BASEURL . '/images/icons/fugue');
Yii::createWebApplication($config)->run();

