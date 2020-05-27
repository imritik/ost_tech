<?php
include 'dbConfig.php';
  ?>
  <!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <title>Job Seek</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="specialty/css/base.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/mmenu.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/magnific.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="specialty/style.css">

    <link rel="shortcut icon" href="#">
    <link rel="apple-touch-icon" href="#">
    <link rel="apple-touch-icon" sizes="72x72" href="#">
    <link rel="apple-touch-icon" sizes="114x114" href="#">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            font-family: 'Varela Round', sans-serif;
        }
        
        .form-control {
            box-shadow: none;
            font-weight: normal;
            font-size: 13px;
        }
        
        .form-control:focus {
            border-color: #33cabb;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-header.col {
            padding: 0 !important;
        }
        
        .navbar {
            background: #fff;
            padding-left: 16px;
            padding-right: 16px;
            border-bottom: 1px solid #dfe3e8;
            border-radius: 0;
        }
        
        .nav-link img {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            margin: -8px 0;
            float: left;
            margin-right: 10px;
        }
        
        .navbar .navbar-brand,
        .navbar .navbar-brand:hover,
        .navbar .navbar-brand:focus {
            padding-left: 0;
            font-size: 20px;
            padding-right: 50px;
        }
        
        .navbar .navbar-brand b {
            font-weight: bold;
            color: #33cabb;
        }
        
        .navbar .form-inline {
            display: inline-block;
        }
        
        .navbar .nav li {
            position: relative;
        }
        
        .navbar .nav li a {
            color: #888;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            padding-right: 35px;
            border-color: #dfe3e8;
            border-radius: 4px !important;
            box-shadow: none
        }
        
        .search-box .input-group-addon {
            min-width: 35px;
            border: none;
            background: transparent;
            position: absolute;
            right: 0;
            z-index: 9;
            padding: 7px;
            height: 100%;
        }
        
        .search-box i {
            color: #a0a5b1;
            font-size: 19px;
        }
        
        .navbar .nav .btn-primary,
        .navbar .nav .btn-primary:active {
            color: #fff;
            background: #33cabb;
            padding-top: 8px;
            padding-bottom: 6px;
            vertical-align: middle;
            border: none;
        }
        
        .navbar .nav .btn-primary:hover,
        .navbar .nav .btn-primary:focus {
            color: #fff;
            outline: none;
            background: #31bfb1;
        }
        
        .navbar .navbar-right li:first-child a {
            padding-right: 30px;
        }
        
        .navbar .nav-item i {
            font-size: 18px;
        }
        
        .navbar .dropdown-item i {
            font-size: 16px;
            min-width: 22px;
        }
        
        .navbar ul.nav li.active a,
        .navbar ul.nav li.open>a {
            background: transparent !important;
        }
        
        .navbar .nav .get-started-btn {
            min-width: 120px;
            margin-top: 8px;
            margin-bottom: 8px;
        }
        
        .navbar ul.nav li.open>a.get-started-btn {
            color: #fff;
            background: #31bfb1 !important;
        }
        
        .navbar .dropdown-menu {
            border-radius: 1px;
            border-color: #e5e5e5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }
        
        .navbar .nav .dropdown-menu li {
            color: #999;
            font-weight: normal;
        }
        
        .navbar .nav .dropdown-menu li a,
        .navbar .nav .dropdown-menu li a:hover,
        .navbar .nav .dropdown-menu li a:focus {
            padding: 8px 20px;
            line-height: normal;
        }
        
        .navbar .navbar-form {
            border: none;
        }
        
        .navbar .dropdown-menu.form-wrapper {
            width: 280px;
            padding: 20px;
            left: auto;
            right: 0;
            font-size: 14px;
        }
        
        .navbar .dropdown-menu.form-wrapper a {
            color: #33cabb;
            padding: 0 !important;
        }
        
        .navbar .dropdown-menu.form-wrapper a:hover {
            text-decoration: underline;
        }
        
        .navbar .form-wrapper .hint-text {
            text-align: center;
            margin-bottom: 15px;
            font-size: 13px;
        }
        
        .navbar .form-wrapper .social-btn .btn,
        .navbar .form-wrapper .social-btn .btn:hover {
            color: #fff;
            margin: 0;
            padding: 0 !important;
            font-size: 13px;
            border: none;
            transition: all 0.4s;
            text-align: center;
            line-height: 34px;
            width: 47%;
            text-decoration: none;
        }
        
        .navbar .social-btn .btn-primary {
            background: #507cc0;
        }
        
        .navbar .social-btn .btn-primary:hover {
            background: #4676bd;
        }
        
        .navbar .social-btn .btn-info {
            background: #64ccf1;
        }
        
        .navbar .social-btn .btn-info:hover {
            background: #4ec7ef;
        }
        
        .navbar .social-btn .btn i {
            margin-right: 5px;
            font-size: 16px;
            position: relative;
            top: 2px;
        }
        
        .navbar .form-wrapper .form-footer {
            text-align: center;
            padding-top: 10px;
            font-size: 13px;
        }
        
        .navbar .form-wrapper .form-footer a:hover {
            text-decoration: underline;
        }
        
        .navbar .form-wrapper .checkbox-inline input {
            margin-top: 3px;
        }
        
        .or-seperator {
            margin-top: 32px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        
        .or-seperator b {
            color: #666;
            padding: 0 8px;
            width: 30px;
            height: 30px;
            font-size: 13px;
            text-align: center;
            line-height: 26px;
            background: #fff;
            display: inline-block;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            top: -15px;
            z-index: 1;
        }
        
        .navbar .checkbox-inline {
            font-size: 13px;
        }
        
        .navbar .navbar-right .dropdown-toggle::after {
            display: none;
        }
        
        @media (min-width: 1200px) {
            .form-inline .input-group {
                width: 300px;
                margin-left: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .navbar .dropdown-menu.form-wrapper {
                width: 100%;
                padding: 10px 15px;
                background: transparent;
                border: none;
            }
            .navbar .form-inline {
                display: block;
            }
            .navbar .input-group {
                width: 100%;
            }
            .navbar .nav .btn-primary,
            .navbar .nav .btn-primary:active {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div id="page">
        


        <nav class="navbar navbar-default navbar-expand-lg navbar-light">
            <div class="navbar-header d-flex col">
                <a class="navbar-brand" href="#">Brand<b>Name</b></a>
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
							<span class="navbar-toggler-icon"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                    <!-- <li class="nav-item dropdown">
								<a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Services <b class="caret"></b></a>
								<ul class="dropdown-menu">					
									<li><a href="#" class="dropdown-item">Web Design</a></li>
									<li><a href="#" class="dropdown-item">Web Development</a></li>
									<li><a href="#" class="dropdown-item">Graphic Design</a></li>
									<li><a href="#" class="dropdown-item">Digital Marketing</a></li>
								</ul>
							</li>
							<li class="nav-item active"><a href="#" class="nav-link">Pricing</a></li>
							<li class="nav-item"><a href="#" class="nav-link">Blog</a></li> -->
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav-item">
                        <!-- <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Employer</a> -->
                        <ul class="dropdown-menu form-wrapper">
                            <li>
                                <form action="login/emp.php" method="post">
                                   
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="emailemp" placeholder="email" value="abc@company.com" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="passwordemp" placeholder="Password" value="denim" required="required">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                                    <div class="form-footer">
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                        <li class="nav-item">
                        <a href="student_register/index.php" target="blank" class="btn btn-primary get-started-btn mt-1 mb-1">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle get-started-btn mt-1 mb-1">Login</a>
                        <ul class="dropdown-menu form-wrapper">
                            <li>
                                <form action="login/stud.php" method="post">

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="emailstud" placeholder="email" value="ritikvverma@gmail.com" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="passwordstud" placeholder="Password" value="denim" required="required">
                                    </div>

                                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="page-hero page-hero-lg" style="background-image: url(home.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-hero-content">
                            <h2 class="page-title">
                                <span class="text-theme">Work there.</span> Find the dream job
                                <br> you’ve always wanted.
                            </h2>
                            <p class="page-subtitle">
                                <!-- <span class="text-theme">405</span> new jobs in the last -->
                                <!-- <span class="text-theme">7</span> days. Search now. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <form action="" class="form-filter"> -->
              

                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-xs-12">
                            <label for="job-description" class="sr-only">Job Title</label>
							<input type="text" id="title-criteria" style="color:black" placeholder="Job title">
							<!-- <input type="email"> -->
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <label for="job-location" class="sr-only">Job Location</label>
                            <input type="text" id="loc-criteria" style="color:black" placeholder="Location">
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <label for="job-category" class="sr-only">Job Category</label>
                            <div class="ci-select">
                                <select id="category-criteria">
										<option value=" ">Category</option>
										<option value="Full Time">Full Time</option>
										<option value="Part Time">Part Time</option>
										<option value="Internship">Internship</option>
										<option value="Freelance">Freelance</option>
										<option value="Contract">Contract</option>
								</select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <button class="btn btn-block" id="search">Search</button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>

        <main class="main">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section-title-wrap">
                            <h3 class="section-title">
                                 <b>All &nbsp;Jobs</b></h3>

                            <span class="section-title-compliment">
								
								</span>
                        </div>
                        <div class="item-listing">
                            

                            <!-- ----php code---- -->

                            <?php
                        
                                $querycat = $db->query("SELECT * FROM Job_Posting order by posting_time DESC");

                                if($querycat ->num_rows >0){
                                    while($row = $querycat->fetch_assoc()){
                                        ?>

                            <div class="list-item" style="display:none;">
                                <div class="list-item-main-info">
                                    <p class="list-item-title">
                                        <a href="job-details.php?jpi=<?php echo $row['posting_id']; ?>" target="blank"><?php echo $row['job_title']; ?></a>
                                    </p>

                                    <div class="list-item-meta">
                                        <a href="#" class="list-item-tag item-badge job-type-contract"><?php echo $row['Job_type']; ?></a>
                                        <span class="list-item-company"><?php echo $row['company_name']; ?></span>
                                    </div>
                                </div>

                           

                                <div class="list-item-secondary-info">
                                    <p class="list-item-location"><?php echo $row['Job_location']; ?></p>
                                    <?php $pt=strtotime(substr($row['posting_time'],0,10));
                                    $ct=strtotime(date("Y-m-d")); 
                                    $tdiff=($ct-$pt)/60/60/24;
                                    $toshow='';
                                    if($tdiff<1){
$toshow='Today';
                                    }
                                    else{
                                        $toshow=number_format($tdiff).' days ago';
                                    }
                                    ?>
                                    <time class="list-item-time" datetime="2017-01-01"><?php echo $toshow; ?> </time>
                                </div>
                                    
                            </div>

                            <?php }}
                                ?>

                          
                            <div class="list-item-secondary-wrap">
                                <button id="loadMore" class="btn btn-round btn-white btn-transparent">Load More Jobs</button>
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </main>

       
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">

                       

                        <div class="footer-copy">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <p>
                                        <a href="#">Specialty</a> &ndash; Job Seek
                                   
                                    </p>
                                </div>

                                <div class="col-sm-6 col-xs-12 text-right">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- #page -->

    <!-- -----load more script---- -->
    <script>
    $(document).ready(function () {
    size_li = $(".list-item").length;
    // console.log(size_li);
    x=2;
    $('.list-item:lt('+x+')').show();
    $('#loadMore').click(function () {
        if(x==size_li){
            alert("no more jobs");
        }
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('.list-item:lt('+x+')').show();
        
    });
    // $('#showLess').click(function () {
    //     x=(x-5<0) ? 3 : x-5;
    //     $('#myList li').not(':lt('+x+')').hide();
    // });

    $('#search').click(function(){
    $('.contact-name').hide();
    var txt = $('#loc-criteria').val();
    var txttitle = $('#title-criteria').val();
    var txtcategory = $('#category-criteria').val();
    $('.list-item').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txttitle.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txtcategory.toUpperCase()) != -1){
           $(this).show();
       }
       else{
           $(this).hide();
           $('#loadMore').hide();
       }
    });
});
});
    
    </script>
    <script src="specialty/js/jquery-1.12.3.min.js"></script>
    <script src="specialty/js/jquery.mmenu.min.all.js"></script>
    <script src="specialty/js/jquery.fitvids.js"></script>
    <script src="specialty/js/jquery.magnific-popup.js"></script>
    <script src="specialty/js/jquery.matchHeight.js"></script>
    <script src="specialty/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="specialty/js/scripts.js"></script>

</body>


</html>