<?php

$config_path = ROOT . DS . 'config'.DS;
foreach (glob($config_path."*.php") as $filename) {
  require_once $filename;
}
require_once (ROOT . DS . 'library' . DS . 'framework' . DS . 'shared.php');

