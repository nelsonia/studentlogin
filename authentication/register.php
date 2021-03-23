<?php
session_start();
$servername = 'localhost';
$username = 'root';
$password = 'nelsonia';
$dbname = 'school';


$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
	# code...
	echo "connection failed" . $conn->connect_error;
} 
//variables to store our users input 
$usernames = $email = $password = $encrypted_pass = $role  = '';
$usernameErr = $emailErr = $passwordErr = '';

//session variables 
$_SESSION["reg"] = "Registration Successful";
$_SESSION["noreg"] = "Registration not Successful";
$_SESSION['classTypeSuccess'] = "success";
$_SESSION['classTypeError'] = "danger";
$_SESSION['userTaken'] = "Wrong Credentials , try again or create an account";



//capture user input / validate users input
if (isset($_POST['save']) ){
	# code...

	if (empty($_POST['username'])) {
		# code...
		$usernameErr = "username is required";
	} else {
		$usernames = $_POST['username'];
	}

if (empty($_POST['email'])) {
		# code...
		$emailErr = "email is required";
	} else {
		$email = $_POST['email'];
	}

if (empty($_POST['password'])) {
		# code...
		$passwordErr = "password is required";
	} else {
		$password = $_POST['password'];
		//encrypting my password 
		$encrypted_pass = md5($password);
	}
    
  $role = $_POST['role'];







	//fetching records to compare sign up details 
	$sql = "SELECT * FROM users WHERE username='$usernames' && email='$email'";
	//execute the query 
	$result = mysqli_query($conn,$sql);
	//finding the number of rows which match my sql query
	$num = mysqli_num_rows($result);
	//check if the implementations above 
	// echo "number of row(s) that match reg details " . $num;

	//logic to use the number rows 
	if ($num >= 1) {
		# code...
		$_SESSION['userTaken'];
		header("location: ../index.php?wrongCred");
	} else {
		if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
		# code...
		//prepare the statement
		$stmt = $conn->prepare("INSERT INTO users (username,email,userpassword,role) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss",$usernames,$email,$encrypted_pass,$role);

		if ($stmt->execute() === TRUE) {
			# code...
            $_SESSION["reg"];
			$_SESSION['classTypeSuccess'];
			header('location: ../index.php?registered');

		} else {
						# code...
            $_SESSION["noreg"];
			$_SESSION['classTypeError'];
			header('location: ../index.php?notreg');

		}
	}

	
	}
	

	



}


?>