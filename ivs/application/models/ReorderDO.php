<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class AttachmentDO extends DataObject {

  private $attachmentid;
  private $userid;
  private $dateadded;
  private $type;
  private $url;
  private $id_field;
  private $reorderid;
  private $title;
  


   function __construct($attachmentid, $reorderid, $userid, $title, $dateadded) {
    $this->attachmentid = $attachmentid;
    $this->reorderid = $reorderid;
    $this->userid = $userid;
    $this->dateadded = $dateadded;
    $this->title = $title;
   }
   
   

  public function getTitle(){
    return $this->title;
  }

  public function setTitle($title){
    $this->title = $title;
  }

  public function getAttachmentid(){
    return $this->attachmentid;
  }

  public function setAttachmentid($attachmentid){
    $this->attachmentid = $attachmentid;
  }

  public function getUserid(){
    return $this->userid;
  }

  public function setUserid($userid){
    $this->userid = $userid;
  }

  public function getDateadded(){
    return $this->dateadded;
  }

  public function setDateadded($dateadded){
    $this->dateadded = $dateadded;
  }

  public function getType(){
    return $this->type;
  }

  public function setType($type){
    $this->type = $type;
  }

  public function getUrl(){
    return $this->url;
  }

  public function setUrl($url){
    $this->url = $url;
  }

  public function getId_field(){
    return $this->id_field;
  }

  public function setId_field($id_field){
    $this->id_field = $id_field;
  }

  public function getReorderid(){
    return $this->reorderid;
  }

  public function setReorderid($reorderid){
    $this->reorderid = $reorderid;
  }

}

class ReorderItemDO extends DataObject {

  private $itemid;
  private $inventoryrecord;
  private $quantity;
  private $comments;

  private $inventory_id;
  private $receive_record;


  function __construct($itemid, $quantity, $inventoryid) {

    $this->quantity = $quantity;
    $this->itemid = $itemid;
    $this->inventory_id = $inventoryid;

  }

  public function getReceive_record(){
    return $this->receive_record;
  }

  public function setReceive_record($receive_record){
    $this->receive_record = $receive_record;
  }

  public function getInventory_id(){
    return $this->inventory_id;
  }

  public function setInventory_id($inventory_id){
    $this->inventory_id = $inventory_id;
  }

  public function getItemid(){
    return $this->itemid;
  }

  public function setItemid($itemid){
    $this->itemid = $itemid;
  }

  public function getInventoryrecord(){
    return $this->inventoryrecord;
  }

  public function setInventoryrecord($inventoryrecord){
    $this->inventoryrecord = $inventoryrecord;
  }

  public function getQuantity(){
    return $this->quantity;
  }

  public function setQuantity($quantity){
    $this->quantity = $quantity;
  }

  public function getComments(){
    return $this->comments;
  }

  public function setComments($comments){
    $this->comments = $comments;
  }


}

class ReceiveRecordDO extends DataObject {

  private $recordUUID; // unique id for reach receive record
  private $itemid;
  private $reorderid;
  private $qtyreceived=0;
  private $datereceived;
  private $status;
  //private $receipt; // attachment
  
  

  private $userid;
  private $inventoryrecord;

  function __construct($recordUUID, $itemid, $userid) {

    $this->recordUUID = $recordUUID;
    $this->itemid = $itemid;
    $this->userid = $userid;
  }
  
  
  	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}



  public function getInventoryrecord(){
    return $this->inventoryrecord;
  }

  public function setInventoryrecord($inventoryrecord){
    $this->inventoryrecord = $inventoryrecord;
  }

  public function getReorderid(){
    return $this->reorderid;
  }

  public function setReorderid($reorderid){
    $this->reorderid = $reorderid;
  }

  public function getRecordUUID(){
    return $this->recordUUID;
  }

  public function setRecordUUID($recordUUID){
    $this->recordUUID = $recordUUID;
  }

  public function getItemid(){
    return $this->itemid;
  }

  public function setItemid($itemid){
    $this->itemid = $itemid;
  }

  public function getQtyreceived(){
    return $this->qtyreceived;
  }

  public function setQtyreceived($qtyreceived){
    $this->qtyreceived = $qtyreceived;
  }

  public function getDatereceived(){
    return $this->datereceived;
  }

  public function setDatereceived($datereceived){
    $this->datereceived = $datereceived;
  }

  public function getReceipt(){
    return $this->receipt;
  }

  public function setReceipt($receipt){
    $this->receipt = $receipt;
  }

  public function getUserid(){
    return $this->userid;
  }

  public function setUserid($userid){
    $this->userid = $userid;
  }


}


class ReorderDO extends DataObject {
 
  private $reorderid;
  //private $quoteid;
  private $description;
  private $dateinitiated;
  private $authorizer;
  private $status;
  private $comments;


  private $userid;
  private $unitid;

  private $reorderitems = array();
  private $quotes = array();
  private $attachments = array();
  private $records = array();

 function __construct($reorderid, $description, $status, $dateinitiated, $userid, $unitid) {
	
    $this->reorderid = $reorderid;
    //$this->quoteid = $quoteid;
    $this->status = $status;
    $this->dateinitiated = $dateinitiated;
    $this->userid = $userid;
    $this->unitid = $unitid;
    $this->description = $description;
  

 }




 public function getReorderitems(){
    return $this->reorderitems;
  }

  public function setReorderitems($reorderitems){
    $this->reorderitems = $reorderitems;
  }

  public function getQuotes(){
    return $this->quotes;
  }

  public function setQuotes($quotes){
    $this->quotes = $quotes;
  }

  public function getAttachments(){
    return $this->attachments;
  }

  public function setAttachments($attachments){
    $this->attachments = $attachments;
  }

  public function getRecords(){
    return $this->records;
  }

  public function setRecords($records){
    $this->records = $records;
  }

  public function getUserid(){
    return $this->userid;
  }

  public function setUserid($userid){
    $this->userid = $userid;
  }

  public function getUnitid(){
    return $this->unitid;
  }

  public function setUnitid($unitid){
    $this->unitid = $unitid;
  }

 

  public function getQuoteid(){
    return $this->quoteid;
  }

  public function setQuoteid($quoteid){
    $this->quoteid = $quoteid;
  }

  public function getReorderid(){
    return $this->reorderid;
  }

  public function setReorderid($reorderid){
    $this->reorderid = $reorderid;
  }

  public function getDescription(){
    return $this->description;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function getDateinitiated(){
    return $this->dateinitiated;
  }

  public function setDateinitiated($dateinitiated){
    $this->dateinitiated = $dateinitiated;
  }

  public function getAuthorizer(){
    return $this->authorizer;
  }

  public function setAuthorizer($authorizer){
    $this->authorizer = $authorizer;
  }

   public function getStatus(){
    return $this->status;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getComments(){
    return $this->comments;
  }

  public function setComments($comments){
    $this->comments = $comments;
  }


}

