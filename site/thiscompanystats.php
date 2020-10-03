<?php 
session_start();
include '../dbConfig.php';
// $posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$cemail=$_POST['param2'];
$jobids=array();
$response=array();
$jobtitle=array();
$getids="SELECT * FROM Job_Posting where email='$cemail'";
// var_dump($getids);
$result = $db->query($getids);
if ($result ->num_rows >0) {
   
    while($row1 = $result->fetch_assoc()) {
        array_push($jobids,$row1['posting_id']);
        array_push($jobtitle,$row1['job_title']);
    }
}
// var_dump($jobids);
for($i=0;$i<count($jobids);$i++){
$prevQuery = "SELECT * FROM interaction_log WHERE stud_id='$stud_id' and posting_id='$jobids[$i]'";
// var_dump($prevQuery);
$prevResult = $db->query($prevQuery);
$row = $prevResult->fetch_assoc();
// $reponse=$row;
// var_dump($response);
array_push($response,array([$jobtitle[$i]],unserialize($row['hr']),unserialize($row['vendor']),unserialize($row['manager']),unserialize($row['coordinator']),unserialize($row['am']),unserialize($row['recruiter'])));
}

// echo(json_encode(array(unserialize($row['hr']),unserialize($row['vendor']),unserialize($row['manager']),unserialize($row['coordinator']),unserialize($row['am']))));
echo json_encode($response);
?>