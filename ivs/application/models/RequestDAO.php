<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class RequestDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateRequestDO(RequestDO $udo, array $row) {
		  
		  if (array_key_exists('REQUESTID',$row)) {
		   $udo->setRequest_id($row['REQUESTID']);
		  }
		  
		  if (array_key_exists('REQUESTORID',$row)) {
		   $udo->setRequestor_id($row['REQUESTORID']);
		  }

		  if (array_key_exists('STATUS',$row)) {
		   $udo->setStatus($row['STATUS']);
		  }
		
		  if (array_key_exists('UNITID',$row)) {
		   $udo->setUnit_id($row['UNITID']);
		  }

		  if (array_key_exists('DATERECEIVED',$row)) {
		   $udo->setDate_received($row['DATERECEIVED']);
		  }
		
		  if (array_key_exists('PRIORITY',$row)) {
		   $udo->setPriority($row['PRIORITY']);
		  }

		  if (array_key_exists('DESCRIPTION',$row)) {
		   $udo->setDescription($row['DESCRIPTION']);
		  }

		  if (array_key_exists('TITLE',$row)) {
		   $udo->setTitle($row['TITLE']);
		  }
		  
		   if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }

		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }
                  
                  if (array_key_exists('ONBEHALF',$row)) {
		   $udo->setOnbehalf($row['ONBEHALF']);
		  }

		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::RequestDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateRequestDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}