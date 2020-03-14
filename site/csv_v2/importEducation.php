<?php
// Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmiteducation'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['fileeducation']['name']) && in_array($_FILES['fileeducation']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['fileeducation']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['fileeducation']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $school_hsc= $line[1];
                $city_hsc=$line[2];
                $per_hsc=$line[3];
                $yoc_hsc=$line[4];
                $school_ssc=$line[5];
                $city_ssc=$line[6];
                $per_ssc=$line[7];
                $yoc_ssc=$line[8];
                $ug_college=$line[9];
                $ug_degree=$line[10];
                $ug_city=$line[11];
                $ug_agg=$line[12];
                $ug_yoc=$line[13];
                $pg_college=$line[14];
                $pg_degree=$line[15];
                $pg_city=$line[16];
                $pg_agg=$line[17];
                $pg_yoc=$line[18];
                $ac=$line[19];
                


                // Check whether member already exists in the database with the same id
                $prevQuery = "SELECT * FROM Education WHERE student_id = $line[0]";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                    // Update member data in the database
                    $db->query("UPDATE Education SET school_hsc = '$school_hsc', city_hsc = '$city_hsc', percent_hsc = '$per_hsc', yoc_hsc = '$yoc_hsc',school_ssc = '$school_ssc', city_ssc = '$city_ssc', percent_ssc = '$per_ssc', yoc_ssc = '$yoc_ssc', ug_college = '$ug_college', ug_degree = '$ug_degree',  ug_city = '$ug_city', ug_agg = '$ug_agg',ug_yoc='$ug_yoc',pg_college = '$pg_college', pg_degree = '$pg_degree',  pg_city = '$pg_city', pg_agg = '$pg_agg',pg_yoc='$pg_yoc',add_courses='$ac',updated_on=NOW() WHERE student_id = $sid");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO Education (student_id,school_hsc,city_hsc,percent_hsc,yoc_hsc,school_ssc,city_ssc,percent_ssc,yoc_ssc,ug_college,ug_degree,ug_city,ug_agg,ug_yoc,pg_college,pg_degree,pg_city,pg_agg,pg_yoc,add_courses,updated_on) VALUES ('".$sid."', '".$school_hsc."', '".$city_hsc."', '".$percent_hsc."', '".$yoc_hsc."', '".$school_ssc."', '".$city_ssc."', '".$percent_ssc."', '".$yoc_ssc."', '".$ug_college."', '".$ug_degree."', '".$ug_city."', '".$ug_agg."', '".$ug_yoc."','".$pg_college."', '".$pg_degree."', '".$pg_city."', '".$pg_agg."', '".$pg_yoc."', '".$ac."',NOW())");
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