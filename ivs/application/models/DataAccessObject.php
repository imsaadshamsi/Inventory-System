<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of DataAccessObject
 * abstract class for the data access objects
 * @author user
 */
abstract class DataAccessObject {


     protected $current_row=0;
	 protected $rs;
	 protected $sql;
	 protected $db = null;
	 
	function __construct($sql, $db) {
	  $this->setSql($sql);
	  $this->setDb($db);
	  $this->current_row = 0;
	 }
	 
	 public function setCurrent_row($current_row) {
		$this->current_row = $current_row;
	 }
	 
	 public function setRs($rs) {
		$this->rs = $rs;
	}
	
	public function setSql($sql) {
		$this->sql = $sql;
	}
		
	public function setDb($db) {
		$this->db = $db;
	}
			
	public function getCurrent_row(){
		return $this->current_row;
	}
			
	public function getRs(){
		return $this->rs;
	}
				
	public function getSql() {
		return $this->sql;
	}
					
	public function getDb() {
		return $this->db;
	}

	 /**
	  * signature for the next function, used to iterate over 
	  * the result set and return a DO
	  */
	 abstract public function next(DataObject $do = null);
	 
	 /**
	  * determines if the result set has more records
	  * @param CI_DB_result $rs
	  * @return boolean
	  */
	 public function hasMore() {
		  if ($this->current_row < $this->rs->num_rows()) {
		   return true;
		  }
		  return false;
	 }
 
	protected function setResultSet() {
		$this->rs = $this->db->query($this->sql);
	}
	
	public function process() {
		$this->setResultSet();
	}
	
}

/* End of file DataAccessObject.php */
/* Location: /DataAccessObject.php */