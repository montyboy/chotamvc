<?php

class BreadCrumb {
	
	private $list;
	private $sep = "/";
	 
	
	public function __construct(){
		$this->add(SITE_NAME,"/");
	}
	
	public function add($name,$link="#"){
		$this->list[$link] = $name;
	}
	
	public function draw(){
		if(is_array($this->list)){ 
			$data = "<ul class=\"breadcrumb\">";
				foreach($this->list as $key=> $values){
					if($key!="#"){
						$data.= "<li><a href=\"".$key."\">".$values."</a> <span class=\"divider\">".$this->sep."</span></li>";
					}else{
						$data.= "<li class=\"active\">".$values."</li>";
					}	
				}
			$data .="</ul>";
			$data .="<script type=\"text/javascript\">";
			$data .="document.title = '".implode(" - " ,$this->list)."';";
			$data.= "</script>";
			return $data;
		}	
	}
	
	
}