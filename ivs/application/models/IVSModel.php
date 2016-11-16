<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


include 'DOEnum.php';
include 'DataObject.php';
include 'UserDO.php';
include 'CategoryDO.php';
include 'LocationDO.php';
include 'UnitDO.php';
include 'SupplierDO.php';
include 'ShelvingDO.php';
include 'InventoryDO.php';
include 'RequestDO.php';
include 'ShelvingListDO.php';
include 'ReorderDO.php';
include 'QuoteDO.php';
include 'SettingDO.php';
include 'Inventory2DO.php';
include 'ReorderHistoryDO.php';
include 'RequestHistoryDO.php';
include 'EditHistoryDO.php';
include 'PageDO.php';
include 'LogDO.php';
include 'AssetDO.php';

include 'DOFactory.php';
include 'Logger.php';

include '/Custom/RulesEngine.php';
include '/Custom/IRules.php';
include '/Custom/Rule_001.php';
include '/Custom/Rule_002.php';


class IVSModel extends CI_Model {
 
 function __construct() {
  parent::__construct();
 }
 
}

