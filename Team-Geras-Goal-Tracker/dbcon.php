<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'goal_tracker';

//connect to the Database
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Test if the connection was successful
if(!$conn) {
	echo 'Connection Error ' .mysqli_connect_error();
}

