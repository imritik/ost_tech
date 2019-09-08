<!DOCTYPE html>
<?php
session_start();
// $_SESSION['email']="ritikvverma@gmail.com";
// $_SESSION['company']="XYZ";
// $_SESSION['url']="abc.com";
if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
  ?>


<html>

<!-- Mirrored from www.coffeecreamthemes.com/themes/jobseek/site/post-a-job.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:32:44 GMT -->

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
                <li class="active"><a href="post-a-job.html">Post a job</a></li>
                <li class="active"><a href="jobs.php">Jobs</a></li>
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

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12">
                    <h1>Post a Job</h1>
                    <h4>Find a Right Candidate</h4>

                </div>
            </div>
            <br>

            <form  action="post.php" method="post">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h2>Job Details</h2>
                        <div class="form-group" id="job-email-group">
                            <label for="job-email">Email</label>
                            <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" value=<?php echo $_SESSION['emailemp'] ;?> required>
                        </div>
                        <div class="form-group" id="job-title-group">
                            <label for="job-title">Title</label>
                            <input type="text" name="title" class="form-control" id="job-title" placeholder="e.g. Web Designer" required>
                        </div>
                        <div class="form-group" id="job-location-group">
                            <label for="job-location">Location (Optional)</label>
                            <input type="text" name="location" class="form-control" id="job-location" placeholder="e.g. New York" required>
                        </div>
                        <!-- <div class="form-group" id="job-region-group">
                            <label for="job-region">Region</label>
                            <select class="form-control" id="job-region">
									<option>Choose a region</option>
									<option>New York</option>
									<option>Los Angeles</option>
									<option>Chicago</option>
									<option>Boston</option>
									<option>San Francisco</option>
								</select>
                        </div> -->
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
                        <div class="form-group" id="job-category-group">
                            <label for="job-category">Job Category</label>
                            <select class="form-control" name="category" id="job-category" required>
									<option>Choose a job category</option>
									<option>Internet Services</option>
									<option>Banking</option>
									<option>Financial</option>
									<option>Marketing</option>
									<option>Management</option>
								</select>
                        </div>
                        <div class="form-group" id="job-description-group">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description" id="job-description" required></textarea>
                        </div>
                        <!-- <div class="form-group" id="job-url-group">
                            <label for="job-url">Application Email/URL</label>
                            <input type="text" class="form-control" id="job-url" placeholder="Email or Website URL">
                        </div> -->
                    </div>
                    <!-- <div class="col-sm-6">
                        <h2>Company Details</h2>
                        <div class="form-group" id="company-name-group">
                            <label for="company-name">Company Name</label>
                            <input type="text" class="form-control" id="company-name" placeholder="Enter company name" value= <?php echo $_SESSION['company'] ;?> readonly>
                        </div>

                        <div class="form-group" id="company-description-group">
                            <label for="company-description">Description (Optional)</label>
                            <div class="textarea form-control" id="company-description"></div>
                        </div>

                        <div class="form-group" id="company-website-group">
                            <label for="company-website">Website (Optional)</label>
                            <input type="text" class="form-control" id="company-website" placeholder="http://">
                        </div>

                        <div class="form-group" id="company-email-group">
                            <label for="company-email">Official Mail</label>
                            <input type="email" class="form-control" id="company-email" placeholder="abc@company.com">
                        </div>


                        <div class="form-group" id="company-linkedin-group">
                            <label for="company-linkedin">LinkedIn Username (Optional)</label>
                            <input type="text" class="form-control" id="company-linkedin" placeholder="yourcompany">
                        </div>

                        <div class="form-group" id="company-logo-group">
                            <label for="company-logo">Logo (Optional)</label>
                            <input type="file" id="company-logo">
                        </div>
                    </div> -->
                </div>
                <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Post <i class="fa fa-arrow-right"></i></button>
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
                    <label for="login-username">Username</label>
                    <input type="text" class="form-control" id="login-username">
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


</html>