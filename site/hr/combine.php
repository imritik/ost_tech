<?php 
session_start();

if(isset($_SESSION['emailhr']) || isset($_SESSION['emailemp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';

$jobid=$_GET['job'];
$emails_array=$_POST['param1'];
$emails=implode(", ", $emails_array);

$insert1 = $db->query("Select * from Student WHERE email IN ($emails) ORDER BY updated_on LIMIT 1");


 if($insert1 ->num_rows >0){
            while($row = $insert1->fetch_assoc()){

              $oldemail=$row['email'];
              $studid=$row['student_id'];
              $encode_emails=json_encode($emails_array);

              $addemails=$db->query("UPDATE IGNORE Student SET Alternate_emails=$encode_emails,modified_on=NOW() WHERE email='$oldemail'");

              $emails_to_delete=array_diff($emails_array,["'".$oldemail."'"]);
        
             
             
              $emails_to_delete=implode(", ", $emails_to_delete);
              $deleteother=$db->query("DELETE FROM Student where email IN ($emails_to_delete) ");
           

              $remove_probable=$db->query("UPDATE IGNORE applied_table SET duplicate_status='' where posting_id='$jobid' and student_id='$studid'");
            
              if($addemails && $deleteother && $remove_probable){
                echo "done";
              }
              else{
                echo "try again later";
              }
          
            }
          }

?>