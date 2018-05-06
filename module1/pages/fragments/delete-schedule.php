<?php
/**
* delete-schedule.php
*
* Deletes the selected schedule
* 
* @author Darren Sison
*/ 
include 'connection.php';
$id=$_GET['id'];

$query = $pdo->prepare("UPDATE schedule SET archive='0' WHERE schedule_id=$id");
$query->execute();

if($query){
        echo '<script type="text/javascript">
              alert("Schedule Revoked!");
              location="../sched.php";
              </script>';
    } else {
        echo '<script>alert("Failed to revoke.")</script>';
    }
?>
