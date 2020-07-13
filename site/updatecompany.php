<?php
// Include the database configuration file
session_start();
include '../dbConfig.php';
// print($_FILES["file"]["name"]);
// print(isset($_FILES["companylogo"]));
// echo rand(pow(10, $digits-1), pow(10, $digits)-1);
$email=$_POST['companyemail'];
$title=$_POST['companyname'];
$cweb=$_POST['companywebsite'];
$cdes=$_POST['companydescription'];
$am=$_POST['manager'];
$pass= "pass";
$statusMsg = '';

$insert = $db->query("UPDATE employer_account SET company_name='$title', url='$cweb',description='$cdes',am='$am' where email='$email'");
            if($insert){
                // $statusMsg = "The company has been added successfully.";
                $statusMsg='?status=succcomp';

            }else{
                // $statusMsg = "upload image failed, please try again.";
                $statusMsg='?status=errcomp';

            } 

header('Location:'.$_SERVER["HTTP_REFERER"].$statusMsg);
?>