<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class QuoteDAO extends DataAccessObject {

	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
	 

	 protected function populateQuoteDO(QuoteDO $udo, array $row) {
		  
		  if (array_key_exists('REORDERID',$row)) {
		   $udo->setReorderid($row['REORDERID']);
		  }

		   if (array_key_exists('QUOTEID',$row)) {
		   $udo->setQuoteid($row['QUOTEID']);
		  }

		   if (array_key_exists('TITLE',$row)) {
		   $udo->setTitle($row['TITLE']);
		  }

		   if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }

		   if (array_key_exists('SELECTED',$row)) {
		   $udo->setSelected($row['SELECTED']);
		  }
		  
		  
		  if (array_key_exists('QUOTEURL',$row)) {
		   $udo->setQuoteurl($row['QUOTEURL']);
		  }

		 if (array_key_exists('QUOTEAMOUNT',$row)) {
		   $udo->setQuoteamount($row['QUOTEAMOUNT']);
		  }

		  if (array_key_exists('SUPPLIERID',$row)) {
		   $udo->setSupplierid($row['SUPPLIERID']);
		  }

		  if (array_key_exists('DELIVERYDATE',$row)) {
		   $udo->setDeliverydate($row['DELIVERYDATE']);
		  }
		  
		  if (array_key_exists('NOTE',$row)) {
		   $udo->setNote($row['NOTE']);
		  }



		  

		 

		  return $udo;
	}
	 
	 
		 
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::QuoteDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateQuoteDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }

}