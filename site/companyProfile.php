<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
// $cname=$_SESSION['company'];
$companyId=$_GET['cpid'];
$compname='';
$compdesc='';
include '../dbConfig.php';
?>
<html>
<head>
<meta charset="utf-8">

    <title>Profile </title>
    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- -----multiselect part-- -->
   
   <!-- -------candidates css -->

   
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
                    <a href="#"><img src="images/logo.png" alt="Talentchords" /></a>
                </div>
            </div>
            <div id="menu-open" class="pull-right">
                <!-- <a class="fm-button"><i class="fa fa-bars fa-lg"></i></a> -->
            </div>

        </div>
    </header>

    <!-- ============ HEADER END ============ -->

    <!-- ============ TITLE START ============ -->
    <?php

                        $sql = "SELECT * FROM employer_account where email='$companyId'";
                        $result = $db->query($sql);

                        if ($result ->num_rows ==1) {
                        
                            while($row1 = $result->fetch_assoc()) {
                                $compname=$row1['company_name'];
                                $compdesc=$row1['description'];

                                ?>
 <section id="title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    
                    <h2><?php echo $compname ;?></h2>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ TITLE END ============ -->

    <!-- ============ CONTENT START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <article>
                        <h2>About this company</h2>
                        <p>
                            <?php echo $compdesc; ?>
                        </p>
                        <hr>
                     
                        <hr>
                        <!-- <h2>Jobs</h2>

                        <div class="jobs">

                            <a href="#">
                                <div class="featured"></div>
                                <img src="images/job1.jpg" alt="" class="img-circle" />
                                <div class="title">
                                    <h5>Web Designer</h5>
                                    <p>Amazon Inc.</p>
                                </div>
                                <div class="data">
                                    <span class="city"><i class="fa fa-map-marker"></i>New York City</span>
                                    <span class="type full-time"><i class="fa fa-clock-o"></i>Full Time</span>
                                    <span class="sallary"><i class="fa fa-dollar"></i>45,000</span>
                                </div>
                            </a>

                        </div> -->

                    </article>
                </div>
                <div class="col-sm-4" id="sidebar">
                    <div class="sidebar-widget" id="share">
                        <h2>Company Profile</h2>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="sidebar-widget" id="widget-contact">
                        <h2>Contact</h2>
                        <ul>
                            <li><i class="fa fa-building"></i>Netvibes</li>
                            <li><i class="fa fa-map-marker"></i>2 Madison Avenue</li>
                            <li><i class="fa"></i>New York City, 29478 USA</li>
                            <li><i class="fa fa-phone"></i>01.22.987.8392</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>


                                <?php
                            }
                        }
                        else{
                             header("location: ../index.php");
                        }

    ?>

   

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
                        &copy; Job Board
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ============ FOOTER END ============ -->

 
  
    <!-- Modernizr Plugin -->
    <script src="js/modernizr.custom.79639.js"></script>
    <!-- jQuery (ecessary for Bootstrap's JavaScript plugins) -->
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

</body>


</html>