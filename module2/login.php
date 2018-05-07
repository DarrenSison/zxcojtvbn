<?php
	//start session
	session_start();

	//Include database connection details
	require_once('connection.php');

  	if (isset($_POST['login'])) {
  		//Sanitize POST values
		$email = $_POST['email'];
  		$password = $_POST['password'];
  		
		$sql = "SELECT * FROM user WHERE email='$email'";
	 	$query = mysqli_query($con,$sql);
	 
	 	$numrows = mysqli_num_rows($query);
	 
	 	if($numrows!==0) {
			while($row = mysqli_fetch_assoc($query)) {
			 	$db_email = $row['email'];
			 	$dbpassword = $row['password'];
		 	}
		 
		 	if ($email==$db_email &&($password)==$dbpassword) {
			  	echo '<script type="text/javascript">
                      	alert("Welcome User!");
                         location="admin-home.php";
                           </script>';
			 $_SESSION['email'] = $email;
		 	}
		 
		 } else {
		 	 	echo '<script type="text/javascript">
                      	alert("No user exist!");
                         location="index.php";
                           </script>';
		}
	}

?>