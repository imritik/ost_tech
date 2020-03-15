<?php 
session_start();
include '../dbConfig.php';
$adminid=$_POST['data'];
// echo $posting_id;
// $stud_id=$_POST['param2'];

  // Insert image file name into database
  $insert = $db->query("DELETE FROM admins WHERE id='$adminid' ");
  if($insert){
      $statusMsg = "Admin deleted";
  }else{
      $statusMsg = "Error while deleting";
  } 

  echo $statusMsg;
?>