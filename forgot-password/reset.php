<?php
//file reset.php
//title:Build your own Forgot Password PHP Script
session_start();
$token=$_GET['token'];
// include("settings.php");
include '../dbConfig.php';

if(!isset($_POST['password'])){
$q="select email from tokens where token='".$token."' and used=0";
$r=$db->query($q);
// var_dump($q,$r);
while($row=$r->fetch_assoc())
   {
$email=$row['email'];
   }
If ($email!=''){
        //   $_SESSION['email']=$email;
}

else die("Invalid link or Password already changed");}
// var_dump($email);
$pass=$_POST['password'];
$email=$_SESSION['email'];
if(!isset($pass)){
echo '<form method="post">
enter your new password:<input type="password" name="password" />
<input type="submit" value="Change Password">
</form>
';}
if(isset($_POST['password']))
{
$q="update admins set password='".$pass."' where email='".$email."'";
$r=$db->query($q);
if($r)$db->query("update tokens set used=1 where token='".$token."'");
var_dump($q);
echo "Your password is changed successfully";
if(!$r)echo "An error occurred";
}