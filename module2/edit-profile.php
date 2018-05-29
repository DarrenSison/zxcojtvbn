<?php include "connection.php"; ?>
      <?php
        //Start your session
        session_start();
        if (isset($_SESSION['email']) && $_SESSION['email'] == true) {
        } else {
            header("location: login.php");
        }

        function echoActiveClassIfRequestMatches($requestUri){
            $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

            if ($current_file_name == $requestUri)
                echo 'class="active-menu"';
        }
		$userid = $_SESSION['user_id'];
    ?>
	
	<?php
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=databaseojt","root","");
	} catch (PDOException $e) {
		exit("Error: Could not establish connection to database.");
	}
    ?>
<!DOCTYPE html>
<html lang="en">

<?php
require 'classes/UserAccount.php';
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Module 2</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  
  <link href="https://fonts.googleapis.com/css?family=Allura|Arima+Madurai|Cinzel+Decorative|Corben|Dancing+Script|Galindo|Gentium+Book+Basic|Great+Vibes|Henny+Penny|Indie+Flower|Kaushan+Script|Kurale|Life+Savers|Love+Ya+Like+A+Sister|Milonga|Miltonian+Tattoo|Niconne|Oregano|Original+Surfer|Pangolin|Parisienne|Philosopher|Princess+Sofia|Rancho|Risque|Salsa|Schoolbell|Special+Elite" rel="stylesheet">		
</head>

<body class=" sticky-footer bg-dark" id="page-top">

  <!-- Navigation-->
  <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
           
                <a class="navbar-brand" href="student-home.php"style ="font-family:courier new ;font-size: 200%;color: white;"></a> 
            </div>
    
    <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px; font-family:courier new;">Date: <?php echo date("F d, Y"); ?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust" onclick="return confirm('Are you sure you want to log out?');">Logout</a> </div>

  </nav>
  
</div>

    <div id="wrapper">

<!-- Sidebar -->
<nav class="navbar-default navbar-side" role="navigation">

            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="student-home.php" style="font-family: courier new; font-size:50px">
                       SCIS
                    </a>
                </li>
                <li style ="font-family: Cinzel Decorative;">>
                    <a href="student-home.php" style="font-family: Cinzel Decorative; font-size:18px"><i class="fa fa-calendar fa-3x"></i> Schedule</a>
                </li>
                <li style ="font-family: Cinzel Decorative;">>
                    <a href="edit-profile.php" style="font-family: Cinzel Decorative; font-size:18px"><i class="fa fa-user-o fa-3x"></i> Edit Profile</a>
                </li>
            </ul>
        </div>
</nav>

  
<div class="content-wrapper">
    <div class="container-fluid">
    <?php
                
                if(isset($_POST['saveprofile'])){
					$user_id = $_SESSION['user_id'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];

                    include 'connection.php';

                    $sql = $pdo->prepare("UPDATE user SET email='$email', password='$password', firstname='$firstname', lastname='$lastname' WHERE user_id='$user_id'");
                    $sql->execute();
                    header("location:student-home.php");
                }
            ?>
     
       <div id="page-wrapper">
       <div id="page-inner">
       <?php
						$user_id = $_SESSION['user_id'];
                        $pdo = new PDO('mysql:host=localhost;dbname=databaseojt', 'root', '');
                        $qry = $pdo->prepare("SELECT * FROM user WHERE user_id = '$user_id'");
                        $qry->execute();
                        $userqry = $qry->fetch(); 

        ?> 
            <div class="jumbotron">
                        <form class="form-horizontal" action="" method="post">
                          <fieldset>
                            <legend style = "font-family: courier new;">Edit Profile</legend>
                            <div class="form-group">
                              <label for="firstname" class="col-lg-2 control-label" style = "font-family: courier new;font-size: 110%;"> First Name</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="firstname" value="<?php echo $userqry['firstname'] ?>">
                              </div>
                              </div>

                              <div class="form-group">
                              <label for="lastname" class="col-lg-2 control-label" style = "font-family: courier new;font-size: 110%;"> Last Name</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="lastname" value="<?php echo $userqry['lastname'] ?>">
                              </div>
                              </div>

                             <div class="form-group">
                              <label for="email" class="col-lg-2 control-label" style = "font-family: courier new; font-size: 110%;">Email</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="email" value="<?php echo $userqry['email'] ?>">
                              </div>
                              </div>  
                                 
                            <div class="form-group">
                              <label for="password" class="col-lg-2 control-label" style = "font-family: courier new;font-size: 110%;">Password</label>
                              <div class="col-lg-10">
                                <input type="password" class="form-control" name="password" value="<?php echo $userqry['password'] ?>">
                              </div>
                            </div>  
                              
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" name="saveprofile" class="btn btn-primary" id="saveprofile" value="submit">Confirm</button>
                                </div>
                            </div>
                              
                            </fieldset>
                        </form>
                    </div>
    </div>
<div>
     
             
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
