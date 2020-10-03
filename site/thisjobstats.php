<?php 
session_start();
include '../dbConfig.php';
// $posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$posting_id=$_POST['param2'];
$prevQuery = "SELECT * FROM interaction_log WHERE stud_id='$stud_id' and posting_id='$posting_id'";
$prevResult = $db->query($prevQuery);
$reponse=array();
$row = $prevResult->fetch_assoc();
$reponse=$row;
echo(json_encode(array(unserialize($row['hr']),unserialize($row['vendor']),unserialize($row['manager']),unserialize($row['coordinator']),unserialize($row['am']),unserialize($row['recruiter']))));
// echo json_encode($reponse);
?>