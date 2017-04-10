<?php

class  Response {
	const JSON="json";
	
	public static function show ($code,$message,$data=array(),$type=""){
		if(!is_numeric($code)){
			return '';
		}
		
		$type = isset($_GET['format']) ? $_GET['format'] : self::JSON;
		
		$result = array(
		   'code' => $code,
		   'message' =>$message,
		   'data' => $data
		);
		
		if($type == "json"){
			self::json($result);
			exit;
		}elseif($type == "array"){
			var_dump($result);
		}elseif($type == 'xml'){
			self::xmlEncode($result);
			exit;
		}
	}
	
	//用JSON传输数据
	public static function json($result){
		
		if(!is_numeric($result['code'])){
			return '';
		}
		
		echo json_encode($result);
	}
	
	//用XML传输数据
	public static function xmlEncode($result){
		if(!is_numeric($result['code'])){
			return '';
		}
		
		header("Content-Type:text/xml");
		$xml="<?xml version='1.0' encoding='UTF-8'?>";
		$xml.="<root>";
		$xml.=self::xmlToEncode($result);
		
		$xml.="</root>";
		echo $xml;
		
	}
	
	//处理xml数据
	public static function xmlToEncode($result){
		$xml=$attr="";
		foreach($result as $key=>$value){
			if(is_numeric($key)){
				$attr="id='{$key}'";
				$key="item";
			}
			$xml.="<{$key} {$attr}>";
			$xml.=is_array($value)?self::xmlToEncode($value):$value;
			$xml.="</{$key}>";
		}
		return $xml;
	}
}

