<?php

	$dbconnect = new mysqli('localhost', 'root', '', 'unique_academy');
	if ($dbconnect){
		
	}else{

		die($dbconnect->connect_error);
	}
?>