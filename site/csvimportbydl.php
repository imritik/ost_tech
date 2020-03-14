<?php
// Load the database configuration file
include_once '../dbConfig.php';


if(isset($_POST['importSubmitbydl2'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $name = $line[1];
               

         // -----check if directory exists----------------------------------------

                    //The name of the directory that we need to create.
                    $directoryName = '../specialty/uploads/'.$sid;

                    //Check if the directory already exists.
                    if(!is_dir($directoryName)){
                        //Directory does not exist, so lets create it.
                        mkdir($directoryName, 0755, true);
                    }



         // ------process to upload file in directory------------------------------

                    // File upload path
                    $targetDir = "../specialty/uploads/$sid/";
                    $fileName = basename($name);
                    // echo $fileName;
                    // print(isset($_FILES["resume"]));
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


                    
        if( !empty($fileName)){
            // Allow certain file formats
            $allowTypes = array('doc','docx','pdf');
            if(in_array($fileType, $allowTypes)){
            
            
                // Upload file to server
             
                    if(copy($name, $targetFilePath)){
                    // Insert image file name into database
                    $test="in herre";
                      // Insert image file name into database
                    $insert = $db->query("UPDATE Student SET resume='$fileName',modified_on=NOW() WHERE student_id='$sid'");
                    if($insert){
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";

                    }else{
                        $statusMsg = " upload failed, please try again.";
                    }                
        }
    }
}


            }
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ&name='.$test;
        // }
    }else{
        $qstring = '?status=err';
    }
}
else{
    $qstring = '?status=invalid_file';
}
}
// Redirect to the listing page
header("Location: candidates.php".$qstring);