<?php
session_start();
if(empty($_SESSION['clientId']) || $_SESSION['clientId'] == ''){
    header("Location:login.php");
    die();
}


include 'include/db.php';
$successUpdate = "";
if (isset($_POST['update'])) {
  $clientid = $_POST['clientId'];
  $username = $_POST['username'];
  $email =  $_POST['email'];
  $firstName =  $_POST['firstName'];
  $lastName =  $_POST['lastName'];
  $contactNo =  $_POST['contactNo'];
  $gender =  $_POST['gender'];
  $address =  $_POST['address'];


  $filepath = $_FILES["uploadfile"]["name"];
  $target = "img/".basename($filepath);

        //$sql = "INSERT INTO user (image) VALUES ('$image')";
        //mysqli_query($db, $sql);

  if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target)) {
    $msg = "Image uploaded successfully";
  }else{
    $msg = "Failed to upload image";
  }



  $query = "UPDATE `client` SET `username`='$username',`email`='$email', `firstName`='$firstName',`lastName`='$lastName',`contactNo`='$contactNo',`gender`='$gender', `address`='$address',`picture`='$filepath' WHERE `clientId`='$clientid'";

  $query_run = mysqli_query($connection, $query);
  
  $successUpdate = '<div class="alert alert-success" role="alert">
  Updated sucessfully
  </div>';

  echo'<script>document.querySelector(".third").addEventListener("click", function(){
    Swal.fire("Our First Alert", "With some body text and success icon!", "success");
  };</script>';
}

$matchError = "";
$passwordError = "";
$success = "";

if (isset($_POST['changePassword'])) {
  $clientId =$_POST['clientId'];
  $password = $_POST['password'];
  $currentPass = md5($_POST['currentPass']);
  $newPass = $_POST['newPass'];
  $confirmPass = $_POST['confirmPass'];

  if ($password === $currentPass && $newPass === $confirmPass) {

    $query = "UPDATE `client` SET `password`= md5('$newPass') WHERE `clientId`='$clientId'";
    $query_run = mysqli_query($connection, $query);

    $success = '<div class="alert alert-success" role="alert">
    Change Password Successfully
    </div>';
    echo"<script>alert 'change password success';</script>";

  } else {
    if ($newPass != $confirmPass) {
      $matchError = "<small class='text-danger'>Password not match</small>";
    }
    if ($password != $currentPass) {
      $passwordError = "<small class='text-danger'>Current password is wrong</small>";
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

   }
 </style>
</head>

<body>
  <?php include 'include/nav.php' ?>



  <section class="about mg-t mg-b" id="about">
    <div class="container">


      <div class="row">

        <div class="col-md-10 col-xl-7">
          <div class="tab-content">
            <div class="tab-pane fade show active" id="account" role="tabpanel">
            <br><br><br>
              <div class="card">
                <div class="card-header">

                  <h5 class="card-title mb-0">Profile information</h5>
                </div>

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
                  $email = $row['email'];
                }

                ?>

                <div class="card-body">
                  <form action="" method="POST" enctype="multipart/form-data" data-toggle="validator">
                    <div class="row">
                      <div class="col-md-8">
                        <div><?php echo $successUpdate; ?></div>

                        <input name="clientId" type="hidden" required value="<?php echo $clientId; ?>" />
                        <div class="form-group">
                          <label for="inputUsername" class="text-dark">Username</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" required value="<?php echo $username; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputUsername" class="text-dark">First Name</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="firstName" required value="<?php echo $firstName; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputUsername" class="text-dark">Last Name</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="lastName" required value="<?php echo $lastName; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputUsername" class="text-dark">Email</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="Email" name="email" required value="<?php echo $email; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputUsername" class="text-dark">Gender:</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="Email" readonly name="gender" required value="<?php echo $gender; ?>" />
                        </div>
                         <div class="form-group">
                          <label for="inputUsername" class="text-dark">Contact No:</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="COntact Number" name="contactNo" required value="<?php echo $contactNo; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="inputUsername" class="text-dark">Address:</label>
                          <input type="text" class="form-control" id="inputUsername" placeholder="address" name="address" required value="<?php echo $address; ?>" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="text-center">
                          <td><img src="<?php echo 'img/'.$picture; ?>" width="100" height="100"></td>
                          <div class="form-group">
                            <label for="exampleInputFile">Upload Profile Picture</label>
                            <input type="file" name="uploadfile" value=""/>
                             <label for="exampleInputFile"><?php echo $picture; ?></label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary third" name="update">Save changes</button>
                  </form>

                </div>
              </div>


            </div>

          </div>
        </div>
        <div class="col-md-2 col-xl-5">
        <br><br><br>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Password</h5>

              <form action="" method="POST" >
                <div><?php echo $success ?></div>
                <div class="form-group">
                  <label for="inputPasswordCurrent" class="text-dark">Current password</label>
                  <input name="clientId" type="hidden" required value="<?php echo $clientId; ?>" />
                  <input type="password" class="form-control" id="inputPasswordCurrent" name="currentPass" required>
                  <input type="hidden" class="form-control" id="inputPasswordCurrent" name="password" required value="<?php echo $password; ?>">
                  <div><?php echo $passwordError ?></div>
                </div>
                <div class="form-group">
                  <label for="inputPasswordNew" class="text-dark">New password</label>
                  <input type="password" class="form-control" id="inputPasswordNew" name="newPass" required>
                </div>
                <div class="form-group">
                  <label for="inputPasswordNew2" class="text-dark">Verify password</label>
                  <input type="password" class="form-control" id="inputPasswordNew2" name="confirmPass" required>
                  <div><?php echo $matchError ?></div>
                </div>

                <button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>
              </form>

            </div>
          </div>

        </div>

      </div>
    </section>
    <?php include 'include/footer.php'; ?>

  </body>

  </html>
