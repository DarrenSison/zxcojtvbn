<?php
/**
* user-reset-password.php
*
* Select user accounts from the database
* 
* @author Darren Sison
*/
include 'connection.php';

$id = $_GET['id'];

$query = $pdo->prepare("UPDATE user SET password = '1234' WHERE user_id=$id");
$query->execute();

    if($query){
        echo '<script type="text/javascript">
              alert("Password Reset Successful! Password set as 1234");
              location="../users.php";
              </script>';
    } else {
        echo '<script>alert("Password Reset Failed.")</script>';
    }

?>