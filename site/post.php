<?php
// Include the database configuration file
session_start();
include '../dbConfig.php';
$statusMsg = '';

$digits = 4;
// echo rand(pow(10, $digits-1), pow(10, $digits)-1);

$email=$_POST['email'];
$title=$_POST['title'];
$location=$_POST['location'];
$type=$_POST['type'];
$category=$_POST['category'];
$url=$_SESSION['url'];
$description=$_POST['description'];
$postingid=rand(pow(10, $digits-1), pow(10, $digits)-1);
// echo $tag1;

if(isset($_POST["submit"]) ){
    // Allow certain file formats
   
            // Insert image file name into database
            $insert = $db->query("INSERT into Job_Posting (posting_id,company_name,job_title,Job_type,Job_location,job_description,company_url,posting_time) VALUES ('".$postingid."','".$_SESSION['company']."' ,'".$title."','".$type."','".$location."','".$description."','".$url."',NOW())");
            if($insert){
                $statusMsg = "The job has been uploaded successfully.";

                echo "<SCRIPT type='text/javascript'> 
                // alert('image uploaded !');
                // window.location.replace(\"http://campuschords.com/index_Admin.php\");
            </SCRIPT>";
            }else{
                $statusMsg = "image upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your image.";
        }
   

// Display status message
echo $statusMsg;
?>