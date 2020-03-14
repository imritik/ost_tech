<?php 
session_start();
include '../dbConfig.php';
$cname=$_POST['param1'];

$list=array();
$list_final=array();

// List students
$query = "SELECT * FROM Student where Uploaded_by='$cname' and is_authorised=0";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}
 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($list,$row['student_id']);
       
    } 
    // echo json_encode($list);
}

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

        if(sizeof($list)){
            $arrlen=count($list);
            // echo $arrlen;
            // echo $studlistobtain[1];
                for($x=0;$x<$arrlen;$x++){
         // Insert image file name into database
        //  $insert = $db->query("UPDATE Student SET is_authorised=0 where student_id=$data1[$x]");
$query2 = "SELECT * FROM Student where student_id=$list[$x] and is_authorised=0";
if (!$result2 = mysqli_query($db, $query2)) {
    exit(mysqli_error($db));
}
 
if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        array_push($list_final,$row2['student_id']);
       
    } 
    // echo json_encode($list);
}
        }
        } 
        echo json_encode($list_final);
?>