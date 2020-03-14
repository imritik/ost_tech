<?php 
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if(isset($_SESSION['stud_id'])){
  }
  else{
    header("location: ../index.php");
  }
$stud_id=$_SESSION['stud_id'];
$oldpass=$_POST['param1'];
$newpass=$_POST['param2'];
$sql = "UPDATE Student SET pass='$newpass',first_login=1,last_activity=NOW(),modified_on=NOW() WHERE student_id=$stud_id";
if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}
?>
