<?php 
session_start();
include '../dbConfig.php';
$pid=$_POST['param2'];

$list=array();
  // Insert image file name into database
// List Users

if(sizeof($pid)){
$arrlen=count($pid);
// echo $arrlen;
$list=array();
$applied=array();
$status=array();
$note=array();
$updatedon=array();

for($x=0;$x<$arrlen;$x++){


$query = "SELECT * FROM applied_table where posting_id='$pid[$x]' and Status!='Offer'";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}
 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($list,$row['student_id']);
        array_push($applied,$row['applied_at']);
        array_push($status,$row['Status']);
        array_push($note,$row['Note']);
        array_push($updatedon,$row['Status_update']);
       
    } 
}

}
echo json_encode(array("list"=>$list,"applied"=>$applied,"Note"=>$note,"Status"=>$status,"updatedon"=>$updatedon));

}
else{

}



?>