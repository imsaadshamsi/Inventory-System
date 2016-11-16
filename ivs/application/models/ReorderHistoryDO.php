<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class ReorderHistoryDO extends DataObject {
 
	private $historyid;
	private $reorderid;
	private $status;
	private $userid; 
	private $comments;
	private $dateoccurred;

 
 function __construct($historyid, $reorderid, $userid) {
	
	$this->historyid = $historyid;
	$this->reorderid = $reorderid;
	$this->userid = $userid;
  
 }
 
 
 public function getHistoryid(){
		return $this->historyid;
	}

	public function setHistoryid($historyid){
		$this->historyid = $historyid;
	}

	public function getReorderid(){
		return $this->reorderid;
	}

	public function setReorderid($reorderid){
		$this->reorderid = $reorderid;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getUserid(){
		return $this->userid;
	}

	public function setUserid($userid){
		$this->userid = $userid;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getDateoccurred(){
		return $this->dataoccurred;
	}

	public function setDateoccurred($dataoccurred){
		$this->dataoccurred = $dataoccurred;
	}

 
  
 

}

