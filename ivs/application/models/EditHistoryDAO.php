<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class EditHistoryDAO extends DataAccessObject {

	 private $currentRow;
	 protected $rs;
	 protected $columnNames;
 
	 function __construct() {
	  $this->columnNames = ' USERID, HISTORYID, INVENTORYID, REASONFOREDIT, DATEOCCURRED, OLDQUANTITY, NEWQUANTITY, OLDSTATUS, NEWSTATUS,
	  OLDMIN, NEWMIN, OLDSNUM, NEWSNUM, OLDNAME, NEWNAME, OLDDESC, NEWDESC, OLDCAT, NEWCAT, OLDCOMMENTS, NEWCOMMENTS, OLDSHELVINGID, NEWSHELVINGID ';
	  $this->currentRow = 0;
	 }
	 
	 
	/**
	  * execute the query to get the users and apply where clause
	  * @param CI_DB $db
	  * @param string $where
	  * @return CI_DB_result
	  */
	 protected function setResultSet($db, $where = NULL) {
	  $sql = 'select '.$this->columnNames .' FROM edithistory a ';
	  //$sql = $sql . ' where a.userid = b.userid ' ;
	 if (!is_null($where)) {
	   $sql = $sql.$where;
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
	 protected function populateHistoryDO(EditHistoryDO $udo, array $row) {
		  

		  if (array_key_exists('HISTORYID',$row)) {
		   $udo->setHistoryid($row['HISTORYID']);
		  }
		  if (array_key_exists('INVENTORYID',$row)) {
		   $udo->setInventoryid($row['INVENTORYID']);
		  }
		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserid($row['USERID']);
		  }
		  if (array_key_exists('REASONFOREDIT',$row)) {
		   $udo->setReasonforedit($row['REASONFOREDIT']);
		  }
		  if (array_key_exists('DATEOCCURRED',$row)) {
		   $udo->setDateoccurred($row['DATEOCCURRED']);
		  }
		  if (array_key_exists('OLDQUANTITY',$row)) {
		   $udo->setOldquantity($row['OLDQUANTITY']);
		  }
		  if (array_key_exists('NEWQUANTITY',$row)) {
		   $udo->setNewquantity($row['NEWQUANTITY']);
		  }
		  if (array_key_exists('OLDSNUM',$row)) {
		   $udo->setOldsnum($row['OLDSNUM']);
		  }
		  if (array_key_exists('NEWSNUM',$row)) {
		   $udo->setNewsnum($row['NEWSNUM']);
		  }
		  if (array_key_exists('OLDMIN',$row)) {
		   $udo->setOldmin($row['OLDMIN']);
		  }
		  if (array_key_exists('NEWMIN',$row)) {
		   $udo->setNewmin($row['NEWMIN']);
		  }
		  if (array_key_exists('OLDCOMMENTS',$row)) {
		   $udo->setOldcomments($row['OLDCOMMENTS']);
		  }
		  if (array_key_exists('NEWCOMMENTS',$row)) {
		   $udo->setNewcomments($row['NEWCOMMENTS']);
		  }
		  if (array_key_exists('OLDCAT',$row)) {
		   $udo->setOldcat($row['OLDCAT']);
		  }
		  if (array_key_exists('NEWCAT',$row)) {
		   $udo->setNewcat($row['NEWCAT']);
		  }
		  if (array_key_exists('OLDSHELVINGID',$row)) {
		   $udo->setOldshelvingid($row['OLDSHELVINGID']);
		  }
		  if (array_key_exists('NEWSHELVINGID',$row)) {
		   $udo->setNewshelvingid($row['NEWSHELVINGID']);
		  }
		  if (array_key_exists('OLDDESC',$row)) {
		   $udo->setOlddesc($row['OLDDESC']);
		  }
		  if (array_key_exists('NEWDESC',$row)) {
		   $udo->setNewdesc($row['NEWDESC']);
		  }
		  if (array_key_exists('OLDNAME',$row)) {
		   $udo->setOldname($row['OLDNAME']);
		  }
		  if (array_key_exists('NEWNAME',$row)) {
		   $udo->setNewname($row['NEWNAME']);
		  }
		  if (array_key_exists('OLDSTATUS',$row)) {
		   $udo->setOldstatus($row['OLDSTATUS']);
		  }
		  if (array_key_exists('NEWSTATUS',$row)) {
		   $udo->setNewstatus($row['NEWSTATUS']);
		  }
		 /* if (array_key_exists('NEW',$row)) {
		   $udo->set($row['NEW']);
		  }
		  if (array_key_exists('OLD',$row)) {
		   $udo->set($row['OLD']);
		  }
		  if (array_key_exists('NEW',$row)) {
		   $udo->set($row['NEW']);
		  }*/
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
		   $do = DOFactory::getInstance()->createDO(DOEnum::EditHistoryDO);
		  }
		  if ($this->currentRow < $this->rs->num_rows()) {
		   $result = $this->rs->result_array();
		   $do = $this->populateHistoryDO($do, $result[$this->currentRow]);
		  }
		  $this->currentRow = $this->currentRow + 1;
		  return $do;
	 }
	 
	 
	public function getEditHistory($db,$where=null) {
		$this->setResultSet($db,$where);
	}
	
	public function hasMoreHistory() {
		if ($this->currentRow < $this->rs->num_rows()) {
			return true;
		}
		return false;
	}


}