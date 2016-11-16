<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class Inventory2DO extends DataObject {
 
  private $inventoryid;
  private $name;
  private $unitname;
  private $site;


 
 function __construct($inventoryid, $name) {

  $this->inventoryid = $inventoryid;
  $this->name = $name;
  
 }


  public function getInventoryid(){
    return $this->inventoryid;
  }

  public function setInventoryid($inventoryid){
    $this->inventoryid = $inventoryid;
  }

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function getUnitname(){
    return $this->unitname;
  }

  public function setUnitname($unitname){
    $this->unitname = $unitname;
  }

  public function getSite(){
    return $this->site;
  }

  public function setSite($site){
    $this->site = $site;
  }

  

}

