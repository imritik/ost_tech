<style>
    
#example {
  table-layout: auto !important;
  width: 560px !important;  
  /* border:none !important; */
}

.hover { background-color:yellow; }


.btn{
    opacity:0.8
}
.btn:hover {opacity: 1;
font-size:13px
}

</style>



<?php
if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];
    ?>

    <script>
   $('#'+<?php echo $jid;?>).addClass('active');    
    </script>
    <?php

    $is_hold='';
// ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows > 0) {
                        while($row22 = $result22->fetch_assoc()) {
                            $hold_text='';
                            $hold_badge_text='';
                            $is_hold=$row22['is_hold'];
                            $postid=$row22['posting_id'];
                            $jobtitle=$row22['job_title'];
                            $cname=$row22['company_name'];
                            $currentCompEmail=$row22['email'];
// var_dump($is_hold);
                            if($is_hold){
$hold_text='Make Job Active';
$hold_badge_text='Freezed';
                            }
                            else{
$hold_text='Freeze Job';
$hold_badge_text='Active';
                            }
                            if(isset($_SESSION['emailhr'])&& $page!='view_mode'){
echo '<div><p style="font-size:x-large;margin-bottom:0">'.$jobtitle.'&nbsp;&nbsp;&nbsp;<span class="badge badge-primary">'.$hold_badge_text.'</span></p>
                    <button class="btn btn-info btn-xs"><a href="editjob.php?jid='.$postid.'" style="color:white">Edit</a></button>
                    <a class="btn btn-xs btn-info" href="../../job-details.php?jpi='.$postid.'" target="blank">View (Public View)</a>

                    <button class="btn btn-info btn-xs" onclick="deletejobpart(\''.$postid.'\');">Delete</button>
                    <button class="btn btn-info btn-xs" onclick="repostpart(\''.$postid.'\');">Repost</button>
                    <button class="btn btn-info btn-xs" onclick="holdjob(\''.$postid.'\');">'.$hold_text.'</button>
                    <button id="combine"class="btn btn-info btn-xs" style="display:none;float: right;" onclick="combine();">Same and Combine</button>
                    </div>
                    
                    ';
                            }
                            else if(isset($_SESSION['emailhr'])&& $page=='view_mode'){
echo '<div><p style="font-size:x-large;margin-bottom:0">'.$jobtitle.'&nbsp;&nbsp;&nbsp;<span class="badge badge-primary">'.$hold_badge_text.'</span></p>
                    <button class="btn btn-info btn-xs"><a href="../hr/editjob.php?jid='.$postid.'" style="color:white">Edit</a></button>
                    <a class="btn btn-xs btn-info" href="../../job-details.php?jpi='.$postid.'" target="blank">View (Public View)</a>
                    <button class="btn btn-info btn-xs" onclick="deletejobpart(\''.$postid.'\');">Delete</button>
                    <button class="btn btn-info btn-xs" onclick="repostpart(\''.$postid.'\');">Repost</button>
                    <button class="btn btn-info btn-xs" onclick="holdjob(\''.$postid.'\');">'.$hold_text.'</button>
                   
                    <button id="combine"class="btn btn-info btn-xs" style="display:none;float: right;" onclick="combine();">Same and Combine</button>
                    </div>
                    
                    ';
                            }
                            else{
 echo '<div><p style="font-size:x-large;margin-bottom:0">'.$jobtitle.'&nbsp;&nbsp;&nbsp;<span class="badge badge-primary">'.$hold_badge_text.'</span></p>
                            </div>
                    <a class="btn btn-xs btn-info" href="../../job-details.php?jpi='.$postid.'" target="blank">View (Public View)</a>';
                            }
                   
                            }
                    }
                    else{
                        echo '<p style="font-size:x-large">Invalid Job</p>';
                    }
                // }
                ?>
 
    <div style="float:right;">
      <?php
      if(!empty($_GET['jid'])){
          ?>
                         <?php 
if(isset($_SESSION['emailvendors'])){

    ?>
    <div class="col-md-12" style="text-align:center">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success btn-xs" data-toggle="tooltip" title="Add Candidates" onclick="formToggle('importFrm');"><i class="plus"></i> <i class="fa fa-upload" aria-hidden="true"></i></a>
                    </div>

                </div>&nbsp;
                       <button class="btn btn-primary" data-toggle="tooltip" title="Save Status" onclick="saveStatus()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
</button>
                <!-- CSV file upload form -->
                <div class="" id="importFrm" style="display: none;text-align: -webkit-center;">
                <br>
                    <form action="../csv_v2/importData_vendor.php?jid=<?php echo $jid;?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <br>
                        <input type="submit" class="btn btn-primary btn-xs" name="importSubmit" value="IMPORT">
                    </form>
                    <br>
                </div>
                <?php

}
else{

    if(!$is_hold){

    ?>
<div class="col-md-12 head" style="display: flex;">
       
         <div id="importFrm">
    
        <form action="../csv_v2/importData_vendor.php?jid=<?php echo $jid;?> method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            
            <input type="submit" class="btn btn-primary btn-xs" name="importSubmit" value="IMPORT Candidates">
        </form>
        
    </div>
        &nbsp;&nbsp;
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary" data-toggle="tooltip" title="Download CSV"><i class="fa fa-download" aria-hidden="true"></i></button>
       &nbsp;&nbsp;<button class="btn btn-primary" data-toggle="tooltip" title="Save Status" onclick="saveStatus()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
</button>
<br>
    </div>
    <!-- CSV file upload form -->
    <div id="importFrm" style="display: none;">
    <br>
        <form action="../csv_v2/importData_vendor.php?jid=<?php echo $jid;?> method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
        <br>
    </div>


    <?php
    }
    else{
        ?>

        <div class="col-md-12 head" style="display: flex;">
       
        &nbsp;&nbsp;
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary" data-toggle="tooltip" title="Download CSV"><i class="fa fa-download" aria-hidden="true"></i></button>
       &nbsp;&nbsp;<button class="btn btn-primary" data-toggle="tooltip" title="Save Status" onclick="saveStatus()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
</button>
    </div>

        <?php
    }
    ?>
         
                <?php 
      }
      ?>
            </div>
<?php
}
                ?>
    
    <br>
    <br>





