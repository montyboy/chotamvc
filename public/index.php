<?php	


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = array_key_exists('url', $_GET)?$_GET['url']:'';

require_once (ROOT . DS . 'library' . DS . 'framework' . DS . 'bootstrap.php');
