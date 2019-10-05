<?php
session_start();
require_once('dbcon.php');
$t_goal = $t_todo = $c_goal = $c_todo = $width = 0;
$color = "";

if (!isset($_SESSION['user'])) {
  die(header("Location: login.php"));
} else {
  $email = $_SESSION['user'];
  $query = "SELECT * FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
  $user_id = $user['user_id'];

}

if (isset($_SESSION['user'])) { /* Page to output if login was successful */

$pagename = "$user[firstname] Dashboard";
echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css">
    <title>$pagename</title>
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

      <div class="collapse navbar-collapse" id="navbarNav">
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
            <a class="nav-link" href="#">Privacy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li>
            <a href="logout.php" class=""><b>Log out</b></a>
          </li>
        </ul>
      </div>
    </nav>
  <div class="menu pt-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <img src="img/star.png" />
          <span>SIMPLIFY LIFE</span>
        </div>
      </div>
      <div class="row center">
        <div class="col-12">
          <img src="img/user.png" class="logo-img" />
          <h6>$user[firstname]</h6>
        </div>
      </div>
      <div class="row margin-50">
        <div class="col-12">
          <ul>
            <li><a href="dashboard.php" class="active"><img src="img/dash1.png"> Dashboard</a></li>
            <li><a href=""><img src="img/addgoal.png"> Create Goal</a></li>
            <li><a href="goals.php"><img src="img/goal.png"> Goals</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="main mt-5 pt-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <a href="#"><b>What have you achieved today?</b></a>
      <div class="row margin-50">
_END;

  // Compute the dashboard Stat
  $query = "SELECT * FROM goals WHERE user_id = '$user_id' ORDER BY goal_id DESC";
  $result = mysqli_query($conn, $query);
  $row = mysqli_num_rows($result);

  if ($row == 0) {
    echo "<p>You haven't created any goals</p>";
    $t_goal = 0;
    $t_todo = 0;
    $c_goal = 0;
    $c_todo = 0;
  } else {
    for ($i = 0;$i < $row;++$i) {
      $goals = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $t_goal = $t_goal + 1;

      $g_id = $goals['goal_id'];
      $query1 = "SELECT * FROM todo WHERE goal_id = '$g_id'";
      $result1 = mysqli_query($conn, $query1);
      $completed = 0;
      $not_completed = 0;

      $row1 = mysqli_num_rows($result1);

      for ($j = 0;$j < $row1;++$j) {
        $todos = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $t_todo = $t_todo + 1;

        if ($todos['completed'] == 1) {
          $c_todo = $c_todo + 1;
        } else {
          $not_completed = $not_completed + 1;
        }
      }

      if ($not_completed == 0) {
        $c_goal = $c_goal + 1;
      } else {
        $total = $not_completed + $completed;
      }
    }
  }
echo <<<_END
        <div class="col-6 col-md-3">
          <h4>Total Goals</h4>
          <p class="bg-light">$t_goal</p>
        </div>
        <div class="col-6 col-md-3">
          <h4>Total Todo's</h4>
          <p class="bg-light">$t_todo</p>
        </div>
        <div class="col-6 col-md-3">
          <h4>Completed Goals</h4>
          <p class="bg-light">$c_goal</p>
        </div>
        <div class="col-6 col-md-3">
          <h4>Completed Todo's</h4>
          <p class="bg-light">$c_todo</p>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-12">
          <h5 class="mb-3">Recently added goals</h5>

_END;

  // Display 5 recently added Goals
  $query = "SELECT * FROM goals WHERE user_id = '$user_id' ORDER BY goal_id DESC LIMIT 5";
  $result = mysqli_query($conn, $query);
  $row = mysqli_num_rows($result);

  if ($row == 0) {
    echo "<p>You haven't created any goals</p>";
  } else {
    for ($i = 0;$i < $row;++$i) {
      $goals = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $g_id = $goals['goal_id'];
      $query1 = "SELECT * FROM todo WHERE goal_id = '$g_id'";
      $result1 = mysqli_query($conn, $query1);
      $completed = 0;
      $not_completed = 0;

      $row1 = mysqli_num_rows($result1);

      for ($j = 0;$j < $row1;++$j) {
        $todos = mysqli_fetch_array($result1, MYSQLI_ASSOC);

        if ($todos['completed'] == 1) {
          $completed = $completed + 1;
        } else {
          $not_completed = $not_completed + 1;
        }
      }

      if ($not_completed == 0) {
        $pro = "Completed";
        $per = 100;
        $width = $per;
      } else {
        $total = $not_completed + $completed;
        $pro = "Complete"; 
        $per = ($completed / $total) * 100;
        $per = number_format($per, 2);
        $width = number_format($per, 0);
      }

      switch ($per) {
          case $per <= 20:
              $color = "bg-danger";
              break;
          case $per <= 50:
              $color = "bg-warning";
              break;
          case $per <= 75:
              $color = "bg-primary";
              break;
          case $per <= 100:
              $color = "bg-success";
              break;
          default:
              $color = "";
      }

echo <<<_END
          <div class="row mb-1">
            <div class="col-6 col-md-4">
              <h6>
                <a href="todo.php?view=$g_id"><b>$goals[title]</b></a><br>
                <span class="text-muted">$goals[description]</span>
              </h6>
            </div>
            <div class="col-6 col-md-4">
              <div class="progress">
                <span class="$color" style="width: $width%;"></span>
              </div>
              <b class="text-warning ml-1">$per%</b>
            </div>
          </div>

_END;
/**
      echo "<p>";
        echo "<a class=title href=todo.php?view=" . $g_id . ">$goals[title]</a> $per% $pro <br />";
        echo $goals['description'] . "<br /><br />";
        echo "<a href=goals.php?del=" . $g_id . ' class="btn danger"><i class="fa fa-trash"></i> Delete</a><br><br>';
        echo "</p>";
**/
    }
  }

  //$user = $_SESSION['user'];
$pagename = "Welcome $user[firstname]";
echo <<<_END
        </div>
      </div>

      <footer>
        <div class="row">
          <div class="col-12 mt-5">
            
          </div>
        </div>
      </footer>
    </div>
  </div>
 <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
</body>
</html>

_END;

/**

        </div>

        <div class="footer">
            <p class="footer-p"> <span class="left"> TERMS OF USE </span> <span class="middle"> PRIVACY OF POLICY </span>
            <span class="right">&copy;2019</span> </p>                   

        </div>

    </div>

    <script src="script/main.js"></script>
</body>
</html>
**/
} else {
  header("location:login.php");
}
?>