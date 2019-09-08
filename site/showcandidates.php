<?php
// echo $_REQUEST['jid'];
$jidd=$_REQUEST['jid'];

include '../dbConfig.php';

?>
<?php
// List Users
$query = "SELECT * FROM applied_table where posting_id=$jidd";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}
$studids=array();

 
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($studids,$row['student_id']);
    }

    // $number = 1;
    // $users = '<table class="table table-bordered">
    //     <tr>
    //         <th>No.</th>
    //         <th>First Name</th>
    //         <th>Last Name</th>
    //         <th>Email</th>
    //     </tr>
    // ';
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $users .= '<tr>
    //         <td>'.$number.'</td>
    //         <td>'.$row['first_name'].'</td>
    //         <td>'.$row['last_name'].'</td>
    //         <td>'.$row['email'].'</td>
    //     </tr>';
    //     $number++;
    // }
    // $users .= '</table>';
    
}


if(sizeof($studids)){

    $arrlength = count($studids);

    for($x = 0; $x < $arrlength; $x++) {
    

    // Get images from the database
    $query = $db->query("SELECT * FROM Student WHERE student_id='$studids[$x]'");

    $number = 1;
    $users = '<table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>College</th>
            <th>contact</th>
            <th>Address</th>
        </tr>
    ';

    if($query ->num_rows ==1){
        $row1 = $query->fetch_assoc();
        // echo $row1;

       
    // while ($row = mysqli_fetch_assoc($result)) {
        $users .= '<tr>
            <td>'.$number.'</td>
            <td>'.$row1['stud_name'].'</td>
            <td>'.$row1['email'].'</td>
            <td>'.$row1['college_name'].'</td>
            <td>'.$row1['contact'].'</td>
            <td>'.$row1['address'].'</td>


        </tr>';
        $number++;
    // }
    $users .= '</table>';
    }}}
    else{
        $users='No Student found!';
    }
       ?>
 
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <!--  Header  -->
    <div class="row">
        <div class="col-md-12">
        
        </div>
    </div>
    <!--  /Header  -->
 <br>
    <!--  Content   -->
    <div class="alert alert-info text-center"><?php echo sizeof($studids); ?> Student(s) Applied</div>
    <div class="form-group">
        <?php echo $users ?>
    </div>
    <div class="form-group">
        <button onclick="exportTableToCSV('candidates.csv')" class="btn btn-primary">Export to CSV File</button>
    </div>
    <!--  /Content   -->
 
    <script>
       


function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++) 
                    row.push(cols[j].innerText);
                
                csv.push(row.join(","));        
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }
    </script>
</div>
</body>
</html>
