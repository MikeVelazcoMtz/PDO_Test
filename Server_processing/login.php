<?php 
	session_start();
	$_SESSION['logged-in'] = true;
	echo "<script>window.location='../Client_views/list.php';</script>";
?>