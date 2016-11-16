<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Unit extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
  	        $this->listunits();
    } else {
           $this->displayPageWithData('index', null);
    }

   }


  /* Screen displays */
  public function edit_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->editUnit($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function remove_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->deleteUnit($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function new_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->newUnit(0, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }





  /* Form operations */
  public function save_post() {

    $this->load->model('UnitM');
    $data = $this->UnitM->insertUnit();
 
    if ($data['msgType'] == 'error') {
     $this->newUnit(0, $data);
    }
    else {
     $this->listunits($data);
    }

  }

  public function update_post($c) {

    $this->load->model('UnitM');
    $data = $this->UnitM->updateUnit();
 
    if ($data['msgType'] == 'error') {
     $this->editUnit($c, $data);
    }
    else {
     $this->listunits($data);
    }

  }

  public function delete_post($c) {

    $this->load->model('UnitM');
    $data = $this->UnitM->deleteUnit();
 
    if ($data['msgType'] == 'error') {
     $this->deleteUnit($c, $data);
    }
    else {
     $this->listunits($data);
    }

  } 







  /* Private */

  private function listunits($data=array()) {

    $this->load->model('UnitM');
    $data['unitlist'] =  $this->UnitM->GetAllUnits(null);

    // show listing 
    $this->displayPageWithData('unit/list', $data);

  }

  private function editUnit($c, $data) {

    $this->load->model('UnitM');

    $data['unitDO'] = $this->UnitM->getUnitFromId(DOFactory::getInstance()->createDO(DOEnum::UnitDO,array('UNITID'=>$c)));
    $data['mode'] = 'edit';
    $data['action'] = 'unit/update/' . $c;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'unit/index';

    $this->displayPageWithData('Unit/form', $data);

  }

  private function deleteUnit($c, $data) {

    $this->load->model('UnitM');

    $data['unitDO'] = $this->UnitM->getUnitFromId(DOFactory::getInstance()->createDO(DOEnum::UnitDO,array('UNITID'=>$c)));
    $data['mode'] = 'remove';
    $data['action'] = 'unit/delete/' . $c;
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'unit/index';

    $this->displayPageWithData('unit/form', $data);

  }

  private function newUnit($c, $data) {

    $this->load->model('UnitM');

    $data['unitDO'] = DOFactory::getInstance()->createDO(DOEnum::UnitDO,array('UNITID'=>$c));
    $data['mode'] = 'new';
    $data['action'] = 'unit/save/' . $c;
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'unit/index';

    $this->displayPageWithData('unit/form', $data); 

  }
   

 }