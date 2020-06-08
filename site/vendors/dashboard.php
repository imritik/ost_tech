<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if(isset($_SESSION['emailvendor'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';
$vendoremail=$_SESSION['emailvendor'];
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
                <li><a class="link-login" href=""+window.location.href onclick="clearuri()">Home</a></li>

               <?php
 // ------collect all jobs of company here
                    $sqljob="SELECT * FROM Job_Posting WHERE vendor='$vendoremail'";
                    $resultjob = $db->query($sqljob);
                    if ($resultjob ->num_rows > 0) {
                        while($rowjob = $resultjob->fetch_assoc()) {
                            $postid=$rowjob['posting_id'];
                            $jobtitle=$rowjob['job_title'];
                            $cname=$rowjob['company_name'];
                    echo '<li id="'.$postid.'" name="'.$postid.'" onclick="showpage(\''.$postid.'\')"><a href="#" style="width:max-content;padding: 10px;" >'.$jobtitle.'  (<small class="company_name"> '.$cname.' </small>)</a> </li>';
                            
                            }
                    }
                    else{
                        echo '<li><a class="link-login">No Jobs</a></li>';
                    }
               ?>
                <li><a class="link-login" href="../../logout/logoutvendor.php">Logout</a></li>
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
                    <a href="#"><img src="images/logo.png" alt="TalentChords" /></a>
                </div>
            </div>
            <div id="menu-open" class="pull-right">
              <a class="link-login" style="font-size:large"><?php echo $_SESSION['emailvendor'];?></a>
&nbsp;
                <a class="fm-button"><i class="fa fa-bars fa-lg"></i></a>
            </div>

        </div>
    </header>

    <!-- ============ HEADER END ============ -->

    <!-- ============ TITLE START ============ -->

    <section id="title">
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


<?php

if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];

                ?>

                <div class="container">
                        <div class="row">
                        <div class="col-md-6 head">

                    <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
                    </div>
                        <div class="col-md-6" style="text-align:center">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Add candidates</a>
                    </div>
                </div>
                <!-- CSV file upload form -->
                <div class="pull-right" id="importFrm" style="display: none;">
                <br>
                    <form action="../csv_v2/importData_vendor.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <br>
                        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                    </form>
                    <br>
                </div>
                        </div>
                        <br>
                        <!-- -----------filters---- -->
            </div>

                </section>

                <!-- ============ TITLE END ============ -->

                <!-- ============ JOBS START ============ -->

                <section id="jobs">
                    <div class="container">
                    <div class="row" style="text-align:center">
                     <?php
 // ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid' and vendor='$vendoremail'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows > 0) {
                        while($row22 = $result22->fetch_assoc()) {
                            $postid=$row22['posting_id'];
                            $jobtitle=$row22['job_title'];
                            $cname=$row22['company_name'];
                    echo '<p style="font-size:x-large"><b>JobCode:</b>'.$postid.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> JobTitle:</b>'.$jobtitle.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Company:</b>'.$cname.'</p>';
                            
                            }
                    }
                    else{
                        echo '<p style="font-size:x-large">Invalid Job</p>';
                    }
               ?>
                    </div>
   

            <br>
                                        <table class="table table-bordered">
                                                <thead>
                                                    <tr class="filters">
                                                        <th>College </th>
                                                        <!-- <th>College_location</th> -->
                                                        <!-- <th>Student id</th> -->
                                                        <th>Name</th>
                                                        <th>Contact</th>
                                                        <th>Email</th>
                                                        <!-- <th>Job title</th> -->
                                                        <!-- <th>Status</th> -->
                                                        <!-- <th>Note</th> -->
                                                        <!-- <th>Applied on</th> -->
                                                        <!-- <th>Status last updated</th> -->
                                                        <th>Registered on</th>
                                                        <th style="color:black">Resume</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <div class="alert alert-warning text-center" role="alert">
                                                <p>Duplicates will be shown here</p>
                                                <p id="duplicates-number" style="color:red"></p>
                                                </div>


                                <!-- -------php code to fetch data from two tables---- -->

                            
            <?php
            // if(isset($_POST['showstudentlist'])){
            if (isset($_COOKIE["vendorduplicate"])){
            
                $studlistobtain=explode(",",$_COOKIE['vendorduplicate']);
                $duplicatestatus=explode(",",$_COOKIE['duplicatestatus']);
                
                if(sizeof($studlistobtain)){
                    $arrlen=count($studlistobtain);
                    ?>
                    <script>
                    document.getElementById("duplicates-number").innerHTML='<?php echo $arrlen; ?> Duplicate(s) Found';
                    </script>
                    <?php
                    // echo $arrlen;
                    // echo $studlistobtain[1];
                        for($x=0;$x<$arrlen;$x++){
                        $sql = "SELECT * FROM Student where student_id='$studlistobtain[$x]'";
                        $result = $db->query($sql);
                        
                        if ($result ->num_rows >0) {
                        
                            while($row1 = $result->fetch_assoc()) {
                                $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studlistobtain[$x].'/'.$row1['resume'];
                                ?>
                                <tr >
                                <td  > <?php echo $row1["college_name"];?></td>
                                <!-- <td ><?php echo $row1["college_location"];?></td> -->
                                <!-- <td ><?php echo $row1["student_id"];?></td> -->
                                <td  ><?php echo $row1["stud_name"];?></td>
                                <td  ><?php echo $row1["contact"];?></td>
                                <td  ><a href="mailto:<?php echo $row1["email"];?>"><?php echo $row1["email"];?></a></td>
                                <!-- <td  ><?php echo $jobtitleobtain[$x];?></td> -->
                                <!-- <td  ><?php echo $statusobtain[$x];?></td> -->
                                <!-- <td  ><?php echo $noteobtain[$x];?></td> -->
                                <!-- <td class="applied" ><?php echo $appliedobtain[$x];?></td> -->
                                <!-- <td  ><?php echo $updatedonobtain[$x];?></td> -->
                                <td  ><?php echo $row1['updated_on'];?></td>
                                <td  ><a href="../../specialty/uploads/<?php echo $row1["student_id"];?>/<?php echo $row1["resume"];?>" target="blank"><?php echo $resumelinks; ?></a></td>
<td><?php echo $duplicatestatus[$x];?></td>
                                </tr>
                        
                            <?php   
                            }
                
                }
                else{
                    echo "No Duplicates";
                }

            } 
            
            }
            }
            // }
            ?>
                                <!-- ----------------- -->
                            
                            </tbody>
                        </table>
                        </div>
                    </div>
                </section>


                <?php

}
else{

      $jobcount="SELECT * FROM Job_Posting WHERE vendor='$vendoremail'";
    $jobcountresult = $db->query($jobcount);
    $jobcountrows=$jobcountresult->num_rows;

     $studcount="SELECT * FROM Student WHERE Uploaded_by='$vendoremail'";
    $studcountresult = $db->query($studcount);
    $studcountrows=$studcountresult->num_rows;



    echo "
    <div class='alert alert-info text-center' style='font-size:20px'>
    <p>Served  <b>".$studcountrows."</b> candidate(s) for <b>".$jobcountrows." </b> Client(s)</p>
    <p>Select a job to add more candidates.</p>
    </div>
    ";
}

