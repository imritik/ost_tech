<?php 
session_start();
include '../dbConfig.php';
// $posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$prevQuery = "SELECT * FROM applied_table WHERE student_id='$stud_id' and Status!='has_applied' ORDER BY Status_update DESC LIMIT 1";
$prevResult = $db->query($prevQuery);
$reponse=array();
$row = $prevResult->fetch_assoc();
$reponse=$row;
// var_dump(json_encode(array($row['Status'],$row['Note'],$row['Status_update'])));
echo json_encode($reponse);
?>