<?php
// Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmitjobs'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['filejobs']['name']) && in_array($_FILES['filejobs']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['filejobs']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['filejobs']['tmp_name'], 'r');
            
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
                $pass = $line[8];
            
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM Job_Posting WHERE posting_id = $line[0]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE Job_Posting SET job_title = '$phone', Job_type = '$address', Job_location = '$cid', Job_description = '$cname',posting_time = NOW() WHERE posting_id = $sid");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO Job_Posting (posting_id,company_name, email, job_title,Job_type,Job_location,job_description,company_url,posting_time) VALUES ('".$sid."', '".$name."', '".$email."', '".$phone."', '".$address."', '".$cid."', '".$cname."', '".$clocation."', '".$pass."')");
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