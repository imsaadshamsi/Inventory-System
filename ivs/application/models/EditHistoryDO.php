<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class EditHistoryDO extends DataObject {
 
	private $historyid;
	private $inventoryid;
	private $userid;
	private $oldquantity;
	private $newquantity;
	private $oldmin;
	private $newmin;
	private $oldstatus;
	private $newstatus;
	private $oldsnum;
	private $newsnum;
	private $olddesc;
	private $newdesc;
	private $oldcat;
	private $newcat;
	private $oldcomments;
	private $newcomments;
	private $dateoccurred;
	private $oldshelvingid;
	private $newshelvingid;
	private $reasonforedit;
	private $oldname;
	private $newname;

	
	function __construct($historyid, $userid, $inventoryid) {
		
		$this->historyid = $historyid;
		$this->userid = $userid;
		$this->inventoryid = $inventoryid;
	  
	}
	
	public function getOldname(){
		return $this->oldname;
	}

	public function setOldname($oldname){
		$this->oldname = $oldname;
	}

	public function getNewname(){
		return $this->newname;
	}

	public function setNewname($newname){
		$this->newname = $newname;
	}
 
	public function getHistoryid(){
		return $this->historyid;
	}

	public function setHistoryid($historyid){
		$this->historyid = $historyid;
	}

	public function getInventoryid(){
		return $this->inventoryid;
	}

	public function setInventoryid($inventoryid){
		$this->inventoryid = $inventoryid;
	}

	public function getUserid(){
		return $this->userid;
	}

	public function setUserid($userid){
		$this->userid = $userid;
	}

	public function getOldquantity(){
		return $this->oldquantity;
	}

	public function setOldquantity($oldquantity){
		$this->oldquantity = $oldquantity;
	}

	public function getNewquantity(){
		return $this->newquantity;
	}

	public function setNewquantity($newquantity){
		$this->newquantity = $newquantity;
	}

	public function getOldmin(){
		return $this->oldmin;
	}

	public function setOldmin($oldmin){
		$this->oldmin = $oldmin;
	}

	public function getNewmin(){
		return $this->newmin;
	}

	public function setNewmin($newmin){
		$this->newmin = $newmin;
	}

	public function getOldstatus(){
		return $this->oldstatus;
	}

	public function setOldstatus($oldstatus){
		$this->oldstatus = $oldstatus;
	}

	public function getNewstatus(){
		return $this->newstatus;
	}

	public function setNewstatus($newstatus){
		$this->newstatus = $newstatus;
	}

	public function getOldsnum(){
		return $this->oldsnum;
	}

	public function setOldsnum($oldsnum){
		$this->oldsnum = $oldsnum;
	}

	public function getNewsnum(){
		return $this->newsnum;
	}

	public function setNewsnum($newsnum){
		$this->newsnum = $newsnum;
	}

	public function getOlddesc(){
		return $this->olddesc;
	}

	public function setOlddesc($olddesc){
		$this->olddesc = $olddesc;
	}

	public function getNewdesc(){
		return $this->newdesc;
	}

	public function setNewdesc($newdesc){
		$this->newdesc = $newdesc;
	}

	public function getOldcat(){
		return $this->oldcat;
	}

	public function setOldcat($oldcat){
		$this->oldcat = $oldcat;
	}

	public function getNewcat(){
		return $this->newcat;
	}

	public function setNewcat($newcat){
		$this->newcat = $newcat;
	}

	public function getOldcomments(){
		return $this->oldcomments;
	}

	public function setOldcomments($oldcomments){
		$this->oldcomments = $oldcomments;
	}

	public function getNewcomments(){
		return $this->newcomments;
	}

	public function setNewcomments($newcomments){
		$this->newcomments = $newcomments;
	}

	public function getDateoccurred(){
		return $this->dateoccurred;
	}

	public function setDateoccurred($dateoccurred){
		$this->dateoccurred = $dateoccurred;
	}

	public function getOldshelvingid(){
		return $this->oldshelvingid;
	}

	public function setOldshelvingid($oldshelvingid){
		$this->oldshelvingid = $oldshelvingid;
	}

	public function getNewshelvingid(){
		return $this->newshelvingid;
	}

	public function setNewshelvingid($newshelvingid){
		$this->newshelvingid = $newshelvingid;
	}

	public function getReasonforedit(){
		return $this->reasonforedit;
	}

	public function setReasonforedit($reasonforedit){
		$this->reasonforedit = $reasonforedit;
	}
 
 


 
  
 

}

