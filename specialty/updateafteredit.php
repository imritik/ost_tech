<?php
// Include the database configuration file
session_start();
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['stud_id'])){

  }
  else{
    header("location: ../index.php");
  }
$statusMsg = '';

// File upload path
// $targetDir = "uploads/";
// $fileName = basename($_FILES['updatedresume']["name"]);
// print($fileName);
// echo $fileName;
// // print(isset($_FILES["updatedresume"]));
// $targetFilePath = $targetDir . $fileName;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$tag1=$_POST['param1'];
// $tag3=$_POST['param5'];
// print $tag1;
$tag4=$_POST['param3'];
$tag6=$_POST['param4'];
$tag9=$_SESSION['stud_id'];

// echo $tag1;

// if( !empty($_FILES["updatedresume"]["name"])){
//     $allowTypes = array('doc','docx','pdf');
//     if(in_array($fileType, $allowTypes)){
      
//         if(move_uploaded_file($_FILES["updatedresume"]["tmp_name"], $targetFilePath)){
//             $insert = $db->query("UPDATE Student SET  curr_company='$tag1',curr_ctc='$tag4',experience='$tag6',resume='$fileName',modified_on=NOW() WHERE student_id=$tag9");
//             if($insert){
//                 $statusMsg = "The image ".$fileName. " has been uploaded successfully.";

//             }else{
//                 $statusMsg = "image upload failed, please try again.";
//             } 
//         }else{
//             $statusMsg = "Sorry, there was an error uploading your image.";
//         }
//     }else{
//         $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
//     }
// } else{
    $insert1 = $db->query("UPDATE Student SET curr_company='$tag1',curr_ctc='$tag4',experience='$tag6',modified_on=NOW() WHERE student_id='$tag9'");
            if($insert1){
                $statusMsg = "updated successfully.";

            }else{
                $statusMsg = "please try again.";
            } 
// Display status message
echo $statusMsg;
?>

