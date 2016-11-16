<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class LocationDAO extends DataAccessObject {


         
         function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
	 
	 
	 
	
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateLocationDO(LocationDO $udo, array $row) {
		  
		  if (array_key_exists('LOCATIONID',$row)) {
		   $udo->setLocationid($row['LOCATIONID']);
		  }
		  if (array_key_exists('LOCATION',$row)) {
		   $udo->setLocation($row['LOCATION']);
		  }
		  if (array_key_exists('DESCRIPTION',$row)) {
		   $udo->setDescription($row['DESCRIPTION']);
		  }
		  if (array_key_exists('LOCATIONCODE',$row)) {
		   $udo->setLocationcode($row['LOCATIONCODE']);
		  }

		  return $udo;
	}
	 
	
           public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::LocationDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateLocationDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}