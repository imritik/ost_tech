<?php 
include '../dbConfig.php';
error_reporting(E_ALL & ~E_NOTICE);
session_start();

$vendoremail='';
$currpass='';
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
      $query = $db->query("SELECT * FROM admins WHERE email='$vendoremail'");

    if($query ->num_rows ==1){
        $row1 = $query->fetch_assoc();
        $currpass=$row1['password'];
    }

}
else{
    // make password form
}

?>
<head>
		<meta charset="utf-8">
		<title>Change Password</title>
	    <link href="../site/css/style.css" rel="stylesheet">
</head>
 <!-- ============ HEADER START ============ -->
 <header>
        <div id="header-background"></div>
        <div class="container">
        <div class="pull-left">
             <b>TalentChords</b>
            </div>
            <div id="menu-open" class="pull-right">
            <a onclick="redirect();">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       </div>
        </div>
    </header>

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
                                            
                                                data: {param1: '<?php echo $vendoremail;?>',param2:$('#det2').val()},
                                            
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
        function redirect(){
    console.log("here");
       var referringURL = document.referrer;
       var local = referringURL.substring(referringURL.indexOf("?"), referringURL.length);
       	var currentQueryString = window.location.search;
			if (currentQueryString) {
				// return true;
                console.log(true);
                var x=history.go(-1);
                console.log(x);
			} else {
			    // return false;
                console.log(false);
                    var x=history.go(-1);
                console.log(x);

			}
}
	</script>
