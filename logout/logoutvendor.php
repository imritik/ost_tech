<?php
   session_start();
   
   if(session_destroy()) {
    setcookie("vendorduplicate", "", time() - 3600);
    setcookie("sids", "", time() - 3600);

      header("Location: ../admin_jobs/vendors/login.php");
   }
?>