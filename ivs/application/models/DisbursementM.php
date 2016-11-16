<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'DisbursementDAO.php';
include 'DisbursementHistoryDAO.php';



class DisbursementM extends IVSModel {


	private $colNames = ' DISBURSEMENTUUID, REQUESTID, REQUESTEDITEMID, QUANTITYDISBURSED, COMMENTS, DATEDISBURSED, USERID, STATUS, CODE ';
	
	
	function __construct() {
	  parent::__construct();
	}

	public function GetDisbursementsInRequest($requestid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM DISBURSEMENTRECORD WHERE requestid=' . $requestid . ' group by disbursementuuid order by datedisbursed'; 
		return $this->initializeDAO($sql);

	}

	/* Get all disbursement record with uuid */
	public function GetDisbursementByUUID($uuid) {

		$sql = 'SELECT a.requesteditemid, b.inventoryid as InventoryID, a.quantitydisbursed as Quantity, a.disbursementuuid from disbursementrecord a, requesteditems b where a.disbursementuuid="' . $uuid . '" and a.requesteditemid = b.requesteditemid'; 
		//return $this->initializeDAO($sql);
		return $this->db->query($sql);

	}
	
	public function GetAllDisbursements($unitid) {
		
		$sql = 'SELECT DISBURSEMENTUUID, DISBURSEMENTRECORD.REQUESTID, REQUESTEDITEMID, QUANTITYDISBURSED, DISBURSEMENTRECORD.COMMENTS, DATEDISBURSED, DISBURSEMENTRECORD.USERID, DISBURSEMENTRECORD.STATUS, CODE FROM DISBURSEMENTRECORD, REQUEST WHERE DISBURSEMENTRECORD.requestid = REQUEST.requestid and REQUEST.unitid=' . $unitid . ' group by DISBURSEMENTUUID ORDER BY DISBURSEMENTRECORD.datedisbursed desc '; 
		return $this->initializeDAO($sql);
	
	}
	
	public function GetDisbursementsInRequestedItem($requesteditemid) {
		
		$sql = 'SELECT ' . $this->colNames . ' FROM DISBURSEMENTRECORD WHERE requesteditemid=' . $requesteditemid . ' ORDER BY datedisbursed desc'; 
		return $this->initializeDAO($sql);
		
	}

	
	public function GetDisbursementFromId($id) {

		$sql = 'SELECT ' . $this->colNames . ' FROM DISBURSEMENTRECORD WHERE disbursementid=' . $id;
		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function GetDisbursementRecordByUUID($uuid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM DISBURSEMENTRECORD WHERE disbursementuuid="' . $uuid . '"';
		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;

	}



	public function GetDisbursementRecord($itemid, $uuid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM DISBURSEMENTRECORD WHERE disbursementuuid="' . $uuid . '" and requesteditemid=' . $itemid;

		//var_dump($sql);
		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;

	}
        
        
          public function getDisbursementHistory($inventoryid, $sdate, $tdate) {
            
              $sql = ' SELECT e.UNITNAME, a.DISBURSEMENTUUID, a.QUANTITYDISBURSED, a.COMMENTS, a.STATUS, a.DATEDISBURSED FROM DISBURSEMENTRECORD a, REQUESTEDITEMS b, INVENTORY c, REQUEST d, ZCORE_UNIT e where'
                      . ' a.requesteditemid = b.requesteditemid and b.inventoryid=c.inventoryid and a.requestid = d.requestid and d.unitid = e.unitid and c.inventoryid= ' . $inventoryid . ' and a.datedisbursed between ' . $this->db->escape($sdate) . ' and ' . $this->db->escape($tdate) . ' and e.unitid=' . $this->session->unitId ; 
		return $this->initializeDAO2($sql);
            
            
         }

	public function UpdateStatus($uuid, $status) {

		$sql = 'update disbursementrecord  set status=' . $this->db->escape($status) . ' where disbursementuuid=' . $this->db->escape($uuid);

		$this->db->query($sql);

		$data['msg'] = 'Status Updated!';
		$data['msgType'] = 'success';
			
		
		return $data;

	}

	public function UpdateQuantityDisbursed($uuid) {

		$sql = 'update disbursementrecord  set quantitydisbursed=0 where disbursementuuid=' . $this->db->escape($uuid);

                    
                
		$this->db->query($sql);


	}


	public function InsertDisbursement($udo) {
                
            $fieldnames = 'requesteditemid, disbursementuuid, userid, status, requestid, quantitydisbursed, comments, datedisbursed, code';
            $fieldvalues = $udo->getRequested_item_id() .  ',' . 
				$this->db->escape($udo->getDisbursementuuid()) .  ',' . 
				$udo->getUser_id() .  ',' .
				$this->db->escape($udo->getStatus()) .  ',' .  
				$udo->getRequestid() .  ',' . 
				$udo->getQuantity_disbursed() .  ',' . 
				$this->db->escape($udo->getComments()) .  ',' . 
				 'now(),' . 
				 $this->db->escape($udo->getCode());
            
		$sql = 'insert into disbursementrecord(' . $fieldnames . ') values(' . $fieldvalues . ')';
		  

		 
                $this->db->query($sql);

                $log = new Logger($this->db);
                $param = new LogDO('INSERT', 'DISBURSEMENTRECORD', $fieldnames, $fieldvalues, 'now()', $this->session->userId, $this->session->unitId, 'none', 'REQUESTEDITEMID' , $udo->getRequested_item_id());
                $log->log($param);
        			
			
//                $data['msg'] = 'Record inserted';
//                $data['msgType'] = 'success';
//			
//	
//		return $data;

	}
	
	protected function initializeDAO($sql) {
		
		$e = new DisbursementDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
        
        
        
        
        protected function initializeDAO2($sql) {
		
		$e = new DisbursementHistoryDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
        

	
	
	
	



	

}

