<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'QuoteDAO.php';



class QuoteM extends IVSModel {

	private $colNames = ' QUOTEID, REORDERID, QUOTEURL, QUOTEAMOUNT, SUPPLIERID, DELIVERYDATE, TITLE, SELECTED, USERID, NOTE ';
	
	
	function __construct() {
	  parent::__construct();
	}

	public function GetAllQuotes($reorderid) {

		$sql = 'select '.$this->colNames .' FROM QUOTES WHERE reorderid=' . $reorderid;
		return $this->initializeDAO($sql);
	}
	
	public function GetQuoteFromID($quoteid) {

		$udo = null;
		$sql = 'SELECT ' . $this->colNames . ' FROM QUOTES WHERE quoteid=' . $quoteid;
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	protected function initializeDAO($sql) {
		
		$e = new QuoteDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
	
	public function UpdateQuote() {
		
		$data = array();
		$this->load->library('form_validation');
		$this->setValidationRules();

		if($this->form_validation->run() === FALSE) {

			$data['msg'] = 'Validation errors:';
		    $data['msgType'] = 'error';
		    $data['quoteDO'] = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));
			

		} else {

		   $config['upload_path'] = './'.UPLOAD_FOLDER.'/';
   		   $config['allowed_types'] = 'jpg|png|gif|pdf';
   		   $this->load->library('upload', $config);
		   
		   $udo = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));

