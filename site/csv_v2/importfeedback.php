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
            // echo "jj";
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $student_email = $line[1];
                $email  = $line[2];
                $phone  = $line[3];
                // $address = $line[4];
                $coordinator_note = $line[4];
                $hr_note=$line[6];
                $manager_note=$line[7];
                $am_note=$line[8];

            $name='';
            // echo "hi";
            // var_dump($student_email,$sid);
            // $dynamicquery=
                // collect student id from email
                $newquery="SELECT * FROM Student where email='$student_email'";
                 $newqueryResult = $db->query($newquery);
                //  $newqueryResult=$newqueryResult->fetch_assoc();
                while ($row = $newqueryResult->fetch_array()) {
                    // $output[] = $row;
                    // var_dump($row);
                    $name=$row['student_id'];
                    // var_dump($name);
                }
                // if($newqueryResult->num_rows==1){
                //     $name=$newqueryResult['student_id'];
                //     var_dump($name);
                // }
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM applied_table WHERE posting_id = $line[0] and student_id=$name";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE IGNORE applied_table 
                    SET 
                    Status = Coalesce(NULLIF('$phone',''),Status), 
                    -- Note = Coalesce(NULLIF('$address',''),Note), 
                    coordinator_note=Coalesce(NULLIF('$coordinator_note',''),coordinator_note),
                    hr_note=Coalesce(NULLIF('$hr_note',''),hr_note),
                    manager_note=Coalesce(NULLIF('$manager_note',''),manager_note),
                    
                    Note=Coalesce(NULLIF('$am_note',''),Note),

                    Status_update = NOW() 
                    WHERE posting_id = $sid and student_id=$name");

                    // var_dump("UPDATE IGNORE applied_table 
                    // SET 
                    // Status = Coalesce(NULLIF('$phone',''),Status), 
                    // Note = Coalesce(NULLIF('$address',''),Note), 
                    // coordinator_note=Coalesce(NULLIF('$coordinator_note',''),coordinator_note),
                    // Status_update = NOW() 
                    // WHERE posting_id = $sid and student_id=$name");
                }else{
                    // echo "new";
                    // Insert member data in the database
                    $db->query("INSERT IGNORE INTO applied_table (posting_id,student_id,applied_at,Status,Note,coordinator_note,Status_update,hr_note,manager_note,Note) VALUES ('".$sid."', '".$name."','".$email."', '".$phone."','".$coordinator_note."',NOW(),'".$hr_note."','".$manager_note."','".$am_note."')");
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

// echo $qstring;
header("Location: ../jobs.php".$qstring);