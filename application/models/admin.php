<?php

class admin extends Model {

    protected $user = null;
    protected $credentials = null;
    protected $islogged = false;
	
	public function login($username="",$password="",$captcha="") {
		
	}
	
	public function logout() {
		
	}
	
	public function isLoggedIn() {
		return $this->islogged;
	}
	
	private function validateCaptcha(){
		
	}
	
	public function getUser(){
		
	}
	
	public function isSuperUser(){
		
	}
	

}
