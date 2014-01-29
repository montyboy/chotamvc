<?php

/**
 * Represent the Site controller
 * 
 */


class siteController extends Controller {
	
	  function index() {

    }

    function test(){

      $u = new user;
      $u->username = 'johndoe';
      $u->password = 'secret';
      $u->first_name = 'John';
      $u->last_name = 'Doe';
      $u->save();

    }
}

?>