<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];

  // Insert image file name into database
  $insert = $db->query("UPDATE applied_table SET Status='Rejected',Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
  if($insert){
      $statusMsg = "Status updated";
  }else{
      $statusMsg = "Error in rejecting";
  } 

  echo $statusMsg;
?>