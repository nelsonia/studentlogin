<?php
include '../connection.php';
session_start();


//variables to store input
$email = $newPass = '';
$emailErr = $newPassErr = $encrypted = '';

$_SESSION['updateSuccess'] = "reset successful login with new password";
$_SESSION['typeAlert'] = "info";

if (isset($_POST['update'])) {
	# code...
	if (empty($_POST['emailReset'])) {
		# code...
        $emailErr = "email is required";
	} else {
		$email = $_POST['emailReset'];
	}

		if (empty($_POST['passwordReset'])) {
		# code...
        $newPassErr = "password is required";
	} else {
		$newPass = $_POST['passwordReset'];
		$encrypted = md5($newPass);
	}


   if (empty($emailErr) && empty($newPassErr)) {
   	# code...

	$resetSql = "UPDATE users SET userpassword='$encrypted' WHERE email='$email'";

	$result = mysqli_query($conn,$resetSql);

	if ($result) {
		# code...
		$_SESSION['updateSuccess'];
		header('location: ../index.php?update');
	}
   } 
   else {
   	  echo "invalid details";
   }

}
 


?>




<!DOCTYPE html>
<html>
<head>
	<title>
		Reset Password
	</title>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-grid.min.css">
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<div class="container" style="margin-top: 20px;">
		<form action="reset.php" method="post" >	
		<h3>Reset Password</h3>	
			<div class="form-group">
         				<input type="email" name="emailReset" id="email" class="form-control" placeholder="Enter Email">
         			</div>
         			<div class="form-group">
         				<input type="password" onkeyup="check();" name="passwordReset" id="password" class="form-control" placeholder="New password">
         			</div>
         			<div class="form-group">
         				<input type="password" onkeyup="check();" name="conpass" id="conpass" class="form-control" placeholder="Confirm password">
         				<span id="message"></span>
         			</div>

		         		<div class="col" style="text-align: center;">
		         			<input type="submit" name="update" id="update" class="btn btn-success btn-block" value="Reset Password">
		         		</div>
			    			
		</form>
		
	</div>
	<script type="text/javascript">
		 function check(){
		 	if (document.getElementById('password').value === document.getElementById('conpass').value) {
                   
                   document.getElementById('message').style.color = "green";
                   document.getElementById('message').innerHTML = "passwords match";
                   document.getElementById('save').disabled = false;
		 	} else {

                   document.getElementById('message').style.color = "red";
                   document.getElementById('message').innerHTML = "passwords do not match";
                   document.getElementById('save').disabled = true;
		 	}
		 }



	</script>
</body>
</html>