<?php
   include("../dbConfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['emailemp']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passwordemp']); 
      
      $sql = "SELECT * FROM employer_account WHERE email = '$myusername' and pass = '$mypassword' and is_active=1";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //   $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        //  session_register("myusername");
         $_SESSION['company'] = $row['company_name'];
         $_SESSION['emailemp'] = $row['email'];
         $_SESSION['url']=$row['url'];

        //  echo $_SESSION['company'];

        //  echo "logged in";

         
         header("location: ../site/post-a-job.php");
      }else {
         $error = "Your Login Name or Password is invalid";
         header("location: ../index.php");
      }
   }
?>