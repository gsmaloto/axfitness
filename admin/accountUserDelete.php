
<?php

include('include/db.php');

$query = 'DELETE FROM client WHERE clientId = ' . $_GET['clientId'];
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

echo '
		<script type="text/javascript">
			window.location = "accountUser.php";
		</script>
		';

?>
