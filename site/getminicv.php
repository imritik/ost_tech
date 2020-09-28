<?php 
session_start();
include '../dbConfig.php';
// $posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$prevQuery = "SELECT * FROM Student WHERE student_id='$stud_id'";
$prevResult = $db->query($prevQuery);
$reponse=array();
$row = $prevResult->fetch_assoc();
$reponse=$row;
echo(json_encode(array($row['email'],$row['contact'],$row['curr_company'],$row['designation'],$row['curr_ctc'],$row['expected_ctc'],$row['notice_period'])));
// echo json_encode($reponse);
?>