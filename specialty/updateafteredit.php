<?php 
session_start();
include '../dbConfig.php';
$c_company=$_POST['param1'];
$stud_id=$_POST['param2'];
$c_ctc=$_POST['param3'];
$c_experience=$_POST['param4'];

  // Insert image file name into database
//   $insert = $db->query("INSERT into applied_table (posting_id,student_id,applied_at) VALUES ('".$posting_id."','".$stud_id."',NOW())");
//   if($insert){
//       $statusMsg = "Applied";
//   }else{
//       $statusMsg = "Error while applying";
//   } 

//   echo $statusMsg;

$sql = "UPDATE Student SET curr_company='$c_company',curr_ctc='$c_ctc',experience='$c_experience' WHERE student_id=$stud_id";

if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}



?>
