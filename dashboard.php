<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style2.css">
    <title>Stat</title>
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
            <img class="logo center" src="<?php echo $_SESSION['userData']['picture']['url']?>">
            <h5><?php echo $_SESSION['userData']['id']?></h5>

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
            <p class="p-1"> <u> WOULD YOU LIKE TO START A GOAL? </u> </p>
            <img class="chart" src="img/chart.png">
            <p class="p-2"> <u> YOUR GOAL PROGRESS </u> </P>


            <ul>
                <li style=" list-style-img: url('img/green.png')">READ 20 BOOKS IN 2019 <img class="li-img" src="img/book.png"> </li>

                <li style=" list-style-img: url('img/red.png')">READ "PSYCHOLOGY OF INFLUENCE <img class="li-img" src="img/book.png"></li>



                <li style=" list-style-img: url('img/yellow.png')">READ PRAGMATIC PROGRAMMING <img class="li-img" src="img/book.png"></li>

                <li style=" list-style-img: url('img/purple.png')">BUILD A STRONG BODY IN 2019 <img class="li-img" src="img/gym.png"></li>

                <li style=" list-style-img: url('img/blue.png')">WALK 30KM IN AUGUST <img class="li-img" src="img/walk.png"></li>
            </ul>

            <div class="chart">
            </div>
        </div>
    </div>
    <script src="script/main.js"></script>
</body>

</html>
