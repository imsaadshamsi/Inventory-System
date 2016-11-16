<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class LogDO extends DataObject {
 
private $querytype;
private $tablename;
private $fieldname;
private $fieldvalue;
private $date;
private $userid;
private $unitid;
private $logguuid;

private $idfield;
private $idfieldvalue;

 
 function __construct($querytype, $tablename, $fieldname, $fieldvalue, $date, $userid, $unitid, $loguuid, $idfield, $idfieldvalue) {
	
     $this->setQuerytype($querytype);
     $this->setDate($date);
     $this->setTablename($tablename);
     $this->setFieldname($fieldname);
     $this->setFieldvalue($fieldvalue);
     $this->setUnitid($unitid);
     $this->setUserid($userid);
     $this->setLogguuid($loguuid);
     $this->idfield = $idfield;
     $this->idfieldvalue = $idfieldvalue;
     
 }
 
 	public function getIdfield(){
		return $this->idfield;
	}

	public function setIdfield($idfield){
		$this->idfield = $idfield;
	}

	public function getIdfieldvalue(){
		return $this->idfieldvalue;
	}

	public function setIdfieldvalue($idfieldvalue){
		$this->idfieldvalue = $idfieldvalue;
	}


 
 public function getQuerytype(){
		return $this->querytype;
}

	public function setQuerytype($querytype){
		$this->querytype = $querytype;
	}

	public function getTablename(){
		return $this->tablename;
	}

	public function setTablename($tablename){
		$this->tablename = $tablename;
	}

	public function getFieldname(){
		return $this->fieldname;
	}

	public function setFieldname($fieldname){
		$this->fieldname = $fieldname;
	}

	public function getFieldvalue(){
		return $this->fieldvalue;
	}

	public function setFieldvalue($fieldvalue){
		$this->fieldvalue = $fieldvalue;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function getUserid(){
		return $this->userid;
	}

	public function setUserid($userid){
		$this->userid = $userid;
	}

	public function getUnitid(){
		return $this->unitid;
	}

	public function setUnitid($unitid){
		$this->unitid = $unitid;
	}

	public function getLogguuid(){
		return $this->logguuid;
	}

	public function setLogguuid($logguuid){
		$this->logguuid = $logguuid;
	}

  

}

