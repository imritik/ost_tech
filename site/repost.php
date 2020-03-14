<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
// $stud_id=$_POST['param2'];

  // Insert image file name into database
  $insert = $db->query("UPDATE Job_Posting SET posting_time=NOW() WHERE posting_id='$posting_id' ");
  if($insert){
      $statusMsg = "Status updated";
  }else{
      $statusMsg = "Error while reposting";
  } 

  echo $statusMsg;
?>