<?php
// Include the database configuration file
session_start();
include '../dbConfig.php';
$statusMsg = '';

$digits = 4;
// echo rand(pow(10, $digits-1), pow(10, $digits)-1);
$compnametemp=explode("$", $_POST['companyname']); 
$compname=$compnametemp[0];
$email=$_POST['email'];
$title=$_POST['title'];
$location=$_POST['location'];
$type=$_POST['type'];
// $category=$_POST['category'];
$url=$_POST['weburl'];
$description=$_POST['description'];
$postingid=rand(pow(10, $digits-1), pow(10, $digits)-1);

// File upload path
$targetDir = "uploads/jd/".$postingid."/";
 //Check if the directory already exists.
 if(!is_dir($targetDir)){
    //Directory does not exist, so lets create it.
    mkdir($targetDir, 0755, true);
}
$fileName = basename($_FILES["jobdescriptionfile"]["name"]);

$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
// echo $tag1;

if(isset($_POST["submit"]) && !empty($_FILES["jobdescriptionfile"]["name"])){
    // Allow certain file formats
    // Allow certain file formats
    $allowTypes = array('doc','docx','pdf');
    if(in_array($fileType, $allowTypes)){
      
        // Upload file to server
        if(move_uploaded_file($_FILES["jobdescriptionfile"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    $insert = $db->query("INSERT into Job_Posting (posting_id,company_name,email,job_title,Job_type,Job_location,job_description,description_file,company_url,posting_time) VALUES ('".$postingid."','".$compname."' ,'".$email."','".$title."','".$type."','".$location."','".$description."','".$fileName."','".$url."',NOW())");
                    if($insert){
                        // $statusMsg = "The job has been uploaded successfully.";
                        $statusMsg='?status=succjob';

                    }else{
                        // $statusMsg = "job upload failed, please try again.";
                        $statusMsg='?status=errjob';

                    } 
        }
    }
    else{
        // $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
        $statusMsg='?status=errfiletype';

    }
}
else{
            // Insert image file name into database
            $insert = $db->query("INSERT into Job_Posting (posting_id,company_name,email,job_title,Job_type,Job_location,job_description,company_url,posting_time) VALUES ('".$postingid."','".$compname."' ,'".$email."','".$title."','".$type."','".$location."','".$description."','".$url."',NOW())");
            if($insert){
                // $statusMsg = "The job has been uploaded successfully.";
                $statusMsg='?status=succjob';

            }else{
                // $statusMsg = "job upload failed, please try again.";
                $statusMsg='?status=errjob';

            } 
        }
        // else{
        //     // $statusMsg = "Sorry, there was an error uploading your job.";
        //     $statusMsg='?status=errjob';

        // }
   
    
// Display status message
// echo $statusMsg;
header('Location:post-a-job.php'.$statusMsg);
?>