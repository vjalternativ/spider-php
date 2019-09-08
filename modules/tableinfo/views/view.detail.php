<?php 

class tableinfoViewDetail  extends ViewDetail {

function getalltables() {

global $db;
$sql ="select * from tableinfo where deleted=0 and tabletype='basic'";
return $db->getrows($sql,'id');
}

	function display() {
		parent::display();
		
		global $db,$entity,$vjlib,$vjconfig,$app_list_strings,$globalEntityList,$globalRelationshipList;
		$bs = $vjlib->BootStrap;
		
		
		$panelheading = $bs->getelement('div', 'Manage',array('class'=>array('value'=>'panel-heading')));
		$list = array(
				'fields-tab'=>array('name'=>"Fields",'attr' => array("class"=>"active","id"=>"fields")),
				'relationships-tab'=>array('name'=>"Relationships",'attr' => array("id"=>"relationships")),
				'listviewlayout-tab'=>array('name'=>"List View Layout",'attr' => array("id"=>"listviewlayout")),
				'editviewlayout-tab'=>array('name'=>"Edit View Layout",'attr' => array("id"=>"editviewlayout")),
				'detailviewlayout-tab'=>array('name'=>"Detail View Layout",'attr' => array("id"=>"detailviewlayout")),
				'listviewfilterlayout-tab'=>array('name'=>"List View Filter Layout",'attr' => array("id"=>"listviewfilterlayout")),
			
		);
		
		
		
		$tableid = $this->data['id'];
		$sql = "select r.*,t.name as secondarytablename,'".$this->data['name']."' as primarytablename from relationships r
		left join tableinfo t on r.secondarytable=t.id		
		 where r.primarytable ='".$tableid."' and r.deleted=0";
		$relationships = $db->getrows($sql);
		$tableinfo =json_decode(base64_decode($this->data['description']),1);
		$metadata = $tableinfo['metadata'];
		$fields = $tableinfo;
		unset($fields['metadata']);
		$tbheader = array('name','type','len','notnull','action');
		$params = array();
		$params['headers'] = $tbheader;
		$params['tbid']  = "field_table";
		$counter = 0;
		$fieldParamData = $tableinfo['fields'];
		foreach($fieldParamData as $key =>$field) {
		    
		    $tableinfo['fields'][$key]['action'] = "";
		    if(in_array($key,$entity->defaultFields)) {
		        $counter++;
		      continue;     
		    }
		    
		    $button = $bs->getelement('button','x',array("type"=>"button",'class'=>'btn btn-danger',"onclick"=>"delelement('".$params['tbid']."-".$counter."')"));
		    $fieldelement = $bs->getelement('input','x',array('type'=>'hidden','name'=>'field[]','value'=>$key),false);
		    $fieldParamData[$key]['action'] = $button.$fieldelement;
		    $counter++;
		}
		
		
		
		$fieldstable = '<form method="post" action="index.php?module=tableinfo&action=deleteFields">';
		$fieldstable .= $bs->generateTable($fieldParamData,$params);
	    $fieldstable .= '<br /> <input type="hidden" name="module_id" value="'.$this->record.'" /><button type="submit" class="btn btn-primary pull-right">Save</button>';
	    $fieldstable .='<div class="clearfix"></div></form>';	
		
	    
	    
	    $tbheader = array('name','primarytablename','secondarytablename','rtype','action');
		$params['headers'] = $tbheader;
		$params['tbid']  = "relationship_table";
		
		$counter = 0;
		foreach($relationships as $key =>$field) {
		    
		    $fieldParamData[$key]['action'] = "";
		    
		    
		    $button = $bs->getelement('button','x',array("type"=>"button",'class'=>'btn btn-danger',"onclick"=>"delelement('".$params['tbid']."-".$counter."')"));
		    $fieldelement = $bs->getelement('input','x',array('type'=>'hidden','name'=>'relationship_ids[]','value'=>$field['id']),false);
		    $relationships[$key]['action'] = $button.$fieldelement;
		    $counter++;
		}
		
		
		$relationshiptable = '<form method="post" action="index.php?module=tableinfo&action=deleteRelationship">';
		$relationshiptable .= $bs->generateTable($relationships,$params);
		$relationshiptable .= '<br /> <input type="hidden" name="module_id" value="'.$this->record.'" /><button type="submit" class="btn btn-primary pull-right">Save</button>';
		$relationshiptable .='<div class="clearfix"></div></form>';
		
		
		
		$tabs = array();
		
		$uli = array();
		$tabcontents = array();
		$counter =0;
		foreach($list as $key=>$val) {
			$class ="";
			if($counter==0) {
				$class ="active";
			}
			$counter++;
			$uli[$key]['li']['attr'] = array("class"=>$class);
			$anchor = array();
			$anchor['a']['attr'] = array("href"=> '#'.$key,"data-toggle"=>"tab");
			$anchor['a']['content'] = $val['name'];
			$uli[$key]['li']['content'] = $anchor;
			$tab = array();
			$tabs[] = array("div",$tabs,array());
		}
		
		$span = array();
		$span['span']['attr'] = array("class"=>'h3');
		$span['span']['content'] = "Manage";
		
		$panelheading = array();
		$panelheading['div']['attr'] = array("class"=>'panel-heading');
		$panelheading['div']['content'] = $span; 
		
		$ul = array();
		$ul['elem'] = 'ul';
		$ul['attr'] =  array("class"=>"nav nav-tabs");
		$ul['contents'] = $uli;
		
		$addnewfield = $bs->getelement("button","New Field",array("class"=>'btn btn-primary margin-top-10',"data-toggle"=>"modal", "data-target"=>"#newfieldmodal"));
		$fieldstabcontent = $bs->getelement('div',$addnewfield.$fieldstable,array("id"=>'fields-tab',"class"=>"tab-pane fade in active"));
		$addnewrelationship = $bs->getelement("button","New Relationship",array("class"=>'btn btn-primary margin-top-10',"data-toggle"=>"modal", "data-target"=>"#newrelationshipmodal"));
		$relationshiptabcontent = $bs->getelement('div',$addnewrelationship.$relationshiptable,array("id"=>'relationships-tab',"class"=>"tab-pane fade"));
		
		$smarty = new Smarty();
		
		$listviewfields = $tableinfo['metadata']['listview'];
		
		$listviewfieldarray = array_keys($listviewfields);
		
		
		
		
		$params = array();
		$params['headers']=array("field","colorder",'action');
		$params['tbid'] = "listviewlayouttable";
		$rows = array();
		$counter=0;
		foreach($listviewfieldarray as $key =>$field) {
			$button = $bs->getelement('button','x',array('class'=>'btn btn-danger',"onclick"=>"delelement('".$params['tbid']."-".$counter."')"));
			$colorder = $bs->getelement('input','x',array('type'=>'hidden','name'=>'colorder[]','value'=>''),false);
			$fieldelement = $bs->getelement('input','x',array('type'=>'hidden','name'=>'field[]','value'=>$field),false);
			
			$rows[] = array("field"=>$field,"colorder"=>$colorder.$fieldelement,"action"=>$button);
			$counter++;
		}
		$listviewLayoutTable = $bs->generateTable($rows,$params);
		
		$sql = "select * from relationships where secondarytable = '".$this->record."' and deleted=0 and rtype='1_M'";
		$rlist  = $db->fetchRows($sql);
		
		foreach($rlist as $r) {
		    $tableinfo['fields'][$r['name']]['name'] =  $r['name'];
		    $tableinfo['fields'][$r['name']]['type'] =  'nondb';
		    $tableinfo['fields'][$r['name']]['rmodule'] =  $globalEntityList[$r['primarytable']]['name'];
		    $tableinfo['fields'][$r['name']]['label'] =  $r['primarytable_name'];
		}
		
		
		$smarty->assign("fields",$tableinfo['fields']);
	
		
		
		$smarty->assign("table",$listviewLayoutTable);
		$smarty->assign("tbid",$params['tbid']);
		$smarty->assign("view",'listview');
		$smarty->assign("record",$this->record);
				
		$listviewhtml = $smarty->fetch($vjconfig['basepath'].'modules/tableinfo/tpls/listview.tpl');
		$listviewtabcontent = $bs->getelement('div',$listviewhtml,array("id"=>'listviewlayout-tab',"class"=>"tab-pane fade"));
		
		
		$listviewfields = array();
		if(isset($tableinfo['metadata']['searchview'])) {
			$listviewfields = $tableinfo['metadata']['searchview'];
		}
		$listviewfieldarray = array_keys($listviewfields);
		$params = array();
		$params['headers']=array("field","colorder",'action');
		$params['tbid'] = "listviewsearchlayouttable";
		$rows = array();
		$counter=0;
		foreach($listviewfieldarray as $field) {
			$button = $bs->getelement('button','x',array('class'=>'btn btn-danger',"onclick"=>"delelement('".$params['tbid']."-".$counter."')"));
			$colorder = $bs->getelement('input','x',array('type'=>'hidden','name'=>'colorder[]','value'=>''),false);
			$fieldelement = $bs->getelement('input','x',array('type'=>'hidden','name'=>'field[]','value'=>$field),false);
			
			$rows[] = array("field"=>$field,"colorder"=>$colorder.$fieldelement,"action"=>$button);
			$counter++;
		}
		$listviewLayoutTable = $bs->generateTable($rows,$params);
		
		
		
		
		
		$smarty->assign("table",$listviewLayoutTable);
		$smarty->assign("view",'searchview');
		$smarty->assign("tbid",$params['tbid']);
		$listviewfilterhtml = $smarty->fetch($vjconfig['basepath'].'modules/tableinfo/tpls/listview.tpl');
		$listviewfiltertabcontent = $bs->getelement('div',$listviewfilterhtml,array("id"=>'listviewfilterlayout-tab',"class"=>"tab-pane fade"));
		
   
		$smarty->assign('viewtype','editview');
		$smarty->assign("metadata",$tableinfo['metadata']['editview']);
		$smarty->assign("layout_param_list",$app_list_strings["layout_param_list"]);
		$editviewhtml = $smarty->fetch($vjconfig['basepath'].'modules/tableinfo/tpls/editview.tpl');
		$editviewtabcontent = $bs->getelement('div',$editviewhtml,array("id"=>'editviewlayout-tab',"class"=>"tab-pane fade"));
		
		$smarty->assign('viewtype','detailview');
		$smarty->assign("metadata",$tableinfo['metadata']['detailview']);
		$smarty->assign("layout_param_list",$app_list_strings["layout_param_list"]);
		$detailviewhtml = $smarty->fetch($vjconfig['basepath'].'modules/tableinfo/tpls/editview.tpl');
		$detailviewtabcontent = $bs->getelement('div',$detailviewhtml,array("id"=>'detailviewlayout-tab',"class"=>"tab-pane fade"));
		
			
		$tabcontent =  array();
		$tabcontent['div']['attr'] = array("class"=>'tab-content');
		
		$tabcontent['div']['contents'][] = $fieldstabcontent;
		$tabcontent['div']['contents'][] = $relationshiptabcontent;
		$tabcontent['div']['contents'][] = $listviewtabcontent;
		$tabcontent['div']['contents'][] = $editviewtabcontent;
		$tabcontent['div']['contents'][] = $detailviewtabcontent;
		$tabcontent['div']['contents'][] = $listviewfiltertabcontent;
		
		
		
		
		$panelbody = array();
		$panelbody['div']['attr'] = array("class"=>'panel-body');
		$panelbody['div']['contents'][] = $ul; 
		$panelbody['div']['contents'][] = $tabcontent; 
		
		
		
		
		
		$panel = array();
		$panel['elem'] ='div';
		$panel['attr'] = array("class"=>'panel panel-info');
		$panel['contents'][] = $panelheading;
		$panel['contents'][] = $panelbody;
		
		
		
		$panelfooter = $bs->getelement('div','',array('class'=>array('value'=>'panel-footer')));
		
		
		
		echo $bs->processhtml($panel);
		
		$smarty = new Smarty();
		$tables = $this->getalltables();
		
		$smarty->assign("record",$this->data['id']);
		$smarty->assign("primarytable",$this->data['name']);
		$smarty->assign("tables",$tables);
		$smarty->assign("dropdowns",$app_list_strings);
		$smarty->assign("global_relationship_list",$globalRelationshipList);
		$smarty->assign("fields",$tableinfo['fields']);
		
		$url = "index.php?module=tableinfo&action=dropdowneditor";
		$url = processurl($url);
		$smarty->assign("dropdownurl",$url);
		$basepath = $vjconfig['basepath'];
		
		$path = $basepath."modules/tableinfo/tpls/layoutmanager.tpl";
		$html = $smarty->fetch($path);
		$script = getelement('script','',array("src"=>'modules/tableinfo/assets/layoutmanager.js'));
		echo $html.$script;
		
	
	}
	
	
}
?>