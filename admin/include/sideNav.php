<?php
session_start();

include('db.php');

if($_SESSION==""){
header("location: index.php");
}


$query = "SELECT * FROM admin where id='$_SESSION[id]'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
$picture = trim($row['picture']);
$firstName = trim($row['firstName']);
$lastName = trim($row['lastName']);
}
?>


<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="dashboard.php">
				<svg>
					<use xlink:href="#ion-ios-pulse-strong"></use>
				</svg>
				AX Fitness
			</a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<img src="<?php echo $picture; ?>" class="img-fluid rounded-circle mb-2" />
					<div class="font-weight-bold"><?php echo $firstName.' '.$lastName?></div>
					<!-- <small>Full-Stack Web Developer</small> -->
				</div>

				<?php
				 $role = $_SESSION['role']; 

				 if($role =='1'){
				 	?>
				 	<ul class="sidebar-nav">
					<li class="sidebar-item">
					<li class="sidebar-item"><a class="sidebar-link" href="dashboard.php">		<i class="align-middle mr-2 fas fa-fw fa-home"></i>Dashboard</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="qrScan.php">			<i class="align-middle mr-2 fa fa-qrcode"></i>Scan QR code</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="accountAdmin.php">	<i class="align-middle mr-2 fas fa-fw fa-user"></i></i>Admin Account</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="accountUser.php">	<i class="align-middle mr-2 fas fa-fw fa-users"></i>User Account</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="membership.php">		<i class="align-middle mr-2 far fa-fw fa-address-card"></i>Membership</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="appointment.php">	<i class="align-middle mr-2 fas fa-fw fa-book"></i>Appointment</a></li>
					<!-- <li class="sidebar-item"><a class="sidebar-link" href="event.php">Event</a></li> -->
					<li class="sidebar-item"><a class="sidebar-link" href="webDetail.php">		<i class="align-middle mr-2 fas fa-fw fa-globe-asia"></i>Website Details</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="income.php">			<i class="align-middle mr-2 fas fa-fw fa-money-bill-alt"></i>Income</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="userLog.php">		<i class="align-middle mr-2 fa fa-history"></i>User Logs</a></li>
					</li>
				</ul>
				 	<?php
				 }else{
				 	?>
				 	<ul class="sidebar-nav">
					<li class="sidebar-item">
					<li class="sidebar-item"><a class="sidebar-link" href="qrScan.php">Scan QR code</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="accountUser.php">User Account</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="dashboard.php">Dashboard</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="membership.php">Membership</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="appointment.php">Appointment</a></li>
					<!-- <li class="sidebar-item"><a class="sidebar-link" href="event.php">Event</a></li> -->
					</li>
				</ul>
				 	<?php
				 }

				?>
				
			</div>
		</nav>