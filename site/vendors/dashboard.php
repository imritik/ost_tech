<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailvendors'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';
$vendoremail=$_SESSION['emailvendors'];
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
                <li>
                    <a class="link-login" href=""+window.location.href onclick="clearuri()">Home</a>
                </li>

               <?php
                    // ------collect all jobs of company here
                    $sqljob="SELECT * FROM Job_Posting WHERE vendor LIKE '%$vendoremail%'";
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

                <li>
                    <a class="link-login" href="../../logout/logout.php">Logout</a>
                </li>
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
              <a class="link-login" style="font-size:large"><?php echo $_SESSION['emailvendors'];?></a>
&nbsp;
                <a class="fm-button"><i class="fa fa-bars fa-lg"></i></a>
            </div>

        </div>
    </header>

    <!-- ============ HEADER END ============ -->

    <!-- ============ TITLE START ============ -->

    <section id="title" style="padding: 40px 0;">
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
                        <!-- <div class="col-md-6 head"> -->

                    <!-- <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button> -->
                    <!-- </div> -->
                        <div class="col-md-12" style="text-align:center">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Add candidates</a>
                    </div>
                </div>
                <!-- CSV file upload form -->
                <div class="" id="importFrm" style="display: none;text-align: -webkit-center;">
                <br>
                    <form action="../csv_v2/importData_vendor.php?jid=<?php echo $jid;?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <br>
                        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                    </form>
                    <br>
                </div>
                        </div>
                        <!-- <br> -->
                        <!-- -----------filters---- -->
            </div>

                </section>

                <!-- ============ TITLE END ============ -->

                <!-- ============ JOBS START ============ -->

                <section id="jobs"style="padding: 40px 0;">
                    <div class="container">
                    <div class="row" style="text-align:center">
                     <?php
 // ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid' and vendor LIKE '%$vendoremail%'";
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
   


 <div class="tab-pane active" id="tab_a">
        
        <?php

if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];
    ?>

    <script>
   $('#'+<?php echo $jid;?>).addClass('active');    
    </script>
    <?php
// /
                }
                ?>

<ul class="nav nav-tabs" style="padding: 0 339px;">
    <li class='uploaded'><a  onclick="setstatus('uploaded')">Upload CV&nbsp;<span></span></a></li>
    <li class='shared'><a  onclick="setstatus('shared')">To Process&nbsp;<span></span></a></li>
    <li class='shortlist'><a  onclick="setstatus('shortlist')">Shortlisted&nbsp;<span></span></a></li>
    <li class='rejected'><a  onclick="setstatus('rejected')">Rejected&nbsp;<span></span></a></li>

  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
       <div class="form-group tobehidden" style="transform: rotateX(180deg);overflow-x:auto">
      <table class="table" style="transform: rotateX(180deg);">
