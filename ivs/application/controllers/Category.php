<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Category extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
  	        $this->listcategories();
    } else {
            $this->displayPageWithData('index', null);
    }

   }


  /* Screen displays */
  public function edit_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->editcategory($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function remove_get($c) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->deletecategory($c, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  public function new_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->newcategory(0, array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }





  /* Form operations */
  public function save_post() {

    $this->load->model('CategoryM');
    $data = $this->CategoryM->insertCategory();
 
    if ($data['msgType'] == 'error') {
     $this->newcategory($c, $data);
    }
    else {
     $this->listcategories($data);
    }

  }

  public function update_post($c) {

    $this->load->model('CategoryM');
    $data = $this->CategoryM->updateCategory();
 
    if ($data['msgType'] == 'error') {
     $this->editcategory($c, $data);
    }
    else {
     $this->listcategories($data);
    }

  }

  public function delete_post($c) {

    $this->load->model('CategoryM');
    $data = $this->CategoryM->deleteCategory();
 
    if ($data['msgType'] == 'error') {
     $this->deletecategory($c, $data);
    }
    else {
     $this->listcategories($data);
    }

  } 







  /* Private */

  private function listcategories($data=array()) {

    $this->load->model('CategoryM');
    $data['categorylist'] =  $this->CategoryM->getCategories(' unitid=' . $this->session->userdata('unitId') );

    // show listing 
    $this->displayPageWithData('category/list', $data);

  }

  private function editcategory($c, $data) {

    $this->load->model('CategoryM');

    $data['categoryDO'] = $this->CategoryM->getCategoryFromId(DOFactory::getInstance()->createDO(DOEnum::CategoryDO,array('CATEGORYID'=>$c)));
    $data['mode'] = 'edit';
    $data['action'] = 'category/update/' . $c;
    $data['btnLabel'] = 'Update';
    $data['backAction'] = 'category/index';

    $this->displayPageWithData('category/form', $data);

  }

  private function deletecategory($c, $data) {

    $this->load->model('CategoryM');

    $data['categoryDO'] = $this->CategoryM->getCategoryFromId(DOFactory::getInstance()->createDO(DOEnum::CategoryDO,array('CATEGORYID'=>$c)));
    $data['mode'] = 'remove';
    $data['action'] = 'category/delete/' . $c;
    $data['btnLabel'] = 'Remove';
    $data['backAction'] = 'category/index';

    $this->displayPageWithData('category/form', $data);

  }

  private function newcategory($c, $data) {

    $this->load->model('CategoryM');

    $data['categoryDO'] = DOFactory::getInstance()->createDO(DOEnum::CategoryDO,array('CATEGORYID'=>$c));
    $data['mode'] = 'new';
    $data['action'] = 'category/save/' . $c;
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'category/index';

    $this->displayPageWithData('category/form', $data); 

  }
   

 }