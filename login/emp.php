<?php
   include("../dbConfig.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['emailemp']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passwordemp']); 
      // $role=$_POST['role'];
    // print $myusername;
      // echo $role;
        
      // if($role=='admins'){

          $sql = "SELECT * FROM admins WHERE email = '$myusername' and password = '$mypassword'";
          $result = mysqli_query($db,$sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //   $active = $row['active'];
          
          $count = mysqli_num_rows($result);
          
          // If result matched $myusername and $mypassword, table row must be 1 row
        
          if($count == 1) {
          
              if($row['role']=='Main'){
                $_SESSION['emailemp'] = $row['email'];

                header("location: ../site/post-a-job.php");
              }
              else if($row['role']=='Level'){
                $_SESSION['emailemplevel'] = $row['email'];

                header("location: ../site/roleindex.php");
              }
              else if($row['role']=='Level2'){
                $_SESSION['emailemplevel2'] = $row['email'];

                header("location: ../site/role2index.php");
              }
              else if($row['role']=='DL'){
                   $_SESSION['emaildl'] = $row['email'];
                  // $_SESSION['coordinatoremp']=$row['email'];
                  header("location: ../site/loaders.php");
              }
               else if($row['role']=='am'){
                   $_SESSION['emailemp'] = $row['email'];
                  $_SESSION['coordinatoremp']=$row['email'];
                  header("location: ../site/coordinators/dashboard.php");
              }
                 else if($row['role']=='cc'){
                $_SESSION['emailemp'] = $row['email'];
                $_SESSION['ccemp']=$row['email'];
                header("location: ../site/cc/dashboard.php");
              }
              else {
                $_SESSION['email'.$row['role']]=$row['email'];
                $_SESSION['company'.$row['role']]=$row['company'];
            setcookie("job_status","open_job",time()+36000,'/');
                

                header("location: ../site/".$row['role']."/dashboard.php");
              }
              
            
          }else {
            $error = "Your Login Name or Password is invalid";
             header("location: ../index.php");
          }

      // }
      // else{

      //   $sql = "SELECT * FROM $role WHERE email = '$myusername' and password = '$mypassword'";
      //     $result = mysqli_query($db,$sql);
      //     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
          
      //     $count = mysqli_num_rows($result);
          
        
      //     if($count == 1) {

      //       if($role=='hr'){
      //         $_SESSION['companyhr']=$row['company'];
      //       }
      //       $_SESSION['email'.$role] = $row['email'];

      //           header("location: ../site/$role/dashboard.php");

      //     }
      //     else {
      //       $error = "Your Login Name or Password is invalid";
      //        header("location: ../index.php");
      //     }
        
      // }
    
   }
?>