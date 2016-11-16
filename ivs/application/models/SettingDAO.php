<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class SettingDAO extends DataAccessObject {

	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
	 
	
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateSettingDO(SettingDO $udo, array $row) {
		  
		  if (array_key_exists('SETTINGID',$row)) {
		   $udo->setSettingid($row['SETTINGID']);
		  }
		  if (array_key_exists('SETTINGTYPE',$row)) {
		   $udo->setSettingtype($row['SETTINGTYPE']);
		  }
		  if (array_key_exists('NAME',$row)) {
		   $udo->setName($row['NAME']);
		  }
		  if (array_key_exists('EMAIL',$row)) {
		   $udo->setEmail($row['EMAIL']);
		  }
		  if (array_key_exists('UNITID',$row)) {
		   $udo->setUnitid($row['UNITID']);
		  }
		  
		  return $udo;
	}
	 
	 
	 
        	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::SettingDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateSettingDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
}