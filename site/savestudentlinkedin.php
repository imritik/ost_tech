<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emaildl'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
// $cname=$_SESSION['company'];
include '../dbConfig.php';

?>
<?php 
$name=$_POST['data']['name'];
$email=$_POST['data']['email'];
$contact=$_POST['data']['contact'];
$college=$_POST['data']['college'];
$college_loc=$_POST['data']['college_loc'];
$student_id=$_POST['data']['student_id'];


// var_dump($_POST['data']['name']);
 // Check whether member already exists in the database with the same email
 $prevQuery = "SELECT * FROM Linkedin WHERE student_id = '$student_id'";
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
     // Update member data in the database
     $db->query("UPDATE Linkedin SET stud_name = '$name', email = '$email', college_name = '$college',college_location = '$college_loc', contact = '$contact' WHERE student_id = '$student_id'");
     echo "Updated";
 }else{
   echo "unable to update";
    }

?>