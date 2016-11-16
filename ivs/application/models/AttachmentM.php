<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'AttachmentDAO.php';



class AttachmentM extends IVSModel {

	private $colNames = ' ATTACHMENTID, REORDERID, TYPE,  URL, USERID, DATEADDED, TITLE ';
	
	
	function __construct() {
	  parent::__construct();
	}


	public function GetAllAttachments($reorderid) {

		$sql = 'SELECT ' . $this->colNames . ' FROM ATTACHMENTS WHERE reorderid=' . $reorderid . ' order by dateadded'; 
		return $this->initializeDAO($sql);

	}

	public function GetAttachmentFromID($attachmentid) {

		$udo = null;
		$sql = 'SELECT ' . $this->colNames . ' FROM ATTACHMENTS WHERE attachmentid=' . $attachmentid;
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function UpdateAttachment() {

		$data = array();
		$this->load->library('form_validation');
		$this->setValidationRules();

		if($this->form_validation->run() === FALSE) {

			$data['msg'] = 'Validation errors:';
		    $data['msgType'] = 'error';
		    $data['attachmentDO'] = DOFactory::getInstance()->createDO(DOEnum::AttachmentDO, array('ATTACHMENTID'=>set_value('attachmentid'),'REORDERID'=>set_value('reorderid'),'USERID'=>set_value('status'), 'URL'=>$arr['file_name'], 'TITLE'=>set_value('title')));

		} else {

		   $config['upload_path'] = './'.UPLOAD_FOLDER.'/';
   		   $config['allowed_types'] = 'jpg|png|gif|pdf';
   		   $this->load->library('upload', $config);

		  	   if ($this->upload->do_upload()) {

				  
			   		   $arr = $this->upload->data();
					   $udo = DOFactory::getInstance()->createDO(DOEnum::AttachmentDO, array('ATTACHMENTID'=>set_value('attachmentid'),'REORDERID'=>set_value('reorderid'),'USERID'=>set_value('status'), 'URL'=>$arr['file_name'], 'TITLE'=>set_value('title')));
					   $udo->setTitle(set_value('title'));
					   $udo->setType(set_value('type'));
					   //$udo->setUrl(set_value('url'));
					  
					   $udo->setUrl($arr['file_name']);

					   //if($udo->getUrl() != null  && $udo->getUrl() != '') { 
					   	$this->db->query('update attachments set' .
					   	' title = ' . $this->db->escape($udo->getTitle()) . 
					   	', url = ' . $this->db->escape($udo->getUrl()) .
					   	', type = ' . $this->db->escape($udo->getType()) .
					   	', userid=' . $_POST['userid'] .
					   	', dateadded=now()' . 
					   	' where attachmentid = '. $udo->getAttachmentid());
					  // }
					   


		   	   $data['msg'] = 'Saved changes successfully!';
		  	 $data['msgType'] = 'success';

			   		
			} else {



				 	$this->db->query('update attachments set' .
					   	' title = ' . $this->db->escape(set_value('title')) . 
					   	', type = ' . $this->db->escape(set_value('type')) .
					   	', userid=' . $_POST['userid'] .
					   	', dateadded=now()' . 
					   	' where attachmentid = '. set_value('attachmentid'));

				 $data['msg'] = 'Attachment updated. But no files uploaded!';
		  	 	 $data['msgType'] = 'success';
			}


		}

		return $data;

	}


		public function InsertAttachment() {

		$data = array();
		$this->load->library('form_validation');
		$this->setValidationRules();
		$arr = null;

		if($this->form_validation->run() === FALSE) {

			$data['msg'] = 'Validation errors:';
		    $data['msgType'] = 'error';
		    $data['attachmentDO'] = DOFactory::getInstance()->createDO(DOEnum::AttachmentDO, array('ATTACHMENTID'=>set_value('attachmentid'),'REORDERID'=>set_value('reorderid'),'USERID'=>set_value('status'), 'URL'=>$arr['file_name'], 'TITLE'=>set_value('title')));

		} else {

		   $config['upload_path'] = './'.UPLOAD_FOLDER.'/';
   		   $config['allowed_types'] = 'jpg|png|gif|pdf';
   		   $this->load->library('upload', $config);

   		    $udo = DOFactory::getInstance()->createDO(DOEnum::AttachmentDO, array('ATTACHMENTID'=>set_value('attachmentid'),'REORDERID'=>set_value('reorderid'),'USERID'=>set_value('status'), 'URL'=>'-', 'TITLE'=>set_value('title')));
					   $udo->setTitle(set_value('title'));
					   $udo->setType(set_value('type'));


		  	   if ($this->upload->do_upload()) {

				  
			   		   $arr = $this->upload->data();
					   $udo->setUrl($arr['file_name']);
					
					   	$this->db->query('insert into attachments(reorderid, title, url, type, userid, dateadded) values(' . set_value('reorderid') . 
					   	',' . $this->db->escape($udo->getTitle()) . 
					   	', ' . $this->db->escape($udo->getUrl()) .
					   	', ' . $this->db->escape($udo->getType()) .
					   	',' . $_POST['userid'] .
					   	', now())');



		   	   $data['msg'] = 'Saved changes successfully!';
		  	 $data['msgType'] = 'success';

			   		
			} else {



				 	$this->db->query('insert into attachments(reorderid, title, url, type, userid, dateadded) values(' . set_value('reorderid') . 

					   	',' . $this->db->escape($udo->getTitle()) . 
					   	', ' . $this->db->escape($udo->getUrl()) .
					   	', ' . $this->db->escape($udo->getType()) .
					   	',' . $_POST['userid'] .
					   	', now())');

				 $data['msg'] = 'Attachment updated. But no files uploaded!';
		  	 	 $data['msgType'] = 'success';
			}


		}

		return $data;

	}





	protected function initializeDAO($sql) {
		
		$e = new AttachmentDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}


	private function setValidationRules() {
	
	  	$this->form_validation->set_rules('reorderid','Reorder ID','trim|numeric|required');
		$this->form_validation->set_rules('attachmentid','Attachment ID','trim');	
		$this->form_validation->set_rules('userfile','Attachment URL','trim');
		$this->form_validation->set_rules('type','Type','trim');
		$this->form_validation->set_rules('url','URL','trim');
		$this->form_validation->set_rules('title','Title','trim');
		$this->form_validation->set_rules('dateadded','Date Added','trim');

		//$this->form_validation->set_rules('userid','Userid','trim');

	}



 
 
}

