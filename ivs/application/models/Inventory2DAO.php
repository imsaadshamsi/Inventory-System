<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class Inventory2DAO extends DataAccessObject {




		 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 
	 
         	//   /**
	//   * populate a userdo from a row from the result set
	//   * @param UserDO $udo
	//   * @param array $row
	//   * @return \UserDO
	//   */
	  protected function populateInventoryDO(Inventory2DO $udo, array $row) {
		  
		  if (array_key_exists('INVENTORYID',$row)) {
		   $udo->setInventoryid($row['INVENTORYID']);
		  }
		  if (array_key_exists('SITE',$row)) {
		   $udo->setSite($row['SITE']);
		  }
		  if (array_key_exists('UNITNAME',$row)) {
		   $udo->setUnitname($row['UNITNAME']);
		  }
		  if (array_key_exists('NAME',$row)) {
	 	   $udo->setName($row['NAME']);
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::Inventory2DO);
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