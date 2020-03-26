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
$oldemail='';
// var_dump($_POST['data']['name']);
 // Check whether member already exists in the database with the same email

//  gather old email from id
$getEmail="SELECT * FROM admins WHERE id=$id";
// var_dump($getEmail);
 $result = $db->query($getEmail);
            if ($result ->num_rows ==1 ) {               
                while($row1 = $result->fetch_assoc()) {
                        $oldemail=$row1['email'];
                        var_dump($row1['email']);
                }
            }

// -----------------------------------

if($oldemail!=$email){
    // update email in other tables
     $db->query("UPDATE to_admin SET recieved_email = replace(recieved_email, '$oldemail', '$email')");

}

 $prevQuery = "SELECT * FROM admins WHERE id = '$id' or email='$email'";
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
     // Update member data in the database
     $db->query("UPDATE admins SET Full_name = '$name', email = '$email', password = '$password', role = '$role' WHERE id = '$id'");
    //  $db->query("UPDATE to_admin SET ")
    //  echo "Updated";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO admins (Full_name,email,password,role) VALUES ('$name','$email','$password','$role')");
    // echo "Inserted";
    }

?>