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
                            $query = "INSERT INTO goals (title) VALUES('$goal') ";
                            $run_query = mysqli_query($conn,$query);
                        }
                        if (isset($_POST['todo'])){
                            $task = $_POST['description'];
                            $query = "INSERT INTO todo (description) VALUES('$task') ";
                            $run_query = mysqli_query($conn,$query);
                        }
                    ?>
                    <label style="margin-left: 7em">GOAL:</label> 
                    <input type="text" text-align="start" name = "title" style="margin-left:1em" id="textbox" placeholder=" Enter goal">
                    <input type="submit" style="margin-left: 2px " name="submit"  value = 'Create Goal'>
                    <br>
                    <hr>
                </form>
            </div>
            <div class="top-box">
                <?php
                    $run_goal = mysqli_query($conn," SELECT * FROM goals LIMIT 20 ");
                    $run_task = mysqli_query($conn," SELECT * FROM todo LIMIT 20 ");
                    while ($row = mysqli_fetch_assoc($run_goal)){
                        $title1 = $row['title'];

                    while ($row = mysqli_fetch_assoc($run_task)){
                        $todo = $row['description'];
                ?>
                    <h4 style='color:blue;'><?php echo $title1; ?></h4>
                    <form method='post' action="<?php $_SERVER['PHP_SELF'] ?>" >
                        <label style="margin-left: 10px">TASK:</label> 
                        <input type="text" style="margin-left: 2px" name="description" placeholder=" Enter Task">
                        <input type="submit" style="margin-left: 2px " name="todo"  value = 'Create Todo'>
                        <br><br> 
                    </form>
                    <div> <p><?php echo $todo; ?></p> </div>  
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>