<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if(isset($_SESSION['emailhr']) || isset($_SESSION['emailemp'])){
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
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    
<style>

.donotshow{
    visibility: hidden;
    position: absolute;
}

</style>
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
            <a onclick="redirect();">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

       $curr_managers='';
       $curr_vendors='';
       $curr_recruiters='';
       $curr_description='';

if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];

        
// ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows ==1) {
                        while($row22 = $result22->fetch_assoc()) {
                        // var_dump($row22['manager'],json_decode($row22['manager']));
                            $curr_managers=json_decode($row22['manager']);
                            $curr_vendors=json_decode($row22['vendor']);
                            $curr_recruiters=json_decode($row22['recruiter']);
                            $curr_description=json_decode($row22['level_description']);

                        // var_dump($curr_managers);

                            ?>

<form  action="updatejob.php?jid=<?php echo $jid;?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h2>Job Details</h2>
                        <div class="form-group donotshow" id="job-company-group">
                            <label for="job-email">Company Name</label>
                            <!-- <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" required> -->
<input class="form-control" name="companyname" id="job-company" value="<?php echo $row22['company_name']; ?>" readonly required>

                        </div>
                        <div class="form-group donotshow" id="job-email-group">
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
                       
                        <div class="form-group" id="job-description-group" style="display:flex;justify-content:space-around">
                        <div style="width:70%">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description"id="job-description" maxlength="2000" required>
                            <?php echo htmlspecialchars($row22['job_description']); ?>
                            </textarea>
                            </div>
                         <div style="width:30%;text-align: center;list-style: none;">
                                    <label for="job-description">Autofill job</label>
                                    <?php
                                    $sqljob="SELECT * FROM Job_Posting where email='$hrcompany' and hr='$hremail'";
                                    $resultjob = $db->query($sqljob);
                                    if ($resultjob ->num_rows > 0) {
                                        while($rowjob = $resultjob->fetch_assoc()) {
                                            $postid=$rowjob['posting_id'];
                                            $jobtitle=$rowjob['job_title'];
                                            $cname=$rowjob['company_name'];
                                    echo '<li id="'.$postid.'"><a href="editjob.php?jid='.$postid.'">'.$jobtitle.'</a></li>';
                                            
                                            }
                                    }
                                    else{
                                        echo '<li><a>No Job(s)</a></li>';
                                    }
                                    ?>
                            </div>
                      
                        </div>
                        <div class="form-group" id="job-description-file-group">
                            <label for="desc-file">Upload description&nbsp; (<a href='../uploads/jd/<?php echo $jid;?>/<?php echo $row22["description_file"];?>' target="blank">View</a>)</label>
                            <input type="file" name="jobdescriptionfile" id="jobdescriptionfile">
                        </div> 
                        <div class="form-group donotshow" id="job-url-group">
                            <label for="job-url">Website (Optional)</label>
                            <input type="text" name="weburl" class="form-control" id="job-url" value="<?php echo $row22['company_url'];?>" placeholder="https://" >
                        </div>
                         <div class="form-group" id="job-cc-group">
                            <label for="job-email">Coordinator ( Assigned: <?php echo $row22['coordinator']; ?>)</label>
                            <br>
                            <select  name="cc" >
                             <option value="" >Select Coordinator</option>

            <!-- -------php code to gather posted jobs---- -->
            <?php

            $query = $db->query("SELECT * FROM admins where role='cc'");
                
            if($query ->num_rows >0){
            while($row = $query->fetch_assoc()){
                $selected = ($row['email'] ==$row22['coordinator'] ) ? 'selected="selected"'  : "";

            echo '<option value="' . $row['email'] . '"'.$selected.' >' . $row['email'] .' ('.$row['Full_name'].')' . '</option>';
            ?>
            <?php }} ?>

                            </select>
                        </div>
                          <!-- <div class="form-group" id="job-manager-group"style="background:cadetblue;">
                            <label for="job-email">Manager</label>
 <select id="companies1" name="manager" class="multiselectmanagers"  multiple="multiple"  >
</select>
                        </div> -->
                         <div class="form-group" id="job-coordinator-group"style="background:cadetblue;">
                            <label for="job-email">Vendor</label>
 <select id="companies2" name="coordinator" class="multiselect"  multiple="multiple"  >
</select>
                        </div>

                                <div class="form-group" id="job-recruiter-group"style="background:cadetblue;">
                            <label for="job-email">Recruiter</label>
 <select id="companies3" name="recruiter" class="multiselectrecruiters"  multiple="multiple" >
</select>
                        </div>

                               <div class="form-group" id="job-type-group">
                            <label for="job-type">Duplicates Evaluation Basis</label>
                            <select class="form-control" name="duplicates" id="job-type" required>
									<option>Choose</option>
									<option value="0" <?php if ($row22['duplicate_basis'] == '0')  echo 'selected = "selected"'; ?>>Project Basis</option>
									<option value="3" <?php if ($row22['duplicate_basis'] == '3')  echo 'selected = "selected"'; ?>>Last 3 months</option>
									<option value="6" <?php if ($row22['duplicate_basis'] == '6')  echo 'selected = "selected"'; ?>>Last 6 months</option>
									<option value="9" <?php if ($row22['duplicate_basis'] == '9')  echo 'selected = "selected"'; ?>>Last 9 months</option>
									<option value="12"<?php if ($row22['duplicate_basis'] == '12')  echo 'selected = "selected"'; ?> >Last 12 months</option>

								</select>
                        </div>

                            <div class="form-group" id="job-type-group">
                            <label for="job-type">Fill number of levels (max. 7)</label>
                                <br> <input type="text" class="form-control" id="member" name="member" min="1" max="7"  value="<?php echo $row22['levels']; ?>"><br />
                                    <a href="#" id="filldetails" onclick="addFields()">Show Managers</a>
                                    <div id="container"/>
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

                else{
?>


<form  action="postjob.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h2>Add a Job</h2>
                        <div class="form-group donotshow" id="job-company-group">
                            <label for="job-email">Company Name</label>
                            <!-- <input type="email" class="form-control" name="email" id="job-email" placeholder="you@yourdomain.com" required> -->
<select class="form-control" name="companyname" id="job-company">


<!-- -------php code to gather posted jobs---- -->
<?php
  if(preg_match('/"/', $hrcompany)){
                        $hrcompany=trim($hrcompany,'"');
                    }
                    
$query = $db->query("SELECT * FROM employer_account where email='$hrcompany'");
            
if($query ->num_rows >0){
    while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['company_name'] .'">' . $row['company_name'] .' ('.$row['email'].')' . '</option>';
?>
    <?php }} ?>

</select>

                        </div>
                        <div class="form-group donotshow" id="job-email-group">
                            <label for="job-email">Email</label>
                            <input type="email" class="form-control" name="email" id="job-email" value="<?php echo $hrcompany; ?>" placeholder="you@yourdomain.com" readonly required>
                        </div>
                        <div class="form-group" id="job-title-group">
                            <label for="job-title">Title</label>
                            <input type="text" name="title" class="form-control" id="job-title"  placeholder="e.g. Web Designer" required>
                        </div>
                        <div class="form-group" id="job-location-group">
                            <label for="job-location">Location (Optional)</label>
                            <input type="text" name="location" class="form-control" id="job-location"  placeholder="e.g. New York" required>
                        </div>
                       
                        <div class="form-group" id="job-type-group">
                            <label for="job-type">Job Type</label>
                            <select class="form-control" name="type" id="job-type" required>
									<option>Choose a job type</option>
									<option >Freelance</option>
									<option >Part Time</option>
									<option >Full Time</option>
									<option >Internship</option>
									<option >Volunteer</option>
								</select>
                        </div>
                       
                        <div class="form-group" id="job-description-group" style="display:flex;justify-content:space-around">
                        <div style="width:70%">
                            <label for="job-description">Description</label>
                            <textarea class="textarea form-control" name="description"id="job-description" maxlength="2000" required>
                            </textarea>
                            </div>
                              <div style="width:30%;text-align: center;list-style: none;">
                                    <label for="job-description">Autofill job</label>
                                    <?php
                                    $sqljob="SELECT * FROM Job_Posting where email='$hrcompany' and hr='$hremail' and is_closed=1";
                                    $resultjob = $db->query($sqljob);
                                    if ($resultjob ->num_rows > 0) {
                                        while($rowjob = $resultjob->fetch_assoc()) {
                                            $postid=$rowjob['posting_id'];
                                            $jobtitle=$rowjob['job_title'];
                                            $cname=$rowjob['company_name'];
                                    echo '<li id="'.$postid.'"><a href="editjob.php?jid='.$postid.'">'.$jobtitle.'</a></li>';
                                            
                                            }
                                    }
                                    else{
                                        echo '<li><a>No Job(s)</a></li>';
                                    }
                                    ?>
                            </div>
                        </div>
                        <div class="form-group" id="job-description-file-group">
                            <label for="desc-file">Upload description&nbsp;</label>
                            <input type="file" name="jobdescriptionfile" id="jobdescriptionfile">
                        </div> 
                        <div class="form-group donotshow" id="job-url-group">
                            <label for="job-url">Website (Optional)</label>
                            <input type="text" name="weburl" class="form-control" id="job-url" value="<?php echo $row22['company_url'];?>" placeholder="https://" >
                        </div>

                         <!-- <div class="form-group" id="job-manager-group"style="background:cadetblue;">
                            <label for="job-email">Manager</label>
                            <select id="companies1" name="manager" class="multiselectmanagers"  multiple="multiple"  >
                            </select>
                        </div> -->

                         <div class="form-group" id="job-coordinator-group" style="background:cadetblue;">
                            <label for="job-email">Vendor</label>
                            <select id="companies2" name="coordinator" class="multiselect"  multiple="multiple">
                            </select>
                        </div>

                                <div class="form-group" id="job-recruiter-group" style="background:cadetblue;">
                                    <label for="job-email">Recruiter</label>
                                    <select id="companies3" class="multiselectrecruiters" name="recruiter" multiple="multiple">
                                        </select>
                            </div>

                        <div class="form-group" id="job-type-group">
                            <label for="job-type">Duplicates Evaluation Basis</label>
                                    <select class="form-control" name="duplicates" id="job-type" required>
                                            <option>Choose</option>
                                            <option value="0" >Project Basis</option>
                                            <option value="3" >Last 3 months</option>
                                            <option value="6" >Last 6 months</option>
                                            <option value="9" >Last 9 months</option>
                                            <option value="12" >Last 12 months</option>

                                    </select>
                        </div>

                        <div class="form-group" id="job-type-group">
                            <label for="job-type">Fill number of levels (max. 7)</label>
                                <br> <input type="text" class="form-control" id="member" name="member" min="1" max="7"  value=""><br />
                                    <a href="#" id="filldetails" onclick="addFields()">Add Managers *</a>
                                    <div id="container"/>
                        </div>




                        <div class="row text-center">
                    <p>&nbsp;</p>
                    <button type="submit" name="submit" id="register" class="btn btn-primary btn-lg">Post <i class="fa fa-arrow-right"></i></button>
                </div>
                    </div>
             </div>
              
            </form>

<?php
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js" integrity="sha256-qoj3D1oB1r2TAdqKTYuWObh01rIVC1Gmw9vWp1+q5xw=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" integrity="sha256-7stu7f6AB+1rx5IqD8I+XuIcK4gSnpeGeSjqsODU+Rk=" crossorigin="anonymous" />

<script>


     

function redirect(){
    console.log("here");
       var referringURL = document.referrer;
       var local = referringURL.substring(referringURL.indexOf("?"), referringURL.length);
       	var currentQueryString = window.location.search;
			if (currentQueryString) {
				// return true;
                console.log(true);
                var x=history.go(-1);
                console.log(x);
			} else {
			    // return false;
                console.log(false);
                    var x=history.go(-1);
                console.log(x);

			}
}
// ----multiselect part----

$(function() {
    <?php
    $companies=array();
    $recruiters=array();
    $managers=array();
    // gathering companies
$sqlcomp='';
$sqlrec='';
$sqlmanag='';

if(isset($_SESSION['emailhr'])){
      if(preg_match('/"/', $hrcompany)){
                        $hrcompany=trim($hrcompany,'"');
                    }
    $sqlcomp = "SELECT * FROM admins where role='vendors' and company='$hrcompany'";
    $sqlrec = "SELECT * FROM admins where role='recruiters'  and company='$hrcompany'";
    $sqlmanag="SELECT * FROM admins where role='manager'  and company='$hrcompany'";

}
else{
    $sqlrec = "SELECT * FROM admins where role='recruiters'";
    $sqlcomp = "SELECT * FROM admins where role='vendors'";
    $sqlmanag="SELECT * FROM admins where role='manager'";  
}

$resultcomp = $db->query($sqlcomp);

if ($resultcomp ->num_rows >0) {
   
    while($rowcomp = $resultcomp->fetch_assoc()) {
        array_push($companies,$rowcomp['email']);
        // array_push($companies_name,$rowcomp['company_name']);

    }
}

$resultrec = $db->query($sqlrec);

if ($resultrec ->num_rows >0) {
   
    while($rowrec = $resultrec->fetch_assoc()) {
        array_push($recruiters,$rowrec['email']);
        // array_push($companies_name,$rowcomp['company_name']);

    }
}

$resultmanag = $db->query($sqlmanag);

if ($resultmanag ->num_rows >0) {
   
    while($rowmanag = $resultmanag->fetch_assoc()) {
        array_push($managers,$rowmanag['email']);
        // var_dump($rowmanag['email']);
        // array_push($companies_name,$rowcomp['company_name']);

    }
}

    ?>
  var name =<?php echo json_encode($companies) ?>;


 <?php if(!$curr_vendors){
     $curr_vendors=array();
 } ?>
 <?php if(!$curr_managers){
     $curr_managers=array();
 } ?>
 <?php if(!$curr_recruiters){
     $curr_recruiters=array();
 } ?>

<?php $i=-1; ?>


  $.map(name, function (x) {
      <?php $i=$i+1; ?>

    return $('.multiselect').append("<option <?php if(in_array($companies[$i],$curr_vendors)){echo ' selected=\"selected\"';} ?>>" + x + "</option>");
  });
  
  $('.multiselect')
    .multiselect({
      allSelectedText: 'All',
      maxHeight: 200,
      includeSelectAllOption: true
    })
    // .multiselect('selectAll', false)
    .multiselect('updateButtonText');

    // checkSelection(name);

// });


var name1 =<?php echo json_encode($recruiters) ?>;
<?php $j=-1; ?>

  $.map(name1, function (x) {
      <?php $j=$j+1; ?>

    return $('.multiselectrecruiters').append("<option <?php if(in_array($recruiters[$j],$curr_recruiters)){echo ' selected=\"selected\"';} ?>>" + x + "</option>");
  });
  
  $('.multiselectrecruiters')
    .multiselect({
      allSelectedText: 'All',
      maxHeight: 200,
      includeSelectAllOption: true
    })
    // .multiselect('selectAll', false)
    .multiselect('updateButtonText');

    // checkSelection(name);

// });


var name2 =<?php echo json_encode($managers) ?>;
<?php $k=-1; ?>
  $.map(name2, function (x) {
      <?php $k=$k+1; ?>
// <?php echo $managers[$k]; ?>
      
    return $('.multiselectmanagers').append("<option <?php if(in_array($managers[$k],$curr_managers)){echo ' selected=\"selected\"';} ?>>" + x + "</option>");
  });
  
  $('.multiselectmanagers')
    .multiselect({
      allSelectedText: 'All',
      maxHeight: 200,
      includeSelectAllOption: true
    })
    // .multiselect('selectAll', true)
    .multiselect('updateButtonText');

    // checkSelection(name);

});


function addFields(){
            var number = document.getElementById("member").value;
            var container = document.getElementById("container");
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }

            if(number<8){

                var temp=<?php echo json_encode($curr_managers) ?>;
                var desc=<?php  echo json_encode($curr_description) ?>;
// console.log(temp);
                for (i=0;i<number;i++){
                container.appendChild(document.createTextNode("Level " + (i+1)));
                  var values = <?php echo json_encode($managers) ?>

                    var select = document.createElement("select");
                    select.name = "managers[]";
                    select.id = "level"+(i+1);
                    select.className="form-control";

                    var level_desc = document.createElement("input");
                    level_desc.name = "level_description[]";
                    level_desc.id = "level_description"+(i+1);
                    level_desc.setAttribute("placeholder", "Add level description");
                    level_desc.className="form-control";

                    for (const val of values) {
                        var option = document.createElement("option");
                        option.value = val;
                        option.text = val.charAt(0).toUpperCase() + val.slice(1);
                        // $("#level"+i+" > [value=" + temp + "]").attr("selected", "true");
                        select.appendChild(option);
                    }
                container.appendChild(level_desc);
                container.appendChild(select);
                $("#level"+(i+1)).val(temp[i]);
                $("#level_description"+(i+1)).val(desc[i]);

                container.appendChild(document.createElement("br"));
                }
            }
            
        }

// }
</script>


</html>
