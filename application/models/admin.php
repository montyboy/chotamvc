<?php
/*
 * Admin model which is used for managing the main website
 */

class admin extends ActiveRecord\Model {

	protected $user = null;

	static $Instance;

	// explicit table name since our table is not "admin"
	static $table_name = 'admin';

	// explicit pk since our pk is not "id"
	static $primary_key = 'id';

	public static function getInstance($loggedin=false) {
		if (!self::$Instance) {
			self::$Instance = new admin;
			if ($loggedin && self::$Instance -> getUser()) {
				return self::$Instance -> getUser();
			}
		}
		return self::$Instance;
	}

	public function validatelogin($username = "", $password = "", $captcha = "") {
		$this -> user = admin::find('first', array('conditions' => array('username = ?', $username)));
		if (isset($this -> user) && $this -> user -> password == md5($password)) {
			if ($this -> validateCaptcha($captcha)) {
				Core::setAttr('user', $this -> user);
				$this -> user -> updateLastLogin();
				return;
			} else {
				return "Invalid captcha code";
			}
		}

		return "Invalid login details";

	}

	public function logout() {
		Core::clearAttr('user');
	}

	public function isLoggedIn() {
		if ($this -> getUser()) {
			return true;
		}
		return false;
	}

	private function validateCaptcha($captcha) {
		if (Core::getAttr('randCode') == $captcha) {
			return true;
		}
		return false;
	}

	public function getUser() {
		return Core::getAttr('user');
	}

	private function updateLastLogin() {
		$this -> last_login = date('Y-m-d H:i:s');
		$this -> save();
	}

	public function changePassword() {

	}
	
	public function updateProfile(){
		
	}

}
