<?php
session_start();
   include("../dbConfig.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['emailstud']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passwordstud']); 

      // echo $myusername,$mypassword;
      
      $sql = "SELECT * FROM Student WHERE email = '$myusername' and pass = '$mypassword' and status!='pending'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //   $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      // echo $count;
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        //  session_register("myusername");
         $_SESSION['emailstud'] = $row['email'];
         $_SESSION['stud_id'] = $row['student_id'];
         $_SESSION['stud_name']=$row['stud_name'];
         $cnfemail=$row['email'];
         $cnfid=$row['student_id'];

          if($row['first_login']==0){
            header("location: ../firstauth.php");
          }
          else{

        // -----updating last login activity-----
                $sql1 = "UPDATE Student SET last_activity=NOW() WHERE email = '$cnfemail' and student_id = '$cnfid'";
                $result1 = mysqli_query($db,$sql1);
        //  echo $_SESSION['company'];

                //  echo "logged in";
                if($result1){
                  header("location: ../specialty/index.php");

                }
                else{
                  echo "unable to make connection with server!";
                }
          }
      }else {
         $error = "Your Login Name or Password is invalid";
         header("location: ../index.php");
      }
   }
?>