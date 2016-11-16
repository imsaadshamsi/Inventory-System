<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Location extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
  	        $this->listlocations();
    } else {
            $this->displayPageWithData('index', null);
    }

   }


  /* Screen displays */
  public function edit_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->editlocation($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function remove_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->deletelocation($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function new_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->newlocation(0, array());
    } else {
           $this->displayPageWithData('index', null);
    }

  }





  /* Form operations */
  public function save_post() {

    $this->load->model('LocationM');
    $data = $this->LocationM->insertLocation();
 
    if ($data['msgType'] == 'error') {
     $this->newlocation($c, $data);
    }
    else {
     $this->listlocations($data);
    }

  }

  public function update_post($c) {

    $this->load->model('LocationM');
    $data = $this->LocationM->updateLocation();
 
    if ($data['msgType'] == 'error') {
     $this->editlocation($c, $data);
    }
    else {
     $this->listlocations($data);
    }

  }

  public function delete_post($c) {

    $this->load->model('LocationM');
    $data = $this->LocationM->deleteLocation();
 
    if ($data['msgType'] == 'error') {
     $this->deletelocation($c, $data);
    }
    else {
     $this->listlocations($data);
    }

  } 


  /* Private */

  private function listlocations($data=array()) {

    $this->load->model('LocationM');
    $data['locationlist'] =  $this->LocationM->getLocations(' unitid=' . $this->session->userdata('unitId'));

    // show listing 
    $this->displayPageWithData('location/list', $data);

  }

  private function editlocation($c, $data) {

    $this->load->model('LocationM');

    $data['locationDO'] = $this->LocationM->getLocationFromId(DOFactory::getInstance()->createDO(DOEnum::LocationDO,array('LOCATIONID'=>$c)));
    $data['mode'] = 'edit';
    $data['action'] = 'location/update/' . $c;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'location/index';

    $this->displayPageWithData('location/form', $data);

  }

  private function deletelocation($c, $data) {

    $this->load->model('LocationM');

    $data['locationDO'] = $this->LocationM->getLocationFromId(DOFactory::getInstance()->createDO(DOEnum::LocationDO,array('LOCATIONID'=>$c)));
    $data['mode'] = 'remove';
    $data['action'] = 'location/delete/' . $c;
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'location/index';

    $this->displayPageWithData('location/form', $data);

  }

  private function newlocation($c, $data) {

    $this->load->model('LocationM');

    $data['locationDO'] = DOFactory::getInstance()->createDO(DOEnum::LocationDO,array('LOCATIONID'=>$c));
    $data['mode'] = 'new';
    $data['action'] = 'location/save/' . $c;
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'location/index';

    $this->displayPageWithData('location/form', $data); 

  }
   

 }