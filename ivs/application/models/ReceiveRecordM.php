<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'ReceiveRecordDAO.php';



class ReceiveRecordM extends IVSModel {

	private $colNames = ' REORDERID, RECORDUUID, ITEMID, USERID, QTYRECEIVED, DATERECEIVED, STATUS';
	
	
	function __construct() {
	  parent::__construct();
	}


	public function GetAllReceiveRecords($reorderid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM RECEIVERECORDS WHERE reorderid=' . $reorderid . ' group by recordUUID order by datereceived'; 
		return $this->initializeDAO($sql);

	}

	public function GetReceiveRecordByUUID($uuid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM RECEIVERECORDS WHERE recordUUID="' . $uuid . '"';
		return $this->initializeDAO($sql);

	}

	public function GetSingleReceiveRecordByUUID($uuid) {

		$udo = null;
		$sql = 'SELECT ' . $this->colNames . ' FROM RECEIVERECORDS WHERE recordUUID="' . $uuid . '"';
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;
		
	}

	public function GetReceiveRecord($itemid, $uuid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM RECEIVERECORDS WHERE recorduuid="' . $uuid . '" and itemid=' . $itemid;

		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function InsertRecord($udo) {

		$sql = 'insert into receiverecords(reorderid, recorduuid, itemid, userid,qtyreceived, datereceived, status) values(' . 
				$udo->getReorderid() .  ',' . 
				$this->db->escape($udo->getRecorduuid()) .  ',' . 
				$udo->getItemid() .  ',' .
				$udo->getUserid() .  ',' .   
				$udo->getQtyreceived() .  ',' .  
				 'now(), "RECEIVED"'   
			    . ')';
		  
				//return $sql;
		 
		$this->db->query($sql);
			
			

	}

	public function UpdateRecord($uuid) {

		$sql = 'update receiverecords set status="CANCELLED" where recorduuid=' . $this->db->escape($uuid);
		  
              
                
		$this->db->query($sql);
                
                  $data['msg'] = 'Status Updated!';
		$data['msgType'] = 'success';
                
                
                return $data;

	}
        

	protected function initializeDAO($sql) {
		
		$e = new ReceiveRecordDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}



 
 
}

