<?php
// Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmitpreference'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['filepreference']['name']) && in_array($_FILES['filepreference']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['filepreference']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['filepreference']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $exp_ctc= $line[1];
                $loc=$line[2];
                $work_seg=$line[3];
                $industry=$line[4];
               
                


                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM Preferences WHERE student_id = $line[0]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE Preferences SET expected_ctc = '$exp_ctc', preferred_loc = '$loc', work_segment = '$work_seg', industry = '$industry',updated_at=NOW() WHERE student_id = $sid");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO Preferences (student_id,expected_ctc,preferred_loc,work_segment,industry,updated_at) VALUES ('".$sid."', '".$exp_ctc."', '".$loc."', '".$work_seg."', '".$industry."',NOW())");
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
header("Location: ../candidates.php".$qstring);