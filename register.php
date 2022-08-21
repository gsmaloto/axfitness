<?php


include 'include/db.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: index.php");
  die();
}

//Load Composer's autoloader
require 'phpMailer/vendor/autoload.php';

$msg = "";

if (isset($_POST['register'])) {
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, md5($_POST['password']));
  $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($connection,$_POST['lastName']);
  $gender = mysqli_real_escape_string($connection, $_POST['gender']);
  $contactNo = mysqli_real_escape_string($connection, $_POST['contactNo']);
  $address = mysqli_real_escape_string($connection, $_POST['address']);
  

  $code = mysqli_real_escape_string($connection, md5(rand()));

  if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM client WHERE email='{$email}'")) > 0) {
    $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
  } else {

    $sql = "INSERT INTO client (username, email, password, firstName, lastName, gender, address, contactNo, code) VALUES ('{$username}', '{$email}', '{$password}', '{$firstName}','{$lastName}','{$gender}','{$address}', '{$contactNo}', '{$code}')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
      echo "<div style='display: none;'>";
      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'lokoberto7@gmail.com';                     //SMTP username
        $mail->Password   = 'Gsmaloto1_';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('lokoberto7@gmail.com', 'AX Fitness');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'no reply';
        $mail->Body    = 'Here is the verification link <b><a href="http://localhost/axfits/axfit/login.php?verification=' . $code . '">Click Here!</a></b>';

        $mail->send();
        echo 'Message has been sent';
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      echo "</div>";
      $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
    } else {
      $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
 <?php include 'include/head.php' ?>

 <style>
   body{
     /* The image used */
     background-image: url("img/outside.jpg");

     /* Full height */
     height: 100%;

     /* Center and scale the image nicely */
     background-position: center;
     background-repeat: no-repeat;
     background-size: cover;
     overflow:scroll;

   }
 </style>
</head>

<body>
  <?php include 'include/nav.php' ?>


  <!-- About Us Start-->
  <div>
    <div class="container-fluid pt-5">
      <div class="section-header">

      </div>
      <br><br>
      <div class="row d-flex justify-content-center">

        <div class="bg-white col-md-7 about-col">
          <div class="about-content">
            <!-- <i class="fa fa-bullseye"></i> -->
            <h2 class="py-3 text-dark">Register Your Account</h2>
            <?php echo $msg; ?>
            <form action="" method="POST" data-toggle="validator">

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <div class="form-group">
                      <label class="text-dark">First Name</label>
                      <input type="text" class="form-control mb-0" name="firstName" data-minlength="3" data-error="Have atleast 3 characters" placeholder="Enter First Name" required>
                      <div class="help-block with-errors text-danger"></div>
                    </div>
                  </div>
                </div>
               
              <div class="col">
               <div class="mb-3">
                <div class="form-group">
                  <label class="text-dark">Last Name</label>
                  <input type="text" class="form-control mb-0" name="lastName" data-minlength="3" data-error="Have atleast 3 characters" placeholder="Enter Last Name" required>
                  <div class="help-block with-errors text-danger"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <div class="form-group">
                  <label class="text-dark">Username</label>
                  <input type="text" class="form-control mb-0" name="username" maxlength="12" minlength="3" data-minlength="6" data-error="Have atleast 6 characters" placeholder="Enter Username" required>
                  <div class="help-block with-errors text-danger"></div>
                </div>
              </div>
            </div>
            <div class="col">

              <div class="mb-3">
                <div class="form-group">
                  <label class="text-dark">Password</label>
                  <input type="password" class="form-control mb-0" name="password" id="password" data-minlength="6" data-error="Have atleast 6 characters" placeholder="Enter Password" required>
                  <div class="help-block with-errors text-danger"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
             <div class="mb-3">
              <div class="form-group">
                <label class="text-dark">Email</label>
                <input type="email" class="form-control mb-0" name="email" data-error="Invalid email." placeholder="Enter Email" required>
                <div class="help-block with-errors text-danger"></div>
              </div>
            </div>
          </div>
          <div class="col">
           <div class="mb-3">
            <div class="form-group">
              <label class="text-dark">Confirm Password</label>
              <input type="password" class="form-control mb-0" name="password" data-match="#password" data-match-error="Password don't match" placeholder="Enter Confirm Password" required>
              <div class="help-block with-errors text-danger"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
         <div class="mb-3">
          <div class="form-group">
            <label class="text-dark">Contact Number</label>
            <input type="text" class="form-control mb-0" name="contactNo" data-error="You must have a Contact Number." maxlength="11" placeholder="09xxxxxxxxx" required>
            <div class="help-block with-errors text-danger"></div>
          </div>
        </div>
      </div>
      <div class="col">
       <div class="mb-3">
        <div class="form-group">
          <label class="text-dark">Gender</label>

          <select class="browser-default custom-select" name="gender" data-error="You must have a gender." required>
            <option disabled selected value="">Choose</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <div class="help-block with-errors text-danger"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-4">
      <div class="mb-3">
        <div class="form-group">
          <label class="text-dark">Birthday</label>
          <input type="date" class="form-control mb-0" name="address" data-error="You must have a Address." placeholder="Enter Address" required>
          <div class="help-block with-errors text-danger"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="mb-3">
        <div class="form-group">
          <label class="text-dark">Address</label>
          <input type="text" class="form-control mb-0" name="address" data-error="You must have a Address." placeholder="Enter Address" required>
          <div class="help-block with-errors text-danger"></div>
        </div>
      </div>
    </div>
  </div>

  

  <div class="form-group col-md-12">
    <button type="submit" class="btn btn-success btn-block align-items-center" name="register">Register</button>
  </div>
  <div class="form-floating mb-3 text-right">
    <a class="small" href="login.php">You have an account?</a>
  </div>
</div>





</form>
</div>
</div>

</div>
</div>
</div>




<!-- About Us End-->
<br><br><br><br><br>
<?php include 'include/footer.php'; ?>
</body>
</html>
