<?php

/**
 * Represent the Pages controller
 *
 */
class pagesadminController extends adminController {

	private $_modulename;
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this -> _modulename = "Pages";
		$this -> breadcrumb -> add($this -> _modulename, "/pagesadmin/index");
		$this -> set('modulename', $this -> _modulename);
	}

	public function index() {
		if ($this -> adminuser -> isLoggedIn()) {
			$this -> breadcrumb -> add("List");
			$this -> set('breadcrumb', $this -> breadcrumb -> draw());
		} else {
			self::redirectUrl(self::$loginURL);
		}
	}

	private function loadform(&$form, $data = null) {
		$this -> addCss("/zebra_form/css/zebra_form.css");
		$this -> addJs("/zebra_form/javascript/zebra_form.js");
		$this -> addJs("/ckeditor/ckeditor.js");

		/* Headline field */
		$form -> add('label', 'label_headline', 'headline', 'Headline');
		$obj = $form -> add('text', 'headline', (isset($data) ? $data -> headline : ""), array('autocomplete' => 'off', 'class' => 'input-xxlarge', 'size' => '90', 'placeholder' => "Headline"));
		$obj -> set_rule(array('required' => array('error', 'Headline is required')));

		/* Description field */
		$form -> add('label', 'label_description', 'label_description', 'Description');
		$obj = $form -> add('textarea', 'description', (isset($data) ? $data -> body : ""), array('autocomplete' => 'off', 'class' => 'ckeditor', ));
		$obj -> set_rule(array('required' => array('error', 'Description is required')));

		/* Description field */
		$form -> add('label', 'label_status', 'label_status', 'Set the page state as');

		$obj = $form -> add('radio', 'status', '1', ((isset($data) && $data -> status == 1) ? array("checked" => 'checked') : ""));
		$obj = $form -> add('radio', 'status', '0', ((isset($data) && $data -> status == 0) ? array("checked" => 'checked') : ""));

	}

	public function add() {
		if ($this -> adminuser -> isLoggedIn()) {
			$this -> breadcrumb -> add("Add new page");
			$this -> set('breadcrumb', $this -> breadcrumb -> draw());
			$form = new Zebra_Form('pagesadmin');
			$this -> loadform($form);
			$form -> clientside_validation(false);
			if ($this -> isPost()) {
				if ($form -> validate()) {
					$this -> savedata();
				} else {
					$form -> show_all_error_messages(true);
				}
			}
			$this -> set('form_content', $form -> render(APP_VIEWS . DS . $this -> _controller . DS . "form.php", true));
		} else {
			self::redirectUrl(self::$loginURL);
		}
	}

	public function edit($id) {
		if ($this -> adminuser -> isLoggedIn()) {
			$page = Pages::getInstance() -> find($id);
			$this -> breadcrumb -> add("Edit page \"" . $page -> headline . "\"");
			$this -> set('breadcrumb', $this -> breadcrumb -> draw());
			$form = new Zebra_Form('pagesadmin');
			$this -> loadform($form, Pages::find($id));
			if ($this -> isPost()) {
				if ($form -> validate()) {
					$this -> savedata($id);
				} else {
					$form -> show_all_error_messages(true);
				}
			}
			$this -> set('form_content', $form -> render(APP_VIEWS . DS . $this -> _controller . DS . "form.php", true));
		} else {
			self::redirectUrl(self::$loginURL);
		}
	}

	private function savedata($id = "") {
		$page = (!empty($id) ? Pages::getInstance() ->find($id) : Pages::getInstance());
		if (!empty($id)) {
			$this -> addMessage("Page <i>\"" . $page -> headline . "\"</i> has been updated successfully.");
		} else {
			$this -> addMessage("A new page has been added successfully.");
		}
		$page -> headline = $this -> getParam('headline');
		$page -> body = $this -> getParam('description');
		$page -> status = $this -> getParam('status');
		$page -> save();
		self::redirectUrl('pagesadmin/index');
	}

	public function delete($id = "") {
		if ($this -> adminuser -> isLoggedIn()) {
			$page = Pages::getInstance() ->find($id);
			$this -> addMessage("Page <i>\"" . $page -> headline . "\"</i> has been deleted successfully.");
			$page -> delete();
			self::redirectUrl('pagesadmin/index');
		} else {
			self::redirectUrl(self::$loginURL);
		}
	}

}
?>