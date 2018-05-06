<?php
	$con = mysqli_connect ('localhost', 'root', '','ojtdatabase');
 	
 	if (!$con) {
	 echo 'not connected to server';
 	}
 	
 	if (!mysqli_select_db($con, 'ojtdatabase')) {
	 echo 'database not selected';
 	}
?>