<ul class="nav nav-tabs">
 <?php
    // if(isset($_SESSION['emailvendors'])){

?>
    <li class='uploaded'><a  onclick="setstatus('uploaded')">Upload CV&nbsp;<span></span></a></li>
<?php
    // }
    ?>
<?php
if(isset($_SESSION['emailhr'])){
    ?>
    <li class='new_arrival'><a  onclick="setstatus('new_arrival')">Probable duplicates&nbsp;<span></span></a></li>
<?php
}
if(!isset($_SESSION['emailvendors'])){

?>

    <li class='Shared'><a  onclick="setstatus('Shared')">To Process&nbsp;<span></span></a></li>
    <?php
    }
    ?>

   

    <li class='shortlist'><a  onclick="setstatus('shortlist')">Under Discussion&nbsp;<span></span></a></li>

     <?php
    if(!isset($_SESSION['emailvendors'])){

?>

    <li class='hold'><a  onclick="setstatus('hold')">Hold&nbsp;<span></span></a></li>
    <?php
    }
    ?>

    <li class='rejected'><a  onclick="setstatus('rejected')">Closed&nbsp;<span></span></a></li>

    <?php
    if(!isset($_SESSION['emailvendors'])){

?>
    <li class='Offered'><a  onclick="setstatus('Offered')">Offered&nbsp;<span></span></a></li>
    <?php
    }
    ?>

</ul>






  <div class="tab-content">
    <div id="home" class="col-md-12 tab-pane fade in active" >
       <!-- <div class="table-scrollable form-group tobehidden" style="transform: rotateX(180deg);overflow-x:auto"> -->
       <div class="table-scrollable col-md-8 form-group tobehidden"style="max-height:500px;overflow-y:scroll;" > 

      <!-- <table id="example" class="table table-striped table-condensed" style="transform: rotateX(180deg);" data-count-fixed-columns="2" cellpadding="0" cellspacing="0"> -->
      <table id="example" class="table table-striped table-condensed" style="" data-count-fixed-columns="2" cellpadding="0" cellspacing="0">

      <thead class="header">
