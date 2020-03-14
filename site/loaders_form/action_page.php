<?php
session_start();
// error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emaildl'])){
    // echo $_SESSION['company'];
    // echo "hi";
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
include '../../dbConfig.php';
$siddforform= $_REQUEST['sidforform'];
// var_dump($_GET['sidforform']);
if ( isset($_GET['sidforform']) && count($_GET) > 1 ) {
    //do something if var and another parameter is given
    // var_dump("doing great!");
}

                // Get row data
                $sid   = $siddforform;
                $fid=$_POST['fname'];
                $name = $_POST['name'];
                $email  = $_POST['email'];
                $phone  = $_POST['contact'];
                $comp = $_POST['curr_comp'];
                // $cctc = $_POST['curr_ctc'];
                // $ctc_variable=$_POST['ctc_variable'];
                // $ctc_fixed=$_POST['ctc_fixed'];

                // $experience=$_POST['experience'];
                $designation=$_POST['designation'];
                // $curr_loc=$_POST['curr_loc'];
                $ug_college=$_POST['ug_college'];
                $ug_degree=$_POST['ug_degree'];
                // $ug_city=$_POST['ug_city'];
                // $ug_agg=$_POST['ug_per'];
                // $ug_yoc=$_POST['ug_yoc'];
                $pg_college=$_POST['pg_college'];
                $pg_degree=$_POST['pg_degree'];
                // $pg_city=$_POST['pg_city'];
                // $pg_agg=$_POST['pg_per'];
                // $pg_yoc=$_POST['pg_yoc'];
                // $add_courses=$_POST['add_courses'];
                $total_exp=$_POST['total_exp'];
                $alternate_emails=$_POST['alternate_emails'];
                $prev_companies=$_POST['prev_comp'];
                $prev_comp_other=$_POST['prev_comp_other'];

                // $linkedin=$_POST['linkedin'];
                // $fb=$_POST['fb'];
                // $twitter=$_POST['twitter'];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM Student WHERE student_id = $siddforform";
                $prevResult = $db->query($prevQuery);
                $no='';
              
                if($prevResult->num_rows ==1){
                    // Update member data in the database
                   $update= $db->query("UPDATE Student SET id='$fid',stud_name = '$name',contact = '$phone', curr_company = '$comp',designation='$designation', modified_on = NOW(), ug_college = '$ug_college', ug_degree = '$ug_degree', pg_college = '$pg_college', pg_degree = '$pg_degree',total_exp = '$total_exp',prev_comp='$prev_companies',prev_comp_other='$prev_comp_other',Alternate_emails='$alternate_emails' WHERE student_id = $sid");
                   if(!$update){
                    // echo "cantupdate";
                    $qstring = 'status=err';
                }
                else{
                    $qstring = 'status=succ';
                }
                }
                else{
                    // echo $sid,$sidd;
                    // echo "not fouund";
                    $qstring = 'status=err';
                }
header("Location:show_status.php?".$qstring);
?>