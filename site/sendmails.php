<?php
session_start();
if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
// $cname=$_SESSION['company'];
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
        
        .filterable .filters input[disabled] {
            background-color: transparent;
            border: none;
            cursor: auto;
            box-shadow: none;
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
                    <!-- <h4>Find your perfect match</h4> -->
                    <button onclick="exportTableToCSV('candidates.csv')" style="float:right" class="btn btn-primary">Export to CSV File</button>

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
                            <div class="container" style="min-height:200px;height: auto">
                            <div class="row" style="display:contents">
                              
<span id="checkspan">
                               
                    
                                <button id="btnshortlistall" class="btn btn-sm" style="background:aliceblue;display:none">Send Mail(s)</button>
                                </span>
                                

   
    





</div>

                            <!-- ======== -->

<div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Candidates</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                    <th style="color:black;display:flex;"> <input type="checkbox" id="selectall">&nbsp;Select</th>
                        <th><input type="text" class="form-control" placeholder="College Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="College location" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student ID#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student Email" disabled></th>
                       <th> <input type="text" class="form-control" name="input" placeholder="Registration Date" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD" disabled></th>
                        
                    </tr>
                </thead>
                <tbody>
                   


                    <!-- -------php code to fetch data from two tables---- -->

                         
<?php
$sql = "SELECT * FROM Student";
$result = $db->query($sql);

if ($result ->num_rows >0) {
   
    while($row1 = $result->fetch_assoc()) {
        ?>
        <tr >
        <td><input type="checkbox" class="studentcheckbox" value="<?php echo $row1['email']; ?>" name="id[]"></td>
        <!-- <td > <?php echo $row1["college_name"];?> </td> -->
        <td  > <?php echo $row1["college_name"];?></td>
        <td ><?php echo $row1["college_location"];?></td>
        <td ><?php echo $row1["student_id"];?></td>
        <td  ><?php echo $row1["stud_name"];?></td>
        <td  ><?php echo $row1["contact"];?></td>
        <td  ><?php echo $row1["email"];?></td>
        <td  ><?php echo substr($row1["updated_on"],0,10);?></td>
     
        </tr>

     <?php   
    }
} else {
    echo "0 results";
}


// $conn->close();
?>



                    <!-- ----------------- -->
                   
                </tbody>
            </table>
        </div>
    </div>
    <script>
    /*
                                            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
                                            */
    $(document).ready(function() {
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
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function() {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
            }
        });
    });


// ----checkbox select--

 var favorites = [];

   
$(".studentcheckbox").click(function(){
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
    sendmail(stid);
})

    });
</script>
<script>

    function sendmail(studid){
       

                $.ajax({
                                url: 'mail.php',
                                type: 'POST',
                            
                                data: {param2:studid},
                            })
                            .done(function(response) {
                                alert(response);
                                //do something with the response
                                // $('#'+studid).html('<p style="color:white;background:forestgreen">Mailed</p>');
                               
                            })
                            .fail(function() {
                                alert("error while sending mails");
                            });
     
     }

</script>

                            </div>

                        </div>
                   
                    </div>


                </div>
            </div>
    </section>

    

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