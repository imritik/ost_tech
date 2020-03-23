<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
$cname=$_SESSION['company'];
include '../dbConfig.php';
$a=0;
$b=50;
$c=0;
$d=50;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title>Job Board </title>
    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


         <style>
        .filterable {
            margin-top: 15px;
        }
        
        .filterable .panel-heading .pull-right {
            margin-top: -20px;
        }
        
        .filterable .filters table tr:not([style*="display:none"]):not([style*="display: none"])disabled] {
            background-color:table tr:not([style*="display:none"]):not([style*="display: none"])parent;
            border: none;
            cursor: auto;
            box-shadow: none;table tr:not([style*="display:none"]):not([style*="display: none"])
            padding: 0;
            height: auto;
        }
        
        .filterable .filters input[disabled]::-webkit-input-placeholder {
            color: #333;
        }
        
        .filterable .filters input[disabled]::-moz-placeholder {
            color: #333;
        }
        
        .filterable .filters input[disabled]:-ms-input-placeholder {
            color: #333;
        }

        #posted_jobs{
            color: black;
            font-size: 16px;
            background: transparent;
            box-shadow: 2px 2px lightgrey;
            border: 2px solid lightgray;
        }
        #checkspan{
            float: right;
    margin-right: 80px;
    font-size: 17px;
        }
        #btnshortlistall:hover{
            color:black;
        }
        .rangefilterbox{
            width:40px;
        }
        .focus {
            background-color: #ff00ff;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        .fill{
            width:-webkit-fill-available;
        }
    </style>


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
                <!-- <li><a href="#home">Home</a></li> -->
                <li class="active"><a href="post-a-job.php">Post a job</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="candidates.php">Push Jobs</a></li>
                <li><a href="linkedinCandidates.php">Push Jobs(Linkedin)</a></li>

                <!-- <li><a href="csv_v2/index.php" target="blank">Add Candidates</a></li> -->
                <!-- <li><a href="import-csv/index.php" target="blank">Add Company</a></li> -->
                <li><a href="sendmails.php">Send Mails</a></li>
                
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="showadmins.php">Admin details</a></li>
                <!-- <li><a class="link-register">Register</a></li> -->
                <li><a class="link-login" href="../logout.php">Logout</a></li>
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
                    <a href="#"><img src="images/logo.png" alt="Jobseek - Job Board Responsive HTML Template" /></a>
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
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Candidates</h1>
                </div>
                <div>
                <!-- ===========import code======= -->


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
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Add candidates</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="csv_v2/importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
        <br>
    </div>
    <div class="col-md-12 head">
        <!-- <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm2');"><i class="plus"></i> Add cv</a>
        </div> -->

                <!-- -----import csv automated--- -->
                <div class="col-md-4" id="importFrm2" style="display: none;">
            <br>
                <form action="csvimportbydl.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" />
                    <br>
                    <input type="submit" class="btn btn-primary" name="importSubmitbydl2" value="IMPORT" id="cv_auto">
                </form>
                <br>
            </div>
    </div>



    <!-- ----------------------------------------- -->
   

    <button onclick="exportTableToCSV('candidates.csv')" style="float:right" id="exportbtn" class="btn btn-primary">Save shortlisted</button>
    <button onclick="downloadcsv();" style="float:right" class="btn btn-sm"><i class="fa fa-download" aria-hidden="true"></i>
</button>


   

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
                <!-- ========== -->
                
                </div>
            </div>
        </div>
    </section>

    <!-- ============ TITLE END ============ -->

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- <h2>Candidates</h2> -->

                    <!-- <iframe id="myIframe" src="../table.html" frameborder="0" style="height:100%;border: none;position: absolute" height="100%" width="100%"></iframe> -->

                    <div class="jobs">


                        <!-- ---------------candidate's list----------------- -->

                        <div id="wrap">
                            <div class="container" style="height: auto">
                            <div class="row" style="display:flex;justify-content: center;">
                            <div>
                                <h3>Select Job to shortlist</h3>
