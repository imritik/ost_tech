<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
// echo $posting_id;
// $stud_id=$_POST['param2'];

  // Insert image file name into database
  $insert = $db->query("DELETE FROM employer_account WHERE email='$posting_id' ");
  if($insert){
      $statusMsg = "Company(s) deleted";
  }else{
      $statusMsg = "Error while deleting";
  } 

  echo $statusMsg;
?>