?>
       
    <!-- ============ JOBS END ============ -->

<?php include '../partials/footer.php' ?>

    <!-- ============ CONTACT END ============ -->

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

function showpage(postid){
    document.cookie = "vendorduplicate=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    console.log(postid);
    getjobids(postid);
}
</script>
  <script>
    function getjobids(x){
        // var y=x.split('$')[0];
            // document.cookie="cname="+x;
            // document.cookie = "sids=";
            

// getting job ids with company name
                            // $.ajax({
                            //     url: '../getjobids.php',
                            //     type: 'POST',
                            //     data: {param1:y},
                            //     dataType:"json",
                            //     success:function(){console.log("seach succsss");},
                            //     error:function(data){console.log(data);}
                            // }).done(function(data){
                            //     console.log(data.list);
                            //     console.log(data.job_title);
                            //     document.cookie="jobtitle="+data.job_title;

// getting ids of student applied for jobs
                                $.ajax({
                                url: '../getstudids.php',
                                type: 'POST',
                                data: {param2:x},
                                dataType:"json",
                                success:function(){console.log("seach succsss");},
                                error:function(data){console.log(data);}
                            }).done(function(data){
                                console.log(data);
                                console.log(data.list);
                                console.log("setting sids");
                                document.cookie="sids="+data.list+";path=/";

                               clearuri();

                                location.replace(window.location.href.split('#')[0]+'?jid='+x);
                            });
                                
                            // });
    }

  
    </script>

   <script>
$('#job-company').val(document.cookie.split(';')[0].split('=')[1]);
         </script>   

         
    <script>


    function clearuri(){
        var uri = window.location.toString();
                                if (uri.indexOf("?") > 0) {
                                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                                    window.history.replaceState({}, document.title, clean_uri);
                                }

    }
       function setjscookie(){
        document.cookie="daterange1="+$('#dr1').val();
        document.cookie="daterange2="+$('#dr2').val();
        var txttitle = $('#dr1').val();
        var txtcategory = $('#dr2').val();
        display(txttitle,txtcategory);

       }


// -------------------------------

function display(startDate,endDate) {
    console.log(startDate,endDate);
    //alert(startDate)
    startDateArray= startDate.split("-");
    endDateArray= endDate.split("-");
    
    var startDateTimeStamp = new Date(startDate).getTime();
   var endDateTimeStamp = new Date(endDate).getTime();
console.log(startDateTimeStamp);

console.log(endDateTimeStamp);
    $("tr").each(function() {
        console.log("in table");
        var rowDate = $(this).find('td:nth-child(12)').text();
        
        rowDate=rowDate.substring(0,11);
        // console.log(rowDate);
        rowDateArray= rowDate.split("-");
     
var rowDateTimeStamp =  new Date(rowDate).getTime();

console.log(rowDateTimeStamp);
        
        if(startDateTimeStamp<=rowDateTimeStamp && rowDateTimeStamp<=endDateTimeStamp) {
            $(this).css("display","block");
        } else {
            $(this).css("display","none");
        }
    });
}


// ----------------------------------------

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