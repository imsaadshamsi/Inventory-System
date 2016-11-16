<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'CategoryDAO.php';



class CategoryM extends IVSModel {

    
             
    private $colNames = ' CATEGORYID, CATEGORY, DESCRIPTION ';
	
    
    
	function __construct() {
	  parent::__construct();
	}
        
               	
	protected function initializeDAO($sql) {
		
		$e = new CategoryDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

        

	public function getCategories($unitid){
		
		$sql = 'SELECT ' . $this->colNames . ' FROM Category where unitid=' . $this->session->unitId;
		return $this->initializeDAO($sql);

	}

	public function getCategoryFromId(CategoryDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM Category WHERE categoryid=' . $udo->getCategoryid();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;
	}

	public function deleteCategory() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('categoryid','Category ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from category where categoryid = '. set_value('categoryid'));
		   $data['msg'] = 'Removed Category successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertCategory() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setCategoryValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['categoryDO'] = DOFactory::getInstance()->createDO(DOEnum::CategoryDO, array('CATEGORYID'=>set_value('categoryid'),'CATEGORY'=>set_value('category'),'DESCRIPTION'=>set_value('description'),'UNITID'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::CategoryDO, array('CATEGORYID'=>set_value('categoryid'),'CATEGORY'=>set_value('category'),'DESCRIPTION'=>set_value('description'),'UNITID'=>$this->session->userdata('unitId')));
		   
			$this->db->query('insert into category(categoryid, category, description, unitid) values('.$this->db->escape($udo->getCategoryid()). ',' . $this->db->escape($udo->getCategory()) . ',' . $this->db->escape($udo->getDescription()) .  ',' . $this->db->escape($udo->getUnitid()) .');');
			
			$data['msg'] = 'Category Added!';
			$data['msgType'] = 'success';
			
		}
		  return $data;

	}

	public function updateCategory() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setCategoryValidationRules();
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		    $data['categoryDO'] = DOFactory::getInstance()->createDO(DOEnum::CategoryDO, array('CATEGORYID'=>set_value('categoryid'),'CATEGORY'=>set_value('category'),'DESCRIPTION'=>set_value('description'),'UNIT'=>$this->session->userdata('unitId')));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::CategoryDO, array('CATEGORYID'=>set_value('categoryid'),'CATEGORY'=>set_value('category'),'DESCRIPTION'=>set_value('description'),'UNIT'=>$this->session->userdata('unitId')));

		    $this->db->query('update category set category = '. $this->db->escape($udo->getCategory()).', description = ' . $this->db->escape($udo->getDescription()) . ' where categoryid = '. $udo->getCategoryid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';

		  }
		  return $data;

	}



	  private function setCategoryValidationRules() {

	  	$this->form_validation->set_rules('categoryid','Category ID','trim|required');
	  	$this->form_validation->set_rules('category','Category','trim|required');
		$this->form_validation->set_rules('description','Description','trim|required');
	  }
 
 
}

