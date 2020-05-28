<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailemp'])){
  }
  else{
    header("location: ../index.php");
  }
include '../dbConfig.php';
include 'partials/header.php';
?>

<div id="wrapper" style="height:auto">
<table id="data_table" border=1 class="table table-striped">
<tr>
<th>Name</th>
<th>Email</th>
<th>Password</th>
<th>Companies</th>
<th>Contact</th>
<th>Role</th>

</tr>
<!-- ---------- -->
                        
<?php

$sql="";

$sql = "SELECT * FROM coordinators";
$result = $db->query($sql);

if ($result ->num_rows >0) {
   
    while($row1 = $result->fetch_assoc()) {
        ?>
        <tr id="<?php echo $row1["id"];?>" >
        
       
        <td  contenteditable="false"> <?php echo $row1["name"];?></td>
        <td contenteditable="false"><?php echo $row1["email"];?></td>
        <td contenteditable="false"><?php echo $row1["password"];?></td>
        <td contenteditable="false" style="background:cadetblue">
       <select  class="multiselect" name="select[]" multiple="multiple"></select>
        </td>

        <td contenteditable="false"><?php echo $row1["contact"];?></td>


        <td contenteditable="false"><select role='<?php echo $row1["is_manager"];?>' value="<?php echo $row1['is_manager'];?>" class="btn btn-success btn-sm role"><option value="1"<?php if ($row1['is_manager'] == '1')  echo 'selected = "selected"'; ?>>Accout Manager</option><option value="0"<?php if ($row1['is_manager'] == '0')  echo 'selected = "selected"'; ?>>Coordinator</option></select></td>
       
       
        <td>
<button id="edit_button1" value="Edit" class="editbtn btn btn-info btn-sm">Edit</button>

</td>
<td>
<button id="edit_button2" value="Delete" class="deletebtn btn btn-info btn-sm">Delete</button>
</td>
        </tr>

     <?php   
    }
} else {
    echo "0 results";
}

?>


<!-- ------------------- -->

<tr>
<td><input type="text" id="new_name"></td>
<td><input type="email" id="new_country"></td>
<td><input type="text" id="new_age"></td>
<td style="background:cadetblue"><select id="companies" class="multiselect" multiple="multiple"></select></td>
<td><input type="text" id="new_contact"></td>
<td><select id="new_role" class="btn btn-success btn-sm"><option value="1">Account Manager</option><option value="0">Coordinator</option></select></td>
<td><input type="button" class="add btn btn-primary btn-sm" onclick="add_row();" value="Add Row"></td>
</tr>

</table>
</div>

</body>
</html>
<script>



function add_row()
{
 var new_name=document.getElementById("new_name").value;
 var new_country=document.getElementById("new_country").value;
 var new_age=document.getElementById("new_age").value;
 var new_companies=document.getElementById("companies").value;
 var new_role=document.getElementById("new_role").value;
 var new_contact=document.getElementById("new_contact").value;

if(typeof(new_companies)=='string'){
 new_companies = [new_companies];
}
if(new_country=='' || new_name=='' || new_age=='' || new_role==''){
    alert("fill details correctly");
}
else{
newadmin={}
newadmin.name=new_name;
newadmin.email=new_country;
newadmin.password=new_age;
newadmin.role=new_role;
newadmin.company=JSON.stringify(new_companies);
newadmin.contact=new_contact;

console.log(newadmin);

// ------ajax request to save new admin details-----

                             $.ajax({
                                url: 'saveam.php',
                                type: 'POST',
                            
                                data: {data:newadmin},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                            })
                            .fail(function() {
                                alert("error in saving");
                            });
}

}

