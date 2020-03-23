<?php
// Load the database configuration file
include_once 'dbConfig.php';
if(isset($_POST['importSubmit'])){
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
                $email  = $line[2];
                $pass = $line[3];
                $additional_email=$line[4];
                $phone  = $line[5];
                $total_exp=$line[6];

                // $clocation  = $line[5];
                // $address = $line[2];
                // $cid = $line[3];
                // $cname = $line[4];
                $comp = $line[7];
                $designation=$line[8];
                $ctc_fix=$line[9];
                $ctc_variable=$line[10];
                $cctc = $line[11];
                
                $resume = $line[23];
                $tech = $line[40];
                $cv_parsed = $line[24];
                $turnup_rate = $line[35];
                $offer_acceptance_rate=$line[36];
                $source=$line[37];
                $callers_comment=$line[38];
                // $job_seeker=$line[15];
                // $experience=$line[16];
                // $updated_on=$line[17];
                // $modified_on=$line[18];
                $is_active=$line[34];
                $uploaded_by=$line[39];
                // $school_hsc=$line[21];
                // $city_hsc=$line[22];
                // $per_hsc=$line[23];
                // $yoc_hsc=$line[24];
                // $school_ssc=$line[25];
                // $city_ssc=$line[26];
                // $per_ssc=$line[27];
                // $yoc_ssc=$line[28];
                $ug_college=$line[18];
                $ug_degree=$line[19];
                $ug_city=$line[25];
                $ug_agg=$line[26];
                $ug_yoc=$line[27];
                $pg_college=$line[20];
                $pg_degree=$line[21];
                $pg_city=$line[28];
                $pg_agg=$line[29];
                $pg_yoc=$line[30];
                $add_courses=$line[22];
                $expected_ctc=$line[12];
                $notice_period=$line[13];
                $curr_loc=$line[14];
                $pre_loc=$line[15];
                // $work_segment=$line[42];
                // $industry=$line[43];
                // $func_seg=$line[45];
                // $industries_worked=$line[46];
                // $max_teamsize=$line[47];
                // $languages=$line[48];
                $prev_companies=$line[16];
                $prev_comp_other=$line[17];
                $linkedin=$line[31];
                $fb=$line[32];
                $twitter=$line[33];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM Student WHERE email = '$email'";
                $prevResult = $db->query($prevQuery);
                $no='';
                if($prevResult->num_rows ==1){
                    // Update member data in the database
                   $update= $db->query("UPDATE Student SET id='$sid',stud_name = '$name',pass='$pass' ,contact = '$phone', curr_company = '$comp', curr_ctc = '$cctc',tech='$tech', modified_on = NOW(),is_active='$is_active', ug_college = '$ug_college', ug_degree = '$ug_degree',  ug_city = '$ug_city', ug_agg = '$ug_agg',ug_yoc='$ug_yoc',pg_college = '$pg_college', pg_degree = '$pg_degree',  pg_city = '$pg_city', pg_agg = '$pg_agg',pg_yoc='$pg_yoc',add_courses='$add_courses',total_exp = '$total_exp',prev_comp='$prev_companies',prev_comp_other='$prev_comp_other',expected_ctc = '$expected_ctc', preferred_loc = '$pre_loc' WHERE email = '$email'");
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
                    $insert=$db->query("INSERT INTO Student (id,stud_name, email, contact,pass,Alternate_emails,total_exp,curr_company,ctc_fixed,ctc_variable,curr_ctc,expected_ctc,designation,notice_period,curr_loc,preferred_loc,prev_comp,prev_comp_other,ug_college,ug_degree,pg_college,pg_degree,add_courses,resume,cv_parsed,ug_city,ug_agg,ug_yoc,pg_city,pg_agg,pg_yoc,linkedin,fb,twitter,is_active,turnup_rate,Offer_acceptance_rate,source,callers_comment,Uploaded_by,tech,updated_on, modified_on) VALUES ('$sid', '$name', '$email', '$phone', '$pass', '$additional_email','$total_exp', '$comp','$designation' ,'$ctc_fix','$ctc_variable','$cctc','$expected_ctc','$notice_period', '$curr_loc','$pre_loc','$prev_companies','$prev_comp_other','$ug_college', '$ug_degree','$pg_college', '$pg_degree','$add_courses','$resume', '$cv_parsed', '$ug_city', '$ug_agg', '$ug_yoc', '$pg_city', '$pg_agg', '$pg_yoc','$linkedin','$fb','$twitter','$is_active','$turnup_rate','$offer_acceptance_rate','$source','$callers_comment','$uploaded_by','$tech',NOW(), NOW()");
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
header("Location: ../candidates.php".$qstring);
?>