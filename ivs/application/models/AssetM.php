<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


require_once 'IVSModel.php';
include 'AssetDAO.php';



class AssetM extends IVSModel {

    private $colNames = ' ASSET_ID, PTAG_CODE, OTAG_CODE, COMM_CODE, ASSET_DESCR, SERIAL_NUM, 
    					  STAT, POHD_CODE, ORIG_DOC_CODE, ACTIVE_DATE, CAP, CAP_DATE, ORGN_RESP, 
    					  FUND, ORGN, LOCN_RESP, NET_BK_VALUE, ACCT, ACCT_TITLE ';
            
	function __construct() {
	  parent::__construct();
	}


	protected function initializeDAO($sql) {
		
		$e = new AssetDAO($sql, $this->db);
		$e->process();
		return $e;
	
	}

	public function getAllAssets(){

		$sql = 'SELECT ' . $this->colNames . ' FROM Assets';
		return $this->initializeDAO($sql);

	}

	public function getAsset(AssetDO $udo) {

		$sql = 'SELECT ' . $this->colNames . ' FROM Assets WHERE asset_id=' . $udo->getAsset_id();
		$guDAO = $this->initializeDAO($sql);
		$udo = $guDAO->next($udo);
		return $udo;

	}

	public function insertAsset() {

		$data = array();
		$this->load->library('form_validation');
		$this->setAssetValidationRules();


		if ($this->form_validation->run() === FALSE) {
			$data['msg'] = 'Validation errors:';
			$data['msgType'] = 'error';

			$udo = $data['assetDO'] = DOFactory::getInstance()->createDO(DOEnum::AssetDO, array(
				'ASSET_ID'=>set_value('assetid'),
				'PTAG_CODE'=>set_value('ptagcode'), 
				'OTAG_CODE'=>set_value('otagcode'), 
				'COMM_CODE'=>set_value('commcode'), 
				'ASSET_DESCR'=>set_value('assetdescr'), 
				'SERIAL_NUM'=>set_value('serialnum'), 
                'STAT'=>set_value('stat'), 
                'POHD_CODE'=>set_value('pohdcode'), 
                'ORIG_DOC_CODE'=>set_value('origdoccode'), 
                'ACTIVE_DATE'=>set_value('activedate'), 
                'CAP'=>set_value('cap'), 
                'CAP_DATE'=>set_value('capdate'), 
                'ORGN_RESP'=>set_value('orgnresp'), 
                'FUND'=>set_value('fund'), 
                'ORGN'=>set_value('orgn'), 
                'LOCN_RESP'=>set_value('locnresp'), 
                'NET_BK_VALUE'=>set_value('netbkvalue'), 
                'ACCT'=>set_value('acct'), 
                'ACCT_TITLE'=>set_value('accttitle')
			));
		}
		else {

				$udo = $data['assetDO'] = DOFactory::getInstance()->createDO(DOEnum::AssetDO, array(
				'ASSET_ID'=>set_value('assetid'),
				'PTAG_CODE'=>set_value('ptagcode'), 
				'OTAG_CODE'=>set_value('otagcode'), 
				'COMM_CODE'=>set_value('commcode'), 
				'ASSET_DESCR'=>set_value('assetdescr'), 
				'SERIAL_NUM'=>set_value('serialnum'), 
                'STAT'=>set_value('stat'), 
                'POHD_CODE'=>set_value('pohdcode'), 
                'ORIG_DOC_CODE'=>set_value('origdoccode'), 
                'ACTIVE_DATE'=>set_value('activedate'), 
                'CAP'=>set_value('cap'), 
                'CAP_DATE'=>set_value('capdate'), 
                'ORGN_RESP'=>set_value('orgnresp'), 
                'FUND'=>set_value('fund'), 
                'ORGN'=>set_value('orgn'), 
                'LOCN_RESP'=>set_value('locnresp'), 
                'NET_BK_VALUE'=>set_value('netbkvalue'), 
                'ACCT'=>set_value('acct'), 
                'ACCT_TITLE'=>set_value('accttitle')
			));

				$sql = 'insert into assets(PTAG_CODE, OTAG_CODE, COMM_CODE, ASSET_DESCR, SERIAL_NUM, 
    					  STAT, POHD_CODE, ORIG_DOC_CODE, ACTIVE_DATE, CAP, CAP_DATE, ORGN_RESP, 
    					  FUND, ORGN, LOCN_RESP, NET_BK_VALUE, ACCT, ACCT_TITLE) values('. 
				$this->db->escape($udo->getPtag_code()). ',' . 
				$this->db->escape($udo->getOtag_code()) . ',' . 
				$this->db->escape($udo->getComm_code()) .  ',' . 
				$this->db->escape($udo->getAsset_descr()) . ',' .
				$this->db->escape($udo->getSerial_num()) . ',' .
				$this->db->escape($udo->getStat()) . ',' .
				$this->db->escape($udo->getPohd_code()) . ',' .
				$this->db->escape($udo->getOrig_doc_code()) . ',' .
				$this->db->escape($udo->getActive_date()) . ',' .
				$this->db->escape($udo->getCap()) . ',' .
				$this->db->escape($udo->getCap_date()) . ',' .
				$this->db->escape($udo->getOrgn_resp()) . ',' .
				$this->db->escape($udo->getFund()) . ',' .
				$this->db->escape($udo->getOrgn()) . ',' .
				$this->db->escape($udo->getLocn_resp()) . ',' .
				$this->db->escape($udo->getNet_bk_value()) . ',' .
				$this->db->escape($udo->getAcct()) . ',' .
				$this->db->escape($udo->getAcct_title()) . 
				');';

	var_dump($sql);
			if( $this->db->query($sql) === TRUE) {
				$data['msg'] = 'New Asset Added!';
				$data['msgType'] = 'success';
			}else{
				$data['msg'] = 'There was a problem executing the query. Please contact the Administrator!';
				$data['msgType'] = 'error';
			}

		}
		return $data;

	}

