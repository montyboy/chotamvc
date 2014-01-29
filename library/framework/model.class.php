<?php

/**
 * Base Model Class
 * 
 * this class will help,
 * 1. to build connection with db
 * 2. to close connection with db
 * 3. useful to write common method used accross the all child models
 * 
 */

require_once(ROOT . DS . 'plugins' . DS . 'php-activerecord'. DS. 'ActiveRecord.php');

class Model extends ActiveRecord\Model {
  public function __construct(){
	// explicit connection name since we always want production with this model
	static $connection = 'development';
	parent::__construct();
  } 
}

$connections = array(
	'development' => 'mysql://root:@127.0.0.1/chotamvc',
	'production' => 'mysql://test:test@127.0.0.1/test'
);

ActiveRecord\Config::initialize(function($cfg) use ($connections)
{
    $cfg->set_model_directory(ROOT.'application'.DS.'models');
    $cfg->set_connections($connections);
});