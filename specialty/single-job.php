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
$sid=$_SESSION['stud_id'];
$jpi=$_REQUEST['jpi'];
$haveapplied=$_REQUEST['apl'];
// var_dump($_SESSION['stud_id']);

?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <title>Single Job &ndash; Specialty</title>
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
.editbtn{
    /* float: right; */
    background: transparent;
    border: 2px solid white;
    /* box-shadow: 2px 2px white; */
    cursor: pointer;
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
                                        <a href="../logout/logoutstud.php">Logout</a>
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

        <!-- ======php=============== -->

<?php

$query = $db->query("SELECT * FROM Job_Posting WHERE posting_id='$jpi'");
            
if($query ->num_rows ==1){
    $row1 = $query->fetch_assoc();

   

   ?>

   


        <div class="page-hero" style="background-image: url(images/hero-1.jpg);">
    
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-hero-content">
                            <h1 class="page-title"><?php echo $row1['job_title']; ?>  </h1>
                            <div class="page-hero-details">
                                <span class="item-badge job-type-full-time"><?php echo $row1['Job_type']; ?> </span>
                                <span class="entry-location"><?php echo $row1['Job_location']; ?> </span>
                                <span class="entry-company"><?php echo $row1['company_name']; ?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="main main-elevated">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-xs-12">
                        <div class="content-wrap">
                            <h3 class="text-center">Job Description <a href='../site/uploads/jd/<?php echo $jpi;?>/<?php echo $row1["description_file"];?>' target="blank">&nbsp;(View)</a></h3>

                            <article class="entry">
                                <div class="entry-content">
                                    <p><?php echo $row1['job_description']; ?></p>

                                   

                                    <!-- <h2>How to Join the Team:</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur blanditiis corporis cumque cupiditate dignissimos, dolor dolorem eaque eligendi error et ex exercitationem expedita facere facilis ipsum iste laboriosam
                                        magni minus, modi mollitia obcaecati officia optio quo repellat repellendus temporibus totam unde. Alias assumenda iste libero ullam. Aspernatur perspiciatis rem voluptatum?</p> -->

                                </div>
                            </article>
                <?php if($haveapplied=='4hvt'){?>
                    <a id="<?php echo $jpi; ?>" class="btn btn-block btn-apply-content" name="applyforjob" onclick="applyforjob(this.id,<?php echo $sid; ?>);">Apply for this job</a>
                <?php }  ?>

                 <?php if($haveapplied=='5a'){?>
                    <a id="<?php echo $jpi; ?>" class="btn btn-block btn-apply-content" name="applyforjob">Applied !</a>
                <?php }  ?>
                          
                        </div>



<!-- ----modal to be shown before applying ------ -->
<!-- <button id="myBtn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button> -->
<div  id="myModal" style="display:none" >
    <div  id="text">
        <div  style="padding:20px">
            <div >
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                 <h4 class="text-center" id="myModalLabel">Your details &nbsp;<br><small>(Last updated on: <span id="last_updated1"></span>)</small></h4>

            </div>
            <div >
            <div>
            <form method="post" action="" class="form-control" enctype="multipart/form-data">
            Resume (<span id="det5"><a href="" target="blank" style="color:white;font-size:15px"></a></span>)
            <input id="det4" type="file" name="updatedresume">
            <button type="submit" id="resumesavebtn" class="btn btn-sm" style="float:right;display:none;" onclick="saveresume();">Save resume</button>
            </form>
            <form method="post" action="" class="form-control" enctype="multipart/form-data">
            Company name
            <input  id="det1" type="text" required>
            Current CTC
            <input id="det2" type="text" required>
            Experience (in years)
            <input id="det3" type="text" required>
           
            
            <br>
            <br>
            
           
                <button  type="button" class="btn editbtn btn-default" onclick="off();" >Close</button>
                <button id='<?php echo $sid; ?>' type="button" class="btn editbtn btn-primary" style="float:right" onclick="applyafteredit(this.id);">Save changes and Apply</button>
            
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


function saveresume(){
    console.log("saving resume");
    var fd = new FormData(); 
                var files = $('#det4')[0].files[0]; 
                fd.append('file', files); 
       
                $.ajax({ 
                    url: 'saveresume.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){ 
                        if(response != 0){ 
                        //    alert(response); 
                        } 
                        else{ 
                            // alert(response); 
                        } 
                    }
                });
}


function applyforjob(x,y){
    console.log(x,y);
    // alert(x);
    // alert(y);
                            $.ajax({
                                url: 'applyforjob.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y},
                                dataType:"json"
                            })
                            .done(function(response) {
                                console.log(response[0]);
                                //do something with the response
                                // $('#<?php echo $jpi; ?>').html('Applied');
                                // $("#myBtn").trigger('click');
                                var date=new Date();
                                console.log(response[0]['last_updated'],Date.parse(response[0]['last_updated']),Date.parse(date));
                                var diffdate=Date.parse(date)-Date.parse(response[0]['last_updated']);
                                var days_diff=diffdate/(1000 * 3600 * 24);
                                console.log("diff",days_diff);
                                if(days_diff>15){
                                        var resumepath='uploads/'+y+'/'+response[0]['resume'];
                                        $('#myModal').show();
                                        $('#det1').val(response[0]['curr_company']);
                                        $('#det2').val(response[0]['curr_ctc']);
                                        $('#det3').val(response[0]['experience']);
                                        // $('#det4').val(resumepath);
                                        $("#det5 a").attr("href", resumepath);

                                        $('#det5 a').html(response[0]['resume']);
                                        $('#last_updated1').html(response[0]['last_updated'].slice(0, 10));
                                }
                                else{
                                            console.log("direct apply");

                                            console.log(<?php echo $jpi; ?>,<?php echo $sid; ?>)
   // ------------for applying----
                                        $.ajax({
                                                    url: 'applyafteredit.php',
                                                    type: 'POST',
                                                
                                                    data: {param1: <?php echo $jpi; ?>,param2:<?php echo $sid; ?>},
                                                
                                                })
                                                .done(function(response) {
                                                        alert(response); 
                                                        console.log(response);  
                                                        off();
                                                        $('#<?php echo $jpi; ?>').html('Applied');
                                                })
                                                .fail(function(data) {
                                                    alert(data);
                                                }); 
                                }
                       

                                
                               
                            })
                            .fail(function() {
                                alert("error while applying");
                            });
}


function applyafteredit(arg){
    alert(arg);
    // $('#resumesavebtn').trigger('click');

 console.log("saving resume");
    var fd = new FormData(); 
                var files = $('#det4')[0].files[0]; 
                fd.append('file', files); 
       
                $.ajax({ 
                    url: 'saveresume.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){ 
                    console.log(response);
                    }
                }).done(function(response){
                   alert(response); 

                //    / -------for updating in db------

                        $.ajax({
                                url: 'updateafteredit.php',
                                type: 'POST',
                            
                            
                                data:{param1:$('#det1').val(),param2:arg,param3:$('#det2').val(),param4:$('#det3').val()},
                                
                            })
                            .done(function(response) {
                                        alert(response);

                                        // ------------for applying----
                                        $.ajax({
                                                    url: 'applyafteredit.php',
                                                    type: 'POST',
                                                
                                                    data: {param1: <?php echo $jpi; ?>,param2:arg},
                                                
                                                })
                                                .done(function(response) {
                                                        alert(response); 
                                                        console.log(response);  
                                                        off();
                                                        $('#<?php echo $jpi; ?>').html('Applied');
                                                })
                                                .fail(function(data) {
                                                    alert(data);
                                                });   
                            });
                        
                                        });

                    }

