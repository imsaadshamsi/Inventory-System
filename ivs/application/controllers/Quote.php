<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Quote extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }

  public function index_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
            $this->listQuotes($c);
    } else {
            $this->displayPageWithData('index', null);
    }

   }
   

  public function new_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null) {
            $this->newQuote($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function edit_get($r, $c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
            $this->editQuote($r, $c, array());
    } else {
            $this->displayPage('index');
    }

  }




  public function save_post() {

    $this->load->model('QuoteM');
    $data = $this->QuoteM->insertQuote();
 
    if ($data['msgType'] == 'error') {
     $this->newQuote($_POST['reorderid'], $data);
    }
    else {
     $this->listQuotes($_POST['reorderid'], $data);
    }

  }

  public function update_post($r) {

    $this->load->model('QuoteM');
    $data = $this->QuoteM->updateQuote();
 
    if ($data['msgType'] == 'error') {
     $this->editQuote($r, $_POST['reorderid'], array());
    }
    else {
     $this->listQuotes($_POST['reorderid'], $data);
    }

  }


public function viewFile_get($a) {

    $this->load->helper('download');
    if($this->uri->segment(3))
    {
        $data   = file_get_contents('./uploads/'.$a);
    }
    $name   =  $a; //$this->uri->segment(3);
    force_download($name, $data);
  

  //$data['a'] = $a;
  //$this->displayPageWithData('quote/viewpdf', $data);

}

/* Private Functions */
  private function newQuote($c, $data) {

    $this->load->model('QuoteM');
    $this->load->model('SupplierM');
    $this->load->model('ReorderM');

    $data['quoteDO'] = DOFactory::getInstance()->createDO(DOEnum::QuoteDO,array('QUOTEID'=>0,'REORDERID'=>$c));
    $data['supplierlist'] = $this->SupplierM->getSuppliers(' status= "CURRENT" and unitid=' . $this->session->userdata('unitId'));
    $data['reorderDO'] = $this->ReorderM->getReorderFromId(DOFactory::getInstance()->createDO(DOEnum::ReorderDO,array('REORDERID'=>$c)));


    $data['mode'] = 'new';
    $data['action'] = 'quote/save';
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'Quote/index';

    $this->displayPageWithData('quote/form', $data); 

  }


  /* Private */
  private function listQuotes($c, $data=array()) {

    $this->load->model('QuoteM');
    $this->load->model('ReorderM');

    $data['quotelist'] = $this->QuoteM->getQuote(' reorderid=' . $c );
    $data['reorderDO'] = $this->ReorderM->getReorderFromId(DOFactory::getInstance()->createDO(DOEnum::ReorderDO,array('REORDERID'=>$c)));
    
    // show listing 
    $this->displayPageWithData('quote/list', $data);

  }

  private function editQuote($r, $c, $data) {

    $this->load->model('QuoteM');
    $this->load->model('SupplierM');
    $this->load->model('ReorderM');

    $data['quoteDO'] = $this->QuoteM->getQuoteFromId(DOFactory::getInstance()->createDO(DOEnum::QuoteDO,array('QUOTEID'=>$r)));
    $data['supplierlist'] = $this->SupplierM->getSuppliers(' status= "CURRENT" and unitid=' . $this->session->userdata('unitId'));
    $data['reorderDO'] = $this->ReorderM->getReorderFromId(DOFactory::getInstance()->createDO(DOEnum::ReorderDO,array('REORDERID'=>$c)));

    $data['mode'] = 'edit';
    $data['action'] = 'quote/update/' . $r;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'quote/index/' . $c;

    $this->displayPageWithData('quote/form', $data);

  }



















 }