	public function updateAsset() {

		$data = array();
		$this->load->library('form_validation');
		$this->setAssetValidationRules();

		if ($this->form_validation->run() === FALSE) {
			
			$data['msg'] = 'Validation errors:';
			$data['msgType'] = 'error';

			$udo = $data['assetDO'] = DOFactory::getInstance()->createDO(DOEnum::AssetDO, array(
				'ASSET_ID'=>set_value('assetid'),
				'PTAG_CODE'=>set_value('ptagcode'), 
				'OTAG_CODE'=>set_value('otagcode'), 
				'COMM_CODE'=>set_value('commcode'), 
				'ASSET_DESCR'=>set_value('assetdescr'), 
				'SERIAL_NUM'=>set_value('serialnum'), 
                'STAT'=>set_value('stat'), 
                'POHD_CODE'=>set_value('pohdcode'), 
                'ORIG_DOC_CODE'=>set_value('origdoccode'), 
                'ACTIVE_DATE'=>set_value('activedate'), 
                'CAP'=>set_value('cap'), 
                'CAP_DATE'=>set_value('capdate'), 
                'ORGN_RESP'=>set_value('orgnresp'), 
                'FUND'=>set_value('fund'), 
                'ORGN'=>set_value('orgn'), 
                'LOCN_RESP'=>set_value('locnresp'), 
                'NET_BK_VALUE'=>set_value('netbkvalue'), 
                'ACCT'=>set_value('acct'), 
                'ACCT_TITLE'=>set_value('accttitle')
			));

		}
		else {

			$udo = DOFactory::getInstance()->createDO(DOEnum::AssetDO, array(
				'ASSET_ID'=>set_value('assetid'),
				'PTAG_CODE'=>set_value('ptagcode'), 
				'OTAG_CODE'=>set_value('otagcode'), 
				'COMM_CODE'=>set_value('commcode'), 
				'ASSET_DESCR'=>set_value('assetdescr'), 
				'SERIAL_NUM'=>set_value('serialnum'), 
                'STAT'=>set_value('stat'), 
                'POHD_CODE'=>set_value('pohdcode'), 
                'ORIG_DOC_CODE'=>set_value('origdoccode'), 
                'ACTIVE_DATE'=>set_value('activedate'), 
                'CAP'=>set_value('cap'), 
                'CAP_DATE'=>set_value('capdate'), 
                'ORGN_RESP'=>set_value('orgnresp'), 
                'FUND'=>set_value('fund'), 
                'ORGN'=>set_value('orgn'), 
                'LOCN_RESP'=>set_value('locnresp'), 
                'NET_BK_VALUE'=>set_value('netbkvalue'), 
                'ACCT'=>set_value('acct'), 
                'ACCT_TITLE'=>set_value('accttitle')
			));

			$sql= 'update assets set 
				PTAG_CODE = '. $this->db->escape($udo->getPtag_code()). ',' . 
				'OTAG_CODE=' . $this->db->escape($udo->getOtag_code()) . ',' . 
				'COMM_CODE=' . $this->db->escape($udo->getComm_code()) .  ',' . 
				'ASSET_DESCR=' . $this->db->escape($udo->getAsset_descr()) . ',' .
				'SERIAL_NUM=' . $this->db->escape($udo->getSerial_num()) . ',' .
				'STAT=' . $this->db->escape($udo->getStat()) . ',' .
				'POHD_CODE=' . $this->db->escape($udo->getPohd_code()) . ',' .
				'ORIG_DOC_CODE=' . $this->db->escape($udo->getOrig_doc_code()) . ',' .
				'ACTIVE_DATE=' . $this->db->escape($udo->getActive_date()) . ',' .
				'CAP=' . $this->db->escape($udo->getCap()) . ',' .
				'CAP_DATE=' . $this->db->escape($udo->getCap_date()) . ',' .
				'ORGN_RESP=' . $this->db->escape($udo->getOrgn_resp()) . ',' .
				'FUND=' . $this->db->escape($udo->getFund()) . ',' .
				'ORGN=' . $this->db->escape($udo->getOrgn()) . ',' .
				'LOCN_RESP=' . $this->db->escape($udo->getLocn_resp()) . ',' .
				'NET_BK_VALUE=' . $this->db->escape($udo->getNet_bk_value()) . ',' .
				'ACCT=' . $this->db->escape($udo->getAcct()) . ',' .
				'ACCT_TITLE=' . $this->db->escape($udo->getAcct_title()) . 
				' where ASSET_ID=' . $udo->getAsset_id();

			if( $this->db->query($sql) === TRUE) {
				$data['msg'] = 'Saved changes successfully!';
				$data['msgType'] = 'success';
			}else{
				$data['msg'] = 'There was a problem executing the query. Please contact the Administrator!';
				$data['msgType'] = 'error';
			}



		}
		return $data;


	}

