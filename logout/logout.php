<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: admin_jobs/admin_home.php");
   }
?>