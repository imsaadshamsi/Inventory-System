<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Charts extends IVS_Application {


  /* Constructor */
   function __construct() {
       parent::__construct();
       $this->session->set_userdata('menuoption',0);
   }


  public function chart1_get() {

    $data = array();
    $data['btnLabel'] = 'Generate';

     // show listing 
    $this->displayPageWithData('charts/chart1', $data);

  }

  public function chart1data_post() {

    $this->load->model('ChartsM');
    $data = $this->ChartsM->getRequestsForPeriod(' datereceived>="' . $_POST['sdate'] . '" and datereceived<="' . $_POST['edate'] . '" ');
    echo $data;

  }




 }