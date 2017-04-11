<?php

	require_once('./response.php');
	require_once('./db.php');
	require_once('./file.php');
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$pagesize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 6;
	if(!is_numeric($page)||!is_numeric($pagesize)){
	   return Response::show(401,"数据不合法"); 
	}

   $offset = ($page-1)*$pagesize;
   $sql = "select * from test1 limit ".$offset.",".$pagesize;
   $cache = new File();
   $results = array();
   
   if(!$results=$cache->cacheData('index' . $page .'-' . $pagesize)){
	  try{ 
		   $connect =Db::getInstance()->connect();
	  }catch(Exception $e){	  
		   return Response::show(403,'失败');
	  }
	   $res = mysql_query($sql,$connect);
		 
	   while($result=mysql_fetch_assoc($res)){
		  $results[]=$result;
		 
	   }
	   
	   if($results){
		   $cache->cacheData('index' . $page .'-' . $pagesize,$results,60);
	   }
   
}
   
   if($results){
	   return Response::show(200,'成功',$results);
   }else{
	   return Response::show(400,'失败');
   }
 