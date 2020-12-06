 <header>
        <div id="header-background"></div>
        <div class="container">
            <div class="pull-left">
             <b>HR<b> (<?php echo $hremail; ?>)
            </div>
            <div id="menu-open" class="pull-right">
               <a href="editjob.php" class="label label-success" style="font-size:inherit">Post a new job</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="../summary/summary_jobs.php">Summary</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="../add_admin.php">Add HR Manager(HR)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              
               <!-- <a href="../../logout/logout.php">Logout</a> -->

   <select class="label label-info" style="font-size: small;background: cadetblue;" onchange="location = this.value;">
   <option value="#">
               <a href="#">My Profile</a>
   
   </option>
    <option value="../../ChangePassword/setPassword.php">
               <a href="../../ChangePassword/setPassword.php">Change password</a>
   
   </option>
   <option value="../../logout/logout.php">
               <a href="../../logout/logout.php">Logout</a>
   
   </option>
   
   </select>



            </div>
            

        </div>
    </header>