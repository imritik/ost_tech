<style>
    /* #table-listing {
        width: 300px;
    }
    
    .table-scrollable {
        width: auto;
        overflow-x: auto;
        overflow-y: hidden;
        border: 1px solid #dddddd;
        margin: 10px 0;
    }
    
    .table th {
        white-space: nowrap;
    }
    
    .table td {
        vertical-align: top;
        border-bottom: 1px solid #ddd;
        padding: 2px 5px;
    } */
</style>



<?php
if(!empty($_GET['jid'])){
    $jid=$_GET['jid'];
    ?>

    <script>
   $('#'+<?php echo $jid;?>).addClass('active');    
    </script>
    <?php
// ------collect all jobs of company here
                    $sql22="SELECT * FROM Job_Posting WHERE posting_id='$jid'";
                    $result22 = $db->query($sql22);
                    if ($result22 ->num_rows > 0) {
                        while($row22 = $result22->fetch_assoc()) {
                            $postid=$row22['posting_id'];
                            $jobtitle=$row22['job_title'];
                            $cname=$row22['company_name'];
                            $currentCompEmail=$row22['email'];
                            if(isset($_SESSION['emailhr'])){
echo '<div><p style="font-size:x-large;margin-bottom:0">'.$jobtitle.'</p>
                    <button class="btn btn-info btn-sm"><a href="editjob.php?jid='.$postid.'" style="color:white">Edit</a></button>
                    <button class="btn btn-danger btn-sm" onclick="deletejobpart(\''.$postid.'\');">Delete</button>
                    <button class="btn btn-info btn-sm" onclick="repostpart(\''.$postid.'\');">Repost</button>
                    <button id="combine"class="btn btn-primary btn-sm" style="display:none;float: right;" onclick="combine();">Same and Combine</button>
                    </div>
                    <br>
                    ';
                            }
                            else{
 echo '<div><p style="font-size:x-large;margin-bottom:0">'.$jobtitle.'</p>
                            </div><br>
                    ';
                            }
                   
                            }
                    }
                    else{
                        echo '<p style="font-size:x-large">Invalid Job</p>';
                    }
                // }
                ?>







                <?php 

if(isset($_SESSION['emailvendors'])){

    ?>
    <div class="col-md-12" style="text-align:center">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Add candidates</a>
                    </div>
                </div>
                <!-- CSV file upload form -->
                <div class="" id="importFrm" style="display: none;text-align: -webkit-center;">
                <br>
                    <form action="../csv_v2/importData_vendor.php?jid=<?php echo $jid;?>" method="post" enctype="multipart/form-data">
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
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Add candidates</a>
        </div>
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>

    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="../csv_v2/importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
        <br>
    </div>


    <?php

}
                ?>
    
    <br>
    <br>





<ul class="nav nav-tabs">
 <?php
    if(isset($_SESSION['emailvendors'])){

?>
    <li class='uploaded'><a  onclick="setstatus('uploaded')">Upload CV&nbsp;<span></span></a></li>
<?php
    }
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
    <li class='hold'><a  onclick="setstatus('hold')">Hold&nbsp;<span></span></a></li>
    <?php
    }
    ?>
    <li class='shortlist'><a  onclick="setstatus('shortlist')">Under Discussion&nbsp;<span></span></a></li>

    <!-- <li class='processed'><a  onclick="setstatus('processed')">Processed&nbsp;<span></span></a></li> -->
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
    <div id="home" class="tab-pane fade in active" >
       <!-- <div class="table-scrollable form-group tobehidden" style="transform: rotateX(180deg);overflow-x:auto"> -->
       <div class="table-scrollable form-group tobehidden"style="transform: rotateX(180deg);overflow-x:auto;" > 

      <!-- <table id="example" class="table table-striped table-condensed" style="transform: rotateX(180deg);" data-count-fixed-columns="2" cellpadding="0" cellspacing="0"> -->
      <table id="example" class="table table-striped table-condensed" style="transform: rotateX(180deg);" data-count-fixed-columns="2" cellpadding="0" cellspacing="0">

      <thead class="header">
