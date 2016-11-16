<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class ShelvingListDO extends DataObject {
 
  private $shelvingid;
  private $shelving;
  private $location;
 
 function __construct($shelvingid, $shelving, $location) {
	
    $this->shelvingid = $shelvingid;
    $this->shelving = $shelving;
    $this->location = $location;
 }

  public function getShelvingid(){
    return $this->shelvingid;
  }

  public function setShelvingid($shelvingid){
    $this->shelvingid = $shelvingid;
  }

  public function getShelving(){
    return $this->shelving;
  }

  public function setShelving($shelving){
    $this->shelving = $shelving;
  }

  public function getLocation(){
    return $this->location;
  }

  public function setLocation($location){
    $this->location = $location;
  }
 

}

