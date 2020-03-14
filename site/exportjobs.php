<?php
session_start();
include '../dbConfig.php';
// $_SESSION['email']="ritikvverma@gmail.com";
// $_SESSION['company']="XYZ";
// $_SESSION['url']="abc.com";
if(isset($_SESSION['emailemp'])){
  }
  else{
    header("location: ../index.php");
  }
  

//get records from database
$query = $db->query("SELECT * FROM Job_Posting");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Job_ID', 'Company_Name', 'Email', 'Job_title', 'Job_type', 'Job_location', 'Job_description', 'url', 'Posting_time');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        // $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array($row['posting_id'], $row['company_name'], $row['email'], $row['job_title'], $row['Job_type'], $row['Job_location'],  $row['job_description'],$row['company_url'], $row['posting_time']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>