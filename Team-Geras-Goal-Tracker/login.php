<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goal Tracker</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="dashboard.php">Geras Goal Tracker</a>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarNav"
    aria-controls="navbarsNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"
          >Home <span class="sr-only">(current)</span></a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link" href="faq.html">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Team</a>
      </li>
    </ul>
  </div>
</nav>

<?php //Login.php
require_once('dbcon.php');
$error = $user = "";

if (isset($_SESSION['user'])) {
    echo '<meta http-equiv="refresh" content="0;url=dashboard.php">';
    die();
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
                echo '<meta http-equiv="refresh" content="0;url=dashboard.php">';
                die();
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
                    <p class="text-white">You don't have an account? <a href="index.php">Sign up</a></p>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>  
</body>
</html>
