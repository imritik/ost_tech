<?php
session_start();
include '../dbConfig.php';
$studlist=$_SESSION['studemails'];
// var_dump($studlist);

$arrlength = count($studlist);

$list=array();               
if(sizeof($studlist)){
  // $delimiter = ",";
  // $filename = "members_" . date('Y-m-d') . ".csv";
  
  // $f = fopen('php://memory', 'w');
  
  // $fields = array('ID#', 'Name', 'Address', 'College', 'College_location', 'Contact', 'Email', 'password', 'Company','CTC','Resume','total_exp','Registered_on','Modified_on');
  // fputcsv($f, $fields, $delimiter);
$linerow=array('id','stud_name', 'email', 'contact','pass','Alternate_emails','total_exp','curr_company','ctc_fixed','ctc_variable','curr_ctc','expected_ctc','designation','notice_period','curr_loc','preferred_loc','prev_comp','prev_comp_other','ug_college','ug_degree','pg_college','pg_degree','add_courses','resume','cv_parsed','ug_city','ug_agg','ug_yoc','pg_city','pg_agg','pg_yoc','linkedin','fb','twitter','is_active','turnup_rate','Shared_acceptance_rate','source','callers_comment','Uploaded_by','tech','Account Creation', 'Last_update','CV_upload_date','Latest_application_date','Applied_for','Applied_to','Profile_segment');
array_push($list,$linerow);
  for($x = 0; $x < $arrlength; $x++) {
  
$query = $db->query("SELECT * FROM Student where email='$studlist[$x]'");

if($query->num_rows ==1){
    
    
    while($row = $query->fetch_assoc()){
      $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studlist[$x].'/'.$row['resume'];
        $lineData = array($row['student_id'], $row['stud_name'], $row['email'],$row['contact'], $row['pass'],$row['Alternate_emails'],$row['total_exp'],$row['curr_company'], $row['ctc_fixed'],$row['ctc_variable'],$row['curr_ctc'],$row['expected_ctc'],$row['designation'],$row['notice_period'],$row['curr_loc'],$row['preferred_loc'],$row['prev_comp'],$row['prev_comp_other'],$row['ug_college'],$row['ug_degree'],$row['pg_college'],$row['pg_degree'],$row['add_courses'],$resumelinks,$row['cv_parsed'] ,$row['ug_city'],$row['ug_agg'],$row['ug_yoc'],$row['pg_city'],$row['pg_agg'],$row['pg_yoc'],$row['linkedin'],$row['fb'],$row['twitter'],$row['is_active'],$row['turnup_rate'],$row['Shared_acceptance_rate'],$row['source'],$row['callers_comment'],$row['Uploaded_by'],$row['tech'],$row['updated_on'], $row['modified_on'],$row['cv_upload_date'],$row['latest_application_date'],$row['applied_for'],$row['applied_to'],$row['profile_segment']);
//         fputcsv($f, $lineData, $delimiter);
array_push($list,$lineData);
    }
    
//     fseek($f, 0);
    
//     header('Content-Type: text/csv');
//     header('Content-Disposition: attachment; filename="' . $filename . '";');
    
// fpassthru($f);

}

  }

  // var_dump($list);

$file = fopen('php://memory', 'w');

foreach ($list as $line) {
  fputcsv($file, $line);
}
fseek($file, 0);
// tell the browser it's going to be a csv file
header('Content-Type: text/csv');
// tell the browser we want to save it instead of displaying it
header('Content-Disposition: attachment; filename="truelist.csv";');
// make php send the generated csv lines to the browser
fpassthru($file);

// var_dump($file);
// exit;
}

?>