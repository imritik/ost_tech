<?php
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if(isset($_SESSION['stud_id'])){

  }
  else{
    header("location: ../index.php");
  }
  

  $currsid=$_SESSION['stud_id'];
  $currpass='';
?>
<!doctype html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title><?php echo $_SESSION['stud_name']; ?> | Profile</title>
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

		   <style>
#myModal {
    position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 20px;
  color: white;
  transform: translate(-50%,-50%);
  background:cadetblue;
  -ms-transform: translate(-50%,-50%);
}
</style>
	</head>
	<body>

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
										<li class="menu-item-home current-menu-item">
											<a href="index.php">Home</a>
										</li>
									
										<li class="menu-item-btn">
											<a href="../logoutstud.php">Logout</a>
										</li>
									</ul>
									<!-- #navigation -->

								
								</nav>
								<!-- #nav -->

								<div id="mobilemenu"></div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div class="page-hero" style="background-image: url(images/hero-1.jpg);">
				<div class="container">
					<div class="row">
						<div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-xs-12">
							<div class="page-hero-content">
								<h3 class="page-title">Account Details<span>&nbsp;<a onclick="changepass()" style="cursor:pointer;color:white"><small style="font-size:18px;">(Change Password)</small></a></span></h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<main class="main main-elevated">
				<div class="container">
					<div class="row">
						<div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-xs-12">
<button class="btn btn-warning" style="float:right;" onclick="allowedit();"><b>Edit</b> &nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>
</button>

							<div class="content-wrap">
								<?php

    // Get images from the database
    $query = $db->query("SELECT * FROM Student WHERE student_id='$currsid'");

    if($query ->num_rows ==1){
        $row1 = $query->fetch_assoc();
        $currpass=$row1['pass'];
       ?>
  


								<div class="row">
										<form action="saveafterauth.php" method="POST" class="form-login col-lg-12 col-xs-12" enctype="multipart/form-data">
								<div class="row">

											<div class="col-lg-6 col-xs-12">
											<h3>Personal</h3>

											<div class="form-field">
												<label for="username-login">Name</label>
												<input type="text" id="username-login" name="username-login" class="editvalue" value="<?php echo $row1['stud_name']; ?>" disabled required>
											</div>

											<div class="form-field">
												<label for="username-password">Email*</label>
														<input type="email" id="username-email" name="username-email" value="<?php echo $row1['email']; ?>" disabled required>
											</div>

											<div class="form-field">
												<label for="username-Address">Address</label>
												<input type="text" id="username-address" name="username-address" class="editvalue" value="<?php echo $row1['address']; ?>" disabled required>
											</div>
											<div class="form-field">
												<label for="username-Address">Contact</label>
												<input type="tel" id="username-contact" name="username-contact" class="editvalue" pattern="^\d{10}$" value="<?php echo $row1['contact']; ?>" disabled required>
											</div>
											
											</div>

											<div class="col-lg-6 col-xs-12">
											<h3>Organization</h3>

											<div class="form-field">
												<label for="email-college">College*</label>
												<input type="text" id="username-college" name="username-college"class="editvalue" value="<?php echo $row1['college_name']; ?>" disabled required>
											</div>

											<div class="form-field">
												<label for="username-company">Company (Current)</label>
												<input type="text" id="username-company" name="username-company" class="editvalue" value="<?php echo $row1['curr_company']; ?>" disabled required>
											</div>

										
											<div class="form-field">
												<label for="username-ctc">CTC (Current)</label>
												<input type="text" id="username-ctc" name="username-ctc" class="editvalue" value="<?php echo $row1['curr_ctc']; ?>" disabled required>
											</div>

											<div class="form-field">
												<label for="username-exp">Experience (in years)</label>
												<input type="text" id="username-exp" name="username-exp" class="editvalue" value="<?php echo $row1['experience']; ?>" disabled required>
											</div>
											<div class="form-field">
											<label for="username-resume">Resume(<a target='blank' href="uploads/<?php echo $currsid; ?>/<?php echo $row1['resume'];?>">View</a>)</label>
												<input type="file" id="username-resume" name="resume">
											</div>
											<div class="form-field">
												<button type="submit" id="savebtn" style="display:none;" class="btn">Save</button>
											</div>
										<!-- </form> -->
									</div>
									</div>
										</form>
									<!-- </div> -->

									
								</div>
								<?php 
}
?>
							</div>
						</div>
					</div>
				</div>
			</main>

			<footer class="footer">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">

							<div class="row">
							
							</div>

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


<!-- ----modal to be shown before applying ------ -->
<!-- <button id="myBtn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button> -->
<div  id="myModal" style="display:none" >
    <div  id="text">
        <div  style="padding:20px">
            <div >
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                 <h4 class="text-center" id="myModalLabel">Change Password &nbsp;</h4>

            </div>
            <div >
            <div>
            <form class="form-control">
            OLD PASSWORD
            <input  id="det1" type="password" required>
            NEW PASSWORD
            <input id="det2" type="password" required>
            
            
            <br>
            <br>
            
           
                <button  type="button" class="btn editbtn btn-default" onclick="off();" >Close</button>
                <button  type="button" class="btn editbtn btn-primary" style="float:right" onclick="updatepassword();">Change Password</button>
            
            </form>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- ------------- -->


<script>


function off() {
  document.getElementById("myModal").style.display = "none";
}

</script>

		<script src="js/jquery-1.12.3.min.js"></script>
		<script src="js/jquery.mmenu.min.all.js"></script>
		<script src="js/jquery.fitvids.js"></script>
		<script src="js/jquery.magnific-popup.js"></script>
		<script src="js/jquery.matchHeight.js"></script>
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="js/scripts.js"></script>


		<script>
		function allowedit(){
			$('.editvalue').removeAttr('disabled');
			$('.editvalue').css("background-color", "aliceblue");
			$("#savebtn").show();
		}

		function changepass(){
			$('#myModal').show();
		}

		function updatepassword(){
			if($('#det1').val()=='<?php echo $currpass;?>'){
				$.ajax({
                                url: 'updatepassafteredit.php',
                                type: 'POST',
                            
                                data: {param1: $('#det1').val(),param2:$('#det2').val()},
                               
                            })
                            .done(function(response) {
                    alert(response);
					off();
							});

			}
			else{
				alert("Can't update password!");
			}
		}
		</script>

	</body>

</html>