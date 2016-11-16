<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class AssetDAO extends DataAccessObject {

	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }
	 
	 

	protected function populateAssetDO(AssetDO $udo, array $row) {
		  
		  if (array_key_exists('ASSET_ID',$row)) {
		   $udo->setAsset_id($row['ASSET_ID']);
		  }
		  if (array_key_exists('PTAG_CODE',$row)) {
		   $udo->setPtag_code($row['PTAG_CODE']);
		  }
		  if (array_key_exists('OTAG_CODE',$row)) {
		   $udo->setOtag_code($row['OTAG_CODE']);
		  }
		  if (array_key_exists('COMM_CODE',$row)) {
		   $udo->setComm_code($row['COMM_CODE']);
		  }
		  if (array_key_exists('ASSET_DESCR',$row)) {
		   $udo->setAsset_descr($row['ASSET_DESCR']);
		  }
		  if (array_key_exists('SERIAL_NUM',$row)) {
		   $udo->setSerial_num($row['SERIAL_NUM']);
		  }
		  if (array_key_exists('STAT',$row)) {
		   $udo->setStat($row['STAT']);
		  }
		  if (array_key_exists('POHD_CODE',$row)) {
		   $udo->setPohd_code($row['POHD_CODE']);
		  }
		  if (array_key_exists('ORIG_DOC_CODE',$row)) {
		   $udo->setOrig_doc_code($row['ORIG_DOC_CODE']);
		  }
		  		  if (array_key_exists('ACTIVE_DATE',$row)) {
		   $udo->setActive_date($row['ACTIVE_DATE']);
		  }
		  		  if (array_key_exists('CAP',$row)) {
		   $udo->setCap($row['CAP']);
		  }
		  		  if (array_key_exists('CAP_DATE',$row)) {
		   $udo->setCap_date($row['CAP_DATE']);
		  }
		  		  if (array_key_exists('ORGN_RESP',$row)) {
		   $udo->setOrgn_resp($row['ORGN_RESP']);
		  }
		  		  if (array_key_exists('FUND',$row)) {
		   $udo->setFund($row['FUND']);
		  }

		  		  		  if (array_key_exists('ORGN',$row)) {
		   $udo->setOrgn($row['ORGN']);
		  }
		  		  		  if (array_key_exists('LOCN_RESP',$row)) {
		   $udo->setLocn_resp($row['LOCN_RESP']);
		  }
		  		  		  if (array_key_exists('NET_BK_VALUE',$row)) {
		   $udo->setNet_bk_value($row['NET_BK_VALUE']);
		  }
		  		  		  if (array_key_exists('ACCT',$row)) {
		   $udo->setAcct($row['ACCT']);
		  }
		  		  		  if (array_key_exists('ACCT_TITLE',$row)) {
		   $udo->setAcct_title($row['ACCT_TITLE']);
		  }


		  
		  return $udo;
	
	}
	 
	public function next(\DataObject $do = null) {
		  
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::AssetDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateAssetDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	
	}
	 

}