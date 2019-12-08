<?php
class ViewDetail  extends View {

	public $datatypeFields = array();
	public $tpl = 'include/tpls/detailview.tpl';
	public $data = array();
	public $tableinfo = array();
	public $subpanels = array();
	public $additionalContent = '';
	function __construct() {
		
	
	    global $vjlib,$entity;
		$datatypes = array();
		$datatypes['varchar'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['int'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['float'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['text'] = array('element'=>array('textarea',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','class'=>'form-control')));
		$datatypes['datetime'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['relate'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['enum'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['dependent_relate'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['nondb'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['file'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		$datatypes['checkbox'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'checkbox','value'=>'','class'=>'form-control')));
		$datatypes['date'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','disabled'=>'disabled','placeholder'=>'name','name'=>'name','type'=>'text','value'=>'','class'=>'form-control')));
		
		$this->datatypeFields = $datatypes;
		
        $entity->load_relationships();
       
        $this->subpanels = $entity->relationships;
      
        
	}

	function display() {
	    
	    global $globalModuleList;
	    /*  echo "<pre>";
	    print_r($globalModuleList);
	    die; */
	    //$id = create_guid();
	    //die($id); 
	    global $vjlib,$entity,$vjconfig;
		$bs = $vjlib->BootStrap;
		$headers = array("id","name","date_entered");
		$module = ucfirst($this->module);
		$href = "index.php?module=tableinfo&action=editview";
		$defaultLayout = $this->getDefaultLayout();
		$href = processUrl($href);
		$this->params += array('module'=>$module,'panel'=>$defaultLayout);
		
		parent::display();
		
	}


	function afterDisplay() {
		global $db,$entity,$vjlib,$smarty;
		$bs = $vjlib->BootStrap;
		
	
	
		foreach($this->subpanels  as $key=>$subpanels) {
		  
    		$pageinfo = $entity->get_relationships($subpanels['name'],false,$subpanels);
    		$rows = $pageinfo['data'];
    		
    		$rows = array_slice($rows, 0,$pageinfo['resultperpage'],true);
    		$params = array('headers' => array('name','date_entered'));
    		
    		$headers = array();
    		$headers['name']['name'] = "name";
    		$headers['name']['label'] = "Name";
    		$headers['date_entered']['name'] = "date_entered";
    		$headers['date_entered']['label'] = "Created";
    		
            $smarty->assign("headers",$headers);
 //           $smarty->assign("headers",$entity->listview['metadata']);
            $smarty->assign("rows",$rows);
            
            $extraPostFields  = array();
            $extraPostFields['id']['data']['html'] = '<button type="button" onclick="removeRelationship(\''.$entity->record.'\',\''.$subpanels['name'].'\',\'REPLACE_KEY\')" class="btn btn-danger">X</button>';
            $extraPostFields['id']['header']['html'] = '';
            $smarty->assign("extraPostFields",$extraPostFields);
            $table =  $smarty->fetch("include/vjlib/libs/tpls/table.tpl");
            
            $pageinfo['url'] = "./index.php?module=".$this->module."&action=getAjaxSubPanelData";
            
            $pageinfo['container_id'] =  $subpanels['id'];
            
            $pageinfo['record'] =  $entity->record;
            $pagingHtml = $vjlib->Paginate->getPagingHtml($pageinfo,true);
            
            $table .= $pagingHtml;
            
            //$table = $bs->generateTable(array_values($pageinfo['data']),$params);
    		 
    		$heading = '<span class="heading">'.$subpanels['secondarytable_name'].'</span>';
    		$heading .= '<input type="hidden" id="subpanel_ptable-'.$subpanels['id'].'"   value="'.$this->module.'" />';
    		$heading .= '<input type="hidden" id="subpanel_rtable-'.$subpanels['id'].'"   value="'.$subpanels['rtable'].'" />';
    		$heading .= '<input type="hidden" id="subpanel_relname-'.$subpanels['id'].'"   value="'.$subpanels['name'].'" />';
    		$heading .= '<a href="index.php?module='.$subpanels['rtable'].'&action=editview&parent_module='.$this->module.'&parent_record='.$this->record.'&rel='.$subpanels['name'].'"><button class="btn btn-primary pull-right">Add New</button></a>';
    		$heading .= '<button class="btn btn-success pull-right margin-right-10" onclick="selectSubpanelItems(\''.$subpanels['id'].'\')">Select</button>';
    		$heading .= '<div class="clearfix"></div>';
    		
    		$panel = $bs->generatePanel($heading,$table,"","info","subpanel_".$subpanels['id']);	
    		echo $panel;
    		
		
		}
		
		
	   $filterhtml = $smarty->fetch("include/tpls/subpanelfilter.tpl");	
		
		$modal = new Modal();
		$modal->id = "subpanel";
		$modal->heading = getLabel("LBL_RELATED_RECORDS");
		$modal->afterheader = $filterhtml;
		$modal->extrafooter = '<button type="submit" class="btn btn-primary">Select</button>';
		$modal->formaction = 'index.php?module=tableinfo&action=addSubpanelRelationship&record='.$_GET['record'].'&primaryModule='.$_GET['module'];
		$smarty->assign("modal",$modal);
		echo $modal->html();
	}

	function getDefaultLayout() {
	    global $db,$entity,$vjlib,$globalModuleList;
		$bs = $vjlib->BootStrap;
		
		$tableinfo =$entity->getwhere("tableinfo","name ='".$this->module."'");
		
		
		$vardef = json_decode(base64_decode($tableinfo['description']),1);
		
	$metadata = $vardef['metadata'];

       
		$html = $this->parseDetailViewDef($metadata['detailview']);
		$editButton= getelement("a","EDIT",array("href"=>"index.php?module=".$this->module."&action=editview&record=".$this->record,"class"=>"btn btn-primary pull-right"));
		$editButton .= $this->additionalContent;
		$editButton .= getelement("div","",array("class"=>"clearfix"));
        $panelheading = $bs->getelement('div',ucfirst($globalModuleList[$this->module]['label']).' | Detail View'.$editButton,array('class'=>array('value'=>'panel-heading')));
		$panelbody = $bs->getelement('div',$html,array('class'=>array('value'=>'panel-body')));
		$panelfooter = $bs->getelement('div','',array('class'=>array('value'=>'panel-footer')));
		$panel = $bs->getelement('div',$panelheading.$panelbody,array('class'=>array('value'=>'panel panel-info')));


		return $panel;


	}







	function getattr($type,$name,$value='') {
		
		$attr = $this->datatypeFields[$type];
		if($type=="relate" || $type=="dependent_relate" || ($type=="nondb" && isset($this->data[$name.'_name']))) {
		    $name  = $name."_name";
		}
		//to do make data type associative

		$element = $attr['element'][0];

		$newattr = array();
		$newattr[] = $element;

		$atr = $attr['element'][1];
		foreach($atr as $key=>$at) {
			$atr[$key] = array('value'=>str_replace('name',$this->data[$name],$at));
		}
		
		$newattr[] = $atr;

		if(isset($attr['isdualtag'])) {
			$newattr[] = $attr['isdualtag'];
		}

		return $newattr;


	}

	function parseDetailViewDef($def) {
		global $vjlib,$mod_string;
		$bs = $vjlib->BootStrap;
		$formgroup = '';
		foreach($def as $item) {
			if($item['type']=='row') {
				if(isset($item['fields'])) {
					$col = "";
					foreach($item['fields'] as $fieldinfo) {
						$field = $fieldinfo['field'];
						$attr = $this->getattr($field['type'], $field['name']);
						$isdualtag = true;
						if(isset($attr[2])) {
							$isdualtag = false;
						}
						
						$label = ucfirst($field['name']);
						if(isset($field['label'])) {
						    $label =isset($mod_string[$field['label']]) ? $mod_string[$field['label']] : $field['label'];
						}
						$addon = getelement('span',$label,array("class"=>'input-group-addon'));
						
						
						$fhtml  = $bs->getelement($attr[0],'',$attr[1],$isdualtag);
						
						
						
						$fhtml = getelement("div",$attr[1]['name']['value'],array("class"=>"form-control"));
						if($field['type']=="file" && !empty($this->data[$field['name']])) {
						    $fhtml = '<a target="_blank" class="form-control"  href="index.php?module=media_files&action=download&id='.$this->data[$field['name']].'" >Attachment</a>';
						} else if($field['type']=="checkbox") {
						    
						    $checkAttr = array("type"=>"checkbox","value"=>1,"disabled"=>"disabled");
						    if($this->data[$field['name']]) {
						        $checkAttr['checked'] = "checked" ;
						    }
						    $fhtml = getelement("input",'',$checkAttr,false);
			                
						    $fhtml = getelement("div",$fhtml,array("class"=>"form-control"));
						}
						
						
						$elementhtml =$addon.$fhtml;
						
						$inputgroup =  $bs->getelement("div",$elementhtml,array("class"=>"input-group"));
						
						
						
						
						
						
						$colattr = array("class"=>array("value"=>"col-md-".$fieldinfo['gridsize']));
						$col .= $bs->getelement('div',$inputgroup,$colattr);
					}
				}
				$row = $bs->getelement("div",$col,array('class'=>array('value'=>'row')));
				$formgroup .= $bs->getelement("div",$row,array('class'=>array('value'=>'form-group')));
}



			// TO DO FOR PANEL
				
				
		}

		return $formgroup;

	}
}
?>