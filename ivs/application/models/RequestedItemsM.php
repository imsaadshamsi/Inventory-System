<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'RequestedItemDAO.php';



class RequestedItemsM extends IVSModel {


	private $colNames = ' REQUESTID, REQUESTEDITEMID, INVENTORYID, REASONFORREQUEST, QUANTITYREQUESTED, QUANTITYREQUESTEDREMAINING  ';
	
	
	function __construct() {
	  parent::__construct();
	}


	public function GetAllRequestedItems($requestid) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM REQUESTEDITEMS WHERE requestid=' . $requestid ; 
		return $this->initializeDAO($sql);
		
	}
	
	
	public function GetRequestedItemFromId(RequestedItemDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM REQUESTEDITEMS WHERE requesteditemid=' . $udo->getRequested_item_id();
		
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}
	
	protected function initializeDAO($sql) {
		
		$e = new RequestedItemDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
	
	public function InsertItem() {
		
		  $data = array();
		  $this->load->library('form_validation');
		  $this->setValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['requestedItemDO'] = DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO, array('REQUESTEDITEMID'=>set_value('requesteditemid'),'REQUESTID'=>set_value('requestid'),'INVENTORYID'=>set_value('inventoryid')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO, array('REQUESTEDITEMID'=>set_value('requesteditemid'),'REQUESTID'=>set_value('requestid'),'INVENTORYID'=>set_value('inventoryid')));
		   $udo->setQuantity_requested(set_value('quantity'));
		   $udo->setReason_for_request(set_value('reason'));
		   $udo->setQuantity_requested_remaining(set_value('quantity'));
		   
			$this->db->query('insert into requesteditems(requestid, inventoryid, quantityrequested, quantityrequestedremaining, reasonforrequest) values(' . $this->db->escape($udo->getRequest_id()) . ',' . $this->db->escape($udo->getInventory_id()) .  ',' . $this->db->escape($udo->getQuantity_requested()) . ',' . $this->db->escape($udo->getQuantity_requested_remaining()) . ',' . $this->db->escape($udo->getReason_for_request()) . ');');
			
			$data['msg'] = 'Item Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;
		  
	}
	
	public function UpdateItem() {
		
		$data = array();
		$this->load->library('form_validation');
		$this->setValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		   $data['requestedItemDO'] = DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO, array('REQUESTEDITEMID'=>set_value('requesteditemid'),'REQUESTID'=>set_value('requestid'),'INVENTORYID'=>set_value('inventoryid')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO, array('REQUESTEDITEMID'=>set_value('requesteditemid'),'REQUESTID'=>set_value('requestid'),'INVENTORYID'=>set_value('inventoryid')));
		   $udo->setQuantity_requested(set_value('quantity'));
		   $udo->setReason_for_request(set_value('reason'));
		   
		   $this->db->query('update requesteditems set reasonforrequest= '. $this->db->escape($udo->getReason_for_request()).
		   	', quantityrequested = ' . $udo->getQuantity_requested() . 
                        ', quantityrequestedremaining = ' . $udo->getQuantity_requested() .
		   	', inventoryid = ' . $udo->getInventory_id() .
		   	' where requesteditemid = '. $udo->getRequested_item_id());

		   $data['msg'] = 'Item Updated!';
		   $data['msgType'] = 'success';

		  }
		  return $data;		
	
	}

	public function UpdateQuantityRequestedRemaining($udo) {

			$sql = 'update requesteditems set quantityrequestedremaining=' . $udo->getQuantity_requested_remaining() . ' where requesteditemid=' . $udo->getRequested_item_id();

		$this->db->query($sql);
	}
	
	public function RemoveItem() {
		
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('requesteditemid','Requested Item ID','trim|required');
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		  }
		  else {
		   
		   $this->db->query('delete from requesteditems where requesteditemid = '. set_value('requesteditemid'));

		   $data['msg'] = 'Item Deleted!';
		   $data['msgType'] = 'success';

		  }
		  return $data;	
		  
	}
	
	
	private function setValidationRules() {

	  	$this->form_validation->set_rules('requesteditemid','Requested Item ID','trim|required');
	  	$this->form_validation->set_rules('quantity','Quantity','trim|required');
		$this->form_validation->set_rules('requestid','Request ID','trim|required');
		$this->form_validation->set_rules('reason','Reason','trim|required');
		$this->form_validation->set_rules('inventoryid','Inventory ID','trim|required');
		
	}


	

}

