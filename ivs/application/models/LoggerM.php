<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'LoggerDAO.php';


class LoggerM extends IVSModel {


	private $colNames = ' LOGUUID, TABLENAME, QUERYTYPE, FIELDNAME, FIELDVALUE, IDFIELD, IDFIELDVALUE, DATE, UNITID, USERID ';
	
	
	function __construct() {
	  parent::__construct();
	}

	public function GetLogsByTable($tablename) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM logs where tablename=' . $this->db->escape($tablename) . ' and unitid=' . $this->session->unitId;
		return $this->initializeDAO($sql);
		
	}
        
        public function GetLogsByID($fieldid, $fieldidvalue) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM logs where idfield=' . $this->db->escape($fieldid) . ' and idfieldvalue=' . $this->db->escape($fieldidvalue) . ' and unitid=' . $this->session->unitId;
		return $this->initializeDAO($sql);
		
	}

	
	protected function initializeDAO($sql) {
		
		$e = new LoggerDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

 
}

