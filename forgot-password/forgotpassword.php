<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title>Reset Password - TalentChords</title>
    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Main Stylesheet -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->

    <!-- -----multiselect part-- -->
   
   <!-- -------candidates css -->

   
</head>
<?php
//file name: forgotpassword.php
//Title:Build your own Forgot Password PHP Script
$forgot_by=$_GET['fp'];

if(!isset($_GET['email'])){
	                  echo'<div class="container col-md-6 col-md-offset-3" style="margin-top:5%;text-align:center"><form action="forgotpassword.php?">
	                      Enter Your Email Id:
							 <input type="text" class="form-control" name="email" />
							 <input type="hidden" class="form-control" name="fp" value="'.$forgot_by.'" />
							 <br>
	                        <input type="submit" class="btn btn-primary" value="Reset My Password" />
	                         </form></div>'; exit();
				       }
$email=$_GET['email'];
$reset_for='';
// include("settings.php");
// var_dump($email);
include '../dbConfig.php';

// connect();
$q='';
if($forgot_by=='empchords'){
$q="select email from admins where email='".$email."'";
$reset_for='empchords';

}
else if($forgot_by=='canchords'){
$q="select email from Student where email='".$email."'";
$reset_for='canchords';

}
// var_dump($reset_for);
$r=$db->query($q);
$n=$r->num_rows;
// var_dump($n);
if($n==0){echo "Email id is not registered";die();}
$token=getRandomString(10);
$q="insert into tokens (token,email) values ('".$token."','".$email."')";
$db->query($q);
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
 function mailresetlink($to,$token,$reset_for){
	//  var_dump($reset_for);
$subject = "Forgot Password ";
$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
$message = '
<html>
<head>
<title>Forgot Password</title>
</head>
<body>
<p>Click on the given link to reset your password <a href="'.$uri.'/jobs/forgot-password/reset.php?token='.$token.'&fp='.$reset_for.'">Reset Password</a></p>
 
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
	//  var_dump($reset_for);

 
if(isset($_GET['email']))mailresetlink($email,$token,$reset_for);