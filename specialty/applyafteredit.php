<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
$stud_id=$_POST['param2'];
// echo $posting_id,$stud_id;

 $insert1 = $db->query("UPDATE Student SET latest_application_date=NOW() where student_id='$stud_id'");
 if($insert1){
     $statusMsg = "Unauthorized!";
 }else{
     $statusMsg = "Error while updating";
 }
  $insert = $db->query("UPDATE applied_table SET Status='has_applied', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
  if($insert){
      $statusMsg1 = "Applied";
  }else{
      $statusMsg1 = "Error while applying";
  } 
  echo $statusMsg1;
?>