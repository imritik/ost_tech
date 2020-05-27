
<?php
// echo $_REQUEST['jid'];
// $jidd=$_REQUEST['jid'];
session_start();
include '../dbConfig.php';
if(isset($_SESSION['emailemplevel2'])){
}
else{
  header("location: ../index.php");
}
$email=$_SESSION['emailemplevel2'];

?>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title>Job Board </title>
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- <link href="css/style.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Main Stylesheet -->
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
            <br>

            <ul class="nav">
                
                <li><a class="link-login btn btn-danger pull-right" href="../logout/logout.php">Logout</a></li>
            </ul>
        </div>
        <!-- end Menu -->
    </div>

    <!-- ============ NAVBAR END ============ -->

    <!-- ============ HEADER START ============ -->

   

    <!-- ============ HEADER END ============ -->
<?php
// List Users
$query = "SELECT * FROM to_admin where recieved_email='$email'";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}
$studids=array();
$jobid=array();
// $studstatuss=array();
 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data=json_decode(stripslashes($row['stud_id']));
// var_dump($data);
                    foreach($data as $d){
                        array_push($studids,$d);
                        array_push($jobid,json_decode($row['job_id_ref']));
                    }
        
        // array_push($studstatuss,$row['Status']);
    } 
}

// ----collecting the status-----
$arrlength = count($studids);
// var_dump($studids);
$studstatuss=array();

    for($x = 0; $x < $arrlength; $x++) {
    
$query = "SELECT * FROM applied_table where posting_id=$jobid[$x] and student_id=$studids[$x]";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}

 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
       
        array_push($studstatuss,$row['Status']);
    } 
}
    }


    $users = '<table class="table table-striped">
    <tr>
    <th style="color:black;display:flex;"> </th>
        <th>No.</th>
        <th>JOb reference</th>
        <th>Name</th>
        <th>Email</th>
        <th>College</th>
        <th>contact</th>
        <th>Resume</th>
       <th>Address</th>
        <th>Status</th>
        <th>tech</th>
        <th>Experience</th>
        <th>Add. courses</th>
        <th>Expected ctc</th>
        <th>Preferred loc</th>
        <th>Previous companies</th>
        <th>Languages</th>
    
    </tr>
    ';
    
    if(sizeof($studids)){
        $number = 1;
        $arrlength = count($studids);
    // var_dump($studids);
        for($x = 0; $x < $arrlength; $x++) {
        
         
    
        // Get images from the database
        $query = $db->query("SELECT * FROM Student WHERE student_id='$studids[$x]'");
    
      
    
        if($query ->num_rows ==1){
            $row1 = $query->fetch_assoc();
            // echo $row1;
            $sturesume=$row1["resume"];
           $ssid=$row1['student_id'];
           $joblink='../job-details.php?jpi='.$jobid[$x];
           $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studids[$x].'/'.$sturesume;
        //    echo $ssid;
        // while ($row = mysqli_fetch_assoc($result)) {
            $users .='<tr>
            <td><input type="checkbox" class="studentcheckbox" value=" '.$ssid.'" name="chk"></td>
                <td>'.$number.'</td>
                <td><a href="'.$joblink.'" target="blank">'.$jobid[$x].'</a></td>
                <td>'.$row1['stud_name'].'</td>
                <td>'.$row1['email'].'</td>
                <td>'.$row1['college_name'].'</td>
                <td>'.$row1['contact'].'</td>
                <td><a href="../specialty/uploads/'.$studids[$x].'/'.$sturesume.'" target="blank">'.$resumelinks.'</a></td>
                <td>'.$row1['address'].'</td>
                <td>'.$studstatuss[$x].'</td>
                <td>'.$row1['tech'].'</td>
                <td>'.$row1['experience'].'</td>
                <td>'.$row1['add_courses'].'</td>
                <td>'.$row1['expected_ctc'].'</td>
                <td>'.$row1['preferred_loc'].'</td>
                <td>'.$row1['prev_comp'].'</td>
                <td>'.$row1['languages'].'</td>
            </tr>';
            $number++;
        // }
        }}
        $users .= '</table>';

}
    else{
        $users='No Student found!';
    }
       ?>
 
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <!--  Header  -->
    <div class="row">
        <div class="col-md-12">
        
        </div>
    </div>
    <!--  /Header  -->
 <br>
    <!--  Content   -->
    <div class="alert alert-info text-center"><?php echo sizeof($studids); ?> Student(s) Shortlisted</div>
    <div style="display:block" class="text-center">
   
    <!-- ------------------------- -->
