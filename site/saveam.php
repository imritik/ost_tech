<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailemp'])|| isset($_SESSION['emailhr'])){
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
// $password=$_POST['data']['password'];
$role=$_POST['data']['role'];
$contact=$_POST['data']['contact'];
$companies=$_POST['data']['company'];
$id=$_POST['data']['id'];
$oldemail='';


// ---------------------for emails--------------------------------------

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
    
$reset_for=getRandomString(10);

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
 $prevResult = $db->query($prevQuery);
 
 if($prevResult->num_rows >0){
    
     echo "User already exists!";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO admins (Full_name,email,company,role,contact,added_on) VALUES ('$name','$email','$companies','$role','$contact',NOW())");
    mailresetlink($email,$reset_for);

    }

?>