<?php
// Include the database configuration file
session_start();
include '../../dbConfig.php';
$statusMsg = '';

// $digits = 4;
// echo rand(pow(10, $digits-1), pow(10, $digits)-1);

// $compnametemp= $_POST['companyname']; 
$compname=$_POST['companyname'];
$email=$_POST['email'];
$title=$_POST['title'];
$location=$_POST['location'];
$type=$_POST['type'];
// $category=$_POST['category'];
$url=$_POST['weburl'];
$description=$_POST['description'];
$vendors=$_POST['coordinator'];
$recruiters=$_POST['recruiter'];
$postingid=$_GET['jid'];
var_dump($postingid);
// File upload path
$targetDir = "../uploads/jd/".$postingid."/";
 //Check if the directory already exists.
 if(!is_dir($targetDir)){
    //Directory does not exist, so lets create it.
    mkdir($targetDir, 0755, true);
}
// var_dump(isset($_FILES["jobdescriptionfile"]));

// var_dump($_FILES);
$fileName = basename($_FILES["jobdescriptionfile"]["name"]);

$targetFilePath = $targetDir . $fileName;

// var_dump($targetFilePath);

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
// echo $tag1;
var_dump($_FILES["jobdescriptionfile"]["name"]);
if(!empty($_FILES["jobdescriptionfile"]["name"])){
    // Allow certain file formats
    // Allow certain file formats
    $allowTypes = array('doc','docx','pdf');
    if(in_array($fileType, $allowTypes)){
      
        // Upload file to server
        if(move_uploaded_file($_FILES["jobdescriptionfile"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    $insert = $db->query("UPDATE IGNORE Job_Posting SET job_title='$title',Job_type='$type',Job_location='$location',job_description='$description',description_file='$fileName',company_url='$url',vendor='$vendors',recruiter='$recruiters' where posting_id='$postingid' and email='$email'");
                //   var_dump("UPDATE IGNORE Job_Posting SET job_title='$title',Job_type='$type',Job_location='$location',job_description='$description',description_file='$fileName',company_url='$url',vendor='$vendors',recruiter='$recruiters where posting_id='$postingid' and email='$email'");
                    if($insert){
                        // $statusMsg = "The job has been uploaded successfully.";
                        $statusMsg='&status=succjob';

                    }else{
                        // $statusMsg = "job upload failed, please try again.";
                        $statusMsg='&status=errjob';

                    } 
        }
    }
    else{
        // $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
        $statusMsg='&status=errfiletype';

    }
}
else{
            // Insert image file name into database
            $insert = $db->query("UPDATE IGNORE Job_Posting SET job_title='$title',Job_type='$type',Job_location='$location',job_description='$description',company_url='$url',vendor='$vendors',recruiter='$recruiters' where posting_id='$postingid' and email='$email'");
                //   var_dump("UPDATE IGNORE Job_Posting SET job_title='$title',Job_type='$type',Job_location='$location',job_description='$description',company_url='$url',vendor='$vendors',recruiter='$recruiters where posting_id='$postingid' and email='$email'");
            
            if($insert){
                // $statusMsg = "The job has been uploaded successfully.";
                $statusMsg='&status=succjob';

            }else{
                // $statusMsg = "job upload failed, please try again.";
                $statusMsg='&status=errjob';

            } 
        }
        // else{
        //     // $statusMsg = "Sorry, there was an error uploading your job.";
        //     $statusMsg='?status=errjob';

        // }
   
    
// Display status message
echo $statusMsg;
header('Location:'.$_SERVER["HTTP_REFERER"].$statusMsg);
?>