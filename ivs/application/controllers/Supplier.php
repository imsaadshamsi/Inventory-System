<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Supplier extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
  	        $this->listsuppliers();
    } else {
           $this->displayPageWithData('index', null);
    }

   }


  /* Screen displays */
  public function edit_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->editsupplier($c, array());
    } else {
           $this->displayPageWithData('index', null);
    }

  }

  public function remove_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->deletesupplier($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function new_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->newsupplier(0, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }





  /* Form operations */
  public function save_post() {

    $this->load->model('SupplierM');
    $data = $this->SupplierM->insertsupplier();
 
    if ($data['msgType'] == 'error') {
     $this->newsupplier($c, $data);
    }
    else {
     $this->listsuppliers($data);
    }

  }

  public function update_post($c) {

    $this->load->model('SupplierM');
    $data = $this->SupplierM->updatesupplier();
 
    if ($data['msgType'] == 'error') {
     $this->editsupplier($c, $data);
    }
    else {
     $this->listsuppliers($data);
    }

  }

  public function delete_post($c) {

    $this->load->model('supplierM');
    $data = $this->supplierM->deletesupplier();
 
    if ($data['msgType'] == 'error') {
     $this->deletesupplier($c, $data);
    }
    else {
     $this->listsuppliers($data);
    }

  } 







  /* Private */

  private function listsuppliers($data=array()) {

    $this->load->model('SupplierM');
    $data['supplierlist'] =  $this->SupplierM->getSuppliers(' unitid=' . $this->session->userdata('unitId') );

    // show listing 
    $this->displayPageWithData('supplier/list', $data);

  }

  private function editsupplier($c, $data) {

    $this->load->model('SupplierM');

    $data['supplierDO'] = $this->SupplierM->getSupplierFromId(DOFactory::getInstance()->createDO(DOEnum::SupplierDO,array('SUPPLIERID'=>$c)));
    $data['mode'] = 'edit';
    $data['action'] = 'supplier/update/' . $c;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'supplier/index';

    $this->displayPageWithData('supplier/form', $data);

  }

  private function deletesupplier($c, $data) {

    $this->load->model('SupplierM');

    $data['supplierDO'] = $this->SupplierM->getSupplierFromId(DOFactory::getInstance()->createDO(DOEnum::SupplierDO,array('SUPPLIERID'=>$c)));
    $data['mode'] = 'remove';
    $data['action'] = 'supplier/delete/' . $c;
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'supplier/index';

    $this->displayPageWithData('supplier/form', $data);

  }

  private function newsupplier($c, $data) {

    $this->load->model('SupplierM');

    $data['supplierDO'] = DOFactory::getInstance()->createDO(DOEnum::SupplierDO,array('SUPPLIERID'=>$c));
    $data['mode'] = 'new';
    $data['action'] = 'supplier/save/' . $c;
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'supplier/index';

    $this->displayPageWithData('supplier/form', $data); 

  }
   

 }