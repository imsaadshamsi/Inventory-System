<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


/* class QuoteItemDO extends DataObject {

  private $qitemid;
  private $quoteid;
  private $itemid;
  private $Note;
  private $unitprice;
  private $unit;
  private $quantity;

  function __construct($qitemid, $quoteid, $itemid) {
   
    $this->qitemid = $qitemid;
    $this->quoteid = $quoteid;
    $this->itemid = $itemid;

  }

    public function getQitemid(){
    return $this->qitemid;
  }

  public function setQitemid($qitemid){
    $this->qitemid = $qitemid;
  }

  public function getquoteid(){
    return $this->quoteid;
  }

  public function setquoteid($quoteid){
    $this->quoteid = $quoteid;
  }

  public function getItemid(){
    return $this->itemid;
  }

  public function setItemid($itemid){
    $this->itemid = $itemid;
  }

  public function getNote(){
    return $this->Note;
  }

  public function setNote($Note){
    $this->Note = $Note;
  }

  public function getUnitprice(){
    return $this->unitprice;
  }

  public function setUnitprice($unitprice){
    $this->unitprice = $unitprice;
  }

  public function getUnit(){
    return $this->unit;
  }

  public function setUnit($unit){
    $this->unit = $unit;
  }

  public function getQuantity(){
    return $this->quantity;
  }

  public function setQuantity($quantity){
    $this->quantity = $quantity;
  }

}
 */
class QuoteDO extends DataObject {
 
  private $quoteid;
  private $reorderid;
  private $quoteurl;

  private $quoteamount;

  private $deliverydate;
  private $supplierid;

  private $title;
  private $selected;
  private $userid;
  
  private $Note;

 
 function __construct($quoteid, $reorderid, $title, $supplierid) {
	
  $this->quoteid = $quoteid;
  $this->title = $title;
  $this->supplierid = $supplierid;
  $this->reorderid = $reorderid;
  
 }
 
 	public function getNote(){
		return $this->Note;
	}

	public function setNote($Note){
		$this->Note = $Note;
	}

  public function getUserid(){
    return $this->userid;
  }

  public function setUserid($userid){
    $this->userid = $userid;
  }

  public function getSelected(){
    return $this->selected;
  }

  public function setSelected($selected){
    $this->selected = $selected;
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

  public function getQuoteurl(){
    return $this->quoteurl;
  }

  public function setQuoteurl($quoteurl){
    $this->quoteurl = $quoteurl;
  }

  public function getQuoteamount(){
    return $this->quoteamount;
  }

  public function setQuoteamount($quoteamount){
    $this->quoteamount = $quoteamount;
  }

  public function getDeliverydate(){
    return $this->deliverydate;
  }

  public function setDeliverydate($deliverydate){
    $this->deliverydate = $deliverydate;
  }

  public function getSupplierid(){
    return $this->supplierid;
  }

  public function setSupplierid($supplierid){
    $this->supplierid = $supplierid;
  }

  public function getTitle(){
    return $this->title;
  }

  public function setTitle($title){
    $this->title = $title;
  }

  

 

  
 

}

