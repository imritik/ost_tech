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
$query = $db->query("SELECT * FROM employer_account");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Company_Name','Description' ,'Email','password','url','Account Manager', 'added_on');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        // $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array($row['company_name'], $row['description'], $row['email'], $row['pass'], $row['url'],$row['am'], $row['added_on']);
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