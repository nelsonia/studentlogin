<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<p>
	<?php  if (isset($_GET['logged'])) {
		# code...
		if (isset($_SESSION['activeUser'])) {
			# code...
			echo $_SESSION['activeUser'];
			session_unset();
			session_destroy();
		} else {
			echo "Welcome admin user";
		}
	} ?>


</p>
<form action="../authentication/logout.php">
	<input type="submit" name="logout" id="logout" value="Logout">
</form>
</body>
</html>