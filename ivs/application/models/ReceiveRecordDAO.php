<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class ReceiveRecordDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateReceiveRecordDO(ReceiveRecordDO $udo, array $row) {
		  
		  if (array_key_exists('ITEMID',$row)) {
		   $udo->setItemid($row['ITEMID']);
		  }

		   if (array_key_exists('QTYRECEIVED',$row)) {
		   $udo->setQtyreceived($row['QTYRECEIVED']);
		  }

		   if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }

		  if (array_key_exists('DATERECEIVED',$row)) {
		   $udo->setDatereceived($row['DATERECEIVED']);
		  }

		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }

		  if (array_key_exists('RECORDUUID',$row)) {
		   $udo->setRecordUUID($row['RECORDUUID']);
		  }
                  
                  if (array_key_exists('STATUS',$row)) {
		   $udo->setStatus($row['STATUS']);
		  }

		  if (array_key_exists('REORDERID',$row)) {
		   $udo->setReorderid($row['REORDERID']);
		  }

		  
	
		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::ReceiveRecordDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateReceiveRecordDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}