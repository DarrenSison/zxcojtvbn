<?php
/**
* company-add.php
*
* Add new company
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
              <h1 style = "font-family: courier new; color:#000000">Add Company
              </h1>   
            </div>    
          </div>
          <div class="jumbotron">
            <form name="reg" class="form-horizontal" action="" onsubmit="return validateForm()" method="post">
              <fieldset>
                <legend style = "font-family: courier new;">New Company
                </legend>
                <div class="form-group">
                  <label for="company_name" class="col-lg-2 control-label" style = "font-size: 110%;">Company Name
                  </label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="company_name">
                  </div>
                </div> 
                <div class="form-group">
                  <label for="contact_name" class="col-lg-2 control-label" style = "font-size: 110%;">Contact Person
                  </label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="contact_name">
                  </div>
                </div>    
                <div class="form-group">
                  <label for="phone" class="col-lg-2 control-label" style = "font-size: 110%;">Phone Number
                  </label>
                  <div class="col-lg-10">
                    <input type="number" class="form-control" name="phone">
                  </div>
                </div>  
                <div class="form-group">
                  <label for="landline" class="col-lg-2 control-label" style = "font-size: 110%;">Landline
                  </label>
                  <div class="col-lg-10">
                    <input type="number" class="form-control" name="landline">
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
$contact_name = $_POST['contact_name'];
$phone = $_POST['phone'];
$landline = $_POST['landline'];

//validate if the company is not in the database
$query2 = $pdo->prepare("SELECT * FROM company WHERE company_name='$company_name' AND archive='1'");
$query2->execute();
$result1 = $query2->fetchAll();
foreach($result1 as $query2){
echo '<script type="text/javascript">
        alert("Company is already registered");
      </script>';
die();
}

$query = "INSERT INTO company(company_id, company_name, contact_name, phone, landline, archive) VALUES (DEFAULT, '$company_name', '$contact_name', '$phone', '$landline', '1')";
$insert = $db->query($query);
if($insert){
echo '<script type="text/javascript">
        alert("Company Added!");
      </script>';
} else {
echo '<script type="text/javascript">
        alert("Failed to add company!");
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
var b=document.forms["reg"]["contact_name"].value;
var c=document.forms["reg"]["phone"].value;
var d=document.forms["reg"]["landline"].value;
if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d==""))
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
  alert("Contact Person must be filled out.");
  return false;
  }
if (c==null || c=="")
  {
  alert("Phone Number must be filled out.");
  return false;
  }
if (d==null || d=="")
  {
  alert("Landline must be filled out.");
  return false;
  }
}
</script>