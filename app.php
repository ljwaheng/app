<?php
require_once('./response.php');

		$data=array(
			'id' =>1,
			'name' => 'ljw',
			'title' =>array(5,2,1)
		);
		
       Response::show(200,'success',$data);
    echo "this is app";

