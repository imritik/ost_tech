<!DOCTYPE html>

<?php
session_start();
if(isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
$cname=$_SESSION['company'];
include '../dbConfig.php';
?>
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

    <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
        <![endif]-->
        


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
                <li><a href="#home">Home</a></li>
                <!-- <li><a href="jobs.html">Jobs</a></li> -->
                <li><a href="post-a-job.php">Post a job</a></li>
                <li class="active"><a href="jobs.php">Jobs</a></li>
                <li class="active"><a href="candidates.php">Candidates</a></li>
                <!-- <li><a href="post-a-resume.html">Post a Resume</a></li> -->


                <!-- <li><a class="link-register">Register</a></li> -->
                <li><a  href="../logout.php">Logout</a></li>
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
                    <h4>Find your perfect match</h4>
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
                                <h3>Select Job to shortlist candidates</h3>

                                <select id="posted_jobs" name="posted_jobs" style="color:black">

                                                <option value="" >Select Job</option>

                                        <!-- -------php code to gather posted jobs---- -->
                                        <?php

                                        $query = $db->query("SELECT * FROM Job_Posting WHERE company_name='$cname'");
                                                    
                                        if($query ->num_rows >0){
                                            while($row = $query->fetch_assoc()){

                                                echo '<option value="' . $row['posting_id'] . '">' . $row['job_title'] .' ('.$row['Job_type'].')' . '</option>';
                                        ?>
                                            <?php }} ?>

                                </select>

<span id="checkspan">
                               
                    
                                <button id="btnshortlistall" class="btn btn-sm" style="background:aliceblue;display:none">Shortlist All</button>
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
                        <th><input type="text" class="form-control" placeholder="College ID#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="College Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="College location" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student ID#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Student Email" disabled></th>
                        <!-- <th><input type="text" class="form-control" placeholder="Student resume" disabled></th> -->
                        <!-- <th><input type="text" class="form-control" placeholder="Action" disabled></th> -->
                        <th style="color:black">Resume</th>
                        <th style="color:black">Action</th>
                    </tr>
                </thead>
                <tbody>
                   


                    <!-- -------php code to fetch data from two tables---- -->

                         
<?php
$sql = "SELECT College.*,Student.* FROM College,Student where College.id = Student.college_id";
$result = $db->query($sql);

if ($result ->num_rows >0) {
   
    while($row1 = $result->fetch_assoc()) {
        ?>
        <tr >
        <td><input type="checkbox" class="studentcheckbox" value="<?php echo $row1['student_id']; ?>" name="id[]"></td>
        <td > <?php echo $row1["id"];?> </td>
        <td  > <?php echo $row1["name"];?></td>
        <td ><?php echo $row1["loc"];?></td>
        <td ><?php echo $row1["student_id"];?></td>
        <td  ><?php echo $row1["stud_name"];?></td>
        <td  ><?php echo $row1["contact"];?></td>
        <td  ><?php echo $row1["email"];?></td>
        <td  >resume</td>
        <td  ><button id="<?php echo $row1['student_id'];?>" onclick="shortlist(this.id);" style="background:transparent;color:black">Shortlist</button></td>



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


    // -----for selecting all student at once---
    $("#selectall").click(function () {
        $('#btnshortlistall').toggle();
        if($('tr').is(":visible")) {
            // alert('hi');

             $(".studentcheckbox").prop('checked', $(this).prop('checked'));
    console.log($(".studentcheckbox"));
    //It's visible
        }
   
    });
// ------------------------------

$('#btnshortlistall').click(function(){
    var idss=$('.studentcheckbox:checked').map(function(){
        return $(this).val()
    }).get().join(',');

    alert(idss);
    idarray=idss.split(',');

idarray.forEach(function(stid){
    shortlist(stid);
})

    });
</script>
<script>

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
                                alert(response);
                                //do something with the response
                                $('#'+studid).html('<p style="color:white;background:forestgreen">Shorlisted</p>');
                               
                            })
                            .fail(function() {
                                alert("error in shortlisting");
                            });

            }
                
            }

</script>


                            <!-- ============== -->

                                <!-- <iframe src="../table.html"></iframe> -->
                                <!-- <iframe id="myIframe" src="../table.html" frameborder="0" style="height:100%;border: none;position: absolute" height="100%" width="100%"></iframe> -->
                            </div>

                        </div>
                        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
                        <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
                        <script src="js/datatables/datatables.js"></script> -->
                        <!-- <script type="text/javascript">
                            $(document).ready(function() {
                                $('.datatable').dataTable({
                                    "sPaginationType": "bs_four_button"
                                });
                                $('.datatable').each(function() {
                                    var datatable = $(this);
                                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                                    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                                    search_input.attr('placeholder', 'Search');
                                    search_input.addClass('form-control input-sm');
                                    // LENGTH - Inline-Form control
                                    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                                    length_sel.addClass('form-control input-sm');
                                });
                            });
                        </script> -->




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
                    <!-- <div class="col-sm-6" id="newsletter">
                        <h2>Newsletter</h2>
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="newsletter-email">Email address</label>
                                <input type="email" class="form-control" id="newsletter-email" placeholder="Email address">
                            </div>
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </form>
                    </div> -->
                    <!-- <div class="col-sm-6" id="social-networks">
                        <h2>Get in touch</h2>
                        <a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-google-plus-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-youtube-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-vimeo-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-pinterest-square"></i></a>
                        <a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                    </div> -->
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

    <!-- ============ LOGIN START ============ -->

    <div class="popup" id="login">
        <div class="popup-form">
            <div class="popup-header">
                <a class="close"><i class="fa fa-remove fa-lg"></i></a>
                <h2>Login</h2>
            </div>
            <form>

                <hr>
                <div class="form-group">
                    <label for="login-email">email</label>
                    <input type="email" class="form-control" id="login-email">
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password">
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>
    </div>

    <!-- ============ LOGIN END ============ -->

    <!-- ============ REGISTER START ============ -->

    <div class="popup" id="register">
        <div class="popup-form">
            <div class="popup-header">
                <a class="close"><i class="fa fa-remove fa-lg"></i></a>
                <h2>Register</h2>
            </div>
            <form>

                <hr>
                <div class="form-group">
                    <label for="register-name">Company Name</label>
                    <input type="text" class="form-control" id="register-name">
                </div>
                <div class="form-group">
                    <label for="register-surname">Company Registration Number</label>
                    <input type="text" class="form-control" id="register-surname">
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="register-email">
                </div>
                <hr>

                <div class="form-group">
                    <label for="register-password1">Password</label>
                    <input type="password" class="form-control" id="register-password1">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

    <!-- ============ REGISTER END ============ -->

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


</body>


</html>