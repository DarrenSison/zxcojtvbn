<?php include "connection.php"; ?>
<?php
	//$userid = $_SESSION[];
	$userid = 6;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Home</title>
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
		if($_POST['action'] == 'uncheck') {
			mysqli_query($con,"DELETE FROM attend WHERE user_id = $userid AND company_id = {$_POST['company_id']} AND schedule_id = {$_POST['schedule_id']}");
			
		} else if($_POST['action'] == 'check') {
			mysqli_query($con,"DELETE FROM attend WHERE user_id = $userid AND company_id = {$_POST['company_id']}");
			mysqli_query($con,"INSERT INTO attend(user_id, company_id, schedule_id) VALUES('$userid', '{$_POST['company_id']}', '{$_POST['schedule_id']}')");
		}
	}

?>

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Start Bootstrap</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

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
  
	  
	  
	  
      <!-- Icon Cards-->
      <table width="" class="table table-bordered" border="1">
		<tbody><tr>
			<th>Company</th>
			<th>Date</th>
			<th>Time</th>
			<th>Room</th>
			<th style="width:300px">Actions</th>
		</tr>
        
		<?php
			$q = mysqli_query($con, 'SELECT *, (SELECT company_name FROM company WHERE company.company_id = schedule.company_id) AS company_name FROM schedule ORDER BY company_name ASC') or die(mysqli_error($con));
			//$prevID = 0;
			//$prevDate = '0000-00-00';
			while($r = mysqli_fetch_array($q)) {
				$id = $r['schedule_id'];
				?>
				<tr>
					<td><?php echo $r['company_name']; ?></td>
					<td><?php echo $r['date']; ?></td>
					<td><?php echo $r['start_time'] . ' - ' . $r['end_time']; ?></td>
					<td><?php echo $r['room']; ?></td>
					<td style="width:300px">
						<form action="" method="post">
						<?php 
							$q2 = mysqli_query($con, "SELECT * FROM attend WHERE user_id = $userid AND company_id = {$r['company_id']} AND schedule_id = {$r['schedule_id']}") or die(mysqli_error($con));
							?>
							<input type="hidden" name="user_id" value="<?php echo $id; ?>">
							<input type="hidden" name="company_id" value="<?php echo $r['company_id']; ?>">
							<input type="hidden" name="schedule_id" value="<?php echo $r['schedule_id']; ?>">
							<?php
							if(mysqli_fetch_array($q2)) {
								?><input type="hidden" name="action" value="uncheck"><button class="btn btn-primary">CHECKED</button><?php
							} else {
								?><input type="hidden" name="action" value="check"><button class="btn btn-default">CHECK</button><?php
							}
						?>
						</form>
					</td>
				<tr>
				<?php
				/*
				if($prevID != $r['company_id']) {
				  $id = $r['company_name'];
				  echo $r['company_name'];
					$prevDate = '0000-00-00';
				}
				
				$r['start_time'] = date("h:m A", strtotime($r['start_time']));
				$r['end_time'] = date("h:m A", strtotime($r['end_time']));
				
				if($prevDate != $r['date']) { 
					echo date("F j, Y", strtotime($r['date'])); 
				}
				echo "{$r['start_time']} - {$r['end_time']}.<br>";
				
				$prevID = $r['company_id'];
				$prevDate = $r['date'];
			*/
			}
		?>
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
