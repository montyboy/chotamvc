<?php

/**
 * Represent the Administration controller
 *
 */
class adminuserController extends adminController {

	private $_modulename;
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this -> _modulename = "Users";
		$this -> breadcrumb -> add($this -> _modulename, "/adminuser/index");
		$this -> set('modulename', $this -> _modulename);
	}

	public function editprofile() {
		if ($this -> adminuser -> isLoggedIn()) {
			$this -> breadcrumb -> add("Update profile");
			$this -> set('breadcrumb', $this -> breadcrumb -> draw());
			$form = new Zebra_Form('profileupdate');
			$this -> loadform($form,$this->adminuser);
			$form -> clientside_validation(false);
			if ($this -> isPost()) {
				if ($form -> validate()) {
					$this -> saveprofile($this->adminuser->id);
				} else {
					$form -> show_all_error_messages(true);
				}
			}
			$this -> set('form_content', $form -> render(APP_VIEWS . DS . $this -> _controller . DS . "form-update.php", true));
			$this -> setView('update');
		} else {
			self::redirectUrl(self::$loginURL);
		}
	}

	private function loadform(&$form, $data = null) {
		$this -> addCss("/zebra_form/css/zebra_form.css");
		$this -> addJs("/zebra_form/javascript/zebra_form.js");
		$this -> addJs("/ckeditor/ckeditor.js");

		/* Firstname */
		$form -> add('label', 'label_firstname', 'firstname', 'Firstname');
		$obj = $form -> add('text', 'firstname', (isset($data) ? $data -> firstname: ""), array('autocomplete' => 'off', 'class' => 'input-xlarge', 'size' => '70', 'placeholder' => "Firstname"));
		$obj -> set_rule(array('required' => array('error', 'Firstname is required')));
		
		/* Lastname */
		$form -> add('label', 'label_lastname', 'lastname', 'Lastname');
		$obj = $form -> add('text', 'lastname', (isset($data) ? $data -> lastname: ""), array('autocomplete' => 'off', 'class' => 'input-xlarge', 'size' => '70', 'placeholder' => "Lastname"));
		$obj -> set_rule(array('required' => array('error', 'Lastname is required')));
		
		/* Email */
		$form -> add('label', 'label_email', 'email', 'Email');
		$obj = $form -> add('text', 'email', (isset($data) ? $data -> email: ""), array('autocomplete' => 'off', 'class' => 'input-xlarge', 'size' => '70', 'placeholder' => "Email"));
		$obj -> set_rule(array(
			'required' => array('error', 'Email is required'),
			'email' => array('error', 'Invalid email address')));		

	}

	private function saveprofile($id="") {
		$admin = (!empty($id) ? Admin::getInstance() ->find($id) : Admin::getInstance());
		if($admin->emailcheck()){
			return true;	
		}
	}

	public function changepassword() {

	}

}
?>