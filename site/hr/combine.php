<?php 
session_start();

if(isset($_SESSION['emailhr']) || isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';;
$emails=$_POST['param1'];
var_dump($emails);
$emails=implode(", ", $emails);
var_dump($emails);
 // Insert image file name into database
  $insert1 = $db->query("Select * from Student WHERE email IN ($emails) ORDER BY updated_on DESC");
//   if($insert1){
//       $statusMsg = "Status updated";
//   }else{
//       $statusMsg = "Error while updating";
//   } 
var_dump("Select * from Student WHERE email IN $emails ORDER BY updated_on DESC");
var_dump($insert1);
  // Insert image file name into database
 
            // $insert = $db->query("UPDATE applied_table SET coordinator_note='$stud_note', Status='$stud_status',Note='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
            // if($insert){
            //     $statusMsg = "Status updated";
            // }else{
            //     $statusMsg = "Error while updating";
            // } 
//   echo $emails;
?>