</div>
<div style='margin: 20px 40px;'>
                                <select id="posted_jobs" name="posted_jobs" style="color:black;height:40px">

                                                <option value="" >Select Job</option>

                                        <!-- -------php code to gather posted jobs---- -->
                                        <?php

                                        $query = $db->query("SELECT * FROM Job_Posting");
                                                    
                                        if($query ->num_rows >0){
                                            while($row = $query->fetch_assoc()){

                                                echo '<option value="' . $row['posting_id'] . '">' . $row['job_title'] .' ('.$row['Job_type'].')' . '</option>';
                                        ?>
                                            <?php }} ?>

                                </select>
                                </div>
                                </div>
                                
                                <?php
                                if(isset($_SESSION['emailemp'])){
                                    // echo "set";
                                    if(isset($_POST['exp1'])){
                                        $_SESSION['a']=$_POST['exp1'];
                                        $_SESSION['b']=$_POST['exp2'];
                 
                                        $_SESSION['c']=$_POST['ctc1'];
                                        $_SESSION['d']=$_POST['ctc2'];
                                        $a=$_SESSION['a'];
                                        $b=$_SESSION['b'];
                                        $c=$_SESSION['c'];
                                        $d=$_SESSION['d'];


                                       
                                        // echo $a;
                                        // echo $a;
                                        // echo $_SERVER['SERVER_NAME'];
                                    }

                                    else{
                                        // echo "unset";
                                        $a=0;
                                        $b=0;
                                        $c=0;
                                        $d=0;
                                    }
                                    if(isset($_POST['booleanskills'])){
                                        $_SESSION['bs']=$_POST['booleanskills'];
                                     
                                        $bs=$_SESSION['bs'];
                                    }
                                    else{
                                        $bs='';
                                    }
                                   
                                   
                                }
                                else{
                                    // echo "unset";
                                    $a=0;
                                    $b=50;
                                    $c=0;
                                    $d=50;
                                    $bs='nodejs,php';
                                }
                                
                                ?>
                                <div style='display: flex;
    justify-content: center;'>
                                <form action='' method='POST'>

                    <input type='date' name="daterange1" id="dr1">-<input type='date' name='daterange2' id="dr2">
                   
                                <span>Experience</span>
                                <input type="number" class="rangefilterbox" name="exp1" value="<?php echo $a;?>">-<input type="number" class="rangefilterbox" name="exp2" value="<?php echo $b;?>">
                                &nbsp;&nbsp;
                            
                                <span>CTC</span>
                                <input type="number" class="rangefilterbox" name="ctc1"value="<?php echo $c;?>">-<input type="number" class="rangefilterbox" name="ctc2" value="<?php echo $d;?>">
                                <!-- <input type="text" name="skills" placeholder="enter technologies"> -->
                                <input type='text' name='booleanskills' placeholder='Enter skills comma(,) separated' value='<?php echo $bs; ?>'>
                                <button class="btn btn-sm" name="filtersearch">Search</button>
                               
                               </form>
                              
                               <button id="btnshortlistall" class="btn btn-sm" style="background:aliceblue;display:none">Shortlist All</button>

                        
 </div>
<span id="checkspan">
                               
                    
                                </span>
              

</div>

                            <!-- ======== -->

<div class="row">

<!-- -----------send students to loaders section----------- -->
<br>

            <div style="display:block" class="text-center">
                <!-- --------------- -->

            <select id="admins_email" style="color:black;height:40px;display:none">

            <option value="" >Select DL</option>

            <!-- -------php code to gather posted jobs---- -->
            <?php

            $query = $db->query("SELECT * FROM admins where role='DL'");
                
            if($query ->num_rows >0){
            while($row = $query->fetch_assoc()){

            echo '<option value="' . $row['email'] . '">' . $row['email'] .' ('.$row['Full_name'].')' . '</option>';
            ?>
            <?php }} ?>

            </select>

            <button id="send_ids" class="btn btn-primary" style="display:none" onclick="sendids();">Send</button>
            </div>





