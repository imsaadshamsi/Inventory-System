<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Shelving extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  public function index_get($locationid) {

    $data['locationid'] = $locationid;

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
  	        $this->listShelvings($data);
    } else {
            $this->displayPageWithData('index', null);
    }

   }


  /* Screen displays */
  public function edit_get($c, $d) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->editShelving($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function remove_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->deleteShelving($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function new_get($locationid) {

    $data['locationid'] = $locationid; 

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->newShelving(0, $data);
    } else {
             $this->displayPageWithData('index' .$locationid, null); 
    }

  }





  /* Form operations */
  public function save_post() {

    $this->load->model('ShelvingM');
    $data = $this->ShelvingM->insertShelving();
    $data['locationid'] = $_POST['locationid'];
 
    if ($data['msgType'] == 'error') {
     $this->newShelving($c, $data);
    }
    else {
     $this->listShelvings($data);
    }

  }

  public function update_post($c) {

    $this->load->model('ShelvingM');
    $data = $this->ShelvingM->updateShelving();
    $data['locationid'] = $_POST['locationid'];

    if ($data['msgType'] == 'error') {
     $this->editShelving($c, $data);
    }
    else {
     $this->listShelvings($data);
    }

  }

  public function delete_post($c) {

    $this->load->model('ShelvingM');
    $data = $this->ShelvingM->deleteShelving();
    $data['locationid'] = $_POST['locationid'];
 
    if ($data['msgType'] == 'error') {
     $this->deleteShelving($c, $data);
    }
    else {
     $this->listShelvings($data);
    }

  } 


  /* Private */

  private function listShelvings($data=array()) {

    $this->load->model('ShelvingM');
    $data['shelvinglist'] =  $this->ShelvingM->getShelvings(' locationid=' . $data['locationid']);

    // show listing 
    $this->displayPageWithData('shelving/list', $data);

  }

  private function editShelving($c, $data) {

    $this->load->model('ShelvingM');

    $udo = $data['shelvingDO'] = $this->ShelvingM->getShelvingFromId(DOFactory::getInstance()->createDO(DOEnum::ShelvingDO,array('SHELVINGID'=>$c))); 

    $data['mode'] = 'edit';
    $data['action'] = 'shelving/update/' . $c;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'shelving/index/' . $udo->getLocationid();

    $this->displayPageWithData('shelving/form', $data);

  }

  private function deleteShelving($c, $data) {

    $this->load->model('ShelvingM');

    $udo = $data['shelvingDO'] = $this->ShelvingM->getShelvingFromId(DOFactory::getInstance()->createDO(DOEnum::ShelvingDO,array('SHELVINGID'=>$c)));
    $data['mode'] = 'remove';
    $data['action'] = 'shelving/delete/' . $c;
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'shelving/index/' . $udo->getLocationid();;

    $this->displayPageWithData('shelving/form', $data);

  }

  private function newShelving($c, $data) {

    $this->load->model('ShelvingM');

    $udo = $data['shelvingDO'] = DOFactory::getInstance()->createDO(DOEnum::ShelvingDO, array('SHELVINGID'=>$c, 'LOCATIONID'=>$data['locationid']));
    $data['mode'] = 'new';
    $data['action'] = 'shelving/save/' . $c;
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'shelving/index/' . $udo->getLocationid();

    $this->displayPageWithData('shelving/form', $data); 

  }
   

 }