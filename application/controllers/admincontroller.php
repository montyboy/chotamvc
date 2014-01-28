<?php

/**
 * Represent the Administration controller
 * 
 */
class adminController extends Controller {
	
	protected $adminuser;
	public function __construct($controller, $action){
		parent::__construct($controller, $action);
		$this->setLayout("admin/layout");
		$this->adminuser = new admin;
	}
	
	public function index(){
		if(!$this->adminuser->isLoggedIn()){
			$this->setTitle("Administration Login");
			$this->setView("login");
			return;	
		}
	}
    
}

?>