<?php
session_start();
if (empty($_SESSION['clientId']) || $_SESSION['clientId'] == '') {
  header("Location:login.php");
  die();
}


include 'include/db.php';


if (isset($_POST['confirm'])) {
  $clientId = $_SESSION['clientId'];
  $civil = $_POST['civil'];
  $occupation = $_POST['occupation'];
  $eContactName = $_POST['eContactName'];
  $eContactNum = $_POST['eContactNum'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $expired = date('Y-m-d', strtotime('+1 years'));

  $query = "INSERT INTO `membership`(`clientId`, `civil`, `occupation`, `eContactName`, `eContactNum`, `height`, `weight`, `expired`) VALUES 
                                    ('$clientId','$civil','$occupation','$eContactName','$eContactNum','$height','$weight','$expired')";
  mysqli_query($connection, $query);

  header('location: membership.php');
}







?>



<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'include/head.php' ?>

  <style>
    body {
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
  <?php include 'include/nav.php' ?>


  <!-- About Us Start-->
  <div>
    <div class="container-fluid pt-5">
      <div class="section-header">

      </div>
      <br><br>

      <?php

      $query = "SELECT * FROM client where clientId='$_SESSION[clientId]'";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      while ($row = mysqli_fetch_array($result)) {
        $clientId = $row['clientId'];
        $username = $row['username'];
        $password = $row['password'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $gender = $row['gender'];
        $contactNo = $row['contactNo'];
        $picture = $row['picture'];
        $address = $row['address'];
      }

      ?>




      <div class="row d-flex justify-content-center">

        <div class="bg-white col-md-7 about-col">
          <div class="about-content">

            <?php
            $query = "SELECT * FROM membership where clientId= '$_SESSION[clientId]'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) == 1) {
              while ($row = mysqli_fetch_assoc($result)) {
                if($row['status'] == 'p'){
                  echo '<h1>Youre membership is pending</h1>';
                }else{
      
                  echo '<h1>You are already a member</h1>
                  <h4>Your Membership expiration date is '.$row['expired'].'</h4>
                  ';
                
                }
               
            ?>
            
            
              
            <?php
              }
            } else {

            ?>

              <h2 class="py-3 text-dark">Membership Details</h2>
              <!-- <?php echo $msg; ?> -->
              <form method="post" action="" data-toggle="validator">

                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">First Name</label>
                        <input type="text" class="form-control mb-0" name="firstName" data-minlength="3" data-error="Have atleast 3 characters" placeholder="Enter Last Name" required value="<?php echo $firstName; ?>">
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col">
                  <div class="mb-3">
                    <div class="form-group">
                      <label class="text-dark">Middle Name</label>
                      <input type="text" class="form-control mb-0" name="lastName" data-minlength="3" data-error="Have atleast 3 characters" placeholder="Enter Last Name" required>
                      <div class="help-block with-errors text-danger"></div>
                    </div>
                  </div>
                </div> -->
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Last Name</label>
                        <input type="text" class="form-control mb-0" name="lastName" data-minlength="3" data-error="Have atleast 3 characters" placeholder="Enter Last Name" required value="<?php echo $lastName; ?>">
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
                        <input type="text" class="form-control mb-0" name="username" maxlength="12" minlength="3" data-minlength="6" data-error="Have atleast 6 characters" placeholder="Enter Username" required value="<?php echo $username; ?>">
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Email</label>
                        <input type="email" class="form-control mb-0" name="email" data-error="Invalid email." placeholder="Enter Email" required value="<?php echo $email; ?>">
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
                        <input type="text" class="form-control mb-0" name="contactNo" data-error="You must have a Contact Number." maxlength="11" placeholder="09xxxxxxxxx" required value="<?php echo $contactNo; ?>">
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Gender</label>
                        <select class="browser-default custom-select" name="gender" data-error="You must have a gender." required>
                          <option selected disabled value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
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
                        <input type="text" class="form-control mb-0" name="address" data-error="You must have a Address." placeholder="Enter Address" required value="<?php echo $address; ?>">
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <h4 class="py-3 text-dark">Additional Information</h4>

                <div class="row">
                  <div class="col-4">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Civil Status</label>
                        <select class="browser-default custom-select" name="civil" data-error="You must have a gender." required>
                          <option disabled selected value="">Choose</option>
                          <option value="single">Single</option>
                          <option value="married">Married</option>
                          <option value="divorced">Divorced</option>
                          <option value="separated">Separated</option>
                          <option value="widowed">Widowed</option>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Occupation</label>
                        <input type="text" class="form-control mb-0" name="occupation" data-error="You must have a Contact Number." maxlength="11" placeholder="" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Emergency Contact Name</label>
                        <input type="text" class="form-control mb-0" name="eContactName" data-error="You must have a Contact Number." maxlength="11" placeholder="" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <div class="form-group">
                        <label class="text-dark">Contact Number</label>
                        <input type="text" class="form-control mb-0" name="eContactNum" data-error="You must have a Contact Number." maxlength="11" placeholder="" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <div class="mb-3">
                      <label class="text-dark">Height</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="heigt" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                          <span class="input-group-text">ft</span>
                        </div>
                      </div>
                      <div class="help-block with-errors text-danger"></div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="mb-3">
                      <label class="text-dark">Weight</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="weight" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                      <div class="help-block with-errors text-danger"></div>
                    </div>
                  </div>
                </div>

            


                <div class="form-group col-md-12">
                  <button type="submit" class="btn btn-success btn-block align-items-center" name="confirm">Confirm</button>
                </div>
              </form>
            <?php
            }

            ?>



          </div>





          </form>
        </div>
      </div>

    </div>
  </div>
  </div>
  <!-- About Us End-->
  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>
  <?php include 'include/footer.php'; ?>
</body>

</html>