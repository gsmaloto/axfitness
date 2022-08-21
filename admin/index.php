<?php

include 'include/db.php';


if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: dashboard.php");
    die();
}

$msg = "";


if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim(md5($_POST['password']));

    $sql = "SELECT * FROM admin WHERE  email='{$email}' AND password='{$password}'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

            session_start();
            $_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['email'] = $row['email'];

            header("Location: dashboard.php");
    } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/head.php'; ?>

    
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




    <!-- home -->



    <section class="about mg-t mg-b" id="about">
        <div class="container">
            <div class="row pt-5 d-flex justify-content-around">
                <div class="col-lg-6 about-cont" data-aos="fade-left" data-aos-duration="1000">
                    <h1 class="text-white">AX Fitness Appointment and Scheduling System</h2>
                </div>
                <div class="col-lg-4 about-cont border bg-white" data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="pt-3">Login Your Account</h2>
                    <?php echo $msg; ?>
                    <form action="" method="POST" data-toggle="validator">
                         <div class="mb-3">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control mb-0" name="email" data-error="Invalid email." placeholder="Enter Email" required>
                            <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control mb-0" name="password" data-error="Password is required." placeholder="Enter Password" required>
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                </div>
                        <div class="form-floating mb-3">
                            <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                        </div>
					<!-- 	<div class="form-floating mb-3">
                            <a type="submit" class="btn btn-primary btn-block" href="register.php">Register</a>
                        </div> -->
                        <div class="form-floating mb-3 text-right">
                            <a class="small" href="forgot.php">Forgot Password?</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>


</body>
<script>
   // Validate Password
    $('#passcheck').hide();
    let passwordError = true;
    $('#password').keyup(function () {
        validatePassword();
    });
    function validatePassword() {
        let passwrdValue =
            $('#password').val();
        if (passwrdValue.length == '') {
            $('#passcheck').show();
            passwordError = false;
            return false;
        }
        if ((passwrdValue.length < 3)||
            (passwrdValue.length > 10)) {
            $('#passcheck').show();
            $('#passcheck').html
("**length of your password must be between 3 and 10");
            $('#passcheck').css("color", "red");
            passwordError = false;
            return false;
        } else {
            $('#passcheck').hide();
        }
    }

    // Validate Email
    const email =
        document.getElementById('email');
    email.addEventListener('blur', ()=>{
       let regex =
/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
       let s = email.value;
       if(regex.test(s)){
          email.classList.remove(
                'is-invalid');
          emailError = true;
        }
        else{
            email.classList.add(
                  'is-invalid');
            emailError = false;
        }
    })

</script>
</html>