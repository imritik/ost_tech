<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emaildl'])){
    // echo $_SESSION['company'];
    // echo "hi";
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../../index.php");
  }
include '../../dbConfig.php';
$jidd=$_REQUEST['jid'];
  ?>
    <!DOCTYPE html>
    <html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            background-color: #f1f1f1;
        }
        
        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            font-family: Raleway;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }
        
        h1 {
            text-align: center;
        }
        
        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }
        /* Mark input boxes that gets an error on validation: */
        
        input.invalid {
            background-color: #ffdddd;
        }
        /* Hide all steps by default: */
        
        .tab {
            display: none;
        }
        
        button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }
        
        button:hover {
            opacity: 0.8;
        }
        
        #prevBtn {
            background-color: #bbbbbb;
        }
        /* Make circles that indicate the steps of the form: */
        
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }
        
        .step.active {
            opacity: 1;
        }
        /* Mark the steps that are finished and valid: */
        
        .step.finish {
            background-color: #4CAF50;
        }
    </style>

    <body>
    <?php


// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

// Get  from the database
$query = $db->query("SELECT * FROM Student WHERE student_id='$jidd'");

if($query ->num_rows ==1){
    $row1 = $query->fetch_assoc();
    // $currpass=$row1['pass'];
   ?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
        <form id="regForm" action="action_page.php?sidforform='<?php echo $jidd; ?>'" method='POST'>
            <h1>Student Profile:</h1>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">
                <!-- <p><input placeholder="ID..." value="<?php echo $row1['id']; ?>"  oninput="this.className = ''" name="fname"></p> -->
                <p><input placeholder="Full name..." value="<?php echo $row1['stud_name']; ?>" oninput="this.className = ''" name="name"></p>
       
                <p><input placeholder="email..." oninput="this.className = ''" value="<?php echo $row1['email']; ?>" name="email" type='email'></p>
                <p><input placeholder="Alternate Emails..." oninput="this.className = ''" value="<?php echo $row1['Alternate_emails']; ?>" name="alternate_emails"></p>
                <p><input placeholder="contact..." value="<?php echo $row1['contact']; ?>" oninput="this.className = ''" name="contact" type="tel"></p>
                <p><input placeholder="total_experience" oninput="this.className = ''" value="<?php echo $row1['total_exp']; ?>" name="total_exp"></p>

                <p><input placeholder="curr_company..." oninput="this.className = ''"value="<?php echo $row1['curr_company']; ?>" name="curr_comp"></p>
                <!-- <p><input placeholder="curr_ctc..." oninput="this.className = ''" value="<?php echo $row1['curr_ctc']; ?>" name="curr_ctc"></p>
                <p><input placeholder="variable ctc..." oninput="this.className = ''" value="<?php echo $row1['curr_variable']; ?>" name="ctc_variable"></p>
                <p><input placeholder="Fixed ctc..." oninput="this.className = ''" value="<?php echo $row1['curr_fixed']; ?>" name="ctc_fixed"></p>                -->
                <!-- <p><input placeholder="Experience..." oninput="this.className = ''" value="<?php echo $row1['experience']; ?>" name="experience"></p> -->
                <p><input placeholder="Designation..." oninput="this.className = ''" value="<?php echo $row1['designation']; ?>" name="designation"></p>
                <!-- <p><input placeholder="curr_location..." oninput="this.className = ''" value="<?php echo $row1['curr_loc']; ?>" name="curr_loc"></p> -->

            </div>
            <div class="tab">Education:
              
                <p><input placeholder="ug_college..." oninput="this.className = ''"value="<?php echo $row1['ug_college']; ?>" name="ug_college"></p>
                <p><input placeholder="ug_degree..." oninput="this.className = ''" value="<?php echo $row1['ug_degree']; ?>" name="ug_degree"></p>
                <!-- <p><input placeholder="ug_city..." oninput="this.className = ''"value="<?php echo $row1['ug_city']; ?>" name="ug_city"></p> -->
                <!-- <p><input placeholder="ug_percent..." oninput="this.className = ''"value="<?php echo $row1['ug_agg']; ?>" name="ug_per"></p> -->
                <!-- <p><input placeholder="ug_yoc..." oninput="this.className = ''" value="<?php echo $row1['ug_yoc']; ?>" name="ug_yoc"></p> -->
                <p><input placeholder="pg_college..." oninput="this.className = ''" value="<?php echo $row1['pg_college']; ?>" name="pg_college"></p>
                <p><input placeholder="pg_degree..." oninput="this.className = ''" value="<?php echo $row1['pg_degree']; ?>" name="pg_degree"></p>
                <p><input placeholder="previous_company 1" oninput="this.className = ''" value="<?php echo $row1['prev_comp']; ?>" name="prev_comp"></p> 
               <p><input placeholder="previous_company 2" oninput="this.className = ''" value="<?php echo $row1['prev_comp_other']; ?>" name="prev_comp_other"></p> 
               
                <!-- <p><input placeholder="pg_city..." oninput="this.className = ''" value="<?php echo $row1['pg_city']; ?>" name="pg_city"></p>
                <p><input placeholder="pg_percent..." oninput="this.className = ''" value="<?php echo $row1['pg_agg']; ?>" name="pg_per"></p>
                <p><input placeholder="pg_yoc..." oninput="this.className = ''" value="<?php echo $row1['pg_yoc']; ?>" name="pg_yoc"></p> -->
                <!-- <p><input placeholder="additional_certifications..." oninput="this.className = ''" value="<?php echo $row1['add_courses']; ?>" name="add_courses"></p> -->

            </div>

            <!-- <div class="tab">Prefrences: -->

          
              
               <!-- <p><input placeholder="linkedin..." oninput="this.className = ''"value="<?php echo $row1['linkedin']; ?>" name="linkedin"></p>
               <p><input placeholder="Facebook..." oninput="this.className = ''" value="<?php echo $row1['fb']; ?>" name="fb"></p>
               <p><input placeholder="Twitter..." oninput="this.className = ''" value="<?php echo $row1['twitter']; ?>" name="twitter"></p> -->


            <!-- </div> -->

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <button type="submit" id="final_submit" onclick="finalsubmit()" style='display:none'>Submit</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <!-- <span class="step"></span> -->
            </div>
        </form>
        <?php 
}
?>
        <script>
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
                // This function will display the specified tab of the form...
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                //... and fix the Previous/Next buttons:
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    // document.getElementById("nextBtn").innerHTML = "Submit";
                    // document.getElementById("nextBtn").type = "submit";
                    document.getElementById("nextBtn").style.display = "none";

                    document.getElementById("final_submit").style.display = "inline";

                } else {
                    document.getElementById("nextBtn").style.display = "block";
                    document.getElementById("final_submit").style.display = "none";

                    document.getElementById("nextBtn").innerHTML = "Next";
                }
                //... and run a function that will display the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(n) {
            
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                console.log(x.length);
                // Exit the function if any field in the current tab is invalid:
                if (n == 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                console.log(currentTab);

                console.log("lenght",x.length);
                // if you have reached the end of the form...
                if (currentTab >=x.length) {
                    // ... the form gets submitted:
                    // document.getElementById("regForm").submit();
                    // return false;
                    console.log("to be submitted");
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    // if (y[i].value == "") {
                    //     // add an "invalid" class to the field:
                    //     y[i].className += " invalid";
                    //     // and set the current valid status to false
                    //     valid = false;
                    // }
                }
                // If the valid status is true, mark the step as finished and valid:
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid; // return the valid status
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class on the current step:
                x[n].className += " active";
            }
            function finalsubmit(){
                document.getElementById("regForm").submit();
            }
        </script>

    </body>

    </html>