</script>
   
   
                        <!-- <div class="content-wrap-footer">
                            <div class="row">
                                <div class="col-md-8 col-xs-12">
                                    <div class="entry-sharing">
                                        Share this Job:
                                        <a href="#" class="entry-share entry-share-facebook">Facebook</a>
                                        <a href="#" class="entry-share entry-share-twitter">Twitter</a>
                                        <a href="#" class="entry-share entry-share-google-plus">Google+</a>
                                        <a href="#" class="entry-share entry-share-linkedin">LinkedIn</a>
                                        <a href="#" class="entry-share entry-share-email">Email</a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12 text-right">
                                    <a href="#">Report this listing</a>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="col-xl-3 col-lg-4 col-xs-12">
                        <div class="sidebar">
                            
                            <aside class="widget widget_ci-company-info-widget">
                                <h3 class="widget-title">Company Information</h3>

                                <div class="card-info">
                                    <div class="card-info-media">
                                        <figure class="card-info-thumb">
                                            <img src="images/company-logo.jpg" alt="">
                                        </figure>

                                        <div class="card-info-details">
                                            <p class="card-info-title"><?php echo $row1['company_name']; ?> </p>
                                            <p class="card-info-link">
                                                <a href="#"><?php echo $row1['company_url']; ?> </a>
                                            </p>

                                            <!-- <div class="card-info-socials">
                                                <a href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-linkedin"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="card-info-description">
                                        <p>There’s a lot of opportunity here to work on a wide range of very challenging projects and to grow quickly.</p>
                                    </div>
                                </div>
                            </aside>

                        </div>
                    </div>
                </div>
            </div>

<?php 
}
?>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer-copy">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <p>
                                <a href="#">Specialty</a> &ndash; Job Board
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
    console.log("hi")
    
});
</script>
</body>
</html>