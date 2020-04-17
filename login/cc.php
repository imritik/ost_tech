<?php
   include("../dbConfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['emailemp']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passwordemp']); 
    // print $myusername;
      
      $sql = "SELECT * FROM coordinators WHERE email = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //   $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
            $_SESSION['emailemp'] = $row['email'];
            $_SESSION['ccemp']=$row['email'];
            header("location: ../site/cc/dashboard.php");
          }
         
      else {
         $error = "Your Login Name or Password is invalid";
         header("location: ../index.php");
      }
    }
?>