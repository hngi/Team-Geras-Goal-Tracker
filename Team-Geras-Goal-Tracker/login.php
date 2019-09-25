<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goal Tracker</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php //Login.php
require_once('dbcon.php');
$error = $user = "";
session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    die(header("location: dash.php"));
} else {
    $user = "";
}
function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}

function validEmail($mail) {
    $mail = preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$mail);
    
    return $mail;
}

if (isset($_POST['email'])) {

    $email = sanitizeString($_POST['email']);
    $pass = sanitizeString($_POST['password']);
    if ($email == "" || $pass == "") {
        $error = "Not all fields were entered<br />";
    } else {
        
        if (!validEmail($_POST['email'])) {
            $error = "Invalid Email";
        } else {
            $salt1 = "qm&h*";
            $salt2 = "pg!@";
            $pass = md5("$salt1$pass$salt2");
            $sql1 = "SELECT firstname, email, password FROM user WHERE email='$email' AND password='$pass'";
            if (mysqli_num_rows(mysqli_query($conn,$sql1)) == 0) {
                $error = "Email/Password invalid<br />";
            } else {
                
                $_SESSION['user'] = $email;
                die(header("location: dash.php"));
            }
        
        }

    }
}

?>
    
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
                    <h1>Welcome to Goal Tracker</h1>
                    <h2>Login</h2>
                    <?php echo $error ?>
                    <p class="text-muted"> Please enter your login and password!</p> 
                    <input type="email" class="email" name="email" placeholder="Email ">
                    <input type="password" name="password" placeholder="Password"> <a class="forgot text-muted" href="#">Forgot password?</a> 
                    <input type="submit" name="" value="Login">
                    <div class="col-md-12">
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>