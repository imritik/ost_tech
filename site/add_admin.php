<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_SESSION['emailhr'])||isset($_SESSION['emailemp'])|| isset($_SESSION['emailmanager'])||isset($_SESSION['coordinatoremp'])){
    // echo $_SESSION['company'];
  }
  else{
    // echo "alert('no session exist')";
    header("location: ../index.php");
  }
// $cname=$_SESSION['company'];
include '../dbConfig.php';
$curr_email='';
$curr_role='';

if(isset($_SESSION['coordinatoremp'])){
    $curr_role='am';
    $curr_email=$_SESSION['coordinatoremp'];

}
else if(isset($_SESSION['emailmanager'])){
     $curr_role='manager';
    $curr_email=$_SESSION['emailmanager'];

}
else if(isset($_SESSION['emailhr'])){
     $curr_role='hr';
    $curr_email=$_SESSION['emailhr'];
}

// var_dump($curr_email);
?>



<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Jobseek - Job Board Responsive HTML Template">
    <meta name="author" content="Coffeecream Themes, info@coffeecream.eu">
    <title>Job Board </title>
    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

   
    <!-- ============ HEADER START ============ -->

    <header>
        <div id="header-background"></div>
        <div class="container">
            <div class="pull-left">
                <div id="logo">
                    <a href="#"><img src="images/logo.png" alt="Jobseek - Job Board Responsive HTML Template" /></a>
                </div>
            </div>
            <div class="pull-right">
               <div id="menu-open" class="pull-right">

               <a onclick="redirect();">Home</a>
            </div>
            </div>
            

        </div>
    </header>

    <!-- ============ HEADER END ============ -->
<div id="wrapper" style="padding: 4%;height:500px;overflow:scroll">

<table align='center' cellspacing=2 cellpadding=5 id="data_table" border=1 class="table table-striped">
<!-- <tr>
<th>Name</th>
<th>Email</th>
<th>PAssword</th>
<th>Role</th> -->
<tr class="filters" style="background: white">

    <th><input type="text" class="form-control width-auto" placeholder="Name"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Email"></th>
    <th><input type="text" class="form-control width-auto" placeholder="Password" disabled></th>
   <th>Companies</th>
    <th>Contact</th>
    <th><input type="text" class="form-control width-auto" placeholder="Role" disabled></th>
</tr>
<!-- ---------- -->
                        
<?php

$sql="";
$curr_comp_list='';

$sql = "SELECT * FROM admins where managed_by='$curr_email'";
$result = $db->query($sql);

