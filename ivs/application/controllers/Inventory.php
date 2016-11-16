<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Inventory extends IVS_Application {


   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption', 0);
   }
   

  public function index_get() {
      
 


    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
  	        $this->listInventory();
    } else {
            $this->displayPageWithData('index', null);
    }

   }

  private function listInventory($data=array()) {

    


    $this->load->model('InventoryM');
    $data['inventorylist'] =  $this->InventoryM->GetAllInventory($this->session->userdata('unitId') );
    $data['action'] = 'inventory/search';

    // show listing 
    $this->displayPageWithData('inventory/list', $data);

  }


  public function search_post() {
    
    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
            $this->searchInventory();
    } else {
            $this->displayPage('index');
    }

   }

  private function searchInventory($data=array()) {

    $this->load->model('InventoryM');
    $data['inventorylist'] =  $this->InventoryM->getInventoryBySearch($_POST['search']);
  
    $data['action'] = 'inventory/search';

    // show listing 
    $this->displayPageWithData('inventory/list', $data);

  }

  public function edit_get($c) {

    $data['inventoryid'] = $c;
    $this->load->model('InventoryM');
    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
            $data['inventoryDO'] = $this->InventoryM->GetInventoryFromId($data['inventoryid']);
            $this->editInventory($data);
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  private function editInventory($data) {

    $this->load->model('ShelvingM');
    $this->load->model('CategoryM');

    $data['shelvinglist'] = $this->ShelvingM->getShelvingsList($this->session->unitId );
    $data['categorylist'] = $this->CategoryM->getCategories(' unitid=' . $this->session->userdata('unitId') );

    $data['mode'] = 'edit';
    $data['action'] = 'inventory/update';
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'inventory/index';

    $this->displayPageWithData('inventory/form', $data);

  }

  public function update_post() {

    $this->load->model('InventoryM');
    $data = $this->InventoryM->updateInventory();
 
    if ($data['msgType'] == 'error') {
     $this->editInventory($data);
    }
    else {
     $this->listInventory($data);
    }

  }


  public function new_get() {
      
      $this->load->model('InventoryM');

    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null) {
      //  $data['inventoryDO'] = DOFactory::getInstance()->createDO(DOEnum::InventoryDO,array('INVENTORYID'=> 0,'UNITID'=>$this->session->userdata('unitId')));
        $data['inventoryDO'] = DOFactory::getInstance()->createDO(DOEnum::InventoryDO,array('INVENTORYID'=>0, 'UNITID'=>$this->session->userdata('unitId')));
        $this->newInventory($data);
    } else {
        $this->displayPage('index');
    }

  }

  private function newInventory($data) {

    $this->load->model('InventoryM');
    $this->load->model('ShelvingM');
    $this->load->model('CategoryM');


    $data['shelvinglist'] = $this->ShelvingM->getShelvingsList(' b.unitid=' . $this->session->userdata('unitId') );
    $data['categorylist'] = $this->CategoryM->getCategories(' unitid=' . $this->session->userdata('unitId') );

    $data['mode'] = 'new';
    $data['action'] = 'inventory/save';
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'inventory/index';

    $this->displayPageWithData('inventory/form', $data); 

  }

  public function save_post() {

    $this->load->model('InventoryM');
    $data = $this->InventoryM->insertInventory();
 
    if ($data['msgType'] == 'error') {

      $data['inventoryid'] = 0;
      $data['inventoryDO'] = DOFactory::getInstance()->createDO(DOEnum::InventoryDO,array('INVENTORYID'=>0, 'UNITID'=>$this->session->userdata('unitId'))); 
      $this->newInventory($data);
    }
    else {
     $this->listInventory($data);
    }

  }


  public function alerts_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null  && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null) {
            $this->getAllInventoryAlerts();
    } else {
            $this->displayPageWithData('index', null);
    }

  }


  private function getAllInventoryAlerts() {

    $this->load->model('InventoryM');
    $data['inventorylist'] =  $this->InventoryM->GetAllInventoryWithAlerts(1, $this->session->userdata('unitId') );

    // show listing 
    $this->displayPageWithData('alerts/alerts', $data);

  }



  public function pdf_get($c) {

    $this->load->model('InventoryM');
    $this->load->model('ShelvingM');
    $this->load->model('CategoryM');

    $udo = $data['inventoryDO'] = $this->InventoryM->GetInventoryFromId($c);
    $data['shelvinglist'] = $this->ShelvingM->getShelvingsList(' b.unitid=' . $this->session->userdata('unitId') );
    $data['categorylist'] = $this->CategoryM->getCategories(' unitid=' . $this->session->userdata('unitId') );

    $data['mode'] = 'pdf';

    $this->load->helper(array('dompdf', 'file'));
     
    // page info here, db calls, etc.     
    $html = $this->load->view('inventory/pdfformat', $data, true);
    pdf_create($html, 'Inventory Details - ' . $udo->getStocknumber());
    
    // or
    // $data = pdf_create($html, '', false);
    // write_file('name', $data);
    //if you want to write it to disk and/or send it as an attachment    
  }


}