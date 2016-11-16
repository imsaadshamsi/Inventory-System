<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}


class AssetDO extends DataObject {
 
  private $asset_id;
  private $ptag_code;
  private $otag_code;
  private $comm_code;
  private $asset_descr;
  private $serial_num;
  private $stat;
  private $pohd_code;
  private $orig_doc_code;
  private $active_date;
  private $cap;
  private $cap_date;
  private $orgn_resp;
  private $fund;
  private $orgn;
  private $locn_resp;
  private $net_bk_value;
  private $acct;
  private $acct_title;

  function __construct($asset_id, $ptag_code, $otag_code, $comm_code, $asset_descr, $serial_num, $stat, $pohd_code, $orig_doc_code, $active_date, $cap,
    $cap_date, $orgn_resp, $fund, $orgn, $locn_resp, $net_bk_value, $acct, $acct_title) {

    $this->asset_id = $asset_id;
    $this->ptag_code = $ptag_code;
    $this->otag_code = $otag_code;
    $this->comm_code = $comm_code;
    $this->asset_descr = $asset_descr;
    $this->serial_num = $serial_num;
    $this->stat = $stat;
    $this->pohd_code = $pohd_code;
    $this->orig_doc_code = $orig_doc_code;
    $this->active_date = $active_date;
    $this->cap = $cap;
    $this->cap_date = $cap_date;
    $this->orgn_resp = $orgn_resp;
    $this->fund = $fund;
    $this->locn_resp = $locn_resp;
    $this->net_bk_value = $net_bk_value;
    $this->acct = $acct;
    $this->acct_title = $acct_title;
    $this->orgn = $orgn;

  }

  public function getAsset_id(){
    return $this->asset_id;
  }

  public function setAsset_id($asset_id){
    $this->asset_id = $asset_id;
  }

  public function getPtag_code(){
    return $this->ptag_code;
  }

  public function setPtag_code($ptag_code){
    $this->ptag_code = $ptag_code;
  }

  public function getOtag_code(){
    return $this->otag_code;
  }

  public function setOtag_code($otag_code){
    $this->otag_code = $otag_code;
  }

  public function getComm_code(){
    return $this->comm_code;
  }

  public function setComm_code($comm_code){
    $this->comm_code = $comm_code;
  }

  public function getAsset_descr(){
    return $this->asset_descr;
  }

  public function setAsset_descr($asset_descr){
    $this->asset_descr = $asset_descr;
  }

  public function getSerial_num(){
    return $this->serial_num;
  }

  public function setSerial_num($serial_num){
    $this->serial_num = $serial_num;
  }

  public function getStat(){
    return $this->stat;
  }

  public function setStat($stat){
    $this->stat = $stat;
  }

  public function getPohd_code(){
    return $this->pohd_code;
  }

  public function setPohd_code($pohd_code){
    $this->pohd_code = $pohd_code;
  }

  public function getOrig_doc_code(){
    return $this->orig_doc_code;
  }

  public function setOrig_doc_code($orig_doc_code){
    $this->orig_doc_code = $orig_doc_code;
  }

  public function getActive_date(){
    return $this->active_date;
  }

  public function setActive_date($active_date){
    $this->active_date = $active_date;
  }

  public function getCap(){
    return $this->cap;
  }

  public function setCap($cap){
    $this->cap = $cap;
  }

  public function getCap_date(){
    return $this->cap_date;
  }

  public function setCap_date($cap_date){
    $this->cap_date = $cap_date;
  }

  public function getOrgn_resp(){
    return $this->orgn_resp;
  }

  public function setOrgn_resp($orgn_resp){
    $this->orgn_resp = $orgn_resp;
  }

  public function getFund(){
    return $this->fund;
  }

  public function setFund($fund){
    $this->fund = $fund;
  }

  public function getOrgn(){
    return $this->orgn;
  }

  public function setOrgn($orgn){
    $this->orgn = $orgn;
  }

  public function getLocn_resp(){
    return $this->locn_resp;
  }

  public function setLocn_resp($locn_resp){
    $this->locn_resp = $locn_resp;
  }

  public function getNet_bk_value(){
    return $this->net_bk_value;
  }

  public function setNet_bk_value($net_bk_value){
    $this->net_bk_value = $net_bk_value;
  }

  public function getAcct(){
    return $this->acct;
  }

  public function setAcct($acct){
    $this->acct = $acct;
  }

  public function getAcct_title(){
    return $this->acct_title;
  }

  public function setAcct_title($acct_title){
    $this->acct_title = $acct_title;
  }
 

}

