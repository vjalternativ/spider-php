<?php 
class Paginate {
	
	public $url='';
	public $index=false;
	public $noresult = 1;
	public $endto = 1;
	public $pagingnum=5;
	public $sql=false;
	public $array=true;
	public $arrayindex=false;
	public $db;
	public $module;
	public $action=false;
	public $process = array();
	public $processHook = array("instance"=>"","method"=>"","enumList"=>array());
	public $extrafields = array();
	private static $instance;
	static function getInstance() {
	    if(self::$instance==null) {
	        self::$instance = new Paginate();
	    }
	    return self::$instance;
	}
	
	function setProcessHook($instance,$method) {
	    
	    
	    $db = MysqliLib::getInstance();
	    $this->processHook['instance'] = $instance;
	    $this->processHook['method'] = $method;
	    
	    
	    $db->setProcessHook($instance,$method);
	}
	
	function process() {
		$url=$this->url;
		$index=$this->index;
		$noresult = $this->noresult;
		$endto = $this->endto;
		$pagingnum=$this->pagingnum;
		$sql=$this->sql;
		
		$array=$this->array;
		$arrayindex=$this->arrayindex;
		$db = $this->db;
		
		$counter  = 0;
		$startfrom = 1;
		$maxlimit = $noresult*$endto;
		$page =  1;
		$pageList = array();
		$start = 0;
		$next = 2;
		$prev = 1;
		$nexturl = $url.'2';
		$prevurl = "#";
		if($index) {
			$page = $index;
		}
		if(isset($page) && $page>0) {
			$start = ($page - 1)*$noresult;
			$next = $page + 1;
			$nexturl = $url.$next;
		}
		if(!$sql && (!$array || !is_array($array))) {
			die('parameter 6 (sql) or parameter 7 $array is not set');
		}
		
		if($sql) {
		$sql .= " LIMIT $start,$maxlimit";
		
		$qry = $db->query($sql);
		$totalresult = $start+$qry->num_rows;
		} else {
			$totalresult = count($array);
		}
		$totalpages =  ceil($totalresult/$noresult);
		
		if($page > 2) {
			$startfrom = $page-2;
			$endto = $page + 2;
		}
		
		if($pagingnum) {
		
		for($i=$startfrom;$i<=$totalpages;$i++) {
			$counter++;
		
			$pageList[] = $i;
		
			if($counter == $pagingnum || $counter==$endto) {
				break;
			}
		
		}
		
		}
		if(isset($page) && $page>0) {
		
		
			if($page*$noresult >= $totalresult) {
				$nexturl = "#";
			}
		
		
			if($page>1) {
				$prev = $page - 1;
				$prevurl = $url.$prev;
		
			}
		
		}
		
		
		
		$data = array();
		$counter=0;
		
		if($sql) {
		$sql = $this->sql." LIMIT $start,$maxlimit";
		$processList = $this->process;
		
		
		//$processList['name'] = array('a',"attr"=>array('href' => array('value'=>'index.php?module='))); 
		$data = $db->getrows($sql,'id',false,false,$processList);	
		
		
		} else  {
		    $rows = array_slice($array, $start,$maxlimit);
			foreach($rows as $row) {
			    
			    
			    
				$counter++;
				if($arrayindex && !isset($row[$arrayindex])) {
					die("index not found in array");
				}
				
				else if($arrayindex && isset($row[$arrayindex])) {
					$data[$row[$arrayindex]] = $row;
				}
				else {
					$data[] = $row;
				}
				if($counter==$noresult) {
					break;
				}
			}
			
			
		}
		
		$x =  array("data"=>$data,"prevurl"=>$prevurl,"nexturl"=>$nexturl,"pagelist"=>$pageList,"activepage"=>$this->index,"url"=>$this->url,"next" => $next,"prev"=>$prev,"resultperpage"=>$noresult);
		return $x;
	}
	
	function getPagingHtml($pageinfo,$ajaxMode=false) {
	       global $smarty,$vjconfig;
	       $smarty->assign('pageinfo',$pageinfo);
	       $smarty->assign('ajaxMode',$ajaxMode);
	       
	       
	       return $smarty->fetch($vjconfig['fwbasepath']."include/vjlib/libs/tpls/paginghtml.tpl");
	}
}
?>