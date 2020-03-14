<?php 
session_start();
include '../dbConfig.php';
$stud_email=$_POST['param2'];
$to_email = $stud_email;
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: noreply @ company . com';
if(mail($to_email,$subject,$message,$headers)){

    echo "mailed";
}
else{

    echo "failed";
}
?>