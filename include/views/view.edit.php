<?php
class ViewEdit  extends View {
	
	public $datatypeFields = array();
	public $tpl = 'include/tpls/editview.tpl';
	public $def;
	public $additionalContent;
	
	function __construct() {
		$datatypes = array();
		$datatypes['varchar'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'text','value'=>'name','class'=>'form-control')));
		$datatypes['int'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'text','value'=>'name','class'=>'form-control')));
		$datatypes['float'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'text','value'=>'name','class'=>'form-control')));
		$datatypes['text'] = array('element'=>array('textarea',array('id'=>'name','name'=>'name','class'=>'form-control')));
		$datatypes['relate'] = array('element'=>array('input',array('id'=>'name','name'=>'name','class'=>'form-control')));
		$datatypes['enum'] = array( 'element'=>array('select',array('id'=>'name','name'=>'name','class'=>'form-control')));
		$datatypes['dependent_relate'] = array('element'=>array('input',array('id'=>'name','name'=>'name','class'=>'form-control')));
		$datatypes['nondb'] = array('element'=>array('input',array('id'=>'name','name'=>'name','class'=>'form-control')));
		$datatypes['file'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'file','class'=>'form-control')));
		$datatypes['checkbox'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'checkbox','value'=>'name','class'=>'')));
		$datatypes['date'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'text','value'=>'name','class'=>'form-control  datepicker')));
		$datatypes['md5'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'text','value'=>'name','class'=>'form-control')));
		$datatypes['datetime'] = array('isdualtag'=>false,'element'=>array('input',array('id'=>'name','name'=>'name','type'=>'text','value'=>'name','class'=>'form-control  datetimepicker')));
		
		$this->datatypeFields = $datatypes;
	}
	
	function preDisplay() {
	    
	    global $entity,$globalModuleList;
	    $entity = new Entity();
	    
	    $tableinfo = $entity->getwhere('tableinfo',"name='".$this->module."'");
	    $vardef = json_decode(base64_decode($tableinfo['description']),1);
	    
	    
	    
	    $languages= $entity->getRelatedData("tableinfo_language_m_m", "tableinfo_id", $tableinfo['id']);
	    
	    if($languages) {
	        foreach($languages as $lang) {
	            $suffix = $lang['name'];
	            $langTable = $this->module.'_'.$suffix;
	            if(isset($globalModuleList[$langTable])) {
	                $vardef = $this->processDefForLang($suffix,$vardef,"editview");
	            }
	        }
	    }
	    $this->def = $vardef;
	    if(!$this->data) {
	        $this->data['id'] = "";
	        $this->data['name'] = "";
	    }
	    
	    
	}
	
	function display() {
		$module = ucfirst($this->module);
		$href = "index.php?module=tableinfo&action=editview";
		$defaultLayout  = $this->getDefaultLayout();
		$href = processUrl($href);
		$data = $this->data;
		$this->params = array('module'=>$module,'panel'=>$defaultLayout,'data'=>$data);
		parent::display();

	}
	
	function getDefaultLayout() {
		global $vjlib,$globalModuleList;
		$bs = $vjlib->BootStrap;
		
		//$tableinfo = $entity->getwhere('tableinfo',"name='".$this->module."'");
		//$vardef = json_decode(base64_decode($tableinfo['description']),1);
		
		
		
		//$this->def = $vardef;
		
		
		$vardef =$this->def;
		
		$metadata = $vardef['metadata'];
		
		$html = $this->parseEditViewDef($metadata['editview']);
		$html .= $bs->getelement('input','',array('name'=>'id','id'=>'id','value'=>$this->data['id'],'type'=>'hidden'));
		$save =  $bs->getelement("button","Save",array("type"=>array("value"=>"submit"),"class"=>array("value"=>"btn btn-primary pull-right")));
		$save .= '<div class="clearfix"></div>';
		
		$panelheading = $bs->getelement('div',ucfirst($globalModuleList[$this->module]['label']).' | Edit View'.$this->additionalContent,array('class'=>array('value'=>'panel-heading')));
		$panelbody = $bs->getelement('div',$html,array('class'=>array('value'=>'panel-body')));
		$panelfooter = $bs->getelement('div',$save,array('class'=>array('value'=>'panel-footer')));
		$panel = $bs->getelement('div',$panelheading.$panelbody.$panelfooter,array('class'=>array('value'=>'panel panel-info')));
		if(isset($_REQUEST['parent_module'])) {
		    $panel .= '<input type="hidden" name="parent_module" value="'.$_REQUEST['parent_module'].'" />';
		}
		if(isset($_REQUEST['parent_record'])) {
		    $panel .= '<input type="hidden" name="parent_record" value="'.$_REQUEST['parent_record'].'" />';
		}
		if(isset($_REQUEST['rel'])) {
		    $panel .= '<input type="hidden" name="rel" value="'.$_REQUEST['rel'].'" />';
		}
		
		$url = "index.php?module=".$this->module."&action=save";
		$form = $bs->getelement('form',$panel,array("name"=>array("value"=>"editview"),"method"=>array("value"=>"post"),"action"=>array("value"=>$url),"enctype"=>array("value"=>"multipart/form-data")));
		return $form;
	}
	
	
	
	
	
	
	
	function getattr($type,$name,$value='') {
		$attr = $this->datatypeFields[$type];
		//to do make data type associative
		$element = $attr['element'][0];
		$newattr = array();
		$newattr[] = $element;
		$atr = $attr['element'][1];
		foreach($atr as $key=>$at) {
		if($key=='value') {
		    $atr[$key] = "";
		    
		    if(isset($this->data[$name])) {
		        $atr[$key] = $this->data[$name];
		        
		    } 
		} else if($at=='name'){
			$atr[$key] = $name;
		}
		}
		$newattr[] = $atr;
		if(isset($attr['isdualtag'])) {
			$newattr[] = $attr['isdualtag'];
		}
		return $newattr;
		
	}
	
	function parseEditViewDef($def) {
		global $vjlib,$app_list_strings,$mod_string,$entity;
		$bs = $vjlib->BootStrap;
		$formgroup = '';
		foreach($def as $item) {
			if($item['type']=='row') {
				if(isset($item['fields'])) {
					$col = "";
					foreach($item['fields'] as $fieldinfo) {
					    $fieldarray = $this->def['fields'][$fieldinfo['field']['name']];
					    
					    
					    
						$val = "";
						$attr = $this->getattr($fieldarray['type'], $fieldarray['name']);
						if(isset($fieldarray['extraclass'])) {
						    $attr[1]['class'] .= $fieldarray['extraclass'];
						}
						$isdualtag = true;
						
						if(!isset($this->data[$fieldarray['name']])) {
						    $this->data[$fieldarray['name']]= "";
						}
						$val = $this->data[$fieldarray['name']];
						
						if(isset($attr[2])) {
							$isdualtag = false;
						} 
						
						if($fieldarray['type']=="checkbox") {
						    $attr[1]['value']=1;
						} else if($fieldarray['type']=="md5") {
						    $attr[1]['value']="";
						}
						
						$field = getelement($attr[0],$val,$attr[1],$isdualtag);
						$label = ucfirst($fieldarray['name']);
						if(isset($fieldarray['label'])) {
						    $label =isset($mod_string[$fieldarray['label']]) ? $mod_string[$fieldarray['label']] : $fieldarray['label'];
						}
						$addon = getelement('span',$label,array("class"=>'input-group-addon'));
						
						if($fieldarray['type']=='relate') {
						    if(!isset($this->data[$fieldarray['name']."_name"])) {
						        $this->data[$fieldarray['name']."_name"] = "";
						    }
                            $field = $bs->getelement('input','',array("class"=>"form-control","id"=>$fieldarray['name'].'_name', "value"=>$this->data[$fieldarray['name']."_name"], "name"=>$fieldarray['name'].'_name',"autocomplete"=>"off","onkeyup"=>"relatemodule('".$fieldarray['rmodule']."',this.value,'".$fieldarray['name']."')"),false);
                            $field .= $bs->getelement('input','',array("class"=>"form-control","name"=>$fieldarray['name'],"id"=>$fieldarray['name'],"type"=>"hidden","value"=>$this->data[$fieldarray['name']]),false);
							
						}
						else if($fieldarray['type']=='dependent_relate') {
						    if(!isset($this->data[$fieldarray['name']."_name"])) {
						        $this->data[$fieldarray['name']."_name"] = "";
						    }
						    $field = $bs->getelement('input','',array("class"=>"form-control","value"=>$this->data[$fieldarray['name']."_name"],"id"=>$fieldarray['name'].'_name',  "name"=>$fieldarray['name'].'_name',"autocomplete"=>"off","onkeyup"=>"dependentRelatemodule('".$fieldarray['relate_relationship']."','".$fieldarray['dependent_relate_field']."','".$fieldarray['rmodule']."',this.value,'".$fieldarray['name']."')"),false);
						    $field .= $bs->getelement('input','',array("class"=>"form-control","name"=>$fieldarray['name'],"id"=>$fieldarray['name'],"type"=>"hidden","value"=>$this->data[$fieldarray['name']]),false);
						    
						}
						else if($fieldarray['type']=='nondb' && isset($fieldarray['rmodule'])) {
						   
						    
						    if(!isset($this->data[$fieldarray['name']."_name"])) {
						        $this->data[$fieldarray['name'].'_name'] ="";
						    }
						    if($fieldarray['type']=="nondb" && isset($_REQUEST['parent_module']) && $_REQUEST['parent_module']==$fieldarray['rmodule']) {
						        $this->data[$fieldarray['name']] = $_REQUEST['parent_record'];
						        $pmodule = $_REQUEST['parent_module'];
						        $nondbData = $entity->get($pmodule,$this->data[$fieldarray['name']]);
						        if($nondbData) {
						            $this->data[$fieldarray['name']] = $nondbData['id'];
						            $this->data[$fieldarray['name'].'_name'] = $nondbData['name'];
						        }
						        
						    }
						    
						    
						    
						    $field = $bs->getelement('input','',array("class"=>"form-control","id"=>$fieldarray['name'].'_name', "value"=>$this->data[$fieldarray['name'].'_name'], "name"=>$fieldarray['name'].'_name',"autocomplete"=>"off","onkeyup"=>"relatemodule('".$fieldarray['rmodule']."',this.value,'".$fieldarray['name']."')"),false);
						    $field .= $bs->getelement('input','',array("class"=>"form-control","name"=>$fieldarray['name'],"id"=>$fieldarray['name'],"type"=>"hidden","value"=>$this->data[$fieldarray['name']]),false);
						    
						}
						else if($fieldarray['type']=='enum') {
						
						
						if(!isset($fieldarray['options']) || !isset($app_list_strings[$fieldarray['options']])) {
						    $fieldarray['options'] = false;
						   // die("option is not defined for field".$fieldarray['name']);
						}
						
						$optionhtml = "";
						if(isset($app_list_strings[$fieldarray['options']])) {
    						$options = $app_list_strings[$fieldarray['options']];
    						foreach($options as $okey=>$oval) {
    						    $opattr = array("value"=>$okey);
    						    if($val==$okey) {
    						        $opattr['selected'] = "selected";
    						    }
    							$optionhtml .= getelement('option',$oval,$opattr);
    						}
						}
						$field = getelement($attr[0],$optionhtml,$attr[1],$isdualtag);
						
						
						} else if($fieldarray['type']=="checkbox") {
						    if($val=='1') {
						      $attr[1]['checked'] = "checked";
						      $field = getelement($attr[0],"",$attr[1],$isdualtag);
						    }
						    $field = getelement("div",$field,array("class"=>"form-control"));
						}
						
						$elementhtml = $addon.$field;
						
						
						
						if($fieldarray['type']=='relate' || $fieldarray['type']=='dependent_relate' || ($fieldarray['type']=="nondb" && isset($fieldarray['rmodule']))) {
						$addon = $bs->getelement('span','<i class="fa fa-search"></i>',array("class"=>'input-group-addon'));
						$elementhtml .= $addon;
						
						//$elementhtml .= $bs->getelement('button','Select',array("class"=>'btn btn-primary'));
						}
						$inputgroup =  $bs->getelement("div",$elementhtml,array("class"=>"input-group"));
						
						
						if($fieldarray['type']=="file" && !empty($this->data[$fieldarray['name']])) {
						    $inputgroup .="<br />";
						    $inputgroup .= '<a target="_blank"  href="index.php?module=media_files&action=download&id='.$this->data[$fieldarray['name']].'" >Attachment</a>';
						}
						
						
						$colattr = array("class"=>array("value"=>"col-md-".$fieldinfo['gridsize']));
						$col .= $bs->getelement('div',$inputgroup,$colattr);
					}
				}
			
			$row = $bs->getelement("div",$col,array('class'=>array('value'=>'row')));
					
			$formgroup .= $bs->getelement("div",$row,array('class'=>array('value'=>'form-group')));
				
			
			
			} else if($item['type']=="hr") {
			    $formgroup .= $bs->getelement("div",$item['label'],array("class"=>"hr_additional"));
			    $formgroup .= $bs->getelement("hr",false,false,false);
			    
			} else if($item['type']=="custom_html") {
			    $content = $bs->getelement("div",$item['html'],array("class"=>"col-md-12"));
			    $formgroup .= $bs->getelement("div",$content,array("class"=>"row"));
			}
		
		
		
		// TO DO FOR PANEL	
			
			
		}
		
		return $formgroup;
		
	}
	
	function processDefForLang($suffix,$vardef,$deftype="editview") {
	    global $globalModuleList,$entity;
	    $langTable = $this->module."_".$suffix;
	    
	    
	    if(isset($globalModuleList[$langTable]) && strlen($this->data['id'])==36) {
	        
	        
	        $langData  = $entity->get($langTable,$this->data['id']);
	        if($langData) {
	            $this->data['name_'.$suffix] = $langData['name'];
	            $jsonData = json_decode($langData['description'],1);
	            if($jsonData) {
    	            foreach($jsonData as $key=>$val) {
    	                $this->data[$key."_".$suffix] = $val;
    	            }
	            }
    	        
	        }
	        
	    }
	    
	    $newDef = $vardef['metadata'][$deftype];
	    
	    foreach($vardef['metadata'][$deftype] as $row) {
	        
	        $addTempRow = false;
	        $temprow = $row;
	        
	        if($row['type']=="row" && isset($row['fields'])) {
	            
	            foreach($row['fields'] as $colkey => $col) {
	                if(isset($col['field']) && ($col['field']['type']=="varchar" || $col['field']['type']=="text")) {
	                    $addTempRow = true;
	                    
	                    if(isset($vardef['fields'][$col['field']['name']])) {
	                        $tempCol = $vardef['fields'][$col['field']['name']];
	                        $tempCol['name'] .= "_".$suffix;
	                        $tempCol['extraclass'] = " language_".$suffix;
	                        $tempCol['label'] = $tempCol['name'];
	                        $vardef['fields'][$tempCol['name']] = $tempCol;
	                        $temprow['fields'][$colkey]['field'] = $tempCol;
	                        
	                    }
	                    
	                    
	                
	                } else {
	                    unset($temprow['fields'][$colkey]);
	                }
	                
	            }
	        }
	        
	        if($addTempRow) {
	            $newDef[] = $temprow;
	        }
	    }
	    
	    $vardef['metadata'][$deftype] = $newDef;
	    return $vardef;
	}
}
?>