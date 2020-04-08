<?php
// echo $_REQUEST['jid'];
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");

  }
$jidd=$_REQUEST['jid'];
$statusjob='has_applied';
if($_REQUEST['status']){
            if($_REQUEST['status']=='Offer'){
                $statusjob='Offer';
            }
            else{
                $statusjob='has_applied';
            }
}else{
   
}
include '../dbConfig.php';
?>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet">

<?php
// List Users
if($statusjob=='Offer'){
    $query = "SELECT * FROM applied_table where posting_id='$jidd'";
}
else{
    $query = "SELECT * FROM applied_table where posting_id='$jidd' and Status !='Offer'";
}
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}
$studids=array();
$studstatuss=array();
 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($studids,$row['student_id']);
        array_push($studstatuss,$row['Status']);
    } 
}
// var_dump($studids,$statusjob);
$users = '<table class="table" style="transform: rotateX(180deg);">
<tr class="filters">
<th style="color:black;display:flex;"><input type="checkbox" id="selectall">Select  </th>
    <th>No.</th>
    <th>Job reference</th>
    <th><input type="text" class="form-control width-auto" placeholder="Name"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Email"></th>
    <th><input type="text" class="form-control width-auto" placeholder="College"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Contact"></th>
    <th>Resume</th>
    <th><input type="text" class="form-control width-auto" placeholder="Status"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Current CTC"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Expected CTC"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Company"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Current location"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Notice period"></th>
    <th><input type="text" class="form-control width-auto" placeholder="UG college"></th>
    <th><input type="text" class="form-control width-auto" placeholder="UG degree"></th>
    <th><input type="text" class="form-control width-auto" placeholder="PG college"></th>
    <th><input type="text" class="form-control width-auto" placeholder="PG degree"></th>

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
       $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studids[$x].'/'.$sturesume;
    //    echo $ssid;
    // while ($row = mysqli_fetch_assoc($result)) {
        $users .='<tr>
        <td><input type="checkbox" class="studentcheckbox1" value=" '.$ssid.'" name="chk"></td>
            <td>'.$number.'</td>
            <td>'.$jidd.'</td>
            <td>'.$row1['stud_name'].'</td>
            <td>'.$row1['email'].'</td>
            <td>'.$row1['ug_college'].'</td>
            <td>'.$row1['contact'].'</td>
            <td><a href="../specialty/uploads/'.$studids[$x].'/'.$sturesume.'" target="blank">'.$resumelinks.'</a></td>
            
            <td>'.$studstatuss[$x].'</td>
            <td>'.$row1['curr_ctc'].'</td>
            <td>'.$row1['expected_ctc'].'</td>
            <td>'.$row1['curr_comp'].'</td>
            <td>'.$row1['curr_loc'].'</td>
            <td>'.$row1['notice_period'].'</td>
            <td>'.$row1['ug_college'].'</td>
            <td>'.$row1['ug_degree'].'</td>
            <td>'.$row1['pg_college'].'</td>
            <td>'.$row1['pg_degree'].'</td>
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
  <style>
  .width-auto{
            width:auto;
        }
</style>
</head>
<body>
<div class="container">
    <!--  Header  -->
    <!-- <div class="row">
        <div class="col-md-12">
        
        </div>
    </div> -->
    <!--  /Header  -->
 <!-- <br> -->
    <!--  Content   -->
    <div class="form-group">
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
    </div>
    <div class="alert alert-info text-center"><?php echo sizeof($studids); ?> Student(s) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-sm btn-info' href='../job-details.php?jpi=<?php echo $jidd;?>' target='blank'>(View Job details)</a>&nbsp;&nbsp;&nbsp;<a class='btn btn-sm btn-info' onclick='urlchange("Offer");'>View Offered Students</a>&nbsp;&nbsp;&nbsp;<a class='btn btn-sm btn-info' onclick='urlchange("has_applied");'>View students applied</a> </div>
    <div style="display:block" class="text-center">
    <!-- --------------- -->

   <select id="admins_email" style="color:black;height:40px;display:none">

<option value="" >Select admin</option>

<!-- -------php code to gather posted jobs---- -->
<?php

$query = $db->query("SELECT * FROM admins where role!='DL'");
    
if($query ->num_rows >0){
while($row = $query->fetch_assoc()){

echo '<option value="' . $row['email'] . '">' . $row['email'] .' ('.$row['Full_name'].')' . '</option>';
?>
<?php }} ?>

</select>

<button id="send_ids" class="btn btn-primary" style="display:none" onclick="sendids();">Send</button>
    <!-- ------------------------- -->
