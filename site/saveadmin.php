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
// $password=$_POST['data']['password'];
$role=$_POST['data']['role'];
$id=$_POST['data']['id'];
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
<p>Click on the given link to update your password <a href="'.$uri.'/jobs/ChangePassword/setPassword.php?email='.$email.'&fp='.$reset_for.'">Update Password</a></p>
 
</body>
</html>
';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From:TalentChords<rupendra@talentchords.com>' . "\r\n";
// $headers .= 'Cc: Admin@tc.com' . "\r\n";
 
mail($to,$subject,$message,$headers);
echo "We have sent the password reset link to your  email id <b>".$to."</b>"; 

}


// -----------------------------------------------------------------------------------------------


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
     $db->query("UPDATE admins SET Full_name = '$name', email = '$email',  role = '$role' WHERE id = '$id'");
    //  $db->query("UPDATE to_admin SET ")
    //  echo "Updated";
 }else{
     // Insert member data in the database
     $db->query("INSERT INTO admins (Full_name,email,role) VALUES ('$name','$email','$role')");
    // echo "Inserted";
    mailresetlink($email,$reset_for);
    }


// send mails to newly inserted emails

?>