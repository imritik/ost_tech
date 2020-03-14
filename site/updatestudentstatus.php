<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$stud_status=$_POST['param3'];
$stud_note=$_POST['param4'];
  // Insert image file name into database
  $insert = $db->query("UPDATE applied_table SET Status='$stud_status',Note='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
  if($insert){
      $statusMsg = "Status updated";
  }else{
      $statusMsg = "Error while updating";
  } 

  echo $statusMsg;
?>