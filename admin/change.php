
<?php

include 'include/db.php';


if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

$msg = "";
if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM admin WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['reset'])) {
            $password = mysqli_real_escape_string($connection, md5($_POST['password']));
            $confirmPassword = mysqli_real_escape_string($connection, md5($_POST['confirmPassword']));

            if ($password === $confirmPassword) {
                $query = mysqli_query($connection, "UPDATE client SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: login.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgot.php");
}

if (isset($_POST['login'])) {
    session_start();
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, md5($_POST['password']));

    $sql = "SELECT * FROM client WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
            $_SESSION['username'] = $row['username'];
            
            header("Location: index.php");
        } else {
            $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
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
                        <h2 class="pt-3 text-dark">Reset password?</h2>
                        <?php echo $msg; ?>
                         <form action="" method="POST">
                        <div class="form-floating mb-3">
                            <label class="text-dark" for="inputPassword" name="password">New Password</label>
                            <input class="form-control" type="password" placeholder="New Password" name="password" required />
                        </div>
                        <div class="form-floating mb-3">
                            <label class="text-dark" for="inputPassword" name="password">Confirm New Paswword</label>
                            <input class="form-control" type="password" placeholder="Confirm Password" name="confirmPassword" required />
                        </div>

                        <div class="form-floating mb-3">
                            <button type="submit" class="btn btn-success btn-block" name="reset">Confirm</button>
                        </div>
                       
                        <div class="form-floating mb-3 text-right">
                            <a class="small" href="forgotPassword.php">Forgot Password?</a>
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