if ($result ->num_rows >0) {
   
    while($row1 = $result->fetch_assoc()) {
        ?>
        <tr id="<?php echo $row1["id"];?>" >
        
       
        <td  contenteditable="false"> <?php echo $row1["Full_name"];?></td>
        <td contenteditable="false"><?php echo $row1["email"];?></td>
        <td contenteditable="false"><?php echo $row1["password"];?></td>
   <td contenteditable="false" style="background:cadetblue;color:white">
       <!-- <select  class="multiselect" name="select[]" multiple="multiple"></select> -->
        <?php echo $row1['company']; ?>
        
        </td>

        <td contenteditable="false"><?php echo $row1["contact"];?></td>

        <td contenteditable="false">
            <select role='<?php echo $row1["role"];?>' value="<?php echo $row1['role'];?>" class="btn btn-success btn-sm role">
                <option value="<?php echo $curr_role; ?>"><?php echo $curr_role; ?></option>
            </select>
        </td>
       
       
        <td>
<!-- <button id="edit_button1" value="Edit" class="editbtn btn btn-info btn-sm">Edit</button> -->
<!-- <input type="button" id="save_button1" value="Save" class="save" onclick="save_row('1')"> -->
<!-- <input type="button" value="Delete" class="delete" onclick="delete_row('1')"> -->
</td>
<td>
<button id="edit_button2" value="Delete" class="deletebtn btn btn-info btn-sm">Delete</button>
<!-- <input type="button" id="save_button1" value="Save" class="save" onclick="save_row('1')"> -->
<!-- <input type="button" value="Delete" class="delete" onclick="delete_row('1')"> -->
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
<td style="background:cadetblue">
<select id="companies" class="multiselect" multiple="multiple">
</select>
</td>
<td><input type="text" id="new_contact"></td>
<td>
    <select id="new_role" class="btn btn-success btn-sm">
    <option value="<?php echo $curr_role; ?>"><?php echo $curr_role; ?></option>
    
 </select>
</td>
<td><input type="button" class="add btn btn-primary btn-sm" onclick="add_row();" value="Add Row"></td>
</tr>

</table>
</div>

</body>
</html>
<script>


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



function add_row()
{
 var new_name=document.getElementById("new_name").value;
 var new_country=document.getElementById("new_country").value;
 var new_age=document.getElementById("new_age").value;
 var new_companies=document.getElementById("companies").value;

 var new_role=document.getElementById("new_role").value;
 var new_contact=document.getElementById("new_contact").value;

<?php 
$checkhrsession=!isset($_SESSION['emailhr']);
// var_dump($checkhrsession);
?>

 if(typeof(new_companies)=='string' && <?php echo json_encode($checkhrsession); ?>){
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
newadmin.company=JSON.stringify(new_companies);

newadmin.role=new_role;
newadmin.managed_by='<?php echo $curr_email; ?>';
newadmin.contact=new_contact;

console.log(newadmin);

// ------ajax request to save new admin details-----

                             $.ajax({
                                url: 'saveunderadmins.php',
                                type: 'POST',
                            
                                data: {data:newadmin},
                            })
                            .done(function(response) {
                                alert(response);
                                location.reload();

                                //do something with the response
                                // $('#'+studid).html('<p style="color:white;background:forestgreen">Shorlisted</p>');
                               
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
              console.log($('#'+currentid+' td .role').val());

              if ($(this).html() == 'Edit') {
                  currentTD = $(this).parents('tr').find('td');
                  $.each(currentTD, function () {
                      $(this).prop('contenteditable', true)
                  });
              } else {
                 $.each(currentTD, function () {
                      $(this).prop('contenteditable', false);
                      admindata={}
                      admindata.name=currentTD[0]['innerHTML'];
                      admindata.email=currentTD[1]['innerHTML'];
                      admindata.password=currentTD[2]['innerHTML'];
                      admindata.role=$('#'+currentid+' td .role').val();
                      admindata.id=currentid;
                                            

                  
                  });
                  console.log(admindata);
                    //   -----ajax request to send and update new data-----


                             $.ajax({
                                url: 'saveadmin.php',
                                type: 'POST',
                            
                                data: {data:admindata},
                            })
                            .done(function(response) {
                                alert(response);
                                //do something with the response
                                // $('#'+studid).html('<p style="color:white;background:forestgreen">Shorlisted</p>');
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

            //   if ($(this).html() == 'Edit') {
            //       currentTD = $(this).parents('tr').find('td');
            //       $.each(currentTD, function () {
            //           $(this).prop('contenteditable', true)
            //       });
            //   } else {
                //  $.each(currentTD, function () {
                //       $(this).prop('contenteditable', false);
                //       admindata={}
                //       admindata.name=currentTD[0]['innerHTML'];
                //       admindata.email=currentTD[1]['innerHTML'];
                //       admindata.password=currentTD[2]['innerHTML'];
                //       admindata.role=$('#'+currentid+' td .role').val();
                //       admindata.id=currentid;
                                            

                  
                //   });
                //   console.log(admindata);
                    //   -----ajax request to send and update new data-----


                             $.ajax({
                                url: 'deleteadmin.php',
                                type: 'POST',
                            
                                data: {data:currentid},
                            })
                            .done(function(response) {
                                alert(response);
                                //do something with the response
                                // $('#'+studid).html('<p style="color:white;background:forestgreen">Shorlisted</p>');
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

     function FilterRow($input){
           console.log("in filter function",$input);
           $tobeshown=[];
        $visible_rows=[];

            if(!$input.length){
                var rows = $('.table tr');
                rows.show();
            }
        //    loop through the filters here
        for(var i = 0; i < $input.length; i++){
                inputContent = $input[i].val().toLowerCase(),
                // $panel = $input[i].parents('.filterable'),
                column = $('.filters th').index($input[i].parents('th')),
                $table = $('.table'),
                $rows = $table.find('tbody tr');
                // console.log($rows);
                if($visible_rows.length && inputContent!=''){
                    console.log("filtered rows here");
                    $rows=$visible_rows;
                    console.log($rows);
                }
                else{
                    // console.log("all rows here");
                }

                if(inputContent=='#'){
                    // console.log("blank search will be there");
                    var $filteredRows = $rows.filter(function() {
                            var value = $(this).find('td').eq(column).text().trim()!='';
                            return value === true;
                            // console.log(value);
                    });
                }
                else{
                            /* Dirtiest filter function ever ;) */
                            var $filteredRows = $rows.filter(function() {
                                            var value = $(this).find('td').eq(column).text().toLowerCase();
                                            return value.indexOf(inputContent) === -1;
                            });
                }
                    $rows.show();
                    $filteredRows.slice(1).hide();
                    $filteredRows=$filteredRows.slice(1);
                    console.log($filteredRows);
                    console.log($filteredRows.slice(1));


                    $tobeshown=$table.find('tbody tr:visible');
                            $visible_rows=$tobeshown;
                            console.log($visible_rows,"visible");

                    // ===--------------
                    console.log($filteredRows,"filtered");
        }
            }
    
    $('.filters input').keyup(function(e) {
        console.log(e);
            console.log($(this));
            var inputs = $(".filters input");
            var input_array=[];
            var $input = $(this);
        
            for(var i = 0; i < inputs.length; i++){
                // alert($(inputs[i]).val());
                if($(inputs[i]).val()!=''){
                    input_array.push($(inputs[i]));
                    //  FilterRow($(inputs[i]));
                }
                else{
                        //  var $input = $(this);
                        // FilterRow($input);
                }
            }
                console.log(input_array);
            var code = e.keyCode || e.which;
            if (code == '9') return;
            FilterRow(input_array);
            // getVisibleRows();
        });
    
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

$sqlcomp = "SELECT * FROM admins where email='$curr_email'and role='$curr_role'";
$resultcomp = $db->query($sqlcomp);

if ($resultcomp ->num_rows ==1) {
   
    while($rowcomp = $resultcomp->fetch_assoc()) {
        // var_dump($rowcomp);
        if($curr_role=='manager'||$curr_role=='hr'){
             array_push($companies,$rowcomp['company']);

        }
        else{
            $companies=json_decode(stripslashes($rowcomp['company']));

        }
        // array_push($companies_name,$rowcomp['company_name']);
// var_dump($companies);
    }
}


    ?>
  var name =<?php echo json_encode($companies) ?>;
  $.map(name, function (x) {
      console.log(x);
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

