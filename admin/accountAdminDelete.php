
<?php

include('include/db.php');

$query = 'DELETE FROM admin WHERE id = ' . $_GET['id'];
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

echo '
		<script type="text/javascript">
			window.location = "accountAdmin.php";
		</script>
		';

?>
