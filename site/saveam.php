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
$contact=$_POST['data']['contact'];
$companies=$_POST['data']['company'];
$id=$_POST['data']['id'];
$oldemail='';



 $prevQuery = "SELECT * FROM coordinators WHERE id = $id";
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
     // Update member data in the database
     $db->query("UPDATE IGNORE coordinators SET name = '$name', email = '$email', password = '$password', is_manager = '$role',companies='$companies',contact='$contact' WHERE id = $id");
    //  $db->query("UPDATE to_admin SET ")
     echo "Updated";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO coordinators (name,email,password,companies,contact,is_manager,account_creation) VALUES ('$name','$email','$password','$companies','$contact','$role',NOW())");
    echo "Inserted";
    }

?>