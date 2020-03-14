<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<?php
// Load the database configuration file
include_once 'dbConfig.php';

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
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
<div class="container">
<div class="row">
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Upload CSV</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
    <br>
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <br>
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
        <br>
    </div>

    <!-- Data list table --> 
    <!-- <table class="table table-striped table-bordered">
    <br>
        <thead class="thead-dark">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>College #ID</th>
                <th>College Name</th>
                <th>College Location</th>
                <th>Pass</th>
                <th>Curr_company</th>
                <th>Curr_CTC</th>
                <th>Resume</th>
                <th>Experience</th>
                <th>uploaded_on</th>
                <th>Modified_on</th>
                 <th>Status</th> 
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $db->query("SELECT * FROM Student ORDER BY email DESC");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['stud_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['college_id']; ?></td>
                <td><?php echo $row['college_name']; ?></td>
                <td><?php echo $row['college_location']; ?></td>

                <td><?php echo $row['pass']; ?></td>
                <td><?php echo $row['curr_company']; ?></td>
                <td><?php echo $row['curr_ctc']; ?></td>
                <td><?php echo $row['resume']; ?></td>
                <td><?php echo $row['experience']; ?></td>
                <td><?php echo $row['updated_on']; ?></td>
                <td><?php echo $row['modified_on']; ?></td>  
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="5">No member(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div> -->

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>