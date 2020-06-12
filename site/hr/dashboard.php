<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

// if(isset($_SESSION['emailvendor'])){
    // echo $_SESSION['company'];
//   }
//   else{
//     // echo "alert('no session exist')";
//     header("location: ../../index.php");
//   }
include '../../dbConfig.php';
// $vendoremail=$_SESSION['emailvendor'];
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

<div class="container">
<h3>Jobs</h3>
<ul class="nav nav-pills nav-stacked col-md-2">

<!-- ----jobs using php -->
 <?php
 // ------collect all jobs of company here
                    $sqljob="SELECT * FROM Job_Posting";
                    $resultjob = $db->query($sqljob);
                    if ($resultjob ->num_rows > 0) {
                        while($rowjob = $resultjob->fetch_assoc()) {
                            $postid=$rowjob['posting_id'];
                            $jobtitle=$rowjob['job_title'];
                            $cname=$rowjob['company_name'];
                    echo '<li id="'.$postid.'" onclick="showpage(\''.$postid.'\')"><a href="#tab_b" data-toggle="pill">'.$jobtitle.'</a></li>';
                            
                            }
                    }
                    else{
                        echo '<li><a>No Job(s)</a></li>';
                    }
               ?>

</ul>
<div class="tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
        
        <?php

if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];
    ?>

    <script>
   $('#'+<?php echo $jid;?>).addClass('active');    
    </script>
    <?php
// ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows > 0) {
                        while($row22 = $result22->fetch_assoc()) {
                            $postid=$row22['posting_id'];
                            $jobtitle=$row22['job_title'];
                            $cname=$row22['company_name'];
                    echo '<p style="font-size:x-large">'.$jobtitle.'</p>';
                            
                            }
                    }
                    else{
                        echo '<p style="font-size:x-large">Invalid Job</p>';
                    }
                }
                ?>

<ul class="nav nav-tabs">
    <li class='new_arrival'><a  onclick="setstatus('new_arrival')">New Arrival&nbsp;<span></span></a></li>
    <li class='to_process'><a  onclick="setstatus('to_process')">To be processed&nbsp;<span></span></a></li>
    <li class='shortlist'><a  onclick="setstatus('shortlist')">Shortlisted&nbsp;<span></span></a></li>
    <li class='rejected'><a  onclick="setstatus('rejected')">Rejected&nbsp;<span></span></a></li>
    <li class='Offer'><a  onclick="setstatus('Offer')">Offered&nbsp;<span></span></a></li>

  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
       <div class="form-group tobehidden" style="transform: rotateX(180deg);overflow-x:auto">
      <table class="table" style="transform: rotateX(180deg);">
<tr class="filters">
<th style="color:black;display:flex;"><input type="checkbox" id="selectall">Select  </th>
    <th><input type="text" class="form-control width-auto" placeholder="Name"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Email"></th>
   
    <th><input type="text" class="form-control width-auto" placeholder="Current CTC"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Expected CTC"></th>
   
    <th><input type="text" class="form-control width-auto" placeholder="Notice period"></th>
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
                $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status'";
            if (!$result = mysqli_query($db, $query)) {
                exit(mysqli_error($db));
            }
            $studids=array();
            // $studstatuss=array();
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($studids,$row['student_id']);
                    // array_push($studstatuss,$row['Status']);
                } 
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
                <td><input type="checkbox" class="studentcheckbox1" value=" '.$ssid.'" name="chk"></td>
              
                    <td><?php echo $row1['stud_name'];?>&nbsp;&nbsp;<a id="'.$ssid.'"data-toggle="tooltip" title="" onclick="showlastjob(this.id)"><i class="fa fa-info-circle"></i></a></td>
                    <td><?php echo $row1['email'];?></td>
               
                    <td><?php echo $row1['curr_ctc'];?></td>
                    <td><?php echo $row1['expected_ctc'];?></td>
              
                    <td><?php echo $row1['notice_period']?>
                    </td>
                    <td><a href='<?php echo $resumelinks;?>' target='blank'>View</a></td>
                
                </tr>
                <?php
                // $number++;
            // }
            }}
            // $users .= '</table>';

        }
            else{
                // $users='No Student found!';
                echo "No Candidates";
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
       
</div><!-- tab content -->
</div>
</body>
 <!-- ============ JOBS END ============ -->

<script>

function showpage(postid){
    document.cookie = "vendorduplicate=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    console.log(postid);
    getjobids(postid);
}
  function getjobids(x){

// getting ids of student applied for jobs
                            //     $.ajax({
                            //     url: '../getstudids.php',
                            //     type: 'POST',
                            //     data: {param2:x},
                            //     dataType:"json",
                            //     success:function(){console.log("seach succsss");},
                            //     error:function(data){console.log(data);}
                            // }).done(function(data){
                            //     console.log(data);
                            //     console.log(data.list);
                            //     console.log("setting sids");
                            //     document.cookie="sids="+data.list+";path=/";

                               clearuri();

                                location.replace(window.location.href.split('#')[0]+'?jid='+x);
                            }
                                
                            // });
    

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
</script>
    <!-- ============ CONTACT END ============ -->
</html>
