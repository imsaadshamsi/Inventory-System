<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'UnitDAO.php';


class UnitM extends IVSModel {


	private $colNames = ' UNITID, SITE, UNITNAME, STORE  ';
	
	
	function __construct() {
	  parent::__construct();
	}

	public function GetAllUnits() {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_UNIT ';
		return $this->initializeDAO($sql);
		
	}
	
	public function GetStoreUnits($store) {
		
		$sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_UNIT WHERE store=' . $store . 
                        ' and site=' . $this->session->site;
		return $this->initializeDAO($sql);
	
	}
	
	public function GetUnitFromId(UnitDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM ZCORE_UNIT WHERE unitid=' . $udo->getUnitid();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}
	
	
	protected function initializeDAO($sql) {
		
		$e = new UnitDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

	

	
	
	
	
	
	
	
	
	
	
	
	


	public function deleteUnit() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('unitid','Unit ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from ZCORE_UNIT where unitid = '. set_value('unitid'));
		   $data['msg'] = 'Removed Unit successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertUnit() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setUnitValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['unitDO'] = DOFactory::getInstance()->createDO(DOEnum::UnitDO, array('UNITNAME'=>set_value('unitname'),'SITE'=>set_value('site')));
		  }
		  else {
		    $udo = DOFactory::getInstance()->createDO(DOEnum::UnitDO, array('UNITNAME'=>set_value('unitname'),'SITE'=>set_value('site')));
		  
		   $this->db->query('insert into ZCORE_UNIT(unitname, site) values('. $this->db->escape($udo->getUnitname()) . ',' . $this->db->escape($udo->getSite()) . ');');
			
		   $data['msg'] = 'Unit Added!';
		   $data['msgType'] = 'success';
			
		}
		  return $data;

	}

	public function updateUnit() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setUnitValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		   $data['unitDO'] = DOFactory::getInstance()->createDO(DOEnum::UnitDO, array('UNITID'=>set_value('unitid'), 'UNITNAME'=>set_value('unitname'),'SITE'=>set_value('site')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::UnitDO, array('UNITID'=>set_value('unitid'), 'UNITNAME'=>set_value('unitname'),'SITE'=>set_value('site')));
		  
		    $this->db->query('update ZCORE_UNIT set unitname = '. $this->db->escape($udo->getUnitname()).', site = ' . $this->db->escape($udo->getSite()) . ' where unitid = '. $udo->getUnitid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';

		  }
		  return $data;

	}



	  private function setUnitValidationRules() {

	  	$this->form_validation->set_rules('unitid','Unit ID','trim|required');
	  	$this->form_validation->set_rules('site','Site','trim|required');
		$this->form_validation->set_rules('unitname','Unit Name','trim|required');
	  }
 
 
}

