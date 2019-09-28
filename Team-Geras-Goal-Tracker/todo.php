<?php
session_start();
require_once('dbcon.php');

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

if (isset($_GET['goal_id']) && $_GET['goal_id'] != "" && !isset($_GET['edit'])) { // Add todo
	$goal_id = sanitizeString($_GET['goal_id']);

	if (isset($_POST['title'])) { 
		if ($_POST['title'] != "") {
			$title = sanitizeString($_POST['title']);
			$query = "INSERT INTO todo(todo_id, goal_id, title, completed) VALUES(NULL,'$goal_id','$title','0')";

			if (mysqli_query($conn, $query)) {
				$msg = "Todo Saved, add another";
			} else {
				$error = "Not Saved, Try again";
			}
		} else {
			$error = "Empty Field";
		}
	}
echo $_GET['view'];
	if (isset($_GET['view']) && $_GET['view'] != "") { // Redirect to goals.php if the add todo requset came from there
		$red_id = sanitizeString($_GET['view']);		// or to todo.php if was initialised from here
		$redirect = "todo.php?view=$red_id";
		$red = "&view=".$red_id;
	} else {
		$redirect = "goals.php";
		$red = "";
	}
echo <<<_END
<div>
	<p>$msg $error</p>
	<form method="post" action="todo.php?goal_id=$goal_id $red">
		<input type="text" name="title" placeholder="" /><br />
		<button type="submit">Save Todo</button><br />
		<a href="$redirect">Done</a>
	</form>
</div>
_END;
	
} elseif (isset($_GET['edit'])) {//edit todo
	if ($_GET['edit'] == "") {
		$error = "Todo not found";
	} else {
		$todo_id = sanitizeString($_GET['edit']);
		$query = "SELECT * FROM todo WHERE todo_id = '$todo_id'";
		$result = mysqli_query($conn, $query);
		$todo = mysqli_fetch_assoc($result);
		if (isset($_POST['title']) && $_POST['title'] == "") {
			$error = "Field Can't be empty";
		} elseif (isset($_POST['title']) && $_POST['title'] != "") {
			if (empty($_POST['complete'])) {
				$comp = 0;
			} else {
				$comp = 1;
			}
			$title = sanitizeString($_POST['title']);
			$query1 = "UPDATE todo SET title = '$title', completed = '$comp'  WHERE todo_id = '$todo_id'";
			if (mysqli_query($conn, $query1)) {
				$msg = "Update Successful";
				header("Location: todo.php?view=$todo[goal_id]");
			} else {
				$error = "Upadte not successful";
			}
		}

		if ($todo['completed'] == 0) {
			$check = "";
		} else {
			$check = "checked";
		}
echo <<<_END
<div>
	<p>$msg $error</p>
	<form method="post" action="todo.php?edit=$todo_id">
		<input type="text" name="title" placeholder="" value="$todo[title]" /> <br />
		<input type="checkbox" name="complete" value="completed" $check /> Completed <br />
		<button type="submit">Update</button>
		<a href="">Cancel</a>
	</form>
</div>
_END;
	}
} else { //view all todos under a goal
	if (isset($_GET['view']) && $_GET['view'] != "") {
		$id = sanitizeString($_GET['view']);
		$query = "SELECT * FROM goals WHERE goal_id = '$id'";
		$result = mysqli_query($conn, $query);
		$goal = mysqli_fetch_assoc($result);

echo <<<_END
		<div>
		<a href="goals.php">Go back to goal</a>
		<h3>$goal[title]</h3>
		<p>$goal[description]</p>
		
_END;
		$query1 = "SELECT * FROM todo WHERE goal_id = '$id'";
		$result1 = mysqli_query($conn, $query1);
		$completed = 0;
		$not_completed = 0;
		$row = mysqli_num_rows($result1);

		echo "<p><b>Todos</b><br />";
		for ($j = 0;$j < $row;++$j) {
			$todos = mysqli_fetch_array($result1, MYSQLI_ASSOC);

				echo "$todos[title] <a href='todo.php?edit=$todos[todo_id]'>Edit</a>";
			if ($todos['completed'] == 1) {
				$completed = $completed + 1;
				$pro = " - Completed";
			} else {
				$not_completed = $not_completed + 1;
				$pro = " - Not completed";
			}
			echo "$pro <br />";
		}
		echo "<a href='todo.php?goal_id=$id&view=$id'>Add new todo</a></p>";

		if ($not_completed == 0) {
			$pro = "Completed";
			$per = 100;
		} else {
			$total = $not_completed + $completed;
			$pro = "Complete";
			$per = ($completed / $total) * 100;
		}
echo <<<_END
			<h2>$per% $pro</h2>
		</div>
_END;
	} else {
		echo "Goal not found<br />";
		echo "<a href='goals.php'>Go Back</a>";
	}
}

?>