<?php
include 'dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if(isset($_SESSION['stud_id'])){

  }
  else{
    header("location: ../index.php");
  }
  $currsid=$_SESSION['stud_id'];
  $currpass='denim';
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

		   <style>
                #myModal {
                    position: fixed;
                /* display: none; */
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
<!-- ----modal to be shown before applying ------ -->
<!-- <button id="myBtn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button> -->
<div  id="myModal" >
    <div  id="text">
        <div  style="padding:20px">
            <div >
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                 <h4 class="text-center" id="myModalLabel">Change Password &nbsp;</h4>

            </div>
            <div >
            <div>
            <form class="form-control">
                    <!-- OLD PASSWORD
                    <input  id="det1" type="password" required> -->
                   Create a New Password
                    <input id="det2" type="password" required>
                    
                    
                    <br>
                    <br>
                    <button  type="button" class="btn editbtn btn-primary" style="float:right" onclick="updatepassword();">Change Password</button>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- ------------- -->

		<script src="specialty/js/jquery-1.12.3.min.js"></script>
		<script src="specialty/js/jquery.mmenu.min.all.js"></script>
		<script src="specialty/js/jquery.fitvids.js"></script>
		<script src="specialty/js/jquery.magnific-popup.js"></script>
		<script src="specialty/js/jquery.matchHeight.js"></script>
		<script src="specialty/js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="specialty/js/scripts.js"></script>
<script>
	function updatepassword(){
			if(<?php echo isset($currpass); ?>){
				$.ajax({
                                url: 'http://talentchords.com/jobs/specialty/updatepassafteredit.php',
                                type: 'POST',
                            
                                data: {param1: '<?php echo $currpass;?>',param2:$('#det2').val()},
                               
                            })
                            .done(function(response) {
                    alert(response);
                    location.replace("http://talentchords.com/jobs/specialty/index.php");
					// off();
							});

			}
			else{
				alert("Can't update password!");
			}
		}
</script>
</body>
</html>