<tr class="filters" style="background: white">

    <th style="color:black;"> </th>

    <th>Name</th>
     <?php if(isset($_SESSION['emailvendors'])&& $_GET['status']=='uploaded'){
                        ?>
    <th>Resume</th>
    <?php
    }
    ?>
 <?php if(isset($_SESSION['emailvendors'])&& $_GET['status']=='uploaded'){
        ?>
        
        <?php
        }
        else{
            ?>
        
            <th >Your comment*</th>
            <th>level</th>
            <?php
        }

   ?>

   
    
    <th >Status</th>
 

    </tr>
    </thead>





    <tbody class="results">
                <?php }
    if(!empty($_GET['jid'])&& !empty($_GET['status'])){
                $jid=$_GET['jid'];
                $status=$_GET['status'];
                ?>
                 <script>
   $('.<?php echo $status;?>').addClass('active');    
    </script>
    <?php
$query='';
$vendoremail='';
 if(isset($_SESSION['emailvendors'])){
     $vendoremail=$_SESSION['emailvendors'];
 }
 else  if(isset($_SESSION['ccemp'])){
     $vendoremail=$_SESSION['ccemp'];

 }
 else  if(isset($_SESSION['coordinatoremp'])){
     $vendoremail=$_SESSION['coordinatoremp'];

 }
 else if(isset($_SESSION['emailhr'])){
     $vendoremail=$_SESSION['emailhr'];


 }

        if(isset($_SESSION['emailvendors'])){


                if($status=='uploaded'){
                    $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND Student.Uploaded_by='$vendoremail' and Student.resume='' and(applied_table.Status='shortlist' or applied_table.duplicate_status='probable')";
                }
                else{

                    $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND Student.Uploaded_by='$vendoremail'and Student.resume!='' and applied_table.Status='$status'";
                }


        }
        else{



                if($status=='uploaded'){
                    $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND Student.Uploaded_by='$vendoremail' and Student.resume='' and(applied_table.Status='shortlist' or applied_table.duplicate_status='probable')";
                }
                    if($status=='new_arrival'){
                            $query = "SELECT * FROM applied_table where posting_id='$jid' and duplicate_status='probable'";

                    }

                    else if($status=='to_process'){
                            $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status' ORDER BY Status_update DESC";

                    }

                    else if($status=='shortlist'){
                    
                            $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND applied_table.Status NOT IN('rejected','hold','Shared','processed','Offered') and Student.resume!='' ORDER BY applied_table.Status_update DESC";
                        


                    }
                    else{
                            $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status' ORDER BY Status_update DESC";

                    }

        }


        
            if (!$result = mysqli_query($db, $query)) {
                exit(mysqli_error($db));
            }
            $studids=array();
            $hrcomment=array();
            $recruitercomment=array();
            $managercomment=array();
            $amcomment=array();
            $vendorcomment=array();
            // $studstatuss=array();
             $coordinatorcomment=array();
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($studids,$row['student_id']);
                
                    array_push($hrcomment,$row['hr_note']);
                    array_push($managercomment,$row['manager_note']);
                    array_push($recruitercomment,$row['recruiter_note']);
                    array_push($coordinatorcomment,$row['coordinator_note']);
                    array_push($vendorcomment,$row['vendor_note']);
                    array_push($amcomment,$row['Note']);




                } 
            }

        if(sizeof($studids)){
            // $number = 1;
             $studids=array_unique($studids);
            $arrlength = count($studids);
        // var_dump($studids);
        ?>
        <script>
         $('.<?php echo $status;?>').find( "span" ).html('(<?php echo $arrlength;?>)'); 
        </script>
        <?php
            for($x = 0; $x < $arrlength; $x++) {
            
            

            // Get images from the database
            $query = $db->query("SELECT * FROM Student WHERE student_id='$studids[$x]'");

        

            if($query ->num_rows ==1){
            $row1 = $query->fetch_assoc();
                // echo $row1;
            $sturesume=$row1["resume"];
            $ssid=$row1['student_id'];
            $sname=$row1['stud_name'];
            $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studids[$x].'/'.$sturesume;
            //    echo $ssid;
            // while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr data-id="<?php echo $ssid;?>">
                <td>
                <?php

                if($status=='new_arrival'){
                    ?>
                                <input type="checkbox" class="studentcheckbox1comp" value="<?php echo $row1['student_id'];?>" name="chkcomp"></td>
<?php
                }
                else{
                    ?>
                <input type="checkbox" class="studentcheckbox1" value="<?php echo $ssid;?>" name="chk" style="display:none" disabled></td>
<?php
                }
                ?>
              
                    <td class="headcol">
                    <a href='<?php echo $resumelinks;?>' target='blank'><?php echo $row1['stud_name'];?></a>
                   
                    <?php
                         if(!isset($_SESSION['emailvendors'])){
                            ?>
                   
                   <?php
                         }
                         ?>
                   </td>
             
                              
                    <?php if($status=='uploaded'){
                        ?>
                    <td>

                        <form id="<?php echo $row1["student_id"];?>" tag='<?php echo $row1["resume"];?>' class='form_resume' enctype="multipart/form-data" resumeid='<?php echo $row1["student_id"];?>'>
                                        <input type='file' name='upd_resume' id='resumefile<?php echo $row1["student_id"];?>'>
                                        <button type='submit' id='upl_resume' class='editresume btn btn-xs btn-success' value='Upload Resume' >Upload&nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
                        </button>
                        </form>
                        </td>
                        <?php

                    } 

                else{
                    
                    ?>
                    
                    
                    
                    
                <?php
                }
                ?>


                  

                        <?php
                         if( $status!='uploaded'){
                            ?>
                            <td><input class="form-control" id="hr_comment<?php echo $ssid;?>" required></td>
                          
                        <?php
                        }
                        ?>


                    <?php 

                    if(!isset($_SESSION['emailvendors'])){
                        ?>
                        <td>
                        <select class="form-control">
                            <option value="l1">L1</option>
                            <option value="l2">L2</option>
                            <option value="l3">L3</option>

                        </select>
                        
                        </td>
                    <td style="border-right: 1px solid #E7E7E7;">
                        <select id="updatenotebtn<?php echo $ssid;?>" class="form-control">
                            <option value="Shared"  <?php if ( $status== 'Shared')  echo 'selected = "selected"'; ?>   >Shared</option>
                            <option value="hold" <?php if (   $status== 'hold')  echo 'selected = "selected"'; ?>>Hold</option>
                            <option value="Offered" <?php if (   $status== 'Offered')  echo 'selected = "selected"'; ?>>Offered</option>
                            <option value="shortlist"<?php if($status== 'shortlist')  echo 'selected = "selected"'; ?> >Shortlist</option>
                            <option value="rejected"<?php if ($status== 'rejected')  echo 'selected = "selected"'; ?> >Close</option>
                            <!-- <option value="blacklist"<?php if ($status == 'blacklist')  echo 'selected = "selected"'; ?>>Blacklist</option> -->
                        </select>
                    </td>
                    <?php
                    }


                    else{
                        ?>
                          <td style="border-right: 1px solid black;">
                        <select id="updatenotebtn<?php echo $ssid;?>" class="form-control">
                            <option value="shortlist"<?php if($status== 'shortlist')  echo 'selected = "selected"'; ?> >Shortlist</option>

                            <option value="rejected"<?php if ($status== 'rejected')  echo 'selected = "selected"'; ?> >Backed out</option>
                        </select>
                    </td>
                        <?php
                    }
                    ?>
                   
                
                </tr>
                <?php if($status=='new_arrival'){
?>
                         <tr>
                                <td>
                            <table class="table table-condensed">

                            <?php

                                $sqlcomp = "SELECT * FROM Student where stud_name='$sname' and student_id!='$studids[$x]' ORDER BY updated_on DESC";
                                $resultcomp = $db->query($sqlcomp);
// var_dump($resultcomp);
                                if ($resultcomp ->num_rows >0) {
                                
                                    while($rowcomp = $resultcomp->fetch_assoc()) {

            $duplinks='http://talentchords.com/jobs/specialty/uploads/'.$rowcomp['student_id'].'/'.$rowcomp['resume'];

?>
                                <tr>
                                <td><input type="checkbox" class="studentcheckbox1comp" value="<?php echo $rowcomp['student_id'];?>" name="chkcomp"></td></td>
                                <td><?php echo $rowcomp['stud_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $rowcomp['email'];?></td>

                                <td><a href='<?php echo $duplinks;?>' target='blank'>View</a></td>
                                <tr>
                               
                                <?php
                                    }
                                }

                            ?>
                              
                            </table>
                            </td>
                </tr>
                <?php

                }else{

                }
                ?>
               
                <?php
                // $number++;
            // }
            }}
            // $users .= '</table>';

        }
            else{
           ?>         
       <div>
        <!-- <p>No Candidate(s) found! </p> -->

        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>

        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr style="height:45px">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>

      
        </div>
<?php
            }
    }

    ?>

    </tbody>
    </table>
    </div>


    <!-- ---------extra info div here------------------------------- -->

