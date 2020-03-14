<?php 
session_start();
include '../../dbConfig.php';
if(isset($_SESSION['emaildl'])){
    // echo $_SESSION['company'];
    // echo "hi";
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
$stud_id=$_POST['param1'];
  // Insert image file name into database
  $insert = $db->query("UPDATE Linkedin SET is_authorised=1 where student_id=$stud_id");
  if($insert){
      $statusMsg = "Authorized!";
  }else{
      $statusMsg = "Error while updating";
  } 
  echo $statusMsg;
?>