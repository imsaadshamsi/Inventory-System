<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class DisbursementHistoryDAO extends DataAccessObject {

 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

         
         
	 protected function populateDisbursementRecordDO(DisbursementRecordDO2 $udo, array $row) {
		  

		 if (array_key_exists('DISBURSEMENTUUID',$row)) {
		   $udo->setDisbursementuuid($row['DISBURSEMENTUUID']);
		  }
		  if (array_key_exists('QUANTITYDISBURSED',$row)) {
		   $udo->setQuantity_disbursed($row['QUANTITYDISBURSED']);
		  }
		  if (array_key_exists('DATEDISBURSED',$row)) {
		   $udo->setDate_disbursed($row['DATEDISBURSED']);
		  }
		  if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }
		  if (array_key_exists('CODE',$row)) {
		   $udo->setCode($row['CODE']);
		  }
		  if (array_key_exists('USERID',$row)) {
		   $udo->setUser_id($row['USERID']);
		  }
		  if (array_key_exists('STATUS',$row)) {
		   $udo->setStatus($row['STATUS']);
		  }
		  if (array_key_exists('REQUESTID',$row)) {
		   $udo->setRequestid($row['REQUESTID']);
		  }
		  if (array_key_exists('REQUESTEDITEMID',$row)) {
		   $udo->setRequested_item_id($row['REQUESTEDITEMID']);
		  }
                  
                  if (array_key_exists('UNITNAME',$row)) {
		   $udo->setUnitname($row['UNITNAME']);
		  }
                  
                  
		  return $udo;
	}
	 
	 
	 /**
	  * gets the next record from the result set and populates the passed UserDO 
	  * (a UserDO is created if it is null). 
	  * @param \DataObject $do
	  * @return \UserDO if no more results are avaialble return empty DO.
	  */
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::DisbursementRecordDO2);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateDisbursementRecordDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }


}