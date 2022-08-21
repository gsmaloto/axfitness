<?php

include 'include/db.php';


if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

$msg = "";

if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM client WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($connection, "UPDATE client SET code='' WHERE code='{$_GET['verification']}'");

        if ($query) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: login.php");
    }
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, md5($_POST['password']));

    $sql = "SELECT * FROM client WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
            session_start();
            $_SESSION['clientId'] = $row['clientId'];
            $_SESSION['username'] = $row['username'];

            $date = date('Y-m-d H:i:s');
        
            $query2 = "INSERT INTO `userLogs`(`clientId`, `date`) VALUES ('$row[clientId]','$date')";
            mysqli_query($connection, $query2);

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

                        <h2 class="pt-3 text-dark">Login Your Account</h2>
                      <?php echo $msg; ?>
                        <form action="" method="POST" data-toggle="validator">
                            <div class="mb-3">
                              <div class="form-group">
                                <label class="text-dark">Email</label>
                                <input type="email" class="form-control mb-0" name="email" data-error="Invalid email." placeholder="Enter Email" required value="<?php if (isset($_POST['login'])) { echo $email; }?>">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                          <div class="form-group">
                            <label class="text-dark">Password</label>
                            <input type="password" class="form-control mb-0" name="password" data-error="Password is required." placeholder="Enter Password" required>
                            <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                    </div>
                    <div class="form-floating mb-3">
                        <a type="submit" class="btn btn-primary btn-block" href="register.php">Register</a>
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




<script>
$(document).ready(function(){
	
	function load_unseen_notification(view = '')
	{
		$.ajax({
			url:"include/fetch.php",
			method:"POST",
			data:{view:view},
			dataType:"json",
			success:function(data)
			{
			$('.dropdown-menu').html(data.notification);
			if(data.unseen_notification > 0){
			$('.count').html(data.unseen_notification);
			}
			}
		});
	}
 
	load_unseen_notification();

 
	$(document).on('click', '.dropdown-toggle', function(){
	$('.count').html('');
	load_unseen_notification('yes');
	});
 
	setInterval(function(){ 
		load_unseen_notification();; 
	}, 5000);
 
});
</script>
</body>
</html>
