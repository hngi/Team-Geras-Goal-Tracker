<?php session_start(); ?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style5.css">
</head>
<body>
    <div id="login-box">
        <div class="left-box">
            <h1>SIMPLY LIFE</h1><br><br><br>

            <img style="margin-left: 7.5em" src="img/Contact Avatar.jpg" class="avatar">

            <h3 style="margin-left: 7.5em">GOALS</h3><br>
            <h3 style="margin-left: 7.5em">TASKS</h3><br>
            <h3 style="margin-left: 7.5em">PROGRESS</h3>
        </div>
        <div class="right-box">
            <div>
                <form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>">
                    <?php
                        $servername = 'localhost';
                        $username = 'root';
                        $password = '';
                        $dbname = 'goal_tracker';
                        
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        
                        if (isset($_POST['submit'])){
                            $goal = $_POST['title'];
                            $task = $_POST['description'];
                            $query = "INSERT INTO goals (title,description) VALUES('$goal','$task') ";
                            $run_query = mysqli_query($conn,$query);
                        }
                    ?>
                    <label style="margin-left: 4.5em">GOAL:</label> 
                    <input type="text" text-align="start" name = "title" style="margin-left: 2.9em" id="textbox" placeholder=" Enter goal"><br><br>
                    <label style="margin-left: 4.5em">TASK:</label> 
                    <input type="text" style="margin-left: 3.5em" name="description" placeholder=" Enter Task"><br><br>
                    <label style="margin-left: 4.5em">CREATED</label> 
                    <input type="date" style="margin-left: 4.1em" name="date" placeholder=" Enter Date">
                    <p><input type="submit" style="margin-left: 8em " name="submit"  value = 'Create Goal'></p>
                    <br><br><br>
                </form>
            </div>
            <div class="top-box">
                <?php
                  $run_task = mysqli_query($conn," SELECT * FROM goals LIMIT 20 ");
                  while ($row = mysqli_fetch_assoc($run_task)){
                    $title1 = $row['title'];
                    $description = $row['description'];
                ?>
                    <h4><?php echo $title1; ?></h4>
                    <p><?php echo $description; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>