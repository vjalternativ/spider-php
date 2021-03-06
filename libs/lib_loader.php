<?php
class lib_loader {



	const PATH = __DIR__;
	public $basepath = '';
	private $data;




	function __construct($lib=false) {

		if($lib) {
		return $this->load($lib);
		}

	}
	public function __get($varName){
		if (!isset($this->data[$varName])){
			die("Attribute not set ".$varName);
		}
		else return $this->data[$varName];
	}

	public function __set($varName,$value){
		$this->data[$varName] = $value;
	}


	 function loadlibs($libs = array()) {
		foreach($libs as $lib) {
			$this->data[$lib] = $this->getobj($lib);
		}
	}


	function getobj($lib) {
		$filepath =self::PATH.'/libs/'.$lib.'.php';

		$this->loadf($filepath);


		$obj = $lib::getInstance();

		return $obj;
	}


	function loadlib($lib) {
		$libpath =self::PATH.'/libs/'.$lib.'.php';
		$this->loadFile($libpath);
	}

	function loadFile($filepath,$die=true,$once=true) {
	   if(file_exists($filepath)) {
 	       if($once) {
 	           require_once $filepath;
 	       } else {
 	           require $filepath;
 	       }
 	       if(!$die) {
				return true;
			}
		} else {
			if($die) {
			    echo "<pre>";
			    debug_print_backtrace();
			die("File not found : ".$filepath);
			}
			return false;
		}
	}
}
?>