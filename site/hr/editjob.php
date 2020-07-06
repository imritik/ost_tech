<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if(isset($_SESSION['emailhr'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';
$hremail=$_SESSION['emailhr'];
$hrcompany=$_SESSION['companyhr'];
$page="job";


// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
       
        case 'succjob':
            $statusType='alert-success';
            $statusMsg='The job has been updated successfully.';
            break;
        case 'errjob':
            $statusType='alert-danger';
            $statusMsg='job update failed, please try again.';
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

  <!DOCTYPE html>
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
    <link href="../css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    

</head>

<body style='padding:0'>

 <!-- ============ HEADER START ============ -->
 <header>
        <div id="header-background"></div>
        <div class="container">
            <div class="pull-left">
             <b>HR<b> (<?php echo $hremail; ?>)
            </div>
            <div id="menu-open" class="pull-right">
               <a href="../../logout/logout.php">Logout</a>
            </div>

        </div>
    </header>
    <br>
    <br>
    <br>
<div class="container">
<div style="padding:10px;">
<!-- !-- Display status message --> 
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
       <?php

if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];

        
// ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows ==1) {
                        while($row22 = $result22->fetch_assoc()) {
                            ?>

<form  action="updatejob.php?jid=<?php echo $jid;?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h2>Job Details</h2>
                        <div class="form-group" id="job-company-group">
                            <label for="job-email">Company Name</label>
                            <!-- <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" required> -->
<input class="form-control" name="companyname" id="job-company" value="<?php echo $row22['company_name']; ?>" readonly required>

                        </div>
                        <div class="form-group" id="job-email-group">
                            <label for="job-email">Email</label>
                            <input type="email" class="form-control" name="email" id="job-email" value="<?php echo $row22['email']; ?>" placeholder="you@yourdomain.com" readonly required>
                        </div>
                        <div class="form-group" id="job-title-group">
                            <label for="job-title">Title</label>
                            <input type="text" name="title" class="form-control" id="job-title" value="<?php echo $row22['job_title']; ?>" placeholder="e.g. Web Designer" required>
                        </div>
                        <div class="form-group" id="job-location-group">
                            <label for="job-location">Location (Optional)</label>
                            <input type="text" name="location" class="form-control" id="job-location" value="<?php echo $row22['Job_location']; ?>" placeholder="e.g. New York" required>
                        </div>
                       
                        <div class="form-group" id="job-type-group">
                            <label for="job-type">Job Type</label>
                            <select class="form-control" name="type" id="job-type" required>
									<option>Choose a job type</option>
									<option <?php if ($row22['Job_type'] == 'Freelance')  echo 'selected = "selected"'; ?>>Freelance</option>
									<option <?php if ($row22['Job_type'] == 'Part Time')  echo 'selected = "selected"'; ?>>Part Time</option>
									<option <?php if ($row22['Job_type'] == 'Full Time')  echo 'selected = "selected"'; ?>>Full Time</option>
									<option <?php if ($row22['Job_type'] == 'Internship')  echo 'selected = "selected"'; ?>>Internship</option>
									<option <?php if ($row22['Job_type'] == 'Volunteer')  echo 'selected = "selected"'; ?>>Volunteer</option>
								</select>
                        </div>
                       
                        <div class="form-group" id="job-description-group">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description"id="job-description" maxlength="2000" required>
                            <?php echo htmlspecialchars($row22['job_description']); ?>
                            </textarea>
                        </div>
                        <div class="form-group" id="job-description-file-group">
                            <label for="desc-file">Upload description&nbsp; (<a href='../uploads/jd/<?php echo $jid;?>/<?php echo $row22["description_file"];?>' target="blank">View</a>)</label>
                            <input type="file" name="jobdescriptionfile" id="jobdescriptionfile">
                        </div> 
                        <div class="form-group" id="job-url-group">
                            <label for="job-url">Website (Optional)</label>
                            <input type="text" name="weburl" class="form-control" id="job-url" value="<?php echo $row22['company_url'];?>" placeholder="https://" required>
                        </div>
                         <div class="form-group" id="job-coordinator-group">
                            <label for="job-email">Vendor</label>
<select class="form-control" name="coordinator" id="job-coordinator" required>

 <option value="" >Assign Vendor</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM admins where role='vendors' and company='$hrcompany'");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['email'] .'">' . $row['Full_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>
                        </div>

                                <div class="form-group" id="job-recruiter-group">
                            <label for="job-email">Recruiter</label>
<select class="form-control" name="recruiter" id="job-Recruiter" required>

 <option value="" >Assign Recruiter</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM admins where role='recruiters' and company='$hrcompany'");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['email'] .'">' . $row['Full_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>
                        </div>
                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit" id="register" class="btn btn-primary btn-lg">Update <i class="fa fa-arrow-right"></i></button>
                </div>
                    </div>
             </div>
              
            </form>
</div>
</div>
</div>
                            <?php
                        }
                    }
                }
    ?>
  <!-- Modernizlugin -->
    <script src="../js/modernizr.custom.79639.js"></script>
    <!-- jQuery (../ecessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-1.11.2.min.js"></script>
    <!-- Bootstra../p Plugins -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Retina P../lugin -->
    <script src="../js/retina.min.js"></script>
    <!-- ScrollRe../veal Plugin -->
    <script src="../js/scrollReveal.min.js"></script>
    <!-- Flex Men../u Plugin -->
    <script src="../js/jquery.flexmenu.js"></script>
    <!-- Slider P../lugin -->
    <script src="../js/jquery.ba-cond.min.js"></script>
    <script src="../js/jquery.slitslider.js"></script>
    <!-- Carousel../ Plugin -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- Parallax../ Plugin -->
    <script src="../js/parallax.js"></script>
    <!-- Counteru../p Plugin -->
    <script src="../js/jquery.counterup.min.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <!-- No UI Sl../ider Plugin -->
    <script src="../js/jquery.nouislider.all.min.js"></script>
    <!-- Bootstra../p Wysiwyg Plugin -->
    <script src="../js/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Flickr P../lugin -->
    <script src="../js/jflickrfeed.min.js"></script>
    <!-- Fancybox../ Plugin -->
    <script src="../js/fancybox.pack.js"></script>
    <!-- Magic Fo../rm Processing -->
    <script src="../js/magic.js"></script>
    <!-- jQuery S../ettings -->
    <script src="../js/settings.js"></script>
    <!-- ============ CONTACT END ============ -->
</html>