<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'SupplierDAO.php';



class SupplierM extends IVSModel {

        
    private $colNames = ' SUPPLIERID, SUPPLIERNAME, ADDRESS, TELEPHONE, EMAIL, CONTACTPERSON, STATUS, DATEADDED, UNITID, COMMENTS ';
	
    
	function __construct() {
	  parent::__construct();
	}

        
        
        
        
        
        	
	protected function initializeDAO($sql) {
		
		$e = new SupplierDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

        
        
	public function getSuppliers($unitid){
		
		$sql = 'SELECT ' . $this->colNames . ' FROM Suppliers where unitid=' . $this->session->unitId;
		return $this->initializeDAO($sql);

	}

	public function getSupplierFromId(SupplierDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM Suppliers WHERE supplierid=' . $udo->getSupplierid();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function deletesupplier() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('supplierid','supplier ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from suppliers where supplierid = '. set_value('supplierid'));
		   $data['msg'] = 'Removed supplier successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertsupplier() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setSupplierValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['supplierDO'] = DOFactory::getInstance()->createDO(DOEnum::SupplierDO, array('SUPPLIERID'=>set_value('supplierid'),'SUPPLIERNAME'=>set_value('suppliername'), 'ADDRESS'=>set_value('address'), 'TELEPHONE'=>set_value('telephone'), 'EMAIL'=>set_value('email'), 'CONTACTPERSON'=>set_value('contactperson'), 'STATUS'=>set_value('status'), 'DATEADDED'=>'', 'COMMENTS'=>set_value('comments'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::SupplierDO, array('SUPPLIERID'=>set_value('supplierid'),'SUPPLIERNAME'=>set_value('suppliername'), 'ADDRESS'=>set_value('address'), 'TELEPHONE'=>set_value('telephone'), 'EMAIL'=>set_value('email'), 'CONTACTPERSON'=>set_value('contactperson'), 'STATUS'=>set_value('status'), 'DATEADDED'=>'', 'COMMENTS'=>set_value('comments'),'UNITID'=>$this->session->userdata('unitId')));
		   
			$this->db->query('insert into suppliers(supplierid, suppliername, dateadded, status, comments, email, telephone, unitid, address, contactperson) values(' . 
				$this->db->escape($udo->getSupplierid()). 
				',' . $this->db->escape($udo->getSuppliername()) . 
				', now(),' . $this->db->escape($udo->getStatus()) .  
				',' . $this->db->escape($udo->getComments()) .
				',' . $this->db->escape($udo->getEmail()) .
				',' . $this->db->escape($udo->getTelephone()) .
				',' . $this->db->escape($udo->getUnitid()) .
				',' . $this->db->escape($udo->getAddress()) .
				',' . $this->db->escape($udo->getContactperson()) .
				');');
			
			$data['msg'] = 'Supplier Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;

	}

	public function updatesupplier() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setSupplierValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		    $data['supplierDO'] = DOFactory::getInstance()->createDO(DOEnum::SupplierDO, array('SUPPLIERID'=>set_value('supplierid'),'SUPPLIERNAME'=>set_value('suppliername'), 'ADDRESS'=>set_value('address'), 'TELEPHONE'=>set_value('telephone'), 'EMAIL'=>set_value('email'), 'CONTACTPERSON'=>set_value('contactperson'), 'STATUS'=>set_value('status'), 'DATEADDED'=>'', 'COMMENTS'=>set_value('comments'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::SupplierDO, array('SUPPLIERID'=>set_value('supplierid'),'SUPPLIERNAME'=>set_value('suppliername'), 'ADDRESS'=>set_value('address'), 'TELEPHONE'=>set_value('telephone'), 'EMAIL'=>set_value('email'), 'CONTACTPERSON'=>set_value('contactperson'), 'STATUS'=>set_value('status'), 'DATEADDED'=>'', 'COMMENTS'=>set_value('comments'),'UNITID'=>$this->session->userdata('unitId')));

		    $this->db->query('update suppliers set suppliername = ' . $this->db->escape($udo->getSuppliername()). 
		    	', email = ' . $this->db->escape($udo->getEmail()) . 
		    	', address = ' . $this->db->escape($udo->getAddress()) . 
		    	', telephone = ' . $this->db->escape($udo->getTelephone()) . 
		    	', contactperson = ' . $this->db->escape($udo->getContactperson()) .
		    	', status = ' . $this->db->escape($udo->getStatus()) .  
		    	' where supplierid = '. $udo->getSupplierid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';

		  }
		  return $data;

	}



	  private function setSupplierValidationRules() {

	  	$this->form_validation->set_rules('supplierid','Supplier ID','trim|required');
	  	$this->form_validation->set_rules('suppliername','Supplier name','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_rules('telephone','Telephone','trim');
		$this->form_validation->set_rules('email','Email','trim');
		$this->form_validation->set_rules('contactperson','Contact Person','trim');
		$this->form_validation->set_rules('address','Address','trim');
		$this->form_validation->set_rules('comments','Comments','trim');
	  }
 
 
}

