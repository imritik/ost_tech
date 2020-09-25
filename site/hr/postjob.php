<?php
// Include the database configuration file
session_start();
include '../../dbConfig.php';
$statusMsg = '';

$digits = 4;
// echo rand(pow(10, $digits-1), pow(10, $digits)-1);
$compname=$_POST['companyname'];
// var_dump($compname);
$email=$_POST['email'];
$title=$_POST['title'];
$location=$_POST['location'];
$type=$_POST['type'];
// $category=$_POST['category'];
$url=$_POST['weburl'];
$description=$_POST['description'];
$vendors=$_POST['coordinator'];
$recruiters=$_POST['recruiter'];
// $managers=$_POST['managers'];

$basis=$_POST['duplicates'];
$levels=$_POST['member'];


$managers=array();
// var_dump($levels);
for($i=0;$i<$levels;$i++){
    array_push($managers,$_POST['managers'][$i]);
}
// $new_managers=$_POST['managers'];

$uploaded_by_hr=$_SESSION['emailhr'];


// var_dump($vendors,$managers);
// var_dump($basis);
// $postingid=$_GET['jid'];
$postingid=rand(pow(10, $digits-1), pow(10, $digits)-1);
// var_dump($email);
if(is_string($vendors)){
$vendors=explode(",",$vendors);
$vendors=json_encode($vendors);
}
else{
    $vendors=json_encode($vendors);
}

if(is_string($recruiters)){
$recruiters=explode(",",$recruiters);
$recruiters=json_encode($recruiters);
}
else{
$recruiters=json_encode($recruiters);
}

if(is_string($managers)){
$managers=explode(",",$managers);
$managers=json_encode($managers);
}
else{
    $managers=json_encode($managers);
}

// var_dump($vendors);
// var_dump($recruiters);
// File upload path

// var_dump($managers);
// var_dump($new_managers);




$targetDir = "uploads/jd/".$postingid."/";
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
// var_dump($_FILES["jobdescriptionfile"]["name"]);
if(!empty($_FILES["jobdescriptionfile"]["name"])){
    // Allow certain file formats
    // Allow certain file formats
    $allowTypes = array('doc','docx','pdf');
    if(in_array($fileType, $allowTypes)){
      
        // Upload file to server
        if(move_uploaded_file($_FILES["jobdescriptionfile"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    $insert = $db->query("INSERT IGNORE into Job_Posting (posting_id,company_name,email,job_title,Job_type,Job_location,job_description,description_file,levels,duplicate_basis,company_url,posting_time,manager,vendor,recruiter,hr) VALUES ('".$postingid."','".$compname."' ,'".$email."','".$title."','".$type."','".$location."','".$description."','".$fileName."','".$levels."','".$basis."','".$url."',NOW(),IFNULL('$managers',manager),IFNULL('$vendors',vendor),IFNULL('$recruiters',recruiter),'".$uploaded_by_hr."')");
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
            $insert = $db->query("INSERT IGNORE into Job_Posting (posting_id,company_name,email,job_title,Job_type,Job_location,job_description,levels,duplicate_basis,company_url,posting_time,manager,vendor,recruiter,hr) VALUES ('".$postingid."','".$compname."' ,'".$email."','".$title."','".$type."','".$location."','".$description."','".$levels."','".$basis."','".$url."',NOW(),IFNULL('$managers',manager),IFNULL('$vendors',vendor),IFNULL('$recruiters',recruiter),'".$uploaded_by_hr."')");
        //   var_dump("INSERT IGNORE into Job_Posting (posting_id,company_name,email,job_title,Job_type,Job_location,job_description,duplicate_basis,company_url,posting_time,manager,vendor,recruiter) VALUES ('".$postingid."','".$compname."' ,'".$email."','".$title."','".$type."','".$location."','".$description."','".$basis."','".$url."',NOW(),IFNULL($managers,manager),IFNULL($vendors,vendor),IFNULL($recruiters,recruiter))");
        //   var_dump($insert);
          
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
header('Location:editjob.php'.$statusMsg);
?>