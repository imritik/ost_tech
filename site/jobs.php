<!DOCTYPE html>

<?php
session_start();

if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
include '../dbConfig.php';
  ?>
<html>

<!-- Mirrored from www.coffeecreamthemes.com/themes/jobseek/site/jobs.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:32:44 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title> Job Board </title>
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
                <li class="active"><a href="jobs.php">Jobs</a></li>
                <li><a href="post-a-job.php">Post a job</a></li>
                <li><a href="candidates.php">Candidates</a></li>

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

    <!-- ============ TITLE START ============ -->

    <section id="title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Job Posted</h1>

                </div>
            </div>
        </div>
    </section>

    <!-- ============ TITLE END ============ -->

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="jobs">

<!-- ------------- -->

                          

<?php
// echo $_REQUEST['category'];
$reqcat=$_SESSION['company'];
// Get images from the database
$querycat = $db->query("SELECT * FROM Job_Posting WHERE company_name='$reqcat'");

if($querycat ->num_rows >0){
    while($row = $querycat->fetch_assoc()){
        ?>
                        <!-- Job offer 1 -->
                        <a href="showcandidates.php?jid=<?php echo $row['posting_id']; ?>" target="blank" class="featured applied">
                            <div class="row">
                                <div class="col-md-1 hidden-sm hidden-xs">
                                <!-- <i class="fa fa-link" aria-hidden="true"></i> -->

                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 job-title">
                                    <h5> <?php echo $row['job_title']; ?></h5>
                                    <p><strong><?php echo $row['company_name']; ?></strong> </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 job-location">
                                    <p><strong><?php echo $row['Job_location']; ?></strong></p>
                                    <!-- <p class="hidden-xs">126.3 miles away</p> -->
                                </div>
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs job-type text-center">
                                    <p class="job-salary"><strong>Rs 30,000</strong></p>
                                    <p class="badge full-time"><?php echo $row['Job_type']; ?></p>
                                </div>
                            </div>
                        </a>

                       
    <?php }}
    ?>


                    </div>

                    <nav>
                        <!-- <ul class="pagination">
                            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                        </ul> -->
                    </nav>

                </div>

            </div>
        </div>
    </section>

    <!-- ============ JOBS END ============ -->



    <!-- ============ CONTACT END ============ -->

    <!-- ============ FOOTER START ============ -->

    <footer>
        <div id="prefooter">
            <div class="container">
                <div class="row">
                    <!-- 
                    <div class="col-sm-6" id="social-networks">
                        <h2>Get in touch</h2>
                        <a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-google-plus-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-youtube-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-vimeo-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-pinterest-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                    </div> -->
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

    <!-- ============ LOGIN START ============ -->

    <div class="popup" id="login">
        <div class="popup-form">
            <div class="popup-header">
                <a class="close"><i class="fa fa-remove fa-lg"></i></a>
                <h2>Login</h2>
            </div>
            <form>

                <hr>
                <div class="form-group">
                    <label for="login-username">email</label>
                    <input type="type" class="form-control" id="login-username">
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password">
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>
    </div>

    <!-- ============ LOGIN END ============ -->

    <!-- ============ REGISTER START ============ -->

    <div class="popup" id="register">
        <div class="popup-form">
            <div class="popup-header">
                <a class="close"><i class="fa fa-remove fa-lg"></i></a>
                <h2>Register</h2>
            </div>
            <form>
                <ul class="social-login">
                    <li><a class="btn btn-facebook"><i class="fa fa-facebook"></i>Register with Facebook</a></li>
                    <li><a class="btn btn-google"><i class="fa fa-google-plus"></i>Register with Google</a></li>
                    <li><a class="btn btn-linkedin"><i class="fa fa-linkedin"></i>Register with LinkedIn</a></li>
                </ul>
                <hr>
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name">
                </div>
                <div class="form-group">
                    <label for="register-surname">Surname</label>
                    <input type="text" class="form-control" id="register-surname">
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="register-email">
                </div>
                <hr>
                <div class="form-group">
                    <label for="register-username">Username</label>
                    <input type="text" class="form-control" id="register-username">
                </div>
                <div class="form-group">
                    <label for="register-password1">Password</label>
                    <input type="password" class="form-control" id="register-password1">
                </div>
                <div class="form-group">
                    <label for="register-password2">Repeat Password</label>
                    <input type="password" class="form-control" id="register-password2">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

    <!-- ============ REGISTER END ============ -->

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


</body>

<!-- Mirrored from www.coffeecreamthemes.com/themes/jobseek/site/jobs.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:32:44 GMT -->

</html>