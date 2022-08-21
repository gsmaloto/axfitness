<?php
    include 'include/db.php';

    $appId = $_GET['appId'];




$query = "select * from `appoint` where appId='$appId'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
   $appId = $row['appId'];
    $clientId = $row['clientId'];
    $date = $row['date'];
    $time = $row['time'];
    $status = $row['status'];
}

$query1 = "select email from `client` where clientId='$clientId'";
$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result1)) {
    $email = $row['email'];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpMailer/vendor/autoload.php';


    if (isset($_POST['appointUpdate'])) {

        // $username = $_POST['username'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $status = $_POST['status'];


        mysqli_query($connection, "update `appoint` set status='$status' where appId='$appId'");

        
        $query = "select * from `appoint` where appId='$appId'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        while ($row = mysqli_fetch_array($result)) {
           $appId = $row['appId'];
            $clientId = $row['clientId'];
            $date = $row['date'];
            $time = $row['time'];
            $status = $row['status'];

        // $fromId = $_POST['clientId'];
        // $time = $_POST['time'];
        $message = "Your appointment in ".$date. " and time is ".$time." is ".$status;
      
        $query1 = "INSERT INTO `notif`(`fromId`, `message`) VALUES ('$clientId','$message')";
        mysqli_query($connection, $query1);

        $created = date('Y-m-d H:i:s');
        
        $query2 = "INSERT INTO `income`(`clientId`, `detail`, `payment`, `created`) VALUES ('$clientId','Session','70', '$created')";
        mysqli_query($connection, $query2);

       
        }
      

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
        $mail->Body    = "
         
                             <h3>Your appointment has been <b>$status</b>!</h3>
                             <label>    This email is to let you know that your appointment in AX Fitness 
                                        on <b>$date</b> and time <b>$time</b> is has been <b>$status</b>.</label>
                        
            


                        ";

        $mail->send();
         header('location:appointment.php');
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }



       
    }



    ?>


    <!DOCTYPE html>
    <html lang="en">


    <!-- Mirrored from spark.bootlab.io/dashboard-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Apr 2021 05:21:48 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

    <head>
        <?php include 'include/head.php'; ?>
    </head>



    <body>
        <div class="splash active">
            <div class="splash-icon"></div>
        </div>
        <div class="wrapper">

            <!-- side nav -->
            <?php include 'include/sideNav.php'; ?>
            <div class="main">
                <!-- topNav -->
                <?php include 'include/topNav.php'; ?>
                <main class="content">
                    <div class="container-fluid">

                        <!-- <div class="header">
                            <h1 class="header-title">
                                Validation
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Validation</li>
                                </ol>
                            </nav>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Appointment Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="appointmentUpdate.php?appId=<?php echo $appId; ?>" enctype="multipart/form-data">

                                            <div class="form-floating mb-3">
                                                <label for="inputPassword" name="password">Appointment ID</label>
                                                <input class="form-control" type="text" placeholder="Enter event title" value="<?php echo $appId; ?>" name="title" required readonly />
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="inputPassword" name="password">Client ID</label>
                                                <input class="form-control" type="text" value="<?php echo $clientId; ?>" name="email" required readonly/>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="inputPassword" name="password">Date</label>
                                                <input class="form-control" type="text" value="<?php echo $date; ?>" name="date" required readonly />
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="inputPassword" name="password">Time</label>
                                                <input class="form-control" type="text" value="<?php echo $time; ?>" name="time" required  readonly/>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="inputPassword" name="password">Status</label>
                                                <select class="form-control mb-3" name="status">
                                                    <?php
                                                    if ($status == 'approve') {
                                                        echo '
                                                            <option selected value="approve">approve</option>
                                                            <option value="cancel">cancel</option>
                                                            <option value="pending">pending</option>
                                                        ';
                                                    }
                                                    if($status == 'cancel') {
                                                        echo '
                                                            <option value="approve">approve</option>
                                                            <option selected value="cancel">cancel</option>
                                                            <option value="pending">pending</option>
                                                        ';
                                                    }if($status == 'pending'){
                                                        echo '
                                                            <option value="approve">approve</option>
                                                            <option value="cancel">cancel</option>
                                                            <option selected value="pending">pending</option>
                                                        ';

                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                             
                                            <div class="form-floating mb-3">
                                                <button type="submit" class="btn btn-success" name="appointUpdate">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-left">
							<ul class="list-inline">
							
							</ul>
						</div>
						<div class="col-4 text-right">
							<p class="mb-0">
								&copy; 2022 - <a href="https://www.facebook.com/AXgym/" class="text-muted">AX Fitness</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
            </div>

        </div>

        <svg width="0" height="0" style="position:absolute">
            <defs>
                <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
                    <path d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
                    </path>
                </symbol>
            </defs>
        </svg>
        <script src="js/app.js"></script>



<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Health Declaration Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <center><img src="<?php echo $pictures; ?>" width="100%" height="100%"></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    </body>



    </html>


    <!-- Button trigger modal -->
