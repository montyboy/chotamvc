<?php

require_once(ROOT . DS . 'plugins' . DS . 'php-activerecord'. DS. 'ActiveRecord.php');
$connections = array(
	'main' => 'mysql://root:@127.0.0.1/chotamvc',
);

ActiveRecord\Config::initialize(function($cfg) use ($connections)
{
	
    $cfg->set_model_directory(ROOT.DS.'application'.DS.'models');
    $cfg->set_connections($connections);
	$cfg->set_default_connection('main');
});


/* Zebra form plugin*/
require_once(ROOT . DS . 'plugins' . DS . 'Zebra_Form'. DS. 'Zebra_Form.php');

