<?php

class Db{
	static private $_instance;
	static private $_connectSource;
	
	private function __construct(){
		
	}
	
	static public function getInstance () {
	   if(!self::$_instance instanceof self){	
		self::$_instance = new self();
		return self::$_instance;
	   }	
	}
	
	private $_dbConfig = array(
	   'host' => '127.01.0.1',
	   'user' =>'root',
	   'password' => 'root',
	   'database' =>'test'
	);
	
	public function connect(){
	   if(!self::$_connectSource){
			@self::$_connectSource = mysql_connect($this->_dbConfig['host'],$this->_dbConfig['user'],$this->_dbConfig['password']);
			if(!self::$_connectSource) {
				throw new Exception('mysql connect error'.mysql_error());
				//die('mysql connect error:'.mysql_error());
		}
		
		mysql_select_db($this->_dbConfig['database'],self::$_connectSource);
		
		mysql_query("set names UTF8",self::$_connectSource);
		return self::$_connectSource;
	}
   }	
}









