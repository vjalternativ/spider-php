<?php
class ViewList  extends View {
	public $datatypeFields = array();
	public $metadata =array();
	function __construct() {
		global $vjlib;
		$datatypes = array();
		//$datatypes['varchar'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		//$datatypes['text'] = array('element'=>array('textarea',array('id'=>'name','placeholder'=>'name','name'=>'name','class'=>'form-control')));
	
		$this->datatypeFields = $datatypes;
	}
	function display() {
 		global $vjlib,$entity,$mod_string,$globalModuleList;
 		$bs = $vjlib->BootStrap;
 		$rows = $this->listview['pageinfo']['data'];
 		$rows = array_slice($rows, 0,$this->listview['pageinfo']['resultperpage'],true);
 		$tpl = $this->listview['tpl'];
	   
 		
 		$pagingHtml = $vjlib->Paginate->getPagingHtml($this->listview['pageinfo']);
 		
 		
 		
 		$headers = array();
 		
 		foreach($this->listview['metadata'] as $key => $header) {
 		    
 		    if(isset($header['rmodule'])) {
 		      $key = $key."_name";  
 		    }
 		    $headers[] = array('name'  => $key,'label'=>$header['label']);
 		}
 		
 		
 		$module = ucfirst($globalModuleList[$this->module]['label']);
 		$href = "index.php?module=".$this->module."&action=editview";
 		$href = processUrl($href);
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
 		parent::display();
 	
 }
}