<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'ReorderDAO.php';



class ReorderM extends IVSModel {

	private $colNames = ' REORDERID, DESCRIPTION, DATEINITIATED, COMMENTS, STATUS, USERID, UNITID ';
	
	
	function __construct() {
	  parent::__construct();
	}


	public function GetAllReorders($unitid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM REORDERS WHERE unitid=' . $unitid . ' ORDER BY (CASE status
                            WHEN "PENDING" 	 THEN 1
                            WHEN "COMPLETED"	 THEN 2
                            WHEN "CANCELLED"	 THEN 3
                            END), dateinitiated desc'; 
		return $this->initializeDAO($sql);

	}


	public function GetReorderFromID($reorderid) {

		$udo = null;
		$sql = 'SELECT ' . $this->colNames . ' FROM REORDERS WHERE reorderid=' . $reorderid;
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}


	protected function initializeDAO($sql) {
		
		$e = new ReorderDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}




	public function insertReorder() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setReorderValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['reorderDO'] = DOFactory::getInstance()->createDO(DOEnum::ReorderDO, array('REORDERID'=>set_value('reorderid'),
		   	'DESCRIPTION'=>set_value('description'),
		   	   'COMMENTS'=>set_value('comments'),
		   	   'USERID'=>set_value('userid'),
		   	   'UNITID'=>set_value('unitid'),
		   	   'STATUS'=>'PENDING'));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::ReorderDO, array('REORDERID'=>set_value('reorderid'),
		   	'DESCRIPTION'=>set_value('description'),
		   	   'COMMENTS'=>set_value('comments'),
		   	   'USERID'=>set_value('userid'),
		   	   'UNITID'=>set_value('unitid'),
		   	   'STATUS'=>'PENDING'));
		   	
		   	$sql = 'insert into reorders(description, dateinitiated, status, comments, userid, unitid) values('
				 . $this->db->escape($udo->getDescription()) . ',' 
				 . 'now(),' 
				 . $this->db->escape($udo->getStatus()) . ',' 
				 . $this->db->escape($udo->getComments()) . ',' 
				 . $udo->getUserid() . ',' 
				 . $udo->getUnitid() . ');';
			
			$this->db->query($sql);

			$data['msg'] = 'Reorder Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;

	}





	private function insertRowReorderHistory($udo) {

		// insert row into requesthistory
	    $this->db->query('insert into reorderhistory(reorderid, userid, dateoccurred, status, comments) values('.$this->db->escape($udo->getReorderid()). ',' . $this->session->userdata('userId') . ',now(),' . $this->db->escape($udo->getStatus()) . ',' .  $this->db->escape($udo->getComments()) . ');');
	

	}

	
	private function setReorderValidationRules() {
	
	  	$this->form_validation->set_rules('reorderid','Reorder ID','trim|numeric|required');
		$this->form_validation->set_rules('description','Description','trim');	
		$this->form_validation->set_rules('userid','User ID','trim');
		$this->form_validation->set_rules('unitid','Unit ID','trim');

	}

	private function setReorderValidationRules_2() {

		$this->form_validation->set_rules('status','Status','trim');
		$this->form_validation->set_rules('comments','Comments','trim');
		$this->form_validation->set_rules('quoteid','Quote ID','trim');
		$this->form_validation->set_rules('dateinitiated','Date Initiated','trim');
	}


	public function updateReorder() {

		  $data = array();

		  $this->db->query('update reorders set status= '. $this->db->escape($_POST['status']) .
		   	' where reorderid = '. $_POST['reorderid']);


			
		   $data['msg'] = 'Status Updated';
		   $data['msgType'] = 'success';

		  
		  return $data;

	}

	// private function processOrdered() {

	// 	// validate fields
	// 	$data = array();
	// 	$this->load->library('form_validation');
	// 	$this->setReorderValidationRules();

	// 	if ($this->form_validation->run() === FALSE) {
		   
	// 	   $data['msg'] = 'Validation errors:';
	// 	   $data['msgType'] = 'error';

	// 	  }
	// 	  else {

			
	// 		if( $_POST['quoteid'] != '' && $_POST['quoteid'] != 0 ) {
				
	// 			$udo = DOFactory::getInstance()->createDO(DOEnum::ReorderDO, array('INVENTORYID'=>set_value('inventoryid'),'REORDERID'=>set_value('reorderid'),'DESCRIPTION'=>set_value('description'),
	// 		   	   'COMMENTS'=>set_value('comments'),
	// 		   	   'PONUMBER'=>set_value('ponumber'),
	// 		   	   'QUOTEID'=>set_value('quoteid'),
	// 		   	   'STATUS'=>set_value('status')));


	// 		    // insert row into history
	// 		   $this->insertRowReorderHistory($udo);

	// 		    // update request
	// 		    $this->db->query('update reorders set status = '. $this->db->escape($udo->getStatus()).
	// 		    	',quoteid = ' . $this->db->escape($udo->getQuoteid()) .
	// 		    	 ',comments=' . $this->db->escape($udo->getComments()) . 
	// 		    	 ',description=' . $this->db->escape($udo->getDescription()) . 
	// 		    	 ',ponumber=' . $this->db->escape($udo->getPonumber()) . 
	// 		    	 ' where reorderid = '. $udo->getReorderid() );
			    
	// 		    $data['msg'] = 'Inventory Reordered!';
	// 		    $data['msgType'] = 'success';

	// 		} else {
	// 			$data['msg'] = 'Invalid Operation! Please select a quote! ';
	// 	   		$data['msgType'] = 'error';
	// 		}

		   
	// 	  }

	// 	  return $data;
	
	// }

	// private function processReceived() {

	// 	// validate fields
	// 	$data = array();
	// 	$this->load->library('form_validation');
	// 	$this->setReorderValidationRules();

	// 	if ($this->form_validation->run() === FALSE) {
	// 	   $data['msg'] = 'Validation errors:';
	// 	   $data['msgType'] = 'error';

	// 	  }
	// 	  else {

			
	// 		if( $_POST['quoteid'] != '' && $_POST['quoteid'] != 0 ) {
				
	// 			$udo = DOFactory::getInstance()->createDO(DOEnum::ReorderDO, array('INVENTORYID'=>set_value('inventoryid'),'REORDERID'=>set_value('reorderid'),'DESCRIPTION'=>set_value('description'),
	// 		   	   'COMMENTS'=>set_value('comments'),
	// 		   	   'PONUMBER'=>set_value('ponumber'),
	// 		   	   'QUOTEID'=>set_value('quoteid'),
	// 		   	   'STATUS'=>set_value('status')));


	// 		    // insert row into history
	// 		    $this->insertRowReorderHistory($udo);

	// 		    // update request
	// 		    $this->db->query('update reorders set status = '. $this->db->escape($udo->getStatus()).
	// 		    	',datereceived = now()' . 
	// 		    	 ' where reorderid = '. $udo->getReorderid() );

	// 		    // update inventory
	// 		    $this->creditInventory($udo);
			    
	// 		    $data['msg'] = 'Inventory Received! Inventory levels updated';
	// 		    $data['msgType'] = 'success';

	// 		} else {
	// 			$data['msg'] = 'Invalid Operation! ';
	// 	   		$data['msgType'] = 'error';
	// 		}

		   
	// 	  }

	// 	  return $data;
	
	// }

	// private function processCancelled() {

	// 	// validate fields
	// 	$data = array();
	// 	$this->load->library('form_validation');
	// 	$this->setReorderValidationRules();

	// 	if ($this->form_validation->run() === FALSE) {
	// 	   $data['msg'] = 'Validation errors:';
	// 	   $data['msgType'] = 'error';

	// 	  }
	// 	  else {

	// 			$udo = DOFactory::getInstance()->createDO(DOEnum::ReorderDO, array('INVENTORYID'=>set_value('inventoryid'),'REORDERID'=>set_value('reorderid'),'DESCRIPTION'=>set_value('description'),
	// 		   	   'COMMENTS'=>set_value('comments'),
	// 		   	   'PONUMBER'=>set_value('ponumber'),
	// 		   	   'QUOTEID'=>set_value('quoteid'),
	// 		   	   'STATUS'=>set_value('status')));

	// 		    // insert row into history
	// 		   $this->insertRowReorderHistory($udo);

	// 		    // update request
	// 		    $this->db->query('update reorders set status = '. $this->db->escape($udo->getStatus()).
	// 		    	',quoteid = ' . $this->db->escape($udo->getQuoteid()) .
	// 		    	 ',comments=' . $this->db->escape($udo->getComments()) . 
	// 		    	 ',description=' . $this->db->escape($udo->getDescription()) . 
	// 		    	 ',ponumber=' . $this->db->escape($udo->getPonumber()) . 
	// 		    	 ' where reorderid = '. $udo->getReorderid() );
			    
	// 		    $data['msg'] = 'Reorder Cancelled!';
	// 		    $data['msgType'] = 'success';

	// 		} 

	// 	  return $data;

	// }

	// private function creditInventory($udo) {

	// 	$this->load->model('QuoteM');
	// 	$vdo = $this->QuoteM->getQuoteFromId(DOFactory::getInstance()->createDO(DOEnum::QuoteDO,array('QUOTEID'=>$udo->getQuoteid())));


	// 	// update inventory
	// 	$this->db->query('update inventory set quantityavailable = quantityavailable +' . $vdo->getQuantity() . ' where inventoryid = '. $udo->getInventoryid() );

	// 	// remove flag if quantityavailble >= minimumquantity
	// 	$this->load->model('InventoryM');
	// 	$pdo = $this->InventoryM->getInventoryFromId(DOFactory::getInstance()->createDO(DOEnum::InventoryDO,array('INVENTORYID'=>$udo->getInventoryid())));
	// 	if($pdo->getQuantityavailable() >= $pdo->getMinimumquantity()) {

	// 		$this->db->query('update inventory set flag = 2 where inventoryid = '. $udo->getInventoryid() );

	// 	}

	// }





 
 
}

