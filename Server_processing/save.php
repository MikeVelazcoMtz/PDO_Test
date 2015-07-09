<?php 
if(!file_exists('connection.php')){
	die("Bad config error. Connection file does not exist.");
} else {
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$requested_items = ['email', 'telephone', 'company', 'birth', 'password'];
		foreach ($requested_items as $item) {
			if(array_key_exists($item, $_POST) === false){
				$error['status'] = 'error';
				$error['message'] = "Not enough form data to save.";
				echo json_encode($error);
			}
		}
		require 'db_methods.php';
		$db = new Contact_catalog();
		$result = $db->save($_POST['email'], $_POST['telephone'], $_POST['company'], $_POST['birth'], $_POST['password']);
		if ($result === true) {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Save success</title>
	<link rel="stylesheet" href="../Clinent_views/style.css">
	<span style="float:right;"><a href="../Client_views/list.php">Return to list</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
</head>
<body>
	<a href="logout.php">Logout</a>
	<h1>Save success</h1>
	<hr>
	<p>The save process finished with success. 	<a href="list.php">Return to list</a>.</p>
</body>
</html>
<?php
		} else {
			echo $result;
		}
	} else {
		echo "<script>window.location = '../Client_views/form.php';</script>";
	}
}

?>