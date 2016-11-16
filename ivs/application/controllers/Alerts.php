<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Alerts extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption', 0);
   }
   

  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null  && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null) {
            $this->getAllInventoryAlerts();
    } else {
            $this->displayPageWithData('index', null);
    }

   }


  /* Private */

  private function getAllInventoryAlerts() {

    $this->load->model('InventoryM');
    $data['inventorylist'] =  $this->InventoryM->getInventory(' flag=1 and unitid=' . $this->session->userdata('unitId') );

    // show listing 
    $this->displayPageWithData('alerts/alerts', $data);

  }


   

 }