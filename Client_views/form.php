<?php 
session_start();
if (isset($_SESSION['logged-in'])) {
	# code...
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact form</title>
	<!-- DatePicker sources -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script>
	jQuery(document).ready(function($) {
		$("#birth").datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: 'button',
            minDate: '-100y',
		    maxDate: '-1y', 
		    yearRange: '<?php echo ((int) date("Y") - 100) . ":" . date("Y"); ?>',
        });
        $("#toggle_help").click(function (argument) {
        	$("#valid_formats").toggle();
        });
	});</script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div>
	<span style="float:right;"><a href="../Server_processing/logout.php">Logout</a></span>
	<span style="float:right;"><a href="list.php">Return to list</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>
	<h1>Contact Form</h1>
	<hr>
	<form action="../Server_processing/save.php" method="POST">
		<p><label for="email">E-mail:</label></p>
		<p><input type="email" name="email" id="email" maxlength="90" required></p>
		<p><label for="password">Password: </label></p>
		<p><input type="password" autocomplete='false' maxlength="45" name="password" id="password" required></p>
		<p><label for="telephone">Telephone number:</label></p>
		<p><span id="toggle_help">Valid Formats:</span></p>
		<div id="valid_formats">
			<ul>
				<li>123-456-7890</li>
				<li>(123) 456-7890</li>
				<li>123 456 7890</li>
				<li>123.456.7890</li>
				<li>+91 (123) 456-7890</li>
			</ul>
		</div>
		<p><input type="tel" name="telephone" id="telephone" maxlength="45" required pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$" validateat="onsubmit"></p>
		<p><label for="company">Company</label></p>
		<p><input type="text" name="company" id="company" maxlength="45"></p>
		<p><label for="birth">Birth Date:</label></p>
		<p><input type="date" name="birth" id="birth" value="<?php echo date('Y-m-d'); ?>"></p>
		<p>
			<input type="submit" value="Save">
		</p>
	</form>
</body>
</html>
<?php 
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Not logged-in</title>
	<script>window.location = '../index.php';</script>
</head>
<body>

</body>
</html>
<?php
}
?>
