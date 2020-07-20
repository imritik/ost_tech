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
// File upload path
$targetDir = "uploads/".$email."/";
 //Check if the directory already exists.
 if(!is_dir($targetDir)){
    //Directory does not exist, so lets create it.
    mkdir($targetDir, 0755, true);
}
$fileName = basename($_FILES["companylogo"]["name"]);

$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit_company"]) && !empty($_FILES["companylogo"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
      
        // Upload file to server
        if(move_uploaded_file($_FILES["companylogo"]["tmp_name"], $targetFilePath)){
   
            // Insert image file name into database
            $insert = $db->query("INSERT into employer_account (company_name,description,email,pass,is_active,url,logo,am,added_on) VALUES ('".$title."','".$cdes."' ,'".$email."','".$pass."','1','".$cweb."','".$fileName."','".$am."',NOW())");
            if($insert){
                // $statusMsg = "The company has been added successfully.";
                $statusMsg='?status=succcomp';

            }else{
                // $statusMsg = "upload image failed, please try again.";
                $statusMsg='?status=errcomp';

            } 
        }else{
            // $statusMsg = "Sorry, there was an error uploading ";
            $statusMsg='?status=errcomp';

        }
    }
        else{
            // $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
            $statusMsg='?status=errcomptype';

        }
        }
        else {
                    // Insert image file name into database
                    $insert = $db->query("INSERT into employer_account (company_name,description,email,pass,is_active,url,logo,am,added_on) VALUES ('".$title."','".$cdes."' ,'".$email."','".$pass."','1','".$cweb."','dummy.jpg','".$am."',NOW())");
                    if($insert){
                $statusMsg='?status=succcomp';

                    }else{
                $statusMsg='?status=errcomp';

                    } 
                }    
// Display status message
// echo $statusMsg;

$sql="SELECT * FROM admins WHERE email='$am'";
$result = $db->query($sql);
$companies=array();

if ($result ->num_rows ==1) {
    while($row1 = $result->fetch_assoc()) {
        $companies=json_decode(stripslashes($row1['company']));
        // var_dump($companies);
        array_push($companies,$email);
        // var_dump($companies);
        $newcomp=json_encode($companies);
        $updateam=$db->query("UPDATE admins SET company='$newcomp' where email='$am'");

        if($updateam){
            $statusMsg='?status=succcomp';
        }
        else{
            $statusMsg='?status=errcomp';
        } 
    }
}

header('Location:post-a-job.php'.$statusMsg);

?>