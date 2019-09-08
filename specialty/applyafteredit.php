<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
$stud_id=$_POST['param2'];

 
  $insert = $db->query("INSERT into applied_table (posting_id,student_id,applied_at) VALUES ('".$posting_id."','".$stud_id."',NOW())");
  if($insert){
      $statusMsg = "Applied";
  }else{
      $statusMsg = "Error while applying";
  } 

  echo $statusMsg;



?>