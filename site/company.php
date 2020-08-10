<!DOCTYPE html>
<html>

<!-- Mirrored from www.coffeecreamthemes.com/themes/jobseek/site/company.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:32:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title>Jobseek - Job Board Responsive HTML Template</title>
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
                <li><a href="jobs.html">Jobs</a></li>
                <li><a href="post-a-job.html">Post a job</a></li>
                <li><a href="candidates.html">Candidates</a></li>
                <li><a href="post-a-resume.html">Post a Resume</a></li>
                <li><a href="#">Pages</a>
                    <ul>
                        <li><a href="job-details.html">Job Details</a></li>
                        <li><a href="resume.html">Resume</a></li>
                        <li class="active"><a href="company.html">Company</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="post.html">Single Post</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="testimonials.html">Testimonials</a></li>
                        <li><a href="options.html">Options</a></li>
                    </ul>
                </li>
                <li><a class="link-register">Register</a></li>
                <li><a class="link-login">Login</a></li>
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
                    <a href="index-2.html"><img src="images/logo.png" alt="Jobseek - Job Board Responsive HTML Template" /></a>
                </div>
            </div>
            <div id="menu-open" class="pull-right">
                <a class="fm-button"><i class="fa fa-bars fa-lg"></i></a>
            </div>
            <div id="searchbox" class="pull-right">
                <form>
                    <div class="form-group">
                        <label class="sr-only" for="searchfield">Searchbox</label>
                        <input type="text" class="form-control" id="searchfield" placeholder="Type keywords and press enter">
                    </div>
                </form>
            </div>
            <div id="search" class="pull-right">
                <a><i class="fa fa-search fa-lg"></i></a>
            </div>
        </div>
    </header>

    <!-- ============ HEADER END ============ -->

    <!-- ============ TITLE START ============ -->

    <section id="title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <img src="images/client-logo-big.gif" class="img-responsive" alt="" />
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
                        <p>Maecenas mollis dictum lectus quis scelerisque. Nulla at rutrum ipsum. Praesent augue quam, facilisis vitae felis vel, convallis convallis nisi. Donec maximus accumsan purus vel tempus. Aenean pretium luctus velit id fermentum.
                            Aenean non velit non nulla interdum venenatis. Integer in libero sagittis, consequat est quis, commodo odio. Aliquam eu vulputate neque. Nunc et massa leo. Vestibulum a pretium dolor. Proin et fermentum sapien. Cras malesuada
                            neque ac purus fermentum, a placerat quam malesuada. Quisque sollicitudin tellus a ex eleifend mattis. In vitae ipsum in mauris vestibulum imperdiet.</p>
                        <p>Maecenas mollis dictum lectus quis scelerisque. Nulla at rutrum ipsum. Praesent augue quam, facilisis vitae felis vel, convallis convallis nisi. Donec maximus accumsan purus vel tempus. Aenean pretium luctus velit id fermentum.
                            Aenean non velit non nulla interdum venenatis. Integer in libero sagittis, consequat est quis, commodo odio. Aliquam eu vulputate neque. Nunc et massa leo. Vestibulum a pretium dolor. Proin et fermentum sapien. Cras malesuada
                            neque ac purus fermentum, a placerat quam malesuada. Quisque sollicitudin tellus a ex eleifend mattis. In vitae ipsum in mauris vestibulum imperdiet.</p>
                        <hr>
                        <h2>Location</h2>


                        <!-- Google Map Script -->
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
                        <script type="text/javascript">
                            function initialize() {
                                //-----------------------------------------------------------------------
                                // Create an array of styles.

                                var styles = [{
                                    "stylers": [{
                                        "saturation": -100
                                    }, {
                                        "gamma": 1
                                    }]
                                }, {
                                    "featureType": "water",
                                    "stylers": [{
                                        "lightness": -12
                                    }]
                                }];

                                //-----------------------------------------------------------------------
                                // Create a new StyledMapType object, passing it the array of styles,
                                // as well as the name to be displayed on the map type control.

                                var styledMap = new google.maps.StyledMapType(styles, {
                                    name: "Styled Map"
                                });

                                //-----------------------------------------------------------------------
                                // Set up map pin position

                                var latlng = new google.maps.LatLng(40.742284, -73.987866);

                                //-----------------------------------------------------------------------
                                // Set up map options

                                var myOptions = {
                                    scrollwheel: false,
                                    zoom: 13,
                                    center: latlng,
                                    mapTypeControlOptions: {
                                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                                    }
                                };

                                //-----------------------------------------------------------------------
                                // Set up map ID's

                                var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

                                //-----------------------------------------------------------------------
                                // Associate the styled map with the MapTypeId and set it to display.

                                map.mapTypes.set('map_style', styledMap);
                                map.setMapTypeId('map_style');

                                //-----------------------------------------------------------------------
                                // Setup up map pin image

                                var image = {
                                    // Path to your map pin image
                                    url: 'images/map-marker.png',
                                    // This marker is 40 pixels wide by 42 pixels tall.
                                    size: new google.maps.Size(40, 42),
                                    // The origin for this image is 0,0.
                                    origin: new google.maps.Point(0, 0),
                                    // The anchor for this image is the base of the pin at 20,42.
                                    anchor: new google.maps.Point(20, 42)
                                };

                                //-----------------------------------------------------------------------
                                // Add marker

                                var myMarker = new google.maps.Marker({
                                    position: latlng,
                                    map: map,
                                    icon: image,
                                    clickable: true,
                                    title: "Netvibes Inc."
                                });

                                myMarker.info = new google.maps.InfoWindow({
                                    content: "<b>Netvibes Inc.</b><br>2 Madison Avenue<br>New York City, 29478 USA"
                                });

                                google.maps.event.addListener(myMarker, 'click', function() {
                                    myMarker.info.open(map, myMarker);
                                });
                            }

                            google.maps.event.addDomListener(window, 'load', initialize);
                        </script>

                        <div id="map-canvas"></div>

                        <hr>
                        <h2>Jobs</h2>

                        <div class="jobs">

                            <!-- Job Shared 1 -->
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

                            <!-- Job Shared 2 -->
                            <a href="#">
                                <div class="featured"></div>
                                <img src="images/job2.jpg" alt="" class="img-circle" />
                                <div class="title">
                                    <h5>Senior Web Developer</h5>
                                    <p>Dropbox Inc.</p>
                                </div>
                                <div class="data">
                                    <span class="city"><i class="fa fa-map-marker"></i>Los Angeles</span>
                                    <span class="type part-time"><i class="fa fa-clock-o"></i>Part Time</span>
                                    <span class="sallary"><i class="fa fa-dollar"></i>85,000</span>
                                </div>
                            </a>

                            <!-- Job Shared 3 -->
                            <a href="#">
                                <img src="images/job3.jpg" alt="" class="img-circle" />
                                <div class="title">
                                    <h5>Project Manager</h5>
                                    <p>Apple Inc.</p>
                                </div>
                                <div class="data">
                                    <span class="city"><i class="fa fa-map-marker"></i>San Francisco</span>
                                    <span class="type freelance"><i class="fa fa-clock-o"></i>Freelance</span>
                                    <span class="sallary"><i class="fa fa-dollar"></i>60,000</span>
                                </div>
                            </a>

                            <!-- Job Shared 4 -->
                            <a href="#">
                                <img src="images/job4.jpg" alt="" class="img-circle" />
                                <div class="title">
                                    <h5>Key Account Manager</h5>
                                    <p>Dell Inc.</p>
                                </div>
                                <div class="data">
                                    <span class="city"><i class="fa fa-map-marker"></i>Boston</span>
                                    <span class="type full-time"><i class="fa fa-clock-o"></i>Full Time</span>
                                    <span class="sallary"><i class="fa fa-dollar"></i>55,000</span>
                                </div>
                            </a>

                            <!-- Job Shared 5 -->
                            <a href="#">
                                <img src="images/job5.jpg" alt="" class="img-circle" />
                                <div class="title">
                                    <h5>Front End Developer</h5>
                                    <p>Ebay Inc.</p>
                                </div>
                                <div class="data">
                                    <span class="city"><i class="fa fa-map-marker"></i>Chicago</span>
                                    <span class="type part-time"><i class="fa fa-clock-o"></i>Part Time</span>
                                    <span class="sallary"><i class="fa fa-dollar"></i>75,000</span>
                                </div>
                            </a>

                            <!-- Job Shared 6 -->
                            <a href="#">
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

                        </div>

                    </article>
                </div>
                <div class="col-sm-4" id="sidebar">
                    <div class="sidebar-widget" id="share">
                        <h2>Share it</h2>
                        <ul>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.coffeecreamthemes.com/themes/jobseek/site/job-details.html"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/home?status=http://www.coffeecreamthemes.com/themes/jobseek/site/job-details.html"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/share?url=http://www.coffeecreamthemes.com/themes/jobseek/site/job-details.html"><i class="fa fa-google-plus"></i></a></li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http://www.coffeecreamthemes.com/themes/jobseek/site/job-details.html&amp;title=Jobseek%20-%20Job%20Board%20Responsive%20HTML%20Template&amp;summary=&amp;source="><i class="fa fa-linkedin"></i></a>
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
                            <li><i class="fa fa-envelope"></i><a href="mailto:company@yourdomain.com">Send an email</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ CONTENT END ============ -->

    <!-- ============ CONTACT START ============ -->

    <section id="contact" class="color2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Drop us a line</h2>
                    <form role="form" name="contact-form" id="contact-form" action="http://www.coffeecreamthemes.com/themes/jobseek/site/process.php">
                        <div class="form-group" id="contact-name-group">
                            <label for="contact-name" class="sr-only">Name</label>
                            <input type="text" class="form-control" id="contact-name" placeholder="Name">
                        </div>
                        <div class="form-group" id="contact-email-group">
                            <label for="contact-email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="contact-email" placeholder="Email">
                        </div>
                        <div class="form-group" id="contact-subject-group">
                            <label for="contact-subject" class="sr-only">Subject</label>
                            <input type="text" class="form-control" id="contact-subject" placeholder="Subject">
                        </div>
                        <div class="form-group" id="contact-message-group">
                            <label for="contact-message" class="sr-only">Message</label>
                            <textarea class="form-control" rows="3" id="contact-message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h2>Visit our office</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>New York</h5>
                            <p>5 Park Avenue<br> New York, NY 10016<br> USA
                            </p>
                            <p><i class="fa fa-phone"></i>+1 718.242.5555<br>
                                <i class="fa fa-fax"></i>+1 718.242.5556<br>
                                <i class="fa fa-envelope"></i><a href="mailto:ny@jobseek.com">ny@jobseek.com</a></p>
                            <p><i class="fa fa-clock-o"></i>Mon-Fri 9am - 5pm<br>
                                <i class="fa fa-clock-o"></i>Sat 10am - 2pm<br>
                                <i class="fa fa-clock-o"></i>Sun Closed</p>
                        </div>
                        <div class="col-sm-6">
                            <h5>Los Angeles</h5>
                            <p>8605 Santa Monica Blvd<br> Los Angeles, CA 90069-4109<br> USA
                            </p>
                            <p><i class="fa fa-phone"></i>+1 985.562.5555<br>
                                <i class="fa fa-fax"></i>+1 985.562.5556<br>
                                <i class="fa fa-envelope"></i><a href="mailto:la@jobseek.com">la@jobseek.com</a></p>
                            <p><i class="fa fa-clock-o"></i>Mon-Fri 9am - 5pm<br>
                                <i class="fa fa-clock-o"></i>Sat 10am - 2pm<br>
                                <i class="fa fa-clock-o"></i>Sun Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ CONTACT END ============ -->

    <!-- ============ FOOTER START ============ -->

    <footer>
        <div id="prefooter">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" id="newsletter">
                        <h2>Newsletter</h2>
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="newsletter-email">Email address</label>
                                <input type="email" class="form-control" id="newsletter-email" placeholder="Email address">
                            </div>
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </form>
                    </div>
                    <div class="col-sm-6" id="social-networks">
                        <h2>Get in touch</h2>
                        <a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-google-plus-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-youtube-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-vimeo-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-pinterest-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="credits">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        &copy; 2015 Jobseek - Responsive Job Board HTML Template<br> Designed &amp; Developed by <a href="http://themeforest.net/user/Coffeecream" target="_blank">Coffeecream Themes</a>
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
                <ul class="social-login">
                    <li><a class="btn btn-facebook"><i class="fa fa-facebook"></i>Sign In with Facebook</a></li>
                    <li><a class="btn btn-google"><i class="fa fa-google-plus"></i>Sign In with Google</a></li>
                    <li><a class="btn btn-linkedin"><i class="fa fa-linkedin"></i>Sign In with LinkedIn</a></li>
                </ul>
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

<!-- Mirrored from www.coffeecreamthemes.com/themes/jobseek/site/company.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:32:54 GMT -->

</html>