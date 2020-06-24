<?php 
session_start();
include '../../dbConfig.php';
$hrcompany=$_SESSION['companyhr'];
$adminid=$_POST['data'];

 $prevQuery = "SELECT * FROM coordinators WHERE id = $adminid";
 $prevResult = $db->query($prevQuery);
 
    if($prevResult->num_rows >0){
    while($row1 = $prevResult->fetch_assoc()) {

         $companies=json_decode(stripslashes($row1['companies']));
         $index = array_search($hrcompany,$companies);
            if($index !== FALSE){
                unset($companies[$index]);
                $newcomp=json_encode($companies);
                 $db->query("UPDATE IGNORE coordinators SET companies='$newcomp' WHERE id = $adminid");
                echo "Deleted";
            }
    
        // Update member data in the database
        }
    }
    else{
        echo "Unable to delete";
        }

//   echo $statusMsg;
?>