<?php
/**
* kiosk-disable.php
*
* Updates the status of the kiosk
* 
* @author Darren Sison
*/ 
include 'connection.php';
$id=$_GET['id'];

$query = $pdo->prepare("UPDATE company SET archive='0' WHERE company_id=$id");
$query->execute();

if($query){
        echo '<script type="text/javascript">
              alert("Company Deleted!");
              location="../index.php";
              </script>';
    } else {
        echo '<script>alert("Failed to delete.")</script>';
    }
?>
