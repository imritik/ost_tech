<!DOCTYPE html>
<?php
session_start();
include '../dbConfig.php';
// $_SESSION['email']="ritikvverma@gmail.com";
// $_SESSION['company']="XYZ";
// $_SESSION['url']="abc.com";
if(isset($_SESSION['emailemp'])){
  }
  else{
    header("location: ../index.php");
  }
  ?>


<html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title> Job Board
    </title>
    <link rel="shortcut icon" href="images/favicon.png">

    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->

</head>

<body>

    <!-- ============ PAGE LOADER START ============ -->

    <div id="loader">
        <i class="fa fa-cog fa-4x fa-spin"></i>
    </div>

    <!-- ============ PAGE LOADER END ============ -->

    <!-- ============ NAVBAR START ============ -->

    <div class="fm-container">
        <!-- Menu -->
        <div class="menu">
            <div class="button-close text-right">
                <a class="fm-button"><i class="fa fa-close fa-2x"></i></a>
            </div>
            <ul class="nav">
                <!-- <li><a href="#home">Home</a></li> -->
                <li class="active"><a href="post-a-job.php">Post a job</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="candidates.php">Push Jobs</a></li>
                <li><a href="linkedinCandidates.php">Push Jobs(Linkedin)</a></li>

                <!-- <li><a href="csv_v2/index.php" target="blank">Add Candidates</a></li> -->
                <!-- <li><a href="import-csv/index.php" target="blank">Add Company</a></li> -->
                <li><a href="sendmails.php">Send Mails</a></li> 
                 <li><a href="dashboard.php">Dashboard</a></li>
                 <li><a href="showadmins.php">Admin details</a></li>
                

                <!-- <li><a class="link-register">Register</a></li> -->
                <li><a class="link-login" href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <!-- end Menu -->
    </div>

    <!-- ============ NAVBAR END ============ -->

    <!-- ============ HEADER START ============ -->

    <header>
        <div id="header-background"></div>
        <div class="container">
            <div class="pull-left">
                <div id="logo">
                    <a href="#"><img src="images/logo.png" alt="Jobseek - Job Board Responsive HTML Template" /></a>
                </div>
            </div>
            <div id="menu-open" class="pull-right">
                <a class="fm-button"><i class="fa fa-bars fa-lg"></i></a>
            </div>

        </div>
    </header>

    <!-- ============ HEADER END ============ -->

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
        <a href="exportjobs.php" class="btn btn-success btn-xs">Export Jobs</a>
        <a href="exportcompanies.php" class="btn btn-success btn-xs pull-right">Export Companies</a>


            <div class="row text-center">

                <div class="col-sm-12">
                    <h1>Post a Job</h1>
                    <h4>Find a Right Candidate</h4>
                 
                    <?php
// Load the database configuration file
// include_once 'dbConfig.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
                </div>
            </div>
            <br>
<div class="row">
<div class="col-sm-6">
<div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="csv_v2/importjobs.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filejobs" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmitjobs" value="IMPORT">
        </form>
        <br>
    </div>

<form  action="post.php" method="post">
                <div class="row">
                    <div class="col-sm-10">
                        <h2>Job Details(<span style="font-size:15px;"> <a href="javascript:void(0);"  onclick="formToggle('importFrm');"><i class="plus"></i>Upload csv</a></span>)</h2>
 





                        <div class="form-group" id="job-company-group">
                            <label for="job-email">Company Name</label>
                            <!-- <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" required> -->
<select class="form-control" name="companyname" id="job-company">

 <option value="" >Select Company</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM employer_account");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['company_name'] .'$'.$row['email'] .'$'.$row['url']. '">' . $row['company_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>
                        </div>
                        <div class="form-group" id="job-email-group">
                            <label for="job-email">Email</label>
                            <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" readonly required>
                        </div>
                        <div class="form-group" id="job-title-group">
                            <label for="job-title">Title</label>
                            <input type="text" name="title" class="form-control" id="job-title" placeholder="e.g. Web Designer" required>
                        </div>
                        <div class="form-group" id="job-location-group">
                            <label for="job-location">Location (Optional)</label>
                            <input type="text" name="location" class="form-control" id="job-location" placeholder="e.g. New York" required>
                        </div>
                       
                        <div class="form-group" id="job-type-group">
                            <label for="job-type">Job Type</label>
                            <select class="form-control" name="type" id="job-type" required>
									<option>Choose a job type</option>
									<option>Freelance</option>
									<option>Part Time</option>
									<option>Full Time</option>
									<option>Internship</option>
									<option>Volunteer</option>
								</select>
                        </div>
                       
                        <div class="form-group" id="job-description-group">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description" id="job-description" maxlength="2000" required></textarea>
                        </div>
                        <div class="form-group" id="job-url-group">
                            <label for="job-url">Website (Optional)</label>
                            <input type="text" name="weburl" class="form-control" id="job-url" placeholder="https://" readonly required>
                        </div>
                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Post <i class="fa fa-arrow-right"></i></button>
                </div>
                    </div>
             </div>
              
            </form>
