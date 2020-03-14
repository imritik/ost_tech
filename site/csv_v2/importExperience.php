<?php
// Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmitexperience'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['fileexperience']['name']) && in_array($_FILES['fileexperience']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['fileexperience']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['fileexperience']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $total_exp= $line[1];
                $tech=$line[2];
                $func_seg=$line[3];
                $industries_worked=$line[4];
                $max_teamsize_handled=$line[5];
                $languages=$line[6];
                $prev_comp=$line[7];

                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM Experience WHERE student_id = $line[0]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE Experience SET total_exp = '$total_exp', tech = '$tech', func_seg = '$func_seg', industries_worked = '$industries_worked',max_teamsize_handled='$max_teamsize_handled',languages='$languages',prev_comp='$prev_comp',updated_at=NOW() WHERE student_id = $sid");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO Experience (student_id,total_exp,tech,func_seg,industries_worked,max_teamsize_handled,languages,prev_comp,updated_at) VALUES ('".$sid."', '".$total_exp."', '".$tech."', '".$func_seg."', '".$industries_worked."', '".$max_teamsize_handled."','".$languages."','".$prev_comp."',NOW())");
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