<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class RequestHistoryDAO extends DataAccessObject {

	 private $currentRow;
	 protected $rs;
	 protected $columnNames;
 
	 function __construct() {
	  $this->columnNames = ' HISTORYID, REQUESTID, EVENT, a.USERID, COMMENTS, DATEOCCURRED, STATUS ';
	  $this->currentRow = 0;
	 }
	 
	 
	/**
	  * execute the query to get the users and apply where clause
	  * @param CI_DB $db
	  * @param string $where
	  * @return CI_DB_result
	  */
	 protected function setResultSet($db, $where = NULL) {
	  $sql = 'select '.$this->columnNames .' FROM requesthistory a, users b ';
	  $sql = $sql . ' where a.userid = b.userid ' ;
	  if (!is_null($where)) {
	   $sql = $sql.' and '.$where;
	  }
	  $sql = $sql.' LIMIT 50 order by dateoccurred DESC';

	  $this->rs = $db->query($sql);
	 }
	 
	 
	  /**
	  * populate a userdo from a row from the result set
	  * @param UserDO $udo
	  * @param array $row
	  * @return \UserDO
	  */
	 protected function populateHistoryDO(RequestHistoryDO $udo, array $row) {
		  

		  if (array_key_exists('HISTORYID',$row)) {
		   $udo->setHistoryid($row['HISTORYID']);
		  }
		  if (array_key_exists('COMMENTS',$row)) {
		   $udo->setComments($row['COMMENTS']);
		  }
		  if (array_key_exists('REQUESTID',$row)) {
		   $udo->setRequestid($row['REQUESTID']);
		  }
		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }
		  if (array_key_exists('STATUS',$row)) {
		   $udo->setStatus($row['STATUS']);
		  }
		  if (array_key_exists('DATEOCCURRED',$row)) {
		   $udo->setDateoccurred($row['DATEOCCURRED']);
		  }
		  return $udo;
	}
	 
	 
	 /**
	  * gets the next record from the result set and populates the passed UserDO 
	  * (a UserDO is created if it is null). 
	  * @param \DataObject $do
	  * @return \UserDO if no more results are avaialble return empty DO.
	  */
	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::RequestHistoryDO);
		  }
		  if ($this->currentRow < $this->rs->num_rows()) {
		   $result = $this->rs->result_array();
		   $do = $this->populateHistoryDO($do, $result[$this->currentRow]);
		  }
		  $this->currentRow = $this->currentRow + 1;
		  return $do;
	 }
	 
	 
	public function getRequestHistory($db,$where=null) {
		$this->setResultSet($db,$where);
	}
	
	public function hasMoreHistory() {
		if ($this->currentRow < $this->rs->num_rows()) {
			return true;
		}
		return false;
	}


}