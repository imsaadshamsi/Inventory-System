<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class ShelvingDO extends DataObject {
 
  private $shelvingid;
  private $shelving;
  private $description;
  private $locationid;
  private $location;
 
 function __construct($shelvingid, $shelving, $description, $locationid) {
	
    $this->shelvingid = $shelvingid;
    $this->shelving = $shelving;
    $this->description = $description;
    $this->locationid = $locationid;
 }
 
 public function setLocation($l) {
     $this->location = $l;
 }
 
 public function getLocation() {
     return $this->location;
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

  public function getDescription(){
    return $this->description;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function getLocationid(){
    return $this->locationid;
  }

  public function setLocationid($locationid){
    $this->locationid = $locationid;
  }
 

}

