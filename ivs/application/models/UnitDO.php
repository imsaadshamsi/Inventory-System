<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class UnitDO extends DataObject {
 
  private $unitid;
  private $site;
  private $unitname;
  private $store;
 
 function __construct($unitid, $site, $unitname) {
	
    $this->unitid = $unitid;
    $this->site = $site;
    $this->unitname = $unitname;
  
 }
 
 
 public function setStore($s) {
	$this->store = $s;
	}
	
	public function getStore() {
		return $this->store;
		}
		
		
  public function getSite() {
    return $this->site;
 }
 
  public function getUnitid() {
    return $this->unitid;
 }
 
  public function getUnitname() {
    return $this->unitname;
 }
 


 public function setSite($a) {
    $this->site = $a;
 }
 
 public function setUnitid($a) {
    $this->unitid = $a;
 }
 
 public function setUnitname($a) {
    $this->unitname = $a;
 }
 

}

