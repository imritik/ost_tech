<?php 
session_start();
include '../dbConfig.php';
$stud_ids=$_POST['param2'];
$admin_email=$_POST['param1'];
$sent_email=$_POST['param4'];
$jobidsent=$_POST['param3'];

$data1=json_decode(stripslashes($stud_ids));
if(sizeof($data1)){
    $arrlen=count($data1);
    // echo $arrlen;
    // echo $studlistobtain[1];
        for($x=0;$x<$arrlen;$x++){
 // Insert image file name into database
 $insert = $db->query("UPDATE Student SET is_authorised=0,Uploaded_by='$admin_email' where student_id=$data1[$x]");
 if($insert){
     $statusMsg = "Unauthorized!";
 }else{
     $statusMsg = "Error while updating";
 }
}
} 

  // Insert image file name into database
  $insert = $db->query("INSERT into to_admin (job_id_ref,stud_id,recieved_email,sent_email,sent_on) values('$jobidsent','$stud_ids','$admin_email','$sent_email',NOW())");
  if($insert){
      $statusMsg = "Status updated";
  }else{
      $statusMsg = "Error in sending";
  } 

  echo $statusMsg;
?>