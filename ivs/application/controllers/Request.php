<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Request extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }
   

  /* 
	Used by Admin and Client.
	For Client: List all the requests made by that unit.
	For Admin: List all the requests made to that unit.
  */
  public function index_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
				$this->getRequestsToUnit($this->session->userdata('unitId'));
    } else {
            $this->displayPageWithData('index', null);
    }

   }
   

  
  /* 
	Used by Admin
    Retreive all the requests made to a unit
*/

  private function getRequestsToUnit($unitid) {
  
	$this->load->model('RequestM');
    $data['requestlist'] =  $this->RequestM->GetAllRequestsToAUnit( $unitid );
    $this->displayPageWithData('request/list', $data);
	
  }
  
   
   public function handle_get($rid) {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
    		$data['requestid'] = $rid;
            $this->showRequest($data);
    } else {
           $this->displayPageWithData('index', null);
    }

   }

   private function showRequest($data) {

		// get request details
		$this->load->model('RequestM');
		$rdo = $data['requestDO'] = $this->RequestM->GetRequestFromId(DOFactory::getInstance()->createDO(DOEnum::RequestDO,array('REQUESTID'=>$data['requestid'])));
		
		// get requested items
		$this->load->model('RequestedItemsM');
		$data['requesteditemslist'] = $temp = null;
		$temp =  $this->RequestedItemsM->GetAllRequestedItems($rdo->getRequest_id());

		$list = null;
		// get inventory details of each requested item
		$t=null;
		$this->load->model('InventoryM');
		$this->load->model('DisbursementM');
		while($temp->hasMore()) {

			$t = $temp->next($t); //&$rdo->getRequested_items()->next($t);
			
			// get inventory details	
			$inventory = null;
			$inventory = $this->InventoryM->GetInventoryFromId($t->getInventory_id());
			$t->setInventory_record($inventory);
			$list[] = $t;
			
			$t= null;

		}

		$data['disbursements'] = $this->DisbursementM->GetDisbursementsInRequest($rdo->getRequest_id());
                $temp = $this->DisbursementM->GetDisbursementsInRequest($rdo->getRequest_id());

		$rdo->setRequested_items($list);
		// set requested items, with inventory details
		$data['requesteditemslist'] = $rdo->getRequested_items();
		
		// get list of all the units that are stores, ie. where store = 1
		$this->load->model('UnitM');
		$data['unitlist'] = $this->UnitM->GetStoreUnits(1);

		$data['btnLabel'] = 'Save';
		$data['action'] = 'request/process/' . $data['requestid'];

		$data['action2'] = 'disbursement/view/new/NONE/' . $data['requestid'];
		$data['backAction'] = 'request/index';
		$data['mode'] = 'edit';
                
                
                // setting state of buttons
                $data['state'] = '';
                if( $rdo->getStatus() == 'DENIED' || $rdo->getStatus() == 'COMPLETED') {
                    $data['state'] = 'disabled';
                }
                
                
                
                if($temp->hasMore() == false) {
                    $data['statusarray'] = array('PENDING', 'DENIED', 'COMPLETED');
                } else {
                    while($temp->hasMore()){
                        
                        $t = $temp->next();
                        if($t->getStatus() == 'PICKUP') {
                             $data['statusarray'] = array('PENDING');
                             break;
                        } else {
                             $data['statusarray'] = array('PENDING', 'COMPLETED');
                        }
                    }
                    
                }
                
                
		
		
		$this->displayPageWithData('request/form', $data);

  }

  public function insert_post() {


		$this->load->model("InventoryM");
		$this->load->model("RequestedItemsM");
		$this->load->model("DisbursementM");
		// Do quantity checks
		$verify = false;
		$code = $this->incrementalHash(5);
		foreach ($_POST as $key=>$val) {
			
			if(substr($key, 0, 3) == 'xxx') {
				$id = trim($key, 'xxx');
				
				$requesteditem = $this->RequestedItemsM->GetRequestedItemFromID(DOFactory::getInstance()->createDO(DOEnum::RequestedItemDO,array('REQUESTEDITEMID'=>$id)));
				$old = $inventory = $this->InventoryM->GetInventoryFromID($requesteditem->getInventory_id());
				
                                if($requesteditem->getQuantity_requested_remaining() >= $val) {
                                    if($inventory->getQuantityavailable() >= $val) {
                                        if($val >= 0){
                                            
                                             $verify = true;
                                            $udo =  DOFactory::getInstance()->createDO(DOEnum::DisbursementRecordDO,array('REQUESTID'=>$_POST['requestid'], 'DISBURSEMENTUUID'=>$_POST['disbursementuuid'], 
                                    'USERID'=>$_POST['userid'], 'STATUS'=>'PICKUP', 'REQUESTEDITEMID'=>$id, 'QUANTITYDISBURSED'=>$val, 'CODE'=>$code, 'COMMENTS'=>$_POST['comments']));

                                            
                                            // decreaase inventory by $val
                                            $inventory->setQuantityavailable($inventory->getQuantityavailable() - $val);
                                            
                                            
                                            //update inventory
                                            //if($inventory->getQuantityavailable() <= $inventory->getMinimumquantity()) $inventory->setFlag(1);
                                            $this->InventoryM->updateQuantityAvailable($inventory);
//                                            
//                                            /* Update status */
//                                            $engine2 = new RulesEngine();
//                                            $engine2->setRule(new Rule_002());
//                                            $result2 = $engine2->applyRule(array('quantityavailable'=> $inventory->getQuantityavailable(), 'status'=>$inventory->getStatus()));
//                                            $inventory->setStatus($result2['status']);
//
//                                           /* Check flag */
//                                           $engine = new RulesEngine();
//                                           $engine->setRule(new Rule_001());
//                                           $result = $engine->applyRule(array('status'=>$inventory->getStatus(), 'quantityavailable'=> $inventory->getQuantityavailable(), 'minimumquantity'=>$inventory->getMinimumquantity()));
//                                           $inventory->setFlag($result['flag']);
//                   
                                            
                                            //insert edit history
                                            $new = $inventory = $this->InventoryM->GetInventoryFromID($requesteditem->getInventory_id());
                                            $this->insertEditHistory($old, $new);

                                            // update remaining decrease by $val
                                            $requesteditem->setQuantity_requested_remaining($requesteditem->getQuantity_requested_remaining() - $val);
                                            $this->RequestedItemsM->UpdateQuantityRequestedRemaining($requesteditem);

                                            $udo->setRequested_item_id($id);
                                            $udo->setRequestid($_POST['requestid']);

                                            $this->DisbursementM->InsertDisbursement($udo);
                                        }
                                    }
                                }
			}
		}
                
                if($verify === true) {
                    $data['msg'] = ' Items Disbursed!';
		    $data['msgType'] = 'success';
                    
                } else {
                    $data['msg'] = 'Validation errors: Please recheck entries';
		    $data['msgType'] = 'error';
                }
		

		$data['requestid'] = $_POST['requestid'];
		$this->showRequest($data);
		

	}
        
        private function insertEditHistory($old, $new) {
//             //Retrieve old values
//            $this->load->model('InventoryM');
//            $old = $this->InventoryM->getInventoryFromId($udo->getInventoryid());
//            $new = $udo;

		  // Insert row into edithistory table
		   $this->db->query('insert into edithistory(inventoryid, event, userid, oldquantity, newquantity, oldmin, newmin, oldstatus, newstatus, oldsnum,newsnum, oldname, newname, olddesc,newdesc, oldcat,newcat, oldshelvingid, newshelvingid, oldcomments, newcomments, dateoccurred,reasonforedit) values('.
				$this->db->escape($new->getInventoryid()). ',"EDIT",' . $this->session->userdata('userId') . ',' 
				 . $this->db->escape($old->getQuantityavailable()) . ',' 
				 . $this->db->escape($new->getQuantityavailable()) . ','
				 . $this->db->escape($old->getMinimumquantity()) . ',' 
				 . $this->db->escape($new->getMinimumquantity()) . ','
				 . $this->db->escape($old->getStatus()) . ',' 
				 . $this->db->escape($new->getStatus()) . ','
				 . $this->db->escape($old->getStocknumber()) . ',' 
				 . $this->db->escape($new->getStocknumber()) . ','
				 . $this->db->escape($old->getName()) . ',' 
				 . $this->db->escape($new->getName()) . ','
				 . $this->db->escape($old->getDescription()) . ',' 
				 . $this->db->escape($new->getDescription()) . ','
				 . $this->db->escape($old->getCategoryid()) . ',' 
				 . $this->db->escape($new->getCategoryid()) . ','
				 . $this->db->escape($old->getShelvingid()) . ',' 
				 . $this->db->escape($new->getShelvingid()) . ','
				 . $this->db->escape($old->getComments()) . ',' 
				 . $this->db->escape($new->getComments()) . ',now(), ' 
				 . $this->db->escape('Quantiy Update')
				 . ');');
        }

	public function updatedisbursement_post() {

		$this->load->model("DisbursementM");
		$this->load->model("InventoryM");

		// CHECK IF CODE ENTERED
		if($_POST['code']  != null || $_POST['code'] != '') {

			
			// retreive code for uuid
			$validcode = $this->DisbursementM->GetDisbursementRecordByUUID($_POST['disbursementuuid']);
			
			//verify code
			if( $_POST['code'] == $validcode->getCode()){
				//change status to collected once verified
				$data = $this->DisbursementM->UpdateStatus($_POST['disbursementuuid'] , 'COLLECTED');
                                $data['msg'] = 'Code Validate.Items Collected!';
                                $data['msgType'] = 'success';
			} else {
                                $data['msg'] = 'Invalid Code!';
                                $data['msgType'] = 'error';
                        }
		} else {
			
			if($_POST['status'] != 'COLLECTED'){
				$data = $this->DisbursementM->UpdateStatus($_POST['disbursementuuid'] , $_POST['status']);
				if($_POST['status'] == 'CANCELLED'){
					
					// credit inventory
					$disbursements = $this->DisbursementM->GetDisbursementByUUID($_POST['disbursementuuid']);
					foreach ($disbursements->result() as $row) {
						$old = $inventory = $this->InventoryM->GetInventoryFromId($row->InventoryID);
						$inventory->setQuantityavailable($inventory->getQuantityavailable() + $row->Quantity);
						$this->InventoryM->updateQuantityAvailable($inventory);
                                                
                                                //insert edit history
                                                $new = $inventory;
                                                $this->insertEditHistory($old, $new);
					}
					$data['msg'] = 'Disbursement Cancelled!';
                                        $data['msgType'] = 'error';
				}
			}else {

				$data['msg'] = 'Code must be entered to mark as COLLECTED';
                $data['msgType'] = 'error';

			}
		}

		$data['requestid'] = $_POST['requestid'];
		$this->showRequest($data);



	}

		/* Generate 5 character code */
	private function incrementalHash($len = 5){

	  $rand = substr(md5(microtime()),rand(0,26),5);
	  return $rand;

	}

   
   public function email_get($rid) {
   
	if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null ) {
            $this->emailRequestor($rid, array());
    } else {
            $this->displayPageWithData('index', null);
    }
	
   }
   
   public function email_post() {
   
		$data=array();
		$data['msg'] = $this->generateEmail($_POST['from'], $_POST['recipient'], $_POST['subject'], $_POST['message']);
		$data['msgType'] = 'success';
		$this->listRequest($data);
		
   }

    private function emailRequestor($rid, $data) {
	
	    $this->load->model('RequestM');
	    $udo = $this->RequestM->GetRequestFromId(DOFactory::getInstance()->createDO(DOEnum::RequestDO,array('REQUESTID'=>$rid)));

	    $this->load->model('User');
	    $userdo = $this->User->GetUserFromID($udo->getUserid());
		
		$data['recipient'] = $userdo->getEmail();
		$data['message'] = "Request ID: " . $udo->getRequest_id();
		$data['sender'] = "noreply@sta.uwi.edu";
		$data['subject'] = "Request Reply";
		
		$data['action'] = 'request/email';
	    $data['btnLabel'] = 'Email';
	    $data['backAction'] = 'request/index';
	  
		$this->displayPageWithData('request/email', $data);
  
  }


   public function process_post($rid) {

      // update status
      $this->load->model('RequestM');
      $data = $this->RequestM->UpdateRequestStatus($rid, $_POST['status']);

      $data['requestid'] = $rid;
      if ($data['msgType'] == 'error') {
       $this->showRequest($data);
      }
      else { //successful
       $this->listRequest($data);
      }
   
    
   }


