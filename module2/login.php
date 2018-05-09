
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student Login</title>
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
				<div align="center" style="font-family:life savers"><b>Student Login</b></div>
				
				<form class="form-horizontal" style="margin-left: 6px;" method="POST" action= "student-home.php">
					<div class="form-group input-group">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span>
						</span> 
						<input type="email" class="form-control" name="email" placeholder="Email">
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-lock"></span>
						</span>
						<input type="password" class="form-control" name="password" placeholder="Password" >
					</div>


					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="login">Login</button>
					</div>

					<div class="login-help">
					<p align="center">Don't Have an Account? <br>Register <a href="register.php">Here</a></p>
				  	</div>
				</form>
			</div>
		</div>
	</div>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>