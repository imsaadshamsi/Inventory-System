<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of UserDO
 * user data object
 * @author user
 */
class PageDO extends DataObject {


    private $pageid;
    private $name;
    private $url;
    private $rendername;

 function __construct($pageid, $name, $url, $rendername) {


     $this->pageid = $pageid;
     $this->name = $name;
     $this->url = $url;
     $this->rendername = $rendername;
    }
    
    
    public function getPageid(){
		return $this->pageid;
	}

	public function setPageid($pageid){
		$this->pageid = $pageid;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getUrl(){
		return $this->url;
	}

	public function setUrl($url){
		$this->url = $url;
	}

	public function getRendername(){
		return $this->rendername;
	}

	public function setRendername($rendername){
		$this->rendername = $rendername;
	}
    
 
 
	

}

/* End of file UserDO.php */
/* Location: /UserDO.php */