<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'RequestDAO.php';



class RequestM extends IVSModel {


	private $colNames = ' USERID, REQUESTID, TITLE, UNITID, REQUESTORID, STATUS, DESCRIPTION, DATERECEIVED, PRIORITY, COMMENTS, ONBEHALF ';
	
	
	function __construct() {
	  parent::__construct();
	}

	
	public function UpdateRequestStatus($requestid, $status) {

           
           
           $fieldnames = '';
           $fieldvalues = ' status= '. $this->db->escape($status);
	   $this->db->query('update request set ' . $fieldvalues . ' where requestid = '. $requestid);

	   $data['msg'] = 'Status Updated';
	   $data['msgType'] = 'success';
           
           $log = new Logger($this->db);
           $param = new LogDO('UPDATE', 'REQUEST', $fieldnames, $fieldvalues, 'now()', $this->session->userId, $this->session->unitId, 'none', 'REQUESTID', $requestid);
           $log->log($param);
                    

	   return $data;

	}




/************** ALL METHODS BELOW HERE ARE USED BY CLIENT ***************/

	/*
		Get all the requests by a particular unit
	*/
	public function GetAllRequestorRequests($requestor_id) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM REQUEST WHERE requestorid=' . $requestor_id . ' ORDER BY requestid desc'; 
		return $this->initializeDAO($sql);
		
	}
	
	/* 
		Get all the requests sent to a particular unit
	*/
	public function GetAllRequestsToAUnit($unitid) {
		
		$sql = 'SELECT ' . $this->colNames . ' FROM REQUEST WHERE unitid=' . $unitid . ' and status<>"NOT SUBMITTED" ORDER BY (CASE status
                            WHEN "PENDING" 	 THEN 1
                            WHEN "COMPLETED"	 THEN 2
                            WHEN "DENIED"	 THEN 3
                            END), datereceived desc ';
		return $this->initializeDAO($sql);
	
	}
	
	/*
		Get specific request
	*/
	public function GetRequestFromId(RequestDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM REQUEST WHERE requestid=' . $udo->getRequest_id();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}
	
	public function ListAllRequestsByStatus($unitid, $status) {
		
		$sql = 'SELECT ' . $this->colNames . ' FROM REQUEST WHERE unitid=' . $unitid . ' AND status="' . $status .  '" ORDER BY datereceived desc ';
		return $this->initializeDAO($sql);
	
	
	}

	public function GetAllRequestsToInventoryItem($inventoryid) {

		
	}
	
	protected function initializeDAO($sql) {
		
		$e = new RequestDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
	
	public function UpdateRequest() {
		
		$data = array();
		$this->load->library('form_validation');
		$this->setValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		    $data['requestDO'] = DOFactory::getInstance()->createDO(DOEnum::RequestDO, array('REQUESTID'=>set_value('requestid'),'TITLE'=>set_value('title'),'DESCRIPTION'=>set_value('description'), 'PRIORITY'=>set_value('priority'),  'UNITID'=>set_value('unitid'), 'COMMENTS'=>set_value('comments'), 'ONBEHALF'=>set_value('onbehalf')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::RequestDO, array('REQUESTID'=>set_value('requestid'),'TITLE'=>set_value('title'),'DESCRIPTION'=>set_value('description'), 'PRIORITY'=>set_value('priority'), 'UNITID'=>set_value('unitid'), 'COMMENTS'=>set_value('comments'), 'ONBEHALF'=>set_value('onbehalf') ));
		   
               
                   
                   $fieldname ='';
                   $fieldvalues = ' description= '. $this->db->escape($udo->getDescription()).
		   	', priority = ' . $this->db->escape($udo->getPriority()) . 
		   	', comments = ' . $this->db->escape($udo->getComments()) .
		   	', title = ' . $this->db->escape($udo->getTitle()) . 
			', unitid = ' . $this->db->escape($udo->getUnit_id()) .
                        ', onbehalf = ' . $this->db->escape($udo->getOnbehalf()) .
                        ', status = ' . $this->db->escape($_POST['status']);
                   
		   $this->db->query('update request set ' .$fieldvalues . ' where requestid = '. $udo->getRequest_id());


			
		   $data['msg'] = 'Saved changes successfully!';
		   $data['msgType'] = 'success';
                   
                   
                    $log = new Logger($this->db);
                    $param = new LogDO('UPDATE', 'REQUEST', $fieldname, $fieldvalues, 'now()', $this->session->userId, $this->session->unitId, 'none', 'REQUESTID', $udo->getRequest_id());
                    $log->log($param);

		  }
		  return $data;		

	}
        
        public function SubmitRequest() {
            
        
        }
	
	public function InsertRequest() {
		
		  $data = array();
		  $this->load->library('form_validation');
		  $this->setValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['requestDO'] = DOFactory::getInstance()->createDO(DOEnum::RequestDO, array('USERID'=>$this->session->userId, 'REQUESTID'=>1, 'UNITID'=>set_value('unitid'), 'TITLE'=>set_value('title'), 'REQUESTORID'=>set_value('requestorid'), 'STATUS'=>"NOT SUBMITTED", 'COMMENTS'=>set_value('comments'), 'DESCRIPTION'=>set_value('description'), 'ONBEHALF'=>set_value('onbehalf')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::RequestDO, array('REQUESTID'=>1, 'UNITID'=>set_value('unitid'), 'TITLE'=>set_value('title'), 'REQUESTORID'=>$this->session->userdata('unitId'), 'STATUS'=>"NOT SUBMITTED", 'COMMENTS'=>set_value('comments'), 'DESCRIPTION'=>set_value('description'), 'ONBEHALF'=>set_value('onbehalf')));
		   
			$this->db->query('insert into request(requestorid, status, priority, comments, title, description, unitid, datereceived, onbehalf, userid) values('. set_value('requestorid') . ',"NOT SUBMITTED" ' . ',' . set_value('priority')  . ',' . $this->db->escape(set_value('comments')) . ',' . $this->db->escape(set_value('title')) .  ',' . $this->db->escape(set_value('description')) .  ',' . set_value('unitid') .',now(),' . set_value('onbehalf') . ','
                                 . $this->session->userId . ')');
			
			$data['msg'] = 'Request Submitted!';
			$data['msgType'] = 'success';
			
		}
		  return $data;
		  
	
	}
	
	
	public function RemoveRequest() {
		
		$data = array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('requestid','Request ID','trim|required');
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['requestDO'] = DOFactory::getInstance()->createDO(DOEnum::RequestDO, array('REQUESTID'=>1, 'UNITID'=>set_value('unitid'), 'TITLE'=>set_value('title'), 'REQUESTORID'=>set_value('requestorid'), 'STATUS'=>"PENDING", 'COMMENTS'=>set_value('comments'), 'DESCRIPTION'=>set_value('description')));
		  }
		  else {
		   
		   $this->db->query('delete from request where requestid = '. set_value('requestid'));

		   $data['msg'] = 'Request Deleted!';
		   $data['msgType'] = 'success';

		  }
		  return $data;	
		  
	}
	
	
	private function setValidationRules() {

	  	$this->form_validation->set_rules('requestid','Request ID','trim|required');
	  	$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('priority','Priority','trim|required');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('unitid','Unit ID','trim|required');
		$this->form_validation->set_rules('requestorid','Requestor ID','trim|required');
		$this->form_validation->set_rules('comments','Comments','trim|required');
                $this->form_validation->set_rules('onbehalf', 'On Behalf', 'trim|required');
		
	}


	

}