<!-- ------------------------- -->
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Candidates</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <div style="transform: rotateX(180deg);overflow-x:auto">
            <table class="table" id="tobesorted" style="transform: rotateX(180deg);">
                <thead>
                    <tr class="filters">
                    <th style="color:black;display:flex;"> <input type="checkbox" id="selectall">&nbsp;Select</th>
                        <!-- <th><input type="text" class="form-control" placeholder="Profile Score#" disabled></th> -->
                        <th><input type="text" class="form-control" placeholder="College Name" disabled></th>
                        <!-- <th><input type="text" class="form-control" placeholder="Student ID#" disabled></th> -->
                        <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Email"  disabled></th>
                        <th><input type="text" class="form-control" placeholder="Company"  disabled></th>
                        <!-- <th><input type="text" class="form-control" placeholder="Preferred_loc" disabled></th>-->
                        <th><input type="text" class="form-control fill" placeholder="CTC" disabled></th>
                        <th><input type="text" class="form-control fill" placeholder="FileName" disabled></th> 
                        <th style="color:black">Resume</th>
                        <th style="color:black">Action</th>
                    </tr>
                </thead>
                <tbody>
                   


                    <!-- -------php code to fetch data from two tables---- -->

                         
<?php
if(isset($_POST['filtersearch'])){

$sql="";
// echo $ctc1;
// echo $a;

// echo $skills;

    // $sql="SELECT * FROM Student";
    if($bs=='' && !($a==0 &&$b==0 &&$c==0 &&$d==0)){
    
        $sql = "SELECT * FROM Student WHERE (curr_ctc BETWEEN $c and $d) and (experience BETWEEN $a and $b);";

    }
    else if($bs=='' && ($a==0 &&$b==0) &&!($c==0 &&$d==0)){
        $sql = "SELECT * FROM Student WHERE curr_ctc BETWEEN $c and $d";

    }
    else if($bs!='' && ($a==0 &&$b==0) &&!($c==0 &&$d==0)){
        $sql = "SELECT *, MATCH (tech,cv_parsed) AGAINST ('$bs' IN NATURAL LANGUAGE MODE) AS score FROM Student WHERE MATCH (tech,cv_parsed) AGAINST ('$bs' IN NATURAL LANGUAGE MODE) and (curr_ctc BETWEEN $c and $d)";

    }
    else if($a==0 &&$b==0 &&$c==0 &&$d==0&& $bs!=''){
        $sql = "SELECT *, MATCH (tech,cv_parsed) AGAINST ('$bs' IN NATURAL LANGUAGE MODE) AS score FROM Student WHERE MATCH (tech,cv_parsed) AGAINST ('$bs' IN NATURAL LANGUAGE MODE);";
    }
    else if($a==0 &&$b==0 &&$c==0 &&$d==0 &&$bs==''){
        $sql = "SELECT * FROM Student";
    }
    else
    {
        $sql = "SELECT *, MATCH (tech,cv_parsed) AGAINST ('$bs' IN NATURAL LANGUAGE MODE) AS score FROM Student WHERE MATCH (tech,cv_parsed) AGAINST ('$bs' IN NATURAL LANGUAGE MODE) and (curr_ctc BETWEEN $c and $d) and (experience BETWEEN $a and $b);";

    }
$result = $db->query($sql);

if ($result ->num_rows >0) {
   
    while($row1 = $result->fetch_assoc()) {
        // var_dump($row1);
        $res = bcmul($row1['score'], 100000000); 
        ?>
        <tr style='display:none' >
        <td><input type="checkbox" class="studentcheckbox" value="<?php echo $row1['student_id']; ?>" name="id[]"></td>
        <!-- <td> <?php echo $row1['score'];?></td> -->
        <!-- <td > <?php echo $row1["college_id"];?> </td> -->
        <td  > <?php echo $row1["ug_college"];?></td>
        <!-- <td ><?php echo $row1["college_location"];?></td> -->
        <!-- <td ><?php echo $row1["student_id"];?></td> -->
        <td  ><?php echo $row1["stud_name"];?></td>
        <td  ><?php echo $row1["contact"];?></td>
        <td  ><a href="mailto:<?php echo $row1["email"];?>"><?php echo $row1["email"];?></a></td>
        <td  ><?php echo $row1["curr_comp"];?></td>
        <!-- <td  ><?php echo $row1["preferred_loc"];?></td>
        <td  ><?php echo $row1["industry"];?></td>
        <td  ><?php echo $row1["work_segment"];?></td> -->
        <td  ><?php echo $row1["curr_ctc"];?></td>
       <td> <?php echo $row1["resume"];?></td>

        <td  ><a href="../specialty/uploads/<?php echo $row1['student_id']; ?>/<?php echo $row1["resume"];?>" target="blank">View</a></td>
        <td  ><button id="<?php echo $row1['student_id'];?>" onclick="shortlist(this.id);" style="background:transparent;color:black">Shortlist</button></td>



        </tr>

     <?php   
    }
} else {
    echo "0 results";
}
}


