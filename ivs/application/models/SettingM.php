<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'SettingDAO.php';



class SettingM extends IVSModel {

    
       private $colNames = ' UNITID, SETTINGID, SETTINGTYPE, NAME, EMAIL  ';
	
	
       
	function __construct() {
	  parent::__construct();
	}

        
        protected function initializeDAO($sql) {
		
		$e = new SettingDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

        
	public function getSettings($where=null){
		
		$sql = 'SELECT ' . $this->colNames . ' FROM Settings where unitid=' . $this->session->unitId;
		return $this->initializeDAO($sql);

	}

	public function getSettingFromId(SettingDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM Setting where settingid=' . $udo->getSettingid();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function deleteSetting() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('settingid','Setting ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from settings where settingid = '. set_value('settingid'));
		   $data['msg'] = 'Removed Setting successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertSetting() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setSettingValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['settingDO'] = DOFactory::getInstance()->createDO(DOEnum::SettingDO, array('SETTINGID'=>set_value('settingid'),'SETTINGTYPE'=>set_value('settingtype'),'NAME'=>set_value('name'), 'EMAIL'=>set_value('email'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::SettingDO, array('SETTINGID'=>set_value('settingid'),'SETTINGTYPE'=>set_value('settingtype'),'NAME'=>set_value('name'), 'EMAIL'=>set_value('email'),'UNITID'=>$this->session->userdata('unitId')));
		   
			$this->db->query('insert into settings(settingid, settingtype, name, email, unitid) values('.$this->db->escape($udo->getSettingid()). ',' . $this->db->escape($udo->getSettingtype()) . ',' . $this->db->escape($udo->getName()) .  ',' . $this->db->escape($udo->getEmail()) . ',' . $this->db->escape($udo->getUnitid()) . ');');
			
			$data['msg'] = 'Setting Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;

	}

	public function updateSetting() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setSettingValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		   $data['settingDO'] = DOFactory::getInstance()->createDO(DOEnum::SettingDO, array('SETTINGID'=>set_value('settingid'),'SETTINGTYPE'=>set_value('settingtype'),'NAME'=>set_value('name'), 'EMAIL'=>set_value('email'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::SettingDO, array('SETTINGID'=>set_value('settingid'),'SETTINGTYPE'=>set_value('settingtype'),'NAME'=>set_value('name'), 'EMAIL'=>set_value('email'),'UNITID'=>$this->session->userdata('unitId')));

		    $this->db->query('update settings set settingtype = '. $this->db->escape($udo->getSettingtype()).', name = ' . $this->db->escape($udo->getName()) .  ', email = ' . $this->db->escape($udo->getEmail()) . ' where settingid = '. $udo->getSettingid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';

		  }
		  return $data;

	}



	  private function setSettingValidationRules() {

	  	$this->form_validation->set_rules('settingid','Setting ID','trim|required');
	  	$this->form_validation->set_rules('settingtype','Setting Type','trim|required');
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required');
	  }
 
 
}