<tr class="filters">
    <th>Name</th>
    <th>Email</th>
    <th>Contact</th>
    <th>Current CTC</th>
    <th>Expected CTC</th>
    <th>Notice period</th>
    <th>Resume</th>
   
    </tr>
    <tbody>
    <?php 

    if(!empty($_GET['jid'])&& !empty($_GET['status'])){
                $jid=$_GET['jid'];
                $status=$_GET['status'];
                ?>
                 <script>
   $('.<?php echo $status;?>').addClass('active');    
    </script>
    <?php
            $query='';
            $studids=array();

        if($status=='uploaded'){
               $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND Student.Uploaded_by='$vendoremail' and Student.resume='' and(applied_table.Status='Shared' or applied_table.duplicate_status='probable')";
        }
        else if($status=='shared'){

                $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='Shared'";

        }
        else{
                $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status'";

        }
            if (!$result = mysqli_query($db, $query)) {
                exit(mysqli_error($db));
            }
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($studids,$row['student_id']);
                } 
            }
            else{
             
            }


        if(sizeof($studids)){
            // $number = 1;
            $arrlength = count($studids);
        // var_dump($studids);
        ?>
        <script>
         $('.<?php echo $status;?>').find( "span" ).html('(<?php echo $arrlength;?>)'); 
        </script>
        <?php
            for($x = 0; $x < $arrlength; $x++) {
            
            

            // Get images from the database
            $query = $db->query("SELECT * FROM Student WHERE student_id='$studids[$x]'");

        

            if($query ->num_rows ==1){
            $row1 = $query->fetch_assoc();
                // echo $row1;
            $sturesume=$row1["resume"];
            $ssid=$row1['student_id'];
            $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studids[$x].'/'.$sturesume;
            //    echo $ssid;
            // while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
              
                    <td>
                    <?php echo $row1['stud_name'];?>
                    <!-- &nbsp;&nbsp;<a id="<?php echo $ssid;?>" type="button" onclick="showthisjob(this.id)"><i class="fa fa-eye"></i></a>
                    &nbsp;&nbsp;<a id="<?php echo $ssid;?>"data-toggle="tooltip" title="" onclick="showlastjob(this.id)"><i class="fa fa-info-circle"></i></a>
                    -->
                   </td>
                    <td><?php echo $row1['email'];?></td>
                    <td><?php echo $row1['contact'];?></td>

               
                    <td><?php echo $row1['curr_ctc'];?></td>
                    <td><?php echo $row1['expected_ctc'];?></td>
              
                    <td><?php echo $row1['notice_period']?>
                    </td>
                    
                    <td>

                        <!-- Add resume -->
                <?php if($status=='uploaded'){
                    ?>
<form id="<?php echo $row1["student_id"];?>" tag='<?php echo $row1["resume"];?>' class='form_resume' enctype="multipart/form-data" resumeid='<?php echo $row1["student_id"];?>'>
                <input type='file' name='upd_resume' id='resumefile<?php echo $row1["student_id"];?>'>
                <button type='submit' id='upl_resume' class='editresume' value='Upload Resume' ><i class="fa fa-upload" aria-hidden="true"></i>
</button>
</form>
                    <?php

                } 
                else{?>
                    
                    
                    <a href='<?php echo $resumelinks;?>' target='blank'>View</a>
                    
                    
                    </td>
                
                </tr>
                <?php
                }
                // $number++;
            // }
            }}
            // $users .= '</table>';

        }
            else{
                // $users='No Student found!';
                  ?>         
       <div style="transform: rotateX(180deg);">
        <p>No Candidate(s) found! </p>
        </div>
<?php
            }
    }


    ?>

    </tbody>
    </table>
    </div>
    </div>
   
  </div>
            <!-- -------------------------------------- -->
        </div>
       