?>



                    <!-- ----------------- -->
                   
                </tbody>
            </table>
</div>
        </div>
    </div>
    <script>
    /*
                                            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
                                            */
    $(document).ready(function() {

  
              function PageWiseFilter(second){
  var totalRows = $('.table').find('tbody tr:has(td)').length;
                                var recordPerPage = 100;
                                var totalPages = Math.ceil(totalRows / recordPerPage);
                                var $pages = $('<div id="pages" style="display:inline;font-size:18px"></div>');
                                for (i = 0; i < totalPages; i++) {
                                    $('<span class="pageNumber" style="cursor:pointer">&nbsp;<b>' + (i + 1) + '</b></span>').appendTo($pages);
                                }
                                $pages.prependTo('.table');

                                // $('.pageNumber').hover(
                                //     function() {
                                //     $(this).addClass('focus');
                                //     },
                                //     function() {
                                //     $(this).removeClass('focus');
                                //     }
                                // );

                                $('.table').find('tbody tr:has(td)').hide();
                                if(second=="true"){
                                var tr = $('.table tbody tr:has(td):visible');

                                }
                                else{
                                var tr = $('.table tbody tr:has(td)');

                                }
                                for (var i = 0; i <= recordPerPage - 1; i++) {
                                    $(tr[i]).show();
                                    console.log(tr[i]);
                                }
                                $('span').click(function(event) {
                                    $('span').removeClass('focus');
                                    $(this).toggleClass('focus');

                                    $('.table').find('tbody tr:has(td)').hide();
                                    var nBegin = ($(this).text() - 1) * recordPerPage;
                                    var nEnd = $(this).text() * recordPerPage - 1;
                                    for (var i = nBegin; i <= nEnd; i++) {
                                    $(tr[i]).show();
                                    // $(this).addClass('focus');
                                    }
                                });
              }
               PageWiseFilter("false");  

               $('#dr1').change(function(){
                   console.log(this.value);
               })   
//                 $("#dr1").datepicker({
//     onSelect: function(dateText) {
//       display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
//       $(this).change();
//     }
//   }).on("change", function() {
//     display("Change event");
//   });    

            });
       function FilterRow($input){
                       inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
                // $rows=new Array();
                // console.log(getVisibleRows());
                // $rows.push(getVisibleRows());
            //   $rows=getVisibleRows();
                // console.log($rows);

             
                console.log(inputContent);
                if(inputContent=='#'){
                    console.log("blank search will be there");
                    var $filteredRows = $rows.filter(function() {
                            var value = $(this).find('td').eq(column).text().trim()!='';
                            return value === true;
                            console.log(value);
                    });
                            // console.log($filteredRows);

                }
                else{
                            /* Dirtiest filter function ever ;) */
                            var $filteredRows = $rows.filter(function() {
                                            var value = $(this).find('td').eq(column).text().toLowerCase();
                                            return value.indexOf(inputContent) === -1;
                            });
                            // console.log($filteredRows);

                }
            
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
            }
            // console.log(getVisibleRows());
            }
        // -----------------------
        $('.filterable .btn-filter').click(function() {
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e) {
            // console.log(getVisibleRows());
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this);
     FilterRow($input);
    //  $("#tobesorted tr:has(td)").remove();
     $('#pages').html('');
    //  PageWiseFilter("true");
    getVisibleRows()
    //  setTimeout(PageWiseFilter("true"), 3000);
         
        });
    // });


  
// ----checkbox select--

 var favorites = [];

   
