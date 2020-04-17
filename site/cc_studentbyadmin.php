<?php 
session_start();
include '../dbConfig.php';
$cname=$_POST['param1'];

$list=array();
$list_final=array();

// List students

// -----get students id forwarded 

                    // List Users
            $query1 = "SELECT * FROM to_admin where recieved_email='$cname'";
            if (!$result1 = mysqli_query($db, $query1)) {
                exit(mysqli_error($db));
            }
            // $studids=array();
            // $jobid=array();
            // $studstatuss=array();
            
            if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $data1=json_decode(stripslashes($row1['stud_id']));
            // var_dump($data);
                                foreach($data1 as $d){
                                    array_push($list,$d);
                } 
            }
        }

      
        echo json_encode($list);
?>