<!-- </div> -->
            <!-- <br> -->
                                      


                                <!-- -------php code to fetch data from two tables---- -->

                            
            <?php
            // if(isset($_POST['showstudentlist'])){
            if (isset($_COOKIE["vendorduplicate"])){
                ?>

  <table class="table table-bordered">
                                                <thead>
                                                    <tr class="filters">
                    
                                                      
                                                        <th>College </th>
                                                        <th>Name</th>
                                                        <th>Contact</th>
                                                        <th>Email</th>
                                                        <th>Registered on</th>
                                                        <th style="color:black">Resume</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <div class="alert alert-warning text-center" role="alert">
                                                <p>Duplicates will be shown here</p>
                                                <p id="duplicates-number" style="color:red"></p>
                                                <button id="mark-duplicate" class="btn btn-xs btn-danger" style="display:none" onclick="removeduplicates();">Mark as duplicate</button>
                                                </div>


                <?php
            
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
                                <td  ><a href="../../specialty/uploads/<?php echo $row1["student_id"];?>/<?php echo $row1["resume"];?>" target="blank">View</a></td>
<td><?php echo $duplicatestatus[$x];?></td>

  <td style='display:flex'>
                <!-- Add resume -->
                <?php if($duplicatestatus[$x]!='Duplicate'){
                    ?>
<form id="<?php echo $row1["student_id"];?>" tag='<?php echo $row1["resume"];?>' class='form_resume' enctype="multipart/form-data" resumeid='<?php echo $row1["student_id"];?>'>
                <input type='file' name='upd_resume' id='resumefile<?php echo $row1["student_id"];?>'>
                <button type='submit' id='upl_resume' class='editresume' value='Upload Resume' ><i class="fa fa-upload" aria-hidden="true"></i>
</button>
</form>
                    <?php

                } ?>
                
                </td>
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
   

    function clearuri(){
        var uri = window.location.toString();
                                if (uri.indexOf("?") > 0) {
                                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                                    window.history.replaceState({}, document.title, clean_uri);
                                }

    }
    function setstatus(status){
        var uri = window.location.toString();
                                if (uri.indexOf("&") > 0) {
                                    var clean_uri = uri.substring(0, uri.indexOf("&"));
                                    window.history.replaceState({}, document.title, clean_uri);
                                }
            location.replace(window.location.href+'&status='+status);

    }
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

// ----checkbox select--

 var favorites = [];

   
$(".studentcheckbox").click(function(){

    var favorite=[];
        $.each($("input[name='id[]']:checked"), function(){            
            favorite.push($(this).val());
        });
        favorites=favorite;
     console.log(favorites);

     if(favorites.length){
            $('#mark-duplicate').show();
     }
     else{
            $('#mark-duplicate').hide();
     }
 

});

    // -----for selecting all student at once---
    $("#selectall").click(function () {

        var jobarr=[]
        $('tr').each(function(i, obj) {
            //test
            console.log(obj);
            if($(this).is(":visible")) {
            
            // console.log(obj);
            if($(this).find('.studentcheckbox').prop('checked') == false){
                $(this).find('.studentcheckbox').prop('checked',true);
                jobarr.push($(this).find('.studentcheckbox').val());
                favorites=jobarr;
                console.log(favorites);

            }
            else{
                $(this).find('.studentcheckbox').prop('checked',false);
                jobarr=[];
                favorites=jobarr;
                console.log(favorites);

            }

            }
        });

          if(favorites.length){
            $('#mark-duplicate').show();
     }
     else{
            $('#mark-duplicate').hide();
     }

    });
</script>
  <script>

function remove(array, element) {
    // console.log("in remove",element,array);
  const index = array.indexOf(element);
  array.splice(index, 1);
}

  function removeduplicates(){
      console.log(favorites);
     <?php  $originalduplicates=explode(",",$_COOKIE['vendorduplicate']); ?>
      console.log(<?php echo json_encode($originalduplicates);?>);

      for(i=0;i<favorites.length;i++){
            remove(<?php echo json_encode($originalduplicates);?>,favorites[i]);
      }
      
    
        setcookie("vendorduplicate",'<?php echo implode(",",$originalduplicates); ?>');
    //   remove the selected student id from cookie duplicatevendors


  }
    function getjobids(x){

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
                                console.log(document.cookie);

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


    
// ===================================================for updating resume------------------

$(".form_resume").on('submit',(function(e) {
    e.preventDefault();   
    // console.log(this.id); 
    var curr_stud=this.id;
    // console.log('tag',$(".form_resume").attr('tag'));
    var resumename=$(".form_resume").attr('tag');
    var myFormData = new FormData();
        var media = document.getElementById('resumefile'+curr_stud);
       console.log(resumename,curr_stud);
        myFormData.append('pictureFile', media.files[0]);
        myFormData.append('var',curr_stud);
// check for resume error here by data loaders

//         if(resumename==media.files[0]['name'] && resumename!=''){
//                         $.ajax({
//                             url: 'resumebydl.php',
//                             type: 'POST',
//                             data: myFormData,  
//                             processData: false,
//                             contentType: false, 
//                             cache: false,
                        
//                             error: function (data) {
//                                 alert(data);
//                             }
                        
//                         }).done(function(data){
//                             alert(data);
//                             console.log(data);
//                         });
//         }
//         else if(resumename==''){
//             $.ajax({
//                             url: 'resumebydl.php',
//                             type: 'POST',
//                             data: myFormData,  
//                             processData: false,
//                             contentType: false, 
//                             cache: false,
                        
//                             error: function (data) {
//                                 alert(data);
//                             }
                        
//                         }).done(function(data){
//                             alert(data);
//                             console.log(data);
//                         });
//         }
//         else{
// alert("upload right resume!");
//         }

    $.ajax({
                            url: '../resumebydl.php',
                            type: 'POST',
                            data: myFormData,  
                            processData: false,
                            contentType: false, 
                            cache: false,
                        
                            error: function (data) {
                                alert(data);
                            }
                        
                        }).done(function(data){
                            alert(data);
                            console.log(data);
                        });
   
}));



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