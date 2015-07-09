<?php 
	session_start();

	if (file_exists('db_methods.php') && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['logged-in'])) {
		require 'db_methods.php';
		$db = new Contact_catalog();
		$requested_items = ['id', 'email', 'telephone', 'company', 'birth', 'password'];
		foreach ($requested_items as $item) {
			if(array_key_exists($item, $_POST) === false){
				$error['status'] = 'error';
				$error['message'] = "Not enough form data to save.";
				die(json_encode($error));
			}
		}
		$result = $db->update($_POST['id'], $_POST['email'], $_POST['telephone'], $_POST['company'], $_POST['birth'], $_POST['password']);
		if ($result === true) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Save success</title>
	<link rel="stylesheet" href="../Clinent_views/style.css">
</head>
<body>
	<div>
		<span style="float:right;"><a href="logout.php">Logout</a></span>
		<span style="float:right;"><a href="../Server_processing/list.php">Return to list</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

	</div>
	<h1>Save success</h1>
	<hr>
	<p>The update process finished with success. <a href="../Client_views/list.php">Return to list</a>.</p>
</body>
</html>
<?php
		}
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
	<script>window.location="../index.php";</script>
</head>
<body>

</body>
</html>
<?php
	}
?>