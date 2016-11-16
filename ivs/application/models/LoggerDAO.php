<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class LoggerDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateLogDO(LogDO $udo, array $row) {
		  
		  if (array_key_exists('LOGGUUID',$row)) {
		   $udo->setLoguuid($row['LOGGUUID']);
		  }
		  if (array_key_exists('TABLENAME',$row)) {
		   $udo->setTablename($row['TABLENAME']);
		  }
		  if (array_key_exists('FIELDNAME',$row)) {
		   $udo->setFieldname($row['FIELDNAME']);
		  }
                  
                   if (array_key_exists('FIELDVALUE',$row)) {
		   $udo->setFieldvalue($row['FIELDVALUE']);
		  }
                  
		   if (array_key_exists('IDFIELD',$row)) {
		   $udo->setIdfield($row['IDFIELD']);
		  }
                  
                  if (array_key_exists('IDFIELDVALUE',$row)) {
		   $udo->setIdfieldvalue($row['IDFIELDVALUE']);
		  }
		  
                  if (array_key_exists('QUERYTYPE',$row)) {
		   $udo->setQuerytype($row['QUERYTYPE']);
		  }
                  
                  if (array_key_exists('DATE',$row)) {
		   $udo->setDate($row['DATE']);
		  }
                  
                   if (array_key_exists('UNITID',$row)) {
		   $udo->setUnitid($row['UNITID']);
		  }
                  
                   if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }
		  
		  
		  
		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::LogDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateLogDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
}