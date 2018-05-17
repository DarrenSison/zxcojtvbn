<?php
/**
* schedule-add.php
*
* Add new a new schedule
* 
* @author Darren Sison
*/
require '../classes/UserAccount.php';
session_start();
$sessionUserAccount = $_SESSION["userAccount"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Module 1
    </title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="pages/assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="pages/assets/css/style2.css"/>
  </head>
  <?php
include 'fragments/head.php';
?>
  <body>
    <?php
//Start your session
if (isset($_SESSION['email']) && $_SESSION['email'] == true) {
} else {
header("location: ../login.php");
}
function echoActiveClassIfRequestMatches($requestUri){
$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
if ($current_file_name == $requestUri)
echo 'class="active-menu"';
}
?>
    <div id="wrapper">
      <?php include 'fragments/page-head.php'; ?>
      <!-- /. NAV TOP  -->
      <?php include 'fragments/sidebar-nav.php'; ?>
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper" >
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h1 style = "font-family: courier new; color:#000000">Add Schedule
              </h1>   
            </div>    
          </div>
          <div class="jumbotron">
            <form name="reg" class="form-horizontal" action="" onsubmit="return validateForm()" method="post">
              <fieldset>
                <legend style = "font-family: courier new;">New Schedule
                </legend>

                <div class="form-group">
                  <label for="roleId" class="col-lg-2 control-label" style = "font-size: 110%;">Company
                  </label>
                  <div class="col-lg-10">
                    <select class="form-control" name="company_name">
                      <option value="">Choose
                      </option>
                        <?php 
                          require_once 'fragments/connection.php';
                          $usersQuerry = $pdo->prepare("SELECT company_name FROM company WHERE archive='1'");
                          $usersQuerry->execute();
                          $users = $usersQuerry->fetchAll();
                          foreach ($users as $user){
                          echo "<option>" . $user['company_name'] . "</option>";
                          }
                          ?>
                   </select>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="date" class="col-lg-2 control-label" style = "font-size: 110%;">Date
                  </label>
                  <div class="col-lg-10">
                    <input type="date" class="form-control" name="date">
                  </div>
                </div>    
                <div class="form-group">
                  <label for="start_time" class="col-lg-2 control-label" style = "font-size: 110%;">Start Time
                  </label>
                  <div class="col-lg-10">
                    <input type="time" class="form-control" name="start_time">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="end_time" class="col-lg-2 control-label" style = "font-size: 110%;">End Time
                  </label>
                  <div class="col-lg-10">
                    <input type="time" class="form-control" name="end_time">
                  </div>
                </div>
                <div class="form-group">
                  <label for="room" class="col-lg-2 control-label" style = "font-size: 110%;">Room
                  </label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="room">
                  </div>
                </div> 
                
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" name="createaccount" class="btn btn-primary" id="createaccount" value="submit">Submit
                    </button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
		  <!-- /. Creates a new account and adds it to the database -->
          <?php
if(! empty($_POST)){
$db = mysqli_connect("localhost", "root", "", "databaseojt");
$company_name = $_POST['company_name'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$room = $_POST['room'];
//get company id
$query1 = $pdo->prepare("SELECT company_id FROM company WHERE company_name='$company_name'");
$query1->execute();
$result = $query1->fetchAll();
foreach($result as $query1){
$company_id = $query1['company_id'];
}
//validate if the room is available
$query2 = $pdo->prepare("SELECT * FROM schedule WHERE date='$date' AND start_time BETWEEN '$start_time' AND SUBTIME('$end_time', '0:01:00') AND room='$room'");
$query2->execute();
$result1 = $query2->fetchAll();
foreach($result1 as $query2){
echo '<script type="text/javascript">
        alert("Room is not available!");
      </script>';
die();
}

$query = "INSERT INTO schedule(schedule_id, company_id, date, start_time, end_time, room) VALUES (DEFAULT, '$company_id', '$date', '$start_time', '$end_time', '$room')";
$insert = $db->query($query);
if($insert){
echo '<script type="text/javascript">
        alert("Schedule Added!");
      </script>';
} else {
echo '<script type="text/javascript">
        alert("Failed to add schedule!");
      </script>';
}
$db->close();
}
?>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">
function validateForm()
{
var a=document.forms["reg"]["company_name"].value;
var b=document.forms["reg"]["date"].value;
var c=document.forms["reg"]["start_time"].value;
var d=document.forms["reg"]["end_time"].value;
var e=document.forms["reg"]["room"].value;
if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e==""))
  {
  alert("All Field must be filled out");
  return false;
  }
if (a==null || a=="")
  {
  alert("Company name must be filled out.");
  return false;
  }
if (b==null || b=="")
  {
  alert("Date must be filled out.");
  return false;
  }
if (c==null || c=="")
  {
  alert("Start time must be filled out.");
  return false;
  }
if (d==null || d=="")
  {
  alert("End time must be filled out.");
  return false;
  }
if (e==null || e=="")
  {
  alert("Room must be filled out");
  return false;
  }
}
</script>