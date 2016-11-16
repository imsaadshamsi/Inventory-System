<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class RequestedItemDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateRequestedItemDO(RequestedItemDO $udo, array $row) {
		  
		  if (array_key_exists('REQUESTEDITEMID',$row)) {
		   $udo->setRequested_item_id($row['REQUESTEDITEMID']);
		  }
		  
		  if (array_key_exists('INVENTORYID',$row)) {
		   $udo->setInventory_id($row['INVENTORYID']);
		  }
		  
		  if (array_key_exists('REQUESTID',$row)) {
		   $udo->setRequest_id($row['REQUESTID']);
		  }


		  if (array_key_exists('REASONFORREQUEST',$row)) {
		   $udo->setReason_for_request($row['REASONFORREQUEST']);
		  }
		
		  if (array_key_exists('QUANTITYREQUESTED',$row)) {
		   $udo->setQuantity_requested($row['QUANTITYREQUESTED']);
		  }

		  if (array_key_exists('QUANTITYREQUESTEDREMAINING',$row)) {
		   $udo->setQuantity_requested_remaining($row['QUANTITYREQUESTEDREMAINING']);
		  }
		


		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateRequestedItemDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}