<?php
include 'fragments/connection.php';

    $query = $pdo->prepare("SELECT company_id FROM company WHERE company_name='Nokia'");
    $query->execute();
    $result = $query->fetchAll();
    foreach($result as $query){
		$company_id=$query['company_id'];
		echo "$company_id";
    }
?>