<tr class="filters" style="background: white">

    <th style="color:black;display:flex;"><input type="checkbox" id="selectall">Select  </th>
    <th><input type="text" class="form-control width-auto" placeholder="Name"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Email"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Contact"></th>
   
    <th><input type="text" class="form-control width-auto" placeholder="Current CTC"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Expected CTC"></th>
   
    <th><input type="text" class="form-control width-auto" placeholder="Notice period"></th>
    <th>Resume</th>
      
    <!-- <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="HR comment" readonly></th>
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Manager comment" readonly></th>
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Recruiter comment" readonly></th> -->
   <?php if(isset($_SESSION['emailvendors'])&& $_GET['status']=='uploaded'){
        ?>
        
        <?php
        }
        else{
            ?>
            <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Last comment" readonly></th>
        
            <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Your comment*" readonly></th>
            <th>History</th>
            <?php
        }

   ?>

   
    
    <th ><input type="text" class="form-control width-auto" style="background:white;" placeholder="Status" readonly></th>
 
   
   
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
$vendoremail=$_SESSION['emailvendors'];

        if(isset($_SESSION['emailvendors'])){


                if($status=='uploaded'){
                    $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND Student.Uploaded_by='$vendoremail' and Student.resume='' and(applied_table.Status='shortlist' or applied_table.duplicate_status='probable')";
                }
                else{

                // $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='Shared'";
                    $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND Student.Uploaded_by='$vendoremail'and Student.resume!='' and applied_table.Status='$status'";
                }


        }
        else{

                    if($status=='new_arrival'){
                            $query = "SELECT * FROM applied_table where posting_id='$jid' and duplicate_status='probable'";

                    }

                    else if($status=='to_process'){
                            $query = "SELECT * FROM applied_table where posting_id='$jid' and Status ='$status' ORDER BY Status_update DESC";

                    }

                    else if($status=='shortlist'){
                    
                            $query="SELECT Student.*, applied_table.* FROM Student INNER JOIN applied_table ON Student.student_id = applied_table.student_id AND applied_table.posting_id='$jid' AND applied_table.Status NOT IN('rejected','hold','Shared','processed','Offered') and Student.resume!='' ORDER BY applied_table.Status_update DESC";
                        

                        // $query = "SELECT * FROM applied_table where posting_id='$jid' and Status NOT IN('rejected','hold','Shared','processed','Offered') ORDER BY Status_update DESC";

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
                <tr>
                <td>
                <?php

                if($status=='new_arrival'){

                }
                else{
                    ?>
                <input type="checkbox" class="studentcheckbox1" value="<?php echo $ssid;?>" name="chk" disabled></td>
<?php
                }
                ?>
              
                    <td class="headcol">
                    <?php echo $row1['stud_name'];?>
                    <!-- &nbsp;&nbsp;<a id="<?php echo $ssid;?>"data-toggle="tooltip" title="" onclick="showlastjob(this.id)"><i class="fa fa-info-circle"></i></a> -->
                    <?php
                         if(!isset($_SESSION['emailvendors'])){
                            ?>
                    &nbsp;&nbsp;<a id="<?php echo $ssid;?>"type="button" onclick="showlastjob(this.id)"><i class="fa fa-info-circle"></i></a>
                   
                   <?php
                         }
                         ?>
                   </td>
                    <td><?php echo $row1['email'];?></td>
                    <td><?php echo $row1['contact'];?></td>

                    <td><?php echo $row1['curr_ctc'];?></td>
                    <td><?php echo $row1['expected_ctc'];?></td>
                    <td><?php echo $row1['notice_period']?></td>
                              <!-- Add resume -->
                              
                    <td>
                    <?php if($status=='uploaded'){
                        ?>
                        <form id="<?php echo $row1["student_id"];?>" tag='<?php echo $row1["resume"];?>' class='form_resume' enctype="multipart/form-data" resumeid='<?php echo $row1["student_id"];?>'>
                                        <input type='file' name='upd_resume' id='resumefile<?php echo $row1["student_id"];?>'>
                                        <button type='submit' id='upl_resume' class='editresume btn btn-xs btn-success' value='Upload Resume' >Upload&nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
                        </button>
                        </form>
                        <?php

                    } 

                else{
                    
                    ?>
                    
                    
                    <a href='<?php echo $resumelinks;?>' target='blank'>View</a>
                    
                    
                    </td>
                <?php
                }
                ?>


                    <?php
                        if(isset($_SESSION['emailhr'])){
                            ?>
                            <td><?php echo $hrcomment[$x];?></td>
                        <?php
                        }
                        ?>


                        <?php
                         if(isset($_SESSION['emailmanager'])){
                            ?>
                            <td><?php echo $managercomment[$x];?></td>
                        <?php
                        }
                        ?>
                        <?php
                         if(isset($_SESSION['ccemp'])){
                            ?>
                            <td><?php echo $coordinatorcomment[$x];?></td>
                        <?php
                        }
                        ?>
                        
                        <?php
                         if(isset($_SESSION['coordinatoremp'])){
                            ?>
                            <td><?php echo $amcomment[$x];?></td>
                        <?php
                        }
                        ?>
                          <?php
                         if(isset($_SESSION['emailvendors'])&&$status!='uploaded'){
                            ?>
                            <td><?php echo $vendorcomment[$x];?></td>

                        <?php
                        }
                        ?>


                        <?php
                         if( $status!='uploaded'){
                            ?>
                            <td><input class="form-control" id="hr_comment<?php echo $ssid;?>" required></td>
                            <td>
                            &nbsp;&nbsp;<a id="<?php echo $ssid;?>" type="button" onclick="showthisjob(this.id)"><i class="fa fa-eye"></i></a>
                            
                            </td>
                        <?php
                        }
                        ?>


                    <?php 

                    if(!isset($_SESSION['emailvendors'])){
                        ?>
                    <td>
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
                          <td>
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
       <div style="transform:rotateX(180deg)" >
        <p>No Candidate(s) found! </p>
        </div>
<?php
            }
    }


    ?>

    </tbody>
    </table>




    </div>
<br>
    <br>
      <div style="float:right;">
      <?php
      if(!empty($_GET['jid'])){
          ?>
                <button class="btn btn-primary" onclick="saveStatus()">Save</button>
                <?php 
      }
      ?>
            </div>
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
  function app_handle_listing_horisontal_scroll(listing_obj) {
        //get table object   
        table_obj = $('.table', listing_obj);
        // table_obj=table_obj[0];
        //get count fixed collumns params
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

    $(function() {
        // app_handle_listing_horisontal_scroll($('#home'))
    })
</script>