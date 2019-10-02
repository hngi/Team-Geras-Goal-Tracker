<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'goal_tracker';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn) {
	echo 'Connection Error ' .mysqli_connect_error();
}

