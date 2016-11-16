<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class History extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption', 0);

}





public function inventoryhistory_get() {
    
    $this->load->model('LoggerM');
    $data['history'] = $this->LoggerM->GetLogsByTable('INVENTORY');
    $data['pagetitle'] = 'Inventory History';
    
    if( $this->session->unitId != '' && $this->session->unitId != null ) {
            $this->displayPageWithData('history/display', $data);
          } else {
              $this->displayPageWithData('index', null);
          }
    
    
}

public function inventoryhistoryid_get($id) {
    
    $this->load->model('LoggerM');
    $data['history'] = $this->LoggerM->GetLogsByID('STOCKNUMBER', $id);
    $data['pagetitle'] = 'Inventory History';
    
    if( $this->session->unitId != '' && $this->session->unitId != null ) {
            $this->displayPageWithData('history/display', $data);
          } else {
              $this->displayPage('index');
          }
    
    
}

public function requesthistory_get() {
    
    $this->load->model('LoggerM');
    $data['history'] = $this->LoggerM->GetLogsByTable('REQUEST');
    $data['pagetitle'] = 'Request History';
    
    if( $this->session->unitId != '' && $this->session->unitId != null ) {
            $this->displayPageWithData('history/display', $data);
          } else {
              $this->displayPageWithData('index', null);
          }
    
    
}

public function disbursementhistory_get($id) {
    
    
    $this->load->model('DisbursementM');
    
    $data['history'] = $this->DisbursementM->getDisbursementHistory($id, null, null);
    $data['pagetitle'] = 'Disbursements';
    $data['id'] = $id;
    
     if( $this->session->unitId != '' && $this->session->unitId != null ) {
            $this->displayPageWithData('history/disbursements', $data);
          } else {
              $this->displayPageWithData('index', null);
          }
    
    
}

public function disbursementhistory_post() {
    
    
    $this->load->model('DisbursementM');
    
    $data['history'] = $this->DisbursementM->getDisbursementHistory($_POST['id'], $_POST['sdate'], $_POST['tdate']);
    $data['pagetitle'] = 'Disbursements';
    $data['id'] = $_POST['id'];
    
    
     if( $this->session->unitId != '' && $this->session->unitId != null ) {
            $this->displayPageWithData('history/disbursements', $data);
          } else {
              $this->displayPageWithData('index', null);
          }
    
    
}

//
//
//         /* Get edit history for a particular unit */
//        public function edithistory_get() {
//
//          if( $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
//                  $this->getEditHistory();
//          } else {
//                  $this->displayPage('index');
//          }
//        }
//        
//        private function getEditHistory() {
//        
//        $this->load->model('HistoryM');
//        $data['historylist'] = $this->HistoryM->getEditHistory($this->session->userdata('unitId') );
//        
//        // show listing 
//          $this->displayPageWithData('history/edit', $data);
//        
//        }
//
//
//
//   
//
//   /* Get History for an inventtory item */
//   public function inventoryhistory_get($inventoryid) {
//
//     if($this->session->unitId != '' && $this->session->unitId != null ) {
//            $this->GetInventoryHistory($inventoryid);
//    } else {
//            $this->displayPage('index');
//    }
//
//   }
//
//   private function GetInventoryHistory($inventoryid) {
//
//    $this->load->model('HistoryM');
//    $data['historylist'] = $this->HistoryM->getEditHistory( $inventoryid );
//  
//    // show listing 
//    $this->displayPageWithData('history/edit', $data);
//  
//  }
//
//    /* Get History for a unit */
//   public function unitinventoryhistory_get() {
//
//     if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
//            $this->GetUnitInventoryHistory($this->session->userdata('unitId'));
//    } else {
//            $this->displayPage('index');
//    }
//
//   }
//
//   private function GetUnitInventoryHistory($unitid) {
//
//    $this->load->model('HistoryM');
//    $data['historylist'] = $this->HistoryM->getAllInventoryHistory( $unitid );
//  
//    // show listing 
//    $this->displayPageWithData('history/edit', $data);
//  
//  }
//
//   




 //  /* Get reorder history for a particular unit */
 //  public function reorders_get() {

 //    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
 //            $this->getReorderHistory();
 //    } else {
 //            $this->displayPage('index');
 //    }
 //  }
  
 //  private function getReorderHistory() {
	
	// $this->load->model('HistoryM');
	// $data['historylist'] = $this->HistoryM->getReorderHistory(' unitid=' . $this->session->userdata('unitId') );
	
	// // show listing 
 //    $this->displayPageWithData('history/reorder', $data);
  
 //  }
  
 //  /* Get requests history for a particular unit */
 //  public function requests_get() {

 //    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
 //            $this->getRequestHistory();
 //    } else {
 //            $this->displayPage('index');
 //    }
 //  }
  
 //  private function getRequestHistory() {
	
	// $this->load->model('HistoryM');
	// $data['historylist'] = $this->HistoryM->getRequestHistory(' unitid=' . $this->session->userdata('unitId') );
	
	// // show listing 
 //    $this->displayPageWithData('history/request', $data);
  
 //  }
  
  
  

  


  

 }