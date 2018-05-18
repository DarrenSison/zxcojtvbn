<?php 
	$firstname="";
	$lastname="";
	$email="";
	$errors= array();

	//connect to the database
	require_once('connection.php');

	//if the register button is clicked
	if(isset($_POST['register'])){
		$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
		$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		$password_1 = mysqli_real_escape_string($con,$_POST['password_1']);
	//ensure that form fields are filled iproperly

		if(empty($firstname)){
			array_push($errors, "Firstname is required");
		}

		if(empty($lastname)){
			array_push($errors, "Lastname is required");
		}


		if(empty($email)){
			array_push($errors, "Email is required");
		}


		if(empty($password)){
			array_push($errors, "Password is required");
		}

		if($password != $password_1){
			array_push($errors, "The two passwords do not match");
		}

		 // first check the database to make sure 
  		// a user does not already exist with the same username and/or email
  		$user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
  		$result = mysqli_query($con, $user_check_query);
  		$user = mysqli_fetch_assoc($result);
  

    	if ($user['email'] === $email) {
      		array_push($errors, "Email already exists");
    	}

		//if there are no errors, save user to database
		if(count($errors) == 0) {
//			$password = md5($password);
			$sql = "INSERT INTO user(firstname,lastname,type,email,password) 
							VALUES('$firstname','$lastname', '2', '$email','$password')";

			mysqli_query($con, $sql);

			echo '<script type="text/javascript">
                      alert("Welcome! Your account has been created. please login to manage your schedules!");
                         location="login.php";
                           </script>';
		}
	}