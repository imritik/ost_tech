<?php

require_once './config.php';
if (isset($_POST["sub"])) {
  // require_once "phpmailer/class.phpmailer.php";

  $name = trim($_POST["uname"]);
  $pass = trim($_POST["pass1"]);
  $email = trim($_POST["uemail"]);
  $sql = "SELECT COUNT(*) AS count from Student where email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      $msg = "Email already exist";
      $msgType = "warning";
    } else {
      $sql = "INSERT INTO `Student` (`stud_name`, `pass`, `email`) VALUES " . "( :name, :pass, :email)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":pass",$pass);
      $stmt->bindValue(":email", $email);
      $stmt->execute();
      $result = $stmt->rowCount();


      if ($result > 0) {
       
        $lastID = $DB->lastInsertId();

        $message = '<html><head>
                <title>Email Verification</title>
                </head>
                <body>';
        $message .= '<h1>Hi ' . $name . '!</h1>';
        $message .= '<p><a href="'.SITE_URL.'activate.php?id=' . base64_encode($lastID) . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
        $message .= "</body></html>";
        

        // php mailer code starts
        // $mail = new PHPMailer(true);
        // $mail->IsSMTP(); // telling the class to use SMTP

        // $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        // $mail->SMTPAuth = true;                  // enable SMTP authentication
        // $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        // $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        // $mail->Port = 587;                   // set the SMTP port for the GMAIL server

        // $mail->Username = 'rritikverma@gmail.com';
        // $mail->Password = 'siddarth21';

        // $mail->SetFrom('rritikverma@gmail.com', 'Ritik verma');
        // $mail->AddAddress($email);

        // $mail->Subject = trim("Email Verifcation - talent");
        // $mail->MsgHTML($message);
  mail($email,"My subject",$message);
            if(mail($email,"My subject",$message)){
              $msg = "An email has been sent for verfication.";
        $msgType = "success";
              
            }
            else{
        $msg = "Failed to send mail";
        $msgType = "warning";

            }
        // try {
        //   $mail->send();
        //   $msg = "An email has been sent for verfication.";
        //   $msgType = "success";
        // } catch (Exception $ex) {
        //   $msg = $ex->getMessage();
        //   $msgType = "warning";
        // }
      } else {
        $msg = "Failed to create User";
        $msgType = "warning";
      }
    }
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}

include './header.php';
?>
<?php if ($msg <> "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>
<div class="container">
  <div class="row"style="margin-left: 30%;
    text-align: center;">
    <div class="col-lg-6">
      <div class="well contact-form-container">
        <form class="form-horizontal contactform" action="index.php" method="post" name="f" onsubmit="return validateForm();">
          <fieldset>
            <div class="form-group">
              <label class="col-lg-12 control-label" for="uname">Name:
                <input type="text" placeholder="Your Name" id="uname" class="form-control" name="uname">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="uemail">Email:
                <input type="text" placeholder="Your Email" id="uemail" class="form-control" name="uemail">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Password:
                <input type="password" placeholder="Password" id="pass1" class="form-control" name="pass1">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1">Confirm Password:
                <input type="password" placeholder="Password" id="pass2" class="form-control" name="pass2">
              </label>
            </div>

            <div style="height: 10px;clear: both"></div>

            <div class="form-group">
              <div class="col-lg-10">
                <button class="btn btn-primary" type="submit" name="sub">Submit</button> 
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function validateForm() {

    var your_name = $.trim($("#uname").val());
    var your_email = $.trim($("#uemail").val());
    var pass1 = $.trim($("#pass1").val());
    var pass2 = $.trim($("#pass2").val());


    // validate name
    if (your_name == "") {
      alert("Enter your name.");
      $("#uname").focus();
      return false;
    } else if (your_name.length < 3) {
      alert("Name must be atleast 3 character.");
      $("#uname").focus();
      return false;
    }

    // validate email
    if (!isValidEmail(your_email)) {
      alert("Enter valid email.");
      $("#uemail").focus();
      return false;
    }

    // validate subject
    if (pass1 == "") {
      alert("Enter password");
      $("#pass1").focus();
      return false;
    } else if (pass1.length < 6) {
      alert("Password must be atleast 6 character.");
      $("#pass1").focus();
      return false;
    }

    if (pass1 != pass2) {
      alert("Password does not matched.");
      $("#pass2").focus();
      return false;
    }

    return true;
  }

  function isValidEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }


</script>

<?php
include './footer.php';
?>