	private function setAssetValidationRules() {

		$this->form_validation->set_rules('assetid','Asset Identifier','trim|required');
		$this->form_validation->set_rules('ptagcode','Ptag Code','trim|required');
		$this->form_validation->set_rules('otagcode','Otag Code','trim|required');
		$this->form_validation->set_rules('commcode','Comm Code','trim|required');
		$this->form_validation->set_rules('assetdescr','Asset Descr','trim|required');
		$this->form_validation->set_rules('serialnum','Serial Num','trim|required');
		$this->form_validation->set_rules('stat','Stat','trim|required');
		$this->form_validation->set_rules('pohdcode','Pohd Code','trim|required');
		$this->form_validation->set_rules('origdoccode','Orig Doc Code','trim|required');
		$this->form_validation->set_rules('activedate','Active Date','trim|required');
		$this->form_validation->set_rules('cap','Cap','trim|required');
		$this->form_validation->set_rules('orgnresp','Orgn Resp','trim|required');
		$this->form_validation->set_rules('fund','Fund','trim|required');
		$this->form_validation->set_rules('orgn','Orgn','trim|required');
		$this->form_validation->set_rules('locnresp','Locn Resp','trim|required');
		$this->form_validation->set_rules('netbkvalue','Net Bk Value','trim|required');
		$this->form_validation->set_rules('acct','Acct','trim|required');
		$this->form_validation->set_rules('accttitle','Acct Title','trim|required');
		// $this->form_validation->set_rules('','','trim|required');
		// $this->form_validation->set_rules('','','trim|required');
		// $this->form_validation->set_rules('','','trim|required');

	}


        

}

