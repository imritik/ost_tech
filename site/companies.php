<!DOCTYPE html>

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
include '../dbConfig.php';
include 'partials/header.php';
  ?>


    <!-- ============ TITLE START ============ -->

    <section id="title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Companies</h1>
                    <div id="actionbar" style="float:right;display:none">
                    <!-- <button class="btn btn-warning btn-sm" onclick="repost();">Repost</button> -->
                        <button class="btn btn-danger btn-sm" onclick="deletejob();"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete </button>
                    </div>

                </div>
            </div>
            <br>
            <!-- -----------filters---- -->

<?php


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
 <!-- Import link -->
 <div class="col-md-12 head">
        <div class="float-right">
            <!-- <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="formToggle('importFrm');"><i class="plus"></i> upload feedback</a> -->
        </div>
        <br>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="csv_v2/importfeedback.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filefeedback" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmitfeedback" value="IMPORT">
        </form>
        <br>
    </div>

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


               <!-- <div class="container"> -->
                 
                <!-- </div> -->
        </div>
    </section>

    <!-- ============ TITLE END ============ -->

    <!-- ============ JOBS START ============ -->

    <section id="jobs">
        <div class="container">
            <div class="row">
            <!-- <button onclick="exportTableToCSV('candidates.csv')" style="float:right" class="btn btn-primary btn-sm">Export to CSV File</button> -->

                <div class="col-sm-12">
<input type="checkbox" id="selectall">Select All
                    <div class="jobs">

<!-- ------------- -->

                          

<?php
// echo $_REQUEST['category'];
$reqcat=$_SESSION['company'];
// Get images from the database
$querycat = $db->query("SELECT * FROM employer_account order by added_on DESC");

if($querycat ->num_rows >0){
    while($row = $querycat->fetch_assoc()){
        ?>
                        <!-- Job Shared 1 -->
                        <a href="editcompany.php?jid=<?php echo $row['email'];?>" target="blank" class="featured applied list-item" style="display:none;">

                            <div class="row" >

                                <div class="col-md-1 hidden-sm hidden-xs">
                                <!-- <i class="fa fa-link" aria-hidden="true"></i> -->
                                <input type="checkbox" class="chk" name="jb" value="<?php echo $row['email']; ?>">

                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 job-title">
                                    <h5> <?php echo $row['company_name']; ?></h5>
                                    <p><strong><?php echo $row['email']; ?></strong> </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                                    <p><strong><?php echo $row['url']; ?></strong></p>
                                    <p class="hidden-xs">Acc Manag.:<strong><?php echo $row['am']; ?></strong> </p>
                                </div>
                                <div class="col-lg-2 col-md-2 hidden-sm hidden-xs job-type text-center">
                                <p class="badge full-time"><?php echo substr($row['added_on'],0,10); ?></p>

                        
                                </div>

                            </div>
                        </a>


                       
    <?php }}
    ?>


                    </div>
                    <div class="list-item-secondary-wrap text-center">
                    <br>
                                <button id="loadMore" class="btn" style="background: teal;color: white;">Load More Companies</button>
                            </div>

                    <nav>
                       
                    </nav>

                </div>

            </div>
        </div>
    </section>

    <!-- ============ JOBS END ============ -->



    <!-- ============ CONTACT END ============ -->
<!-- Modernizlugin -->
    <script src="js/modernizr.custom.79639.js"></script>
    <!-- jQuery (ecessary for Bootstrap's JavaScript plugins) -->
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


  <!-- -----load more script---- -->
  <script>
    $(document).ready(function () {
    size_li = $(".list-item").length;
    // console.log(size_li);
    x=2;
    $('.list-item:lt('+x+')').show();
    $('#loadMore').click(function () {
        if(x==size_li){
            alert("no more jobs");
        }
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('.list-item:lt('+x+')').show();
        
    });
    // $('#showLess').click(function () {
    //     x=(x-5<0) ? 3 : x-5;
    //     $('#myList li').not(':lt('+x+')').hide();
    // });

    $('#search').click(function(){
    $('.contact-name').hide();
    var txt = $('#loc-criteria').val();
    var txttitle = $('#title-criteria').val();
    var txtcategory = $('#category-criteria').val();
    var txtcompany = $('#company-criteria').val();
    $('.list-item').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txttitle.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txtcategory.toUpperCase()) != -1 && $(this).text().toUpperCase().indexOf(txtcompany.toUpperCase()) != -1 ){
           $(this).show();
       }
       else{
           $(this).hide();
           $('#loadMore').hide();
       }
    });
});
});

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

    // -----for selecting all student at once---
    $("#selectall").click(function () {
        $('#actionbar').show();
        var jobarr=[]
        $('.list-item').each(function(i, obj) {
            //test
            // console.log(obj);
            if($(this).is(":visible")) {
            
            console.log(obj);
            if($(this).find('.chk').prop('checked') == false){
                $(this).find('.chk').prop('checked',true);
                jobarr.push($(this).find('.chk').val());
                favorites=jobarr;
                console.log(favorites);

            }
            else{
                $(this).find('.chk').prop('checked',false);
                jobarr=[];
                favorites=jobarr;
                console.log(favorites);

            }

            }
        });

      
   
    });

    function repost(){
        favorites.forEach(function(i){
            console.log(i);
repostpart(i);

        });
    }

    function repostpart(x){
        console.log(x);
                             $.ajax({
                                url: 'repost.php',
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

    function deletejob(){
        favorites.forEach(function(i){
deletejobpart(i);
        });
    }

    function deletejobpart(x){
                            $.ajax({
                                url: 'deletecompany.php',
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
    
    
    </script>



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