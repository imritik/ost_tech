<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailemp'])){
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
$password=$_POST['data']['password'];
$role=$_POST['data']['role'];
$id=$_POST['data']['id'];
// var_dump($_POST['data']['name']);
 // Check whether member already exists in the database with the same email
 $prevQuery = "SELECT * FROM admins WHERE id = '$id' or email='$email'";
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
     // Update member data in the database
     $db->query("UPDATE admins SET Full_name = '$name', email = '$email', password = '$password', role = '$role' WHERE id = '$id'");
     echo "Updated";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO admins (Full_name,email,password,role) VALUES ('$name','$email','$password','$role')");
    echo "Inserted";
    }

?>