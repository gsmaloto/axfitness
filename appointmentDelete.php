
<?php

include('include/db.php');

$appId = $_GET['appId'];

mysqli_query($connection, "update `appoint` set status='cancel' where appId='$appId'");




header('location:appointment.php');
?>
