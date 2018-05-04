<?php
session_start();
include('connection.php');
$company_name=$_POST['company_name'];
$full_name=$_POST['full_name'];
$address=$_POST['address'];
$phone_number=$_POST['phone_number'];
$landline=$_POST['landline'];
mysql_query("INSERT INTO table_name(company_name, full_name, address, address, phone_number, landline)VALUES('$company_name', '$full_name', '$address', '$address', '$phone_number', '$landline')");
header("location: signup.php?remarks=success");
mysql_close(1);
?>