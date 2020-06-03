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
            <div class="row" style="overflow-x:auto;width: 50%;margin: auto;">
                    <form action='' method='post' >
          
            <div class="form-group" id="job-company-group">
                            <label for="job-email">Company Name</label>
                    <select class="form-control" name="companyname" id="job-company" onchange="getjobids(this.value);">

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
                    <!-- <button name="showstudentlist" class="btn btn-sm" id="srchbtn">Search</button> -->

                    </div>
                    <div class="form-group" style="text-align: center;">
                    <input type='date' name="daterange1" id="dr1">-<input type='date' name='daterange2' id="dr2">
                    <button onclick="setjscookie();">Filter</button>
                 
                   </div>
                    </form>
                        </div>

<br>
                             <table class="table table-bordered">
                                    <thead>
                                        <tr class="filters">
                                            <th>College </th>
                                            <th>College_location</th>
                                            <!-- <th>Student id</th> -->
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Job title</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>Applied on</th>
                                            <!-- <th>Status last updated</th> -->
                                            <th>Registered on</th>
                                            <th style="color:black">Resume</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <div class="alert alert-warning text-center" role="alert">
                                    <p>Duplicates will be shown here</p>
                                    <p id="duplicates-number"></p>
                                    </div>


                    <!-- -------php code to fetch data from two tables---- -->

                  
<?php
// if(isset($_POST['showstudentlist'])){
 if (isset($_COOKIE["vendorduplicate"])){
    // echo $_COOKIE["sids"]; 
    // echo $_COOKIE['daterange1'];
    // echo '2019-10-05';
    // echo strcmp("2019-10-05",$_COOKIE['daterange1']); 
    $studlistobtain=explode(",",$_COOKIE['vendorduplicate']);
    // $appliedobtain=explode(",",$_COOKIE['applied']);
    // $statusobtain=explode(",",$_COOKIE['status']);
    // $noteobtain=explode(",",$_COOKIE['note']);
    // $updatedonobtain=explode(",",$_COOKIE['updatedon']);
    // $jobtitleobtain=explode(",",$_COOKIE['jobtitle']);
    // echo sizeof($studlistobtain);
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
                    <td ><?php echo $row1["college_location"];?></td>
                    <!-- <td ><?php echo $row1["student_id"];?></td> -->
                    <td  ><?php echo $row1["stud_name"];?></td>
                    <td  ><?php echo $row1["contact"];?></td>
                    <td  ><a href="mailto:<?php echo $row1["email"];?>"><?php echo $row1["email"];?></a></td>
                    <td  ><?php echo $jobtitleobtain[$x];?></td>
                    <td  ><?php echo $statusobtain[$x];?></td>
                    <td  ><?php echo $noteobtain[$x];?></td>
                    <td class="applied" ><?php echo $appliedobtain[$x];?></td>
                    <td  ><?php echo $updatedonobtain[$x];?></td>
                    <!-- <td  ><?php echo $row1['updated_on'];?></td> -->
                    <td  ><a href="../../specialty/<?php echo $row1["student_id"];?>/<?php echo $row1["resume"];?>" target="blank"><?php echo $resumelinks; ?></a></td>
            
            
            
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
</script>
  <script>
    function getjobids(x){
        var y=x.split('$')[0];
            // alert(y);
            document.cookie="cname="+x;
            document.cookie = "sids=";
            // document.cookie = "applied=";
            // document.cookie = "status=";
            // document.cookie = "note=";
            // document.cookie = "updatedon=";
            // document.cookie = "jobtitle=";
            // document.cookie="daterange2="
            // document.cookie="daterange1="

// getting job ids with company name
                            $.ajax({
                                url: '../getjobids.php',
                                type: 'POST',
                                data: {param1:y},
                                dataType:"json",
                                success:function(){console.log("seach succsss");},
                                error:function(data){console.log(data);}
                            }).done(function(data){
                                // alert(data);
                                console.log(data.list);
                                console.log(data.job_title);
                                document.cookie="jobtitle="+data.job_title;
// getting ids of student applied for jobs
                                $.ajax({
                                url: '../getstudids.php',
                                type: 'POST',
                                data: {param2:data.list},
                                dataType:"json",
                                success:function(){console.log("seach succsss");},
                                error:function(data){console.log(data);}
                            }).done(function(data){
                                console.log(data);
                                console.log(data.list);
                                document.cookie="sids="+data.list+";path=/";
                                // document.cookie="applied="+data.applied;
                                // document.cookie="note="+data.Note;
                                // document.cookie="status="+data.Status;
                                // document.cookie="updatedon="+data.updatedon;
                               
                            });
                                
                            });
    }

  
    </script>

   <script>
$('#job-company').val(document.cookie.split(';')[0].split('=')[1]);
         </script>   

         
    <script>
       function setjscookie(){
        document.cookie="daterange1="+$('#dr1').val();
        document.cookie="daterange2="+$('#dr2').val();
        //    alert("cookies");
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
    // console.log(startDateArray);
    // console.log(endDateArray);
    var startDateTimeStamp = new Date(startDate).getTime();

    // var startDateTimeStamp = new Date(startDateArray[2],+startDateArray[0],startDateArray[1]).getTime();
    // var endDateTimeStamp = new Date(endDateArray[2],+endDateArray[0],endDateArray[1]).getTime();
    var endDateTimeStamp = new Date(endDate).getTime();
console.log(startDateTimeStamp);

console.log(endDateTimeStamp);
    $("tr").each(function() {
        console.log("in table");
        var rowDate = $(this).find('td:nth-child(12)').text();
        
        rowDate=rowDate.substring(0,11);
        // console.log(rowDate);
        rowDateArray= rowDate.split("-");
        // console.log(rowDateArray);

// var rowDateTimeStamp =  new Date(rowDateArray[2],+rowDateArray[0],rowDateArray[1]).getTime();
var rowDateTimeStamp =  new Date(rowDate).getTime();

console.log(rowDateTimeStamp);
        // alert(startDateTimeStamp<=rowDateTimeStamp)
        // alert(rowDateTimeStamp<=endDateTimeStamp)
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