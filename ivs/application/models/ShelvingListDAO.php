<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class ShelvingListDAO extends DataAccessObject {

	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
         

	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateShelvingListDO(ShelvingListDO $udo, array $row) {
		  
		  if (array_key_exists('SHELVINGID',$row)) {
		   $udo->setShelvingid($row['SHELVINGID']);
		  }
		  if (array_key_exists('SHELVING',$row)) {
		   $udo->setShelving($row['SHELVING']);
		  }
		  if (array_key_exists('LOCATION',$row)) {
		   $udo->setLocation($row['LOCATION']);
		  }

		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::ShelvingListDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateShelvingListDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}