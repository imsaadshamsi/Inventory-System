<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class Logger {
 
 private $db;
 
 function __construct($db) {
     $this->db = $db;
 }
 
 private function generateuuid() {
         

    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
     mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
     mt_rand( 0, 0xffff ),
     mt_rand( 0, 0x0fff ) | 0x4000,
     mt_rand( 0, 0x3fff ) | 0x8000,
     mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
	
 }
 
 public function log(LogDO $param) {
     
     $param->setLogguuid($this->generateuuid());
     
     $sql = 'insert into logs(loguuid, querytype, tablename, fieldname, fieldvalue, date, unitid, userid,idfield, idfieldvalue) values(' . 
            $this->db->escape($param->getLogguuid()) . ',' . 
             $this->db->escape($param->getQuerytype()) . ',' .
             $this->db->escape($param->getTablename()) . ',' .
             $this->db->escape($param->getFieldname()) . ', "' .
             $param->getFieldvalue() . '",' .
             $param->getDate(). ',' .
             $param->getUnitid() . ',' .
             $param->getUserid() . ',' .
             $this->db->escape($param->getIdfield()). ',' .
             $this->db->escape($param->getIdfieldvalue()) .
      ')';
	 
      $this->db->query($sql);
			
			
 }


}

