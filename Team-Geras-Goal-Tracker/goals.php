<?php
session_start();
require_once('dbcon.php');
$pagename = "Goals";

if (!isset($_SESSION['user'])) {
	die(header("Location: login.php"));
} else {
	$email = $_SESSION['user'];
	$query = "SELECT * FROM user WHERE email = '$email'";
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);
	$user_id = $user['user_id'];

}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}

$msg = $error = "";

if (isset($_GET['del'])) {
	$id = sanitizeString($_GET['del']);

	if (isset($_GET['ans']) && $_GET['ans'] == "yes") {
		$query = "DELETE FROM todo WHERE goal_id = $id";
		$query1 = "DELETE FROM goals WHERE goal_id = $id";
		if (mysqli_query($conn, $query) && mysqli_query($conn, $query1)) {
			$msg = "Deleted Successfully";
		} else {
			$error = "Didn't Deleted Successfully";
		}
	} elseif (isset($_GET['ans']) && $_GET['ans'] == "no") {
		$msg = "Delete Cancelled";
	} else {
require_once('header.php');
echo <<<_END
<p> Are you sure you want to delete this goal
<a href="goals.php?del=$id&ans=yes" class="btn danger"><i class="fa"></i>Yes</a> || <a href="goals.php?del=$id&ans=no" class="btn"><i class="fa"></i>No</a>
_END;
		die();
	}
} elseif (isset($_POST['edit'])) {
	# code...
}

require_once('header.php');
echo $error . $msg . "<br><br>";

$query = "SELECT * FROM goals WHERE user_id = '$user_id' ORDER BY goal_id DESC";
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
		} else {
			$total = $not_completed + $completed;
			$pro = "Complete"; 
			$per = ($completed / $total) * 100;
			$per = number_format($per, 2);
		}

		echo "<p>";
	    echo "<a href=todo.php?view=" . $g_id . ">$goals[title]</a> $per% $pro <br />";
	    echo $goals['description'] . "<br /><br />";
	    echo "<a href=goals.php?del=" . $g_id . ' class="btn danger"><i class="fa fa-trash"></i> Delete</a><br><br>';
	    echo "</p>";
	}
}

require_once('footer.php');
?>