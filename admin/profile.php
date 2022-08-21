<?php
include 'include/db.php';
$successUpdate = "";
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email =  $_POST['email'];


	$filepath = "img/" . $_FILES["uploadfile"]["name"];
	$target = "img/".basename($filepath);

        //$sql = "INSERT INTO user (image) VALUES ('$image')";
        //mysqli_query($db, $sql);

	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target)) {
		$msg = "Image uploaded successfully";
	}else{
		$msg = "Failed to upload image";
	}

	$query = "UPDATE `admin` SET `username`='$username', `firstName`='$firstName', `lastName`='$lastName', `email`='$email', `picture`='$filepath' WHERE `id`='$id'";
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
	$id =$_POST['id'];
	$password = $_POST['password'];
	$currentPass = md5($_POST['currentPass']);
	$newPass = $_POST['newPass'];
	$confirmPass = $_POST['confirmPass'];

	if ($password === $currentPass && $newPass === $confirmPass) {

		$query = "UPDATE `admin` SET `password`= md5('$newPass') WHERE `id`='$id'";
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
			$passwordError = "<small class='text-danger'>Password not match</small>";
		}
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

					
					<div class="row">

						<div class="col-md-9 col-xl-7">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">
											
											<h5 class="card-title mb-0">Profile information</h5>
										</div>

										<?php

										$query = "SELECT * FROM admin where id='$_SESSION[id]'";
										$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
										while ($row = mysqli_fetch_array($result)) {
											$id = trim($row['id']);
											$username = trim($row['username']);
											$firstName = trim($row['firstName']);
											$lastName = trim($row['lastName']);
											$email = trim($row['email']);
											$password = trim($row['password']);
											$picture = trim($row['picture']);
										}
										?>

										<div class="card-body">
											<form action="" method="POST" enctype="multipart/form-data" data-toggle="validator">
												<div class="row">
													<div class="col-md-8">
														<div><?php echo $successUpdate; ?></div>

														<input name="id" type="hidden" required value="<?php echo $id; ?>" />
														<div class="form-group">
															<label for="inputUsername">Username</label>
															<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" required value="<?php echo $username; ?>" />
														</div>
														<div class="form-group">
															<label for="inputUsername">First Name</label>
															<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="firstName" required value="<?php echo $firstName; ?>" />
														</div>
														<div class="form-group">
															<label for="inputUsername">Last Name</label>
															<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="lastName" required value="<?php echo $lastName; ?>" />
														</div>
														<div class="form-group">
															<label for="inputUsername">Email</label>
															<input type="text" class="form-control" id="inputUsername" placeholder="Email" name="email" required value="<?php echo $email; ?>" />
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">
															<td><img src="<?php echo $picture; ?>" width="100" height="100"></td>
															<div class="form-group">
																<label for="exampleInputFile">Upload Profile Picture</label>
																<input type="file" name="uploadfile" value="<?php echo $picture; ?>"/>
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
						<div class="col-md-3 col-xl-5">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Password</h5>

									<form action="" method="POST" >
										<div><?php echo $success ?></div>
										<div class="form-group">
											<label for="inputPasswordCurrent">Current password</label>
											<input name="id" type="hidden" required value="<?php echo $id; ?>" />
											<input type="password" class="form-control" id="inputPasswordCurrent" name="currentPass" required>
											<input type="hidden" class="form-control" id="inputPasswordCurrent" name="password" required value="<?php echo $password; ?>">
											<div><?php echo $passwordError ?></div>
										</div>
										<div class="form-group">
											<label for="inputPasswordNew">New password</label>
											<input type="password" class="form-control" id="inputPasswordNew" name="newPass" required>
										</div>
										<div class="form-group">
											<label for="inputPasswordNew2">Verify password</label>
											<input type="password" class="form-control" id="inputPasswordNew2" name="confirmPass" required>
											<div><?php echo $matchError ?></div>
										</div>

										<button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>
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

</body>


<!-- Mirrored from spark.bootlab.io/pages-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Apr 2021 05:22:18 GMT -->

</html>