<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class PageDAO extends DataAccessObject {
 
	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }

	 protected function populatePageDO(PageDO $udo, array $row) {
		  
		  if (array_key_exists('PAGEID',$row)) {
		   $udo->setPageid($row['PAGEID']);
		  }
		  if (array_key_exists('NAME',$row)) {
		   $udo->setName($row['NAME']);
		  }
		  if (array_key_exists('URL',$row)) {
		   $udo->setUrl($row['URL']);
		  }
		   if (array_key_exists('RENDERNAME',$row)) {
		   $udo->setRendername($row['RENDERNAME']);
		  }
		  
		  return $udo;
	}
	 
	 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::PageDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populatePageDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
}