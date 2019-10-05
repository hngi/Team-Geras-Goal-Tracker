<?php
session_start();
require_once('dbcon.php');
$t_goal = $t_todo = $c_goal = $c_todo = $width = 0;
$color = "";

//Test if the user is logged in 
if (!isset($_SESSION['user'])) {
  die(header("Location: login.php"));
} else {
  $email = $_SESSION['user'];
  $query = "SELECT * FROM user WHERE email = '$email'"; //Retrive the user details
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
  $user_id = $user['user_id'];

}

if (isset($_SESSION['user'])) { /* Page to output if login was successful */

$pagename = "$user[firstname] Dashboard"; // page title
//Output the head and Nav Bar
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
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Team</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link"><b>Log out</b></a>
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
        </div>
      </div>
      <div class="row margin-50">
_END;
//End of Output the head and Nav Bar

  // Compute the dashboard Stat
  $query = "SELECT * FROM goals WHERE user_id = '$user_id' ORDER BY goal_id DESC";
  $result = mysqli_query($conn, $query);
  $qrow = mysqli_query($conn, "SELECT COUNT(*) FROM goals WHERE user_id = '$user_id' ORDER BY goal_id DESC");
  if ($qrow == FALSE) { // Fix the error passing boolean to the mysqli_fetch_array() function
    $row[0] = 0;        // when the user asn't created any goals
  } else {
    $row = mysqli_fetch_array($qrow, MYSQLI_NUM); // number of goals in related to the user
  }
  

  if ($row[0] == 0) { // when the user hasn't created any goals
    $t_goal = 0; //Total number of goals
    $t_todo = 0; // Total number of todo's
    $c_goal = 0; // Completed goals
    $c_todo = 0; // Completed todo's
  } else {
    for ($i = 0;$i < $row[0];++$i) { // loop through the result
      $goals = mysqli_fetch_array($result, MYSQLI_ASSOC); // Convert mySql result to array
      $t_goal = $t_goal + 1; // Count the Goals

      $g_id = $goals['goal_id'];
      $query1 = "SELECT * FROM todo WHERE goal_id = '$g_id'";
      $result1 = mysqli_query($conn, $query1);
      $completed = 0;
      $not_completed = 0;

      $qrow1 = mysqli_query($conn, "SELECT COUNT(*) FROM todo WHERE goal_id = '$g_id'");
      if ($qrow1 == FALSE) { // Fix the error passing boolean to the mysqli_fetch_array() function
        $row1[0] = 0;        // when the user asn't created any goals
      } else {
        $row1 = mysqli_fetch_array($qrow1, MYSQLI_NUM); // number of goals in related to the user
      }

      for ($j = 0;$j < $row1[0];++$j) { // loop through the result
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
  
  $qrow = mysqli_query($conn, "SELECT COUNT(*) FROM goals WHERE user_id = '$user_id' ORDER BY goal_id");
  if ($qrow == FALSE) { // Fix the error passing boolean to the mysqli_fetch_array() function
    $row[0] = 0;        // when the user asn't created any goals
  } else {
    $row = mysqli_fetch_array($qrow, MYSQLI_NUM); // number of goals in related to the user
  }

  if ($row[0] > 5) {
    $row[0] = 5;
  }

  if ($row[0] == 0) {
    echo "<p>You haven't created any goals</p>";
  } else {
    for ($i = 0;$i < $row[0];++$i) {
      $goals = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $g_id = $goals['goal_id'];
      $query1 = "SELECT * FROM todo WHERE goal_id = '$g_id'";
      $result1 = mysqli_query($conn, $query1);
      $completed = 0;
      $not_completed = 0;

      $qrow1 = mysqli_query($conn, "SELECT COUNT(*) FROM todo WHERE goal_id = '$g_id'");
      if ($qrow1 == FALSE) { // Fix the error passing boolean to the mysqli_fetch_array() function
        $row1[0] = 0;        // when the user asn't created any goals
      } else {
        $row1 = mysqli_fetch_array($qrow1, MYSQLI_NUM); // number of goals in related to the user
      }

      for ($j = 0;$j < $row1[0];++$j) {
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

      switch ($per) { // Progress bar and percentage color
          case $per <= 20:
              $color = "danger";
              break;
          case $per <= 50:
              $color = "warning";
              break;
          case $per <= 75:
              $color = "primary";
              break;
          case $per <= 100:
              $color = "success";
              break;
          default:
              $color = "";
      }

// Display goals
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
                <span class="bg-$color" style="width: $width%;"></span>
              </div>
              <b class="text-$color ml-1">$per%</b>
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

  // Output footer
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
        <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js"><\/script>')</script>
        
        <script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script> 
</body>
</html>

_END;

} else {
  header("location:login.php");
}
?>