<div class="col-md-4">


  <div class="contains_resume" style="text-align:center">

                            <label><input type="radio" class="uncheck" name="colorRadio" value="red"> Micro CV</label>
                            <label><input type="radio" name="colorRadio" class="uncheck" value="green">Interaction History</label>
                           
                           
                            <div class="red box" style="display:none;text-align: justify;">
                          
                            </div>
                           
                           
                            <div class="green box"style="display:none;"\>
                            
                                            <button type="button" class="btn btn-xs btn-info" data-toggle="collapse" data-target="#showthisjob">Show less</button>
                                                <div id="showthisjob" class="collapse">
                                                </div>

                                                <?php if($_GET['status']=="Shared"){
                                                    ?>
<button type="button" class="btn btn-xs btn-info" data-toggle="collapse" data-target="#showthiscompany">Show Full</button>
                                                <div id="showthiscompany" class="collapse">
                                                </div>

                                                    <?php

                                                }
                                                ?>
                                            
                            
                            </div>

                    
                    </div>


                    <div class="contains_text" style="text-align:center;padding: 20px;"><p>Nothing to be displayed.</p>
<p>Please hover on candidate's name to view details</p>
</div>

</div>




    <!-- -------------------------------------------------------------- -->
<br>
    <br>
      <!-- ---------------save button -->
            <br>
            <br>
    </div>
   
  </div>
            <!-- -------------------------------------- -->

        </div>
       
