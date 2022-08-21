<?php
include 'include/db.php';


$query = "SELECT * FROM webDetail where id='1'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
	$id = $row['id'];
	$name = $row['name'];
	$email = $row['email'];
	$contact = $row['contact'];
	$about = $row['about'];
	$max = $row['max'];
}





if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$about = $_POST['about'];
	$max = $_POST['max'];


	$query = "UPDATE `webDetail` SET `name`='$name',`email`='$email',`contact`='$contact',`about`='$about',`max`='$max' WHERE `id`='$id'";
	$query_run = mysqli_query($connection, $query);

	header("Location: webDetail.php");
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
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Website Details</h5>
								</div>
								<div class="card-body">





									<form action="" method="POST">
										<div class="form-group">
											<input type="hidden" name="id" value="<?php echo $id; ?>" />
										</div>
										<!-- <div class="form-floating mb-3">
											<label for="inputPassword" name="password">Business Name</label>
											<input class="form-control" type="text" placeholder="Enter your Businesss Name" name="name" required value="<?php echo $name; ?>" />
										</div> -->
										<div class="form-floating mb-3">
											<label for="inputPassword" name="password">Email</label>
											<input class="form-control" type="email" placeholder="Enter your email" name="email" required value="<?php echo $email; ?>" />
										</div>
										<div class="form-floating mb-3">
											<label for="inputPassword" name="password">Contact Number</label>
											<input class="form-control" type="text" placeholder="Enter your email" name="contact" required value="<?php echo $contact; ?>" />
										</div>
										<div class="form-floating mb-3">
											<label for="inputPassword" name="password">Max Capacity</label>
											<input class="form-control" type="text" placeholder="Enter your email" name="max" required value="<?php echo $max; ?>" />
										</div>
										<!-- <div class="form-floating mb-3">
											<label for="inputPassword" name="password">About</label>
											<textarea class="form-control" type="password" placeholder="Enter about business" name="about" rows="5" required><?php echo $about; ?></textarea>
										</div>
										 -->

										<div class="form-floating mb-3">
											<button type="submit" class="btn btn-success update" name="update">Update</button>
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

</body>


<!-- Mirrored from spark.bootlab.io/forms-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Apr 2021 05:22:21 GMT -->

</html>