		  	   if ($this->upload->do_upload()) {

				  
				   $arr = $this->upload->data();
				   
				   $udo->setQuoteurl($arr['file_name']);
				  

					
					$this->db->query('update quotes set supplierid = '.  $udo->getSupplierid() .
				', quoteamount = ' . $this->db->escape(set_value('quoteamount')) . 
				', title = ' . $this->db->escape(set_value('title')) . 
				//', total = ' . $this->db->escape(set_value('total')) . 
				', note = ' . $this->db->escape(set_value('note')) . 
				', quoteurl = ' . $this->db->escape($udo->getQuoteurl()) . 
				', deliverydate = ' . $this->db->escape(set_value('deliverydate')) . 
				' where quoteid = '. $udo->getQuoteid());
	
					 
					   


		   	    $data['msg'] = 'Saved changes successfully!';
				$data['msgType'] = 'success';

			   		
			} else {



				 	$this->db->query('update quotes set supplierid = '.  $udo->getSupplierid() .
				   	', quoteamount = ' . $this->db->escape(set_value('quoteamount')) . 
				   	', title = ' . $this->db->escape(set_value('title')) . 
				   	//', total = ' . $this->db->escape(set_value('total')) . 
					', note = ' . $this->db->escape(set_value('note')) . 
				   	', deliverydate = ' . $this->db->escape(set_value('deliverydate')) . 
				   	' where quoteid = '. $udo->getQuoteid());

				 $data['msg'] = 'Quote updated. But no files uploaded!';
		  	 	 $data['msgType'] = 'success';
			}


		}

		return $data;
	
	}
	
	
	
		public function InsertQuote() {
		
		$data = array();
		$this->load->library('form_validation');
		$this->setValidationRules();

		if($this->form_validation->run() === FALSE) {

			$data['msg'] = 'Validation errors:';
		    $data['msgType'] = 'error';
		    $data['quoteDO'] = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));
			

		} else {

		   $config['upload_path'] = './'.UPLOAD_FOLDER.'/';
   		   $config['allowed_types'] = 'jpg|png|gif|pdf';
   		   $this->load->library('upload', $config);
		   
		   $udo = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));

		  	   if ($this->upload->do_upload()) {

                                $arr = $this->upload->data();

                                
                                $udo->setQuoteurl($arr['file_name']);
				  
				$this->db->query('insert into quotes(reorderid, supplierid, userid,  quoteurl, quoteamount, deliverydate, title, selected, note ) values('.
				$udo->getReorderid(). ','
				 . set_value('supplierid') . ',' 
				 . $_POST['userid'] . ',' 
				 . $this->db->escape($udo->getQuoteurl()) . ',' 
				 . $this->db->escape(set_value('quoteamount')) . ',' 
				 . $this->db->escape(set_value('deliverydate'))  . ',' 
				 . $this->db->escape(set_value('title'))  . ',' 
				 . $this->db->escape(set_value('selected'))  . ',' 
				 . $this->db->escape(set_value('note')) 
				 . ');');
	
					 
					   


		   	    $data['msg'] = 'Saved changes successfully!' ;
				$data['msgType'] = 'success';

			   		
			} else {



				 		$this->db->query('insert into quotes(reorderid, supplierid, userid,  quoteurl, quoteamount, deliverydate, title, selected, note ) values('.
				$this->db->escape($udo->getReorderid()). ','
				 . $this->db->escape(set_value('supplierid')) . ',' 
				 . $_POST['userid'] . ',' 
				 . $this->db->escape(set_value('quoteurl')) . ',' 
				 . $this->db->escape(set_value('quoteamount')) . ',' 
				 . $this->db->escape(set_value('deliverydate'))  . ',' 
				 . $this->db->escape(set_value('title'))  . ',' 
				 . $this->db->escape(set_value('selected'))  . ',' 
				 . $this->db->escape(set_value('note')) 
				 . ');');

				 $data['msg'] = 'Quote updated. But no files uploaded!';
		  	 	 $data['msgType'] = 'success';
			}


		}

		return $data;
	
	}
	
		private function setValidationRules() {
	
	  	$this->form_validation->set_rules('quoteid','Quote ID','trim|numeric|required');
		$this->form_validation->set_rules('reorderid','Reorder','trim|numeric|required');
		$this->form_validation->set_rules('supplierid','Supplier','trim');
		$this->form_validation->set_rules('userfile','URL','trim');
		$this->form_validation->set_rules('quoteamount','Amount','trim');
		$this->form_validation->set_rules('title','Title','trim');
		$this->form_validation->set_rules('note','Note','trim');
		$this->form_validation->set_rules('selected','Selected','trim');
		$this->form_validation->set_rules('userid','Userid','trim');
		$this->form_validation->set_rules('deliverydate','Quote ID','trim');
		
		
	}





	// public function getQuote($where=null){
		
	// 	$e = new QuoteDAO();
	// 	$e->getQuote($this->db, $where);
	// 	return $e;

	// }

	// public function getQuoteFromId(QuoteDO $udo) {

	// 	$guDAO = new QuoteDAO();
	// 	$guDAO->getQuoteFromId($this->db, $udo);
	// 	$udo = $guDAO->next($udo);
	// 	return $udo;

	// }

	// public function insertQuote() {

	// 	  $data = array();
	// 	  $this->load->library('form_validation');
	// 	  $this->setQuoteValidationRules();
		  
	// 	  if ($this->form_validation->run() === FALSE) {
	// 	   $data['msg'] = 'Validation errors:';
	// 	   $data['msgType'] = 'error';
	// 	   $data['quoteDO'] = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));
	// 	  }
	// 	  else {


	//   	   $config['upload_path'] = './'.UPLOAD_FOLDER.'/';
 //   		   $config['allowed_types'] = 'pdf';
 //   		   $this->load->library('upload', $config);

 //   		   // $this->upload->do_upload() automatically pulls the file from hte 'userfile' field of the form.
	// 	   // 'userfile' field is compulsory

	// 	   $data['msg'] = 'Saved changes successfully!';
	// 	   $data['msgType'] = 'success';

	// 	   // upload both files separately
	// 	   $a = $this->upload->do_upload('porder');
	// 	   $arr = $this->upload->data('porder');
	// 	   $b = $this->upload->do_upload('invoice');
	// 	   $arr2 = $this->upload->data('invoice');


	// 	   //if (!$a && !$b) {

	// 	  // 	$data['msg'] = 'Error uploading file: ' . $this->upload->display_errors();
	// 		//$data['msgType'] = 'error';

	// 	  // }else {

	// 	   	$udo = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));

	// 		$this->db->query('insert into quotes(reorderid, supplierid, unit, unitprice, quantity, quoteurl, quoteamount, deliverydate,porder,invoice) values('.
	// 			$this->db->escape($udo->getReorderid()). ','
	// 			 . $this->db->escape(set_value('supplierid')) . ',' 
	// 			 . $this->db->escape(set_value('unit')) . ',' 
	// 			 . $this->db->escape(set_value('unitprice')) . ',' 
	// 			 . $this->db->escape(set_value('quantity')) . ',' 
	// 			 . $this->db->escape(set_value('quoteurl')) . ',' 
	// 			 . $this->db->escape(set_value('quoteamount')) . ',' 
	// 			 . $this->db->escape(set_value('deliverydate'))  . ',' 
	// 			 . $this->db->escape($arr['file_name'])  . ',' 
	// 			 . $this->db->escape($arr2['file_name']) 
	// 			 . ');');
			
	// 		$data['msg'] = 'Quote Added!';
	// 		$data['msgType'] = 'success';

	// 	  // }


	// 	}
	// 	  return $data;

	// }

	// public function updateQuote() {

	// 	  $data = array();
	// 	  $this->load->library('form_validation');
	// 	  $this->setQuoteValidationRules();
	
	// 	  if ($this->form_validation->run() === FALSE) {
	// 	   $data['msg'] = 'Validation errors:';
	// 	   $data['msgType'] = 'error';
	// 	   $data['quoteDO'] = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));
	// 	  }
	// 	  else {


	// 	   	   $config['upload_path'] = './'.UPLOAD_FOLDER.'/';
	//    		   $config['allowed_types'] = 'pdf';
	//    		   $this->load->library('upload', $config);

	//    		   // $this->upload->do_upload() automatically pulls the file from hte 'userfile' field of the form.
	// 		   // 'userfile' field is compulsory

	// 		   $data['msg'] = 'Saved changes successfully!';
	// 		   $data['msgType'] = 'success';

	// 		   // upload both files separately
	// 		   $a = $this->upload->do_upload('porder');
	// 		   $arr = $this->upload->data('porder');
	// 		   $b = $this->upload->do_upload('invoice');
	// 		   $arr2 = $this->upload->data('invoice');

	// 		   if (!$a && !$b) {

	// 		       $udo = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));
				  

	// 			   $this->db->query('update quotes set supplierid = '.  $udo->getSupplierid() .
	// 			   	', quoteamount = ' . $this->db->escape(set_value('quoteamount')) . 
	// 			   	', unit = ' . $this->db->escape(set_value('unit')) . 
	// 			   	', quantity = ' . $this->db->escape(set_value('quantity')) . 
	// 			   	', unitprice = ' . $this->db->escape(set_value('unitprice')) . 
	// 			   	', deliverydate = ' . $this->db->escape(set_value('deliverydate')) . 
	// 			   	' where quoteid = '. $udo->getQuoteid());

	// 		   } else {


	// 			   $udo = DOFactory::getInstance()->createDO(DOEnum::QuoteDO, array('REORDERID'=>set_value('reorderid'),'SUPPLIERID'=>set_value('supplierid'),'QUOTEID'=>set_value('quoteid')));

	// 			   $udo->setPorder($arr['file_name']);
	// 			   $udo->setInvoice($arr2['file_name']);

	// 			   $this->db->query('update quotes set supplierid = '.  $udo->getSupplierid() .
	// 			   	', quoteamount = ' . $this->db->escape(set_value('quoteamount')) . 
	// 			   	', unit = ' . $this->db->escape(set_value('unit')) . 
	// 			   	', quantity = ' . $this->db->escape(set_value('quantity')) . 
	// 			   	', unitprice = ' . $this->db->escape(set_value('unitprice')) . 
	// 			   	', porder = ' . $this->db->escape($udo->getPorder()) . 
	// 			   	', invoice = ' . $this->db->escape($udo->getInvoice()) . 
	// 			   	', deliverydate = ' . $this->db->escape(set_value('deliverydate')) . 
	// 			   	' where quoteid = '. $udo->getQuoteid());

	// 			   $data['msg'] = 'Saved changes successfully!';
	// 			   $data['msgType'] = 'success';
	// 		}

	// 	  }
	// 	  return $data;

	// }


	// public function deleteQuote() {

	// 	$data = array();

	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('quoteid','Quote ID','trim|required|is_natural_no_zero|xss_clean');
		  
	// 	if ($this->form_validation->run() === FALSE) {
	// 	   $data['msg'] = 'Validation errors:';
	// 	   $data['msgType'] = 'error';
	// 	} else{
		  
	// 	   $this->db->query('delete from quotes where quoteid = '. set_value('quoteid'));
	// 	   $data['msg'] = 'Removed Quote successfully!';
	// 	   $data['msgType'] = 'success';
	// 	}
		  
	// 	  return $data;

	// }

	
	// private function setQuoteValidationRules() {
	
	//   	$this->form_validation->set_rules('quoteid','Quote ID','trim|xss_clean|numeric|required');
	// 	$this->form_validation->set_rules('reorderid','Inventory ID','trim|xss_clean|numeric|required');
	// 	$this->form_validation->set_rules('supplierid','Description','trim|xss_clean');
	// 	//$this->form_validation->set_rules('quoteurl','Date Initiated','trim|xss_clean');
	// 	$this->form_validation->set_rules('quoteamount','Date Received','trim|xss_clean');
	// 	$this->form_validation->set_rules('unit','Purchase Order Number','trim|xss_clean');
	// 	$this->form_validation->set_rules('unitprice','Status','trim|xss_clean');
	// 	$this->form_validation->set_rules('quantity','Comments','trim|xss_clean');
	// 	$this->form_validation->set_rules('deliverydate','Quote ID','trim|xss_clean');
		
		
	// }




 
 
}

