<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'LocationDAO.php';



class LocationM extends IVSModel {

    
                   
    private $colNames = ' LOCATIONID, LOCATION, DESCRIPTION, LOCATIONCODE ';
	
    
	function __construct() {
	  parent::__construct();
	}
        
        protected function initializeDAO($sql) {
		
		$e = new LocationDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

        

	public function getLocations($where=null){
		
		$sql = 'SELECT ' . $this->colNames . ' FROM Location where unitid=' . $this->session->unitId;
		return $this->initializeDAO($sql);

	}

	public function getLocationFromId(LocationDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM Location WHERE locationid=' . $udo->getLocationid();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function deleteLocation() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('locationid','Location ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from location where locationid = '. set_value('locationid'));
		   $data['msg'] = 'Removed Location successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertLocation() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setLocationValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['locationDO'] = DOFactory::getInstance()->createDO(DOEnum::LocationDO, array('LOCATIONID'=>set_value('locationid'),'LOCATION'=>set_value('location'),'DESCRIPTION'=>set_value('description'),'LOCATIONCODE'=>set_value('locationcode'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::LocationDO, array('LOCATIONID'=>set_value('locationid'),'LOCATION'=>set_value('location'),'DESCRIPTION'=>set_value('description'), 'LOCATIONCODE'=>set_value('locationcode'), 'UNITID'=>$this->session->userdata('unitId')));
		   
			$this->db->query('insert into location(locationid, location, description, locationcode,unitid) values(' . $this->db->escape($udo->getLocationid()). ',' . $this->db->escape($udo->getLocation()) . ',' . $this->db->escape($udo->getDescription()) . ',' . $this->db->escape($udo->getLocationcode()) .  ',' . $this->db->escape($udo->getUnitid()) . ');');
			
			$data['msg'] = 'Location Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;

	}

	public function updateLocation() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setLocationValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		   $data['locationDO'] = DOFactory::getInstance()->createDO(DOEnum::LocationDO, array('LOCATIONID'=>set_value('locationid'),'LOCATION'=>set_value('location'),'DESCRIPTION'=>set_value('description'),'LOCATIONCODE'=>set_value('locationcode'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::LocationDO, array('LOCATIONID'=>set_value('locationid'),'LOCATION'=>set_value('location'),'DESCRIPTION'=>set_value('description'), 'LOCATIONCODE'=>set_value('locationcode'), 'UNITID'=>$this->session->userdata('unitId')));

		    $this->db->query('update location set location = '. 
		    	$this->db->escape($udo->getLocation()).', description = ' . 
		    	$this->db->escape($udo->getDescription()) . 
		    	', locationcode=' . $this->db->escape($udo->getLocationcode()) . 
		    	' where locationid = '. $udo->getLocationid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';

		  }
		  return $data;

	}



	  private function setLocationValidationRules() {

	  	$this->form_validation->set_rules('locationid','Location ID','trim|required');
	  	$this->form_validation->set_rules('location','Location','trim|required');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('locationcode','Location Code','trim|required');
	  }
 
 
}

