 <?php 
    include 'dbConfig.php';
    // session_start();
    // if(isset($_SESSION['stud_id'])){
    //   }
    //   else{
    //   }
    $jpi=$_REQUEST['jpi'];
    ?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <title>Single Job &ndash; Specialty</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="specialty/css/base.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/mmenu.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/magnific.css">
    <link rel="stylesheet" type="text/css" href="specialty/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="specialty/style.css">

    <link rel="shortcut icon" href="#">
    <link rel="apple-touch-icon" href="#">
    <link rel="apple-touch-icon" sizes="72x72" href="#">
    <link rel="apple-touch-icon" sizes="114x114" href="#">

    <style>
    #myModal {
    position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 20px;
  color: white;
  transform: translate(-50%,-50%);
  background:cadetblue;
  -ms-transform: translate(-50%,-50%);
}
    </style>
</head>

<body>




    <div id="page">
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mast-head">
                            <h1 class="site-logo">
                                <a href="index.php">
                                    <img src="images/logo-light.png" alt="">
                                </a>
                            </h1>
                            <nav class="nav">
                                <ul class="navigation-main">
                                    <li class="menu-item-home current-menu-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                   
                                    <!-- <li class="menu-item-btn">
                                        <a href="../logout.php">Logout</a>
                                    </li> -->


                                </ul>
                                <!-- #navigation -->

                              
                            </nav>
                            <!-- #nav -->

                            <div id="mobilemenu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ======php=============== -->

<?php

$query = $db->query("SELECT * FROM Job_Posting WHERE posting_id='$jpi'");
            
if($query ->num_rows ==1){
    $row1 = $query->fetch_assoc();

   

   ?>

   


        <div class="page-hero" style="background-image: url(images/hero-1.jpg);">
    
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-hero-content">
                            <h1 class="page-title"><?php echo $row1['job_title']; ?>  </h1>
                            <div class="page-hero-details">
                                <span class="item-badge job-type-full-time"><?php echo $row1['Job_type']; ?> </span>
                                <span class="entry-location"><?php echo $row1['Job_location']; ?> </span>
                                <span class="entry-company"><?php echo $row1['company_name']; ?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
function redirectlogin(){
    alert("Please login to apply");

}
</script>

        <main class="main main-elevated">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-xs-12">
                        <div class="content-wrap">
                            <article class="entry">
                                <div class="entry-content">
                                    <p><?php echo $row1['job_description']; ?></p>

                                   

                                    <h2>How to Join the Team:</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur blanditiis corporis cumque cupiditate dignissimos, dolor dolorem eaque eligendi error et ex exercitationem expedita facere facilis ipsum iste laboriosam
                                        magni minus, modi mollitia obcaecati officia optio quo repellat repellendus temporibus totam unde. Alias assumenda iste libero ullam. Aspernatur perspiciatis rem voluptatum?</p>

                                </div>
                            </article>

                            <?php if(isset($_SESSION['stud_id'])){
                                ?>
                    <a id="<?php echo $jpi; ?>" class="btn btn-block btn-apply-content" name="applyforjob" onclick="applyforjob(this.id,<?php echo $sid; ?>);">Apply for this job</a>


                        <?php    }
                            else{
                                ?>
                                <a id="<?php echo $jpi; ?>" class="btn btn-block btn-apply-content" name="applyafterogin" onclick="redirectlogin();">Login to Apply</a>

                        <?php    }
                ?>
                

              
                          
                        </div>
                        <div  id="myModal" style="display:none" >
                        <div  id="text">
                        <div  style="padding:20px">
                                <form action="login/stud.php" method="post">

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="emailstud" placeholder="email" value="fff@ff.com" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="passwordstud" placeholder="Password" value="denim" required="required">
                                    </div>

                                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                                </form>
                            </div>
                            <button  type="button" class="btn editbtn btn-default" onclick="off();" >Close</button>
                            </div>
                            </div>
                       


<script>


function applyforjob(x,y){
    alert(x);
    alert(y);
                            $.ajax({
                                url: 'applyforjob.php',
                                type: 'POST',
                            
                                data: {param1: x,param2:y},
                            })
                            .done(function(response) {
                                alert(response);
                                //do something with the response
                                $('#'+x).html('Applied');
                                localtion.reload();
                               
                            })
                            .fail(function() {
                                alert("error while applying");
                            });
}

function redirectlogin(){
    $('#myModal').show();
    document.cookie='recentjid='+<?php echo $jpi; ?>;
    document.cookie='firsttime=yes';
}

function off() {
  document.getElementById("myModal").style.display = "none";
}

</script>
   
                     
                    </div>

                    <div class="col-xl-3 col-lg-4 col-xs-12">
                        <div class="sidebar">
                            
                            <aside class="widget widget_ci-company-info-widget">
                                <h3 class="widget-title">Company Information</h3>

                                <div class="card-info">
                                    <div class="card-info-media">
                                        <figure class="card-info-thumb">

<!-- //getting the logo of company by its email here -->
<?php
$email=$row1['email'];
$clogo='';
$querylogo = $db->query("SELECT * FROM employer_account WHERE email='$email'");
            
if($querylogo ->num_rows ==1){
    $row5 = $querylogo->fetch_assoc();
    $clogo=$row5['logo'];
}
?>

                                            <img src="site/uploads/<?php echo $email; ?>/<?php echo $clogo; ?>" alt="company_logo">
                                        </figure>

                                        <div class="card-info-details">
                                            <p class="card-info-title"><?php echo $row1['company_name']; ?> </p>
                                            <p class="card-info-link">
                                                <a href="#"><?php echo $row1['company_url']; ?> </a>
                                            </p>

                                       
                                        </div>
                                    </div>

                                    <div class="card-info-description">
                                        <p>There’s a lot of opportunity here to work on a wide range of very challenging projects and to grow quickly.</p>
                                    </div>
                                </div>
                            </aside>

                        </div>
                    </div>
                </div>
            </div>

<?php 
}
?>
        </main>

        <footer class="footer">
            <div class="container">
                

                <div class="footer-copy">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <p>
                                <a href="#">Specialty</a> &ndash; Job Board
                            </p>
                        </div>


                    </div>
                </div>
            </div>
    </div>
    </div>
    </footer>
    </div>
    <!-- #page -->

    <script src="specialty/js/jquery-1.12.3.min.js"></script>
    <script src="specialty/js/jquery.mmenu.min.all.js"></script>
    <script src="specialty/js/jquery.fitvids.js"></script>
    <script src="specialty/js/jquery.magnific-popup.js"></script>
    <script src="specialty/js/jquery.matchHeight.js"></script>
    <script src="specialty/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="specialty/js/scripts.js"></script>

</body>
</html>