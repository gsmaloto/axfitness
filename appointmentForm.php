<?php
session_start();

include 'include/db.php';


if(empty($_SESSION['clientId']) || $_SESSION['clientId'] == ''){
    header("Location:login.php");
}

$date = '';

if (isset($_GET['date'])) {
  $date = $_GET['date'];
}

$msg = '';
if (isset($_POST['confirm'])) {

  $clientId = $_POST['clientId'];
  $q1 = $_POST['q1'];
  $q2 = $_POST['q2'];
  $q3 = $_POST['q3'];
  $q4 = $_POST['q4'];
  $q5 = $_POST['q5'];

   $code = md5(mt_rand(111111, 999999));
  $clientId  = $_POST['clientId'];
  $date = $_POST['date'];
  $time   = $_POST['time'];
  $created = date("Y-m-d H:i:s");


  $query = "INSERT INTO `healthdeclaration`(`clientId`, `q1`, `q2`, `q3`, `q4`, `q5`) 
  VALUES ('$clientId','$q1','$q2','$q3','$q4','$q5')";
  mysqli_query($connection, $query);

$sql = "INSERT INTO `appoint` (`code`, `clientId`, `date`, `time`, `status`,`created`) 
  VALUES ('$code','$clientId', '$date','$time', 'pending', '$created')";

  mysqli_query($connection, $sql);


  $message = "New appointment in ".$date. " and time is ".$time.".";
      
        $query1 = "INSERT INTO `notif`(`fromId`, `message`) VALUES ('0','$message')";
        mysqli_query($connection, $query1);

  header('location: appointment.php');
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
/*radio button(payment)*/
.radio-toolbar {
    margin: 10px;
  }

  .radio-toolbar input[type="radio"] {
    opacity: 0;
    position: fixed;
    width: 0;
  }

  .radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 10px 20px;
    font-family: sans-serif, Arial;
    font-size: 16px;
    border: 2px solid #444;
    border-radius: 4px;
  }

  .radio-toolbar label:hover {
    background-color: #dfd;
  }

  .radio-toolbar input[type="radio"]:focus + label {
    border: 2px dashed #444;
  }

  .radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
  }



 </style>
</head>

