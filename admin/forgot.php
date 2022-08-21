
<?php
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: indexMember.php");
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpMailer/vendor/autoload.php';

include 'include/db.php';
$msg = "";

if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $code = mysqli_real_escape_string($connection, md5(rand()));

    if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM client WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($connection, "UPDATE client SET code='{$code}' WHERE email='{$email}'");

        if ($query) {        
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
                $mail->Body    = 'Here is the password reset link <b><a href="http://localhost//axfits/axfit/admin/changePassword.php?reset='.$code.'">Click this to reset your password</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
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

   }
</style>
</head>

<body>
   
    <!-- About Us Start-->
    <div>
        <div class="container-fluid pt-5">
            <div class="section-header">
              
            </div>
<br><br>
            <div class="row d-flex justify-content-center">

                <div class="bg-white col-md-4 about-col">
                    <div class="about-content">
                        <!-- <i class="fa fa-bullseye"></i> -->
                        <h2 class="pt-3 text-dark">Forgot your password?</h2>
                        <?php echo $msg; ?>
                        <form action="" method="POST" data-toggle="validator">
                            <div class="mb-3">
                              <div class="form-group">
                                <label class="text-dark">Email</label>
                                <input type="email" class="form-control mb-0" name="email" data-error="Invalid email." placeholder="Enter Email" required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
         
                    <div class="form-floating mb-3">
                        <button type="submit" class="btn btn-success btn-block" name="reset">Send Link</button>
                    </div>
  
                    <div class="form-floating mb-3 text-right">
                        <a class="small" href="index.php">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
<!-- About Us End-->
<br><br><br><br><br>
</body>
</html>
