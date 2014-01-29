<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vinayak_bhomkar
 * Date: 1/29/14
 * Time: 7:12 PM
 * To change this template use File | Settings | File Templates.
 */

class Book extends Model{
	// explicit table name since our table is not "books"
	static $table_name = 'simple_book';

	// explicit pk since our pk is not "id"
	static $primary_key = 'book_id';
	
	public function __construct(){
		parent::__construct();
	}	
  
}