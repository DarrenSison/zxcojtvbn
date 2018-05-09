<!-- /. NAV SIDE  -->

<?php
    require_once 'connection.php'; 
    
    $query = $pdo->prepare("SELECT * FROM user WHERE email='".$_SESSION['email']."';");
    $query->execute();
    $print = $query->fetch();
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Allura|Arima+Madurai|Cinzel+Decorative|Corben|Dancing+Script|Galindo|Gentium+Book+Basic|Great+Vibes|Henny+Penny|Indie+Flower|Kaushan+Script|Kurale|Life+Savers|Love+Ya+Like+A+Sister|Milonga|Miltonian+Tattoo|Niconne|Oregano|Original+Surfer|Pangolin|Parisienne|Philosopher|Princess+Sofia|Rancho|Risque|Salsa|Schoolbell|Special+Elite" rel="stylesheet">		
    </head>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

        <li  style ="font-family: Cinzel Decorative;">
            <a href="index.php"  style ="font-family: Cinzel Decorative; font-size:18px"><i class="fa fa-eye" ></i> View<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li style ="font-family: Cinzel Decorative;">
                    <a  href=index.php><i class="fa fa-building-o fa-3x"></i>Companies</a>
                </li>
                <li style ="font-family: Cinzel Decorative;">
                    <a href="sched.php"><i class="fa fa-calendar fa-3x"></i>Schedules</a>
                </li>
            </ul>            
        </li>

        <li  style ="font-family: Cinzel Decorative;">
            <a href="company-add.php"  style ="font-family: Cinzel Decorative; font-size:18px"><i class="fa fa-plus" ></i> Add<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li style ="font-family: Cinzel Decorative;">
                    <a  href="company-add.php"><i class="fa fa-building-o fa-3x"></i>Add Company</a>
                </li>
                <li style ="font-family: Cinzel Decorative;">
                    <a href="schedule-add.php"><i class="fa fa-calendar fa-3x"></i>Add Schedule</a>
                </li>
            </ul>            
        </li>

        <li  style ="font-family: Cinzel Decorative;">
            <a href="users.php"  style ="font-family: Cinzel Decorative; font-size:18px"><i class="fa fa-user" ></i> Accounts<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li style ="font-family: Cinzel Decorative;">
                    <a  href="users.php"><i class="fa fa-user fa-3x"></i>Manage Accounts</a>
                </li>
            </ul>            
        </li>
        <li style ="font-family: Cinzel Decorative;">
            
        </li>			
        </ul>
    </div>
</nav> 
</html>