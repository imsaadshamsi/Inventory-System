<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class ReorderItemsDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateReorderItemDO(ReorderItemDO $udo, array $row) {
		  
		  if (array_key_exists('ITEMID',$row)) {
		   $udo->setItemid($row['ITEMID']);
		  }

		   if (array_key_exists('QUANTITY',$row)) {
		   $udo->setQuantity($row['QUANTITY']);
		  }

		   if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }

		  if (array_key_exists('INVENTORYID',$row)) {
		   $udo->setInventory_id($row['INVENTORYID']);
		  }
	
		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::ReorderItemDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateReorderItemDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}