$('.editbtn').click(function () {

              var currentTD = $(this).parents('tr').find('td');
              console.log(currentTD);
              var currentid=$(this).parents('tr').prop('id');
              console.log($(this).parents('tr').prop('id'));
              console.log($('#'+currentid+' td .multiselect').val());
              console.log($('#'+currentid+' td .role').val());

              if ($(this).html() == 'Edit') {
                  currentTD = $(this).parents('tr').find('td');
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', true)
                  });
              } 
              else {
                 $.each(currentTD, function () {
                      $(this).prop('contenteditable', false);
                      admindata={}
                      admindata.name=currentTD[0]['innerHTML'];
                      admindata.email=currentTD[1]['innerHTML'];
                      admindata.password=currentTD[2]['innerHTML'];
                      admindata.company=JSON.stringify($('#'+currentid+' td .multiselect').val());
                      admindata.contact=currentTD[4]['innerHTML'];
                      admindata.role=$('#'+currentid+' td .role').val();
                      admindata.id=currentid;
                  });

                  console.log(admindata);

                    //   -----ajax request to send and update new data-----
                             $.ajax({
                                url: 'saveam.php',
                                type: 'POST',
                            
                                data: {data:admindata},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("error in saving");
                            });


                    // ----------------------------------

              }
    
              $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
    
          });






        //   -----------------delete admin-------------------
        $('.deletebtn').click(function () {
              var currentTD = $(this).parents('tr').find('td');
              console.log(currentTD);
              var currentid=$(this).parents('tr').prop('id');
              console.log($(this).parents('tr').prop('id'));
              console.log($('#'+currentid+' td .role').val());

                    //   -----ajax request to send and update new data-----


                             $.ajax({
                                url: 'deleteam.php',
                                type: 'POST',
                            
                                data: {data:currentid},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();
                               
                            })
                            .fail(function() {
                                alert("error in saving");
                            });


                    // ----------------------------------

            //   }
    
            //   $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
    
          });

        //   -----------------------------------------------------
    
    </script>

  
    <!-- Modernizr Plugin -->
    <script src="js/modernizr.custom.79639.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.2.min.js"></script>

    <!-- Bootstrap Plugins -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Retina Plugin -->
    <script src="js/retina.min.js"></script>

    <!-- ScrollReveal Plugin -->
    <script src="js/scrollReveal.min.js"></script>

    <!-- Flex Menu Plugin -->
    <script src="js/jquery.flexmenu.js"></script>

    <!-- Slider Plugin -->
    <script src="js/jquery.ba-cond.min.js"></script>
    <script src="js/jquery.slitslider.js"></script>

    <!-- Carousel Plugin -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Parallax Plugin -->
    <script src="js/parallax.js"></script>

    <!-- Counterup Plugin -->
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>

    <!-- No UI Slider Plugin -->
    <script src="js/jquery.nouislider.all.min.js"></script>

    <!-- Bootstrap Wysiwyg Plugin -->
    <script src="js/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- Flickr Plugin -->
    <script src="js/jflickrfeed.min.js"></script>

    <!-- Fancybox Plugin -->
    <script src="js/fancybox.pack.js"></script>

    <!-- Magic Form Processing -->
    <script src="js/magic.js"></script>

    <!-- jQuery Settings -->
    <script src="js/settings.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js" integrity="sha256-qoj3D1oB1r2TAdqKTYuWObh01rIVC1Gmw9vWp1+q5xw=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" integrity="sha256-7stu7f6AB+1rx5IqD8I+XuIcK4gSnpeGeSjqsODU+Rk=" crossorigin="anonymous" />

<script>
// ----multiselect part----

$(function() {
    <?php
    $companies=array();
    // $companies_name=array();
    // gathering companies

$sqlcomp = "SELECT * FROM employer_account";
$resultcomp = $db->query($sqlcomp);

if ($resultcomp ->num_rows >0) {
   
    while($rowcomp = $resultcomp->fetch_assoc()) {
        array_push($companies,$rowcomp['email']);
        // array_push($companies_name,$rowcomp['company_name']);

    }
}


    ?>
  var name =<?php echo json_encode($companies) ?>;
  $.map(name, function (x) {
    return $('.multiselect').append("<option>" + x + "</option>");
  });
  
  $('.multiselect')
    .multiselect({
      allSelectedText: 'All',
      maxHeight: 200,
      includeSelectAllOption: true
    })
    .multiselect('selectAll', false)
    .multiselect('updateButtonText');

    // checkSelection(name);

});

// function checkSelection(available,name){
//     console.log("in check func",available,name);
// }
</script>
