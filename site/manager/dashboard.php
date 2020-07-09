<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

if(isset($_SESSION['emailmanager'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';
$hremail=$_SESSION['emailmanager'];
$hrcompany=$_SESSION['companymanager'];
$page="job";
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
    
<style>
 .fill{
            width:-webkit-fill-available;
        }
        .width-auto{
            width:auto;
        }
</style>
</head>

<body style='padding:0'>

 <!-- ============ HEADER START ============ -->
 <header>
        <div id="header-background"></div>
        <div class="container">
            <div class="pull-left">
             <b>Manager<b> (<?php echo $hremail; ?>)
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


   <br>
    <div class="row">
    <div class="col-md-2 fixed-top">
<h3>Jobs</h3><span><?php echo $hrcompany;?></span>

<ul class="nav nav-pills nav-stacked">

<!-- ----jobs using php -->
 <?php
 // ------collect all jobs of company here
                    $sqljob="SELECT * FROM Job_Posting where email='$hrcompany'";
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
</div>
<div class="tab-content col-md-10">
<div style="display:none"  class="text-center tobe-reused">

   
    <div style="display:flex;justify-content: center;">
    <div>
    <!-- <label>Feedback</label> -->
    <select id="updatenotebtn" class="form-control">
        <option value="hold" >Hold</option>
        <option value="shortlist" >Shortlist</option>
        <option value="rejected" >Reject</option>
        <option value="blacklist">Blacklist</option>
    </select>
    </div>
    <div>
    <input id="hrfeedback" class="form-control" name="hrfeedback" placeholder="detailed feedback" value="feedback" required>
  </div>
  </div>
  <br>
    <!-- <select class="btn btn-info" id="updatestatusbtn"  onchange="updatestatus();">
                    <option value="Round 1">Round 1</option>
                    <option value="Round 2">Round 2</option>
                    <option value="Round 3">Round 3</option>
                    <option value="Round 4">Round 4</option>
    </select> -->
                    <!-- &nbsp; -->
                    <button class="btn btn-info" onclick="updatestatus();">Save</button>
     <!-- <button id="rejectbtn"  class="btn btn-danger" onclick="rejectstud();"><i class="fa fa-minus-circle" aria-hidden="true"></i>Reject</button> -->
                    <br>
            
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
// ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows > 0) {
                        while($row22 = $result22->fetch_assoc()) {
                            $postid=$row22['posting_id'];
                            $jobtitle=$row22['job_title'];
                            $cname=$row22['company_name'];
                    echo '<div><p style="font-size:x-large;margin-bottom:0">'.$jobtitle.'</p>
                  
                    ';
                            
                            }
                    }
                    else{
                        echo '<p style="font-size:x-large">Invalid Job</p>';
                    }
                // }
                ?>

<ul class="nav nav-tabs">
    <li class='hold'><a  onclick="setstatus('hold')">To be processed&nbsp;<span></span></a></li>
    <li class='shortlist'><a  onclick="setstatus('shortlist')">Shortlisted&nbsp;<span></span></a></li>
    <li class='rejected'><a  onclick="setstatus('rejected')">Rejected&nbsp;<span></span></a></li>

  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
       <div class="tobehidden" style="transform: rotateX(180deg);overflow-x:auto">
      <table class="table" style="transform: rotateX(180deg);">
<tr class="filters">
<th style="color:black;display:flex;"><input type="checkbox" id="selectall">Select  </th>
    <th><input type="text" class="form-control width-auto" placeholder="Name"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Email"></th>
   
    <th><input type="text" class="form-control width-auto" placeholder="Current CTC"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Expected CTC"></th>
   
    <th><input type="text" class="form-control width-auto" placeholder="Notice period"></th>
    <th>Resume</th>
    
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="HR comment" readonly></th>
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Manager comment" readonly></th>
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Recruiter comment" readonly></th>
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Your comment" readonly></th>
    
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Status" readonly></th>
   
   
    </tr>
    <tbody>
    <?php 
}
    if(!empty($_GET['jid'])&& !empty($_GET['status'])){
                $jid=$_GET['jid'];
                $status=$_GET['status'];
                ?>
                 <script>
   $('.<?php echo $status;?>').addClass('active');    
    </script>
    <?php
$query='';
        if($status=='new_arrival'){
                $query = "SELECT * FROM applied_table where posting_id='$jid' and Status_update >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";

        }
        else if($status=='to_process'){
                $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status'";

        }
        else{
                $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status'";

        }
            if (!$result = mysqli_query($db, $query)) {
                exit(mysqli_error($db));
            }
            $studids=array();
            $hrcomment=array();
            $recruitercomment=array();
            $managercomment=array();
            // $studstatuss=array();
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($studids,$row['student_id']);
                
                    array_push($hrcomment,$row['hr_note']);
                    array_push($managercomment,$row['manager_note']);
                    array_push($recruitercomment,$row['recruiter_note']);

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
                <td><input type="checkbox" class="studentcheckbox1" value="<?php echo $ssid;?>" name="chk"></td>
              
                    <td>
                    <?php echo $row1['stud_name'];?>
                    &nbsp;&nbsp;<a id="<?php echo $ssid;?>" type="button" onclick="showthisjob(this.id)"><i class="fa fa-eye"></i></a>
                    &nbsp;&nbsp;<a id="<?php echo $ssid;?>"data-toggle="tooltip" title="" onclick="showlastjob(this.id)"><i class="fa fa-info-circle"></i></a>
                   
                   </td>
                    <td><?php echo $row1['email'];?></td>
               
                    <td><?php echo $row1['curr_ctc'];?></td>
                    <td><?php echo $row1['expected_ctc'];?></td>
              
                    <td><?php echo $row1['notice_period']?>
                    </td>
                    <td><a href='<?php echo $resumelinks;?>' target='blank'>View</a></td>
                    <td><?php echo $hrcomment[$x];?></td>
                    <td><?php echo $managercomment[$x];?></td>
                   
                    <td><?php echo $recruitercomment[$x];?></td>
<td><input class="form-control" id="manager_comment<?php echo $ssid;?>"></td>
                    <td>
                    <td>
                     <select id="updatenotebtn<?php echo $ssid;?>" class="form-control">
        <option value="hold" >Hold</option>
        <option value="shortlist" >Shortlist</option>
        <option value="rejected" >Reject</option>
        <option value="blacklist">Blacklist</option>
    </select>
                    </td>
                
                </tr>
                <?php
                // $number++;
            // }
            }}

            ?>

          

            <?php
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
    <br>
    <br>
  
        <div style="float:right;">
                <button class="btn btn-primary">Save</button>
        </div>
           
    </div>
   
  </div>
            <!-- -------------------------------------- -->
        </div>
       
