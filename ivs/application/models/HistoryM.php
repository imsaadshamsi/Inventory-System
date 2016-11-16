<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'ReorderHistoryDAO.php';
include 'RequestHistoryDAO.php';
include 'EditHistoryDAO.php';


class HistoryM extends IVSModel {

	function __construct() {
	  parent::__construct();
	}

	
	public function getReorderHistory($where=null) {
		
		$e = new ReorderHistoryDAO();
		$e->getReorderHistory($this->db, $where);
		return $e;
	
	}
	
	public function getRequestHistory($where=null) {
		
		$e = new RequestHistoryDAO();
		$e->getRequestHistory($this->db, $where);
		return $e;
	
	}
	
	public function getEditHistory($unitid) {
		
		$e = new EditHistoryDAO();
		$e->getEditHistory($this->db, $unitid);
		return $e;
	
	}

	public function getAllInventory($unitid) {

		$e = new EditHistoryDAO();
		$e->getEditHistory($this->db, ' where unitid= ' . $unitid);
		return $e;
	}
        
        
        public function getDisbursementHistory($inventoryid) {
            
            
            
        }
	
}

