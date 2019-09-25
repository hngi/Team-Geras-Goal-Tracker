<?php
include_once('dbcon.php');

$error = false;
$firstname=$email=$phoneno="";

if (isset($_POST['btn-signup'])) {
  
  // clean user input to prevent sql injections
  $firstname = trim($_POST['firstname']);
  $firstname = htmlspecialchars(strip_tags($firstname));

  $email = trim($_POST['email']);
  $email = htmlspecialchars(strip_tags($email));

  $pwd = $_POST['pwd'];
  $pwd = strip_tags($pwd);
  $pwd = htmlspecialchars($pwd);

  $cpwd = $_POST['cpwd'];
  $cpwd = strip_tags($cpwd);
  $cpwd = htmlspecialchars($cpwd);

  $phoneno = trim($_POST['phoneno']);
  $phoneno = htmlspecialchars(strip_tags($phoneno));

 $gender = $_POST['gender'];

  $day = trim($_POST['day']);
  
  $month = trim($_POST['month']);
  
  $Year = trim($_POST['Year']);
 
  // To validate
  if (empty($firstname)) {
    $error = true;
    $errorfirstname = '<h6>Please input firstname</h6>';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $errorEmail = '<h6>Please a valid input email</h6>'; 
    }

    if ($pwd != $cpwd) {
    $error = true;
    $cpwdpwd = '<h6>Your passwords do not match</h6>';
    }

    if (!is_numeric($phoneno) || (strlen($phoneno) != 11)) {
    $error = true;
    $errorphone = '<h6>Please enter a valid Mobile Number</h6>';
    } 

    // check if users already exist
    
  //insert data if no error
      if (!$error) {
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $pwd = md5("$salt1$pwd$salt2");
    $sql1 = "INSERT INTO user(user_id, firstname, email, password, phoneno, day, month, year, gender) VALUES(NULL, '$firstname', '$email', '$pwd', '$phoneno', '$day', '$month', '$Year', '$gender')";
    if (mysqli_query($conn, $sql1)) {
      $msg4 = '<h5>Register successfully</h5>';
      header("location:login.php");
    }else{
      echo "Error " .mysqli_error($conn);
    }
   
  }

}
?>

<html>
  <head>
    <title>SignUp Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="row">
      <div class="column1 img1">
        <h1>WE break your GOALS into smaller bits.</h1>
      </div>
      <div class="column2 card">
        <img class="center" src="img/user.png">
    <h1>Sign Up</h1>
    <p>It's free and always will be.</p><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" autocomplete="off">
      <?php
          if (isset($msg4)) {
            ?>
              <div class="alert alert-success">
                <span class="glyphicon glyphicon-info-sign"></span>
                <?php echo $msg4; ?>
              </div>
            <?php
          }

        ?>
    <input type="text" class="name" name="firstname" value="<?php echo $firstname?>" placeholder="first name">
    <span class="text-danger"><?php if(isset($errorfirstname)) echo $errorfirstname; ?></span>

    <input type="email" class="email" name="email" value="<?php echo $email?>" placeholder="enter your email">
    <span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>

    <input type="password" class="pasword" name="pwd" placeholder="enter your password">

    <input type="password" class="pasword" name="cpwd" placeholder="enter your password again">
    <span class="text-danger"><?php if(isset($cpwdpwd)) echo $cpwdpwd; ?></span>

    <input type="number" class="number" name="phoneno" value="<?php echo $phoneno?>" placeholder="mobile number">

<br><br><br>
    <label>Birthday</label>
<select name='day'>
<option>Day</option>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select>
<select name='month'>
<option>Month</option>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
</select>
<select name='Year'>
<option >Year</option>
<option value='1948'>1948</option>
<option value='1949'>1949</option>
<option value='1950'>1950</option>
<option value='1951'>1951</option>
<option value='1952'>1952</option>
<option value='1953'>1953</option>
<option value='1954'>1954</option>
<option value='1955'>1955</option>
<option value='1956'>1956</option>
<option value='1957'>1957</option>
<option value='1958'>1958</option>
<option value='1959'>1959</option>
<option value='1960'>1960</option>
<option value='1961'>1961</option>
<option value='1962'>1962</option>
<option value='1963'>1963</option>
<option value='1964'>1964</option>
<option value='1965'>1965</option>
<option value='1966'>1966</option>
<option value='1967'>1967</option>
<option value='1968'>1968</option>
<option value='1969'>1969</option>
<option value='1970'>1970</option>
<option value='1971'>1971</option>
<option value='1972'>1972</option>
<option value='1973'>1973</option>
<option value='1974'>1974</option>
<option value='1975'>1975</option>
<option value='1976'>1976</option>
<option value='1977'>1977</option>
<option value='1978'>1978</option>
<option value='1979'>1979</option>
<option value='1980'>1980</option>
<option value='1981'>1981</option>
<option value='1982'>1982</option>
<option value='1983'>1983</option>
<option value='1984'>1984</option>
<option value='1985'>1985</option>
<option value='1986'>1986</option>
<option value='1987'>1987</option>
<option value='1988'>1988</option>
<option value='1989'>1989</option>
<option value='1990'>1990</option>
<option value='1991'>1991</option>
<option value='1992'>1992</option>
<option value='1993'>1993</option>
</select><br><br>
<label>Gender</label>
<select name="gender">
                <option>Male</option>
                <option>Female</option>
</select>

<br><br><br>
<p2>By clicking Sign Up, you have agree to our <a href="#">Terms and Conditions</a> and that you have read our <a href="#">Data Policy</a>, including our <a href="#">Cookie Use</a>.</p2>
<br><br>
<button class="btn" name="btn-signup"><i class="fa fa-spinner fa-spin"></i>Sign Up</button>

  </form>

</div>
<div class="column3">
  <img class="img" src="img/reader.jpeg">
  <h1>Our Partners</h1>
  <div class="partner">
  <img class="img3" src="img/HNG.PNG">
  <img class="img3" src="img/FLW-logo.svg">
  <img class="img3" src="img/lucid-logo.svg">
</div>
</div>



  </div>
  </body>
</html>