<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');




/*******************/
require 'IVS_Application.php';
/*******************/

class Reorder extends IVS_Application {


  /* Constructor */
   function __construct() {
  	   parent::__construct();
  	   $this->session->set_userdata('menuoption',0);
   }

  public function index_get() {

    if( $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
            $this->listReorders(array());
    } else {
            $this->displayPageWithData('index', null);
    }

   }


  private function listReorders($data) {

    $this->load->model('ReorderM');
    $data['reorderlist'] = $this->ReorderM->GetAllReorders($this->session->userdata('unitId'));
    // show listing 
    $this->displayPageWithData('reorder/list', $data);

  }


  public function edit_get($r) {

    if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
            $data['reorderid'] = $r;
            $this->editReorder($data);
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  private function editReorder($data) {

    // reorder details
    $this->load->model('ReorderM');
    $udo = $data['reorderDO'] = $this->ReorderM->GetReorderFromID($data['reorderid']);

    // get list of reordered items
    $this->load->model('ReorderItemsM');
    $data['reordereditemslist'] = $temp = null;
    $temp =  $this->ReorderItemsM->GetAllReorderedItems($udo->getReorderid());

    $list = null;
    // get inventory details of each requested item
    $t=null;
    $this->load->model('InventoryM');
    while($temp->hasMore()) {
      $t = $temp->next($t);  
      $inventory = null;
      $inventory = $this->InventoryM->GetInventoryFromId($t->getInventory_id());
      $t->setInventoryrecord($inventory);
      $list[] = $t;
      $t= null;
    }
     $udo->setReorderitems($list);
     $data['reordereditemslist'] = $udo->getReorderitems();

    // get list of receive records
    $this->load->model('ReceiveRecordM');
    $data['receiverecords'] = $this->ReceiveRecordM->GetAllReceiveRecords($data['reorderid']);
    $temporary = $this->ReceiveRecordM->GetAllReceiveRecords($data['reorderid']);

    // get list of attachments
    $this->load->model('AttachmentM');
    $data['attachments'] = $this->AttachmentM->GetAllAttachments($data['reorderid']);


    // get list of quotes
     $this->load->model('QuoteM');
     $data['quotes'] = null;
     $data['quotes'] = $this->QuoteM->GetAllQuotes($data['reorderid'] );
     
     $data['state'] = '';
     if($udo->getStatus() == 'CANCELLED' || $udo->getStatus() == 'COMPLETED'){
         $data['state'] = 'disabled';
     }
     
     
      if($temporary->hasMore() == false) {
            $data['statusarray'] = array('PENDING', 'COMPLETED', 'CANCELLED');
        } else {
            while($temporary->hasMore()){

                $t = $temporary->next();
                if($t->getStatus() == 'RECEIVED') {
                     $data['statusarray'] = array('PENDING', 'COMPLETED');
                     break;
                } else {
                     $data['statusarray'] = array('PENDING', 'CANCELLED');
                }
            }

        }
                
     
         
     
    $data['mode'] = 'edit';
    $data['action'] = 'reorder/update'; // saving reorder details
    $data['action2'] = 'reorder/reorderitem/new/' . $data['reorderid'] . '/0'; // adding item
    $data['action3'] = 'reorder/receiverecord/new/NONE/' . $data['reorderid']; // adding record
    $data['action4'] = 'reorder/attachment/new/0/' .  $data['reorderid'];
    $data['action5'] = 'reorder/quote/new/' . $data['reorderid'] . '/0';
    $data['btnLabel'] = 'Save';
    $data['backAction'] = 'reorder/index';

    $this->displayPageWithData('reorder/form', $data);

  }


  public function new_get() {

    if($this->session->userdata('userId') != '' && $this->session->userdata('userId') != null && $this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null) {
            $this->newReorder(array());
    } else {
            $this->displayPageWithData('index', null);
    }

  }

  private function newReorder($data) {

    $this->load->model('ReorderM');
    $this->load->model('QuoteM');

    $data['reorderDO'] = DOFactory::getInstance()->createDO(DOEnum::ReorderDO,array('REORDERID'=>0, 'STATUS'=>'PENDING', 'USERID'=>$this->session->userdata('userId'), 'UNITID'=>$this->session->userdata('unitId'), 'COMMENTS'=>'none'));

    //$data['quotelist'] = $this->QuoteM->getQuote(' reorderid=' . $c );

    $data['mode'] = 'new';
    $data['reorderid'] = 0;
    $data['action'] = 'reorder/insert';
    $data['btnLabel'] = 'Create';
    $data['backAction'] = 'reorder/index';
    $data['state']  = '';

    $this->displayPageWithData('reorder/form', $data); 

  }


  public function insert_post() {

    $this->load->model('ReorderM');
    $data = $this->ReorderM->insertReorder();

    if ($data['msgType'] == 'error') {
     $this->displayPageWithData('reorder/form', $data);
    }
    else {
     $this->listReorders($data);
    }

  }



  public function update_post() {

    $this->load->model('ReorderM');
    $data = $this->ReorderM->updateReorder();
    $data['reorderid'] = $_POST['reorderid'];

    if ($data['msgType'] == 'error') {
     $this->editReorder( $data);
    }
    else { //successful
     $this->listReorders($data);
    }

  }

  

/***** REORDER ITEMS ******/
public function reorderitem_get($mode, $reorderid, $reorderitemid) {

   $this->load->model('ReorderM');
   $this->load->model('ReorderItemsM');
   $this->load->model('InventoryM');

   //get reorder
   $data['reorderDO'] = $this->ReorderM->GetReorderFromID($reorderid);
   $data['itemDO'] = $this->ReorderItemsM->GetReorderItemFromID($reorderitemid);
   $data['inventorylist'] = $this->InventoryM->GetAllInventoryByASC($this->session->userdata('unitId'));

   $data['mode'] = $mode;

   if($mode == 'edit') {

      $data['action'] = 'reorder/updatereorderitem';
      $data['btnLabel'] = 'Update';
   }else {

      $data['action'] = 'reorder/savereorderitem';
      $data['btnLabel'] = 'Save';

   }
   $data['backAction'] = 'reorder/edit/' . $reorderid;

   $this->displayPageWithData('items/form', $data);



}

public function savereorderitem_post() {


  $this->load->model('ReorderItemsM');

  $data = $this->ReorderItemsM->InsertReorderItem();
  $data['reorderid'] = $_POST['reorderid'];
  $this->editReorder($data);

}

public function updatereorderitem_post() {


  $this->load->model('ReorderItemsM');

  $data = $this->ReorderItemsM->UpdateReorderItem();
  $data['reorderid'] = $_POST['reorderid'];
  $this->editReorder($data);

}


/**** RECEIVE RECORDS ***/
public function receiverecord_get($mode, $uuid, $reorderid) {

    $data['mode'] = $mode;
    $data['reorderid'] = $reorderid;
    $data['userid'] = $this->session->userdata('userId');


    $this->load->model('User');
    $this->load->model('ReceiveRecordM');
    $this->load->model('ReorderM');
    $reorderDO = $this->ReorderM->GetReorderFromID($reorderid);
    
    
      $data['state'] = '';
    if($mode == 'edit') {

      $udo = $data['recordDO'] = $this->ReceiveRecordM->GetSingleReceiveRecordByUUID($uuid);
      $data['userDO'] = $this->User->GetUserFromID($udo->getUserid());

      $data['state'] = '';
      
      if($reorderDO->getStatus() == "COMPLETED" || $udo->getStatus() == "CANCELLED") 
          $data['state'] = 'disabled';
      
      
      $data['action'] = 'reorder/cancelrecord';
      $data['btnLabel'] = 'Cancel';
      $data['backAction'] = 'reorder/edit/' . $reorderid;

      } else if ($mode == 'new') {

        //generate uuid
        $uuid = $this->generateUUID();

         $y = DOFactory::getInstance()->createDO(DOEnum::ReceiveRecordDO,array('REORDERID'=>$reorderid, 'RECORDUUID'=>$uuid, 
          'USERID'=>$this->session->userdata('userId')));
         $y->setReorderid($reorderid);
         $data['recordDO'] = $y;

        //$data['userDO'] = $this->User->GetUserFromID($this->session->userdata('userId'));

        $data['action'] = 'reorder/insertrecord';
        $data['btnLabel'] = 'Add';
        $data['backAction'] = 'reorder/edit/' . $reorderid; 

      }

      $this->load->model('ReorderItemsM');
      $data['reorderitemslist'] = $temp = null;
      $temp =  $this->ReorderItemsM->GetAllReorderedItems($reorderid);
      // $temp = $data['records'];
      $list = null;
      // get inventory details of each requested item
      $t=null;
      $record = null;
      $this->load->model('InventoryM');
      while($temp->hasMore()) {

        $t = $temp->next($t); 
        // get inventory details  
        $inventory = $this->InventoryM->GetInventoryFromId($t->getInventory_id());
        $record = $this->ReceiveRecordM->GetReceiveRecord($t->getItemid(), $uuid);
        $t->setReceive_record($record);
        $t->setInventoryrecord($inventory);
        $list[] = $t;
        
        $t = null;
        $record = null;
        $inventory = null;



      }
      //reset records
      //$data['records'] = $list;
      $data['reorderitemslist'] = $list;

      if($this->session->userdata('unitId') != '' && $this->session->userdata('unitId') != null ) {
        $this->displayPageWithData('record/form', $data);
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



public function insertrecord_post() {

    $this->load->model('ReceiveRecordM');
    $this->load->model('ReorderItemsM');
    $this->load->model('InventoryM');
    $obj = new ArrayObject( $_POST );
    $it = $obj->getIterator();
    $str = '';
    $verify = true;
    
    foreach ($it as $key=>$val) {
      if(substr($key, 0, 3) == 'xxx') {
        $id = trim($key, 'xxx');
        
        $item = $this->ReorderItemsM->GetReorderItemFromID($id);
        $old = $inventory = $this->InventoryM->GetInventoryFromId($item->getInventory_id());
        
        if( $val <= $item->getQuantity() && $val >=0 ) {
        
                $udo =  DOFactory::getInstance()->createDO(DOEnum::ReceiveRecordDO,array('REORDERID'=>$_POST['reorderid'], 'RECORDUUID'=>$_POST['uuid'], 
                  'USERID'=>$_POST['userid'], 'ITEMID'=>$id, 'QTYRECEIVED'=>$val));
                $udo->setReorderid($_POST['reorderid']);
                $udo->setQtyreceived($val);

                // add record
                $this->ReceiveRecordM->InsertRecord($udo);

                //update inventory
                $inventory->setQuantityavailable($inventory->getQuantityavailable() + $val);
                //update alert status;
                if($inventory->getQuantityavailable() <= $inventory->getMinimumquantity()) $inventory->setFlag(1); 
                else $inventory->setFlag(0);
                $this->InventoryM->updateQuantityAvailable($inventory);


                //insert edit history
                $new = $inventory;
                $this->insertEditHistory($old, $new);
                                            
                
                
                
                //update alert status;
                if($inventory->getQuantityavailable() > $inventory->getMinimumquantity()) $inventory->setFlag(0);
        
        } else {
             $verify = false;
        }

      }

    }
    
    if($verify == true) {
            $data['msg'] = 'Record added!';
            $data['msgType'] = 'success';
    } else {
         $data['msg'] = 'Invalid quantity received!';
            $data['msgType'] = 'error';
    }

    $data['reorderid'] = $_POST['reorderid'];
    $this->editReorder($data);

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


public function cancelrecord_post() {

  $this->load->model('ReceiveRecordM');
    $this->load->model('ReorderItemsM');
    $this->load->model('InventoryM');
    $obj = new ArrayObject( $_POST );
    $it = $obj->getIterator();
    $str = '';

    foreach ($it as $key=>$val) {
      if(substr($key, 0, 3) == 'xxx') {
        $id = trim($key, 'xxx');

        //update inventory
        $item = $this->ReorderItemsM->GetReorderItemFromID($id);
        $inventory = $this->InventoryM->GetInventoryFromId($item->getInventory_id());
        $inventory->setQuantityavailable($inventory->getQuantityavailable() - $val);
        $this->InventoryM->updateQuantityAvailable($inventory);
        
       

      }

    }
    
    $this->ReceiveRecordM->UpdateRecord($_POST['uuid']);

    $data['reorderid'] = $_POST['reorderid'];
    $data['msg'] = 'Record cancelled!';
    $data['msgType'] = 'success';
    $this->editReorder($data);


}



  public function attachment_get($mode, $attachmentid, $reorderid) {

    $data['mode'] = $mode;
    $this->load->model('AttachmentM');
    $att = null;

    $data['attachmentDO'] = $att = $this->AttachmentM->getAttachmentFromID($attachmentid);
    $data['reorderid'] = $reorderid;
    $data['attachmentid']= $attachmentid;

    if($mode == 'edit') {

      $data['action'] = 'reorder/updateattachment';
      $data['btnLabel'] = 'Update';

    }else {
      $data['action'] = 'reorder/insertattachment';
      $data['btnLabel'] = 'Insert';
    }

    $data['backAction'] = 'reorder/edit/' . $reorderid;
    $this->displayPageWithData('attachments/form' , $data);

  }


  public function insertattachment_post() {

      $this->load->model('AttachmentM');

      $_POST['userid'] = $this->session->userdata('userId');
      $data = $this->AttachmentM->InsertAttachment();
      $data['reorderid'] = $_POST['reorderid'];
      $this->editReorder($data);

  }

  public function updateattachment_post() {

     $this->load->model('AttachmentM');

      $_POST['userid'] = $this->session->userdata('userId');
      $data = $this->AttachmentM->UpdateAttachment();
      $data['reorderid'] = $_POST['reorderid'];
      $this->editReorder($data);


  }


  /********* QUOTES *********/
  public function quote_get($mode, $reorderid, $quoteid) {


    $data['mode'] = $mode;
    $this->load->model('QuoteM');
    $this->load->model('SupplierM');
    $att = null;

    $data['quoteDO'] = $att = $this->QuoteM->getQuoteFromID($quoteid);
    $data['reorderid'] = $reorderid;
    $data['quoteid']= $quoteid;
    $data['supplierlist'] = $this->SupplierM->getSuppliers(' status= "CURRENT" and unitid=' . $this->session->userdata('unitId'));

    if($mode == 'edit') {

      $data['action'] = 'reorder/updatequote';
      $data['btnLabel'] = 'Update';

    }else {
      $data['action'] = 'reorder/insertquote';
      $data['btnLabel'] = 'Insert';
    }

    $data['backAction'] = 'reorder/edit/' . $reorderid;
    $this->displayPageWithData('quote/form' , $data);

  }

  public function insertquote_post() {

    $this->load->model('QuoteM');

    $_POST['userid'] = $this->session->userdata('userId');
    $data = $this->QuoteM->InsertQuote();
    $data['reorderid'] = $_POST['reorderid'];
    $this->editReorder($data);

  }


  public function updatequote_post() {

    $this->load->model('QuoteM');

    $_POST['userid'] = $this->session->userdata('userId');
    $data = $this->QuoteM->UpdateQuote();
    $data['reorderid'] = $_POST['reorderid'];
    $this->editReorder($data);


  }

  public function viewFile_get($a) {

    $this->load->helper('download');
    if($this->uri->segment(3))
    {
        $data   = file_get_contents('./uploads/'.$a);
    }
    $name   =  $a; //$this->uri->segment(3);
    force_download($name, $data);
  

  //$data['a'] = $a;
  //$this->displayPageWithData('quote/viewpdf', $data);

}



}