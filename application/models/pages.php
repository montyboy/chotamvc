<?php
/*
 * Admin model which is used for managing the main website
 */
 
class Pages extends ActiveRecord\Model {

	protected $user = null;
	
	static $Instance;
	
	// explicit table name since our table is not "admin"
	static $table_name = 'pages';

	// explicit pk since our pk is not "id"
	static $primary_key = 'id';
	
	public static function getInstance(){
        if (!self::$Instance){
        	self::$Instance = new Pages;
        }
		return self::$Instance;
    }
	
}

