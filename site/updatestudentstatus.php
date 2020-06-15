<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$stud_status=$_POST['param3'];
$stud_note=$_POST['param4'];
$ps1=$_POST['param5'];
$ps2=$_POST['param6'];

 // Insert image file name into database
//   $insert1 = $db->query("UPDATE Student SET profile_segment='$ps1',profile_segment2='$ps2', modified_on=NOW() WHERE student_id=$stud_id");
//   if($insert1){
//       $statusMsg = "Status updated";
//   }else{
//       $statusMsg = "Error while updating";
//   } 
  // Insert image file name into database
  if($stud_status=="am"){
        $insert = $db->query("UPDATE applied_table SET Note='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
        if($insert){
            $statusMsg = "Status updated";
        }else{
            $statusMsg = "Error while updating";
        } 
  }
   if($stud_status=="hr"){
// var_dump("in hr");
        $insert = $db->query("UPDATE applied_table SET hr_note='$stud_note',Status='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
    //    var_dump("UPDATE applied_table SET hr_note='$stud_note',Status='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
        if($insert){
            $statusMsg = "Status updated";
        }else{
            $statusMsg = "Error while updating";
        } 
  }
  else{
            $insert = $db->query("UPDATE applied_table SET Status='$stud_status',Note='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
            if($insert){
                $statusMsg = "Status updated";
            }else{
                $statusMsg = "Error while updating";
            } 
  }
  

  echo $statusMsg;
?>