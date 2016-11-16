<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class AttachmentDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populateAttachmentDO(AttachmentDO $udo, array $row) {
		  
		  if (array_key_exists('ATTACHMENTID',$row)) {
		   $udo->setAttachmentid($row['ATTACHMENTID']);
		  }

		  //  if (array_key_exists('ID_FIELD',$row)) {
		  //  $udo->setId_field($row['ID_FIELD']);
		  // }

		   if (array_key_exists('URL',$row)) {
		   $udo->setUrl($row['URL']);
		  }

		  if (array_key_exists('DATEADDED',$row)) {
		   $udo->setDateadded($row['DATEADDED']);
		  }

		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }

		  if (array_key_exists('TYPE',$row)) {
		   $udo->setType($row['TYPE']);
		  }

		  if (array_key_exists('TITLE',$row)) {
		   $udo->setTitle($row['TITLE']);
		  }

		  if (array_key_exists('REORDERID',$row)) {
		   $udo->setReorderid($row['REORDERID']);
		  }

		  // if (array_key_exists('TYPE',$row)) {
		  //  $udo->setType($row['TYPE']);
		  // }


		  
	
		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::AttachmentDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateAttachmentDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}