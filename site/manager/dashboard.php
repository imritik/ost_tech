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
    <title> Job Board- </title>
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
        .selected {
            color: red;
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
            <!-- <div id="menu-open" class="pull-right">
                <a href="../View/view.php">Monitor</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="../add_admin.php">Add manager</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
               <a href="../../logout/logout.php" class="pull-right">Logout</a>
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
 $key='';
 // ------collect all jobs of company here
                    $sqljob="SELECT * FROM Job_Posting where email='$hrcompany' and manager LIKE '%$hremail%'";
                    // var_dump($sqljob);
                    $resultjob = $db->query($sqljob);
                    // var_dump($resultjob);
                    if ($resultjob ->num_rows > 0) {
                        while($rowjob = $resultjob->fetch_assoc()) {
                            $postid=$rowjob['posting_id'];
                            $jobtitle=$rowjob['job_title'];
                            $cname=$rowjob['company_name'];
                            // var_dump(json_decode($rowjob['manager']));
                            $key = array_search($hremail, json_decode($rowjob['manager']));
                            // var_dump($key+1);
                    echo '<li id="'.$postid.'" onclick="showpage(\''.$postid.'\')"><a href="#tab_b" data-toggle="pill">'.$jobtitle.'&nbsp;&nbsp;(L'.($key+1).')</a></li>';
                            
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
        
                      <?php include '../table2.php'; ?>

</body>
 <!-- ============ JOBS END ============ -->

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

                                location.replace(window.location.href.split('#')[0]+'?jid='+x+'&status=shortlist');
                            }
                                
                            // });
    

    function clearuri(){
        var uri = window.location.toString();
                                if (uri.indexOf("?") > 0) {
                                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                                    window.history.replaceState({}, document.title, clean_uri);
                                }

    }
    // function setstatus(status){
    //     var uri = window.location.toString();
    //                             if (uri.indexOf("&") > 0) {
    //                                 var clean_uri = uri.substring(0, uri.indexOf("&"));
    //                                 window.history.replaceState({}, document.title, clean_uri);
    //                             }
    //         location.replace(window.location.href+'&status='+status);

    // }
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
    

//  var frm = ['cv'];
//  var hrf=[];
//  function setSource() {
//      console.log("in set source");
//             for(i=0, l=frm.length; i<l; i++) {
//                 document.querySelector('iframe[name="'+frm[i]+'"]').src = hrf[i];
//             }
//         }
//      function showform(){
//         $('.tobehidden').removeClass('blur');
//         $('.tobe-reused').removeClass('df3');
//         $('.tobe-reused').toggle();
//          $('.df2').toggle();
//          $('.df3').toggle();
//          $('.df4').toggle();


//      }

//      function showcvform(x,y){
//          $('.tobe-reused').hide();
//          $('.tobe-reused').addClass('df3');
//          console.log(x);
//          var hrf1 = [x];
//          hrf=hrf1;
//         var favorite=[];
//         var jobref=['<?php echo $jidd;?>'];
//         favorite.push(y);
//         favorites=favorite;
//         jobrefs=jobref;
//         var newArray = favorites.map((e, i) => e +','+ jobrefs[i]);
//         newArray1=newArray;
//         console.log(newArray1);
//          setSource();
//          $('.tobehidden').addClass('blur');
//          $('.df2').toggle();
//          $('.df3').toggle();
//          $('.df4').toggle();
//      }

    
//      function showlastjob(id){
//         //  alert(id);
//           $.ajax({
//                                 url: '../thiscompanystats.php',
//                                 type: 'POST',
                            
//                                 data: {param1: id,param2:'<?php echo $currentCompEmail;?>'},
//                             })
//                             .done(function(response) {
//                                 // console.log(response);
//                                 data=JSON.parse(response)
                             
//                                 // data=response;
//                                 console.log(data);
//                                 // console.log(data.length);

//                                 var html = "<table border='1|1'class='table table-striped'>";
//                                 for (var i = 0; i < data.length; i++) {
//                                     // console.log(data[i]);
//                                      var cname=data[i][0];
//                         // console.log(cname);
//                                         for(var j=0;j<data[i].length;j++){
//                                                 if(data[i][j]){
//                                                     // console.log(data[i][j].length);
                       
//                                                              var res = data[i][j];
//                                                              console.log(res);
//                                                             for(k=0;k<res.length;k++){
//                                                                 if(res[k]){
//                                                                 console.log(res[k]);

//                                                                 }
//                                                                 var line = res[k].split("$");
//                                                                 // console.log(line);
//                                                                 if(line[1] && line[0] && line[2]){
//                                                                           html+="<tr>";
//                                                                         html+="<td>"+cname+"</td>";

//                                                                         html+="<td>"+line[1]+"</td>";
//                                                                         html+="<td>"+line[0]+"</td>";
//                                                                         html+="<td>"+line[2]+"</td>";
//                                                                         html+="</tr>";
//                                                                 }
                                                              

//                                                             }
                                                           
//                                                  }

//                                         }
//                                 }
//                                 html+="</table>";

//                                 $('.modal-title').html("This company feedback");
//                                 $('.thisjob').html(html);
//                                 // Display Modal
//                                 $('#myModal').modal('show'); 
//                             })
//                             .fail(function() {
//                                 alert("error while fetching stats");
//                             });
//      }

//      function showthisjob(id){
//         //  ajax request to fetch job stats
//                             $.ajax({
//                                 url: '../thisjobstats.php',
//                                 type: 'POST',
                            
//                                 data: {param1: id,param2:<?php echo $_GET['jid'];?>},
//                             })
//                             .done(function(response) {
//                                 data=JSON.parse(response)
//                                 console.log(data);

//                                 var html = "<table border='1|1'class='table table-striped'>";
//                                 for (var i = 0; i < data.length; i++) {
//                                     if(data[i]){
//                                         for(var j=0;j<data[i].length;j++){
//                                             var res = data[i][j].split("$");
//                                            if(res[0]&&res[1]&&res[2]){
//                                                 html+="<tr>";
//                                                 html+="<td>"+res[1]+"</td>";
//                                                 html+="<td>"+res[0]+"</td>";
//                                                 html+="<td>"+res[2]+"</td>";
//                                                 html+="</tr>";
//                                             }
//                                         }

//                                     }


//                                 }
//                                 html+="</table>";
//                                 $('.modal-title').html("This job feedback");

//                                 $('.thisjob').html(html);
//                                 // Display Modal
//                                 $('#myModal').modal('show'); 
//                             })
//                             .fail(function() {
//                                 alert("error while fetching stats");
//                             });
//      }
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
                                    var statusvalue="manager";
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
     </script>
  

    <!-- ============ CONTACT END ============ -->
</html>
