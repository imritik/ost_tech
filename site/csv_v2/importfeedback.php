<?php
// Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmitfeedback'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['filefeedback']['name']) && in_array($_FILES['filefeedback']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['filefeedback']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['filefeedback']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $student_email = $line[1];
                $email  = $line[2];
                $phone  = $line[3];
                $address = $line[4];
                $coordinator_note = $line[5];

            $name='';
            $dynamicquery=
                // collect student id from email
                $newquery="SELECT * FROM Student where email='$student_email'";
                 $newqueryResult = $db->query($newquery);
                if($newqueryResult->num_rows >0){
                    $name=$newqueryResult['student_id'];
                }
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM applied_table WHERE posting_id = $line[0] and student_id=$line[1]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE applied_table SET Status = '$phone', Note = '$address', coordinator_note='$coordinator_note',Status_update = NOW() WHERE posting_id = $sid and student_id=$name");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO applied_table (posting_id,student_id,applied_at,Status,Note,coordinator_note,Status_update) VALUES ('".$sid."', '".$name."','".$email."', '".$phone."', '".$address."','".$coordinator_note."',NOW())");
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
header("Location: ../jobs.php".$qstring);