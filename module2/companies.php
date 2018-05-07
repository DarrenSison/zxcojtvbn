<?php include "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
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
		if($_POST['action'] == 'newcompany') {
			$company_name = mysqli_real_escape_string($con,$_POST['company_name']);		
			
			$sql = "INSERT INTO company (company_name) VALUES('$company_name')";
			mysqli_query($con,$sql);
		} else if($_POST['action'] == 'editcompany') {
			//code for saving
			$company_id = mysqli_real_escape_string($con, $_POST['company_id']);
			$company_name = mysqli_real_escape_string($con, $_POST['company_name']);
			
			$sql = "UPDATE company SET company_name= '$company_name' WHERE company_id= '$company_id'";
	
			mysqli_query($con, $sql);
			
		} else if($_POST['action'] == 'deletecompany') {
			//code for delete
			$company_id = mysqli_real_escape_string($con, $_POST['company_id']);
			
			$sql = "DELETE FROM company WHERE company_id = $company_id";
			mysqli_query($con, $sql);
		}
	}

?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Start Bootstrap</a>
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
					<td><a href="#">Companies</a></td>
					<td><input type="button" style="margin-left:1005px" class="btn btn-primary" value="New Company" data-toggle="modal" data-target="#newCompany"></td>
				</tr>
			</table>
			
			<!-- The Modal -->
				<div class="modal fade" id="newCompany">
				  <div class="modal-dialog">
					<div class="modal-content">
					<form method="post" action="">
						<input type="hidden" name="action" value="newcompany">
						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">New Company</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">
							<label for="compname">Company Name:</label>
							<input type="text" class="form-control" id="compname" name="company_name" value="" placeholder="Company Name">
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
        
        </li>
      </ol>
      <!-- Icon Cards-->
      
	  <table width="" class="table table-bordered" border="1">
		<tbody><tr>
			<th>Name</th>
			<th style="width:300px">Actions</th>
		</tr>
		<?php
			$q = mysqli_query($con, 'SELECT * FROM company') or die(mysqli_error($con));
			while($r = mysqli_fetch_array($q)) {
				$id = $r['company_id'];
		?>
		<tr>
			<td><?php echo $r['company_name']; ?></td>
			<td>
				<input type="button" class="btn btn-success" value="Edit" data-toggle="modal" data-target="#editCompany<?php echo $id; ?>">&nbsp;
				<input type="button" class="btn btn-danger" value="Delete"  data-toggle="modal" data-target="#deleteCompany<?php echo $id; ?>">&nbsp;
				<input type="button" class="btn btn-info" value="List">
				
				
				<!-- The Modal -->
				<div class="modal fade" id="editCompany<?php echo $id; ?>">
				  <div class="modal-dialog">
					<div class="modal-content">
					<form method="post" action="">
						<input type="hidden" name="action" value="editcompany">
							<input type="hidden" name="company_id" value="<?php echo $id; ?>">
						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">Edit Company</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">
							<label for="compname">Company Name:</label>
							<input type="text" class="form-control" id="compname" name="company_name" value="<?php echo $r['company_name']; ?>">
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
				<div class="modal fade" id="deleteCompany<?php echo $id; ?>">
				  <div class="modal-dialog">
					<div class="modal-content">
					<form method="post" action="">
						<input type="hidden" name="action" value="deletecompany">
						<input type="hidden" name="company_id" value="<?php echo $id; ?>">
						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">Delete Company</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">
							<label>Are you sure you want to delete '<?php echo $r['company_name']; ?>' ?</label>
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
