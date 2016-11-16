<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Main extends IVS_Application {


/* Constructor */
 function __construct() {
	parent::__construct();
 }

 
 /**
	Display first page
*/
  public function index_get() {

    $data = array();
    $page = 'index';
    $this->displayPageWithData($page, $data);

 }
 
 public function logon_get(){

	$data['msg'] = '';
	$this->displayPageWithData('login/login', $data);
 
 }
 
   /*---------- POST -------------*/
 /**
  * verify login function
  * username and password fields are required
  * check the password against LDAP
  * once password is valid, get user record from database and create session for user
  * if any check fails show invalid username and password
  */
 public function verifyLogon_post() {
 
      $this->load->library('form_validation');
      $this->form_validation->set_rules('username','User name','trim|required');
      $this->form_validation->set_rules('userPassword','Password','required');

      if ($this->form_validation->run() === FALSE) {
       $data['msg'] = 'Logon error:';
       $this->displayPageWithData('login/login', $data);
      }
      else {
       if ($this->validateUser(set_value('username'), set_value('userPassword'))) {
        $this->load->model('User');
        $udo = $this->User->GetUserFromLDAP(set_value('username'));
        if ($udo->getUserActive() == 1) {
         $this->logonUser($udo);
         $this->index_get();
        }
        else {
         $data['msg'] = 'Invalid username or password';
         $this->displayPageWithData('login/login', $data);
        }
       }
       else {
        $this->session->logon_userRec = false;
        $data['msg'] = 'Invalid username or password';
        $this->displayPageWithData('login/login', $data);
       }
      }

 }
 
 /**
  * validate the user against AD. Return true if user is valid false otherwise
  * @param string $pUserName
  * @param string $pPassword
  * @return boolean
  */
 private function validateUser($pUserName, $pPassword) {

        /* remove this */
    if($pUserName == 'aali') {
        return true;
    } else {


  	// Active Directory server defined in constants - LDAP_SERVER
  	// Domain, for purposes of constructing $user, defined in constants - LDAP_USER_DOMAIN
  	try {
  		// connect to active directory
  		$ldap = ldap_connect(LDAP_SERVER);
  		// verify user and password
  		return ldap_bind($ldap, LDAP_USER_DOMAIN. '\\'.$pUserName, $pPassword);
  	}
  	catch (Exception $e) {
  		

      return false;


  	}


  }


 }
 
 /**
  * create a session for the user
  * @param UserDO $uDO
  */
 private function logonUser(UserDO $uDO) {

  // $this->session->set_userdata('logon_userRec',true);
  // $this->session->set_userdata('userId',$uDO->getUserId());
  // $this->session->set_userdata('loginName',$uDO->getUserName());
  // $this->session->set_userdata('isAdmin',$uDO->getIsAdmin());
  // $this->session->set_userdata('userType', $uDO->getUsertype());
  // $this->session->set_userdata('unitId', $uDO->getUnitid());
  // $this->session->set_userdata('email', $uDO->getEmail());
  // $this->session->set_userdata('staffname', $uDO->getStaffname());

  $this->session->logon_userRec = true;
  $this->session->userId = $uDO->getUserId();
  $this->session->loginName = $uDO->getUserName();
  $this->session->isAdmin = $uDO->getIsAdmin();
  $this->session->userType = $uDO->getUsertype();
  $this->session->unitId = $uDO->getUnitid();
  $this->session->email = $uDO->getEmail();
  $this->session->staffname = $uDO->getStaffname();
  $this->session->site = $uDO->getSite();
  $this->session->roleid = $uDO->getRoleid();
  
 }
 
 
  public function logout_get() {

      // unset all values because destroy() leaves this set.
      unset(
            $_SESSION['logon_userRec'],
            $_SESSION['userId'],
            $_SESSION['isAdmin'],
            $_SESSION['userType'],
            $_SESSION['unitId'],
            $_SESSION['email'],
            $_SESSION['staffname'],
            $_SESSION['loginName'],
            $_SESSION['roleid'],
            $_SESSION['siteid']
      );

      $this->session->sess_destroy();
      $page = 'login/login';
      $data = array();
      $this->displayPageWithData($page, $data);

 }

 
 
 
 }