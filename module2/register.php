<?php include('regis.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styletwo.css">
</head>
<body>
	<div class="container">
		<div class="col-sm-10">
			<div class="jumbotron">
				<div class="form-group">
					<h1>Register</h1>
				</div>

				<form class="form-horizontal" method="post" action="register.php">
					<?php include('errors.php'); ?>
					<div class="form-group input-group">
						<input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name">
					</div>

					<div class="form-group input-group">
						<input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Last Name">
					</div>

					<div class="form-group input-group">
						<input type="email" name="email" id="email" class="form-control" placeholder="Email">
					</div>

					<div class="form-group input-group">
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					</div>

					<div class="form-group input-group">
						<input type="password" name="password_1" id="password_1" class="form-control" placeholder="Confirm Password">
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary" name ="register">Register</button>
					</div>
					<p class="message">Already Registered?<a href="index.php">Login Here</a></p>

				</form>
			</div>
		</div>
	</div>

</body>
</html>
