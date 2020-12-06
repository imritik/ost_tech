<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailemp'])||isset($_SESSION['emailhr'])||isset($_SESSION['coordinatoremp'])){
  }
  else{
    header("location: ../../admin_jobs/admin_home.php");
  }
include '../../dbConfig.php';
// $coordinator_email=$_SESSION['coordinatoremp'];
$coordinator_email='';
$company='';
// if(isset($_SESSION['emailmanager'])){
//     $coordinator_email=$_SESSION['emailmanager'];
// }
// else if(isset($_SESSION['coordinatoremp'])){
//     $coordinator_email=$_SESSION['coordinatoremp'];
// }
// else
 if(isset($_SESSION['emailhr'])){
    $coordinator_email=$_SESSION['emailhr'];
    $company=$_SESSION['companyhr'];
}
else if($_SESSION['emailemp']){
    $coordinator_email=$_SESSION['emailemp'];
}
else if($_SESSION['coordinatoremp']){
    $coordinator_email=$_SESSION['coordinatoremp'];
}
// var_dump($company,"emil");

$page="view_mode";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
 .fill{
            width:-webkit-fill-available;
        }
        .width-auto{
            width:auto;
        }

        .panel-title{
            font-size: smaller;
    padding: 0;
        }
</style>

</head>

<body style='padding:0'>

 <!-- ============ HEADER START ============ -->
 <header>
        <div id="header-background"></div>
        <div class="container">
            <div class="pull-left">
             <b>Monitoring Dashboard<b> (<?php echo $coordinator_email; ?>)
            </div>
            <div id="menu-open" class="pull-right">
            <a onclick="redirect();">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             <select class="label label-info" style="font-size: small;background: cadetblue;" onchange="location = this.value;">
   <option value="#">
               <a href="#">My Profile</a>
   
   </option>
   <?php
 if(isset($_SESSION['emailhr'])){
?>   
    <option value="../../ChangePassword/setPassword.php">
               <a href="../../ChangePassword/setPassword.php">Change password</a>
   
   </option>
   <?php
   }
   ?>
   <option value="../../logout/logout.php">
               <a href="../../logout/logout.php">Logout</a>
   
   </option>
   
   </select>
            </div>

        </div>
    </header>
    <br>
    <br>
    <br>
<div class="container">

<div class="row" style="display: flex;justify-content: center;">
<!-- <?php include 'radio.php';?> -->
</div>
   <br>
    <div class="row">
    <div class="col-md-10 fixed-top">
<h3>Jobs</h3>

 <table id="example" class="table table-striped table-condensed"> 

            <thead class="header">
            <tr class="filters" style="background: white">

            <th style="color:black;">Sr.No </th>
            <?php
            if($_SESSION['emailemp']){
                ?>
            <th style="color:black;">Company </th>

               <?php 
            }
            ?>
            <th style="color:black;">Position </th>
            <th style="color:black;">HR Manager </th>
            <th style="color:black;">Recruiter </th>
            <th style="color:black;">Vendor </th>
            <th style="color:black;">Profile Received </th>
            <th style="color:black;">To Process </th>
            <th style="color:black;">UnderDiscussion </th>
           
            <th style="color:black;">Offered </th>
            </tr>
            </thead>
            <tbody>
<!-- ----jobs using php -->
 <?php
//  $getJobsQuery="SELECT * FROM Job_Posting where hr='$coordinator_email'";
//  $resultGetQuery=$db->query($getJobsQuery);
// $uniqueJobs=array();
// if ($resultGetQuery ->num_rows>0) {
//     while($rowgetjobs = $resultGetQuery->fetch_assoc()) {
//         array_push($uniqueJobs,$rowgetjobs['posting_id']);
//     }
// }
$sql='';
 if($_SESSION['emailemp']||$_SESSION['coordinatoremp']){
 $sql="SELECT Job_Posting.*, applied_table.*,count(Job_Posting.posting_id) as numRows FROM Job_Posting INNER JOIN applied_table ON Job_Posting.posting_id = applied_table.posting_id group by Job_Posting.company_name";

 }
 else if($_SESSION['emailhr']){
 $sql="SELECT Job_Posting.*, applied_table.*,count(Job_Posting.posting_id) as numRows FROM Job_Posting INNER JOIN applied_table ON Job_Posting.posting_id = applied_table.posting_id AND Job_Posting.email='$company' group by Job_Posting.posting_id";

 }
$result = $db->query($sql);
// var_dump($sql);
// var_dump($sql);
// $companies=array();
// $jobs=array();
// $jobs_details=array();
// $to_admin_data=array();
// $company_names=array();
// $currentCompEmail='';
// $uniqueJobs=array();


 $i=0;
