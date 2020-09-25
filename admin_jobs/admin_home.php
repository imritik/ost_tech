
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  .middle{
  position: fixed;
    top: 50%;
    left: 50%;
    width: 30em;
    height: 18em;
    margin-top: -11em;
    margin-left: -15em;
  }
  body{
    background:cadetblue;
  }
  </style>
<div class="container">
<div class="col-md-6 middle">
<h2 class="text-center" style="color:white">Login</h2>

<form action="../login/emp.php" method="post">
                                    <div class="form-group">
                                    <!-- <select class="form-control" name="role">
                                    <option value="none" selected disabled hidden> 
                                        Select Role
                                    </option> 
                                    <option value="hr">HR</option>
                                    <option value="vendors">Vendor</option>
                                    <option value="admins">Main Admin</option>
                                    </select> -->
                                   </div>
                                   <div class="form-group">
                                       <input type="email" class="form-control" name="emailemp" placeholder="email" value="" required="required">
                                   </div>
                                   <div class="form-group">
                                       <input type="password" class="form-control" name="passwordemp" placeholder="Password" value="" required="required">
                                   </div>
                                   <input type="submit" class="btn btn-primary btn-block" value="Login">
                                   <div class="form-footer">
                                   </div>
                                   </form>
</div>
</div>