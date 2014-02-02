<?php

/**
 * Represent the Pages controller
 * 
 */
class pagesadminController extends adminController {
	
	private $_modulename;
	public function __construct($controller, $action){
		parent::__construct($controller, $action);
		$this->_modulename = "Pages";
		$this->breadcrumb->add($this->_modulename,"/pagesadmin/index");
		$this->set('modulename',$this->_modulename);
	}
	
	public function index(){
		if($this->adminuser->isLoggedIn()){
			$this->breadcrumb->add("List");
			$this->set('breadcrumb',$this->breadcrumb->draw());
		}else{
			self::redirectUrl(self::$loginURL);
		}
	}
	
	public function add(){
		if($this->adminuser->isLoggedIn()){
			$this->breadcrumb->add("Add new page");
			$this->set('breadcrumb',$this->breadcrumb->draw());
			$this->addJs("/ckeditor/ckeditor.js");
			$this->setView("form");
		}else{
			self::redirectUrl(self::$loginURL);
		}
	}
	
	public function edit($id){
		if($this->adminuser->isLoggedIn()){
			$page = Pages::getInstance()->find($id);
			$this->breadcrumb->add("Edit page \"".$page->headline."\"");
			$this->set('breadcrumb',$this->breadcrumb->draw());
			$this->set('page',$page);
			$this->addJs("/ckeditor/ckeditor.js");
			$this->setView("form");
			
		}else{
			self::redirectUrl(self::$loginURL);
		}
	}
	
	private function save(){
		
	}
	
	public function delete(){
		
	}
	
}

?>