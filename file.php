<?php
class File {
	private $_dir;

	const EXT = '.txt';

	public function __construct(){
		$this->_dir=dirname(__FILE__).'/files/';
	}

	public function cacheData ($key,$value='',$cacheTime=0){
         $filename=$this->_dir . $key.self::EXT;

         if($value !==''){
         	//判断$value是否为null如果为null则代表需要删除缓存
         	if(is_null($value)){
         		return @unlink($filename);
         	}
         	//将$value值写入缓存
         	$dir=dirname($filename);
         	if(!$dir){
         		mkdir($dir,0777);
         	}
         }

         //获取缓存文件
         if(!is_file($filename)){
         	return FALSE;
         }
         $contents =file_get_contents($filename);
	}
}