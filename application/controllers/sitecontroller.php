<?php

/**
 * Represent the Site controller
 * 
 */


class siteController extends Controller {
	
	function index() {

    }

    function test(){
		
		
    }
	
	public function logincaptcha(){
		$image = ImageCreateFromJPEG("cms/images/code.jpg");
		$text_color = ImageColorAllocate($image, 0, 0, 0);
		$code = substr(rand(),0,5);
		Header("Content-type: image/jpeg");
		$code = substr(md5($code),0,5);
		Core::setAttr('randCode', $code);
		ImageString ($image, 5, 30, 5, $code, $text_color);
		ImageJPEG($image, '', 100);
		ImageDestroy($image);
		die();
	}
}

?>