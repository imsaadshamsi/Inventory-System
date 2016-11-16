<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Asset extends IVS_Application {


   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption', 0);
   }
   

  public function index_get() {
      
    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
      $this->displayIndex();
    } else {
      $this->displayPageWithData('index', null);
    }

  }

  public function asset_get($assetnumber){

    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
      $this->displayAsset($assetnumber);
    } else {
      $this->displayPageWithData('index', null);
    }

  }

  public function asset_post() {

     if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
      $this->saveAsset();
    } else {
      $this->displayPageWithData('index', null);
    }

  }

  public function export_get($assetnumber) {

    if($assetnumber == 'all')
      $this->generateListPDF();
    else
      $this->generateItemPDF($assetnumber);
    

  }

  private function displayIndex($data = array()) {

    $this->load->model('AssetM');

    // retreive all assets
    $data['assetlist'] =  $this->AssetM->getAllAssets();
    $data['action'] = 'asset/search';

    // show listing 
    $this->displayPageWithData('asset/list', $data);

  }

  private function displayAsset($assetnumber, $data=array()) {


    $this->load->model('AssetM');

    if($assetnumber == 0) {
        $data = $this->buildNewAsset();
    }else {
        $data = $this->buildEditAsset($assetnumber);
    }

    $this->displayPageWithData('asset/form', $data); 

  }

  private function buildEditAsset($assetnumber) {
      
      $data['assetDO'] = $this->AssetM->getAsset(DOFactory::getInstance()->createDO(DOEnum::AssetDO,array('ASSET_ID'=>$assetnumber)));
      $data['mode'] = 'edit';
      $data['action'] = 'asset/asset';
      $data['btnLabel'] = 'Save';
      $data['backAction'] = 'asset/index';

      return $data;
  }

  private function buildNewAsset() {
     
      $data['assetDO'] = DOFactory::getInstance()->createDO(DOEnum::AssetDO,array('ASSET_ID'=>0));
      $data['mode'] = 'new';
      $data['action'] = 'asset/asset';
      $data['btnLabel'] = 'Create';
      $data['backAction'] = 'asset/index';

      return $data;

  }

  private function saveAsset() {

    $this->load->model('AssetM');
    $data = array();

    if($_POST['assetid'] == 0) {

        $data = $this->AssetM->insertAsset();

    }else {

        $data = $this->AssetM->updateAsset();


    }


    if ($data['msgType'] == 'error') {
      $this->displayAsset($_POST['assetid'], $data);
    }
    else {
      $this->displayIndex($data);
    }


  }


  private function generateListPDF() {

     $this->load->model('AssetM');

    // retreive all assets
    $data['assetlist'] =  $this->AssetM->getAllAssets();
    $data['action'] = 'asset/search';

    

    $this->load->helper(array('dompdf', 'file'));
     
    // page info here, db calls, etc.     
    $html = $this->load->view('asset/list', $data, true);
    pdf_create($html, 'List of Assets' );
    


  }

  private function generateItemPDF($assetnumber) {

    $this->load->model('AssetM');

    $data = $this->buildEditAsset($assetnumber);

    $this->load->helper(array('dompdf', 'file'));
     
    // page info here, db calls, etc.     
    $html = $this->load->view('asset/form', $data, true);
    pdf_create($html, 'Asset Details' );
    
  }

 


}