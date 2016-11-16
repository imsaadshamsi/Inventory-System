<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'ShelvingDAO.php';
include 'ShelvingListDAO.php';



class ShelvingM extends IVSModel {

        private $colNames = ' SHELVINGID, SHELVING, DESCRIPTION, LOCATIONID ';
        
	function __construct() {
	  parent::__construct();
	}
        
        
        
        
	protected function initializeDAO($sql) {
		
		$e = new ShelvingDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

        

	public function getShelvings($where=null){
		
		
                
                $sql = 'SELECT ' . $this->colNames . ' FROM Shelving where ' . $where;
		return $this->initializeDAO($sql);

	}

	public function getShelvingsList($where=null){
		
		$sql = 'SELECT  SHELVINGID, SHELVING, a.DESCRIPTION, a.LOCATIONID, b.LOCATION  FROM Shelving a, Location b where a.locationid = b.locationid and b.unitid= ' . $this->session->unitId;
		return $this->initializeDAO($sql);

	}



	public function getShelvingFromId(ShelvingDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM Shelving WHERE shelvingid=' . $udo->getShelvingid();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function deleteShelving() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('shelvingid','Shelving ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from shelving where shelvingid = '. set_value('shelvingid'));
		   $data['msg'] = 'Removed Shelving successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertShelving() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setShelvingValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['shelvingDO'] = DOFactory::getInstance()->createDO(DOEnum::ShelvingDO, array('SHELVINGID'=>set_value('shelvingid'),'SHELVING'=>set_value('shelving'),'DESCRIPTION'=>set_value('description'),'LOCATIONID'=>set_value('locationid')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::ShelvingDO, array('SHELVINGID'=>set_value('shelvingid'),'SHELVING'=>set_value('shelving'),'DESCRIPTION'=>set_value('description'),'LOCATIONID'=>set_value('locationid')));
		   
			$this->db->query('insert into shelving(shelving, description, locationid) values(' . $this->db->escape($udo->getShelving()) . ',' . $this->db->escape($udo->getDescription()) . ',' . $this->db->escape($udo->getLocationid()) .  ');');
			
			$data['msg'] = 'Shelving Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;

	}

	public function updateShelving() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setShelvingValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		   $data['shelvingDO'] = DOFactory::getInstance()->createDO(DOEnum::ShelvingDO, array('SHELVINGID'=>set_value('shelvingid'),'SHELVING'=>set_value('shelving'),'DESCRIPTION'=>set_value('description'),'LOCATIONID'=>set_value('locationid')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::ShelvingDO, array('SHELVINGID'=>set_value('shelvingid'),'SHELVING'=>set_value('shelving'),'DESCRIPTION'=>set_value('description'),'LOCATIONID'=>set_value('locationid')));

		    $this->db->query('update Shelving set shelving = '. 
		    	$this->db->escape($udo->getShelving()).', description = ' . 
		    	$this->db->escape($udo->getDescription()) .  
		    	' where shelvingid = '. $udo->getShelvingid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';

		  }
		  return $data;

	}



	  private function setShelvingValidationRules() {

	  	$this->form_validation->set_rules('shelvingid','Shelving ID','trim|required');
	  	$this->form_validation->set_rules('shelving','Shelving','trim|required');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('locationid','Location ID','trim|required');
	  }
 
 
}

