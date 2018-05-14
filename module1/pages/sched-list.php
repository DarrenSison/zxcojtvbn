<!DOCTYPE html>
<?php
require '../classes/UserAccount.php';
?>
<html lang="en">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Allura|Arima+Madurai|Cinzel+Decorative|Corben|Dancing+Script|Galindo|Gentium+Book+Basic|Great+Vibes|Henny+Penny|Indie+Flower|Kaushan+Script|Kurale|Life+Savers|Love+Ya+Like+A+Sister|Milonga|Miltonian+Tattoo|Niconne|Oregano|Original+Surfer|Pangolin|Parisienne|Philosopher|Princess+Sofia|Rancho|Risque|Salsa|Schoolbell|Special+Elite" rel="stylesheet">		
    </head>
<?php
    include 'fragments/head.php';
?>
<body>
       <?php
        //Start your session
        session_start();
        if (isset($_SESSION['email']) && $_SESSION['email'] == true) {
            echo "You are logged in as, " . $_SESSION['email'] . "!";
        } else {
            header("location: ../login.php");
        }

        function echoActiveClassIfRequestMatches($requestUri){
            $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

            if ($current_file_name == $requestUri)
                echo 'class="active-menu"';
        }

    ?>
    
    <div id="wrapper">
        <?php include 'fragments/page-head.php'; ?>
        <!-- /. NAV TOP  -->
        <?php include 'fragments/sidebar-nav.php'; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style = "font-family: courier new; color:#000000">Registered Users</h1>
                        <?php
                            $id = $_GET['id'];
                            $query = $pdo->prepare("SELECT schedule.schedule_id, company.company_id, company.company_name AS 'company', schedule.date AS 'date', schedule.start_time AS 'start', schedule.end_time AS 'end', schedule.room AS 'room' FROM company INNER JOIN schedule ON company.company_id=schedule.company_id WHERE schedule.schedule_id=$id");
                            $query->execute();
                            $result = $query->fetchAll();

                            foreach($result as $query){
                            $rid = $query['schedule_id'];
                            $rid = $query['company_id'];
                            echo "<h4>";
                            echo " Company: " . $query['company']. "<br>";
                            echo " Date: " . $query['date']. "<br>";
                            echo " Time: " . $query['start'] . "-" . $query['end']. "<br>";
                            echo " Room: " . $query['room'];
                            echo "</h4>";   
                            }
                        ?>
                </div>
                <div class="jumbotron"> 
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" name="anothercontent">
                        <?php
                            include 'fragments/sched-list-query.php';
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>    
