<?php
session_start();
if (isset($_SESSION['logged-in'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Are you sure of what are you doing?</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Are you sure of what are you doing?</h1>
	<p>If you delete this record, then you will never recover it</p>
	<p><a href="../Server_processing/confirm_delete.php?pk=<?php echo $_GET['id'] ?>">Delete</a> or <a href="list.php">Return to list</a>.</p>
</body>
</html>
<?php } else { ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="list.php"></a>
</body>
</html>
<?php
} ?>