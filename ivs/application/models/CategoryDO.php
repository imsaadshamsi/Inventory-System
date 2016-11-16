<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class CategoryDO extends DataObject {
 
  private $categoryid;
  private $category;
  private $description;
  private $unitid;
 
 function __construct($categoryid, $category, $description, $unitid) {
	
    $this->categoryid = $categoryid;
    $this->category = $category;
    $this->description = $description;
    $this->unitid = $unitid;
  
 }

  public function getUnitid(){
    return $this->unitid;
  }

  public function setUnitid($unitid){
    $this->unitid = $unitid;
  }
 
  public function getCategory() {
    return $this->category;
 }
 
  public function getCategoryid() {
    return $this->categoryid;
 }
 
  public function getDescription() {
    return $this->description;
 }
 


 public function setCategory($a) {
    $this->category = $a;
 }
 
 public function setCategoryid($a) {
    $this->categoryid = $a;
 }
 
 public function setDescription($a) {
    $this->description = $a;
 }
 

}

