<?php
// usable only if you admin is executing something
// so you can skip checks and just pass array

class Query {
	function __construct($array, $delim = '=', $delim2 = ' AND ') {
		
		foreach($array as $key => $val)
			$this->param[':'.$key] = $val;
			
		if($delim == '='){
			$query = [];
			foreach($array as $key => $val){
				$query[] = $key.' = :'.$key;
			}
			$this->query = implode($delim2, $query);
		}
		else{
			$array = array_keys($array);
			$this->keys = implode(', ', $array);
			$this->values = ':'.implode(', :', $array);
			
			$this->query = '('.$this->keys.') VALUES ('.$this->values.')';
			
		}
    }
	
	public $keys = '';
	public $values = '';
	public $query = '';
	public $param = [];
	function bindParam($dbh){
		foreach($this->param as $key => &$val)
			$dbh->bindParam($key, $val, PDO::PARAM_STR, 255);
	}

}
