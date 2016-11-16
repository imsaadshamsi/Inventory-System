<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class UnitDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateUnitDO(UnitDO $udo, array $row) {
		  
		  if (array_key_exists('UNITID',$row)) {
		   $udo->setUnitid($row['UNITID']);
		  }
		  if (array_key_exists('SITE',$row)) {
		   $udo->setSite($row['SITE']);
		  }
		  if (array_key_exists('UNITNAME',$row)) {
		   $udo->setUnitname($row['UNITNAME']);
		  }
		   if (array_key_exists('STORE',$row)) {
		   $udo->setStore($row['STORE']);
		  }
		  
		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::UnitDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateUnitDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
}