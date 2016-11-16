<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



/*******************/
require 'IVS_Application.php';
/*******************/

class Users extends IVS_Application {


/* Constructor */
 function __construct() {
	parent::__construct();
 }
 
 /**
	Display first page
*/
  public function index_get() {
	  $this->showUserList(array());
 }
 
  
 /**
  * show the user list
  * @param array $data
  */
 private function showUserList(array $data) {
  $this->load->model('User');
  $data['userList'] = $this->User->GetAllUsers();
  $this->displayPageWithData('users/list', $data);
 }

 public function user_get(){
	
	$this->load->model('User');
	$data['userDO'] = DOFactory::getInstance()->createDO(DOEnum::UserDO,array('USERID'=>0));
	$this->showNewUserForm($data);
  
 }
 
 public function edit_get($userId){
	  
	  $this->load->model('User');
	  $udo = $this->User->GetUserFromID($userId);
	  if ($udo === FALSE) {
	   $this->showUserList(array());
	  }
	  else {
	   $data['userDO'] = $udo;
	   $this->showEditUserForm($data);
	  }
  
 }
 
 
 public function user_post(){
  
  $this->load->model('User');
  $data = $this->User->insertUser();
  if ($data['msgType'] == 'error') {
   $this->showNewUserForm($data);
  }
  else {
   $this->showUserList($data);
  }
 
 }
 
 public function updateUser_post(){
 
 $this->load->model('User');
  $data = $this->User->updateUser();
  if ($data['msgType'] == 'error') {
   $this->showEditUserForm($data);
  }
  else {
   $this->showUserList($data);
  }
 
 }
 
 
 public function remove_get($userId) {

  $this->load->model('User');
  $udo = $this->User->GetUserFromID($userId);

  if ($udo === FALSE) {
   $this->showUserList(array());
  }
  else {
   $data['userDO'] = $udo;
   $this->showRemoveUserForm($data);
  }
 }
 
 public function remove_post(){
	 $this->load->model('User');
	$this->showUserList($this->User->deleteUser());
 
 }
 
 
 
 
  private function showRemoveUserForm($data) {

    $this->load->model('UnitM');
    $data['unitlist'] =  $this->UnitM->GetAllUnits();

    $data['mode'] = 'remove';
    $data['action'] = 'users/remove';
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'users/index';
    $this->displayPageWithData('users/form', $data);
 }
 
 
 
 
  private function showNewUserForm(array $data) {

    $this->load->model('UnitM');
    $data['unitlist'] =  $this->UnitM->GetAllUnits();


    $data['mode'] = 'new';
    $data['action'] = 'users/user';
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'users/index';

    $this->displayPageWithData('users/form', $data);

 }
 
  private function showEditUserForm($data) {

    $this->load->model('UnitM');
    $data['unitlist'] =  $this->UnitM->GetAllUnits();

    $data['mode'] = 'edit';
    $data['action'] = 'users/updateUser';
    $data['btnLabel'] = 'Save Changes';
    $data['backAction'] = 'users/index';
    $this->displayPageWithData('users/form', $data);
 }
 
 
 
 
 }