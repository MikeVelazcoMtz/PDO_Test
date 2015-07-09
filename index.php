<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
	<link rel="stylesheet" href="Client_views/style.css">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['logged-in'])) {
?>
<div class="title">You're logged-in.</div>
<div>
	<div class="half">
		<a href="Server_processing/logout.php">Logout</a>
	</div>
	<div class="half">
		<a href="Client_views/list.php">Go to list</a>.
	</div>
</div>
<?php
} else {
?>
<div class="title">You're not logged-in.</div>
<div>
	<div class="middle"><a href="Server_processing/login.php">Log-in</a></div>
</div>
<?php
}
?>
</body>
</html>
