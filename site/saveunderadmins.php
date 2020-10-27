<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['coordinatoremp'])||isset($_SESSION['emailmanager'])||isset($_SESSION['emailhr'])){
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
else if(isset($_SESSION['emailhr'])){
    //  $curr_role='hr';
    $coordinator_email=$_SESSION['emailhr'];
}
?>
<?php 
$name=$_POST['data']['name'];
$email=$_POST['data']['email'];
// $password=$_POST['data']['password'];
$role=$_POST['data']['role'];
$contact=$_POST['data']['contact'];
$companies=$_POST['data']['company'];
$managed_by=$_POST['data']['managed_by'];
// $id=$_POST['data']['id'];
$oldemail='';


// ---------------------for emails--------------------------------------

$reset_for=getRandomString(10);
// var_dump($_POST['data']['name']);
 // Check whether member already exists in the database with the same email
function getRandomString($length) 
	   {
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
	return $result;}
  function mailresetlink($to,$reset_for){
	//  var_dump($reset_for);
$subject = "Update Password ";
$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
$message = '
<html>
<head>
<title>Update Password</title>
</head>
<body>
<p>Click on the given link to update your password <a href="'.$uri.'/jobs/ChangePassword/setPassword.php?email='.$to.'&fp='.$reset_for.'">Update Password</a></p>
 
</body>
</html>
';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From:TalentChords<rupendra@talentchords.com>' . "\r\n";
// $headers .= 'Cc: Admin@tc.com' . "\r\n";
 
mail($to,$subject,$message,$headers);
echo "We have sent the password reset link to  email id ".$to.""; 

}


// -----------------------------------------------------------------------------------------------


 $prevQuery = "SELECT * FROM admins WHERE email='$email'";
//  var_dump("SELECT * FROM admins WHERE email='$email'");
 $prevResult = $db->query($prevQuery);
//  var_dump($prevResult);
 if($prevResult->num_rows >0){
     // Update member data in the database
    //  $db->query("UPDATE IGNORE admins SET Full_name = '$name', email = '$email', password = '$password',contact='$contact' WHERE id = $id");
    //  $db->query("UPDATE to_admin SET ")
     echo "User already found with this email!";
 }else{
     // Insert member data in the database
   $insert_test=$db->query("INSERT IGNORE INTO admins (Full_name,email,company,role,contact,managed_by,added_on) VALUES ('$name','$email','$companies','$role','$contact','$coordinator_email',NOW())");
    // echo "Inserted";
    // echo $insert_test;
    mailresetlink($email,$reset_for);

    }

?>