<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class InventoryDAO extends DataAccessObject {


	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateInventoryDO(InventoryDO $udo, array $row) {
		  
		  if (array_key_exists('INVENTORYID',$row)) {
		   $udo->setInventoryid($row['INVENTORYID']);
		  }
		  if (array_key_exists('NAME',$row)) {
		   $udo->setName($row['NAME']);
		  }
		  if (array_key_exists('DESCRIPTION',$row)) {
		   $udo->setDescription($row['DESCRIPTION']);
		  }
		  if (array_key_exists('CATEGORYID',$row)) {
		   $udo->setCategoryid($row['CATEGORYID']);
		  }
		  if (array_key_exists('STOCKNUMBER',$row)) {
		   $udo->setStocknumber($row['STOCKNUMBER']);
		  }
		  if (array_key_exists('MINIMUMQUANTITY',$row)) {
		   $udo->setMinimumquantity($row['MINIMUMQUANTITY']);
		  }
		  if (array_key_exists('QUANTITYAVAILABLE',$row)) {
		   $udo->setQuantityavailable($row['QUANTITYAVAILABLE']);
		  }
		  if (array_key_exists('FLAG',$row)) {
		   $udo->setFlag($row['FLAG']);
		  }
		  if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }
		  if (array_key_exists('SHELVINGID',$row)) {
		   $udo->setShelvingid($row['SHELVINGID']);
		  }
		  if (array_key_exists('UNITID',$row)) {
		   $udo->setUnitid($row['UNITID']);
		  }
		  if (array_key_exists('STATUS',$row)) {
		   $udo->setStatus($row['STATUS']);
		  }
		  if (array_key_exists('DATEADDED',$row)) {
		   $udo->setDateadded($row['DATEADDED']);
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::InventoryDO);
		  }
		  if ($this->getCurrent_row() < $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateInventoryDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
	 
	

}