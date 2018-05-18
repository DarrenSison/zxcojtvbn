<?php
/**
* delete-company.php
*
* Deletes the selected company
* 
* @author Darren Sison
*/ 
include 'connection.php';
$id=$_GET['id'];

//validate if the company has pending schedules
$query2 = $pdo->prepare("SELECT * FROM schedule WHERE company_id=$id AND archive='1'");
$query2->execute();
$result1 = $query2->fetchAll();
foreach($result1 as $query2){
echo '<script type="text/javascript">
        alert("Unable to delete. There are pending schedules in for this company.");
        location="../index.php";
      </script>';
die();
}

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
