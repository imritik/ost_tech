<span class="label label-primary" style="font-size: inherit;"><b>Manage</b>&nbsp;</span>&nbsp;&nbsp;
<input class="radio" type="radio" name="alg_Type" id="HP" value="job" onclick="location.href='dashboard.php'" <?php echo ($page == 'job') ? 'checked="checked"' : ''; ?> /> <label class="choice" for="HP">Jobs</label>
&nbsp;&nbsp;
<input class="radio" type="radio" name="alg_Type" id="HP" value="vendor" onclick="location.href='showvendors.php'" <?php echo ($page == 'vendor') ? 'checked="checked"' : ''; ?>/> <label class="choice" for="HP">Vendors</label>
&nbsp;&nbsp;
<input class="radio" type="radio" name="alg_Type" id="HP" value="manager" onclick="location.href='showmanagers.php'" <?php echo ($page == 'manager') ? 'checked="checked"' : ''; ?>/> <label class="choice" for="HP">Managers</label>
&nbsp;&nbsp;
<input class="radio" type="radio" name="alg_Type" id="HP" value="recruiter" onclick="location.href='showrecruiters.php'" <?php echo ($page == 'recruiter') ? 'checked="checked"' : ''; ?>/> <label class="choice" for="HP">Recruiters</label>
