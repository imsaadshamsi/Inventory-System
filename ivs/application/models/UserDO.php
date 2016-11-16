<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of UserDO
 * user data object
 * @author user
 */
class UserDO extends DataObject {

 private $userId;
 private $username;
 private $ldapUserCode;
 private $userActive;
 private $isAdmin;
 private $unitid;
 private $usertype; 
 private $email;
 private $staffname;
 private $site;
 private $roleid;


 function __construct($userId, $username, $ldapUserCode, $userActive, $isAdmin, $unitid, $usertype, $email, $staffname, $siteid, $roleid) {

        $this->userId = $userId;
        $this->username = $username;
        $this->ldapUserCode = $ldapUserCode;
        $this->userActive = $userActive;
        $this->isAdmin = $isAdmin;
        $this->unitid = $unitid;
        $this->usertype = $usertype;
        $this->staffname = $staffname;
        $this->email = $email;
        $this->site = $siteid;
        $this->roleid = $roleid;


 }
 
 	public function getRoleid(){
		return $this->roleid;
	}

	public function setRoleid($roleid){
		$this->roleid = $roleid;
	}
 
 public function getSite() {
     return $this->site;
 }

 public function setSite($id) {
     $this->site = $id;
 }
 
 public function getUserId(){
		return $this->userId;
	}

	public function setUserId($userId){
		$this->userId = $userId;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getLdapUserCode(){
		return $this->ldapUserCode;
	}

	public function setLdapUserCode($ldapUserCode){
		$this->ldapUserCode = $ldapUserCode;
	}

	public function getUserActive(){
		return $this->userActive;
	}

	public function setUserActive($userActive){
		$this->userActive = $userActive;
	}

	public function getIsAdmin(){
		return $this->isAdmin;
	}

	public function setIsAdmin($isAdmin){
		$this->isAdmin = $isAdmin;
	}

	public function getUnitid(){
		return $this->unitid;
	}

	public function setUnitid($unitid){
		$this->unitid = $unitid;
	}

	public function getUsertype(){
		return $this->usertype;
	}

	public function setUsertype($usertype){
		$this->usertype = $usertype;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getStaffname(){
		return $this->staffname;
	}

	public function setStaffname($staffname){
		$this->staffname = $staffname;
	}

	

}

/* End of file UserDO.php */
/* Location: /UserDO.php */