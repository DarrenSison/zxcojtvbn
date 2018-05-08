<?php
	$con = mysqli_connect ('localhost', 'root', '','databaseojt');
 	
 	if (!$con) {
	 echo 'not connected to server';
 	}
 	
 	if (!mysqli_select_db($con, 'databaseojt')) {
	 echo 'database not selected';
 	}
?>