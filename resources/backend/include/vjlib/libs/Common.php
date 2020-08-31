<?php
class Common {
	
	function __construct() {
		die("s");
	}
	function getArrayByKeys($array,$keys) {
		$newArray = array();
		foreach($keys as $id) {
			if(isset($array[$id])) {
				$newArray[$id] =$array[$id];  
			}
		}
		
		return $newArray;
	}
	
	
}