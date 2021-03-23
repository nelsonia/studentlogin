<?php
$servername = 'localhost';
$username = 'root';
$password = 'nelsonia';
$dbname = 'school';


$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
	# code...
	echo "connection failed" . $conn->connect_error;
} else {
	echo "works";
}


?>