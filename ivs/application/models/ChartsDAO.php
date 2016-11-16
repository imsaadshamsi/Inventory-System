<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'DataAccessObject.php';

class ChartsDAO extends DataAccessObject {

	 protected $rs;

	 function __construct() {

	 }

	 
	public function getRequestsForPeriod($db, $where=null) {
	  
	  //$this->setResultSet($db,$where);
	  $sql = 'select datereceived as y , count(datereceived) as a from request '; 
	  //' where datereceived>='2015-02-24' and datereceived<='2015-02-28' group by datereceived;';
	  if (!is_null($where)) {
	   $sql = $sql.' where '.$where;
	  }
	  $sql = $sql.' group by datereceived order by datereceived asc ';
	  $this->rs = $db->query($sql);

	  // convert result set to result array
	  $result = $this->rs->result_array();
	  
	  return json_encode($result);

	}
	
	public function getRequestsForDate($db, $where=null){
		
	  $sql = 'select * from request '; 
	  if (!is_null($where)) {
	   $sql = $sql.' where '.$where;
	  }
	  $this->rs = $db->query($sql);
	  // convert result set to result array
	  $result = $this->rs->result_array();
	  
	  //return json_encode($result);
	  $r = '{ "data":' . json_encode($result) . '}';
	  return $r;
	
	}

	 public function next(\DataObject $do = null) {
		  // leave empty
	 }




}