<?php
    $con = mysqli_connect ('localhost', 'root', '','ojtdatabase');
 	
    if (!$con) {
    echo 'not connected to server';
    }
    
    if (!mysqli_select_db($con, 'ojtdatabase')) {
    echo 'database not selected';
    }
    
    $errors = array();
    
    if (isset($_POST['login'])) {
	    login();
    }

        // LOGIN USER
    function login(){
	    global $db, $username, $errors;

	    // grap form values
	    $email = $_POST['email'];
	    $password = $_POST['password'];

	    // make sure form is filled properly
	    if (empty($email)) {
		    array_push($errors, "Email is required");
	    }
	    if (empty($password)) {
		    array_push($errors, "Password is required");
	    }

	    // attempt login if no errors on form
	    if (count($errors) == 0) {
		    $password = md5($password);

		    $query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
		    $results = mysqli_query($con, $query);

		    if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			    $logged_in_user = mysqli_fetch_assoc($results);
			        if ($logged_in_user['type'] == '0') {

				    $_SESSION['user'] = $logged_in_user;
				    $_SESSION['success']  = "You are now logged in";
				    header('location: admin-home.php');		  
			    }else if($logged_in_user['type']== '2'){
				    $_SESSION['user'] = $logged_in_user;
				    $_SESSION['success']  = "You are now logged in";
                	header('location: student-home.php');
			    }
		    }else {
			    array_push($errors, "Wrong username/password combination");
		    }
	    }
    }
?>