$(".studentcheckbox").click(function(){
    $('#admins_email').show()
        $('#send_ids').show();
    $('#btnshortlistall').show();

    var favorite=[];
        $.each($("input[name='id[]']:checked"), function(){            
            favorite.push($(this).val());
        });
        favorites=favorite;
     console.log(favorites);
 

});

    // -----for selecting all student at once---
    $("#selectall").click(function () {
        $('#admins_email').show()
        $('#send_ids').show();
        $('#btnshortlistall').toggle();
        var jobarr=[]
        $('tr').each(function(i, obj) {
            //test
            // console.log(obj);
            if($(this).is(":visible")) {
            
            console.log(obj);
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

    });


$('#btnshortlistall').click(function(){
   
favorites.forEach(function(stid){
    shortlist(stid);
})

    });
</script>
<script>

function getVisibleRows(){

$rowtest=[]
         $('tr').each(function(i, obj) {
            //test
            // console.log(obj);
            if($(this).is(":visible")) {
            // console.log($(this).is(":visible"));
            // console.log(obj);
            $rowtest.push(obj);
            // console.log("visible");
            // console.log($rowtest.length);

            }
        });
        // console.log($rowtest[1]);
        // return $rowtest;
        // ----------pagination work---------
         var totalRows = $rowtest.length;
        //  console.log(totalRows);
                                var recordPerPage = 100;
                                var totalPages = Math.ceil(totalRows / recordPerPage);
                                var $pages = $('<div id="pages" style="display:inline;font-size:18px"></div>');
                                for (i = 0; i < totalPages; i++) {
                                    $('<span class="pageNumber" style="cursor:pointer">&nbsp;<b>' + (i + 1) + '</b></span>').appendTo($pages);
                                }
                                $pages.prependTo('.table');

                                // $('.pageNumber').hover(
                                //     function() {
                                //     $(this).addClass('focus');
                                //     },
                                //     function() {
                                //     $(this).removeClass('focus');
                                //     }
                                // );

                                $('.table').find('tbody tr:has(td)').hide();
                                                             var tr = $rowtest;

                                for (var i = 0; i <= recordPerPage - 1; i++) {
                                    $(tr[i]).show();
                                    // console.log(tr[i]);
                                }
                                $('span').click(function(event) {
                                    $('span').removeClass('focus');
                                    $(this).toggleClass('focus');

                                    $('.table').find('tbody tr:has(td)').hide();
                                    var nBegin = ($(this).text() - 1) * recordPerPage;
                                    var nEnd = $(this).text() * recordPerPage - 1;
                                    for (var i = nBegin; i <= nEnd; i++) {
                                    $(tr[i]).show();
                                    // $(this).addClass('focus');
                                    }
                                });




        // ------------------------------------
}

    function shortlist(studid){
        // alert(studid);
        // alert($('#posted_jobs').val());
        if($('#posted_jobs').val()==""){
            alert("Please select job to continue");
        }

            else{

                $.ajax({
                                url: 'shortlist.php',
                                type: 'POST',
                            
                                data: {param1: $("#posted_jobs").val(),param2:studid},
                            })
                            .done(function(response) {
                                // alert(response);
                                //do something with the response
                                $('#'+studid).html('<p style="color:white;background:forestgreen">Shorlisted</p>');
                               
                            })
                            .fail(function() {
                                alert("error in shortlisting");
                            });

            }
                
            }

</script>

 </div>

                        </div>
                      




                    </div>


                </div>
            </div>
    </section>

    <script>
        // Selecting the iframe element
        var iframe = document.getElementById("myIframe").contentWindow;

        // iframe.$(".toggle_div").bind("change", function() {
        $("#myIframe").css({
            height: iframe.$("body").outerHeight()
        });
        // });
    </script>

    <!-- ============ FOOTER START ============ -->

    <footer>
        <div id="prefooter">
            <div class="container">
                <div class="row">
                  
                </div>
            </div>
        </div>
        <div id="credits">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        &copy; 2019 Job Board </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ============ FOOTER END ============ -->

  
    <!-- Modernizr Plugin -->
    <script src="js/modernizr.custom.79639.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>

    <!-- Bootstrap Plugins -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Retina Plugin -->
    <script src="js/retina.min.js"></script>

    <!-- ScrollReveal Plugin -->
    <script src="js/scrollReveal.min.js"></script>

    <!-- Flex Menu Plugin -->
    <script src="js/jquery.flexmenu.js"></script>

    <!-- Slider Plugin -->
    <script src="js/jquery.ba-cond.min.js"></script>
    <script src="js/jquery.slitslider.js"></script>

    <!-- Carousel Plugin -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Parallax Plugin -->
    <script src="js/parallax.js"></script>

    <!-- Counterup Plugin -->
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>

    <!-- No UI Slider Plugin -->
    <script src="js/jquery.nouislider.all.min.js"></script>

    <!-- Bootstrap Wysiwyg Plugin -->
    <script src="js/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- Flickr Plugin -->
    <script src="js/jflickrfeed.min.js"></script>

    <!-- Fancybox Plugin -->
    <script src="js/fancybox.pack.js"></script>

    <!-- Magic Form Processing -->
    <script src="js/magic.js"></script>

    <!-- jQuery Settings -->
    <script src="js/settings.js"></script>



    <!-- ======export to csv script==== -->
<script>


        function exportTableToCSV(filename) {


            // var csv = [];
         var idss=[];
            // var rows = document.querySelectorAll('table tr:not([style*="display:none"]):not([style*="display: none"])');
            
            // for (var i = 1; i < rows.length; i++) {
            //     var row = [], cols = rows[i].querySelectorAll("td, th");
                
            //     for (var j = 0; j < cols.length-1; j++) 
            //         row.push(cols[j].innerText);
            //         idss.push(cols[4].innerText);
                    
            //         console.log(idss);
            idss=favorites;
            console.log(idss);
                
 

        // }
        //ajax call 
    $.ajax({
         url: "set_session.php",
         type:'post',
         data: { role: idss }
    });     

    $('#exportbtn').html('Saved!');
   
        }

        function downloadcsv(){

        
        window.location.href = "http://<?php  echo $_SERVER['SERVER_NAME']; ?>/jobs/site/exportshortliststud.php";
        }



        // ------load more students---------

          $(document).ready(function () {
                  
          });



        //   ---------send students to loaders function
        function sendids(){
                var newArray = favorites;
                // var stid=[];
                console.log(newArray);
          
                // ------------
                var x= $('#admins_email').val();
                // var y=JSON.stringify(stid);
                var z="to_loaders";
                var w='<?php echo $_SESSION['emailemp'];?>';


                // -----change authorised to unauthorised
// <?php 
//  if(sizeof(favorites)){
//         $arrlen=count(favorites);
//         // echo $arrlen;
//         // echo $studlistobtain[1];
//             for($x=0;$x<$arrlen;$x++){
//             $sql = "SELECT * FROM Student where student_id='$studlistobtain[$x]' and is_authorised=0";
//             $result = $db->query($sql);
            
//             if ($result ->num_rows >0) {
               
//                 while($row1 = $result->fetch_assoc()) {
//                 }
//             }
//         }
//     }
//     ?>



                // -----------------------------------------

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


// ----------sorting algo----------
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("tobesorted");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      console.log(x,y);
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}


// --------------------------
    </script>


<?php


function writeStudents(){


    $sql = "SELECT * FROM Student WHERE (curr_ctc BETWEEN '1' and '4') and (experience BETWEEN '1' and '3')";
    $result = $db->query($sql);
    
    if ($result ->num_rows >0) {
       
        while($row1 = $result->fetch_assoc()) {
            ?>
            <tr >
            <td><input type="checkbox" class="studentcheckbox" value="<?php echo $row1['student_id']; ?>" name="id[]"></td>
            <!-- <td > <?php echo $row1["college_id"];?> </td> -->
            <td  > <?php echo $row1["college_name"];?></td>
            <td ><?php echo $row1["college_location"];?></td>
            <!-- <td ><?php echo $row1["student_id"];?></td> -->
            <td  ><?php echo $row1["stud_name"];?></td>
            <td  ><?php echo $row1["contact"];?></td>
            <td  ><a href="mailto:<?php echo $row1["email"];?>"><?php echo $row1["email"];?></a></td>
            <td  ><a href="../specialty/uploads/<?php echo $row1['student_id']; ?>/<?php echo $row1["resume"];?>" target="blank">View</a></td>
            <td  ><button id="<?php echo $row1['student_id'];?>" onclick="shortlist(this.id);" style="background:transparent;color:black">Shortlist</button></td>
    
    
    
            </tr>
    
         <?php   
        }
    } else {
        echo "0 results";
    }
    
}


?>

</body>


</html>