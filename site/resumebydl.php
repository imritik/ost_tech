<?php
// Include the database configuration file
include '../dbConfig.php';

error_reporting(E_ALL & ~E_NOTICE);
session_start();

if(isset($_SESSION['emaildl'])){

  }
  else{
    header("location: ../index.php");
  }
$statusMsg = '';
$studid=$_POST['var'];
print $studid;
// File upload path

         // -----check if directory exists----------------------------------------

                    //The name of the directory that we need to create.
                    $directoryName = '../specialty/uploads/'.$studid.'/';

                    //Check if the directory already exists.
                    if(!is_dir($directoryName)){
                        //Directory does not exist, so lets create it.
                        mkdir($directoryName, 0755, true);
                    }

$fileName = basename($_FILES["pictureFile"]["name"]);

$targetFilePath = $directoryName . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if( !empty($_FILES["pictureFile"]["name"])){
    // Allow certain file formats
    $allowTypes = array('doc','docx','pdf');
    if(in_array($fileType, $allowTypes)){
      
        // Upload file to server
        if(move_uploaded_file($_FILES["pictureFile"]["tmp_name"], $targetFilePath)){


                 // <!-- // -----api to convert docx to pdf------ -->
                        
                 if($fileType=='docx'){

                    
                        $url = 'https://v2.convertapi.com/convert/docx/to/pdf?Secret=h286hcVyKZgyHkzu';
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


            // Insert image file name into database
            $insert = $db->query("UPDATE Student SET resume='$fileName',modified_on=NOW() WHERE student_id='$studid'");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";

            }else{
                $statusMsg = " upload failed, please try again.";
            } 
            // $statusMsg="uploaded";
        }else{
            $statusMsg = "Sorry, there was an error uploading .";
        }
    }else{
        $statusMsg = 'Sorry, only pdf,docx,doc files are allowed to upload.';
    }
}else{
    $statusMsg='upload file';
}

// Display status message
echo $statusMsg;
?>

