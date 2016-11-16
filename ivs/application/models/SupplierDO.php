<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class SupplierDO extends DataObject {
 
 private $supplierid;
 private $suppliername;
 private $address;
 private $telephone;
 private $email;
 private $contactperson;
 private $dateadded;
 private $unitid;
 private $status;
 private $comments;

 function __construct($supplierid,$suppliername,$address,$telephone,$email, $contactperson, $dateadded, $unitid, $status, $comments) {
	 
   $this->supplierid = $supplierid;
   $this->suppliername = $suppliername;
   $this->address = $address;
   $this->telephone = $telephone;
   $this->email = $email;
   $this->contactperson = $contactperson;
   $this->dateadded = $dateadded;
   $this->unitid = $unitid;
   $this->status = $status;
   $this->comments = $comments;

 }

 public function getSupplierid(){
    return $this->supplierid;
  }

  public function setSupplierid($supplierid){
    $this->supplierid = $supplierid;
  }

  public function getSuppliername(){
    return $this->suppliername;
  }

  public function setSuppliername($suppliername){
    $this->suppliername = $suppliername;
  }

  public function getAddress(){
    return $this->address;
  }

  public function setAddress($address){
    $this->address = $address;
  }

  public function getTelephone(){
    return $this->telephone;
  }

  public function setTelephone($telephone){
    $this->telephone = $telephone;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setEmail($email){
    $this->email = $email;
  }

  public function getContactperson(){
    return $this->contactperson;
  }

  public function setContactperson($contactperson){
    $this->contactperson = $contactperson;
  }

  public function getDateadded(){
    return $this->dateadded;
  }

  public function setDateadded($dateadded){
    $this->dateadded = $dateadded;
  }

  public function getUnitid(){
    return $this->unitid;
  }

  public function setUnitid($unitid){
    $this->unitid = $unitid;
  }

  public function getStatus(){
    return $this->status;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getComments(){
    return $this->comments;
  }

  public function setComments($comments){
    $this->comments = $comments;
  }

 
 

}

