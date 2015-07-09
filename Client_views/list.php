<?php 
	session_start();
	if (file_exists('../Server_processing/db_methods.php') && isset($_SESSION['logged-in'])) {
		require '../Server_processing/db_methods.php';
		$db = new Contact_catalog();
		$list = $db->list_items();
		if (!is_string($list)) { // If is a string then is a json error.
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact list</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div>
		<span style="float:right;"><a href="../Server_processing/logout.php">Logout</a></span>
	</div>
	<h1>Contact list</h1>
	<hr>
	<p>The actual contact list is shown below:</p>
	<table>
		<thead>
			<tr>
				<th>E-mail</th>
				<th>Telephone number</th>
				<th>Company</th>
				<th>Date of birth</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list as $item) {
				echo "<tr><td>" . $item['email'] . "</td><td>" . $item['telephone_number'] . "</td>";
				echo "<td>" . $item['company'] . "</td><td>" . $item['birth_date'] . "</td>";
				echo "<td><a href='update.php?id=" . $item['id'] . "'>Update</a></td>";
				echo "<td><a href='delete.php?id=" . $item['id'] . "'>Delete</a></td></tr>";
			} ?>
		</tbody>
	</table>
	<br>
	<br>
	<br>
	<div class="middle">
		<a href="form.php">Create new Item</a>
	</div>
</body>
</html>
<?php	
		} else {
			echo $list;
		}
	} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Session error</title>
	<script>window.location='../index.php'</script>
</head>
<body></body>
</html>
<?php
	}
?>