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

require_once (ROOT . DS . 'plugins' . DS . 'doctrine'. DS .'doctrine.php');

class Model extends Doctrine_Record {
  public function __construct(){
    parent::__construct();
  }
}
