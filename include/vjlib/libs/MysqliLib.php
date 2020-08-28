<?php
class MysqliLib {
	
	public $con;
	public $processHook = array("instance"=>"","method"=>"","enumList"=>array());
	public $dimindexer  =array();
	private $processSeq = false;
	private $debug = false;
	private static $instance = null;
	static function getInstance() {
	    if(self::$instance==null) {
	        self::$instance = new MysqliLib();
	    }
	    return self::$instance;
	}
	
	function setProcessSequence($b) {
	    $this->processSeq = $b;
	}
	
	function setDebugMode($b) {
	    $this->debug= $b;
	}
	
	function setProcessHook($instance,$method) {
	    
	    $this->processHook['instance'] = $instance;
	    $this->processHook['method'] = $method;
	}
	
	function connect($host="locahost",$user="root",$password="",$database="framework") {
		
				$this->con = mysqli_connect($host,$user,$password,$database) or die("database connection failed");
				
				if (mysqli_connect_errno())
				{
				die(mysqli_connect_error());
				}
				$this->query("SET SESSION sql_mode=''");
				$this->query("SET SESSION wait_timeout = 600");
				$this->query("set SESSION innodb_lock_wait_timeout=200");
				$this->query("set SESSION net_read_timeout=600");
				$this->query("set SESSION net_write_timeout=600");
				//$this->query('SET GLOBAL connect_timeout=28800');
				$this->query('SET SESSION wait_timeout=28800');
				$this->query('SET SESSION interactive_timeout=28800');
				//$this->query("set SESSION  net_buffer_length=1000000");
			//	$this->query("set SESSION max_allowed_packet=1000000000");
				
	}
	
	function getfields($table=false) {
	    if(!$table) {
	        die("table name should be set for get fields");
	    }
	    $fields = array();
	    $sql = "SHOW COLUMNS FROM ".$table;
	    $fields = $this->fetchRows($sql,array("Field"),"Field");
	    return  $fields;
	    
	}
	
	function getfieldsold($table=false) {
		if(!$table) {
		die("table name should be set for get fields");
		}
		$fields = array();
		$sql = "select * from ".$table." limit 1";
		if ($result = $this->query($sql)) {
			while ($fieldinfo=mysqli_fetch_field($result)) {
				$fields[$fieldinfo->name] = $fieldinfo->name;
			}
			$result->free();
			
		}
		
		return  $fields;
		}
	
		function print_bt() {
		    
		    echo "<br />";
		    echo "<pre>";
		    debug_print_backtrace();
		    return "";
		}
	function query($sql,$return =false) {
			
	    if($return) {
	        $qry = mysqli_query($this->con,$sql);
	        return $qry;
	    }
		  $qry = mysqli_query($this->con,$sql) or die("Query Failed :".$sql."<br />".mysqli_error($this->con).$this->print_bt());
		  return $qry;	
	}
	
	function fetch($qry) {
		return mysqli_fetch_assoc($qry);
	}
	
	function getrow($sql) {
		//echo $sql."<br />";
		$qry = mysqli_query($this->con,$sql);
		if($qry) {
		    return mysqli_fetch_assoc($qry);
		} else {
		    echo "wrong query for get row ".$sql;
		    echo "<pre>";print_r(debug_print_backtrace());
		    die;
		}
		
	}
	
	
	function getrows($sql,$id=false,$value=false,$extrafields=false,$process=false,$debug=false) {
		//replace query with inbuilt mysqli functions
		$rows = array();
		$qry = $this->query($sql);
		while($row = $this->fetch($qry)) {
		    
		    if(isset($this->processHook['method']) && $this->processHook['method']) {
		        if(isset($this->processHook['instance']) && $this->processHook['instance']) {
		            $row  =	call_user_func(array($this->processHook['instance'],$this->processHook['method']),$row);
		        } else {
		            $row  =	call_user_func($this->processHook['method'],$row);
		        }
		    }
		    
			if($id) {
				$listIndex = $row[$id];
			}
			if($extrafields) {
				foreach($extrafields as $key=>$field) {
					if(isset($field['field'])) {
						$row[$key] = $row[$field['field']];
					} else  {
					$row[$key] = $field['value'];
					}
					if(isset($field['condition'])) {
						$list = $field['condition']['list'];
						
						if(isset($list[$row[$field['condition']['field']]])) {
							$row[$key] = $field['condition']['value'];
						} else {
							$row[$key] = $field['value'];
						}
					}
					
				}
			}
			
			if($process) {
				$processList = $row;
				foreach($process as $key=>$proc) {
					$rowval = $row[$key];
					$isdualtag = true;
					if(isset($proc['isdualtag'])) {
						$isdualtag =$proc['isdualtag'];
					}
					if($isdualtag==false) {
					$proc['attr']['value'] = $rowval;
					}
					if(isset($proc['attr']['data-relate-name'])) {
						$proc['attr']['data-relate-name'] = $row['name'];
					}
					if(isset($proc['value'])) {
					$strs = explode('_',$proc['value']);
					$rowval = $proc['value'];
					if($strs[0]=='key') {
					$rowval = $row[$strs[1]];
					} 
					
					}
					
					
					foreach($proc['attr'] as $pkey=>$tempattr) {
					    foreach($row as $col=>$val) {
					        $tempattr = str_replace("key_".$col,$val,$tempattr);
					    }
					    $proc['attr'][$pkey] = $tempattr;
					}
					
					$processList[$key]  = getelement($proc['tag'],$rowval,$proc['attr'],$isdualtag);
						
					
					
					
					
					
				}
				$row = $processList;
			}
			
			if($id && $value) {
				$rows[$listIndex] = $row[$value]; 
			} else if($id) {
				$rows[$listIndex] = $row;
			} else {
				$rows[] = $row;
			}
		}
		
		$this->resetHook();
		return $rows;
	}
	
	
	function processDimIndexer($row, $dim) {
	    $seqdim= array();
	    foreach($dim as $key=>$val) {
	        if(is_array($val)) {
	            $seqdim[] = $key;
	        } else {
	            $seqdim[] = $val;
	        }
	    }
	    $skey = "seq";
	    $sval = false;
	    $vval = "val_";
	    $ikey = "rseq";
	    foreach($seqdim as $index) {
	        $vval .= "_".$row[$index];
	        $skey .="_".$index;
	        $ikey .="_".$index;
	        if(isset($this->dimindexer['last_seq_indexes'][$skey])) {
	            if(!isset($this->dimindexer['vals'][$skey][$vval])) {
	                $this->dimindexer['last_seq_indexes'][$skey]++;
	                $this->dimindexer['vals'][$skey][$vval] =$this->dimindexer['last_seq_indexes'][$skey];
	            }
	            
	        } else {
	            $this->dimindexer['last_seq_indexes'][$skey]=0;
	            $this->dimindexer['vals'][$skey][$vval] = 0;
	        }
	        $row[$skey] = $this->dimindexer['last_seq_indexes'][$skey];
	        
	        if($sval) {
	            if(isset($this->dimindexer['last_iseq_indexes'][$ikey."_".$sval])) {
	                if(!isset($this->dimindexer['vals'][$ikey."_".$sval][$vval])) {
	                    $this->dimindexer['last_iseq_indexes'][$ikey."_".$sval]++;
	                    $this->dimindexer['vals'][$ikey."_".$sval][$vval] = $this->dimindexer['last_iseq_indexes'][$ikey."_".$sval];
	                }
	            } else {
	                $this->dimindexer['last_iseq_indexes'][$ikey."_".$sval]=0;
	                $this->dimindexer['vals'][$ikey."_".$sval][$vval]=$this->dimindexer['last_iseq_indexes'][$ikey."_".$sval];
	            }
	            $row[$ikey] = $this->dimindexer['last_iseq_indexes'][$ikey."_".$sval];
	            $sval .= "_".$row[$index];
	        }else {
	            $sval = "val_".$row[$index];
	        }
	    }
	    return $row;
	    
	}
	
	
	
	
	
