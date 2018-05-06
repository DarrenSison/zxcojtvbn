<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Users</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
	
	if(isset($_POST['action'])) {
		if($_POST['action'] == 'newuser') {
			//code for saving
			$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
			$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$type = mysqli_real_escape_string($con,$_POST['type']);
			$password = mysqli_real_escape_string($con,$_POST['password']);
			
			$sql = "INSERT INTO user(email,password,type,firstname,lastname) VALUES('$email','$password','$type','$firstname','$lastname')";
			mysqli_query($con,$sql);
		} else if($_POST['action'] == 'edituser') {
			//code for editing
			$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
			$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$type = mysqli_real_escape_string($con,$_POST['type']);
			$password = mysqli_real_escape_string($con,$_POST['password']);
			$id = mysqli_real_escape_string($con, $_POST['user_id']);
			
			$sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', email= '$email', type= '$type', password = '$password' WHERE user_id='$id'";
			mysqli_query($con,$sql);
		} else if($_POST['action'] == 'deleteuser') {
			//code for delete
			$id = mysqli_real_escape_string($con, $_POST['user_id']);
			
			$sql = "DELETE FROM user WHERE user_id = $id";
			mysqli_query($con,$sql);
		}
	}

?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">SCIS</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="admin-home.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="companies.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Companies</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="users.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Users</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
  <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
		  <table style="width: 100% !important">
				<tr>
					<td><a href="#">Users</a></td>
					<td><input type="button" style="margin-left:1070px" class="btn btn-primary" value="New User" data-toggle="modal" data-target="#newUser"></td>
				</tr>
			</table>
        </li>
      </ol>
     <div class="modal fade" id="newUser">
				  <div class="modal-dialog">
					<div class="modal-content">
					<form method="post" action="">
						<input type="hidden" name="action" value="newuser">
						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">New User</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">
							<label for="compname">First name: </label>
							<input type="text" class="form-control" name="firstname" value="" placeholder="First Name">
							<label for="compname">Last name: </label>
							<input type="text" class="form-control" name="lastname" value="" placeholder="Last Name">
							<label for="compname">Email: </label>
							<input type="text" class="form-control" name="email" value="" placeholder="Email">
							<label for="compname">Password: </label>
							<input type="password" class="form-control" name="password" value="" placeholder="Password">
							<label for="compname">Confirm Password:</label>
							<input type="password" class="form-control" name="confirm" value="" placeholder="Confirm Password">
							<label for="compname">Type:</label>
							<select name="type" class="form-control">

								<option value="0">Administrator</option>
								<option value="1">Facilitator</option>
								<option value="2">Student</option>
							</select>
						  </div>

						  <!-- Modal footer -->
						  <div class="modal-footer">
							<button type="submit" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						  </div>
					</form>
					</div>
				  </div>
				</div>
      <!-- Icon Cards-->
      
	  <table width="" class="table table-bordered" border="1">
		<tbody><tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th style="width:300px">Actions</th>
		</tr>
		<?php
			$q = mysqli_query($con, 'SELECT * FROM user ORDER BY email ASC') or die(mysqli_error($con));
			while($r = mysqli_fetch_array($q)) {
				$id = $r['user_id'];
		?>
		<tr>
			<td><?php echo $r['firstname']; ?></td>
			<td><?php echo $r['lastname']; ?></td>
			<td><?php echo $r['email']; ?></td>
			
			<td>
				<input type="button" class="btn btn-success" value="Edit" data-toggle="modal" data-target="#editUser<?php echo $id; ?>">&nbsp;
				<input type="button" class="btn btn-danger" value="Delete"  data-toggle="modal" data-target="#deleteUser<?php echo $id; ?>">
				
				<div class="modal fade" id="editUser<?php echo $id; ?>">
				  <div class="modal-dialog">
					<div class="modal-content">
					<form method="post" action="">
						<input type="hidden" name="action" value="edituser">
						<input type="hidden" name="user_id" value="<?php echo $id; ?>">
						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">Edit User</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">
							<label for="email">Email: </label>
							<input type="email" class="form-control" name="email" value="<?php echo $r['email']; ?>" placeholder="Email">
							<label for="password">Password: </label>
							<input type="password" class="form-control" name="password" value="" placeholder="Password">
							<label for="type">Type: </label>
							<select name="type" class="form-control">
								<option value="0"<?php echo ($r['type'] == 0 ? ' selected' : ''); ?>>Administrator</option>
								<option value="1"<?php echo ($r['type'] == 1 ? ' selected' : ''); ?>>Facilitator</option>
								<option value="2"<?php echo ($r['type'] == 2 ? ' selected' : ''); ?>>Student</option>
							</select>
							<label for="firstname">First name: </label>
							<input type="text" class="form-control" name="firstname" value="<?php echo $r['firstname']; ?>" placeholder="First Name">
							<label for="firstname">Last name: </label>
							<input type="text" class="form-control" name="lastname" value="<?php echo $r['lastname']; ?>" placeholder="Last Name">
						  </div>

						  <!-- Modal footer -->
						  <div class="modal-footer">
							<button type="submit" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						  </div>
					</form>
					</div>
				  </div>
				</div>
				
				<!-- The Modal -->
				<div class="modal fade" id="deleteUser<?php echo $id; ?>">
				  <div class="modal-dialog">
					<div class="modal-content">
					<form method="post" action="">
						<input type="hidden" name="action" value="deleteuser">
						<input type="hidden" name="user_id" value="<?php echo $id; ?>">
						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">Delete User</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">
							<label>Are you sure you want to delete '<?php echo $r['email']; ?>' ?</label>
						  </div>

						  <!-- Modal footer -->
						  <div class="modal-footer">
							<button type="submit" class="btn btn-primary">Yes</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
						  </div>
					</form>
					</div>
				  </div>
				</div>
			</td>
		</tr>
		<?php
			}
		?>
		</tbody>
	</table>
      
		</div>
		
	  </div>
	</div>
  </div>
     
             
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
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
