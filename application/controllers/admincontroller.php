<?php

/**
 * Represent the Administration controller
 * 
 */
class adminController extends Controller {
	
	protected $adminuser;
	static $loginURL = "cmslogin";
	public function __construct($controller="", $action=""){
		parent::__construct($controller, $action);
		$this->setLayout("admin/layout");
		$this->adminuser = admin::getInstance();
		$this->set('user',$this->adminuser);
		$this->setTitle(SITE_NAME);
		$this->breadcrumb = new BreadCrumb();
		$this->set('modulename',"");
	}
	
	/*
	 * Login action 
	 */
	public function login(){
		
		if($this->adminuser->isLoggedIn()){ // If the user has already logged in
			self::redirectUrl('admin/index');
		}
		
		if ($this->isPost()) { // If the user has logged in
            $this->validator->addValidation("username", "req", "Username required");
            $this->validator->addValidation("password", "req", "Password required");
			$this->validator->addValidation("code", "req", "Code required");
            if ($this->validator->ValidateForm()) { // Validate the form
            	$error = $this->adminuser->validatelogin($this->getParam('username'),
            		$this->getParam('pasword'),$this->getParam('code'));
				if (isset($error) && !empty($error)){ // If there is some problem in the login
					$this->set('error', $error);	
				}else{
					// Redirect user to main index
					self::redirectUrl('admin/index');
				}	
            }
			
			// Check for errors
        }
		$this->setTitle(SITE_NAME." Administration Login");
		$this->setView("login");
	} 
	
	/*
	 * Default action
	 */
	public function index(){
		if($this->adminuser->isLoggedIn()){
			$modulename = "Dashboard";
			$this->set('modulename',$modulename);
			$this->breadcrumb->add($modulename);
			$this->set('breadcrumb',$this->breadcrumb->draw());
		}else{
			self::redirectUrl(self::$loginURL);
		}
	}
	
	
	/*
	 * User logout
	 */
	function logout(){
		$this->adminuser->logout();
		self::redirectUrl(self::$loginURL);	
	}
    
}

?>