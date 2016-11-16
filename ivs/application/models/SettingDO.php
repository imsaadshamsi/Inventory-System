<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class SettingDO extends DataObject {
 

  private $unitid;
  private $settingid;
  private $settingtype;
  private $name;
  private $email;
 
 function __construct($unitid, $settingid, $settingtype, $name, $email) {

    $this->unitid = $unitid;
    $this->settingid = $settingid;
    $this->settingtype = $settingtype;
    $this->name = $name;
    $this->email = $email;
  
 }

  public function getUnitid(){
    return $this->unitid;
  }

  public function setUnitid($unitid){
    $this->unitid = $unitid;
  }

  public function getSettingid(){
    return $this->settingid;
  }

  public function setSettingid($settingid){
    $this->settingid = $settingid;
  }

  public function getSettingtype(){
    return $this->settingtype;
  }

  public function setSettingtype($settingtype){
    $this->settingtype = $settingtype;
  }

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setEmail($email){
    $this->email = $email;
  }
 
  
 

}

