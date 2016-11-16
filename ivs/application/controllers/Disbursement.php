<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Disbursement extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
   }
   

  public function index_get() {

		if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
					$data = $this->listAllDisbursements($this->session->userdata('unitId'));
					$this->displayPageWithData('disbursement/list', $data);
		} else {
				$this->displayPageWithData('index', null);
		}

   }
   
   private function listAllDisbursements() {
	
		$this->load->model('DisbursementM');
		$data['action'] = 'disbursement/search';
		$data['disbursements'] = $this->DisbursementM->GetAllDisbursements($this->session->userdata('unitId'));

		return $data;

   }


  //    public function search_post() {
    
  //   if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
  //           $this->searchDisbursements();
  //   } else {
  //           $this->displayPage('index');
  //   }

  //  }

  // private function searchDisbursements($data=array()) {

  //   $this->load->model('DisbursementM');
  //   $data['disbursements'] =  $this->DisbursementM->getDisbursementBySearch($_POST['search'],$this->session->userdata('unitId'));
  
  //   $data['action'] = 'disbursement/search';

  //   // show listing 
  //   $this->displayPageWithData('disbursement/list', $data);

  // }



   
   public function view_get($mode, $uuid, $requestid) {

   		$data['mode'] = $mode;
   		$data['requestid'] = $requestid;
   		$data['userid'] = $this->session->userdata('userId');
   		$udo = null;
   		

   		$this->load->model('User');

	   	if($mode == 'edit') {

	   		$udo = $data['disbursementDO'] = $this->getDisbursementRecordByUUID($uuid);
   			
   			$data['userDO'] = $this->User->GetUserFromID($udo->getUser_id());

			$data['action'] = 'request/updatedisbursement';
			$data['btnLabel'] = 'Update';
			$data['backAction'] = 'request/handle/' . $requestid;

	   	} else if ($mode == 'new') {

	   		//generate uuid
	   		$uuid = $this->generateUUID();

	   		$data['disbursementDO'] = DOFactory::getInstance()->createDO(DOEnum::DisbursementRecordDO,array('REQUESTID'=>$requestid, 'DISBURSEMENTUUID'=>$uuid, 
	   			'USERID'=>$this->session->userdata('userId')));

	   		$data['userDO'] = $this->User->GetUserFromID($this->session->userdata('userId'));

	   		$data['action'] = 'request/insert';
			$data['btnLabel'] = 'Add';
			$data['backAction'] = 'request/handle/' . $requestid; 

	   	}

	   	$this->load->model('RequestedItemsM');
		$data['requesteditemslist'] = $temp = null;
		$temp =  $this->RequestedItemsM->GetAllRequestedItems($requestid);
		$list = null;
		// get inventory details of each requested item
		$t=null;
		$disburse = null;
		$this->load->model('InventoryM');
		$this->load->model('DisbursementM');
		while($temp->hasMore()) {

			$t = $temp->next($t); //&$rdo->getRequested_items()->next($t);
			
			// get inventory details	
			$inventory = $this->InventoryM->GetInventoryFromId($t->getInventory_id());
			$disburse = $this->DisbursementM->GetDisbursementRecord($t->getRequested_item_id(), $uuid);
			//var_dump($disburse);
			$t->setDisbursement_records($disburse);
			$t->setInventory_record($inventory);
			$list[] = $t;
			
			$t = null;
			$disburse = null;
			$inventory = null;

		}
		$data['requesteditemslist'] = $list;

	   	if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
			$this->displayPageWithData('disbursement/form', $data);
		} else {
			$this->displayPageWithData('index', null);
		}


   }

    function generateUUID() {

		  return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		   mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		   mt_rand( 0, 0xffff ),
		   mt_rand( 0, 0x0fff ) | 0x4000,
		   mt_rand( 0, 0x3fff ) | 0x8000,
		   mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		  );
	}

	public function insert_post() {

		$this->load->model("InventoryM");
		$this->load->model("RequestedItemsM");
		$this->load->model("DisbursementM");
		// Do quantity checks
		$verify = true;
		$obj = new ArrayObject( $_POST );
		$it = $obj->getIterator();
		$items = array();
		foreach ($it as $key=>$val) {

			if(strpos($key, "xxx")) {
				$id = substr($key, -3, 0);
				$items[$id] = $val;
				$requesteditem = $this->RequestedItemsM->GetRequestedItemFromID($id);
				$inventory = $this->InventoryM->GetInventoryFromID($requesteditem->getInventory_id());
				if($inventory->getQuantityavailable() < $val) $verify = false;
			}
		}

		if($verify){

			$obj = null;
			$obj = new ArrayObject($items);
			$it = null;
			$it = $obj->getIterator();
			$code = $this->incrementalHash(5);
			foreach($it as $key=>$val) {
				$udo =  DOFactory::getInstance()->createDO(DOEnum::DisbursementRecordDO,array('REQUESTID'=>$_POST['requestid'], 'DISBURSEMENTUUID'=>$_POST['disbursementuuid'], 
	   			'USERID'=>$_POST['userid'], 'STATUS'=>$_POST['status'], 'REQUESTEDITEMID'=>$key, 'QUANTITYDISBURSED'=>$val, 'CODE'=>$code));
				$this->DisbursementM->InsertDisbursement($udo);
			}
                        
                                $data['msg'] = 'Disbursement inserted';
                        $data['msgType'] = 'success';

		} else {


			$data['msg'] = 'Validation errors: Please recheck entries';
		    $data['msgType'] = 'error';
		}

		$this->displayPageWithData('disbursement/form', $data);
		

	}

	/* Generate 5 character code */
	private function incrementalHash($len = 5){

	  $rand = substr(md5(microtime()),rand(0,26),5);
	  return $rand;

	}



    private function getDisbursementRecordByUUID($uuid) {
   
		$this->load->model('DisbursementM');
 		return $this->DisbursementM->getDisbursementRecordByUUID($uuid);
   
   }
   

  
   
   
   
 
  


 }