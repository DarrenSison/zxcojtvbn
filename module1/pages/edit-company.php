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
                
                	if(isset($_POST['savecompany'])){
                    	$kiosk = $_SESSION["userAccount"];
                    	$company_id = $_GET['id'];

                        $company_name = $_POST['company_name'];
                        $contact_name = $_POST['contact_name'];
                        $phone = $_POST['phone'];
                        $landline = $_POST['landline'];

                    	include 'fragments/connection.php';

                    	$sql = $pdo->prepare("UPDATE company SET company_name='$company_name', contact_name='$contact_name', phone='$phone', landline='$landline' WHERE company_id='$company_id'");
                        $sql->execute();
                        header("location:index.php");
                    }
                ?>
                <?php include 'fragments/sidebar-nav.php'; ?>
                <!-- /. NAV SIDE  -->
                <div id="page-wrapper" >
                    <div id="page-inner">
                    <?php
                        $company_id = $_GET['id'];
                        
                        //QUERY THE ACCOUNT DATA
                        $qry = $pdo->prepare("SELECT * FROM company WHERE company_id = '$company_id'");
                        $qry->execute();
                        $companyqry = $qry->fetch(); 


                    ?> 
                        
                    <div class="row">
                        <div class="col-md-12">
                        	<h2 style = "font-family: Cinzel Decorative; color:#000000">Edit Company</h2>   
                        </div>    
                    </div>
                        
                    <div class="jumbotron">
                        <form class="form-horizontal" action="" method="post">
                          <fieldset>
                            <legend style = "font-family: special elite;">Company Information</legend>

                             <div class="form-group">
                              <label for="company_name" class="col-lg-2 control-label" style = "font-family: milonga; font-size: 110%;">Company Name</label>

                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="company_id" value="<?php echo $companyqry['company_name'] ?>">
                              </div>
                              </div>     

                            <div class="form-group">
                              <label for="contact_name" class="col-lg-2 control-label" style = "font-family: milonga;font-size: 110%;">Contact</label>

                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="contact_name" value="<?php echo $companyqry['contact_name'] ?>">
                              </div>
                            </div>  
                              
                            <div class="form-group">
                              <label for="phone" class="col-lg-2 control-label" style = "font-family: milonga;font-size: 110%;"> Phone Number</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="phone" value="<?php echo $companyqry['phone'] ?>">
                              </div>
                              </div>

                            
                                <div class="form-group">
                                  <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                    <button type="submit" name="savecompany" class="btn btn-primary" id="savecompany" value="submit">Confirm</button>
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