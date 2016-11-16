<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'PageDAO.php';


class PageM extends IVSModel {


	private $colNames = ' a.PAGEID, a.NAME, a.URL, a.RENDERNAME ';
	
	
	function __construct() {
	  parent::__construct();
	}

	public function GetAllPages($roleid) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM zcore_pages a, zcore_permissions b where b.pageid=a.pageid and b.roleid=' . $roleid;
                $sql = $sql . ' order by a.ordering ';
		return $this->initializeDAO($sql);
		
	}
	

	
	protected function initializeDAO($sql) {
		
		$e = new PageDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

 
 
}

