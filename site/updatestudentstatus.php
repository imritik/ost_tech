<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include '../dbConfig.php';
$posting_id=$_POST['param2'];
$stud_id=$_POST['param1'];
$stud_status=$_POST['param3'];
$stud_note=$_POST['param4'];
$ps1=$_POST['param5'];
$ps2=$_POST['param6'];
// var_dump($stud_status);
 // Insert image file name into database
//   $insert1 = $db->query("UPDATE Student SET profile_segment='$ps1',profile_segment2='$ps2', modified_on=NOW() WHERE student_id=$stud_id");
//   if($insert1){
//       $statusMsg = "Status updated";
//   }else{
//       $statusMsg = "Error while updating";
//   } 
  // Insert image file name into database
  if($stud_status=="am"){
        $insert = $db->query("UPDATE applied_table SET Note='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
        if($insert){
            // $statusMsg = "Status updated";
        }else{
            $statusMsg = "Error while updating";
        } 
  }
   if($stud_status=="hr"){
// var_dump("in hr");
        $insert = $db->query("UPDATE applied_table SET hr_note='$ps1',Status='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
    //    var_dump("UPDATE applied_table SET hr_note='$stud_note',Status='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");


                $prevQuery = "SELECT * FROM interaction_log WHERE posting_id = $posting_id and stud_id=$stud_id";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                     while($row = $prevResult->fetch_assoc()){
                         $feedback_unserialize=unserialize($row['hr']);
                        $feedbackstring=$ps1.'$'.$_SESSION['emailhr'].'$'.date("Y-m-d");
                        array_push($feedback_unserialize,$feedbackstring);
                        $feedback_string=serialize($feedback_unserialize);
                    $db->query("UPDATE IGNORE interaction_log SET hr='$feedback_string' WHERE posting_id = $posting_id and stud_id=$stud_id");

                     }
                // update

                }
                    else{
                        $feedback=array();
                        $feedbackstring=$ps1.'$'.$_SESSION['emailhr'].'$'.date("Y-m-d");
                        array_push($feedback,$feedbackstring);
                        $feedback_string=serialize($feedback);
                    $db->query("INSERT into interaction_log (posting_id,stud_id,hr) values('$posting_id','$stud_id','$feedback_string')");
                    }


        if($insert){
            // $statusMsg = "Status updated";
        }else{
            $statusMsg = "Error while updating";
        } 
  }


   if($stud_status=="manager"){
// var_dump("in hr");
        $insert = $db->query("UPDATE applied_table SET manager_note='$ps1',Status='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
    //    var_dump("UPDATE applied_table SET hr_note='$stud_note',Status='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");


                $prevQuery = "SELECT * FROM interaction_log WHERE posting_id = $posting_id and stud_id=$stud_id";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows >0){
                     while($row = $prevResult->fetch_assoc()){
                         $feedback_unserialize=unserialize($row['manager']);
                        $feedbackstring=$ps1.'$'.$_SESSION['emailmanager'].'$'.date("Y-m-d");
                        array_push($feedback_unserialize,$feedbackstring);
                        $feedback_string=serialize($feedback_unserialize);
                    $db->query("UPDATE IGNORE interaction_log SET manager='$feedback_string' WHERE posting_id = $posting_id and stud_id=$stud_id");

                     }
                // update

                }
                    else{
                        $feedback=array();
                        $feedbackstring=$ps1.'$'.$_SESSION['emailmanager'].'$'.date("Y-m-d");
                        array_push($feedback,$feedbackstring);
                        $feedback_string=serialize($feedback);
                    $db->query("INSERT into interaction_log (posting_id,stud_id,manager) values('$posting_id','$stud_id','$feedback_string')");
                    }


        if($insert){
            // $statusMsg = "Status updated";
        }else{
            $statusMsg = "Error while updating";
        } 
  }

  else{
            // $insert = $db->query("UPDATE applied_table SET Status='$stud_status',Note='$stud_note', Status_update=NOW() WHERE posting_id='$posting_id' and student_id='$stud_id'");
            // if($insert){
            //     // $statusMsg = "Status updated";
            // }else{
            //     $statusMsg = "Error while updating";
            // } 
  }
//   echo $statusMsg;
?>