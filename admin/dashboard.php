<?php
include('include/db.php');
$query = "SELECT count(*) as date from appoint WHERE DATE(date) = CURDATE() AND status='approve'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
$today = trim($row['date']);

}
$query1 = "SELECT count(*) as total from appoint";
$result1 = mysqli_query($connection, $query1) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result1)) {
$total = trim($row['total']);

}
$query2 = "SELECT SUM(payment) as totalIncome from income";
$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result2)) {
$totalIncome = trim($row['totalIncome']);

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
			<?php include 'include/sideNav.php';?>
		<div class="main">
			<!-- topNav -->
			<?php include 'include/topNav.php';?>
		
			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
							
						</h1>
						<p class="header-subtitle"></p>
					</div>

					<div class="row">
						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">
									
									<h5 class="card-title mb-0">Appointment</h5>
								</div>
								<div class="card-body py-3">
									 <div id="piechart" style="width: 400px; height: 500px;"></div>
									
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Appointment Today</h5>
													</div>

												</div>
												<h1 class="display-5 mt-1 mb-3"><?php echo $today; ?></h1>
												
											</div>
										</div>
					
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Appointment</h5>
													</div>

													<div class="col-auto">
														<!-- <div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="dollar-sign"></i>
															</div>
														</div> -->
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3"><?php echo $total; ?></h1>
												
											</div>
										</div>
										
									</div>
									
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Income</h5>
													</div>

												</div>
												<h1 class="display-5 mt-1 mb-3"><?php echo '₱'.$totalIncome ?></h1>
												
											</div>
										</div>
					
									</div>
								
									
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

	
	<script src="js/app.js"></script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'ax');
$query = "SELECT `date`, count(*) as cancel FROM appoint where status = 'cancel'";
$result = mysqli_query($connection, $query);

$queryApprove = "SELECT `date`, count(*) as approve FROM appoint where status = 'approve'";
$resultApprove = mysqli_query($connection, $queryApprove);
?>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['date', 'Number'],
            <?php
            while ($row = mysqli_fetch_array($result)) {

                echo "['Cancelled', " . $row["cancel"] . "],";
            }
            while ($row = mysqli_fetch_array($resultApprove)) {

                echo "['Approved', " . $row["approve"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Total number of appointment status',

            is3D:true,  
            pieHole: 0.4
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
</body>


<!-- Mirrored from spark.bootlab.io/dashboard-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Apr 2021 05:22:14 GMT -->
</html>

