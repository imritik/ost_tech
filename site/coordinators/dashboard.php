<?php 
session_start();
include '../../dbConfig.php';
$coordinator_email='test@test.com';
$sql="SELECT * FROM coordinators WHERE email='$coordinator_email'";
$result = $db->query($sql);
$companies=array();
$jobs=array();
$jobs_details=array();
$to_admin_data=array();
if ($result ->num_rows ==1) {
   
    while($row1 = $result->fetch_assoc()) {

        $companies=json_decode(stripslashes($row1['companies']));
        // var_dump($companies);
        if(sizeof($companies)){
            $arrlen=count($companies);
                for($x=0;$x<$arrlen;$x++){
                    // var_dump($companies[$x]);

                    // ------collect all jobs of company here

                    $sqljob="SELECT * FROM Job_Posting WHERE email='$companies[$x]' and coordinator='$coordinator_email'";
                    $resultjob = $db->query($sqljob);
                    if ($resultjob ->num_rows > 0) {
                        while($rowjob = $resultjob->fetch_assoc()) {
                            $jobid=$rowjob['posting_id'];
                            array_push($jobs,$rowjob['posting_id']);
                            array_push($jobs_details,$rowjob);
                            }
                    }

                    // -------------------------
                }
        } 
    }
 
}
?>
<html>
    <head>
    <link href="../css/style.css" rel="stylesheet">
  
        <style>
                .sidebar {
                width: 180px;
                }

                @media (min-width: 768px) {
                .main {
                padding-right: 40px;
                padding-left: 220px; /* 180 + 40 */
                }
                }
        </style>
    </head>
<div class="container-fluid">
    <div class="row"style="display:flex">
        <div class="sidebar">
        <ul class="nav nav-sidebar">
            <?php
                for($i=0;$i<sizeof($companies);$i++){
                    echo '<li class="active dropdown" name="'.$companies[$i].'"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" onclick="showjobs(\''.$companies[$i].'\')">'.$companies[$i].'<span class="caret"></span></a> <ul id="'.$companies[$i].'" class="dropdown-menu" role="menu"></ul></li>';
                }
            ?>
        </ul>
        </div>
        <div class="col-sm-12 main">
            <h3 class="page-header">Dashboard</h3>
            <div class="showjobsdiv">

            </div>
        </div>
    </div>
</div>
<script>
var companyJobs=[];
function showjobs(cemail){
    console.log(cemail);
    var newArray=<?php echo json_encode($jobs_details); ?>;
    var companyjobs=newArray.filter(function(e1){
         return e1.email==cemail
    });
    companyJobs=companyjobs;
    console.log(companyJobs);
    for(i=0;i<companyJobs.length;i++){
        console.log(companyJobs[i]);
        var e='<li><a href="#" id="'+companyJobs[i].posting_id+'">'+companyJobs[i].job_title+'</a></li>';
        //   $("#"+cemail).append(e);
    }

}
</script>
  <!-- ============ FOOTER END ============ -->

  
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

    <!-- Flickr Plugin -->
    <script src="../js/jflickrfeed.min.js"></script>

    <!-- Fancybox../ Plugin -->
    <script src="../js/fancybox.pack.js"></script>

    <!-- Magic Fo../rm Processing -->
    <script src="../js/magic.js"></script>

    <!-- jQuery S../ettings -->
    <script src="../js/settings.js"></script>



    <!-- ======export to csv script==== -->
<script>
</html>