<body>
  <?php include 'include/nav.php' ?>

  
  <?php 
  $query = "SELECT * FROM client where clientId='$_SESSION[clientId]'";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  while ($row = mysqli_fetch_array($result)) {
    $clientId = $row['clientId'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $contact = $row['contactNo'];
  }
  ?>


  <!-- About Us Start-->
  <div>
    <div class="container-fluid pt-5">
      <div class="section-header">

      </div>
      <br><br>
      <div class="row d-flex justify-content-center">

        <div class="bg-white col-md-7 about-col">
          <div class="about-content">
            <h2 class="py-3 text-dark">Appointment Details</h2>
            <form method="post" action="" data-toggle="validator">
              <div class="form-group">
                <div class="mb-3">
                  <label class="text-dark">Date: <?php echo $date ?></label>
                  <input type="hidden" class="form-control" value="<?php echo $date ?>" name="date">
                </div>
                <div class="mb-3">
                  <label class="text-dark">Time</label>
                  <select class="form-control mb-3" name="time" required data-error="Please choose time">

                    <option value="" selected disabled>Choose</option>

                    <?php

                    $query = "SELECT max FROM webDetail where id ='1'";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

                    while ($row = mysqli_fetch_assoc($result)) {

                      $max = (int)$row['max'];


                      $resultAm = mysqli_query($connection, "SELECT COUNT(*) AS `am` FROM `appoint` where date = '$date' and time = 'am' and status !='cancel'");
                      $row = mysqli_fetch_array($resultAm);
                      $am = $row['am'];

                      $resultPm = mysqli_query($connection, "SELECT COUNT(*) AS `pm` FROM `appoint` where date = '$date' and time = 'pm' and status !='cancel'");
                      $row = mysqli_fetch_array($resultPm);
                      $pm = $row['pm'];


                      if ($am < $max) {
                        echo '

                        <option value"am">AM</option>
                        ';
                      }

                      if ($pm < $max) {
                        echo '
                        <option value"pm">PM</option>';

                      }
                    }

                    ?>
                  </select>
                  <div class="help-block with-errors text-danger"></div>
                </div>
                <!-- <div class="mb-3">
                  <label class="text-dark">Mode of Payment</label>
                  <div class="radio-toolbar">
                    <input type="radio" id="radioApple" name="payment" value="Gcash" required data-error="Please choose Mode of payment">
                    <label class="" for="radioApple">Gcash</label>

                    <input type="radio" id="radioBanana" name="payment" value="Cash" required >
                    <label for="radioBanana">Cash</label>
                  </div>
                  <div class="help-block with-errors text-danger"></div>  
                </div> -->
              


                <h2 class="py-3 text-dark">Health Declaration Form</h2>
                <p class="mb-1">Name: <?php echo $firstName.' '.$lastName; ?></p>
                <p class="mb-1">Contact Number: <?php echo $contact; ?></p>
                <p class="mb-1">Email: <?php echo $email; ?></p>
                <input type="hidden" name="clientId" value="<?php echo $clientId; ?>" />

                <hr class="my-">

                <!-- question 1 -->
                <div class="row">
                  <div class="col-10">
                    <div class="mb-3">
                        <p>1. Have you experienced cough, fever, sore throat, Body pains, shortness of breath, Diarrhea, Loss of taste or smell, Difficulty of breathing, Fatigue/Tiredness in the last 24 hours?</p>
                    </div>
                  </div>
                  <div class="col">
                   <div class="mb-3">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="y1" name="q1" value="Yes" required  data-error="Answer required!">
                        <label class="custom-control-label text-dark" for="y1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="n1" name="q1" value="No" required>
                        <label class="custom-control-label text-dark" for="n1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</label>
                      </div>
                      <small class="help-block with-errors text-danger"></small>
                    </div>
                  </div>
                </div>
              </div>

              <!-- question 2 -->
              <div class="row">
                <div class="col-10">
                  <div class="mb-3">
                      <p>2. Have you recently been tested for COVID-19 or been in contact with a suspected or COVID-19 positive individual (in the last two weeks)?</p>
                  </div>
                </div>
                <div class="col">
                 <div class="mb-3">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" id="y2" name="q2" value="Yes"required  data-error="Answer required!">
                      <label class="custom-control-label text-dark" for="y2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" id="n2" name="q2" value="No" required  data-error="Answer required!">
                      <label class="custom-control-label text-dark" for="n2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</label>
                    </div>
                    <small class="help-block with-errors text-danger"></small>
                </div>
              </div>
            </div>

            <!-- question 3 -->
            <div class="row">
              <div class="col-10">
                <div class="mb-3">
                    <p>3. Have you provided direct care for a patient with probable or confirmed COVID-19 case
                    without using proper "Personal Protective Equipment (PPE)" for the past 14 days?</p>
                </div>
              </div>
              <div class="col">
               <div class="mb-3">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="y3" name="q3" value="Yes" required  data-error="Answer required!">
                    <label class="custom-control-label text-dark" for="y3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="n3" name="q3" value="No" required  data-error="Answer required!">
                    <label class="custom-control-label text-dark" for="n3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</label>
                  </div>
                  <small class="help-block with-errors text-danger"></small>
              </div>
            </div>
          </div>

          <!-- question 4 -->
          <div class="row">
            <div class="col-10">
              <div class="mb-3">
                 <p>4. Have you traveled outside the Philippines in the last 14 days?</p>
             </div>
           </div>
           <div class="col">
             <div class="mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="y4" name="q4" value="Yes" required  data-error="Answer required!">
                  <label class="custom-control-label text-dark" for="y4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="n4" name="q4" value="No" required  data-error="Answer required!">
                  <label class="custom-control-label text-dark" for="n4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</label>
                </div>
                <small class="help-block with-errors text-danger"></small>
            </div>
          </div>
        </div>

        <!-- question 5 -->
        <div class="row container">
          <div class="mb-3">
             <p class="mb-0">5. Have you traveled outside the current city/municipality where you reside? If yes, specify which city/municipality
             you went to?</p>
             <input type="password" class="form-control mb-0" name="q5" placeholder="If yes, what city/municipality? ">
         </div>
       </div>

       <button type="submit" class="btn btn-primary my-3" name="confirm">Confirm</button>
       <div class="form-floating mb-3">
        <a class="small float-right" href="appointment.php">Back to Calendar</a>
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
