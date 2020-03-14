<?php
// Load the database configuration file
include_once 'dbConfig.php';
if(isset($_POST['importSubmitlinkedin'])){
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['filelinkedin']['name']) && in_array($_FILES['filelinkedin']['type'], $csvMimes)){
        // If the file is uploaded
        if(is_uploaded_file($_FILES['filelinkedin']['tmp_name'])){
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['filelinkedin']['tmp_name'], 'r');
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
                $tech = $line[12];
                $cv_parsed = $line[13];
                $turnup_rate = $line[14];
                $job_seeker=$line[15];
                $experience=$line[16];
                $updated_on=$line[17];
                $modified_on=$line[18];
                $is_active=$line[19];
                $uploaded_by=$line[20];
                $school_hsc=$line[21];
                $city_hsc=$line[22];
                $per_hsc=$line[23];
                $yoc_hsc=$line[24];
                $school_ssc=$line[25];
                $city_ssc=$line[26];
                $per_ssc=$line[27];
                $yoc_ssc=$line[28];
                $ug_college=$line[29];
                $ug_degree=$line[30];
                $ug_city=$line[31];
                $ug_agg=$line[32];
                $ug_yoc=$line[33];
                $pg_college=$line[34];
                $pg_degree=$line[35];
                $pg_city=$line[36];
                $pg_agg=$line[37];
                $pg_yoc=$line[38];
                $add_courses=$line[39];
                $expected_ctc=$line[40];
                $pre_loc=$line[41];
                $work_segment=$line[42];
                $industry=$line[43];
                $total_exp=$line[44];
                $func_seg=$line[45];
                $industries_worked=$line[46];
                $max_teamsize=$line[47];
                $languages=$line[48];
                $prev_companies=$line[49];
                $prev_comp_other=$line[50];
                $linkedin=$line[51];
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM Linkedin WHERE linkedin = '$linkedin'";
                $prevResult = $db->query($prevQuery);
                $no='';
                if($prevResult->num_rows ==1){
                    // Update member data in the database
                   $update= $db->query("UPDATE Linkedin SET id='$sid',stud_name = '$name',pass='$pass' ,contact = '$phone', address = '$address', curr_company = '$comp', curr_ctc = '$cctc',tech='$tech',job_seeker='$job_seeker' , experience = '$experience', modified_on = NOW(),is_active='$is_active',school_hsc = '$school_hsc', city_hsc = '$city_hsc', percent_hsc = '$per_hsc', yoc_hsc = '$yoc_hsc',school_ssc = '$school_ssc', city_ssc = '$city_ssc', percent_ssc = '$per_ssc', yoc_ssc = '$yoc_ssc', ug_college = '$ug_college', ug_degree = '$ug_degree',  ug_city = '$ug_city', ug_agg = '$ug_agg',ug_yoc='$ug_yoc',pg_college = '$pg_college', pg_degree = '$pg_degree',  pg_city = '$pg_city', pg_agg = '$pg_agg',pg_yoc='$pg_yoc',add_courses='$add_courses',total_exp = '$total_exp', func_seg = '$func_seg', industries_worked = '$industries_worked',max_teamsize_handled='$max_teamsize',languages='$languages',prev_comp='$prev_companies',prev_comp_other='$prev_comp_other',expected_ctc = '$expected_ctc', preferred_loc = '$pre_loc', work_segment = '$work_segment', industry = '$industry' WHERE linkedin = '$linkedin'");
                // echo "old";
                if(!$update){
                    $qstring = '?status=err';
                }
                else{
                    $qstring = '?status=succ';
                }
                }
                
                else{
                    // Insert member data in the database
                    $insert=$db->query("INSERT INTO Linkedin (id,stud_name, email, contact, address,college_id,college_name,college_location,pass,curr_company,curr_ctc,resume,experience,tech,cv_parsed,turnup_rate,job_seeker,updated_on, modified_on,is_active,Uploaded_by,school_hsc,city_hsc,percent_hsc,yoc_hsc,school_ssc,city_ssc,percent_ssc,yoc_ssc,ug_college,ug_degree,ug_city,ug_agg,ug_yoc,pg_college,pg_degree,pg_city,pg_agg,pg_yoc,add_courses,expected_ctc,preferred_loc,work_segment,industry,total_exp,func_seg,industries_worked,max_teamsize_handled,languages,prev_comp,prev_comp_other,linkedin) VALUES ('$sid', '$name', '$email', '$phone', '$address', '$cid', '$cname', '$clocation', '$pass', '$comp', '$cctc', '$resume', '$experience','$tech','$cv_parsed','$turnup_rate','$job_seeker',NOW(), NOW(),'$is_active','$uploaded_by','$school_hsc', '$city_hsc', '$per_hsc', '$yoc_hsc', '$school_ssc', '$city_ssc', '$per_ssc', '$yoc_ssc', '$ug_college', '$ug_degree', '$ug_city', '$ug_agg', '$ug_yoc','$pg_college', '$pg_degree', '$pg_city', '$pg_agg', '$pg_yoc', '$add_courses','$expected_ctc', '$pre_loc', '$work_segment', '$industry','$total_exp', '$func_seg', '$industries_worked', '$max_teamsize','$languages','$prev_companies','$prev_comp_other','$linkedin')");
                    if(!$insert){
                        // echo "srry";
                        $qstring = '?status=err';
                    }
                    else{
                        
                        $qstring = '?status=succ';
                    }
                
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            // $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}
// Redirect to the listing page
header("Location: ../linkedinCandidates.php".$qstring);
?>