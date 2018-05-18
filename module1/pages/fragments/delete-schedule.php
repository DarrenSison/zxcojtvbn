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

//validate if the schedule is registered by the students
$query2 = $pdo->prepare("SELECT * FROM attend WHERE schedule_id=$id");
$query2->execute();
$result1 = $query2->fetchAll();
foreach($result1 as $query2){
echo '<script type="text/javascript">
        alert("Unable to delete. Some students are registered in this schedule.");
        location="../sched.php";
      </script>';
die();
}

$query = $pdo->prepare("UPDATE schedule SET archive='0' WHERE schedule_id=$id");
$query->execute();
if($query){
        echo '<script type="text/javascript">
              alert("Schedule Deleted!");
              location="../sched.php";
              </script>';
    } else {
        echo '<script>alert("Failed to delete.")</script>';
    }
?>