</div><!-- tab content -->
</div>
</div>





<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">This Job Feedbacks</h4>
      </div>
      <div class="modal-body thisjob">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>






<script>
$('#example tr').hover(function() {
    console.log("hi");

    var id=$(this).attr("data-id");
   
    $('.contains_text').addClass('hide');

    // $(this).removeClass('hover');
    getminicv(id);
    showlastjob(id);
    showthisjob(id);
    $("input:radio[class=uncheck]:first").attr('checked', true).trigger("click");


}, function() {

    var id=$(this).attr("data-id");
    

});


$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});


  function setstatus(status){
        var uri = window.location.toString();
                                if (uri.indexOf("&") > 0) {
                                    var clean_uri = uri.substring(0, uri.indexOf("&"));
                                    window.history.replaceState({}, document.title, clean_uri);
                                }
            location.replace(window.location.href+'&status='+status);

    }


  function app_handle_listing_horisontal_scroll(listing_obj) {
        //get table object   
        table_obj = $('.table', listing_obj);
       
        count_fixed_collumns = table_obj.attr('data-count-fixed-columns')

        if (count_fixed_collumns > 0) {
            //get wrapper object
            wrapper_obj = $('.table-scrollable', listing_obj);

            wrapper_left_margin = 0;

            table_collumns_width = new Array();
            table_collumns_margin = new Array();

            //calculate wrapper margin and fixed column width
            $('th', table_obj).each(function(index) {
                if (index < count_fixed_collumns) {
                    wrapper_left_margin += $(this).outerWidth();
                    table_collumns_width[index] = $(this).outerWidth();
                }
            })

            //calcualte margin for each column  
            $.each(table_collumns_width, function(key, value) {
                if (key == 0) {
                    table_collumns_margin[key] = wrapper_left_margin;
                } else {
                    next_margin = 0;
                    $.each(table_collumns_width, function(key_next, value_next) {
                        if (key_next < key) {
                            next_margin += value_next;
                        }
                    });

                    table_collumns_margin[key] = wrapper_left_margin - next_margin;
                }
            });

            //set wrapper margin               
            if (wrapper_left_margin > 0) {
                wrapper_obj.css('cssText', 'margin-left:' + wrapper_left_margin + 'px !important; width: auto')
            }

            //set position for fixed columns
            $('tr', table_obj).each(function() {

                //get current row height
                current_row_height = $(this).outerHeight();

                $('th,td', $(this)).each(function(index) {

                    //set row height for all cells
                    $(this).css('height', current_row_height)

                    //set position 
                    if (index < count_fixed_collumns) {
                        $(this).css('position', 'absolute')
                            .css('margin-left', '-' + table_collumns_margin[index] + 'px')
                            .css('width', table_collumns_width[index])

                        $(this).addClass('table-fixed-cell')
                    }
                })
            })

            if(table_obj[1]){

              $('tr', table_obj[1]).each(function() {

                //get current row height
                current_row_height = $(this).outerHeight();

                $('th,td', $(this)).each(function(index) {

                    //set row height for all cells
                    $(this).css('height', 0)

                    //set position 
                    if (index < count_fixed_collumns) {
                        $(this).css("all","unset")

                        $(this).removeClass('table-fixed-cell')
                    }
                })
            })
            }

        }
    }


     function showlastjob(id){
        //  alert(id);
          $.ajax({
                                url: '../thiscompanystats.php',
                                type: 'POST',
                            
                                data: {param1: id,param2:'<?php echo $hrcompany;?>'},
                            })
                            .done(function(response) {
                                // console.log(response);
                                data=JSON.parse(response)
                             
                                // data=response;
                                console.log(data);
                                // console.log(data.length);

                                var html = "<table border='1|1'class='table table-striped'>";
                                for (var i = 0; i < data.length; i++) {
                                    // console.log(data[i]);
                                     var cname=data[i][0];
                        // console.log(cname);
                                        for(var j=0;j<data[i].length;j++){
                                                if(data[i][j]){
                                                    // console.log(data[i][j].length);
                       
                                                             var res = data[i][j];
                                                             console.log(res);
                                                            for(k=0;k<res.length;k++){
                                                                if(res[k]){
                                                                console.log(res[k]);

                                                                }
                                                                var line = res[k].split("$");
                                                                // console.log(line);
                                                                if(line[1] && line[0] && line[2]){
                                                                          html+="<tr>";
                                                                        html+="<td>"+cname+"</td>";

                                                                        html+="<td>"+line[1]+"</td>";
                                                                        html+="<td>"+line[0]+"</td>";
                                                                        html+="<td>"+line[2]+"</td>";
                                                                        html+="</tr>";
                                                                }
                                                              

                                                            }
                                                           
                                                 }

                                        }
                                }
                                html+="</table>";

                                $('#showthiscompany').html(html);
                                
                            })
                            .fail(function() {
                                alert("error while fetching stats");
                            });
     }

     function showthisjob(id){
        //  ajax request to fetch job stats
                            $.ajax({
                                url: '../thisjobstats.php',
                                type: 'POST',
                            
                                data: {param1: id,param2:<?php echo $_GET['jid'];?>},
                            })
                            .done(function(response) {
                                data=JSON.parse(response)
                                console.log(data);

                                var html = "<table border='1|1'class='table table-striped'>";
                                for (var i = 0; i < data.length; i++) {
                                    if(data[i]){
                                        for(var j=0;j<data[i].length;j++){
                                            var res = data[i][j].split("$");
                                            if(res[0]&&res[1]&&res[2]){
                                                html+="<tr>";
                                                html+="<td>"+res[1]+"</td>";
                                                html+="<td>"+res[0]+"</td>";
                                                html+="<td>"+res[2]+"</td>";
                                                html+="</tr>";
                                            }
                                         
                                        }

                                    }


                                }
                                html+="</table>";
                               
                                $('#showthisjob').html(html);

                            })
                            .fail(function() {
                                alert("error while fetching stats");
                            });
     }


   function getminicv(id){
        //  ajax request to fetch job stats
                            $.ajax({
                                url: '../getminicv.php',
                                type: 'POST',
                            
                                data: {param1: id},
                            })
                            .done(function(response) {
                                data=JSON.parse(response);
                                console.log(data,data.length);

                                var html = "<table border='1|1'class='table'>";
                                
                                        var headers=["Email","Contact","Curr Company","Designation","Curr CTC","Expected CTC","Notice Period"];
                                             
                                        for(var j=0;j<data.length;j++){
                                              
                                                html+="<tr>";
                                                html+="<td>"+headers[j]+"</td>";
                                                html+="<td>"+data[j]+"</td>";
                                              
                                                html+="</tr>";
                                            }
                                         
                                    //     }

                                    // }


                                // }
                                html+="</table>";
                               
                                $('.red').html(html);

                            })
                            .fail(function() {
                                console.log("fsile");
                                alert("error while fetching stats");
                            });
     }


          function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            
            for (var i = 1; i < rows.length; i++) {

                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                // for (var j = 0; j < cols.length; j++) 
                    // row.push(cols[j].innerText);
                console.log(cols[0].children[0].defaultValue);
                
                csv.push(cols[0].children[0].defaultValue);  
                console.log(csv);      
            }

              $.ajax({
                    url: "../set_session.php",
                    type:'post',
                    data: { role: csv }
                }).done(function(response) {
        window.location.href = "http://<?php  echo $_SERVER['SERVER_NAME']; ?>/jobs/site/exportshortliststud.php";
                               
                            })
                            .fail(function() {
                                alert("error in exporting");
                            });


            // Download CSV file
            // downloadCSV(csv.join("\n"), filename);
        }

    $(function() {
        // app_handle_listing_horisontal_scroll($('#home'))
    })
</script>