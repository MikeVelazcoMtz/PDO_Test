<?php
session_start();

if(!file_exists('connection.php')){
	die("Bad config error. Connection file does not exist.");
} else {

	if(isset($_SESSION['logged-in']) && isset($_GET['pk'])) {
		require 'db_methods.php';
		$db = new Contact_catalog();
		$result = $db->delete($_GET['pk']);
		if ($result === true) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete success</title>
	<link rel="stylesheet" href="../Client_views/style.css">
</head>
<body>
	<div>
		<span style="float:right;"><a href="logout.php">Logout</a></span>
	</div>
	<h1>Delete success</h1>
	<hr>
	<p>The delete process finished with success. <a href="../Client_views/list.php">Return to list</a>.</p>
</body>
</html>
<?php
		} else {
			echo $result;
		}
	} else {
		echo $_SESSION['logged-in'];
		echo "<br>";
		echo $_GET['pk'];
		// echo "<script>window.location = '../index.php';</script>";
	}
}

?>