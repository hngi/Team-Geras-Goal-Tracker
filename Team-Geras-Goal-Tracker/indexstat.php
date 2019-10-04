<?php
    include_once 'includes/dbh.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <?php  
    $query = "SELECT user_id FROM user WHERE email ='$_SESSION[user]'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);for ($i = 0;$i < $row;++$i); {
        $goals = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo $row;
        $g_id = $goals['goal_id'];
        $query1 = "SELECT * FROM todo WHERE goal_id = '$g_id'";
        $result1 = mysqli_query($conn, $query1);
        $completed = 0;
        $not_completed = 0;    $row1 = mysqli_num_rows($result1);    for ($j = 0;$j < $row1;++$j)
        {
            $todos = mysqli_fetch_array($result1, MYSQLI_ASSOC);        if ($todos['completed'] == 1) {
                $completed = $completed + 1;
            } else {
                $not_completed = $not_completed + 1;
            }
        }    
        
        if ($not_completed == 0) {
            $pro = "Completed";
            $per = 100;
        } 
        
        else {
            $total = $not_completed + $completed;
            $pro = "Complete";
            $per = ($completed / $total) * 100;
        }    
        echo "$goals[title] $per % $pro <br>";
       echo $goals['description'] . "<br><br>";
    }
    ?>
    
    
</body>
</html