<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Dashboard extends IVS_Application {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',0);
 }

 
 /**
	Display first page
*/
  public function index_get() {
	 
   if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null) {
      
                $data['msg'] = '';
                $this->load->model('InventoryM');
                $data['alert'] = $this->InventoryM->GetAllInventoryWithAlerts(1, $this->session->userdata('unitId') );
                $data['inventory'] = $this->InventoryM->GetAllInventory2($this->session->userdata('unitId'));
                $this->load->model('RequestM');
                $data['request'] = $this->RequestM->ListAllRequestsByStatus( $this->session->userdata('unitId'), "PENDING" );
                $this->load->model('ReorderM');
                $data['reorders'] = $this->ReorderM->GetAllReorders( $this->session->userdata('unitId'));

                $this->displayPageWithData('dashboard/index', $data);

	}

	
   }
	
}