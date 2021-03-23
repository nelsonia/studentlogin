<?php
session_start();
?>
<html>
<head>
	<title>Dahsboard</title>
</head>
<body>
<p>
	<?php  if (isset($_GET['guest'])) {
		# code...
		if (isset($_SESSION['guest'])) {
			# code...
			echo $_SESSION['guest'];
			session_unset();
			session_destroy();
		} else {
			echo "Welcome guest";
		}
	} ?>


</p>

<form action="../authentication/logout.php">
	<input type="submit" name="logout" id="logout" value="Logout">
</form>
 
 	
</body>
</html>