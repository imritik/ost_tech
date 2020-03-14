<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emaildl'])){
    // echo $_SESSION['company'];
    // echo "hi";
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
include '../dbConfig.php';
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
    <link href="css/style.css" rel="stylesheet">

    <style>
    .unselectable{
     /* background-color: #ddd; */
     cursor: not-allowed;
     
    }
    .df2{
        position:fixed;
        right:0;
        bottom:0;
        height:100%;
    }
    .df3{
        position:fixed;
        left:0;
        bottom:0;
        height:100%;
    }
    .df4{
        position:fixed;
        left:60%;
        bottom:50%;
        top:50%;
        height:100%;
    }
    </style>

</head>

<body>

    <!-- ============ PAGE LOADER START ============ -->
<div class='df1'>
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
                <li><a class='link-login'><?php echo $_SESSION['emaildl']; ?></a></li>
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
  <!-- Import link -->
  <div class="col-md-4 head">
        <div class="float-right">
            <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Add candidates</a> -->
        </div>
                <!-- CSV file upload form -->
            <div class="col-md-4" id="importFrm" style="display: none;">
            <br>
                <form action="importbydl.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" />
                    <br>
                    <input type="submit" class="btn btn-primary" name="importSubmitbydl" value="IMPORT">
                </form>
                <br>
            </div>
    </div>
 



  
  <div class="col-md-4">
        <!-- <button onclick="showform();" class="btn btn-primary">Entry Form</button> -->
        <a href='loaders.php' class='btn btn-sm btn-primary'>Home</a>
              
            </div>


            <div class="col-md-4">
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
              
            </div>
            <div id="actionbar" class='col-md-4' style="float:right;display:none">
                        <button class="btn btn-danger btn-sm" onclick="deletejob();"><i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>
            
            <!-- -----------filters---- -->
</div>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
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
    </section>

    <!-- ============ TITLE END ============ -->

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row" style="overflow-x:auto;">
          
            <div class="form-group" id="job-company-group">
                          
                  
                    <br>
                    <form action='' method='post' >
                    <!-- <button name="showstudentlist" class="btn btn-sm" id="foo">Search</button> -->
<br>
<br>
                    <input type='date' name="daterange1" id="dr1">-<input type='date' name='daterange2' id="dr2">
                   
                    </form>
                    <button onclick="setjscookie();">Filter</button>
                        </div>

                             <table class="table table-striped">
                                    <thead>
                                        <tr class="filters">
                                            <th></th>
                                            <!-- <th>College </th>
                                            <th>College_location</th>
                                            <th>Student id</th> -->
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <!-- <th>Registered on</th> -->
                                            <th style="color:black">Resume</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    


                    <!-- -------php code to fetch data from two tables---- -->

                  
