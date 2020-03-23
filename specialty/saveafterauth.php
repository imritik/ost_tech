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
$currstud=$_SESSION['stud_id'];

// File upload path
$targetDir = "uploads/$currstud";

                    //Check if the directory already exists.
                    if(!is_dir($targetDir)){
                        //Directory does not exist, so lets create it.
                        mkdir($targetDir, 0755, true);
                    }

$fileName = basename($_FILES["resume"]["name"]);
// echo $fileName;
// print(isset($_FILES["resume"]));
$targetFilePath = $targetDir .'/'. $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$tag1=$_POST['username-login'];
// $tag2=$_POST['username-email'];
$tag3=$_POST['username-address'];
$tag4=$_POST['username-contact'];
// $tag5=$_POST['username-email'];
$tag11=$_POST['username-college'];
$tag6=$_POST['username-company'];
$tag7=$_POST['username-ctc'];
$tag8=$_POST['username-exp'];
$tag9=$_SESSION['stud_id'];


if( !empty($_FILES["resume"]["name"])){
    // Allow certain file formats
    $allowTypes = array('doc','docx','pdf');
    if(in_array($fileType, $allowTypes)){
       
        // Upload file to server
        if(move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)){

            if($fileType=='docx'){

                // <!-- // -----api to convert docx to pdf------ -->
                
                    $url = 'https://v2.convertapi.com/convert/docx/to/pdf?Secret=h286hcVyKZgyHkzu';
                    $File ='File=http://talentchords.com/jobs/specialty/uploads/'.$currstud.'/'.$fileName;
    
                    $ch = curl_init( $url );
                    curl_setopt( $ch, CURLOPT_POST, 1);
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $File);
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt( $ch, CURLOPT_HEADER, 0);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
                    $response = curl_exec( $ch );
                    $final= json_decode($response);
                    $newname=$final->Files[0]->FileName;
                    $newdata=base64_decode($final->Files[0]->FileData);
                    // var_dump($final->Files[0]);
                    // Write the contents back to the file
                        // file_put_contents($newname, $newdata);
                    $fileName=$newname;
                    $filepdf = fopen($targetDir . '/' . $fileName,"w");
                    fwrite($filepdf,$newdata);
                    fclose($filepdf);
                    $targetFilePath = $targetDir;

                    
                    // ------upload the pdf file back to server----
                        if(copy($filepdf, $targetFilePath)){
                            // echo "updated ty";
                        }
                        else{
                            $statusMsg='Conversion gone wrong!';
                        }
            }

                 //  --------------------------------------------------
                // <!-- // -----api to convert doc to pdf------ -->
                        
                if($fileType=='doc'){

                    
                    $url = 'https://v2.convertapi.com/convert/doc/to/pdf?Secret=h286hcVyKZgyHkzu';
                    $File ='File=http://talentchords.com/jobs/specialty/uploads/'.$studid.'/'.$fileName;
    
                    $ch = curl_init( $url );
                    curl_setopt( $ch, CURLOPT_POST, 1);
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $File);
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt( $ch, CURLOPT_HEADER, 0);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
                    $response = curl_exec( $ch );
                    $final= json_decode($response);
                    $newname=$final->Files[0]->FileName;
                    $newdata=base64_decode($final->Files[0]->FileData);
                    // var_dump($final->Files[0]);
                    // Write the contents back to the file
                        // file_put_contents($newname, $newdata);
                    $fileName=$newname;
                    $filepdf = fopen($directoryName . '/' . $fileName,"w");
                    fwrite($filepdf,$newdata);
                    fclose($filepdf);
                    $targetFilePath = $directoryName;

                    
                    // ------upload the pdf file back to server----
                        if(copy($filepdf, $targetFilePath)){
                            // echo "updated ty";
                        }
                        else{
                            $statusMsg='Conversion gone wrong!';
                        }
            }

                  
    
            }
        
            // Insert image file name into database
            $insert = $db->query("UPDATE Student SET stud_name='$tag1', address='$tag3',contact='$tag4',college_name='$tag11',  curr_company='$tag6',curr_ctc='$tag7',experience='$tag8',resume='$fileName',cv_upload_date=NOW(),modified_on=NOW() WHERE student_id=$tag9");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";

            }else{
                $statusMsg = " upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, only pdf,docx,doc files are allowed to upload.";
        }
}else{
     // Insert image file name into database
     $insert1 = $db->query("UPDATE Student SET stud_name='$tag1', address='$tag3',contact='$tag4',college_name='$tag11',  curr_company='$tag6',curr_ctc='$tag7',experience='$tag8',modified_on=NOW() WHERE student_id=$tag9");
     if($insert1){
         $statusMsg = "saved successfully.";

     }else{
         $statusMsg = "  please try again.";
     } 
}

// Display status message
echo $statusMsg;
?>


