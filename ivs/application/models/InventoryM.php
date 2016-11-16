<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'InventoryDAO.php';
include 'Inventory2DAO.php';


class InventoryM extends IVSModel {

	private $colNames = 'INVENTORYID, CATEGORYID, INVENTORY.UNITID, SHELVINGID, NAME, DESCRIPTION, MINIMUMQUANTITY, QUANTITYAVAILABLE, STATUS, FLAG, STOCKNUMBER, COMMENTS, DATEADDED ';
	
	function __construct() {
	  parent::__construct();
	}

	public function GetAllInventory($unitid) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM INVENTORY WHERE unitid=' . $unitid . ' ORDER BY name asc, (CASE status
                            WHEN "AVAILABLE" 	 THEN 1
                            WHEN "OUT OF STOCK"	 THEN 2
                            WHEN "DISCONTINUED"	 THEN 3
                            END)' ; 
		return $this->initializeDAO($sql);

	}
	
		public function GetAllInventory2($unitid) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM INVENTORY WHERE unitid=' . $unitid . '  and status="AVAILABLE" ' ; 
		return $this->initializeDAO($sql);

	}
	
	public function GetAllInventoryByASC($unitid){
		$sql = 'SELECT ' . $this->colNames . ' FROM INVENTORY WHERE unitid=' . $unitid . ' ORDER BY name ASC' ; 
		return $this->initializeDAO($sql);
	}
        
        public function GetAllInventorySite($siteid) {
	
		$sql = 'SELECT INVENTORYID, INVENTORY.NAME, UNITNAME, SITE FROM INVENTORY, ZCORE_UNIT WHERE INVENTORY.UNITID=ZCORE_UNIT.UNITID and ZCORE_UNIT.SITE=' . $siteid . ' AND INVENTORY.STATUS="AVAILABLE" '; 
		return $this->initializeDAO2($sql);

	}
	
	public function GetAllInventoryWithAlerts($flag, $unitid) {
	
		$sql = 'SELECT ' . $this->colNames . ' FROM INVENTORY WHERE flag = ' . $flag . ' and unitid=' . $unitid ; 
		return $this->initializeDAO($sql);
		
	}
	
	public function GetInventoryFromId($inventoryid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM INVENTORY WHERE inventoryid=' . $inventoryid;
		$guDAO = $this->initializeDAO($sql);
		$udo = null;
		$udo = $guDAO->next($udo);
		return $udo;

	}
	
	public function GetInventoryBySearch($stocknumber) {


		$sql = 'SELECT ' . $this->colNames . ' FROM INVENTORY WHERE stocknumber=' . $this->db->escape($stocknumber); 
		return $this->initializeDAO($sql);

	}
	
	protected function initializeDAO($sql) {
		
		$e = new  InventoryDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
        
        protected function initializeDAO2($sql) {
		
		$e = new  Inventory2DAO($sql, $this->db);
		$e->process();
		return $e;
	
	}
        

	public function deleteInventory() {

		$data = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('Inventoryid','Inventory ID','trim|required|is_natural_no_zero');
		  
		if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		} else{
		  
		   $this->db->query('delete from Inventory where Inventoryid = '. set_value('Inventoryid'));
		   $data['msg'] = 'Removed Inventory successfully!';
		   $data['msgType'] = 'success';
		}
		  
		  return $data;

	}

	public function insertInventory() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setInventoryValidationRules();
		  
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   $data['inventoryDO'] = DOFactory::getInstance()->createDO(DOEnum::InventoryDO, array('INVENTORYID'=>set_value('inventoryid'),'NAME'=>set_value('name'),'DESCRIPTION'=>set_value('description'),'UNITID'=>$this->session->userdata('unitId'),
		   	   'SHELVINGID'=>set_value('shelvingid'), 
		   	   'QUANTITYAVAILABLE'=>set_value('quantityavailable'),
		   	   'MINIMUMQUANTITY'=>set_value('minimumquantity'),
		   	   'STATUS'=>set_value('status'),
		   	   'STOCKNUMBER'=>set_value('stocknumber'),
		   	   'CATEGORYID'=>set_value('categoryid'),
		   	   'COMMENTS'=>set_value('comments')

		   	));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::InventoryDO, array('INVENTORYID'=>set_value('inventoryid'),'NAME'=>set_value('name'),'DESCRIPTION'=>set_value('description'),'UNITID'=>$this->session->userdata('unitId'),
		   	   'SHELVINGID'=>set_value('shelvingid'), 
		   	   'QUANTITYAVAILABLE'=>set_value('quantityavailable'),
		   	   'MINIMUMQUANTITY'=>set_value('minimumquantity'),
		   	   'STATUS'=>set_value('status'),
		   	   'STOCKNUMBER'=>set_value('stocknumber'),
		   	   'CATEGORYID'=>set_value('categoryid'),
		   	   'COMMENTS'=>set_value('comments')
		   	));

                   
		   /* Update status */
                    $engine2 = new RulesEngine();
                    $engine2->setRule(new Rule_002());
                    $result2 = $engine2->applyRule(array('quantityavailable'=> $udo->getQuantityavailable(), 'status'=>$udo->getStatus()));
                    $udo->setStatus($result2['status']);
                    
		   /* Check flag */
                   $engine = new RulesEngine();
                   $engine->setRule(new Rule_001());
                   $result = $engine->applyRule(array('status'=>$udo->getStatus(), 'quantityavailable'=> $udo->getQuantityavailable(), 'minimumquantity'=>$udo->getMinimumquantity()));
		   $udo->setFlag($result['flag']);
                   
                   

               
                   
                   $fieldnames = 'name,stocknumber, categoryid, shelvingid, quantityavailable,minimumquantity,status,comments, description, unitid,flag,dateadded,userid';
		   $fieldvalues = $this->db->escape($udo->getName()). ','
				 . $this->db->escape($udo->getStocknumber()) . ',' 
				 . $this->db->escape($udo->getCategoryid()) . ',' 
				 . $this->db->escape($udo->getShelvingid()) . ',' 
				 . $this->db->escape($udo->getQuantityavailable()) . ',' 
				 . $this->db->escape($udo->getMinimumquantity()) . ',' 
				 . $this->db->escape($udo->getStatus()) . ',' 
				 . $this->db->escape($udo->getComments()) . ',' 
				 . $this->db->escape($udo->getDescription()) .  ','
				 . $this->db->escape($udo->getUnitid()) .',' .  $udo->getFlag() . ', now() ,' . $this->session->userId;
                   
			$this->db->query('insert into inventory(' . $fieldnames . ') values('. $fieldvalues . ');');
			
			$data['msg'] = 'Inventory Added!';
			$data['msgType'] = 'success';
                        
                        $log = new Logger($this->db);
                        $param = new LogDO('INSERT', 'INVENTORY', $fieldnames, $fieldvalues, 'now()', $this->session->userId, $this->session->unitId, 'none', 'STOCKNUMBER', $udo->getStocknumber());
                        $log->log($param);
        			
		}
		  return $data;

	}

	public function updateQuantityAvailable($udo) {

                /* Update status */
                $engine2 = new RulesEngine();
                $engine2->setRule(new Rule_002());
                $result2 = $engine2->applyRule(array('quantityavailable'=> $udo->getQuantityavailable(), 'status'=>$udo->getStatus()));
                $udo->setStatus($result2['status']);

                /* Check flag */
                $engine = new RulesEngine();
                $engine->setRule(new Rule_001());
                $result = $engine->applyRule(array('status'=>$udo->getStatus(), 'quantityavailable'=> $udo->getQuantityavailable(), 'minimumquantity'=>$udo->getMinimumquantity()));
                $udo->setFlag($result['flag']);

                $this->db->query('update inventory set quantityavailable=' . $udo->getQuantityavailable() . ', flag=' . $udo->getFlag() . ', status=' .  $this->db->escape($udo->getStatus()) .   ' where inventoryid=' . $udo->getInventoryid());

       }

	public function updateInventory() {

		  $data = array();
		  $this->load->library('form_validation');
		  $this->setInventoryValidationRules();
		  $this->form_validation->set_rules('reason', 'Reason for Edit','trim|required');
	
		  if ($this->form_validation->run() === FALSE) {
		   $data['msg'] = 'Validation errors:';
		   $data['msgType'] = 'error';
		   
		    $data['inventoryDO'] = DOFactory::getInstance()->createDO(DOEnum::InventoryDO, array('INVENTORYID'=>set_value('inventoryid'),'NAME'=>set_value('name'),'DESCRIPTION'=>set_value('description'),'UNITID'=>$this->session->userdata('unitId'),
		   	   'SHELVINGID'=>set_value('shelvingid'), 
		   	   'QUANTITYAVAILABLE'=>set_value('quantityavailable'),
		   	   'MINIMUMQUANTITY'=>set_value('minimumquantity'),
		   	   'STATUS'=>set_value('status'),
		   	   'STOCKNUMBER'=>set_value('stocknumber'),
		   	   'CATEGORYID'=>set_value('categoryid'),
		   	   'COMMENTS'=>set_value('comments')

		   	));
		  }
		  else {
		   $udo = DOFactory::getInstance()->createDO(DOEnum::InventoryDO, array('INVENTORYID'=>set_value('inventoryid'),'NAME'=>set_value('name'),'DESCRIPTION'=>set_value('description'),'UNITID'=>$this->session->userdata('unitId'),
		   	   'SHELVINGID'=>set_value('shelvingid'), 
		   	   'QUANTITYAVAILABLE'=>set_value('quantityavailable'),
		   	   'MINIMUMQUANTITY'=>set_value('minimumquantity'),
		   	   'STATUS'=>set_value('status'),
		   	   'STOCKNUMBER'=>set_value('stocknumber'),
		   	   'CATEGORYID'=>set_value('categoryid'),
		   	   'COMMENTS'=>set_value('comments')

		   	));


		  //Retrieve old values
		   $old = $this->getInventoryFromId($udo->getInventoryid());
		   $new = $udo;

		  // Insert row into edithistory table
		   $this->db->query('insert into edithistory(inventoryid, event, userid, oldquantity, newquantity, oldmin, newmin, oldstatus, newstatus, oldsnum,newsnum, oldname, newname, olddesc,newdesc, oldcat,newcat, oldshelvingid, newshelvingid, oldcomments, newcomments, dateoccurred,reasonforedit) values('.
				$this->db->escape($udo->getInventoryid()). ',"EDIT",' . $this->session->userdata('userId') . ',' 
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
				 . $this->db->escape(set_value('reason'))
				 . ');');

                   /* Update status */
                    $engine2 = new RulesEngine();
                    $engine2->setRule(new Rule_002());
                    $result2 = $engine2->applyRule(array('quantityavailable'=> $udo->getQuantityavailable(), 'status'=>$udo->getStatus()));
                    $udo->setStatus($result2['status']);

                    /* Check flag */
                    $engine = new RulesEngine();
                    $engine->setRule(new Rule_001());
                    $result = $engine->applyRule(array('status'=>$udo->getStatus(), 'quantityavailable'=> $udo->getQuantityavailable(), 'minimumquantity'=>$udo->getMinimumquantity()));
                    $udo->setFlag($result['flag']);
                   
                   
                    $fieldnames = '';
                    $fieldvalues = ' name = '. $this->db->escape($udo->getName()) . 
		    	', description = ' . $this->db->escape($udo->getDescription()) .
		    	', quantityavailable = ' . $this->db->escape($udo->getQuantityavailable()) .
		    	', minimumquantity = ' . $this->db->escape($udo->getMinimumquantity()) .
		    	', status = ' . $this->db->escape($udo->getStatus()) .
		    	', stocknumber = ' . $this->db->escape($udo->getStocknumber()) .
		    	', categoryid = ' . $this->db->escape($udo->getCategoryid()) .
		    	', comments = ' . $this->db->escape($udo->getComments()) .
				', flag = ' . $this->db->escape($udo->getFlag()) .
		    	', shelvingid = ' . $this->db->escape($udo->getShelvingid());
                    
		    $this->db->query('update inventory set ' . $fieldvalues  .
		    	 ' where inventoryid = '. $udo->getInventoryid() );

		    $data['msg'] = 'Saved changes successfully!';
		    $data['msgType'] = 'success';
                    
                    
                    $log = new Logger($this->db);
                    $param = new LogDO('UPDATE', 'INVENTORY', $fieldnames, $fieldvalues, 'now()', $this->session->userId, $this->session->unitId, 'none', 'STOCKNUMBER', $udo->getStocknumber());
                    $log->log($param);


		  }
		  return $data;

	}



	  private function setInventoryValidationRules() {

	  	$this->form_validation->set_rules('inventoryid','Inventory ID','trim|required');
		$this->form_validation->set_rules('stocknumber','Stock Number','trim|required');
	  	$this->form_validation->set_rules('name','Name','trim|required');
	  	$this->form_validation->set_rules('comments','Comments','trim|required');
	  	$this->form_validation->set_rules('status','Inventory','trim|required');
	  	$this->form_validation->set_rules('quantityavailable','Quantity Available','trim|required|numeric');
	  	$this->form_validation->set_rules('minimumquantity','Minimum Qty','trim|required|numeric');
	  	$this->form_validation->set_rules('shelvingid','Shelving','trim|required');
	  	$this->form_validation->set_rules('unitid','Unit','trim|required');
	  	$this->form_validation->set_rules('categoryid','Category ID','trim|required');
		$this->form_validation->set_rules('description','Description','trim|required');
		
	  }

 
 
}

