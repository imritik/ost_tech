<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
// $stud_id=$_POST['param2'];

  // Insert image file name into database
  $insert = $db->query("UPDATE IGNORE Job_Posting SET is_closed = IF(`is_closed` = 1, 0, 1),is_hold = IF(`is_hold` = 1, 0, 1) WHERE posting_id = '$posting_id'");
  if($insert){
      $statusMsg = "Status updated";
  }else{
      $statusMsg = "Error while freezing";
  } 

  echo $statusMsg;
?>