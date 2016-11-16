<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Setting extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
  	        $this->listSettings();
    } else {
            $this->displayPageWithData('index', null);
    }

   }


  /* Screen displays */
  public function edit_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->editSetting($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function remove_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->deleteSetting($c, array());
    } else {
            $this->displayPage('index');
    }

  }

  public function new_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->newSetting(0, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }





  /* Form operations */
  public function save_post() {

    $this->load->model('SettingM');
    $data = $this->SettingM->insertSetting();
 
    if ($data['msgType'] == 'error') {
     $this->newSetting(0, $data);
    }
    else {
     $this->listSettings($data);
    }

  }

  public function update_post($c) {

    $this->load->model('SettingM');
    $data = $this->SettingM->updateSetting();
 
    if ($data['msgType'] == 'error') {
     $this->editSetting($c, $data);
    }
    else {
     $this->listSettings($data);
    }

  }

  public function delete_post($c) {

    $this->load->model('SettingM');
    $data = $this->SettingM->deleteSetting();
 
    if ($data['msgType'] == 'error') {
     $this->deleteSetting($c, $data);
    }
    else {
     $this->listSettings($data);
    }

  } 







  /* Private */

  private function listSettings($data=array()) {

    $this->load->model('SettingM');
    $data['settingList'] =  $this->SettingM->getSettings(' unitid=' . $this->session->userdata('unitId') );

    // show listing 
    $this->displayPageWithData('settings/list', $data);

  }

  private function editSetting($c, $data) {

    $this->load->model('SettingM');

    $data['settingDO'] = $this->SettingM->getSettingFromId(DOFactory::getInstance()->createDO(DOEnum::SettingDO,array('SETTINGID'=>$c)));
    $data['mode'] = 'edit';
    $data['action'] = 'setting/update/' . $c;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'setting/index';

    $this->displayPageWithData('settings/form', $data);

  }

  private function deleteSetting($c, $data) {

    $this->load->model('SettingM');

    $data['settingDO'] = $this->SettingM->getSettingFromId(DOFactory::getInstance()->createDO(DOEnum::SettingDO,array('SETTINGID'=>$c)));
    $data['mode'] = 'remove';
    $data['action'] = 'setting/delete/' . $c;
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'setting/index';

    $this->displayPageWithData('settings/form', $data);

  }

  private function newSetting($c, $data) {

    $this->load->model('SettingM');

    $data['settingDO'] = DOFactory::getInstance()->createDO(DOEnum::SettingDO,array('SETTINGID'=>$c));
    $data['mode'] = 'new';
    $data['action'] = 'setting/save/' . $c;
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'setting/index';

    $this->displayPageWithData('settings/form', $data); 

  }
   

 }