</div>


<!-- -----------company profile--- -->
<div class="col-sm-6">
<div class="col-md-12" id="importFrm1" style="display: none;">
    <br>
        <form action="csv_v2/importcompany.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filecompany" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmitcompany" value="IMPORT">
        </form>
        <br>
    </div>
            <form  action="addcompany.php" method="post" enctype="multipart/form-data" >
                        <h2>Company Details(<span style="font-size:15px;"> <a href="javascript:void(0);"  onclick="formToggle1('importFrm1');"><i class="plus"></i>Upload csv</a></span>)</h2>
       
                        <div class="form-group" id="company-name-group">
                            <label for="company-name">Company Name</label>
                            <input type="text" class="form-control" name="companyname" id="company-name" placeholder="Enter company name" required>
                        </div>

                        <div class="form-group" id="company-description-group">
                            <label for="company-description">Description (Optional)</label>
                          
                            <!-- <div class="textarea form-control" name="companydescription" id="company-description" required></div> -->
                            <textarea class="textarea form-control" name="companydescription" id="company-description" maxlength="2000" required></textarea>
                        
                        </div>

                        <div class="form-group" id="company-website-group">
                            <label for="company-website">Website (Optional)</label>
                            <input type="text" class="form-control" name="companywebsite" id="company-website" placeholder="http://" required>
                        </div>

                        <div class="form-group" id="company-email-group">
                            <label for="company-email">Official Mail</label>
                            <input type="email" class="form-control" name="companyemail" id="company-email" placeholder="abc@company.com" required>
                        </div>



                        <div class="form-group" id="company-logo-group">
                            <label for="company-logo">Logo</label>
                            <input type="file" name="companylogo" id="company-logo">
                        </div> 
                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit_company" class="btn btn-primary btn-lg">Add company <i class="fa fa-arrow-right"></i></button>
                </div>

            </form>

        </div>
    </section>

    <!-- ============ JOBS END ============ -->

    <!-- ============ CONTACT START ============ -->


    <!-- ============ FOOTER START ============ -->

    <footer>
        <div id="prefooter">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div>
        <div id="credits">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        &copy; 2019 job Board
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ============ FOOTER END ============ -->

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
function formToggle1(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
  


    <!-- Modernizr Plugin -->
    <script src="js/modernizr.custom.79639.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>

    <!-- Bootstrap Plugins -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Retina Plugin -->
    <script src="js/retina.min.js"></script>

    <!-- ScrollReveal Plugin -->
    <script src="js/scrollReveal.min.js"></script>

    <!-- Flex Menu Plugin -->
    <script src="js/jquery.flexmenu.js"></script>

    <!-- Slider Plugin -->
    <script src="js/jquery.ba-cond.min.js"></script>
    <script src="js/jquery.slitslider.js"></script>

    <!-- Carousel Plugin -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Parallax Plugin -->
    <script src="js/parallax.js"></script>

    <!-- Counterup Plugin -->
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>

    <!-- No UI Slider Plugin -->
    <script src="js/jquery.nouislider.all.min.js"></script>

    <!-- Bootstrap Wysiwyg Plugin -->
    <script src="js/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- Flickr Plugin -->
    <script src="js/jflickrfeed.min.js"></script>

    <!-- Fancybox Plugin -->
    <script src="js/fancybox.pack.js"></script>

    <!-- Magic Form Processing -->
    <script src="js/magic.js"></script>

    <!-- jQuery Settings -->
    <script src="js/settings.js"></script>

        <script>
                $('#job-company').change(function(){
            alert(this.value);
            var output=this.value;
            var cname=output.split('$')[0];
            var cemail=output.split('$')[1];
            var cweburl=output.split('$')[2];
            // alert(cemail);
            $('#job-email').val(cemail);
            $('#job-url').val(cweburl);
                });
               
            
    </script>



</body>


</html>