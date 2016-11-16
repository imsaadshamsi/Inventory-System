<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Reports extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }


   public function report1_get() {
	
		$data = array();
		$data['btnLabel'] = 'Generate';

		 // show listing 
		$this->displayPageWithData('reports/report1', $data);
   }
   
    public function report1data_post() {

		$this->load->model('ChartsM');
		$data = $this->ChartsM->getRequestsForDate(' datereceived="' . $_POST['sdate'] . '" ');
		echo $data;

  }

   




 }