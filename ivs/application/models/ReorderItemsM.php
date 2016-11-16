<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'ReorderItemsDAO.php';



class ReorderItemsM extends IVSModel {

	private $colNames = ' ITEMID, INVENTORYID, QUANTITY, COMMENTS ';
	
	
	function __construct() {
	  parent::__construct();
	}


	public function GetAllReorderedItems($reorderid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM REORDERITEMS WHERE reorderid=' . $reorderid; 
		return $this->initializeDAO($sql);

	}


	public function GetReorderItemFromID($itemid) {

		$udo = null;
		$sql = 'SELECT ' . $this->colNames . ' FROM REORDERITEMS WHERE itemid=' . $itemid;
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function InsertReorderItem() {

		$sql = 'insert into reorderitems(reorderid, inventoryid, quantity, comments) values(' . $_POST['reorderid'] . ',' . 
				$_POST['inventoryid'] . ',' . 
				$_POST['quantity'] . ',' . 
				$this->db->escape($_POST['comments']). 
			') ';

		$this->db->query($sql);

		$data['msg'] = 'Item added!';
		$data['msgType'] = 'success';
			
		
		return $data;



	}

	public function UpdateReorderItem() {

		$sql = 'update reorderitems set inventoryid=' . 
				$_POST['inventoryid'] . ',quantity=' . 
				$_POST['quantity'] . ',comments=' . 
				$this->db->escape($_POST['comments']). 
			' where itemid= ' . $_POST['itemid'];

		$this->db->query($sql);

		$data['msg'] = 'Item saved!';
		$data['msgType'] = 'success';
			
		
		return $data;



	}


	protected function initializeDAO($sql) {
		
		$e = new ReorderItemsDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}







 
 
}

