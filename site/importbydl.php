<?php
// Load the database configuration file
include_once '../dbConfig.php';


if(isset($_POST['importSubmitbydl'])){
    
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
                $email  = $line[7];
                $phone  = $line[6];
                $clocation  = $line[5];
                $address = $line[2];
                $cid = $line[3];
                $cname = $line[4];
                $pass = $line[8];
                $comp = $line[9];
                $cctc = $line[10];
                $resume = $line[11];
                $exper = $line[12];
                $upload = $line[13];
                $modify_on = $line[14];
                $uploaded_by=$line[16];
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM Student WHERE student_id = $line[0]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE Student SET stud_name = '$name', contact = '$phone', email = '$email', address = '$address', curr_company = '$comp', curr_ctc = '$cctc',  experience = '$exper', modified_on = NOW() WHERE student_id = $sid");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO Student (student_id,stud_name, email, contact, address,college_id,college_name,college_location,pass,curr_company,curr_ctc,resume,experience,updated_on, modified_on,Uploaded_by) VALUES ('".$sid."', '".$name."', '".$email."', '".$phone."', '".$address."', '".$cid."', '".$cname."', '".$clocation."', '".$pass."', '".$comp."', '".$cctc."', '".$resume."', '".$exper."', '".$upload."', '".$modify_on."','".$uploaded_by."')");
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
header("Location: loaders.php".$qstring);