<?php 
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$email=$_POST['param1'];
$newpass=$_POST['param2'];
$sql = "UPDATE IGNORE admins SET password='$newpass' WHERE email='$email'";
if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $db->error;
}
?>
