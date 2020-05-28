<?php 
session_start();
include '../dbConfig.php';
$stud_ids=$_POST['param2'];
$admin_email=$_POST['param1'];
$sent_email=$_POST['param4'];
$jobidsent=$_POST['param3'];

  // Insert image file name into database
  $insert = $db->query("INSERT into to_admin_linkedin (job_id_ref,stud_id,recieved_email,sent_email,sent_on) values('$jobidsent','$stud_ids','$admin_email','$sent_email',NOW())");
  if($insert){
      $statusMsg = "Status updated";
  }else{
      $statusMsg = "Error in sending";
  } 

  echo $statusMsg;
?>