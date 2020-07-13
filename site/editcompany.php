<?php
session_start();
// error_reporting(E_ALL & ~E_NOTICE);

if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
include '../dbConfig.php';
// $hremail=$_SESSION['emailhr'];
// $hrcompany=$_SESSION['companyhr'];
$page="job";
include 'partials/header.php';


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
    
    

</head>

<body style='padding:0'>


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
                    $sql22="SELECT * FROM employer_account WHERE email='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows ==1) {
                        while($row22 = $result22->fetch_assoc()) {
                            ?>

<form  action="updatecompany.php?jid=<?php echo $jid;?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h2>Company Details</h2>
                        <div class="form-group" id="job-company-group">
                            <label for="job-email">Company Name</label>
                            <!-- <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" required> -->
<input class="form-control" name="companyname" id="job-company" value="<?php echo $row22['company_name']; ?>" required>

                        </div>
                        <div class="form-group" id="job-email-group">
                            <label for="job-email">Email</label>
                            <input type="email" class="form-control" name="email" id="job-email" value="<?php echo $row22['email']; ?>" placeholder="you@yourdomain.com" readonly required>
                        </div>
                        <div class="form-group" id="job-title-group">
                            <label for="job-title">Url</label>
                            <input type="text" name="title" class="form-control" id="job-title" value="<?php echo $row22['url']; ?>" placeholder="e.g. Web Designer" required>
                        </div>
                      
                       
                       
                       
                        <div class="form-group" id="job-description-group">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description"id="job-description" maxlength="2000" required>
                            <?php echo htmlspecialchars($row22['description']); ?>
                            </textarea>
                        </div>
                      
                         
                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit" id="register" class="btn btn-primary btn-lg">Update <i class="fa fa-arrow-right"></i></button>
                </div>
                    </div>
             </div>
              <br>
              <br>
              <br>
              <br>

            </form>
</div>
</div>
</div>
                            <?php
                        }
                    }
                }

                else{
echo "invlaid company";

                }
                ?>

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
    <!-- ============ CONTACT END ============ -->
</html>
