<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of DOFactory
 * factory for the data objects
 * @author kpersadsingh
 */
class DOFactory {


 public static $instance = null;
 
 private function __construct() { }
 
 public static function getInstance() {
  if (!isset(self::$instance)) {
   self::$instance = new DOFactory();
  }
  return self::$instance;
 }
 
 /**
  * checks that the parametes passed are the ones required to create a DO
  * If the required values are not passed, the default value is set
  * returns an array containing the parameters to instantiate the DO with
  * 
  * @param array $pParams
  * @param array $pReqParams
  * @param array $pDefaults
  * @return array
  */
 private function checkParameters (array $pParams, array $pReqParams, array $pDefaults) {
  if (isset($pParams)) {
   $arr = $pDefaults;
   foreach ($pParams as $key => $keyValue) {
    if (in_array($key, $pReqParams)) {
     $arr[$key] = $keyValue;
    }
   }
   
   return $arr;
  }
  else { //null passed so create with defaults
   return $pDefaults;
  }
 }
 
 /**
  * create DOs, $pDO is the DO to be created (integer)
  * $pParams is an array containing parameters to pass to DO
  * 
  * @param integer $pDO
  * @param array $pParams
  * @return a data object
  */
 public function createDO($pDO, array $pParams = null) {
  if (is_null($pParams)) {
   $pParams = array();
  }
  switch ($pDO) {
 
    case DOEnum::UserDO:
      $vParams = $this->checkParameters($pParams, array('ROLEID', 'USERID','USERNAME','LDAPUSERCODE','USERACTIVE','ISADMIN','UNITID', 'USERTYPE', 'EMAIL', 'STAFFNAME', 'SITE'), array('ROLEID'=>0, 'USERID'=>0,'USERNAME'=>'','LDAPUSERCODE'=>'','USERACTIVE'=>0,'ISADMIN'=>0,'UNITID'=>0,'USERTYPE'=>'',  'EMAIL'=>'', 'STAFFNAME'=>'', 'SITE'=>0));
      $vDO = new UserDO($vParams['USERID'],$vParams['USERNAME'],$vParams['LDAPUSERCODE'],$vParams['USERACTIVE'],$vParams['ISADMIN'],$vParams['UNITID'],$vParams['USERTYPE'], $vParams['EMAIL'], $vParams['STAFFNAME'], $vParams['SITE'], $vParams['ROLEID']);
    break;

    case DOEnum::CategoryDO:
      $vParams = $this->checkParameters($pParams, array('CATEGORYID','CATEGORY','DESCRIPTION', 'UNITID'), array('CATEGORYID'=>0,'CATEGORY'=>'','DESCRIPTION'=>'', 'UNITID'=>0));
      $vDO = new CategoryDO($vParams['CATEGORYID'],$vParams['CATEGORY'],$vParams['DESCRIPTION'],$vParams['UNITID']);
    break;

    case DOEnum::LocationDO:
      $vParams = $this->checkParameters($pParams, array('LOCATIONID', 'LOCATION', 'LOCATIONCODE','DESCRIPTION', 'UNITID'), array('LOCATIONID'=>0, 'LOCATION'=>'', 'LOCATIONCODE'=>'','DESCRIPTION'=>'', 'UNITID'=>0));
      $vDO = new LocationDO($vParams['LOCATIONID'],$vParams['LOCATION'],$vParams['DESCRIPTION'],$vParams['LOCATIONCODE'],$vParams['UNITID']);
    break;

    case DOEnum::UnitDO:
      $vParams = $this->checkParameters($pParams, array('UNITID','SITE','UNITNAME'), array('UNITID'=>0,'SITE'=>'','UNITNAME'=>''));
      $vDO = new UnitDO($vParams['UNITID'],$vParams['SITE'],$vParams['UNITNAME']);
    break;


    case DOEnum::LogDO:
      $vParams = $this->checkParameters($pParams, array('LOGUUID', 'TABLENAME', 'QUERYTYPE', 'FIELDNAME', 'FIELDVALUE', 'IDFIELD', 'IDFIELDVALUE', 'DATE', 'UNITID', 'USERID'), array('LOGUUID'=>'', 'TABLENAME'=>'', 'QUERYTYPE'=>'', 'FIELDNAME'=>'', 'FIELDVALUE'=>'', 'IDFIELD'=>'', 'IDFIELDVALUE'=>'', 'DATE'=>'', 'UNITID'=>'', 'USERID'=>''));
      $vDO = new LogDO($vParams['QUERYTYPE'], $vParams['TABLENAME'],$vParams['FIELDNAME'], $vParams['FIELDVALUE'], $vParams['DATE'], $vParams['USERID'],  $vParams['UNITID'],  $vParams['LOGUUID'],$vParams['IDFIELD'], $vParams['IDFIELDVALUE']);
    break;

 case DOEnum::PageDO:
      $vParams = $this->checkParameters($pParams, array('PAGEID', 'NAME', 'URL', 'RENDERNAME'), array('PAGEID'=>0, 'NAME'=>'', 'URL'=>'', 'RENDERNAME'=>''));
      $vDO = new PageDO($vParams['PAGEID'],$vParams['NAME'],$vParams['URL'], $vParams['RENDERNAME']);
    break;

    case DOEnum::SupplierDO:
      $vParams = $this->checkParameters($pParams, array('SUPPLIERID', 'SUPPLIERNAME', 'ADDRESS', 'TELEPHONE', 'EMAIL', 'CONTACTPERSON', 'STATUS', 'DATEADDED', 'UNITID', 'COMMENTS'), array('SUPPLIERID'=>0, 'SUPPLIERNAME'=>'', 'ADDRESS'=>'', 'TELEPHONE'=>'', 'EMAIL'=>'', 'CONTACTPERSON'=>'', 'STATUS'=>'', 'DATEADDED'=>'', 'UNITID'=>0, 'COMMENTS'=>''));
      $vDO = new SupplierDO($vParams['SUPPLIERID'],$vParams['SUPPLIERNAME'],$vParams['ADDRESS'],$vParams['TELEPHONE'],$vParams['EMAIL'],$vParams['CONTACTPERSON'],$vParams['DATEADDED'],$vParams['UNITID'],$vParams['STATUS'],$vParams['COMMENTS']);
    break;

    case DOEnum::ShelvingDO:
      $vParams = $this->checkParameters($pParams, array('SHELVINGID', 'SHELVING', 'DESCRIPTION', 'LOCATIONID'), array('SHELVINGID'=>0, 'SHELVING'=>'', 'DESCRIPTION'=>'', 'LOCATIONID'=>0));
      $vDO = new ShelvingDO($vParams['SHELVINGID'],$vParams['SHELVING'],$vParams['DESCRIPTION'],$vParams['LOCATIONID']);
    break;

    case DOEnum::InventoryDO:
      $vParams = $this->checkParameters($pParams, array('INVENTORYID', 'CATEGORYID', 'SHELVINGID', 'UNITID', 'FLAG', 'STATUS', 'STOCKNUMBER', 'NAME', 'DESCRIPTION', 'COMMENTS', 'QUANTITYAVAILABLE', 'MINIMUMQUANTITY'), array('INVENTORYID'=>0, 'CATEGORYID'=>0,'SHELVINGID'=>0, 'UNITID'=>0,'FLAG'=>2, 'STATUS'=>'', 'STOCKNUMBER'=>0, 'NAME'=>'', 'DESCRIPTION'=>'', 'COMMENTS'=>'', 'QUANTITYAVAILABLE'=>0, 'MINIMUMQUANTITY'=>0));
      $vDO = new InventoryDO($vParams['INVENTORYID'],$vParams['UNITID'],$vParams['CATEGORYID'],$vParams['SHELVINGID'],$vParams['MINIMUMQUANTITY'],$vParams['QUANTITYAVAILABLE'],$vParams['FLAG'],$vParams['STATUS'],$vParams['STOCKNUMBER'],$vParams['NAME'],$vParams['COMMENTS'],$vParams['DESCRIPTION']);
    break;

    case DOEnum::RequestDO:
      $vParams = $this->checkParameters($pParams, array('ONBEHALF', 'REQUESTID', 'UNITID', 'TITLE', 'REQUESTORID', 'DATERECEIVED',  'DESCRIPTION', 'PRIORITY', 'STATUS','COMMENTS', 'USERID'), array('ONBEHALF'=>0,'REQUESTID'=>0,  'STATUS'=>'', 'UNITID'=>0, 'REQUESTORID'=>0, 'TITLE'=>'', 'DATERECEIVED'=>'', 'DESCRIPTION'=>'', 'PRIORITY'=>0,'COMMENTS'=>'','USERID'=>''));
      $vDO = new RequestDO($vParams['REQUESTID'], $vParams['UNITID'], $vParams['TITLE'],  $vParams['REQUESTORID'], $vParams['DATERECEIVED'],  $vParams['DESCRIPTION'], $vParams['PRIORITY'], $vParams['STATUS'], $vParams['COMMENTS'], $vParams['ONBEHALF'], $vParams['USERID']);
    break;

//    case DOEnum::ShelvingListDO:
//      $vParams = $this->checkParameters($pParams, array('SHELVINGID', 'SHELVING', 'LOCATION'), array('SHELVINGID'=>0, 'SHELVING'=>'','LOCATION'=>''));
//      $vDO = new ShelvingListDO($vParams['SHELVINGID'],$vParams['SHELVING'],$vParams['LOCATION']);
//    break;

    case DOEnum::ReorderDO:
      $vParams = $this->checkParameters($pParams, array('DESCRIPTION', 'REORDERID',  'STATUS', 'DATEINITIATED' ,'USERID', 'UNITID', 'COMMENTS' ), array( 'REORDERID'=>0,  'STATUS'=>'', 'COMMENTS'=>'', 'DESCRIPTION'=>'', 'USERID'=>0, 'UNITID'=>0, 'DATEINITIATED'=>''));
      $vDO = new ReorderDO($vParams['REORDERID'], $vParams['DESCRIPTION'],  $vParams['STATUS'], $vParams['DATEINITIATED'], $vParams['USERID'], $vParams['UNITID']);
    break;

    case DOEnum::ReceiveRecordDO: 
      $vParams = $this->checkParameters($pParams, array('REORDERID', 'RECORDUUID', 'ITEMID', 'USERID', 'QTYRECEIVED', 'DATERECEIVED'), array('REORDERID'=>0, 'RECORDUUID'=>'', 'ITEMID'=>0, 'USERID'=>0, 'QTYRECEIVED'=>0, 'DATERECEIVED'=>''));
      $vDO = new ReceiveRecordDO($vParams['RECORDUUID'], $vParams['ITEMID'], $vParams['USERID']);
    break;

    case DOEnum::ReorderItemDO:
      $vParams = $this->checkParameters($pParams, array('ITEMID', 'REORDERID','INVENTORYID', 'QUANTITY'), array('ITEMID'=>0, 'REORDERID'=>0,'INVENTORYID'=>0, 'QUANTITY'=>0));
      $vDO = new ReorderItemDO($vParams['ITEMID'], $vParams['QUANTITY'], $vParams['INVENTORYID']);
    break;

    case DOEnum::AttachmentDO:
      $vParams = $this->checkParameters($pParams, array('ITEMID', 'REORDERID','USERID', 'DATEADDED', 'URL','TYPE', 'ATTACHMENTID', 'TITLE'), array('ITEMID'=>0, 'REORDERID'=>0,'USERID'=>0, 'DATEADDED'=>'', 'URL'=>'','TYPE'=>'', 'ATTACHMENTID'=>'', 'TITLE'=>''));
      $vDO = new AttachmentDO($vParams['ATTACHMENTID'], $vParams['REORDERID'], $vParams['USERID'], $vParams['TITLE'], $vParams['DATEADDED']);
    break;

    case DOEnum::QuoteDO:
      $vParams = $this->checkParameters($pParams, array('REORDERID','SUPPLIERID','QUOTEID', 'TITLE'), array('REORDERID'=>0,'SUPPLIERID'=>0,'QUOTEID'=>0, 'TITLE'=>''));
      $vDO = new QuoteDO($vParams['QUOTEID'], $vParams['REORDERID'], $vParams['TITLE'], $vParams['SUPPLIERID']);
    break;

/*     case DOEnum::QuoteItemDO:
      $vParams = $this->checkParameters($pParams, array('REORDERID','QUOTEID','SUPPLIERID'), array('REORDERID'=>0, 'QUOTEID'=>0,'SUPPLIERID'=>0));
      $vDO = new QuoteDO( $vParams['QUOTEID'], $vParams['SUPPLIERID'],$vParams['REORDERID']);
    break; */

    case DOEnum::SettingDO:
      $vParams = $this->checkParameters($pParams, array('SETTINGID','SETTINGTYPE','NAME', 'UNITID', 'EMAIL'), array('SETTINGID'=>0,'SETTINGTYPE'=>'','NAME'=>'', 'UNITID'=>0, 'EMAIL'=>''));
      $vDO = new SettingDO($vParams['UNITID'],$vParams['SETTINGID'],$vParams['SETTINGTYPE'],$vParams['NAME'],$vParams['EMAIL']);
    break;

     case DOEnum::Inventory2DO:
       $vParams = $this->checkParameters($pParams, array('INVENTORYID', 'SITE', 'UNITNAME', 'NAME'), array('INVENTORYID'=>0, 'SITE'=>'', 'UNITNAME'=>'', 'NAME'=>''));
       $vDO = new Inventory2DO($vParams['INVENTORYID'],$vParams['NAME']);
     break;
	
	case DOEnum::ReorderHistoryDO:
      $vParams = $this->checkParameters($pParams, array('HISTORYID', 'REORDERID', 'USERID', 'COMMENTS', 'STATUS', 'DATEOCCURRED'), array('HISTORYID'=>0, 'REORDERID'=>0, 'USERID'=>0, 'COMMENTS'=>'', 'STATUS'=>'', 'DATEOCCURRED'=>''));
     $vDO = new ReorderHistoryDO($vParams['HISTORYID'],$vParams['REORDERID'], $vParams['USERID']);
    break;
	
	case DOEnum::RequestHistoryDO:
      $vParams = $this->checkParameters($pParams, array('HISTORYID', 'REQUESTID', 'EVENT' , 'USERID', 'COMMENTS', 'STATUS', 'DATEOCCURRED'), array('HISTORYID'=>0, 'REQUESTID'=>0, 'USERID'=>0, 'COMMENTS'=>'', 'EVENT'=>'', 'STATUS'=>'', 'DATEOCCURRED'=>''));
     $vDO = new RequestHistoryDO($vParams['HISTORYID'],$vParams['REQUESTID'], $vParams['USERID']);
    break;
	
	case DOEnum::EditHistoryDO:
      $vParams = $this->checkParameters($pParams, array('HISTORYID', 'INVENTORYID', 'USERID', 'REASONFOREDIT', 'DATEOCCURRED'), array('HISTORYID'=>0, 'INVENTORYID'=>0, 'USERID'=>0, 'REASONFOREDIT'=>'','DATEOCCURRED'=>''));
     $vDO = new EditHistoryDO($vParams['HISTORYID'],$vParams['USERID'],$vParams['INVENTORYID']);
    break;
	
	case DOEnum::RequestedItemDO:
     $vParams = $this->checkParameters($pParams, array('REQUESTID', 'REQUESTEDITEMID', 'INVENTORYID', 'REASONFORREQUEST', 'QUANTITYREQUESTED', 'QUANTITYREQUESTEDREMAINING'), array('REQUESTID'=>0, 'REQUESTEDITEMID'=>0, 'INVENTORYID'=>0, 'REASONFORREQUEST'=>'', 'QUANTITYREQUESTED'=>0, 'QUANTITYREQUESTEDREMAINING'=>0));
     $vDO = new RequestedItemDO($vParams['REQUESTID'], $vParams['REQUESTEDITEMID'], $vParams['INVENTORYID']);
    break;
	
	case DOEnum::DisbursementRecordDO:
     $vParams = $this->checkParameters($pParams, array('DISBURSEMENTUUID', 'QUANTITYDISBURSED', 'COMMENTS', 'DATEDISBURSED', 'USERID', 'STATUS', 'CODE','REQUESTID', 'REQUESTEDITEMID'), array('CODE'=>'', 'DISBURSEMENTUUID'=>0, 'QUANTITYDISBURSED'=>0, 'COMMENTS'=>'', 'DATEDISBURSED'=>'', 'USERID'=>0, 'STATUS'=>'', 'REQUESTID'=>0, 'REQUESTEDITEMID'=>0));
     $vDO = new DisbursementRecordDO($vParams['DISBURSEMENTUUID'], $vParams['REQUESTID'], $vParams['REQUESTEDITEMID'], $vParams['QUANTITYDISBURSED'],$vParams['COMMENTS'],$vParams['DATEDISBURSED'],$vParams['CODE'],$vParams['USERID'],$vParams['STATUS']);
    break;

	case DOEnum::DisbursementRecordDO2:
     $vParams = $this->checkParameters($pParams, array('DISBURSEMENTUUID', 'QUANTITYDISBURSED', 'COMMENTS', 'DATEDISBURSED', 'USERID', 'STATUS', 'CODE','REQUESTID', 'REQUESTEDITEMID'), array('CODE'=>'', 'DISBURSEMENTUUID'=>0, 'QUANTITYDISBURSED'=>0, 'COMMENTS'=>'', 'DATEDISBURSED'=>'', 'USERID'=>0, 'STATUS'=>'', 'REQUESTID'=>0, 'REQUESTEDITEMID'=>0));
     $vDO = new DisbursementRecordDO2($vParams['DISBURSEMENTUUID'], $vParams['REQUESTID'], $vParams['REQUESTEDITEMID'], $vParams['QUANTITYDISBURSED'],$vParams['COMMENTS'],$vParams['DATEDISBURSED'],$vParams['CODE'],$vParams['USERID'],$vParams['STATUS']);
    break;
	
	case DOEnum::AssetDO:
     $vParams = $this->checkParameters($pParams, 
                array('ASSET_ID', 'PTAG_CODE', 'OTAG_CODE', 'COMM_CODE', 'ASSET_DESCR', 'SERIAL_NUM', 
                'STAT', 'POHD_CODE', 'ORIG_DOC_CODE', 'ACTIVE_DATE', 'CAP', 'CAP_DATE', 'ORGN_RESP', 
                'FUND', 'ORGN', 'LOCN_RESP', 'NET_BK_VALUE', 'ACCT', 'ACCT_TITLE'), 
                array('ASSET_ID'=>0, 'PTAG_CODE'=>'', 'OTAG_CODE'=>'', 
                'COMM_CODE'=>'', 'ASSET_DESCR'=>'', 'SERIAL_NUM'=>'', 
                'STAT'=>'', 'POHD_CODE'=>'', 'ORIG_DOC_CODE'=>'', 'ACTIVE_DATE'=>'', 'CAP'=>'', 'CAP_DATE'=>'', 'ORGN_RESP'=>'', 
                'FUND'=>'', 'ORGN'=>'', 'LOCN_RESP'=>'', 'NET_BK_VALUE'=>'', 'ACCT'=>'', 'ACCT_TITLE'=>''));
     $vDO = new AssetDO($vParams['ASSET_ID'], $vParams['PTAG_CODE'], $vParams['OTAG_CODE'],
                $vParams['COMM_CODE'], $vParams['ASSET_DESCR'], 
                $vParams['SERIAL_NUM'], 
                $vParams['STAT'], $vParams['POHD_CODE'], $vParams['ORIG_DOC_CODE'], 
                $vParams['ACTIVE_DATE'], $vParams['CAP'], $vParams['CAP_DATE'], 
                $vParams['ORGN_RESP'], 
                $vParams['FUND'], $vParams['ORGN'], $vParams['LOCN_RESP'], $vParams['NET_BK_VALUE'], 
                $vParams['ACCT'], $vParams['ACCT_TITLE']);
    break;


	default:
    $vDO = null;
  }
  
  return $vDO;
 }
}

/* End of file DOFactory.php */
/* Location: /DOFactory.php */