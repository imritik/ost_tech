<!doctype html>

<?php


include '../dbConfig.php';
session_start();

if(isset($_SESSION['stud_id'])){
    // echo $_SESSION['company'];

  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
  
// $_SESSION['stud_id']=1;
// $_SESSION['stud_name']="ritik verma";
?>
<html lang="en">

<!-- Mirrored from www.cssigniter.com/themeforest/specialty/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:30:01 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <title>Home &ndash; Specialty</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/mmenu.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/magnific.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="shortcut icon" href="#">
    <link rel="apple-touch-icon" href="#">
    <link rel="apple-touch-icon" sizes="72x72" href="#">
    <link rel="apple-touch-icon" sizes="114x114" href="#">
</head>

<body>

      <?php
      $notapplied=0;
      $applied=0;
                // echo $_REQUEST['category'];
                $studentid=$_SESSION['stud_id'];

                // Get images from the database
                $querycat = $db->query("SELECT * FROM Offer_table WHERE student_id='$studentid'");
$jobcount=$querycat ->num_rows;
                if($querycat ->num_rows >0){
                    $jobids=array();
                    while($row = $querycat->fetch_assoc()){
                        array_push($jobids,$row['posting_id']);
                    }
                }
                        ?>

    <div id="page">
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mast-head">
                            <h1 class="site-logo">
                                <a href="index.php">
                                    <img src="images/logo-light.png" alt="">
                                </a>
                            </h1>
                            <nav class="nav">
                                <ul class="navigation-main">
                                    <li  id="getappliedjobs" class="menu-item-btn">
                                        <a href="#">Applied Jobs</a>
                                    </li>
                                    <li  id="getnotappliedjobs" class="menu-item-btn" style="display:none">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <!-- <button id="getappliedjobs">Applied Jobs</button> -->
                                   
                                    <li class="menu-item-btn">
                                        <a href="#"><?php echo $_SESSION['stud_name']; ?></a>
                                    </li>
                                    <li class="menu-item-btn">
                                        <a href="../logout.php">Logout</a>
                                    </li>
                                </ul>
                                <!-- #navigation -->

                                <a href="#mobilemenu" class="mobile-nav-trigger">
                                    <i class="fa fa-navicon"></i> Menu
                                </a>
                            </nav>
                            <!-- #nav -->

                            <div id="mobilemenu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-hero page-hero-lg" style="background-image: url(images/hero-1.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-hero-content">
                            <h2 class="page-title">
                                <span class="text-theme">Work there.</span> Find the dream job
                                <br> you’ve always wanted.
                            </h2>
                            <p class="page-subtitle">
                                <span class="text-theme"><?php echo $jobcount; ?></span>  jobs offered in the last
                                <!-- <span class="text-theme">7</span> days. Search now. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="https://www.cssigniter.com/" class="form-filter">
                <div class="form-filter-header">
                    <a href="#" class="form-filter-dismiss">&times;</a>
                </div>

                
            </form>
        </div>


        <!-- ------php code for storing jobs id and getting jobs count---- -->


<!-- ------------- -->

                          

              




        <!-- ------------------------------------------ -->

        <main class="main">
            <div class="container">
                <div class="row notappliedjobsdiv">
                    <div class="col-xl-12 col-lg-12 col-xs-12">
                        <h3 class="section-title">
                            <b><span id="newjob"></span></b>&nbsp;New Job(s) Found</h3>

                        <div class="item-listing">
                            

                            <!-- ----fetching jobs offered---- -->


                              <?php
                            
if(sizeof($jobids)){

    $arrlength = count($jobids);

    for($x = 0; $x < $arrlength; $x++) {
    

    // Get images from the database
    $query = $db->query("SELECT * FROM Job_Posting WHERE posting_id='$jobids[$x]' and NOT EXISTS
    (SELECT *
     FROM   applied_table
     WHERE  posting_id ='$jobids[$x]' and student_id='$studentid')");

    if($query ->num_rows ==1){
        $row1 = $query->fetch_assoc();
        $notapplied=$notapplied+1;
        
       ?>
  


    <div class="list-item">
        <div class="list-item-main-info">
            <p class="list-item-title">
                <a href="single-job.php?jpi=<?php echo $jobids[$x]; ?>&apl=4hvt" target="blank" ><?php echo $row1['job_title']; ?> </a>
            </p>

            <div class="list-item-meta">
                <a href="#" class="list-item-tag item-badge job-type-contract"><?php echo $row1['Job_type']; ?></a>
                <span class="list-item-company"><?php echo $row1['company_name']; ?></span>
            </div>
        </div>

        <div class="list-item-secondary-info">
            <p class="list-item-location"><?php echo $row1['Job_location']; ?></p>
            <time class="list-item-time" datetime="2017-01-01"><?php echo $row1['posting_time']; ?></time>
        </div>
    </div>


<?php 
}}
?>
<?php
}
else{
    echo "No job offered";
}
?>


                        </div>
                    </div>
                    

                </div>
            </div>
    </div>
    </div>


    <!-- --------------------------------------------------------------------------- -->
<div class="container">
    <div class="row appliedjobsdiv" style="display:none;margin-top:-50px" >


    <div class="col-xl-12 col-lg-12 col-xs-12">
                        <h3 class="section-title">
                            <b><span id="appliedjob"></span></b>&nbsp;Applied Job(s) Found.</h3>

                        <div class="item-listing">
                            

                            <!-- ----fetching jobs offered---- -->


                              <?php
                            
if(sizeof($jobids)){

    $arrlength = count($jobids);

    for($x = 0; $x < $arrlength; $x++) {
    

    // Get images from the database
    $query = $db->query("SELECT * FROM Job_Posting WHERE posting_id='$jobids[$x]' and EXISTS
    (SELECT *
     FROM   applied_table
     WHERE  posting_id ='$jobids[$x]' and student_id='$studentid')");

    if($query ->num_rows ==1){
        $row1 = $query->fetch_assoc();
        $applied=$applied+1;
        
       ?>
  


    <div class="list-item">
        <div class="list-item-main-info">
            <p class="list-item-title">
                <a href="single-job.php?jpi=<?php echo $jobids[$x]; ?>&apl=5a" target="blank" ><?php echo $row1['job_title']; ?> </a>
            </p>

            <div class="list-item-meta">
                <a href="#" class="list-item-tag item-badge job-type-contract"><?php echo $row1['Job_type']; ?></a>
                <span class="list-item-company"><?php echo $row1['company_name']; ?></span>
            </div>
        </div>

        <div class="list-item-secondary-info">
            <p class="list-item-location"><?php echo $row1['Job_location']; ?></p>
            <time class="list-item-time" datetime="2017-01-01"><?php echo $row1['posting_time']; ?></time>
        </div>
    </div>


<?php 
}}
?>
<?php
}
else{
    echo "You have not applied for any job yet!";
}
?>


                        </div>
                    </div>
                    

                </div>
            </div>
    </div>
    
    
    </div>
    </div>
    </div>
    </main>

    <footer class="footer">
        <div class="container">
            <!-- <div class="row">
                <div class="col-xs-12">

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-xs-12">
                            <aside class="widget widget_text group">
                                <h3 class="widget-title">Text Widget</h3>
                                <p>Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in blandit. Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante. Nulla at nulla justo, eget luctus tortor.
                                    Nulla facilisi. Duis aliquet egestas purus.</p>
                            </aside>
                             /widget
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <aside class="widget widget_categories group">
                <h3 class="widget-title">Widget Title</h3>
                <ul>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#">Terms &amp; Conditions</a>
                    </li>
                    <li>
                        <a href="#">Careers</a>
                    </li>
                    <li>
                        <a href="#">History</a>
                    </li>
                    <li>
                        <a href="#">Disclaimer</a>
                    </li>
                </ul>
            </aside>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <aside class="widget widget_categories group">
                <h3 class="widget-title">Widget Title</h3>
                <ul>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#">Terms &amp; Conditions</a>
                    </li>
                    <li>
                        <a href="#">Careers</a>
                    </li>
                    <li>
                        <a href="#">History</a>
                    </li>
                    <li>
                        <a href="#">Disclaimer</a>
                    </li>
                </ul>
            </aside>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">

            <aside class="widget widget_ci_social_widget ci-socials group">
                <h3 class="widget-title">Socials</h3>

                <ul class="list-social-icons">
                    <li>
                        <a class="social-icon" href="#">
                            <i class="fa fa-rss"></i>
                        </a>
                    </li>
                    <li>
                        <a class="social-icon" href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a class="social-icon" href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="social-icon" href="#">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </li>
                    <li>
                        <a class="social-icon" href="#">
                            <i class="fa fa-vimeo"></i>
                        </a>
                    </li>
                    <li>
                        <a class="social-icon" href="#">
                            <i class="fa fa-medium"></i>
                        </a>
                    </li>
                </ul>
            </aside>
        </div>
        </div> -->

            <div class="footer-copy">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <p>
                            <a href="#">Specialty</a> &ndash; Job Board
                            <a href="https://www.cssigniter.com/ignite" target="_blank"></a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </div>
    </footer>
    </div>
    <!-- #page -->


    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/jquery.mmenu.min.all.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/jquery.matchHeight.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scripts.js"></script>


    <script>
    $(document).ready(function(){
        $('#newjob').html(<?php echo $notapplied; ?>);
        $('#appliedjob').html(<?php echo $applied; ?>);

        $('#getappliedjobs').click(function(){

            // alert("jjjjjj");

            $('.notappliedjobsdiv').hide();
            $('.appliedjobsdiv').show();
            $('#getappliedjobs').hide();
            $('#getnotappliedjobs').show();


        });


        $('#getnotappliedjobs').click(function(){

            // alert("jjjjjj");

            // $('.notappliedjobsdiv').hide();
            // $('.appliedjobsdiv').show();
            $('#getappliedjobs').show();
            $('#getnotappliedjobs').hide();


            });
    });
    
    </script>

</body>


</html>