<?php
// if(isset($_POST['showstudentlist'])){
 if (isset($_COOKIE["sidss"])){
   
    $studlistobtain=explode(",",$_COOKIE['sidss']);
  
    // echo sizeof($studlistobtain);
    if(sizeof($studlistobtain)){
        $arrlen=count($studlistobtain);
        // echo $arrlen;
        // echo $studlistobtain[1];
            for($x=0;$x<$arrlen;$x++){
            $sql = "SELECT * FROM Linkedin where student_id='$studlistobtain[$x]' and is_authorised=0";
            $result = $db->query($sql);
            
            if ($result ->num_rows >0) {
               
                while($row1 = $result->fetch_assoc()) {
                    $resumelinks='http://talentchords.com/jobs/specialty/uploads/linkedin/'.$studlistobtain[$x].'/'.$row1['resume'];
                    // $resumelinks='http://localhost/ost_internship/specialty/uploads/'.$studlistobtain[$x].'/'.$row1['resume'];
                   
                    $currstudid=$row1['student_id'];
                    ?>
                    <tr id="<?php echo $row1["student_id"];?>">
                    <td> <input type="checkbox" class="chk" name="jb" value="<?php echo $studlistobtain[$x]; ?>">
                   </td>
                    <!-- <td contenteditable="false" > <?php echo $row1["college_name"];?></td>
                    <td contenteditable="false" ><?php echo $row1["college_location"];?></td>
                    <td class='unselectable' readonly><?php echo $row1["student_id"];?></td> -->
                    <td contenteditable="false"  ><?php echo $row1["stud_name"];?></td>
                    <td contenteditable="false"  ><?php echo $row1["contact"];?></td>
                    <td contenteditable="false"  ><?php echo $row1["email"];?></td>
                    <!-- <td class='unselectable'  ><?php echo $row1['updated_on'];?></td> -->
                    <!-- <td class='unselectable' ><a href="../specialty/uploads/<?php echo $row1["student_id"];?>/<?php echo $row1["resume"];?>" target="blank"><?php echo $resumelinks; ?></a></td> -->
            <td><button class="btn btn-xs" id="<?php echo $currstudid;?>" onclick="showcvform('<?php echo $resumelinks;?>','<?php echo $currstudid;?>')">View</button></td>
                 
                        <!-- <td>
                <button id="edit_button1" value="Edit" class="editbtn btn btn-info btn-sm">Edit</button>
                </td> -->
                <td style='display:flex'>
                <!-- Add resume -->
                <form id="<?php echo $row1["student_id"];?>" tag='<?php echo $row1["resume"];?>' class='form_resume' enctype="multipart/form-data" resumeid='<?php echo $row1["student_id"];?>'>
                <input type='file' name='upd_resume' id='resumefile<?php echo $row1["student_id"];?>'>
                <button type='submit' id='upl_resume' class='editresume' value='Upload Resume' ><i class="fa fa-upload" aria-hidden="true"></i>
</button>
</form>
                </td>
                <td><button id="<?php echo $row1["student_id"];?>" class='btn btn-sm btn-primary' onclick='authorisedStudent(this.id);'>Authorise</button></td>
                    </tr>
            
                 <?php   
                }
    
    }
    else{
        // echo "No results";
    }

 } 
 
}
 }
 else{
     echo "no students found.";
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



    <!-- ============ CONTACT END ============ -->

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
                        &copy; Job Board
                    </div>
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
    <script>
    function getjobids(x){
        var y=x
            alert(y);
            document.cookie = "sidss=";
          
// getting student ids with admin email

                            $.ajax({
                                url: 'studentbyadminlinkedin.php',
                                type: 'POST',
                                data: {param1:y},
                                dataType:"json",
                                success:function(){console.log("seach succsss");},
                                error:function(data){console.log(data);}
                            }).done(function(data){
                                // alert(data);
                                console.log(data);
                                document.cookie="sidss="+data;
                                // $( "#foo" ).trigger( "click" );

    });
    }

   
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

// function display(startDate,endDate) {
//     console.log(startDate,endDate);
//     //alert(startDate)
//     startDateArray= startDate.split("-");
//     endDateArray= endDate.split("-");
//     // console.log(startDateArray);
//     // console.log(endDateArray);
//     var startDateTimeStamp = new Date(startDate).getTime();

//     // var startDateTimeStamp = new Date(startDateArray[2],+startDateArray[0],startDateArray[1]).getTime();
//     // var endDateTimeStamp = new Date(endDateArray[2],+endDateArray[0],endDateArray[1]).getTime();
//     var endDateTimeStamp = new Date(endDate).getTime();
// console.log(startDateTimeStamp);

// console.log(endDateTimeStamp);
//     $("tr").each(function() {
//         console.log("in table");
//         var rowDate = $(this).find('td:nth-child(7)').text();
        
//         rowDate=rowDate.substring(0,11);
//         // console.log(rowDate);
//         rowDateArray= rowDate.split("-");
//         // console.log(rowDateArray);

// // var rowDateTimeStamp =  new Date(rowDateArray[2],+rowDateArray[0],rowDateArray[1]).getTime();
// var rowDateTimeStamp =  new Date(rowDate).getTime();

// console.log(rowDateTimeStamp);
//         // alert(startDateTimeStamp<=rowDateTimeStamp)
//         // alert(rowDateTimeStamp<=endDateTimeStamp)
//         if(startDateTimeStamp<=rowDateTimeStamp && rowDateTimeStamp<=endDateTimeStamp) {
//             $(this).css("display","block");
//         } else {
//             $(this).css("display","none");
//         }
//     });
// }



// ==================================


$('.editbtn').click(function () {
              var currentTD = $(this).parents('tr').find('td');
              console.log(currentTD);
              if ($(this).html() == 'Edit') {
                  currentTD = $(this).parents('tr').find('td');
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', true)
                  });
              } else {
                 $.each(currentTD, function () {
                      $(this).prop('contenteditable', false);
                      studentdata={}
                      studentdata.college=currentTD[1]['innerHTML'];
                      studentdata.college_loc=currentTD[2]['innerHTML'];
                      studentdata.student_id=currentTD[3]['innerHTML'];

                      studentdata.name=currentTD[4]['innerHTML'];
                      studentdata.contact=currentTD[5]['innerHTML'];
                      studentdata.email=currentTD[6]['innerHTML'];
             
                  });
                  console.log(studentdata);
                    //   -----ajax request to send and update new data-----


                             $.ajax({
                                url: 'savestudentlinkedin.php',
                                type: 'POST',
                            
                                data: {data:studentdata},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                             
                               
                            })
                            .fail(function() {
                                alert("error in saving");
                            });


                    // ----------------------------------

              }
    
              $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
    
});
    
