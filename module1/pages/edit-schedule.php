<?php
/**
* edit-company.php
*
* Edit company information
* 
* @author Darren Sison
*/
    require '../classes/UserAccount.php';
    session_start();
    $sessionUserAccount = $_SESSION["userAccount"];
    include 'fragments/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Allura|Arima+Madurai|Cinzel+Decorative|Corben|Dancing+Script|Galindo|Gentium+Book+Basic|Great+Vibes|Henny+Penny|Indie+Flower|Kaushan+Script|Kurale|Life+Savers|Love+Ya+Like+A+Sister|Milonga|Miltonian+Tattoo|Niconne|Oregano|Original+Surfer|Pangolin|Parisienne|Philosopher|Princess+Sofia|Rancho|Risque|Salsa|Schoolbell|Special+Elite" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="assets/img/wifira_logo.png"/>
    </head>
    <?php
        include 'fragments/head.php';
    ?>

    <body>
           

        <?php
            //Start your session
            function echoActiveClassIfRequestMatches($requestUri){
                $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
                if ($current_file_name == $requestUri)
                    echo 'class="active-menu"';
            }
        ?>

        <div id="wrapper">
                
                <?php include 'fragments/page-head.php'; ?>
                <!-- /. NAV TOP  -->

                    <?php
                        $schedule_id = $_GET['id'];
                        
                        //QUERY THE ACCOUNT DATA
                        $qry = $pdo->prepare("SELECT * FROM schedule WHERE schedule_id = '$schedule_id'");
                        $qry->execute();
                        $schedqry = $qry->fetch(); 

                    ?>
                <?php

                        //get company name
                        $company_id = $schedqry['company_id'];
                        $query3 = $pdo->prepare("SELECT company_name FROM company WHERE company_id='$company_id'");
                        $query3->execute();
                        $result1 = $query3->fetchAll();
                        foreach($result1 as $query3){
                            $company_name = $query3['company_name'];
                        }
                
                	if(isset($_POST['savesched'])){
                    	$schedule_id = $_GET['id'];

                       // $company_name = $_POST['company_name'];
                        $date = $_POST['date'];
                        $start_time = $_POST['start_time'];
                        $end_time = $_POST['end_time'];
                        $room = $_POST['room'];


                        //validate if the room is available
                        $query2 = $pdo->prepare("SELECT * FROM schedule WHERE date='$date' AND start_time BETWEEN '$start_time' AND SUBTIME('$end_time', '0:00:01') AND room='$room'");
                        $query2->execute();
                        $result1 = $query2->fetchAll();
                        foreach($result1 as $query2){
                        echo '<script type="text/javascript">
                                alert("Room is not available!");
                              </script>';
                              header("location: sched.php");
                        die();
                        }

                    	$sql = $pdo->prepare("UPDATE schedule SET date='$date', start_time='$start_time', end_time='$end_time', room='$room' WHERE schedule_id='$schedule_id'");
                        $sql->execute();
                        header("location:sched.php");


                         include("connect.php");
                         $subject = $company_name;
                         $comment = 'Your reserved exam schedule made some changes. Please check if it is an appropriate time for you.';
                         $query = "INSERT INTO comments(comment_subject, comment_text) VALUES ('$subject', '$comment')";
                         mysqli_query($con, $query);
                    }
                ?>
                <?php include 'fragments/sidebar-nav.php'; ?>
                <!-- /. NAV SIDE  -->
                <div id="page-wrapper" >
                    <div id="page-inner"> 
                        
                    <div class="row">
                        <div class="col-md-12">
                        	<h2 style = "font-family: Cinzel Decorative; color:#000000">Change Schedule</h2>   
                        </div>    
                    </div>
                        
                    <div class="jumbotron">
                        <form class="form-horizontal" action="" method="post">
                          <fieldset>
                            <legend style = "font-family: special elite;">Company Name:  <?php echo $company_name ?></legend>

                             
                                 
                            <div class="form-group">
                              <label for="date" class="col-lg-2 control-label" style = "font-family: milonga;font-size: 110%;">Date</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="date" value="<?php echo $schedqry['date'] ?>">
                              </div>
                            </div>  
                              
                            <div class="form-group">
                              <label for="start_time" class="col-lg-2 control-label" style = "font-family: milonga;font-size: 110%;"> Start Time</label>
                              <div class="col-lg-10">
                                <input type="time" class="form-control" name="start_time" value="<?php echo $schedqry['start_time'] ?>">
                              </div>
                              </div>

                            <div class="form-group">
                              <label for="end_time" class="col-lg-2 control-label" style = "font-family: milonga;font-size: 110%;"> End Time</label>
                              <div class="col-lg-10">
                                <input type="time" class="form-control" name="end_time" value="<?php echo $schedqry['end_time'] ?>">
                              </div>
                              </div>

                            <div class="form-group">
                              <label for="room" class="col-lg-2 control-label" style = "font-family: milonga;font-size: 110%;"> Room</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="room" value="<?php echo $schedqry['room'] ?>">
                              </div>
                              </div>

                            
                                <div class="form-group">
                                  <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                    <button type="submit" name="savesched" class="btn btn-primary" id="savesched" value="submit">Confirm</button>
                                  </div>
                                </div>
                              
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>    