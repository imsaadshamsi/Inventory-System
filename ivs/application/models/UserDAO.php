<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

/**
 * Description of UserDAO
 * abstrat parent of user DAO classes
 * @author user
 */
require_once 'DataAccessObject.php';

class UserDAO extends DataAccessObject {


	 function __construct($sql, $db) {
	  parent::__construct($sql, $db);
	 }


 
 /**
  * populate a userdo from a row from the result set
  * @param UserDO $udo
  * @param array $row
  * @return \UserDO
  */
 protected function populateUserDO(UserDO $udo, array $row) {
  
		  if (array_key_exists('USERID',$row)) {
		   $udo->setUserId($row['USERID']);
		  }
		  if (array_key_exists('USERNAME',$row)) {
		   $udo->setUserName($row['USERNAME']);
		  }
		  if (array_key_exists('LDAPUSERCODE',$row)) {
		   $udo->setLdapUserCode($row['LDAPUSERCODE']);
		  }
		  if (array_key_exists('USERACTIVE',$row)) {
		   $udo->setUserActive($row['USERACTIVE']);
		  }
		  if (array_key_exists('ISADMIN',$row)) {
		   $udo->setIsAdmin($row['ISADMIN']);
		  }

		  if (array_key_exists('UNITID',$row)) {
		   $udo->setUnitid($row['UNITID']);
		  }

		  if (array_key_exists('EMAIL',$row)) {
		   $udo->setEmail($row['EMAIL']);
		  }

		  if (array_key_exists('USERTYPE',$row)) {
		   $udo->setUsertype($row['USERTYPE']);
		  }
		  
		  if (array_key_exists('STAFFNAME',$row)) {
		   $udo->setStaffname($row['STAFFNAME']);
		  }
                  
                  if (array_key_exists('SITE',$row)) {
		   $udo->setSite($row['SITE']);
		  }

                   if (array_key_exists('ROLEID',$row)) {
		   $udo->setRoleid($row['ROLEID']);
		  }
		  return $udo;
 }
 
 
 	 public function next(\DataObject $do = null) {
		  if (is_null($do)) {
		   $do = DOFactory::getInstance()->createDO(DOEnum::UserDO);
		  }
		  if ($this->getCurrent_row()< $this->getRs()->num_rows()) {
		   $result = $this->getRs()->result_array();
		   $do = $this->populateUserDO($do, $result[$this->getCurrent_row()]);
		  }
		  $t = $this->getCurrent_row() + 1;
		  $this->setCurrent_row($t);
		  return $do;
	 }
	 
 
}

/* End of file UserDAO.php */
/* Location: /UserDAO.php */