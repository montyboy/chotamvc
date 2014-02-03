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

  private function loadform(&$form,$data=null){
    $this->addCss("/zebra_form/css/zebra_form.css");
    $this->addJs("/zebra_form/javascript/zebra_form.js");
    $this->addJs("/ckeditor/ckeditor.js");

    /* Headline field */
    $form->add('label', 'label_headline', 'headline', 'Headline');
    $obj = $form->add('text', 'headline', (isset($data)? $data->headline: ""),
      array('autocomplete' => 'off', 'class' => 'input-xxlarge', 'size' => '90', 'placeholder' => "Headline")
    );
    $obj->set_rule(array(
      'required'  =>  array('error', 'Headline is required')
    ));


    /* Description field */
    $form->add('label', 'label_description', 'label_description', 'Description');
    $obj = $form->add('textarea', 'description', (isset($data)? $data->body: ""),
      array('autocomplete' => 'off', 'class' => 'ckeditor',)
    );
    $obj->set_rule(array(
      'required'  =>  array('error', 'Description is required')
    ));

    /* Description field */
    $form->add('label', 'label_status', 'label_status', 'Set the page state as');
    $obj = $form->add('radio', 'status', '1',((isset($data) && $data->status==1)? "Checked" : ""));
    $obj = $form->add('radio', 'status', '0',((isset($data) && $data->status==0)? "Checked" : ""));

    return $form->render(APP_VIEWS.DS.$this->_controller.DS."form.php" ,true);
  }
	
	public function add(){
		if($this->adminuser->isLoggedIn()){
      $this->breadcrumb->add("Add new page");
			$this->set('breadcrumb',$this->breadcrumb->draw());
      $form = new Zebra_Form('pagesadmin');
      if($this->isPost() && $form->validate()){
          $this->savedata();
      }
      $this->set('form_content',$this->loadform($form));
		}else{
			self::redirectUrl(self::$loginURL);
		}
	}
	
	public function edit($id){
		if($this->adminuser->isLoggedIn()){
			$page = Pages::getInstance()->find($id);
			$this->breadcrumb->add("Edit page \"".$page->headline."\"");
			$this->set('breadcrumb',$this->breadcrumb->draw());
      $form = new Zebra_Form('pagesadmin');
      if($this->isPost() && $form->validate()){
        $this->savedata();
      }
      $this->set('form_content',$this->loadform($form,Pages::find($id)));
		}else{
			self::redirectUrl(self::$loginURL);
		}
	}
	
	private function savedata($id=""){
    $pageObj = (!empty($id) ? Pages::find($id): new Pages);
    $pageObj->headline = $this->getParam('headline');
    $pageObj->body = $this->getParam('description');
    $pageObj->status = $this->getParam('status');
    $pageObj->save();
    self::redirectUrl('pagesadmin/index');
	}
	
	public function delete(){
		
	}
}

?>