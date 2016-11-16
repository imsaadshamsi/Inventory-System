<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

require_once 'IVSModel.php';
include 'UserDAO.php';
//include 'GetUsersDAO.php';
//include 'GetUserDAO.php';

class User extends IVSModel {
	 
	private $colNames = ' USERID,USERNAME,LDAPUSERCODE,USERACTIVE,ISADMIN,UNITID,USERTYPE,EMAIL,STAFFNAME,SITE, ROLEID  ';
	
	
	 function __construct() {
	  parent::__construct();
	 }
	 
	 public function GetAllUsers() {
		
		$sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_USERS ';
		return $this->initializeDAO($sql);
		
	 }
	 
	 public function GetUserFromLDAP($usercode) {
		
		$sql = 'SELECT' . $this->colNames . ' FROM ZCORE_USERS where ldapUserCode=' . $this->db->escape($usercode);
		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;
		
	 }
         
         public function GetAllUsersWithRole($roleid) {
             
             $sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_USERS where roleid=' . $roleid;
		return $this->initializeDAO($sql);
             
             
         }
	 
	 public function GetUserFromID($userid) {
		
		$sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_USERS WHERE userid=' . $userid;
		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;
		
	 }
	 
	protected function initializeDAO($sql) {
		
		$e = new UserDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
	
	protected function isUniqueUserOther($usercode, $userid) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_USERS where ldapusercode="' . $usercode . '" AND userId<> ' . $userid;
		$t = $this->initializeDAO($sql);
		 if ($t->getRs()->num_rows() <= 0) {
		   return true;
		  }
		  return false;
  
	}

 private function setUserValidationRules() {

  $this->form_validation->set_rules('userName','Name','trim|required');
  $this->form_validation->set_rules('ldapUserCode','LDAP User Name','trim|required');
  $this->form_validation->set_rules('isAdmin','Is Admin','trim|required|is_natural|less_than[2]');
  $this->form_validation->set_rules('userActive','Status','trim|required|is_natural|less_than[2]');
  $this->form_validation->set_rules('unitid','Unit','trim|required');
  $this->form_validation->set_rules('usertype','User Type','trim|required');
  $this->form_validation->set_rules('email','Email','trim|required');
  $this->form_validation->set_rules('staffname','Staff Name','trim|required');
 }
 
 private function setUserIdValidationRule() {
  $this->form_validation->set_rules('userId','User ID','trim|required|is_natural_no_zero');
 }
 
 /**
  * validates the form data and creates a user record if valid. return an 
  * array containing the messages about the status of the record
  * @return array
  */
 public function insertUser() {
		  $data = array();
		  $this->load->library('form_validation');
		  $this->setUserValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['userDO'] = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive'), 'UNITID'=>set_value('unitid'), 'USERTYPE'=>set_value('usertype'), 'EMAIL'=>set_value('email'), 'STAFFNAME'=>set_value('staffname')
		   ));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive'), 'UNITID'=>set_value('unitid'), 'USERTYPE'=>set_value('usertype'),'EMAIL'=>set_value('email'), 'STAFFNAME'=>set_value('staffname')));

		 
		     if ($this->isUniqueUserOther($udo->getLdapUserCode(),  $udo->getUserId())) {
				$this->db->query('insert into ZCORE_USERS(userName, ldapUserCode, isAdmin, userActive, unitid, usertype, email, staffname) values('. $this->db->escape($udo->getUserName()).','.$this->db->escape($udo->getLdapUserCode()). ','. 
				  $udo->getIsAdmin().','. $udo->getUserActive() . ',' . 
				  $udo->getUnitid(). ','.
				  $this->db->escape($udo->getUsertype()). ',' .
				  $this->db->escape($udo->getEmail()) . ',' . 
				  $this->db->escape($udo->getStaffname()) .
			  ')');
			
			$data['msg'] = 'Created user successfully';
			$data['msgType'] = 'success';
		   }
		   else {
			$data['msg'] = 'The LDAP User Name entered has been used by another user. Please enter another.';
			$data['msgType'] = 'error';
			$data['userDO'] = $udo;
		   }
		  }
		  return $data;
 }
 
 /**
  * validates the form data and updates the user record if valid. return an
  * array containing the status of the record
  * @return array
  */
 public function updateUser() {
 
		  $data = array();
		  $this->load->library('form_validation');
		  $this->setUserValidationRules();
		  $this->setUserIdValidationRule();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['userDO'] = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERID'=>set_value('userId'),'USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive'), 'UNITID'=>set_value('unitid'), 'USERTYPE'=>set_value('usertype') , 'EMAIL'=>set_value('email'), 'STAFFNAME'=>set_value('staffname')
		   
		   ));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::UserDO, array('USERID'=>set_value('userId'),'USERNAME'=>set_value('userName'),'LDAPUSERCODE'=>set_value('ldapUserCode'),'ISADMIN'=>set_value('isAdmin'),'USERACTIVE'=>set_value('userActive'),'UNITID'=>set_value('unitid'), 'USERTYPE'=>set_value('usertype'), 'EMAIL'=>set_value('email'), 'STAFFNAME'=>set_value('staffname')
		   ));
		   

		   if ($this->isUniqueUserOther($udo->getLdapUserCode(),  $udo->getUserId())) {

			$this->db->query('update ZCORE_USERS set userName = '.$this->db->escape($udo->getUserName()).', ldapUserCode = '.$this->db->escape($udo->getLdapUserCode()).', isAdmin = '.$udo->getIsAdmin().
			  ', userActive = '.$udo->getUserActive() .
			  ', unitid = '.$udo->getUnitid() .
			  ', usertype = '. $this->db->escape($udo->getUsertype()) .
			  ', email=' . $this->db->escape($udo->getEmail()). 
			  ', staffname=' . $this->db->escape($udo->getStaffname()) . 
			' where userId = '.$udo->getUserId());

			$data['msg'] = 'Saved changes successfully';
			$data['msgType'] = 'success';
		   }
		   else {
			$data['msg'] = 'The LDAP User Name has been used by another user. Please enter another.';
			$data['msgType'] = 'error';
			$data['userDO'] = $udo;
		   }
		  }
		  return $data;
 }
 
 /**
  * validates the user id and removes the user record if valid. return an 
  * array containing the status of the record
  * @return array
  */
 public function deleteUser() {
  $data = array();
  $this->load->library('form_validation');
  $this->setUserIdValidationRule();
  if ($this->form_validation->run() === FALSE) {
   $data['msg'] = 'Validation errors:';
   $data['msgType'] = 'error';
  }
  else {
   $this->db->query('delete from users where userId = '.set_value('userId'));
   $data['msg'] = 'Removed user successfully';
   $data['msgType'] = 'success';
  }
  return $data;
 }

 
}

/* End of file User.php */
/* Location: /User.php */