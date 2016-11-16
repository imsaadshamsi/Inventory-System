<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/*******************/
require 'IVS_Application.php';
/*******************/

class Client extends IVS_Application {


/* Constructor */
 function __construct() {
	parent::__construct();
	$this->session->set_userdata('menuoption',0);
 }


 // Get the index page which is the main index.php
 public function index_get() {
	$data = null;
	$this->displayPageWithData('index', $data);
 }
 
 // Get all requests from a requestor
 public function requestlist_get() {
 
	if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
				$data = null;
				$this->getRequestsByRequestor($data);
    } else {
            $this->displayPageWithData('index', null);
    }
 
 }
 
   /*
	Used by Client
	Retreive all the requests made by a unit
  */
  private function getRequestsByRequestor($data){
		
		$this->load->model('RequestM');
		$data['requestlist'] =  $this->RequestM->GetAllRequestorRequests( $this->session->userdata('unitId'));
		$this->displayPageWithData('client/requestlist', $data);
  
  }

 /*
	Get the details of a request
	For Edit: $mode = edit, $rid = >0
	For New: $mode = new, $rid = 0
*/
   public function request_get($mode, $rid) {

	$data['mode'] = $mode;
	$data['rid'] = $rid;
        
        
	$this->displayRequest($data);

   }
   
   private function displayRequest($data) {
   
		// set the action details
		$data['action'] = 'client/request'; // save request
		$data['action2'] = 'client/item/new/0' ; // add requested item
		$data['action3'] = 'client/submit'; // send request
		$data['backAction'] = 'client/index';
                
                
        $this->load->model('User');
                $data['users'] = $this->User->GetAllUsersWithRole(4);// get all client users
		$this->session->set_userdata('requestid', $data['rid']);
		
		// get request details
		$data['requestorid'] = $this->session->unitId;
		$this->load->model('RequestM');
		$rdo = $data['requestDO'] = $this->RequestM->GetRequestFromId(DOFactory::getInstance()->createDO(DOEnum::RequestDO,array('REQUESTID'=>$data['rid'])));
		
		// get requested items
		$this->load->model('RequestedItemsM');
		$data['requesteditemslist'] = $temp = null;
		$temp =  $this->RequestedItemsM->GetAllRequestedItems($rdo->getRequest_id());

		$list = null;
		// get inventory details of each requested item
		$t=null;
		$this->load->model('InventoryM');
		while($temp->hasMore()) {

			$t = $temp->next($t); //&$rdo->getRequested_items()->next($t);
			// get inventory details	
			$inventory = null;
			$inventory = $this->InventoryM->GetInventoryFromId($t->getInventory_id());
			$t->setInventory_record($inventory);
			$list[] = $t;
			$t= null;

		}

		 $rdo->setRequested_items($list);
		// set requested items, with inventory details
		$data['requesteditemslist'] = $rdo->getRequested_items();
		
		// get list of all the units that are stores, ie. where store = 1
		$this->load->model('UnitM');
		$data['unitlist'] = $this->UnitM->GetStoreUnits(1);
		
		// button details
		if($data['mode']== 'new') {
			$data['btnLabel'] = 'Create';
		} else if ($data['mode'] == 'edit') {
			$data['btnLabel'] = 'Save';
		} else {
			$data['btnLabel']= 'Remove';
			$data['action'] = 'client/removerequest/' . $data['rid'] ; // send request
			}

		// display request details
		$this->displayPageWithData('client/form', $data);
	
   }
   
   /* 
	Save the changes made to the request
	*/
  public function request_post() {

      $this->load->model('RequestM');
      $data = null;
      if( $_POST['requestid'] == '0' )
          $data = $this->RequestM->InsertRequest();
      else {
          $data = $this->RequestM->UpdateRequest();
      }
      $this->getRequestsByRequestor($data);
	
   }
   
   
   public function submit_post() {
       
      $this->load->model('RequestM');
      $data = null;
      
      $data = $this->RequestM->UpdateRequestStatus($_POST['requestid'], 'PENDING');
      
      $this->getRequestsByRequestor($data);
      
   }
   
   
  
  public function removerequest_post() {
  
  	$this->load->model('RequestM');
	$data = $this->RequestM->RemoveRequest();
	$this->getRequestsByRequestor($data);
  
  }
  
  public function item_get($mode, $requesteditemid) {
  
    // set the action details
    $data['action'] = 'client/item'; // save item
    $data['mode'] = $mode;
    $data['backAction'] =  'client/request/edit/' . $this->session->userdata('requestid'); // back button
    $data['btnLabel'] = 'Save';
    if($mode == "remove") {
            $data['btnLabel'] = 'Remove';
            $data['action'] = 'client/removeitem'; 
    }

    // get request details
    $this->load->model('RequestedItemsM');
    $this->load->model('InventoryM');

    $t = DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO,array('REQUESTEDITEMID'=>$requesteditemid,'REQUESTID'=>$this->session->userdata('requestid'))); 
    $rdo = $this->RequestedItemsM->GetRequestedItemFromId($t);

    // get the inventory item
    $inv = $this->InventoryM->GetInventoryFromId($rdo->getInventory_id());

    $rdo->setInventory_record($inv);
    $data['requestedItemDO'] = $rdo;
    $data['inventorylist'] =  $this->InventoryM->GetAllInventorySite($this->session->site);

    // display request details
    $this->displayPageWithData('client/item', $data);
	
  
  }
  

  public function item_post() {
  
	  $this->load->model('RequestedItemsM');
	  $data = null;
	  if($_POST['requesteditemid'] == '0')
		$data = $this->RequestedItemsM->InsertItem();
	  else 
		$data = $this->RequestedItemsM->UpdateItem();
      

	  $data['mode'] = 'edit';
	  $data['rid'] = $_POST['requestid'];
	  $this->displayRequest($data);
	  
  
  }
  
  public function removeitem_post() {
	
	$this->load->model('RequestedItemsM');
	$data = $this->RequestedItemsM->RemoveItem();
	

	$data['mode'] = 'edit';
	$data['rid'] = $_POST['requestid'];
	$this->displayRequest($data);
  
  }
  
 }