	function fetchRows($sql = "",$dim=false,$val=false,$die=true) {
	    $rows = array();
	    $temp = &$rows;
	    $qry = mysqli_query($this->con,$sql);
	    if(!$qry ) {
	        if($die) {
	            echo "<pre>";
	            print_r(debug_print_backtrace());
	            
	            die("wrong query ".$sql." ". mysqli_error($this->con));
	        } else {
	            return false;
	        }
	    }
 	    
	    $checkFirst  = true;
	    $this->dimindexer = array();
	    
	    while($row = mysqli_fetch_assoc($qry)) {
	        
	        if($checkFirst) {
	            $row['isfirstrow'] = true;
	            $checkFirst = false;
	        } else {
	            $row['isfirstrow'] = false;
	            
	        }
	        
	        
	        if(isset($this->processHook['enumList']) && $this->processHook['enumList']) {
	            foreach($this->processHook['enumList'] as $col => $enumkey) {
	                $row[$col] = $this->getEnumValue($enumkey,$row[$col]);
	            }
	        }
	        if(isset($this->processHook['method']) && $this->processHook['method']) {
	            if(isset($this->processHook['instance']) && $this->processHook['instance']) {
	                $row  =	call_user_func(array($this->processHook['instance'],$this->processHook['method']),$row);
	            } else {
	                $row  =	call_user_func($this->processHook['method'],$row);
	            }
	        }
	        if($dim) {
	            
	            if($this->processSeq) {
	               $row = $this->processDimIndexer($row, $dim);
	            }
	            foreach($dim as $dimkey=> $index){
	                $cols = false;
	                
	                if(is_array($index)) {
	                    if(isset($index['cols'])) {
	                        $cols = $index['cols'];
	                        $index = $index['key'];
	                        
	                    } else {
	                        $cols = $index;
	                        $index = $dimkey;
	                    }
	                }
	                
	                if($cols) {
	                    if( !isset($temp[$row[$index]])) {
	                        foreach($cols as $col) {
	                            if(isset($row[$col])) {
	                                $temp[$row[$index]][$col] = $row[$col];
	                            }
	                        }
	                        $temp[$row[$index]]['items'] = false;
	                    } 
	                } else {
	                    if(!isset($temp[$row[$index]])) {
	                        $temp[$row[$index]] = false;
	                    }
	                }
	                
	                if($cols) {
	                    $temp = &$temp[$row[$index]]['items'];
	                } else {
	                    $temp = &$temp[$row[$index]];
	                }
	                
	            }
	            
	            
	            
	            if($val) {
	                $temp = $row[$val];
	            } else {
	                
	                $temp = $row;
	            }
	        } else {
	            if($val) {
	                $rows[$row[$val]] = $row[$val];
	            } else {
	                $rows[] = $row;
	            }
	        }
	        $temp = &$rows;
	    }
	    
	   
	    $this->resetHook();
	    $this->processSeq= false;
	    return $rows;
	}
	
	function resetHook() {
	    $this->processHook = array();
	}
	
	function insert($table,$row) {
	    
	    $sql= "INSERT INTO ".$table." SET ";
	    $fields = $this->getfields($table);
	    foreach($row as $key=>$val) {
	        $val = addslashes($val);
	        if(isset($fields[$key])) {
	            $sql .= $key." = '".$val."'  ";
	        }
	    }
	    return $this->query($sql,true);
	}
	
	
}