<?php
class File {
	private $_dir;

	const EXT = '.txt';

	public function __construct(){
		//dirname函数用于获取当前文件路径的目录部分
		$this->_dir=dirname(__FILE__).'/files/';
	}

	public function cacheData($key,$value='',$cacheTime=0){
         $filename=$this->_dir . $key.self::EXT;

         if($value !==''){
         	//判断$value是否为null如果为null则代表需要删除缓存
         	if(is_null($value)){
         		return @unlink($filename);
         	}
         	
			//判断是否存在缓存文件所在目录
         	$dir=dirname($filename);
         	if(!is_dir($dir)){
         		mkdir($dir,0777);
         	}
			//缓存时间格式为%011d 为%d 时间位数有11位 不够用0填充
			$cacheTime = sprintf('%011d',$cacheTime);
			//将$value值和缓存时间写入缓存文件
			return file_put_contents($filename,$cacheTime.json_encode($value));
         }

         //获取缓存文件
         if(!is_file($filename)){
         	return FALSE;
         }
		 $contents =file_get_contents($filename);
		 $cacheTime = (int)substr($contents,0,11);
		 //真正的缓存数据
		 $value=substr($contents,11);
		 if($cacheTime != 0&&($cacheTime+filemtime($filename)<time())){
         	   @unlink($filename);			 
		 }
		 return json_decode($value,true);         
		 
	}
}



