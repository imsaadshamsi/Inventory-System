<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'ChartsDAO.php';



class ChartsM extends IVSModel {

	function __construct() {
	  parent::__construct();
	}

	public function getRequestsForPeriod($where=null){
		
		$e = new ChartsDAO();
		return $e->getRequestsForPeriod($this->db, $where);

	}
	
	public function getRequestsForDate($where=null) {
		
		$e = new ChartsDAO();
		return $e->getRequestsForDate($this->db, $where);
	
	}

 
}

