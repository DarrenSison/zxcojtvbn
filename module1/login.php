<?php
require 'classes/UserAccount.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <title>Admin Login</title><meta charset="UTF-8" />
      <link rel="stylesheet" href="pages/assets/css/style.css">
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="col-sm-10" style="width: 350px; margin-left: 370px; margin-top: 30px;">
                <div class="jumbotron">
                    <div class="form-group">
                        <img src="img/scislogo.png" style="width:250px; height:180px; ">
                    </div>
      <?php
        if(isset($errMsg)){
          echo '<div style="color:black;text-align:center;font-size:120px;">'.$errMsg.'</div>';
        }
      ?>
      <div align="center" style="font-family:life savers"><b>Admin Login</b></div>
          <form class="form-horizontal" style="margin-left: 6px;" action="" method="post">
          <div class="form-group input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
                </span>
              <input type="text" name="email" class="form-control" placeholder="Email"/>
        </div>

        <div class="form-group input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
                </span>
              <input type="password" name="password" class="form-control"placeholder="Password"/>
        </div>

        <div class="form-group">
          <input type="submit" name='submit' class="btn btn-primary" value="Submit"/>
          </form>
    </div>
      </div>
    </div>
  </div>
    <?php
    $errMsg = "";
  if(isset($_POST['submit'])){
    //email and password sent from Form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($email == '')
      $errMsg .= 'You must enter your Email<br>';

    if($password == '')
      $errMsg .= 'You must enter your Password<br>';

    //if($errMsg == ''){
        if($email && $password){
            require "pages/fragments/connection.php";
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryLogin = "SELECT * FROM user WHERE email='$email' AND password='$password' and type='0' ";
            $queryFail = "SELECT * FROM user WHERE email='$email' AND password='$password' and type='2' ";
            $records = $pdo->query($queryLogin);
            $records->execute();
            $counter = $records->rowCount();
            
            $record = $pdo->query($queryFail);
            $record->execute();
            $counters = $record->rowCount();

            if ($counters >= 1) {
                while($rows = $record->fetch(PDO::FETCH_ASSOC)){
                    $dbuser = $rows["email"];
                    $dbpass = $rows["password"];
                    if($email == $dbuser && $password == $dbpass ) {
                           $message = "You are not allowed to login here";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                }
            }
            if($counter != 0){
                while($rows = $records->fetch(PDO::FETCH_ASSOC)){
                    $dbuser = $rows["email"];
                    $dbpass = $rows["password"];
                    if($email == $dbuser && $password == $dbpass ) {
                        session_start();

                        /*
                         * The whole userAccount information pack into an object and place inside the user session for further usage
                         * */
						$user_id = $rows["user_id"];
                        $password = $rows["password"];
                        $firstname = $rows["firstname"];
                        $lastname = $rows["lastname"];

                        $userAccount = new UserAccount($user_id, $dbuser, '', $email, $password,
                            $firstname, $lastname);

                        $_SESSION["userAccount"] = $userAccount;

                        $_SESSION["email"]=$dbuser;
                        header('location:pages/index.php');

                    }else{
                       $errMsg .= "User Credentials Not Found!";
                    }
                }
            }

    }

  }
?>

<?php
	/*
    $errMsg = "";
    if(isset($_GET['submit'])){
        //username and password sent from Form
        $username = trim($_GET['username']);
        $password = trim($_GET['password']);

        if($username == '')
            $errMsg .= 'You must enter your Username<br>';

        if($password == '')
            $errMsg .= 'You must enter your Password<br>';

        //if($errMsg == ''){
        if($username && $password){
            require "pages/fragments/connection.php";
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryLogin = "SELECT * FROM accounts WHERE username='$username' AND password='$password' and roleId='Admin' ";

            $records = $pdo->query($queryLogin);
            $records->execute();
            $counter = $records->rowCount();


            if($counter != 0){
                while($rows = $records->fetch(PDO::FETCH_ASSOC)){
                    $dbuser = $rows["username"];
                    $dbpass = $rows["password"];
                    if($username == $dbuser && $password == $dbpass ) {
                        session_start();

                        /*
                         * The whole userAccount information pack into an object and place inside the user session for further usage
                         * */
/**						 
                        $accountNo = $rows["accountNo"];
                        $roleId = $rows["roleId"];
                        $name = $rows["name"];
                        $address = $rows["address"];
                        $username = $rows["username"];
                        $password = $rows["password"];
                        $accountStatus = $rows["accountStatus"];
                        $image = $rows["image"];

                        $userAccount = new UserAccount($accountNo, $dbuser, '', $roleId, $name,
                            $address, $accountStatus, $image);

                        $_SESSION["userAccount"] = $userAccount;


                        $_SESSION["username"]=$dbuser;
                        header('location:pages/index.php');

                    }else{
                        $errMsg .= "User Credentials Not Found!";
                    }
                }
            }

        }

    }
*/
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>
