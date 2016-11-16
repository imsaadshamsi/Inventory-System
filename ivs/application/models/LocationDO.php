<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class LocationDO extends DataObject {
 
  private $locationid;
  private $location;
  private $description;
  private $locationcode;
  private $unitid;
 
 function __construct($locationid, $location, $description, $locationcode,$unitid) {
	
    $this->locationid = $locationid;
    $this->location = $location;
    $this->description = $description;
    $this->locationcode = $locationcode;
    $this->unitid = $unitid;
  
 }

   public function getUnitid(){
    return $this->unitid;
  }

  public function setUnitid($unitid){
    $this->unitid = $unitid;
  }

 
  public function getLocation() {
    return $this->location;
 }
 
  public function getLocationid() {
    return $this->locationid;
 }
 
  public function getDescription() {
    return $this->description;
 }
 


 public function setLocation($a) {
    $this->location = $a;
 }
 
 public function setLocationid($a) {
    $this->locationid = $a;
 }
 
 public function setDescription($a) {
    $this->description = $a;
 }

  public function getLocationcode(){
    return $this->locationcode;
  }

  public function setLocationcode($locationcode){
    $this->locationcode = $locationcode;
  }
 

}