if ($result ->num_rows>0) {
    while($row1 = $result->fetch_assoc()) {
        $postingID=$row1['posting_id'];
//query to get offered candidates count
$offeredQuery="SELECT * FROM applied_table where posting_id='$postingID' and Status='Offered'";
$offeredQueryResult=$db->query($offeredQuery);
$offeredQueryCount=$offeredQueryResult->num_rows;    
      
//query to get shared candidates count
$sharedQuery="SELECT * FROM applied_table where posting_id='$postingID' and Status='Shared'";
$sharedQueryResult=$db->query($sharedQuery);
$sharedQueryCount=$sharedQueryResult->num_rows;

//query to get under discussion candidates count
$shortlistQuery="SELECT * FROM applied_table where posting_id='$postingID' and Status='shortlist'";
$shortlistQueryResult=$db->query($shortlistQuery);
$shortlistQueryCount=$shortlistQueryResult->num_rows;

$i=$i+1;?>

<tr>
<td><?php echo $i;?></td>
  <?php
            if($_SESSION['emailemp']){
                ?>
            <td><?php echo $row1['company_name'];?> </td>

               <?php 
            }
            ?>
<td><?php echo $row1['job_title'];?></td>

<td><?php echo $row1['hr'];?></td>

<td><?php echo $row1['recruiter'];?></td>
<td><?php echo $row1['vendor'];?></td>

<td><?php echo $row1['numRows'];?></td>
<td>
<?php echo $sharedQueryCount; ?>
</td>
<td>
<?php echo $shortlistQueryCount;?>
</td>
<td>
<?php echo $offeredQueryCount; ?>
</td>


</tr>

<?php
        // ----------------------------------
    }
}
    else{
        echo "Nothing to see";
        }
               ?>
               </tbody>
               </table>

</div>
<div class="tab-content col-md-2">
<div style="display:none"  class="text-center tobe-reused">
<div style="display:flex;justify-content: center;">

  </div>
 
            
</div> 
        <div class="tab-pane active" id="tab_a">
        

</body>
 <!-- ============ JOBS END ============ -->


<script>
// $(document).on('click',function(){
// $('.collapse').collapse('hide');
// })
</script>
<script>


 function setPage() {
        var uri = window.location.toString();
                    console.log(uri.indexOf("?"));
                                if (uri.indexOf("?") > 0) {
                                   
                                    window.stop();
                                }
                                else{
                                    $('ul li:first').click();

                                }
   
    }

    $( document ).ready(function() {
        console.log( "ready!" );
        // setPage();
                    setTimeout(setPage(), 1000);

    });
  

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


 function setPage() {
        var uri = window.location.toString();
                    console.log(uri.indexOf("?"));
                                if (uri.indexOf("?") > 0) {
                                   
                                    window.stop();
                                }
                                else{
                                    $('ul li:first').click();

                                }
   
    }

    $( document ).ready(function() {
        console.log( "ready!" );
        // setPage();
                    setTimeout(setPage(), 1000);

    });
  
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
                            
  function deletejobpart(x){
                            $.ajax({
                                url: '../deletejob.php',
                                type: 'POST',
                            
                                data: {param1: x},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("error while deleting!");
                            });
    }

    function holdjob(x){
        console.log(x);
                             $.ajax({
                                url: '../holdjob.php',
                                type: 'POST',
                            
                                data: {param1: x},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("Try again later!");
                            });
    }

     function closejob(x){
        console.log(x);
                             $.ajax({
                                url: '../closejob.php',
                                type: 'POST',
                            
                                data: {param1: x},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("Try again later!");
                            });
    }


    function repostpart(x){
        console.log(x);
                             $.ajax({
                                url: '../repost.php',
                                type: 'POST',
                            
                                data: {param1: x},
                            })
                            .done(function(response) {
                                alert(response);
                               
                            })
                            .fail(function() {
                                alert("error in reposting");
                            });
    }

