<?php

	try{
		$pdo = new PDO("mysql:host=localhost;dbname=databaseojt","root","");
	} catch (PDOException $e) {
		exit("Error: Could not establish connection to database.");
	}
?>