private function genEmail() {

	  $this->load->model('RequestM');
	  $udo = $this->RequestM->getRequestFromId(DOFactory::getInstance()->createDO(DOEnum::RequestDO,array('REQUESTID'=>$_POST['requestid'])));

	  $message = '';
	  if($udo->getStatus() == "APPROVED") {
		  $message = 'Request:R' . $udo->getRequestid() . '\n'.
		  'Status:' . $udo->getStatus() . '\n' . 
		  'Code:' . $udo->getCode();
	  }else {
			$message = 'Request:R' . $udo->getRequestid() . '\n'.
			'Status:' . $udo->getStatus() . '\n';
	  }

	return $this->generateEmail('noreply_ivs@sta.uwi.edu', $udo->getStaffemail(), 'Status Update', $message);
}

private function generateEmail($from, $to, $subject, $message) {
	
	$config = Array(
    'protocol' => 'smtp',
    'smtp_host' => EMAIL_HOST,
    'smtp_port' => EMAIL_PORT
  );
  
  // email settings
  $this->load->helper('email');
  $this->load->library('email',$config);
  $this->email->set_newline("\r\n");
  $this->email->from($from); // sender
  $this->email->to($to);
  $this->email->subject($subject);
  $this->email->message($message);
  $this->email->send();
  
  //$data = array();
  return 'Email Sent!';
	

}



/* VALIDATION FUNCTIONS */

// Validate quantityapproved against quantityrequested
public function _check_quantity() {

      $d   =   $this->input->post('quantityapproved');
      $c   =   $this->input->post('quantityrequested');

      if($d <= $c) return TRUE;
      else {
        $this->form_validation->set_message('_check_quantity', 'Quantity Approved must be less than or equal to Quantity Requested');
        return FALSE;
      }

}
 

  /* Form operations */
  public function save_post() {

    $this->load->model('RequestM');
    $data = $this->RequestM->insertRequest();
 
    if ($data['msgType'] == 'error') {
     $this->newRequest($c, $data);
    }
    else {
     $this->listcategories($data);
    }

  }








  /* 
	Used by Admin.
	Get a list of all the requests in a particular unit
  */
  private function listRequest($data=array()) {

    $this->load->model('RequestM');
    $data['requestlist'] =  $this->RequestM->GetAllRequestsToAUnit( $this->session->userdata('unitId') );

    // show listing 
    $this->displayPageWithData('request/list', $data);

  }


  



 }