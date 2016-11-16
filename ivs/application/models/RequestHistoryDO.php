<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class RequestHistoryDO extends DataObject {
 
	private $historyid;
	private $requestid;
	private $event;
	private $status;
	private $userid; 
	private $comments;
	private $dateoccurred;

 
 function __construct($historyid, $requestid, $userid) {
	
	$this->historyid = $historyid;
	$this->requestid = $requestid;
	$this->userid = $userid;
  
 }
 
 
 public function getHistoryid(){
		return $this->historyid;
	}

	public function setHistoryid($historyid){
		$this->historyid = $historyid;
	}

	public function getRequestid(){
		return $this->requestid;
	}

	public function setRequestid($requestid){
		$this->requestid = $requestid;
	}

	public function getEvent(){
		return $this->event;
	}

	public function setEvent($event){
		$this->event = $event;
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
		return $this->dateoccurred;
	}

	public function setDateoccurred($dateoccurred){
		$this->dateoccurred = $dateoccurred;
	}

 
  
 

}

