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
                        <h1 style = "font-family: courier new; color:#000000">Accounts</h1>
                </div>
                <div class="jumbotron"> 
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" name="anothercontent">
                        <?php
                            include 'fragments/user-query.php';
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>    
