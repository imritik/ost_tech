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
            if($_REQUEST['status']=='Shared'){
                $statusjob='Shared';
            }
            else{
                $statusjob='has_applied';
            }
}else{
   
}
include '../dbConfig.php';
?>

<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet">

<?php
// List Users
if($statusjob=='Shared'){
    $query = "SELECT * FROM applied_table where posting_id='$jidd'";
}
else{
    $query = "SELECT * FROM applied_table where posting_id='$jidd' and coordinator_note !='rejected' and Status !='Shared' and note!='rejected'";
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
    $studlistobtain=explode(",",$_COOKIE['sidss']);
   $trimmed= array_map('trim',$studlistobtain);
    // var_dump($trimmed);
// var_dump($studids);
// var_dump(array_intersect($studids,["202"]));
$real_studids=array_intersect($studids,$trimmed);
// var_dump($real_studids);
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
    <th><input type="text" class="form-control width-auto" placeholder="Profile Segment 1"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Profile Segment 2"></th>
    </tr>
';

if(sizeof($real_studids)){
    $number = 1;
    $arrlength = count($real_studids);
// var_dump($studids);
    for($x = 0; $x < $arrlength; $x++) {
    
     

    // Get images from the database
    $query = $db->query("SELECT * FROM Student WHERE student_id='$real_studids[$x]'");

  

    if($query ->num_rows ==1){
        $row1 = $query->fetch_assoc();
        // echo $row1;
        $sturesume=$row1["resume"];
       $ssid=$row1['student_id'];
       $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$real_studids[$x].'/'.$sturesume;
    //    echo $ssid;
    // while ($row = mysqli_fetch_assoc($result)) {
        $users .='<tr>
        <td><input type="checkbox" class="studentcheckbox1" value=" '.$ssid.'" name="chk"></td>
            <td>'.$number.'</td>
            <td>'.$jidd.'</td>
           <td>'.$row1['stud_name'].'&nbsp;&nbsp;<a id="'.$ssid.'"data-toggle="tooltip" title="" onclick="showlastjob(this.id)"><i class="fa fa-info-circle"></i></a></td>
           
            <td>'.$row1['email'].'</td>
            <td>'.$row1['ug_college'].'</td>
            <td>'.$row1['contact'].'</td>
            <td><button class="btn btn-xs" id="'.$real_studids[$x].'" onclick="showcvform(\''.$resumelinks.'\',\''.$real_studids[$x].'\')">View</button></td>
            
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
            <td>'.$row1['profile_segment'].'</td>
            <td>'.$row1['profile_segment2'].'</td>
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
          .df2{
        position:fixed;
        left:0;
        bottom:0;
        height:100%;
    }
    .df3{
        position:fixed;
        right:0;
        bottom:0;
        height:100%;
        margin: -30px 100px -80px;
    }
    .df4{
        position:fixed;
        left:60%;
        bottom:50%;
        top:50%;
        height:100%;
    }
    .blur{
        /* opacity:0; */
        display:none;
    }
</style>
</head>
<body>
<div class="container">
   
    <div class="form-group">
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
    </div>
    <div class="alert alert-info tobehidden text-center"><?php echo sizeof($real_studids); ?> Student(s) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-sm btn-info' href='../job-details.php?jpi=<?php echo $jidd;?>' target='blank'>(View Job details)</a></div>
<div style="display:none"  class="text-center tobe-reused">
   <select id="admins_email" style="color:black;height:40px;"> 

        <option value="" >Select admin</option>

        <?php

        $query = $db->query("SELECT * FROM coordinators");
            
        if($query ->num_rows >0){
        while($row = $query->fetch_assoc()){

        echo '<option value="' . $row['email'] . '">' . $row['email'] .' ('.$row['name'].')' . '</option>';
        ?>
        <?php }} ?>

    </select>

    <button id="send_ids" class="btn btn-primary"  onclick="sendids();">Send</button>
    <br>
    <br>
    <label>Feedback</label>
    <select id="updatenotebtn" class="form-control">
        <option value="hold" >Hold</option>
        <option value="shortlist" >Shortlist</option>
        <option value="rejected" >Reject</option>
        <option value="blacklist">Blacklist</option>

    </select>
    <!-- <input id="updatenotebtn" class="form-control" placeholder="optional note" value="feedback" required> -->
    <br>
    <label>Profile Segment 1</label>
    <input id="ps1" class="form-control" placeholder="segment" required>
    <br>
    <label>Profile Segment 1</label>
    <input id="ps2" class="form-control" placeholder="segment" required>
    <br>
    <select class="btn btn-info" id="updatestatusbtn">
                    <option value="Round 1">Round 1</option>
                    <option value="Round 2">Round 2</option>
                    <option value="Round 3">Round 3</option>
                    <option value="Round 4">Round 4</option>
    </select>
                    &nbsp;
     <button id="rejectbtn"  class="btn btn-danger" onclick="rejectstud();"><i class="fa fa-minus-circle" aria-hidden="true"></i>Reject</button>
                    <br>
                    <button class="btn btn-info" onclick="updatestatus();">Save</button>

            
</div> 
    <br>

    <div class="form-group tobehidden" style="transform: rotateX(180deg);overflow-x:auto">
        <?php echo $users ?>
    </div>
   
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
        var is_checked=false;

   
    $(".studentcheckbox1").click(function(){
         $('.tobe-reused').show();

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
    // -----for selecting all student at once---
    $("#selectall").click(function () {
        // $('.tobe-reused').toggle();
        
        var sidc=[];
        var jobid=[];
                is_checked=!is_checked;

        $('tr').each(function(i, obj) {
                if($('tr').not(':first').is(":visible")) {

                    if(is_checked){
   // alert('hi');
                            $(this).find('.studentcheckbox1').prop('checked',true)
                            if($(this).find('.studentcheckbox1').prop('checked') == true){
                                console.log($(this).find('.studentcheckbox1').val());
                                sidc.push($(this).find('.studentcheckbox1').val());
                                jobid.push($(this).find('.studentcheckbox1').closest("tr").find('td:eq(2)').text());
                                favorites=sidc;
                                jobrefs=jobid;
                            }

                 
                     }
                    else{
                        console.log("here");
                        $(this).find('.studentcheckbox1').prop('checked',false);
                        favorites=sidc;
                        jobrefs=jobid;
                    }
                }
                // }
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
                    $rows.show();
                    $filteredRows.slice(1).hide();

                    $tobeshown=$table.find('tbody tr:visible');
                            $visible_rows=$tobeshown;
                            console.log($visible_rows);

                    // ===--------------
                    console.log($filteredRows,"filtered");
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
        var ps1=$('#ps1').val();
        var ps2=$('#ps2').val();

        newArray1.forEach(function(obj){

            var stid=obj.split(',')[0];
            var jid=obj.split(',')[1];

         

            // call to function for updating status
            updatestatusofeach(stid,jid,statusvalue,notevalue,ps1,ps2);
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

    function updatestatusofeach(x,y,z,q,a,b){

                console.log(x,y,z,q,a,b);
                $.ajax({
                                url: 'cc_updatestudentstatus.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y,param3:z,param4:q,param5:a,param6:b},
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
   

    window.location=window.location.protocol + "//" + window.location.host + window.location.pathname + '?jid=<?php echo $jidd;?>&status='+cat;
}
    

 var frm = ['cv'];
 var hrf=[];
 function setSource() {
     console.log("in set source");
            for(i=0, l=frm.length; i<l; i++) {
                document.querySelector('iframe[name="'+frm[i]+'"]').src = hrf[i];
            }
        }
     function showform(){
        $('.tobehidden').removeClass('blur');
        $('.tobe-reused').removeClass('df3');
        $('.tobe-reused').toggle();
         $('.df2').toggle();
         $('.df3').toggle();
         $('.df4').toggle();


     }
     function showcvform(x,y){
         $('.tobe-reused').hide();

         $('.tobe-reused').addClass('df3');
         console.log(x);
         var hrf1 = [x];
         hrf=hrf1;
        var favorite=[];
        var jobref=['<?php echo $jidd;?>'];
        favorite.push(y);
        favorites=favorite;
        jobrefs=jobref;
        var newArray = favorites.map((e, i) => e +','+ jobrefs[i]);
        newArray1=newArray;
        console.log(newArray1);
         setSource();
         $('.tobehidden').addClass('blur');
         $('.df2').toggle();
         $('.df3').toggle();
         $('.df4').toggle();
     }

  function getUnique(array){
        var uniqueArray = [];
        
        // Loop through array values
        for(i=0; i < array.length; i++){
            if(uniqueArray.indexOf(array[i]) === -1) {
                uniqueArray.push(array[i]);
            }
        }
        return uniqueArray;
    }

       function getjobids(x){
        var y=x
            // alert(y);
            document.cookie = "sidss=";
          
// getting student ids with admin email

                            $.ajax({
                                url: 'cc_studentbyadmin.php',
                                type: 'POST',
                                data: {param1:y},
                                dataType:"json",
                                success:function(){console.log("seach succsss");},
                                error:function(data){console.log(data);}
                            }).done(function(data){
                                // alert(data);
                                console.log(data,"new data");
                                                       console.log(getUnique(data));     

                                document.cookie="sidss="+getUnique(data);
                                // $( "#foo" ).trigger( "click" );

    });
    }

      // -------document ready
        $( document ).ready(function() {
            console.log( "ready!" );
            getjobids('<?php echo $_SESSION['ccemp'] ?>');

        });
          function showlastjob(id){
        //  alert(id);
        //  ajax request to fetch job stats
                            $.ajax({
                                url: 'jobstats.php',
                                type: 'POST',
                            
                                data: {param1: id},
                            })
                            .done(function(response) {
                                // alert(response);
                                data=JSON.parse(response)
                                console.log(data,typeof(data));
                                // location.reload();
var newtext='Status: '+data.Status+'\n Feedback: '+data.Note+'\n Applied_at: '+data.Status_update.slice(0,10)
                                $('#'+id).tooltip('hide')
                                .attr('data-original-title',newtext)
                                .tooltip('show');
                               
                            })
                            .fail(function() {
                                alert("error while fetching");
                            });
     }

</script>

  <div class='df2'style='display:none'>
 <iframe id="forPostyouradd" name='cv' data-src="http://www.w3schools.com" src="loaders_form/form.php?jid=2" width="750" style="background:#ffffff;height:inherit"></iframe>
 </div>
 
 <div class='df4' style='display:none'><button onclick='showform();'><i class="fa fa-close" style="font-size:30px;color:red"></i></button></div>
 
</div>
</body>
</html>
