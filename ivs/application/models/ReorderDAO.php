<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class ReorderDAO extends DataAccessObject {


	function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	}

	protected function populateReorderDO(ReorderDO $udo, array $row) {
	  
	  if (array_key_exists('REORDERID',$row)) {
	   $udo->setReorderid($row['REORDERID']);
	  }
	  
	  if (array_key_exists('STATUS',$row)) {
	   $udo->setStatus($row['STATUS']);
	  }

	  if (array_key_exists('DESCRIPTION',$row)) {
	   $udo->setDescription($row['DESCRIPTION']);
	  }


	   if (array_key_exists('COMMENTS',$row)) {
	   $udo->setComments($row['COMMENTS']);
	  }


	  if (array_key_exists('DATEINITIATED',$row)) {
	   $udo->setDateinitiated($row['DATEINITIATED']);
	  }

	  if (array_key_exists('USERID',$row)) {
	   $udo->setUserid($row['USERID']);
	  }


	  if (array_key_exists('UNITID',$row)) {
	   $udo->setUnitid($row['UNITID']);
	  }

	 


	  return $udo;
	}

	public function next(\DataObject $do = null) {
	  
	  if (is_null($do)) {
	   $do = DOFactory::getInstance()->createDO(DOEnum::ReorderDO);
	  }
	  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
	   $result = $this->getRs()->result_array();
	   $do = $this->populateReorderDO($do, $result[$this->getCurrent_row()]);
	  }
	  $t = $this->getCurrent_row() + 1;
	  $this->setCurrent_row($t);
	  return $do;
	  
	}




	//  private $currentRow;
	//  protected $rs;
	//  protected $columnNames;
 
	//  function __construct() {
	//   $this->columnNames = ' REORDERID, a.INVENTORYID, a.DESCRIPTION, DATEINITIATED, DATERECEIVED, PONUMBER, a.COMMENTS, a.STATUS, b.NAME, QUOTEID ';
	//   $this->currentRow = 0;
	//  }
	 
	 
	// /**
	//   * execute the query to get the users and apply where clause
	//   * @param CI_DB $db
	//   * @param string $where
	//   * @return CI_DB_result
	//   */
	//  protected function setResultSet($db, $where = NULL) {

	//   $sql = 'select '.$this->columnNames .' FROM Reorders a, Inventory b ';
	//   $sql =  $sql . ' where a.inventoryid = b.inventoryid ';
	//   if (!is_null($where)) {
	//    $sql = $sql.' and '.$where;
	//   }
	//   $sql = $sql.' order by reorderid ';

	//   $this->rs = $db->query($sql);

	//  }
	 
	 
	//   /**
	//   * populate a userdo from a row from the result set
	//   * @param UserDO $udo
	//   * @param array $row
	//   * @return \UserDO
	//   */
	//  protected function populateReorderDO(ReorderDO $udo, array $row) {
		  
	// 	  if (array_key_exists('REORDERID',$row)) {
	// 	   $udo->setReorderid($row['REORDERID']);
	// 	  }
		  
	// 	  if (array_key_exists('STATUS',$row)) {
	// 	   $udo->setStatus($row['STATUS']);
	// 	  }

	// 	  if (array_key_exists('DESCRIPTION',$row)) {
	// 	   $udo->setDescription($row['DESCRIPTION']);
	// 	  }

	// 	  if (array_key_exists('DATERECEIVED',$row)) {
	// 	   $udo->setDatereceived($row['DATERECEIVED']);
	// 	  }

	// 	  if (array_key_exists('NAME',$row)) {
	// 	   $udo->setInventoryname($row['NAME']);
	// 	  }

	// 	   if (array_key_exists('PONUMBER',$row)) {
	// 	   $udo->setPonumber($row['PONUMBER']);
	// 	  }
		  
	// 	   if (array_key_exists('COMMENTS',$row)) {
	// 	   $udo->setComments($row['COMMENTS']);
	// 	  }

	// 	  if (array_key_exists('INVENTORYID',$row)) {
	// 	   $udo->setInventoryid($row['INVENTORYID']);
	// 	  }

	// 	  if (array_key_exists('DATEINITIATED',$row)) {
	// 	   $udo->setDateinitiated($row['DATEINITIATED']);
	// 	  }

	// 	  if (array_key_exists('QUOTEID',$row)) {
	// 	   $udo->setQuoteid($row['QUOTEID']);
	// 	  }

	// 	  if (array_key_exists('DATERECEIVED',$row)) {
	// 	   $udo->setDatereceived($row['DATERECEIVED']);
	// 	  }

	// 	  return $udo;
	// }
	 
	 
	//  /**
	//   * gets the next record from the result set and populates the passed UserDO 
	//   * (a UserDO is created if it is null). 
	//   * @param \DataObject $do
	//   * @return \UserDO if no more results are avaialble return empty DO.
	//   */
	//  public function next(\DataObject $do = null) {
	// 	  if (is_null($do)) {
	// 	   $do = DOFactory::getInstance()->createDO(DOEnum::ReorderDO);
	// 	  }
	// 	  if ($this->currentRow < $this->rs->num_rows()) {
	// 	   $result = $this->rs->result_array();
	// 	   $do = $this->populateReorderDO($do, $result[$this->currentRow]);
	// 	  }
	// 	  $this->currentRow = $this->currentRow + 1;
	// 	  return $do;
	//  }
	 
	 
	// public function getReorder($db,$where=null) {
	// 	$this->setResultSet($db,$where);
	// }
	
	// public function hasMoreReorder() {
	// 	if ($this->currentRow < $this->rs->num_rows()) {
	// 		return true;
	// 	}
	// 	return false;
	// }
	
	// public function getReorderFromId($db,$udo){
	// 	$this->setResultSet($db, ' reorderid = '. $udo->getReorderid());
	// }

}