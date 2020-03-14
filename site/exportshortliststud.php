<?php
session_start();
include '../dbConfig.php';

if(isset($_SESSION['emailemp'])){
  }
  else{
    header("location: ../index.php");
  }
  
$studlist= $_SESSION['studlist'];
//get records from database

$arrlength = count($studlist);

$list=array();               
if(sizeof($studlist)){
  // $delimiter = ",";
  // $filename = "members_" . date('Y-m-d') . ".csv";
  
  // $f = fopen('php://memory', 'w');
  
  // $fields = array('ID#', 'Name', 'Address', 'College', 'College_location', 'Contact', 'Email', 'password', 'Company','CTC','Resume','Experience','Registered_on','Modified_on');
  // fputcsv($f, $fields, $delimiter);
$linerow=array('ID#','Name','address','college_id','College','Colleg_location','Contact','Email','Password','Company','CTC','Resume','Tech','cv_parsed','turnup_rate','job_seeker','Experience','Registered_on',"modified_on",'is_active','Uploaded_by','school_hsc','city_hsc','percent_hsc','yoc_hsc','school_ssc','city_ssc','percent_ssc','yoc_ssc','ug_college','ug_degree','ug_city','ug_agg','ug_yoc','pg_college','pg_degree','pg_city','pg_agg','pg_yoc','add_courses','expected_ctc','Pre_location','work_segment','industry','total_exp','func_seg','industries_worked','max_teamsize_handled','languages','prev_companies 1','prev_company_2','Linkedin');
array_push($list,$linerow);
  for($x = 0; $x < $arrlength; $x++) {
  
$query = $db->query("SELECT * FROM Student where student_id='$studlist[$x]'");

if($query->num_rows ==1){
    
    
    while($row = $query->fetch_assoc()){
      $resumelinks='http://talentchords.com/jobs/specialty/uploads/'.$studlist[$x].'/'.$row['resume'];
        $lineData = array($row['student_id'], $row['stud_name'], $row['address'],$row['college_id'], $row['college_name'], $row['college_location'], $row['contact'],  $row['email'],$row['pass'], $row['curr_company'], $row['curr_ctc'], $resumelinks,$row['tech'],$row['cv_parsed'] ,$row['turnup_rate'] ,$row['job_seeker'],$row['experience'],$row['updated_on'], $row['modified_on'],$row['is_active'],$row['Uploaded_by'],$row['school_hsc'],$row['city_hsc'],$row['percent_hsc'],$row['yoc_hsc'],$row['school_ssc'],$row['city_ssc'],$row['percent_ssc'],$row['yoc_ssc'],$row['ug_college'],$row['ug_degree'],$row['ug_city'],$row['ug_agg'],$row['ug_yoc'],$row['pg_college'],$row['pg_degree'],$row['pg_city'],$row['pg_agg'],$row['pg_yoc'],$row['add_courses'],$row['expected_ctc'],$row['preferred_loc'],$row['work_segment'],$row['industry'],$row['total_exp'],$row['func_seg'],$row['industries_worked'],$row['max_teamsize_handled'],$row['languages'],$row['prev_comp'],$row['prev_comp_other'],$row['linkedin']);
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

// exit;
}

?>