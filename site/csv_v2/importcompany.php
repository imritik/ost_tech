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
                $name = $line[1];
                $email  = $line[2];
                $phone  = $line[3];
                $clocation  = $line[7];
                $address = $line[4];
                $cid = $line[5];
                $cname = $line[6];

            
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM employer_account WHERE company_name = $line[0]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE employer_account SET description = '$name', is_active = '$address', url = '$cid', logo = '$cname',added_on = NOW() WHERE company_name = $sid");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO employer_account (company_name, description,email, pass,is_active,url,logo,added_on) VALUES ('".$sid."', '".$name."', '".$email."', '".$phone."', '".$address."', '".$cid."', '".$cname."', '".$clocation."')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: ../post-a-job.php".$qstring);