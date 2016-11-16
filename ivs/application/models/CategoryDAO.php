<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class CategoryDAO extends DataAccessObject {

	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
	 


	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateCategoryDO(CategoryDO $udo, array $row) {
		  
		  if (array_key_exists('CATEGORYID',$row)) {
		   $udo->setCategoryid($row['CATEGORYID']);
		  }
		  if (array_key_exists('CATEGORY',$row)) {
		   $udo->setCategory($row['CATEGORY']);
		  }
		  if (array_key_exists('DESCRIPTION',$row)) {
		   $udo->setDescription($row['DESCRIPTION']);
		  }
		  
		  return $udo;
	}
	 
	   public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::CategoryDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateCategoryDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 

}