 <?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


 
 require_once APPPATH.'/libraries/REST_Controller.php';  

class IVS_Application extends REST_Controller {
 function __construct() {
  parent::__construct();
 }
 
 /**
  * displays the header, footer and the page to be diplayed
  * if the session is not set, the only pages the user can access are
  *  - login/login
  * all other pages are ovrewritten by the main view
  * 
  * @param string $page
  * @param array $data
  */
 protected function displayPageWithData($page, $data) {
  
	  
      if (!isset($data['page_title'])) {
	$data['page_title'] = 'Inventory System v 1.0 - 2015';
      }

      $loggedon = false;
      $record = $this->session->logon_userRec;
      if ($record != null || $record != '' || $record != false) {
         $loggedon = true; 
      }

      $data['alerts'] = null;
      $data['requests'] = null;
      $data['pages'] = null;

      if($this->session->userId != '' && $this->session->userId != null && $this->session->unitId != '' && $this->session->unitId != null && $loggedon === true) {

				  if($this->session->userType != 'Client User') {
					   $data['alerts'] = $this->getAllInventoryAlerts();
					   $data['requests'] = $this->listRequest();
				  }

                                 
       // get all pages
       $data['pages'] = $this->getMenu();        
      }else $page = 'login/login';
      
      

      $this->load->view('header', $data);
      $this->load->view($page, $data);
      $this->load->view('footer', $data);

 }
 
 private function getMenu() {
     
     $this->load->model('PageM');
     return $this->PageM->GetAllPages($this->session->roleid);
     
 }
 

 private function getAllInventoryAlerts() {

    $this->load->model('InventoryM');
    return $this->InventoryM-> GetAllInventoryWithAlerts(1,  $this->session->unitId );


  }

  private function listRequest() {

    $this->load->model('RequestM');
    return $this->RequestM->ListAllRequestsByStatus($this->session->unitId, "PENDING" );

  }
 
  /**
  * gets the user record from the user id. if the user id is invalid, return false,
  * else return a UserDO with user record
  * @param type $userId
  * @return UserDO or FALSE if the user id is not valid
  */
 protected function getUser($userId) {

  if (is_numeric($userId)) {
   $this->load->model('User');
   $udo = $this->User->getUserFromId(DOFactory::getInstance()->createDO(DOEnum::UserDO,array('USERID'=>$userId)));
   if (strlen($udo->getUserName()) > 0) {
    return $udo;
   }
  }
  return false;
  
 }








 /****************CLIENT **********************/
 protected function displayPageWithData2($page, $data) {
  
      if (!isset($data['page_title'])) {
       $data['page_title'] = 'Inventory System v 1.0 - 2015';
      }
      
      $this->load->view('header2',$data);
      $this->load->view($page, $data);
      $this->load->view('footer2', $data);

 }


}

/* End of file ACQList.php */
/* Location: /ACQList.php */
