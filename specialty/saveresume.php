<?php 
   include '../dbConfig.php';
   session_start();
   if(isset($_SESSION['stud_id'])){
       // echo $_SESSION['company'];
     }
     else{
       // echo "alert('no session exist')";
       header("location: ../index.php");
     }
/* Getting file name */
$currstud=$_SESSION['stud_id'];
$fileName = basename($_FILES['file']['name']); 
/* Location */
$targetDir="uploads/$currstud/";
  //Check if the directory already exists.
  if(!is_dir($targetDir)){
    //Directory does not exist, so lets create it.
    mkdir($targetDir, 0755, true);
}
$location = $targetDir.$fileName; 
$fileType = pathinfo($location,PATHINFO_EXTENSION);  
$uploadOk = 1; 
$statusMsg = '';
$resumeid=$_SESSION['stud_id'];
if($uploadOk == 0){ 
   echo 0; 
}else{ 
   /* Upload file */
   if( !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('doc','docx','pdf');
    if(in_array($fileType, $allowTypes)){

   if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){ 

    // -----------check for api-------------



                 // <!-- // -----api to convert docx to pdf------ -->
                        
                 if($fileType=='docx'){

                    
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
                    $filepdf = fopen($targetDir.$fileName,"w");
                    fwrite($filepdf,$newdata);
                    fclose($filepdf);
                    $targetFilePath = $targetDir;
                    $location=$targetFilePath.$fileName;
                    
                    // ------upload the pdf file back to server----
                        if(copy($filepdf, $targetFilePath)){
                            // echo "updated ty";
                        }
                        else{
                            $statusMsg='Conversion gone wrong!';
                        }
            }



            //  --------------------------------------------------
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





    $insert = $db->query("UPDATE Student SET resume='$fileName',cv_upload_date=NOW() WHERE student_id=$resumeid");
                if($insert){
                    $statusMsg = "The image ".$fileName. " has been uploaded successfully.";
    
                }else{
                    $statusMsg = "image upload failed, please try again.";
                }
            } 
   }else{ 
    $statusMsg = 'error uploading';
   } 
}
else{
    $statusMsg='Old resume is used';
}
   echo $statusMsg;
} 
?> 