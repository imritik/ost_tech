<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['coordinatoremp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../admin_jobs/admin_home.php");

  }
include '../../dbConfig.php';
$coordinator_email=$_SESSION['coordinatoremp'];
$sql="SELECT * FROM admins WHERE email='$coordinator_email'";
$result = $db->query($sql);
$companies=array();
$jobs=array();
$jobs_details=array();
$to_admin_data=array();
$company_names=array();
if ($result ->num_rows ==1) {
    while($row1 = $result->fetch_assoc()) {
        $companies=json_decode(stripslashes($row1['company']));
        // var_dump($companies);
        if(sizeof($companies)){
            $arrlen=count($companies);
                for($x=0;$x<$arrlen;$x++){
                    // var_dump($companies[$x]);
                    // ------collect all jobs of company here
                    $sqljob="SELECT * FROM Job_Posting WHERE email='$companies[$x]' AND posting_time >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
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

// ---get company names
 for($i=0;$i<sizeof($companies);$i++){
    $sqlname="SELECT * FROM employer_account WHERE email='$companies[$i]'";
    $resultname = $db->query($sqlname);
    if ($resultname ->num_rows > 0) {
         while($rowname = $resultname->fetch_assoc()) {
             array_push($company_names,$rowname['company_name']);
        }
    }
}
?>

<html>
    <head>
       <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <link rel="shortcut icon" href="images/favicon.png">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
                .showtable{
                      position: fixed;
                        right: 0;
                        left:0;
                        bottom: 0;
                        top: auto;
                        height: 500px;
                }
        </style>
    </head>

    <!-- ============ PAGE LOADER END ============ -->

    <!-- ============ NAVBAR START ============ -->
<body onload="setclick()">
    <div class="fm-container">
        <!-- Menu -->
        <div class="menu">
            <div class="button-close text-right">
                <a class="fm-button"><i class="fa fa-close fa-2x"></i></a>
            </div>
            <ul class="nav">
             <?php
                for($i=0;$i<sizeof($companies);$i++){
                    echo '<li id="'.$i.'" style="font-size:12px" name="'.$companies[$i].'" onclick="showjobs(\''.$companies[$i].'\')"><a href="#" style="width:max-content;padding: 10px;" >'.$company_names[$i].'<br>(<small class="company_name">'.$companies[$i].'</small>)</a> <ul id="'.$companies[$i].'" class="'.$companies[$i].'" style="font-size: initial;"></ul></li><br>';
                }
            ?>
            </ul>
            <ul class="nav">
                <li><a href="../../logout/logout.php">Logout</a></li>
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
              Account Manager (<?php echo $coordinator_email; ?>)
            </div>
            <div id="menu-open" class="pull-right">
                <a class="fm-button"><i class="fa fa-bars fa-lg"></i></a>
            </div>

        </div>
    </header>

   
<div class="container">

        <div class="col-sm-12 main">
            <h3 class="page-header text-center">Dashboard &nbsp;(<span id="showjobname" ></span>)</h3>

            <!-- <div class="showjobsdiv"> -->
                    <div class="showtable">
                         <iframe name='cv' id="frametable" data-src="http://www.w3schools.com" src="../loaders_form/form.php?jid=2" width="900" style="background:#ffffff;height:-webkit-fill-available;width: -webkit-fill-available;display:none"></iframe>
                    <br>
                    <br>
                    <br>
                    </div>
            <!-- </div> -->
            <br>
            <br>
            <br>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
</body>
<script>

var companyJobs=[];


function showjobs(cemail){
    document.getElementById(cemail).innerHTML='';
    console.log(cemail);
    var newArray=<?php echo json_encode($jobs_details); ?>;
    console.log(newArray);

    var companyjobs=newArray.filter(function(e1){
         return e1.email==cemail
    });
    companyJobs=companyjobs;
    console.log(companyJobs);
    if(!companyJobs.length){
        var e='<li><a href="#">No jobs</a></li>'
        document.getElementById(cemail).innerHTML=e;
    }
    else{
        for(i=0;i<companyJobs.length;i++){
        console.log(companyJobs[i]);
        var e='<li><a href="#" id="'+companyJobs[i].posting_id+'" onclick="showjobtable(this.id,this.innerHTML)">'+companyJobs[i].job_title+'</a></li>';
        document.getElementById(cemail).innerHTML+=e
    }
    }
}

function getcname(cemail){
 var newArray=<?php echo json_encode($jobs_details); ?>;
    var companyjobs=newArray.filter(function(e1){
         return e1.email==cemail
    });
    console.log(companyjobs);
    return companyjobs;
      
}

function setcname(){
     var companyArray=<?php echo json_encode($companies); ?>;
    console.log(companyArray.length);
            for(i=0;i<companyArray.length;i++){
                var value=document.querySelectorAll("li[id='"+i+"']")[0].innerText;
                var rr=value.toLowerCase();
                console.log(rr);
                console.log(rr.trim());
                console.log(getcname(rr.trim()));
                document.querySelectorAll("li[id='"+i+"'] a span")[0].innerText= getcname(rr.trim());
            }  

}

var frm = ['cv'];
 var hrf=[];
 function setSource() {
     console.log("in set source");
            for(i=0, l=frm.length; i<l; i++) {
                document.querySelector('iframe[name="'+frm[i]+'"]').src = hrf[i];
            }
        }

function urlchange(cat){
   

    window.location=window.location.protocol + "//" + window.location.host + window.location.pathname + '?status='+cat;
}

function showjobtable(jid,jname){
    console.log(jid,jname);
        //  urlchange("gg");
    $('#frametable').show();
    document.getElementById('showjobname').innerHTML=jname;
     var hrf1 = ['../am_showcandidates.php?jid='+jid];
     hrf=hrf1;
     setSource();
}

function setclick() {
    var companyArray=<?php echo json_encode($companies); ?>;
    // console.log(companyArray.length);
    //         for(i=0;i<companyArray.length;i++){
    //             console.log(i);
    //             console.log(document.querySelector("li[id='"+i+"']"));
    //             document.querySelector("li[id='"+i+"']").click();
    //         }
            // setcname();   
            var sleep = 0;
            $('.with-ul').each(function(){
                var likeElement = $(this);
                setTimeout(function() {
                    likeElement.trigger('click');
                }, sleep);
                sleep += 10000;
            }); 
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