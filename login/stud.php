<?php
   include("../dbConfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['emailstud']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passwordstud']); 
      
      $sql = "SELECT * FROM Student WHERE email = '$myusername' and pass = '$mypassword' and is_active=1";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //   $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        //  session_register("myusername");
         $_SESSION['emailstud'] = $row['email'];
         $_SESSION['stud_id'] = $row['student_id'];
         $_SESSION['stud_name']=$row['stud_name'];

        //  echo $_SESSION['company'];

        //  echo "logged in";

         
         header("location: ../specialty/index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
         header("location: ../index.php");
      }
   }
?>