<?php
include 'include/db.php';

    $id = $_GET['id'];

$query = "select * from `membership` where id='$id'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
   $id = $row['id'];
    $clientId = $row['clientId'];
    $status = $row['status'];
    $civil = $row['civil'];
    $occupation = $row['occupation'];
    $eContactName = $row['eContactName'];
    $eContactNum = $row['eContactNum'];
    $height = $row['height'];
    $weight = $row['weight'];
}

if (isset($_POST['memberUpdate'])) {

    $status = $_POST['status'];


    mysqli_query($connection, "update `membership` set status='$status' where id='$id'");

    $created = date('Y-m-d H:i:s');

    $query2 = "INSERT INTO `income`(`clientId`, `detail`, `payment`, `created`) VALUES ('$clientId','Membership','1250', '$created')";
        mysqli_query($connection, $query2);




    header('location:membership.php');
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
                                    <h5 class="card-title mb-0">Membership</h5>
                                </div>
                                <div class="card-body">


                                    <form method="POST" action="memberUpdate.php?id=<?php echo $id; ?>">

                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Membership ID</label>
                                            <input readonly class="form-control" type="text" placeholder="Enter event title" value="<?php echo $id; ?>" name="title" required />
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Client ID</label>
                                            <input readonly class="form-control" type="text" value="<?php echo $clientId; ?>"  name="date" required />
                                        </div>
                                        <div class="form-floating mb-3">
                                                <label for="inputPassword" name="password">Status</label>
                                                <select class="form-control mb-3" name="status">
                                                    <?php
                                                    if ($status == 'a') {
                                                        echo '
                                                            <option selected value="a">approve</option>
                                                            <option value="c">cancel</option>
                                                            <option value="p">pending</option>
                                                        ';
                                                    }
                                                    if($status == 'c') {
                                                        echo '
                                                            <option value="a">approve</option>
                                                            <option selected value="c">cancel</option>
                                                            <option value="p">pending</option>
                                                        ';
                                                    }if($status == 'p'){
                                                        echo '
                                                            <option value="a">approve</option>
                                                            <option value="c">cancel</option>
                                                            <option selected value="p">pending</option>
                                                        ';

                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Occupation</label>
                                            <input readonly class="form-control" type="text" value="<?php echo $occupation; ?>"  name="contact" required />
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Emergency Contact Name</label>
                                            <input readonly class="form-control" type="text" value="<?php echo $eContactName; ?>"  name="contact" required />
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Emergency Contact Number</label>
                                            <input readonly class="form-control" type="text" value="<?php echo $eContactNum; ?>"  name="contact" required />
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Height</label>
                                            <input readonly class="form-control" type="text" value="<?php echo $height; ?>"  name="contact" required />
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="inputPassword" name="password">Weight</label>
                                            <input readonly class="form-control" type="text" value="<?php echo $weight; ?>"  name="contact" required />
                                        </div>

                                        <div class="form-floating mb-3">
                                            <button type="submit" class="btn btn-success" name="memberUpdate">Update</button>
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



</html>