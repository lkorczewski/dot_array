<?php

class Dot_Array {
	
	protected $separator = '.';
	protected $array = [];
	
	function __construct(array $array = null){
		if($array){
			$this->array = $array;
		}
	}
	
	function get($key = null){
		if(is_null($key)){
			return $this->array;
		}
		$sections = explode($this->separator, $key);
		$current_element = $this->array;
		foreach($sections as $section){
			if(!is_array($current_element) || !array_key_exists($section, $current_element)){
				trigger_error("Dot notation array element ($key) doesn't exist.", E_USER_ERROR);
			}
			$current_element = $current_element[$section];
		}
		return $current_element;
	}
	
	function set($key, $value){
		$sections = explode($this->separator, $key);
		$current_element =& $this->array;
		foreach($sections as $section){
			if(!is_array($current_element) || !array_key_exists($section, $current_element)){
				trigger_error("Dot notation array element ($key) doesn't exist.", E_USER_ERROR);
			}
			$current_element =& $current_element[$section];
		}
		$current_element = $value;
		
		return $this;
	}
	
}

