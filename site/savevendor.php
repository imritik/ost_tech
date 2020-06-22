<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailhr'])){
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
// $role=$_POST['data']['role'];
$contact=$_POST['data']['contact'];
// $companies=$_POST['data']['company'];
$id=$_POST['data']['id'];
$oldemail='';



 $prevQuery = "SELECT * FROM vendors WHERE id = $id";
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
     // Update member data in the database
     $db->query("UPDATE IGNORE vendors SET name = '$name', email = '$email', password = '$password', contact='$contact' WHERE id = $id");
    //  $db->query("UPDATE to_admin SET ")
     echo "Updated";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO vendors (name,email,password,contact,account_creation) VALUES ('$name','$email','$password','$contact',NOW())");
    echo "Inserted";
    }

?>