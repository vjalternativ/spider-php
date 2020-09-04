<?php
class ViewList  extends BackendResourceView {
	public $datatypeFields = array();
	public $metadata =array();
	function __construct() {
	   $datatypes = array();

		$this->datatypeFields = $datatypes;

		    $vjconfig = lib_config::getInstance()->getConfig();
		    $this->listview['tpl'] = $vjconfig['fwbasepath'].'include/tpls/listview.tpl';
		    $this->listview['tpls']['filter']['varchar'] = $vjconfig['fwbasepath'].'include/tpls/filters/varchar.tpl';

	}
	function display() {
 		$mod_string = lib_datawrapper::getInstance()->get("mod_string_list");
$globalModuleList = lib_datawrapper::getInstance()->get("module_list");

 		$bs = lib_bootstrap::getInstance();
 		$rows = $this->listview['pageinfo']['data'];
 		$rows = array_slice($rows, 0,$this->listview['pageinfo']['resultperpage'],true);
 		$tpl = isset($this->listview['tpl']) ? $this->listview['tpl'] : false;


 		$pagingHtml = lib_paginate::getInstance()->getPagingHtml($this->listview['pageinfo']);



 		$headers = array();

 		foreach($this->listview['metadata'] as $key => $header) {

 		    if(isset($header['rmodule'])) {
 		      $key = $key."_name";
 		    }

 		    $header['label'] = isset($header['label']) ? $header['label'] :$key;

 		    $headers[] = array('name'  => $key,'label'=>$header['label']);
 		}


 		$module = ucfirst($globalModuleList[$this->module]['label']);
 		$href = "index.php?module=".$this->module."&action=editview";
 		$href = lib_util::processUrl($href);
 		$addnew = $bs->getelement('a','Add New '.$module,array('href'=>array('value'=>$href),'class'=>array('value'=>'btn btn-primary pull-right')));

 		$extrafields = array();
 		$url ="index.php?module=".$this->module."&action=editview&record=RID";
 		$editbutton = $bs->getelement('a','Edit',array('href'=>$url ,'class'=>'btn btn-info'));
 		$url ="index.php?module=".$this->module."&action=detailview&record=RID";
 		$detailbutton = $bs->getelement('a','Detail',array('href'=>$url ,'class'=>'btn btn-primary'));
 		$deletebutton = $bs->getelement('button','X',array('class'=>'btn btn-danger','onclick'=>"deleteRecord('ROWID','".$this->module."','RID')"));

		$extrafields['action'] = $editbutton.' '.$detailbutton.' '.$deletebutton;

		$params = array();
		$params['tbid'] = $this->module.'-tb';
		$params['headers'] = $headers;
		$params['extra'] = $extrafields;
 		$params['class'] = "table-striped table-bordered";
		$table = $bs->generateTable($rows,$params);
		$filters = $this->listview['searchlayout'];


		$params = $this->params;
		$this->tpl = $tpl;
		$this->params = array('table'=>$table,'module'=>$module,'addnew'=>$addnew,'filters'=>$filters,'mod_string'=>$mod_string,'params'=>$params,"pagingHtml"=>$pagingHtml);
		if(isset($this->listview['tpls'])) {
		    $this->params['tpls'] = $this->listview['tpls'];
		}
 		parent::display();

 }
}