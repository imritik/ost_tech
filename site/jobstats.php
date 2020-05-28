<?php 
session_start();
include '../dbConfig.php';
// $posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$prevQuery = "SELECT * FROM applied_table WHERE student_id='$stud_id' ORDER BY Status_update DESC LIMIT 1";
$prevResult = $db->query($prevQuery);

$row = $prevResult->fetch_assoc();
var_dump($row);
?>