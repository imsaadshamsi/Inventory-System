<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class SupplierDAO extends DataAccessObject {

	 
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
	 

	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateSupplierDO(SupplierDO $udo, array $row) {
		  
		  if (array_key_exists('SUPPLIERID',$row)) {
		   $udo->setSupplierid($row['SUPPLIERID']);
		  }
		  if (array_key_exists('SUPPLIERNAME',$row)) {
		   $udo->setSuppliername($row['SUPPLIERNAME']);
		  }
		  if (array_key_exists('ADDRESS',$row)) {
		   $udo->setAddress($row['ADDRESS']);
		  }
		  if (array_key_exists('TELEPHONE',$row)) {
		   $udo->setTelephone($row['TELEPHONE']);
		  }
		  if (array_key_exists('EMAIL',$row)) {
		   $udo->setEmail($row['EMAIL']);
		  }
		  if (array_key_exists('CONTACTPERSON',$row)) {
		   $udo->setContactperson($row['CONTACTPERSON']);
		  }
		  if (array_key_exists('STATUS',$row)) {
		   $udo->setStatus($row['STATUS']);
		  }
		  if (array_key_exists('DATEADDED',$row)) {
		   $udo->setDateadded($row['DATEADDED']);
		  }
		  if (array_key_exists('UNITID',$row)) {
		   $udo->setUnitid($row['UNITID']);
		  }
		  if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }
		  
		  return $udo;
	}
	 
	 

         
          public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::SupplierDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateSupplierDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
	 
	 
	

}