<?php
include_once('dbcon.php');

//check empty fields
$error = false;
$goal = $date = $task = "";

if (isset($_POST['submit'])) {

  // To validate
  if (empty($goal)) {
    $error = true;
    $errorgoal = '<h6>Please input goal title</h6>';
  }

  if (empty($date)) {
    $error = true;
    $errordate = '<h6>Please enter a date</h6>';
  }

  if (empty($task)) {
    $error = true;
    $errortask = '<h6>Please enter a date</h6>';
  }
  
  //insert data if no error
  require_once('dbcon.php');
  if (isset($_POST['submit'])) {
    $goal = $_POST['title'];
    $task = $_POST['description'];
    $query = "INSERT INTO goals (title,description) VALUES('','','$goal','','$task') ";
    $run_query = mysqli_query($conn, $query);
    if (mysqli_query($conn, $query)) {
      $msg4 = '<h5>goal created successfully</h5>';
      header("location:todo.php?goal_id=$goal_id");
    } else {
      echo "Error " . mysqli_error($conn);
    }
  }
}
?>

<html>

<head>
  <title>Create Goals</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  <div class="wrapper">

    <div class="first">
      <a class="click-toggle" href="#">
        <img class="star" src="img/star.png">
      </a>
      <p class="sim-p">SIMPLIFY LIFE</p>
    </div>

    <div class="second">
      <img class="logo center" src="img/logo.png">
      <h5>$user</h5>

      <Center>
        <a class="center flow side-menu" href="goal.php"> <img class="m-img" src="img/goal.jpg"> GOALS </a>
      </Center> <br>

      <center>
        <a class="center side-menu" href="#"> <img class="m-img" src="img/statistics.png"> STATISTICS </a>
      </center> <br>

      <Center>
        <a class="center l-down" href="logout.php"> <u>LOG OUT </u> </a>
      </center><br>
    </div>
    <div class="third">
      <form>
        <span class="text-danger"><?php if (isset($errorgoal)) echo $errorgoal; ?></span>
        <label>GOAL:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="goal" value="<?php echo $goal ?>" placeholder=" Enter goal"><br><br>
        <span class="text-danger"><?php if (isset($errordate)) echo $errordate; ?></span>
        <label>CREATED:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="date" name="date" value="<?php echo $date ?>"><br><br>
        <label>DESCRIPTION:</label>&nbsp;&nbsp;&nbsp;
        <textarea name="description" value="<?php echo $task ?>" placeholer="Enter the details of your goal"></textarea><br><br>
        <input type="submit" name="submit" value='Create goal'>
      </form>
    </div>
  </div>
</body>
</html>