<input id="updatenotebtn" class="form-control" placeholder="optional note" value="feedback" style="width:auto;display:none">
    <select class="btn btn-info" id="updatestatusbtn" style="display:none" onchange="updatestatus();">
            <option value="Round 1">Round 1</option>
            <option value="Round 2">Round 2</option>
            <option value="Round 3">Round 3</option>
            <option value="Round 4">Round 4</option>
    </select>
            &nbsp;
            <button id="rejectbtn"  class="btn btn-danger" style="display:none" onclick="rejectstud();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
            <br>
            
    </div>
    <br>

    <div class="form-group" style="transform: rotateX(180deg);overflow-x:auto">
        <?php echo $users ?>
    </div>
    <!-- <div class="form-group">
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
    </div> -->
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

   
    $(".studentcheckbox1").click(function(){
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
        $('#updatenotebtn').toggle();
        $('#rejectbtn').toggle();
        $('#admins_email').toggle()
        $('#send_ids').toggle();
        var sidc=[];
        var jobid=[];
        //  var favorites = [];
        $('tr').each(function(i, obj) {

                if($('tr').is(":visible")) {
                if($(this).find('.studentcheckbox1').prop('checked') == false){

                    // alert('hi');
                    $(this).find('.studentcheckbox1').prop('checked',true)
                    console.log($(this).find('.studentcheckbox1').val());
                    sidc.push($(this).find('.studentcheckbox1').val());
                    jobid.push($(this).find('.studentcheckbox1').closest("tr").find('td:eq(2)').text());
                    favorites=sidc;
                    jobrefs=jobid;
                }
                else{
                    $(this).find('.studentcheckbox1').prop('checked',false);
                     favorites=sidc;
                    jobrefs=jobid;
                }
            }
        });

        var newArray = favorites.map((e, i) => e +','+ jobrefs[i]);
        newArray1=newArray;
         console.log(newArray1);
   
    });

     function FilterRow($input){
           console.log("in filter function",$input);
           $tobeshown=[];
        $visible_rows=[];

            if(!$input.length){
                var rows = $('.table tr');
                rows.show();
            }
        //    loop through the filters here
        for(var i = 0; i < $input.length; i++){
                inputContent = $input[i].val().toLowerCase(),
                // $panel = $input[i].parents('.filterable'),
                column = $('.filters th').index($input[i].parents('th')),
                $table = $('.table'),
                $rows = $table.find('tbody tr');
                // console.log($rows);
                if($visible_rows.length && inputContent!=''){
                    // console.log("filtered rows here");
                    $rows=$visible_rows;
                }
                else{
                    // console.log("all rows here");
                }

                if(inputContent=='#'){
                    // console.log("blank search will be there");
                    var $filteredRows = $rows.filter(function() {
                            var value = $(this).find('td').eq(column).text().trim()!='';
                            return value === true;
                            // console.log(value);
                    });
                }
                else{
                            /* Dirtiest filter function ever ;) */
                            var $filteredRows = $rows.filter(function() {
                                            var value = $(this).find('td').eq(column).text().toLowerCase();
                                            return value.indexOf(inputContent) === -1;
                            });
                }
            
                    /* Clean previous no-result if exist */
                    // $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    // var firstrows = $('.table tr:first');
                    // firstrows.show();
                    // console.log(firstrows,"first rows");
                    $rows.show();
                    $filteredRows.slice(1).hide();

                    $tobeshown=$table.find('tbody tr:visible');
                            $visible_rows=$tobeshown;
                            console.log($visible_rows);

                    // ===--------------
                    console.log($filteredRows,"filtered");
                    /* Prepend no-result row if all rows are filtered */
                    // if ($filteredRows.length === $rows.length) {
                    //     $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
                    // }
                    // console.log(getVisibleRows());
        }
            }
    
    $('.filters input').keyup(function(e) {
        console.log(e);
            console.log($(this));
            var inputs = $(".filters input").slice(1);
            var input_array=[];
            var $input = $(this);
        
            for(var i = 0; i < inputs.length; i++){
                // alert($(inputs[i]).val());
                if($(inputs[i]).val()!=''){
                    input_array.push($(inputs[i]));
                    //  FilterRow($(inputs[i]));
                }
                else{
                        //  var $input = $(this);
                        // FilterRow($input);
                }
            }
console.log(input_array);
            var code = e.keyCode || e.which;
            if (code == '9') return;
            FilterRow(input_array);
            // getVisibleRows();
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
                                // alert(response);
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
                                // alert(response);
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
    var w='<?php echo $_SESSION['emailemp'];?>';

    // ----inserting----
    $.ajax({
                                url: 'toadmin.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:JSON.stringify(favorites),param3:z,param4:w},
                            })
                            .done(function(response) {
                                // alert(response);
                               $('#send_ids').html('sent!');
                            })
                            .fail(function() {
                                alert("error while sending");
                            });

}

function urlchange(cat){
    // alert(cat);
    // var name=window.location.search.substr(1);
    // var tags=name.split('=')[1];
    // alert(tags);
    // $('#'+tags).trigger('click');
    // if (history.pushState) {
    //       var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?jid=<?php echo $jidd;?>&status='+cat;
    //       window.history.pushState({path:newurl},'',newurl);
    //   }

    window.location=window.location.protocol + "//" + window.location.host + window.location.pathname + '?jid=<?php echo $jidd;?>&status='+cat;
}
    
    </script>
</div>
</body>
</html>
