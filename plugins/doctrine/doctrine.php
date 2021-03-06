<?php

require_once ROOT.'/plugins/doctrine/lib/Doctrine.php';

// this will allow Doctrine to load Model classes automatically
spl_autoload_register(array('Doctrine', 'autoload'));

// we load our database connections into Doctrine_Manager
// this loop allows us to use multiple connections later on

$connection_name = "default";
// first we must convert to dsn format
$dsn = "mysql://root:@localhost/cms";
Doctrine_Manager::connection($dsn,$connection_name);


// telling Doctrine where our models are located
Doctrine::loadModels(ROOT.'/application/models');


// this will allow us to use "mutators"
Doctrine_Manager::getInstance()->setAttribute(
	Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

// this sets all table columns to notnull and unsigned (for ints) by default
Doctrine_Manager::getInstance()->setAttribute(
	Doctrine::ATTR_DEFAULT_COLUMN_OPTIONS,
	array('notnull' => true, 'unsigned' => true));

// set the default primary key to be named 'id', integer, 4 bytes
Doctrine_Manager::getInstance()->setAttribute(
	Doctrine::ATTR_DEFAULT_IDENTIFIER_OPTIONS,
	array('name' => 'id', 'type' => 'integer', 'length' => 4));