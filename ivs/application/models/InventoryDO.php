<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class InventoryDO extends DataObject {
 
  private $inventoryid;
  private $shelvingid;
  private $quantityavailable;
  private $minimumquantity;
  private $flag;
  private $status;
  private $stocknumber;
  private $name;
  private $description;
  private $unitid;
  private $categoryid;
  private $comments;
  private $dateadded;
 
 function __construct($inventoryid, $unitid, $categoryid, $shelvingid, $minimumquantity, $quantityavailable, $flag, $status, $stocknumber, $name, $comments, $description) {
	
    $this->inventoryid = $inventoryid;
    $this->description = $description;
    $this->unitid = $unitid;
    $this->shelvingid = $shelvingid;
    $this->quantityavailable = $quantityavailable;
    $this->minimumquantity = $minimumquantity;
    $this->flag = $flag;
    $this->status = $status;
    $this->stocknumber = $stocknumber;
    $this->name = $name;
    $this->categoryid = $categoryid;
    $this->comments = $comments;
  
 }

  public function getDateadded(){
    return $this->dateadded;
  }

  public function setDateadded($dateadded){
    $this->dateadded = $dateadded;
  }

 public function getInventoryid(){
    return $this->inventoryid;
  }

  public function setInventoryid($inventoryid){
    $this->inventoryid = $inventoryid;
  }

  public function getShelvingid(){
    return $this->shelvingid;
  }

  public function setShelvingid($shelvingid){
    $this->shelvingid = $shelvingid;
  }

  public function getQuantityavailable(){
    return $this->quantityavailable;
  }

  public function setQuantityavailable($quantityavailable){
    $this->quantityavailable = $quantityavailable;
  }

  public function getMinimumquantity(){
    return $this->minimumquantity;
  }

  public function setMinimumquantity($minimumquantity){
    $this->minimumquantity = $minimumquantity;
  }

  public function getFlag(){
    return $this->flag;
  }

  public function setFlag($flag){
    $this->flag = $flag;
  }

  public function getStatus(){
    return $this->status;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getStocknumber(){
    return $this->stocknumber;
  }

  public function setStocknumber($stocknumber){
    $this->stocknumber = $stocknumber;
  }

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function getDescription(){
    return $this->description;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function getUnitid(){
    return $this->unitid;
  }

  public function setUnitid($unitid){
    $this->unitid = $unitid;
  }

  public function getCategoryid(){
    return $this->categoryid;
  }

  public function setCategoryid($categoryid){
    $this->categoryid = $categoryid;
  }

  public function getComments(){
    return $this->comments;
  }

  public function setComments($comments){
    $this->comments = $comments;
  }

}