function showpage(postid){
    document.cookie = "vendorduplicate=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    console.log(postid);
    getjobids(postid);
}
  function getjobids(x){

                               clearuri();

                                location.replace(window.location.href.split('#')[0]+'?jid='+x+'&status=Shared');
                            }
                                
                            // });
    

    function clearuri(){
        var uri = window.location.toString();
                                if (uri.indexOf("?") > 0) {
                                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                                    window.history.replaceState({}, document.title, clean_uri);
                                }

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

    // for selecting comp names



    $(".studentcheckbox1comp").click(function(){
        //  $('.tobe-reused').show();
        var favorite=[];
        var jobref=[];
            $.each($("input[name='chkcomp']:checked"), function(){  
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
         $('#combine').show();
         }
         else{
         $('#combine').hide();

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


function combine(){
    console.log(jobrefs);

                            $.ajax({
                                url: 'combine.php',
                                type: 'POST',
                            
                                data: {param1: jobrefs},
                            })
                            .done(function(response) {
                                alert(response);
                                // location.reload();
                               
                            })
                            .fail(function() {
                                alert("error in combining");
                            });
}


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
                    console.log("filtered rows here");
                    $rows=$visible_rows;
                    console.log($rows);
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
                    console.log($filteredRows);
                    console.log($filteredRows.hide());


                    $tobeshown=$table.find('tbody tr:visible');
                            $visible_rows=$tobeshown;
                            console.log($visible_rows,"visible");

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

        var statusvalue="hr";
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

     function updatestatusofeach(x,y,z,q,a,b,c){

                console.log(x,y,z,q,a,b,c);
                $.ajax({
                                url: '../updatestudentstatus.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y,param3:z,param4:q,param5:a,param6:b,param7:c},
                            })
                            .done(function(response) {
                                // alert(response);
                                // location.reload();
                               
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
    


     function setclick(){
         $(".nav-pills li:first").trigger('click');
     }

       function saveStatus(){
             var sidc=[];
            var jobid=[];
                is_checked=!is_checked;
            var i=0;
            var commentcheck=false;

        $('tr').each(function(i, obj) {
            // console.log($('tr').length);
            // console.log(i);
                if($('tr').not(':first').is(":visible")) {

                    if(is_checked){
   // alert('hi');
                            $(this).find('.studentcheckbox1').prop('checked',true)
                            if($(this).find('.studentcheckbox1').prop('checked') == true){
                                console.log($(this).find('.studentcheckbox1').val());
                                var selectedID=$(this).find('.studentcheckbox1').val();
                                console.log($('#hr_comment'+selectedID).val());
                                console.log($('#updatenotebtn'+selectedID).val());
                                    var statusvalue="am";
                                    var notevalue=$('#updatenotebtn'+selectedID).val();
                                    var hrfeedback=$('#hr_comment'+selectedID).val();
                                    var levelbtn=$('#levelbtn'+selectedID).val();

                                    var ps2='';
                                    // if(hrfeedback!=''){
                                    //     commentcheck=true;
                                        updatestatusofeach(selectedID,'<?php echo $_GET['jid'];?>',statusvalue,notevalue,hrfeedback,ps2,levelbtn);
                                    // }
                                    // else{

                                    // }
                            }
                            i=i+1;
                     }
                    else{
                        console.log("here");
                       
                    }
                }
                if(i==$('tr').length-1){

                        // if(!commentcheck){
                        // alert("Add a comment to save status");
                        // }
                    // console.log(i,$('tr').length-1,"reload");
                    // else{
                    // location.reload();
                    setTimeout(function(){  location.reload(); }, 1000);

                    // }

                }
        });
        }


// function downloadCSV(csv, filename) {
//     var csvFile;
//     var downloadLink;

//     // CSV file
//     csvFile = new Blob([csv], {type: "text/csv"});

//     // Download link
//     downloadLink = document.createElement("a");

//     // File name
//     downloadLink.download = filename;

//     // Create a link to the file
//     downloadLink.href = window.URL.createObjectURL(csvFile);

//     // Hide download link
//     downloadLink.style.display = "none";

//     // Add the link to DOM
//     document.body.appendChild(downloadLink);

//     // Click download link
//     downloadLink.click();
// }

//         function exportTableToCSV(filename) {
//             var csv = [];
//             var rows = document.querySelectorAll("table tr");
            
//             for (var i = 1; i < rows.length; i++) {

//                 var row = [], cols = rows[i].querySelectorAll("td, th");
                
//                 // for (var j = 0; j < cols.length; j++) 
//                     // row.push(cols[j].innerText);
//                 console.log(cols[2].innerText);
                
//                 csv.push(cols[2].innerText);  
//                 console.log(csv);      
//             }

//               $.ajax({
//                     url: "../setstudbyemail.php",
//                     type:'post',
//                     data: { role: csv }
//                 }).done(function(response) {
//                                 // alert(response);
//                                 //do something with the response
//                                 // $('#'+studid).html('<p style="color:white;background:forestgreen">Shorlisted</p>');
//         window.location.href = "http://<?php  echo $_SERVER['SERVER_NAME']; ?>/jobs/site/exportstudbyemail.php";
                               
//                             })
//                             .fail(function() {
//                                 alert("error in exporting");
//                             });


//             // Download CSV file
//             // downloadCSV(csv.join("\n"), filename);
//         }

     </script>


    
    <!-- Modernizr Plugin -->
    <script src="../js/modernizr.custom.79639.js"></script>
    <!-- jQuery (../necessary for Bootstrap's JavaScript plugins) -->
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
</html>
