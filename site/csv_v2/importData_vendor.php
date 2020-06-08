<?php
// Load the database configuration file
// var_dump($_COOKIE);
include_once 'dbConfig.php';
if(isset($_POST['importSubmit'])){
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            // Open uploaded CSV file with read-only mode

    $studlistobtain=$_COOKIE['sids'];
    $duplicatecandidates=array();
    $duplicatestatus=array();

            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            // Skip the first line
            fgetcsv($csvFile);
          // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $sid   = $line[0];
                $name = $line[1];
                $email  = $line[2];
                $pass = $line[4];
                $additional_email=$line[5];
                $phone  = $line[3];
                $total_exp=$line[6];

               
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
             
                $is_active=$line[34];
                $uploaded_by=$line[39];
               
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
            
                $prev_companies=$line[16];
                $prev_comp_other=$line[17];
                $linkedin=$line[31];
                $fb=$line[32];
                $twitter=$line[33];

                $cv_upload_date=$line[43];
                $latest_application_date=$line[44];
                $applied_for=$line[45];
                $applied_to=$line[46];
                $profile_segment=$line[47];


                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM Student WHERE (email = '$email' or contact='$phone' and stud_name='$name') and student_id in ($studlistobtain)";
                $prevResult = $db->query($prevQuery);
                $no='';

                // check name for probable duplicate
                  $nameQuery = "SELECT * FROM Student WHERE (stud_name='$name') and student_id in ($studlistobtain)";
                $nameResult = $db->query($nameQuery);

                // var_dump($prevQuery);
                // var_dump($prevResult);
                if($prevResult->num_rows >0){
                        
                        // echo "old";
                        while($row = $prevResult->fetch_assoc()){
                             array_push($duplicatecandidates,$row['student_id']);
                             array_push($duplicatestatus,"Duplicate");
                        }

                // if(!$update){
                    // echo "here";
                    // $qstring = '&status=err';/
                // }
                // else{
                    $qstring = '?status=succ';
                // }
                }




                else  if($nameResult->num_rows >0){
                        
                        // echo "old";
                        while($rowname = $nameResult->fetch_assoc()){
                             array_push($duplicatecandidates,$rowname['student_id']);
                             array_push($duplicatestatus,"Probable Duplicate");

                        }

                // if(!$update){
                    // echo "here";
                    // $qstring = '&status=err';/
                // }
                // else{
                    $qstring = '?status=succ';
                // }
                }
                



                else{
                    // Insert member data in the database
                    // $insert=$db->query("INSERT IGNORE INTO Student (id,stud_name, email, contact,pass,Alternate_emails,total_exp,curr_company,ctc_fixed,ctc_variable,curr_ctc,expected_ctc,designation,notice_period,curr_loc,preferred_loc,prev_comp,prev_comp_other,ug_college,ug_degree,pg_college,pg_degree,add_courses,resume,cv_parsed,ug_city,ug_agg,ug_yoc,pg_city,pg_agg,pg_yoc,linkedin,fb,twitter,is_active,turnup_rate,Offer_acceptance_rate,source,callers_comment,Uploaded_by,tech,updated_on, modified_on,cv_upload_date,latest_application_date,applied_for,applied_to,profile_segment) VALUES ('$sid','$name', '$email', '$phone', '$pass', '$additional_email','$total_exp', '$comp','$designation' ,'$ctc_fix','$ctc_variable','$cctc','$expected_ctc','$notice_period', '$curr_loc','$pre_loc','$prev_companies','$prev_comp_other','$ug_college', '$ug_degree','$pg_college', '$pg_degree','$add_courses','$resume', '$cv_parsed', '$ug_city', '$ug_agg', '$ug_yoc', '$pg_city', '$pg_agg', '$pg_yoc','$linkedin','$fb','$twitter','$is_active','$turnup_rate','$offer_acceptance_rate','$source','$callers_comment','$uploaded_by','$tech',NOW(), NOW(),'$cv_upload_date','$latest_application_date','$applied_for','$applied_to','$profile_segment')");
                    // if(!$insert){
                      
                        //echo "srry";
                        // $qstring = '?status=err';
                    // }
                    // else{
                        // echo "new";
                        
                        $qstring = '&status=succ';
                    // }
                
                }
            }
            // var_dump($duplicatecandidates);
            $duplicatecandidates=implode(",",$duplicatecandidates);
            $duplicatestatus=implode(",",$duplicatestatus);
            setcookie("vendorduplicate",$duplicatecandidates, time()+3600 , '/' );
            setcookie("duplicatestatus",$duplicatestatus,time()+3600,'/');
            // Close opened CSV file
            fclose($csvFile);
            
            // $qstring = '?status=succ';
        }else{
            // echo "here1";/
            $qstring = '&status=err';
        }
    }else{
        $qstring = '&status=invalid_file';
    }
}
// Redirect to the listing page
// 
header("Location:". $_SERVER['HTTP_REFERER'].$qstring);
?>