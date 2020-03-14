<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
$stud_id=$_POST['param2'];
$statusMsg='';
// check if job already offered
$prevQuery = "SELECT * FROM applied_table_linkedin WHERE posting_id = '$posting_id' and student_id='$stud_id'";
$prevResult = $db->query($prevQuery);
if($prevResult->num_rows ==1){

    // job already offered ignore 
    $statusMsg="This candidate is already offered this job";
}
else{
        // Insert  name into database
        $insert = $db->query("INSERT into applied_table_linkedin (posting_id,student_id,applied_at,Status,Note,Status_update) VALUES ('".$posting_id."','".$stud_id."',NOW(),'Offer','applied',NOW())");
        if($insert){
            $statusMsg = "Shortlisted";
        }else{
            $statusMsg = "Error in shorlisting";
        } 
}
  echo $statusMsg;
?>