// ===================================================for updating resume------------------

$(".form_resume").on('submit',(function(e) {
    e.preventDefault();   
    // console.log(this.id); 
    var curr_stud=this.id;
    // console.log('tag',$(".form_resume").attr('tag'));
    var resumename=$(".form_resume").attr('tag');
    var myFormData = new FormData();
        var media = document.getElementById('resumefile'+curr_stud);
       console.log(resumename);
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
                            url: 'resumebydllinkedin.php',
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


// ----checkbox select--

 var favorites = [];

   
$(".chk").click(function(){
    $('#actionbar').show();

    var favorite=[];
        $.each($("input[name='jb']:checked"), function(){            
            favorite.push($(this).val());
        });
        favorites=favorite;
     console.log(favorites);
 

});


   function deletejob(){
        favorites.forEach(function(i){
deletejobpart(i);
        });
    }

    function deletejobpart(x){
                            $.ajax({
                                url: 'deletestudentlinkedin.php',
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
                
                for (var j = 0; j < cols.length-2; j++) 
                    row.push(cols[j].innerText);
                
                csv.push(row.join(","));        
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }



        // -------document ready
        $( document ).ready(function() {
            console.log( "ready!" );
            getjobids('<?php echo $_SESSION['emaildl'] ?>');
        });



// -----maintaining the time gap between two uploads-----

      
    </script>
 </div>
 <div class='df2'style='display:none'>
 <iframe id="forPostyouradd" name='form' data-src="http://www.w3schools.com" src="loaders_form/form.php?jid=2" width="550" style="background:#ffffff;height:inherit"></iframe>
 </div>
 <div class='df3'style='display:none'>
 <iframe name='cv' data-src="http://www.w3schools.com" src="loaders_form/form.php?jid=2" width="750" style="background:#ffffff;height:inherit"></iframe>
 </div>
 <div class='df4' style='display:none'><button onclick='showform();'><i class="fa fa-close" style="font-size:30px;color:red"></i></button></div>
 
 <script>
 var frm = ['form', 'cv'];
 var hrf=[];
 function setSource() {
            for(i=0, l=frm.length; i<l; i++) {
                document.querySelector('iframe[name="'+frm[i]+'"]').src = hrf[i];
            }
        }
     function showform(){
         $('.df2').toggle();
         $('.df3').toggle();
         $('.df4').toggle();


     }
     function showcvform(x,y){
         console.log(x,y);
         var hrf1 = ['loaders_form/formlinkedin.php?jid='+y, x];
         hrf=hrf1;
         setSource();
         $('.df2').toggle();
         $('.df3').toggle();
         $('.df4').toggle();


     }

     function authorisedStudent(sid){
         console.log(sid);

                           $.ajax({
                                url: 'loaders_form/authorisedStudlinkedin.php',
                                type: 'POST',
                                data: {param1:sid},
                                dataType:"json",
                                success:function(){   
                                    alert(data);
                                    console.log(data);
                                    location.reload();
                                },
                                error:function(data){
                                    alert(data.responseText);
                                    console.log(data.responseText);
                                    location.reload();
                                 }
                            }).done(function(data){
                                alert(data);
                                console.log(data);
                                location.reload();
                            });
     }
     </script>
</body>


</html>