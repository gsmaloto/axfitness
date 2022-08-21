
<?php

include('include/db.php');

$query = 'DELETE FROM appoint WHERE appId = ' . $_GET['appId'];
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

echo '
		<script type="text/javascript">
			window.location = "appointment.php";
		</script>
		';

?>
