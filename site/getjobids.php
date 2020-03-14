<?php 
session_start();
include '../dbConfig.php';
$cname=$_POST['param1'];

$list=array();
$jobtitle=array();
  // Insert image file name into database
// List Users
$query = "SELECT * FROM Job_Posting where company_name='$cname'";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}
 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($list,$row['posting_id']);
        array_push($jobtitle,$row['job_title']);
       
    } 
    echo json_encode(array("list"=>$list,"job_title"=>$jobtitle));
}
else{
    array_push($list,"No jobs");
    echo json_encode($list);
}

?>