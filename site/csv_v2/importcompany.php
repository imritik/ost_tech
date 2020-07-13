<?php
// Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmitcompany'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['filecompany']['name']) && in_array($_FILES['filecompany']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['filecompany']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['filecompany']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $desc = $line[1];
                $email  = $line[2];
                $password  = $line[3];
                $url = $line[4];
                $am= $line[5];


                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM employer_account WHERE email = '$line[2]'";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE IGNORE employer_account SET company_name='$sid',description = '$desc', am='$am', url = '$url',added_on = NOW() WHERE email = '$email'");

                    // var_dump("UPDATE IGNORE employer_account SET company_name='$sid',description = '$desc', am='$am', url = '$url',added_on = NOW() WHERE email = '$email'");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT IGNORE INTO employer_account (company_name, description,email, pass,url,am,added_on) VALUES ('".$sid."', '".$desc."', '".$email."', '".$password."', '".$url."', '".$am."',NOW())");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succcomp';
        }else{
            $qstring = '?status=errcomp';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: ../post-a-job.php".$qstring);