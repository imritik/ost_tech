<?php
$conn = mysqli_connect("localhost", "root", "", "job");

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into Student (student_id,stud_name,address,college_id,college_name,contact,email,pass,curr_company,curr_ctc,resume,experience,updated_on,is_active)
                   values (' $column[0] ',' $column[1] ',' $column[2] ',' $column[3] ',' $column[4] ',' $column[5] ',' $column[6] ',' $column[7] ',' $column[8] ',' $column[9] ',' $column[10] ',' $column[11] ',' $column[12] ',' $column[13] ')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
	font-family: Arial;
	width: 550px;
}

.outer-scontainer {
	/* background: #F0F0F0; */
	border: #e0dfdf 1px solid;
	padding: 20px;
	border-radius: 2px;
}

.input-row {
	margin-top: 0px;
	margin-bottom: 20px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
	color: #f0f0f0;
	font-size: 0.9em;
	width: 100px;
	border-radius: 2px;
	cursor: pointer;
}

.outer-scontainer table {
	border-collapse: collapse;
	width: 100%;
}

.outer-scontainer th {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.outer-scontainer td {
	border: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file</h2>
    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer" style="width:max-content">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-12 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM Student";
            $result = mysqli_query($conn, $sqlSelect);
            
            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Address</th>
                    <th>college_id</th>
                    <th>college_name</th>
                    <th>contact</th>
                    <th>email</th>
                    <th>password</th>
                    <th>current_company</th>
                    <th>current_ctc</th>
                    <th>resume</th>
                    <th>experience</th>
                    <th>updated_on</th>
                    <th>is_active</th>


                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['student_id']; ?></td>
                    <td><?php  echo $row['stud_name']; ?></td>
                    <td><?php  echo $row['address']; ?></td>
                    <td><?php  echo $row['college_id']; ?></td>
                    <td><?php  echo $row['college_name']; ?></td>
                    <td><?php  echo $row['contact']; ?></td>
                    <td><?php  echo $row['email']; ?></td>
                    <td><?php  echo $row['pass']; ?></td>
                    <td><?php  echo $row['curr_company']; ?></td>
                    <td><?php  echo $row['curr_ctc']; ?></td>
                    <td><?php  echo $row['resume']; ?></td>
                    <td><?php  echo $row['experience']; ?></td>
                    <td><?php  echo $row['updated_on']; ?></td>
                    <td><?php  echo $row['is_active']; ?></td>










                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>