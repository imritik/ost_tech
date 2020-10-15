<head>
		<meta charset="utf-8">
		<title>Change Password</title>
	    <link href="../site/css/style.css" rel="stylesheet">

</head>
<?php 
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
session_start();

$vendoremail='';
 if(isset($_SESSION['emailvendors'])){
     $vendoremail=$_SESSION['emailvendors'];
 }
 else  if(isset($_SESSION['ccemp'])){
     $vendoremail=$_SESSION['ccemp'];

 }
 else  if(isset($_SESSION['coordinatoremp'])){
     $vendoremail=$_SESSION['coordinatoremp'];

 }
 else if(isset($_SESSION['emailhr'])){
     $vendoremail=$_SESSION['emailhr'];
 }

 else if(isset($_SESSION['emailmanager'])){
     $vendoremail=$_SESSION['emailmanager'];
 } 
 else if(isset($_SESSION['emailrecruiters'])){
     $vendoremail=$_SESSION['emailrecruiters'];
 } 

 else if(isset($_GET['email'])){
    $vendoremail=$_GET['email'];
 }
 else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
if($vendoremail!=''){
    // change password form and fetch old password here
}
else{
    // make password form
}

?>

<div  id="text">
        <div  style="padding:20px">
        <?php 

if($vendoremail!=''){
    // change password form
?>
 <div >
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                 <h4 class="text-center" id="myModalLabel">Change Password  &nbsp;(<?php echo $vendoremail ;?>)</h4>

            </div>
            <hr>
   <?php
}
else{
    ?>

 <div >
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                 <h4 class="text-center">Set Password &nbsp;(<?php echo $vendoremail ;?>)</h4>

            </div>
  <hr>
   <?php
}
?>
           
            <div class="col-md-6 col-md-offset-3" style="text-align:center" >
            <form >
            <?php
            if($vendoremail!=''){
?>
  <label for=""> OLD PASSWORD</label>
            <input class="form-control" id="det1" type="password" required>

            <?php
            }
            else{

            }
          ?>
          <br>
           <label for="">NEW PASSWORD</label> 
            <input class="form-control" id="det2" type="password" required>
            
            
            <br>
            <br>
            
                <button  type="button" class="btn editbtn btn-primary" onclick="updatepassword();">Change Password</button>
            
            </form>
            </div>
        </div>
    </div>

    <script>
    		function updatepassword(){
                if(isset($_GET['email'])){
                    // no need of old password

                      $.ajax({
                                                url: 'updatepassafteredit.php',
                                                type: 'POST',
                                            
                                                data: {param1: <?php echo $vendoremail;?>,param2:$('#det2').val()},
                                            
                                            })
                                            .done(function(response) {
                                    alert(response);
                                    off();
                                            });

                }
                else{


                    if($('#det1').val()=='<?php echo $currpass;?>'){
                                $.ajax({
                                                url: 'updatepassafteredit.php',
                                                type: 'POST',
                                            
                                                data: {param1: '<?php echo $vendoremail;?>',param2:$('#det2').val()},
                                            
                                            })
                                            .done(function(response) {
                                    alert(response);
                                    off();
                                            });

                            }
                            else{
                                alert("Can't update password!");
                            }
                }

		
		}
	</script>
