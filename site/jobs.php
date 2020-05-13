<!DOCTYPE html>

<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

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
                <li class="active"><a href="post-a-job.php">Post a job</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="candidates.php">Push Jobs</a></li>
                <li><a href="linkedinCandidates.php">Push Jobs(Linkedin)</a></li>

                <!-- <li><a href="csv_v2/index.php" target="blank">Add Candidates</a></li> -->
                <!-- <li><a href="import-csv/index.php" target="blank">Add Company</a></li> -->
                <li><a href="sendmails.php">Send Mails</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="showadmins.php">Admin details</a></li>
                  <li><a href="../admin_jobs/coordinators/login.php" target="blank">Account Manager</a></li>
                 <li><a href="../admin_jobs/cc/login.php" target="blank">Cordinator</a></li>
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
                    <div id="actionbar" style="float:right;display:none">
                    <button class="btn btn-warning btn-sm" onclick="repost();">Repost</button>
                        <button class="btn btn-danger btn-sm" onclick="deletejob();"><i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>

                </div>
            </div>
            <br>
            <!-- -----------filters---- -->

<?php


// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
 <!-- Import link -->
 <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="formToggle('importFrm');"><i class="plus"></i> upload feedback</a>
        </div>
        <br>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="csv_v2/importfeedback.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filefeedback" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmitfeedback" value="IMPORT">
        </form>
        <br>
    </div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>


               <!-- <div class="container"> -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-12">
                            <label for="job-description" class="sr-only">Job Title</label>
							<input type="text"class="form-control" id="title-criteria" style="color:black" placeholder="Job title">
							<!-- <input type="email"> -->
                        </div>
                        <div class="col-lg-2 col-xs-12">
                            <label for="job-location" class="sr-only">Job Location</label>
                            <input type="text"class="form-control"id="loc-criteria" style="color:black" placeholder="Location">
                        </div>
                        <div class="col-lg-2 col-xs-12">
                            <label for="job-company" class="sr-only">Company</label>
                            <select id="company-criteria" class="form-control">
										<option value=" ">Company</option>
									
                                        <!-- -------php code to gather posted jobs---- -->
                                        <?php

                                        $query = $db->query("SELECT * FROM employer_account");
                                                    
                                        if($query ->num_rows >0){
                                            while($row4 = $query->fetch_assoc()){

                                                echo '<option value="' . $row4['company_name'] . '">' . $row4['company_name'] .' ('.$row4['email'].')' . '</option>';
                                        ?>
                                            <?php }} ?>
								</select>
                        </div>
                        <div class="col-lg-2 col-xs-12">
                            <label for="job-category" class="sr-only">Job Category</label>
                            <div class="ci-select">
                                <select id="category-criteria" class="form-control">
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
                            <button class="btn btn-info" id="search">Search</button>
                        </div>
                    </div>
                <!-- </div> -->
        </div>
    </section>

    <!-- ============ TITLE END ============ -->

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row">
            <!-- <button onclick="exportTableToCSV('candidates.csv')" style="float:right" class="btn btn-primary btn-sm">Export to CSV File</button> -->

                <div class="col-sm-12">
<input type="checkbox" id="selectall">Select All
                    <div class="jobs">

<!-- ------------- -->

                          

<?php
// echo $_REQUEST['category'];
$reqcat=$_SESSION['company'];
// Get images from the database
$querycat = $db->query("SELECT * FROM Job_Posting order by posting_time DESC");

if($querycat ->num_rows >0){
    while($row = $querycat->fetch_assoc()){
        ?>
                        <!-- Job offer 1 -->
                        <a href="showcandidates.php?jid=<?php echo $row['posting_id']; ?>" target="blank" class="featured applied list-item" style="display:none;">

                            <div class="row" >

                                <div class="col-md-1 hidden-sm hidden-xs">
                                <!-- <i class="fa fa-link" aria-hidden="true"></i> -->
                                <input type="checkbox" class="chk" name="jb" value="<?php echo $row['posting_id']; ?>">

                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 job-title">
                                    <h5> <?php echo $row['job_title']; ?></h5>
                                    <p><strong><?php echo $row['company_name']; ?></strong> </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 job-location">
                                    <p><strong><?php echo $row['Job_location']; ?></strong></p>
                                    <p class="hidden-xs">Coordinator:<strong><?php echo $row['coordinator']; ?></strong> </p>
                                </div>
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs job-type text-center">
                                <p class="badge full-time"><?php echo $row['Job_type']; ?></p>

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
                                    <p class="job-salary"><strong><?php echo $toshow ; ?> </strong></p>
                                </div>

                            </div>
                        </a>


                       
    <?php }}
    ?>


                    </div>
                    <div class="list-item-secondary-wrap text-center">
                    <br>
                                <button id="loadMore" class="btn" style="background: teal;color: white;">Load More Jobs</button>
                            </div>

                    <nav>
                       
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
    var txtcompany = $('#company-criteria').val();
    $('.list-item').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txttitle.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txtcategory.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txtcompany.toUpperCase()) != -1 ){
           $(this).show();
       }
       else{
           $(this).hide();
           $('#loadMore').hide();
       }
    });
});
});

// ----checkbox select--

 var favorites = [];

   
$(".chk").click(function(){
    $('#actionbar').show();

    var favorite=[];
        $.each($("input[name='jb']:checked"), function(){            
            favorite.push($(this).val());
        });
        favorites=favorite;
     console.log(favorites);
 

});

    // -----for selecting all student at once---
    $("#selectall").click(function () {
        $('#actionbar').toggle();
        var jobarr=[]
        $('.list-item').each(function(i, obj) {
            //test
            // console.log(obj);
            if($(this).is(":visible")) {
            
            console.log(obj);
            if($(this).find('.chk').prop('checked') == false){
                $(this).find('.chk').prop('checked',true);
                jobarr.push($(this).find('.chk').val());
                favorites=jobarr;
                console.log(favorites);

            }
            else{
                $(this).find('.chk').prop('checked',false);
                jobarr=[];
                favorites=jobarr;
                console.log(favorites);

            }

            }
        });

      
   
    });

    function repost(){
        favorites.forEach(function(i){
            console.log(i);
repostpart(i);

        });
    }

    function repostpart(x){
        console.log(x);
                             $.ajax({
                                url: 'repost.php',
                                type: 'POST',
                            
                                data: {param1: x},
                            })
                            .done(function(response) {
                                alert(response);
                               
                            })
                            .fail(function() {
                                alert("error in reposting");
                            });
    }

    function deletejob(){
        favorites.forEach(function(i){
deletejobpart(i);
        });
    }

    function deletejobpart(x){
                            $.ajax({
                                url: 'deletejob.php',
                                type: 'POST',
                            
                                data: {param1: x},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("error while deleting!");
                            });
    }
    
    
    </script>



    <!-- ======export to csv script==== -->
    <script>
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll('table tr:not([style*="display:none"]):not([style*="display: none"])');
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++) 
                    row.push(cols[j].innerText);
                
                csv.push(row.join(","));        
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }
    </script>
</body>


</html>