<input id="updatenotebtn" class="form-control" placeholder="optional note" value="passed" style="width:auto;display:none">
    <select class="btn btn-info" id="updatestatusbtn" style="display:none" onchange="updatestatus();">
            <option value="Round 1">Round 1</option>
            <option value="Round 2">Round 2</option>
            <option value="Round 3">Round 3</option>
            <option value="Round 4">Round 4</option>
    </select>
            &nbsp;
            <button id="rejectbtn"  class="btn btn-danger" style="display:none" onclick="rejectstud();"><i class="fa fa-minus-circle" aria-hidden="true"></i>Reject</button>
            <br>
            
    </div>
    <br>

    <div class="form-group">
        <?php echo $users ?>
    </div>
    <div class="form-group">
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
    </div>
    <!--  /Content   -->
 
    <script>var statusvalue=$('#updatestatusbtn').val();
       


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
            var rows = document.querySelectorAll("table tr");
            
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

    <script>
        var favorites = [];
        var jobrefs=[];
        var newArray1=[];

   
    $(".studentcheckbox").click(function(){
        $('#updatestatusbtn').show();
        $('#updatenotebtn').show();
        $('#rejectbtn').show();
        $('#admins_email').show()
        $('#send_ids').show();
        var favorite=[];
        var jobref=[];
            $.each($("input[name='chk']:checked"), function(){  
                console.log($(this).val());          
                favorite.push($(this).val());
                jobref.push($(this).closest("tr").find('td:eq(2)').text());
            });
            favorites=favorite;
            jobrefs=jobref;
            var newArray = favorites.map((e, i) => e +','+ jobrefs[i]);
            newArray1=newArray;
         console.log(newArray1);
         
     

    });
    // -----for selecting all student at once---
    $("#selectall").click(function () {
        $('#updatestatusbtn').toggle();
        $('#rejectbtn').toggle();
        var sidc=[];
        var jobid=[];
        if($('tr').is(":visible")) {
            // alert('hi');

            $(".studentcheckbox").prop('checked', $(this).prop('checked'));
            console.log($(".studentcheckbox").val());
            sidc.push($(".studentcheckbox").val());
            jobid.push($(".studentcheckbox").closest("tr").find('td:eq(2)').text());
            favorites=sidc;
            jobrefs=jobid;

    //It's visible
        }
        var newArray = favorites.map((e, i) => e +','+ jobrefs[i]);
        newArray1=newArray;
         console.log(newArray1);
   
    });
    
    

    function updatestatus(){

        var statusvalue=$('#updatestatusbtn').val();
        var notevalue=$('#updatenotebtn').val();

        newArray1.forEach(function(obj){

            var stid=obj.split(',')[0];
            var jid=obj.split(',')[1];

         

            // call to function for updating status
            updatestatusofeach(stid,jid,statusvalue,notevalue);
        });

    }

    function rejectstud(){

                  newArray1.forEach(function(obj){

                        var stid=obj.split(',')[0];
                        var jid=obj.split(',')[1];


                            // call to function for rejecting student
                            rejectstudeach(stid,jid);
        });

    }

    function updatestatusofeach(x,y,z,q){

console.log(x,y,z,q);
                $.ajax({
                                url: 'updatestudentstatus.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y,param3:z,param4:q},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();

                               
                            })
                            .fail(function() {
                                alert("error in updating status");
                            });

    }

    function rejectstudeach(x,y){
console.log(x,y);

                $.ajax({
                                url: 'rejectstudent.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("error in rejecting");
                            });

    }


function sendids(){
    var newArray = favorites.map((e, i) => e +','+ jobrefs[i]);
    var stid=[];
    var jid=[];
    newArray.forEach(function(obj){

stid=obj.split(',')[0];
jid=obj.split(',')[1];
});
    // ------------
    var x= $('#admins_email').val();
    var y=JSON.stringify(stid);
    var z=JSON.stringify(jid);
    var w='<?php echo $_SESSION['emailemplevel2'];?>';

    // ----inserting----
    $.ajax({
                                url: 'toadmin.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:JSON.stringify(favorites),param3:z,param4:w},
                            })
                            .done(function(response) {
                                alert(response);
                               $('#send_ids').html('sent!');
                            })
                            .fail(function() {
                                alert("error while sending");
                            });

}
    
    </script>
</div>
</body>
</html>
