<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['coordinatoremp'])||isset($_SESSION['emailmanager'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
// $cname=$_SESSION['company'];
include '../dbConfig.php';

$coordinator_email='';

if(isset($_SESSION['emailmanager'])){
    $coordinator_email=$_SESSION['emailmanager'];
}
else if(isset($_SESSION['coordinatoremp'])){
    $coordinator_email=$_SESSION['coordinatoremp'];
}

?>
<?php 
$name=$_POST['data']['name'];
$email=$_POST['data']['email'];
$password=$_POST['data']['password'];
$role=$_POST['data']['role'];
$contact=$_POST['data']['contact'];
$companies=$_POST['data']['company'];
$managed_by=$_POST['data']['managed_by'];
$id=$_POST['data']['id'];
$oldemail='';



 $prevQuery = "SELECT * FROM admins WHERE id = $id";
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
     // Update member data in the database
    //  $db->query("UPDATE IGNORE admins SET Full_name = '$name', email = '$email', password = '$password',contact='$contact' WHERE id = $id");
    //  $db->query("UPDATE to_admin SET ")
     echo "User already found with this email!";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO admins (Full_name,email,password,company,role,contact,managed_by,added_on) VALUES ('$name','$email','$password','$companies','$role','$contact','$coordinator_email',NOW())");
    echo "Inserted";
    }

?>