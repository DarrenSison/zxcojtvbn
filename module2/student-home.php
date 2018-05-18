<?php include "connection.php"; ?>
<?php
	//$userid = $_SESSION[];
	$userid = 1;
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

<?php
	if(isset($_POST['action'])) {
		function extractCompanyID($scheduleID, $con) {
			$q = mysqli_query($con,"SELECT company_id FROM schedule WHERE schedule_id = $scheduleID");
			return mysqli_fetch_array($q)['company_id'];
		}
		function isConflict($attend_start_time, $attend_end_time, $sched_start_time, $sched_end_time) {
			$attend_start_time = strtotime($attend_start_time);
			$attend_end_time = strtotime($attend_end_time);
			$sched_start_time = strtotime($sched_start_time);
			$sched_end_time = strtotime($sched_end_time);
			if($attend_start_time === $sched_start_time) { return true; }
			else if(($attend_start_time < $sched_start_time) && ($attend_end_time > $sched_start_time)) { return true; }
			else if(($attend_start_time > $sched_start_time) && ($attend_end_time < $sched_start_time)) { return true; }
			return false;
		}
		
		if($_POST['action'] == 'uncheck') {
			mysqli_query($con,"DELETE FROM attend WHERE user_id = $userid AND schedule_id = {$_POST['schedule_id']}");
			
		} else if($_POST['action'] == 'check') {
			$q = mysqli_query($con,"SELECT start_time, end_time FROM schedule WHERE schedule_id = {$_POST['schedule_id']}");
			$r = mysqli_fetch_array($q);
			$sched_start_time = $r['start_time'];
			$sched_end_time = $r['end_time'];
			
			$hasConflict = false;
			$q = mysqli_query($con,"SELECT start_time, end_time FROM schedule WHERE schedule_id IN (SELECT schedule_id FROM attend WHERE user_id = $userid)");
			while($r = mysqli_fetch_array($q)) { if(isConflict($r['start_time'], $r['end_time'], $sched_start_time, $sched_end_time)) { $hasConflict = true; break; } }
			if($hasConflict) { ?><script>alert('Conflicting schedule.');</script><?php }
			else {
				mysqli_query($con,"DELETE FROM attend WHERE user_id = $userid AND schedule_id IN (SELECT schedule_id FROM schedule WHERE company_id = " . extractCompanyID($_POST['schedule_id'], $con) . ")");
				mysqli_query($con,"INSERT INTO attend(user_id, schedule_id) VALUES('$userid', '{$_POST['schedule_id']}')") or die(mysqli_error($con));
			}
		}
	}
?>
<div>
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
          require('viewsched.php');
          foreach($company_result as $res) {
			  ?>
			  <div class="card" data-toggle="collapse" href="#collapse_<?php echo $res[1]; ?>" role="button" aria-expanded="false" aria-controls="collapse_<?php echo $res[1]; ?>">
                <div class="card-header">
                  <h5 class="mb-0">
                    <?php echo $res[1]; ?>
                  </h5>
                </div>
              </div>
			  <div class="collapse multi-collapse" id="collapse_<?php echo $res[1]; ?>">
				  <div class="card card-body">
					<table>
						<?php
						$q = mysqli_query($con, 'SELECT * FROM schedule WHERE company_id = ' .  $res[0] . ' ORDER BY date ASC') or die(mysqli_error($con));
						while($r = mysqli_fetch_array($q)) {
							$id = $r['schedule_id'];
							?>
							<tr>
								<td><?php echo $res[1]; ?></td>
								<td><?php echo $r['date']; ?></td>
								<td><?php echo $r['start_time'] . ' - ' . $r['end_time']; ?></td>
								<td><?php echo $r['room']; ?></td>
								<td style="width:300px">
									<form action="" method="post">
									<?php 
										$q2 = mysqli_query($con, "SELECT * FROM attend WHERE user_id = $userid AND schedule_id = {$r['schedule_id']}") or die(mysqli_error($con));
										?>
										<input type="hidden" name="user_id" value="<?php echo $userid; ?>">
										<input type="hidden" name="schedule_id" value="<?php echo $r['schedule_id']; ?>">
										<?php
                      if(mysqli_fetch_array($q2)) {
                        echo '<input type="hidden" name="action" value="uncheck"><button class="btn btn-primary">CHECKED</button>';
                      } else {
                        echo '<input type="hidden" name="action" value="check"><button class="btn btn-default">CHECK</button>';
                      }
                    ?>
									</form>
								</td>
							<tr>
						<?php } ?>
					</table>
				  </div>
				</div>
			  <?php
            /*
			echo '<div id="'.$res[1].'">
              <div class="card">
                <div class="card-header">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#'.$res[0].'" aria-expanded="true" aria-controls="collapseOne">
                      '.$res[1].'
                    </button>
                  </h5>
                </div>
              </div>
            </div>';
			*/
          }
        ?>
      </div>
  </div>
  
             
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
