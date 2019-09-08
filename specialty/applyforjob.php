<?php 
session_start();
include '../dbConfig.php';
$posting_id=$_POST['param1'];
$stud_id=$_POST['param2'];
// echo $stud_id;

  // Insert image file name into database
//   $insert = $db->query("INSERT into applied_table (posting_id,student_id,applied_at) VALUES ('".$posting_id."','".$stud_id."',NOW())");
//   if($insert){
//       $statusMsg = "Applied";
//   }else{
//       $statusMsg = "Error while applying";
//   } 

//   echo $statusMsg;


$querylocation1=$db->query("SELECT * FROM Student WHERE student_id='$stud_id'");

if($querylocation1 ->num_rows == 1){
    // $ids=array();
    while($row = $querylocation1->fetch_assoc()){
        $return_arr[] = array("curr_company" => $row['curr_company'],"curr_ctc" => $row['curr_ctc'],"experience" => $row['experience'],"resume" => $row['resume'],"last_updated" => $row['updated_on']);

    }

    echo json_encode($return_arr);
}

?>