</div><!-- tab content -->
</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">This Job Feedbacks</h4>
      </div>
      <div class="modal-body thisjob">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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
 <script>
         var favorites = [];
        var jobrefs=[];
        var newArray1=[];
        var is_checked=false;


$('#admins_email').on('change', function () {
    $('#send_ids').prop('disabled', !$(this).val());
}).trigger('change');

   
    $(".studentcheckbox1").click(function(){
        //  $('.tobe-reused').show();

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

         if(newArray1.length){
         $('.tobe-reused').show();
         }
         else{
         $('.tobe-reused').hide();

         }
         
     

    });
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
           if(newArray1.length){
         $('.tobe-reused').show();
         }
         else{
         $('.tobe-reused').hide();

         }
   
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

        var statusvalue="manager";
        var notevalue=$('#updatenotebtn').val();
        var hrfeedback=$('#hrfeedback').val();
        newArray1.forEach(function(obj){

            var stid=obj.split(',')[0];
            var jid="<?php echo $_GET['jid']?>";
            var ps1="";
            var ps2="";
         

            // call to function for updating status
            updatestatusofeach(stid,jid,statusvalue,notevalue,hrfeedback,ps2);
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
                                url: '../updatestudentstatus.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y,param3:z,param4:q,param5:a,param6:b},
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
        jid="<?php echo $_GET['jid']?>";
        });
            // ------------
            var x= $('#admins_email').val();
            var y=JSON.stringify(stid);
            var z=JSON.stringify(jid);
            var w='<?php echo $_SESSION['emailhr'];?>';

            // ----inserting----
            $.ajax({
                                        url: '../am_toadmin.php',
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

     function showlastjob(id){
        //  alert(id);
          jid=<?php echo $_GET['jid'];?>
        //  ajax request to fetch job stats
                            $.ajax({
                                url: '../jobstats.php',
                                type: 'POST',
                            
                                data: {param1: id,param2:jid},
                            })
                            .done(function(response) {
                                // alert(response);
                                data=JSON.parse(response)
                                console.log(data,typeof(data));
                                // location.reload();
var newtext='Last Job Status: '+data.Status+'\n  , Feedback: '+data.Note+'\n   ,   Applied_at: '+data.Status_update.slice(0,10)
                                $('#'+id).tooltip('hide')
                                .attr('data-original-title',newtext)
                                .tooltip('show');
                               
                            })
                            .fail(function() {
                                alert("error while fetching stats");
                            });
     }

     function showthisjob(id){
        //  ajax request to fetch job stats
                            $.ajax({
                                url: '../thisjobstats.php',
                                type: 'POST',
                            
                                data: {param1: id,param2:<?php echo $_GET['jid'];?>},
                            })
                            .done(function(response) {
                                data=JSON.parse(response)
                                console.log(data);

                                var html = "<table border='1|1'class='table table-striped'>";
                                for (var i = 0; i < data.length; i++) {
                                    if(data[i]){
                                        for(var j=0;j<data[i].length;j++){
                                            var res = data[i][j].split("$");
                                            html+="<tr>";
                                            html+="<td>"+res[1]+"</td>";
                                            html+="<td>"+res[0]+"</td>";
                                            html+="<td>"+res[2]+"</td>";
                                            html+="</tr>";
                                        }

                                    }


                                }
                                html+="</table>";

                                $('.thisjob').html(html);
                                // Display Modal
                                $('#myModal').modal('show'); 
                            })
                            .fail(function() {
                                alert("error while fetching stats");
                            });
     }
     </script>
    <!-- ============ CONTACT END ============ -->
</html>
