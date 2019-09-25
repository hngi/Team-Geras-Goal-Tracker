<?php
session_start();
if (isset($_SESSION['user'])) { /* Page to output if login was successful */

  $user = $_SESSION['user'];
$pagename = "Welcome $user";
echo <<<_END
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">	
  <title>$pagename</title>
  <LINK href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="container">
        <div class="success">
        	<h3>Login Successful!!!!</h3>
        	<p>Welcome $user</p>
        	<a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

_END;
} else {
  header("location:login.php");
}
?>