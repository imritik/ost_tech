<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
$stud_id=$_POST['param2'];

  // Insert image file name into database
  $insert = $db->query("INSERT into Offer_table (posting_id,student_id,offer_time) VALUES ('".$posting_id."','".$stud_id."',NOW())");
  if($insert){
      $statusMsg = "Shortlisted";
  }else{
      $statusMsg = "Error in shorlisting";
  } 

  echo $statusMsg;
?>