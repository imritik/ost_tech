<!DOCTYPE html>
<?php
session_start();
include '../dbConfig.php';
// $_SESSION['email']="ritikvverma@gmail.com";
// $_SESSION['company']="XYZ";
// $_SESSION['url']="abc.com";
if(isset($_SESSION['emailemp'])){
  }
  else{
    header("location: ../index.php");
  }
  include 'partials/header.php';
  ?>



    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
        <a href="exportjobs.php" class="btn btn-success btn-xs">Export Jobs</a>
        <a href="exportcompanies.php" class="btn btn-success btn-xs pull-right">Export Companies</a>


            <div class="row text-center">

                <div class="col-sm-12">
                    <h1>Post a Job</h1>
                    <h4>Find a Right Candidate</h4>
                 
                    <?php
// Load the database configuration file
// include_once 'dbConfig.php';

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
        case 'succjob':
            $statusType='alert-success';
            $statusMsg='The job has been uploaded successfully.';
            break;
        case 'errjob':
            $statusType='alert-danger';
            $statusMsg='job upload failed, please try again.';
            break;
            case 'succcomp':
            $statusType='alert-success';
            $statusMsg='The company has been added successfully.';
            break;
        case 'errcomp':
            $statusType='alert-danger';
            $statusMsg='Sorry, there was an error uploading ';
            break;
        case 'errcomptype':
            $statusType='alert-danger';
            $statusMsg='Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
            break;
        case 'errfiletype':
            $statusType='alert-danger';
            $statusMsg='Sorry only pdf,docx files are allowed to upload.';
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
                </div>
            </div>
            <br>
<div class="row">
<div class="col-sm-6">
<div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="csv_v2/importjobs.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filejobs" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmitjobs" value="IMPORT">
        </form>
        <br>
    </div>

<form  action="post.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-10">
                        <h2>Job Details(<span style="font-size:15px;"> <a href="javascript:void(0);"  onclick="formToggle('importFrm');"><i class="plus"></i>Upload csv</a></span>)</h2>
 





                        <div class="form-group" id="job-company-group">
                            <label for="job-email">Company Name</label>
                            <!-- <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" required> -->
<select class="form-control" name="companyname" id="job-company">

 <option value="" >Select Company</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM employer_account");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['company_name'] .'$'.$row['email'] .'$'.$row['url']. '">' . $row['company_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>
                        </div>
                        <div class="form-group" id="job-email-group">
                            <label for="job-email">Email</label>
                            <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" readonly required>
                        </div>
                        <div class="form-group" id="job-title-group">
                            <label for="job-title">Title</label>
                            <input type="text" name="title" class="form-control" id="job-title" placeholder="e.g. Web Designer" required>
                        </div>
                        <div class="form-group" id="job-location-group">
                            <label for="job-location">Location (Optional)</label>
                            <input type="text" name="location" class="form-control" id="job-location" placeholder="e.g. New York" required>
                        </div>
                       
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
                       
                        <div class="form-group" id="job-description-group">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description" id="job-description" maxlength="2000" required></textarea>
                        </div>
                        <div class="form-group" id="job-description-file-group">
                            <label for="desc-file">Upload description</label>
                            <input type="file" name="jobdescriptionfile" id="jobdescriptionfile">
                        </div> 
                        <div class="form-group" id="job-url-group">
                            <label for="job-url">Website (Optional)</label>
                            <input type="text" name="weburl" class="form-control" id="job-url" placeholder="https://" required>
                        </div>
                         <div class="form-group" id="job-coordinator-group">
                            <label for="job-email">Coordinator</label>
<select class="form-control" name="coordinator" id="job-coordinator">

 <option value="" >Select Coordinator</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM admins where role='cc'");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['email'] .'">' . $row['Full_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>
                        </div>
                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Post <i class="fa fa-arrow-right"></i></button>
                </div>
                    </div>
             </div>
              
            </form>
</div>


<!-- -----------company profile--- -->
<div class="col-sm-6">
<div class="col-md-12" id="importFrm1" style="display: none;">
    <br>
        <form action="csv_v2/importcompany.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filecompany" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmitcompany" value="IMPORT">
        </form>
        <br>
    </div>
            <form  action="addcompany.php" method="post" enctype="multipart/form-data" >
                        <h2>Company Details(<span style="font-size:15px;"> <a href="javascript:void(0);"  onclick="formToggle1('importFrm1');"><i class="plus"></i>Upload csv</a></span>)</h2>
       
                        <div class="form-group" id="company-name-group">
                            <label for="company-name">Company Name</label>
                            <input type="text" class="form-control" name="companyname" id="company-name" placeholder="Enter company name" required>
                        </div>

                        <div class="form-group" id="company-description-group">
                            <label for="company-description">Description (Optional)</label>
                          
                            <!-- <div class="textarea form-control" name="companydescription" id="company-description" required></div> -->
                            <textarea class="textarea form-control" name="companydescription" id="company-description" maxlength="2000" required></textarea>
                        
                        </div>

                        <div class="form-group" id="company-website-group">
                            <label for="company-website">Website (Optional)</label>
                            <input type="text" class="form-control" name="companywebsite" id="company-website" placeholder="http://" required>
                        </div>

                        <div class="form-group" id="company-email-group">
                            <label for="company-email">Official Mail</label>
                            <input type="email" class="form-control" name="companyemail" id="company-email" placeholder="abc@company.com" required>
                        </div>



                        <div class="form-group" id="company-logo-group">
                            <label for="company-logo">Logo</label>
                            <input type="file" name="companylogo" id="company-logo">
                        </div> 

                         <div class="form-group" id="job-coordinator-group">
                            <label for="job-email">Account Manager</label>
<select class="form-control" name="manager" id="job-coordinator">

 <option value="" >Select Account Manager</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM admins where role='am'");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['email'] .'">' . $row['Full_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>
                        </div>


                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit_company" class="btn btn-primary btn-lg">Add company <i class="fa fa-arrow-right"></i></button>
                </div>

            </form>

        </div>
    </section>

    <!-- ============ JOBS END ============ -->

    <!-- ============ CONTACT START ============ -->

    <!-- ============ CONTACT END ============ -->


    <!-- Modernizlugin -->
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
function formToggle1(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
  



        <script>
                $('#job-company').change(function(){
            // alert(this.value);
            var output=this.value;
            var cname=output.split('$')[0];
            var cemail=output.split('$')[1];
            var cweburl=output.split('$')[2];
            // alert(cemail);
            $('#job-email').val(cemail);
            $('#job-url').val(cweburl);
                });
               
            
    </script>



</body>


</html>