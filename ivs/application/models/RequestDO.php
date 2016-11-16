<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class RequestedItemDO extends DataObject {
	
	private $requested_item_id;
	private $reason_for_request;
	private $quantity_requested;
	private $inventory_id;
	private $request_id;
	private $quantity_requested_remaining;
	
	private $disbursement_records = null;
	private $inventory_record = null;
	
	 function __construct($requestid, $requesteditemid, $inventoryid) {
	
		$this->request_id = $requestid;
		$this->requested_item_id = $requesteditemid;
		$this->inventory_id = $inventoryid;
	}
	public function getInventory_record(){
		return $this->inventory_record;
	}

	public function setInventory_record($inventory_record){
		$this->inventory_record = $inventory_record;
	}
	
	public function getDisbursement_records(){
		return $this->disbursement_records;
	}

	public function setDisbursement_records($disbursement_records){
		$this->disbursement_records = $disbursement_records;
	}
	
	public function getRequested_item_id(){
		return $this->requested_item_id;
	}

	public function setRequested_item_id($requested_item_id){
		$this->requested_item_id = $requested_item_id;
	}

	public function getReason_for_request(){
		return $this->reason_for_request;
	}

	public function setReason_for_request($reason_for_request){
		$this->reason_for_request = $reason_for_request;
	}

	public function getQuantity_requested(){
		return $this->quantity_requested;
	}

	public function setQuantity_requested($quantity_requested){
		$this->quantity_requested = $quantity_requested;
	}

	public function getInventory_id(){
		return $this->inventory_id;
	}

	public function setInventory_id($inventory_id){
		$this->inventory_id = $inventory_id;
	}

	public function getRequest_id(){
		return $this->request_id;
	}

	public function setRequest_id($request_id){
		$this->request_id = $request_id;
	}

	public function getQuantity_requested_remaining(){
		return $this->quantity_requested_remaining;
	}

	public function setQuantity_requested_remaining($quantity_requested_remaining){
		$this->quantity_requested_remaining = $quantity_requested_remaining;
	}

}

class DisbursementRecordDO extends DataObject {
	
	private $disbursementuuid;
	private $requestid;
	private $requested_item_id;
	private $quantity_disbursed;
	private $comments;
	private $date_disbursed;
	private $code;
	private $user_id; // person disbursing inventory
	private $status;
	
	
	function __construct($disbursementuuid, $requestid, $requesteditemid, $quantity_disbursed, $comments, $date_disbursed, $code, $user_id, $status) {
	
		$this->disbursementuuid = $disbursementuuid;
		$this->quantity_disbursed = $quantity_disbursed;
		$this->comments = $comments;
		$this->date_disbursed = $date_disbursed;
		$this->code = $code;
		$this->user_id = $user_id;
		$this->status = $status;
		
	}

	public function getRequestid(){
		return $this->requestid;
	}

	public function setRequestid($requestid){
		$this->requestid = $requestid;
	}
	
	
	
	public function getDisbursementuuid(){
		return $this->disbursementuuid;
	}

	public function setDisbursementuuid($disbursementuuid){
		$this->disbursementuuid = $disbursementuuid;
	}

	public function getRequested_item_id(){
		return $this->requested_item_id;
	}

	public function setRequested_item_id($requested_item_id){
		$this->requested_item_id = $requested_item_id;
	}

	public function getQuantity_disbursed(){
		return $this->quantity_disbursed;
	}

	public function setQuantity_disbursed($quantity_disbursed){
		$this->quantity_disbursed = $quantity_disbursed;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getDate_disbursed(){
		return $this->date_disbursed;
	}

	public function setDate_disbursed($date_disbursed){
		$this->date_disbursed = $date_disbursed;
	}

	public function getCode(){
		return $this->code;
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	
}

class DisbursementRecordDO2 extends DataObject {
	
	private $disbursementuuid;
	private $requestid;
	private $requested_item_id;
	private $quantity_disbursed;
	private $comments;
	private $date_disbursed;
	private $code;
	private $user_id; // person disbursing inventory
	private $status;
        
        private $unitname;
        
	
	
	function __construct($disbursementuuid, $requestid, $requesteditemid, $quantity_disbursed, $comments, $date_disbursed, $code, $user_id, $status) {
	
		$this->disbursementuuid = $disbursementuuid;
		$this->quantity_disbursed = $quantity_disbursed;
		$this->comments = $comments;
		$this->date_disbursed = $date_disbursed;
		$this->code = $code;
		$this->user_id = $user_id;
		$this->status = $status;
		
	}
        
        	public function getUnitname(){
		return $this->unitname;
	}

	public function setUnitname($unitname){
		$this->unitname = $unitname;
	}

	public function getRequestid(){
		return $this->requestid;
	}

	public function setRequestid($requestid){
		$this->requestid = $requestid;
	}
	
	
	
	public function getDisbursementuuid(){
		return $this->disbursementuuid;
	}

	public function setDisbursementuuid($disbursementuuid){
		$this->disbursementuuid = $disbursementuuid;
	}

	public function getRequested_item_id(){
		return $this->requested_item_id;
	}

	public function setRequested_item_id($requested_item_id){
		$this->requested_item_id = $requested_item_id;
	}

	public function getQuantity_disbursed(){
		return $this->quantity_disbursed;
	}

	public function setQuantity_disbursed($quantity_disbursed){
		$this->quantity_disbursed = $quantity_disbursed;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getDate_disbursed(){
		return $this->date_disbursed;
	}

	public function setDate_disbursed($date_disbursed){
		$this->date_disbursed = $date_disbursed;
	}

	public function getCode(){
		return $this->code;
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	
}

class RequestDO extends DataObject {
 
  private $request_id;
  private $title;
  private $unit_id;
  private $requestor_id;
  private $status;
  private $date_received;
  private $priority;
  private $comments;
  private $description;
  private $userid;
  private $onbehalf;
  
  private $requested_items = array();
 
 function __construct($requestid, $unitid, $title, $requestorid,  $datereceived, $description, $priority, $status, $comments, $onbehalf, $userid) {
	
    $this->request_id = $requestid;
    $this->unit_id = $unitid;
	$this->title = $title;
    $this->date_received = $datereceived;
	$this->description = $description;
	$this->priority = $priority;
	$this->status = $status;
	$this->comments= $comments;
        $this->onbehalf = $onbehalf;
        $this->userid = $userid;
        $this->requestor_id = $requestorid;

 }
 
 
 	public function getOnbehalf(){
		return $this->onbehalf;
	}

	public function setOnbehalf($onbehalf){
		$this->onbehalf = $onbehalf;
	}

 	public function getUserid(){
		return $this->userid;
	}

	public function setUserid($userid){
		$this->userid = $userid;
	}
 
	public function getRequest_id(){
		return $this->request_id;
	}

	public function setRequest_id($request_id){
		$this->request_id = $request_id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getUnit_id(){
		return $this->unit_id;
	}

	public function setUnit_id($unit_id){
		$this->unit_id = $unit_id;
	}

	public function getRequestor_id(){
		return $this->requestor_id;
	}

	public function setRequestor_id($requestor_id){
		$this->requestor_id = $requestor_id;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getDate_received(){
		return $this->date_received;
	}

	public function setDate_received($date_received){
		$this->date_received = $date_received;
	}

	public function getPriority(){
		return $this->priority;
	}

	public function setPriority($priority){
		$this->priority = $priority;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getRequested_items(){
		return $this->requested_items;
	}

	public function setRequested_items($requested_items){
		$this->requested_items = $requested_items;
	}

  
 

}

