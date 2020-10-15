<?php
session_start();
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['stud_id'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
  if(isset($_COOKIE['recentjid']) && $_COOKIE['firsttime']=='yes' && !$_COOKIE['firsttimevisit']=='no'){
setcookie("firsttimevisit", "no");
    header("location: single-job.php?jpi=".$_COOKIE['recentjid']."&apl=4hvt");
    
  }
// $_SESSION['stud_id']=1;
// $_SESSION['stud_name']="ritik verma";
?>
<!doctype html>
<html lang="en">

<!-- Mirrored from www.cssigniter.com/themeforest/specialty/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 03 Aug 2019 18:30:01 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <title>Home &ndash;&nbsp;<?php echo $_SESSION['stud_name']; ?></title>
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

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

      <?php
      $notapplied=0;
      $applied=0;
                // echo $_REQUEST['category'];
                $studentid=$_SESSION['stud_id'];

                // Get images from the database
                $querycat = $db->query("SELECT * FROM applied_table WHERE student_id='$studentid'");
$jobcount=$querycat ->num_rows;
                if($querycat ->num_rows >0){
                    $jobids=array();
                    // $statusarr=array();
                    // $notearr=array();
                    while($row = $querycat->fetch_assoc()){
                        array_push($jobids,$row['posting_id']);
                        // array_push($statusarr,$row['Status']);
                        // array_push($notearr,$row['Note']);
                    }
                }
                        ?>

<!-- -=============collect the status of applied jobs======== -->
<?php
 $statusarr=array();
 $notearr=array();
 $applieddate=array();
                $querycat1 = $db->query("SELECT * FROM applied_table WHERE student_id='$studentid' and Status!='Shared'");
$jobcount1=$querycat1 ->num_rows;
                if($querycat1 ->num_rows >0){
                    // $jobids=array();
                   
                    while($row1 = $querycat1->fetch_assoc()){
                        // array_push($jobids,$row['posting_id']);
                        array_push($statusarr,$row1['Status']);
                        array_push($notearr,$row1['Note']);
                        array_push($applieddate,$row1['applied_at']);
                    }
                }
                // var_dump($statusarr[0]);
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
                                    <!-- <li  id="getappliedjobs" class="menu-item-btn">
                                        <a href="#">Applied Jobs</a>
                                    </li> -->
                                    <li  id="getnotappliedjobs" class="menu-item-btn" style="display:none">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <!-- <button id="getappliedjobs">Applied Jobs</button> -->
                                   
                                    <li class="menu-item-btn">
                                        <a href="auth.php"><?php echo $_SESSION['stud_name']; ?></a>
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
        <div class="page-hero page-hero-lg" >
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-hero-content">
                            <h2 class="page-title">
                                <span class="text-theme">Work there.</span> Find the dream job
                                <br> you’ve always wanted.
                            </h2>
                            <p class="page-subtitle">
                                <span class="text-theme"><?php echo $jobcount; ?></span>  jobs Shared in the last
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="" class="form-filter">
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

             <div class="row">
                    <div class="col-md-2 fixed-top">

                        <ul id="menu" class="nav nav-pills nav-stacked">
                            <li class="menu-item-btn active" ><a href="#">Home</a></li>
                            <li id="getappliedjobs"><a href="#">Applied Jobs</a></li>

                            <li id="getnotappliedjobs"><a href="index.php">Suggested Jobs</a></li>
                            <li><a href="#">Messages</a></li>
                            <li><a href="auth.php">Edit Profile</a></li>

                        </ul>
                    </div>
                    <div class="col-md-10">
                                        <div class="col-xl-12 col-lg-12 col-xs-12">
                                            <h3 class="section-title notappliedjobsdiv">
                                                <b><span id="newjob"></span></b>&nbsp;New Job(s) Found
                                            </h3>

                                            <div class="item-listing">
                                                

                                                <!-- ----fetching jobs Shareded---- -->


                                                                            <?php
                                                                            
                                                if(sizeof($jobids)){

                                                    $arrlength = count($jobids);
                                                    // var_dump(sizeof($arrlength));
                                                    if(sizeof($arrlength)){

                                                ?>
                                                <table class="table table-bordered table-striped notappliedjobsdiv" >
                                                <tr class="filters">
                                                <th>Job Title</th>
                                                    <th>Company</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                
                                                    <th>Job Description</th>
                                                    <th>Applied At</th>
                                                
                                                    </tr>
                                                <tbody>
                                                <?php
                                                    }
                                                    for($x = 0; $x < $arrlength; $x++) {
                                                    

                                                    // Get Shareds from the database
                                                    $query = $db->query("SELECT *
                                                    FROM applied_table inner join Job_Posting on  applied_table.posting_id=Job_Posting.posting_id where applied_table.posting_id='$jobids[$x]' and applied_table.student_id='$studentid' and applied_table.Status='Shared'");

                                                    if($query ->num_rows ==1){
                                                        $row1 = $query->fetch_assoc();
                                                        $notapplied=$notapplied+1;
                                                        
                                                    ?>
                                                
                                                                <tr>
                                                            
                                                                    <td>
                                                <a href="single-job.php?jpi=<?php echo $jobids[$x]; ?>&apl=4hvt" target="blank" ><?php echo $row1['job_title']; ?> </a>

                                                                    <!-- <?php echo $row1['job_title']; ?> -->
                                                                
                                                                </td>
                                                                    <td><?php echo $row1['company_name']; ?></td>
                                                            
                                                                    <td><?php echo $row1['Job_location']; ?></td>
                                                                    <td><?php echo $row1['Status']; ?></td>
                                                                    <td>
                                                <a href='../site/uploads/jd/<?php echo $jobids[$x];?>/<?php echo $row1["description_file"];?>' target="blank">&nbsp;(View)</a>
                                                </td>
                                                            
                                                                    <td><?php echo $row1['Status_update'];?>
                                                                    </td>
                                                                
                                                                </tr>

                                                    

                                                <?php 
                                                }}
                                                ?>
                                                <?php
                                                }
                                                else{
                                                    echo "No job Shared";
                                                }
                                                ?>


                                            </div>
                                        </div>


    <div class="col-xl-12 col-lg-12 col-xs-12 appliedjobsdiv"style="display:none;overflow:scroll;">
                        <h3 class="section-title">
                            <b><span id="appliedjob"></span></b>&nbsp;Applied Job(s) Found.</h3>

                        <div class="item-listing">
                            

                            <!-- ----fetching jobs applied---- -->


                              <?php
                            
if(sizeof($jobids)){

    $arrlength = count($jobids);
    // var_dump($jobids);
    $i=0;
     if(sizeof($arrlength)){

?>
<!-- <div class="container"> -->
 <table class="table table-bordered table-striped appliedjobsdiv" style="display:none">
<tr class="filters">
    <th>Job Title</th>
    <th>Company</th>
    <th>Location</th>
    <th>Status</th>
   
    <th>Job Description</th>
    <th>Applied At</th>
   
    </tr>
    <tbody>
<?php
    }
    for($x = 0; $x < $arrlength; $x++) {
       

    // Get images from the database
    $query =  $db->query("SELECT *
    FROM applied_table inner join Job_Posting on  applied_table.posting_id=Job_Posting.posting_id where applied_table.posting_id='$jobids[$x]' and applied_table.student_id='$studentid' and applied_table.Status!='Shared'");

    if($query ->num_rows==1){
        $row1 = $query->fetch_assoc();
        $applied=$applied+1;
        $curr_status='';
        // $i=$i+1;
        // var_dump($row1['is_closed']);
        if($row1['is_closed']=='1'){ 
            $curr_status= 'Position closed';
        
        } else{
            $curr_status= $row1['Status'];
        };
        
        
       ?>
  
   <tr>
              
                    <td>
                    <a href="single-job.php?jpi=<?php echo $jobids[$x]; ?>&apl=5a" target="blank" ><?php echo $row1['job_title']; ?> </a>
                   
                   </td>
                    <td><?php echo $row1['company_name']; ?></td>
               
                    <td><?php echo $row1['Job_location']; ?></td>
              <td><?php echo $curr_status; ?></td>
                    <td>
                    <a href='../site/uploads/jd/<?php echo $jobids[$x];?>/<?php echo $row1["description_file"];?>' target="blank">&nbsp;(View)</a>
                    </td>


                    <td><?php echo $row1['Status_update']; ?>
                    </td>
                
                </tr>

  

<?php 
$i=$i+1;
}


}
?>
<?php
}
else{
    echo "You have not applied for any job yet!";
}

?>
 </tbody>
    </table>
    <!-- </div> -->

                        </div>
                    </div>


                                        

                    </div>
                     
   

            </div>
   
    </main>
<br>
    <footer class="footer">
        <div class="container">
         

            <div class="footer-copy">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <p>
                            <a href="#">Specialty</a> &ndash; Job Board
                            <!-- <a href="https://www.cssigniter.com/ignite" target="_blank"></a> -->
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
            // $('#getappliedjobs').hide();
            // $('#getnotappliedjobs').show();


        });


        $('#getnotappliedjobs').click(function(){

            // alert("jjjjjj");

            // $('.notappliedjobsdiv').hide();
            // $('.appliedjobsdiv').show();
            $('#getappliedjobs').show();
            $('#getnotappliedjobs').hide();


            });
    });
    
    $("#menu li a").click(function() {
    $(this).parent().addClass('active').siblings().removeClass('active');

    });
    </script>

</body>


</html>