<?php

echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style2.css">
    <title>$pagename</title>
    <style>
	.btn {
	  background-color: DodgerBlue;
	  border: none;
	  color: white;
	  padding: 12px 16px;
	  font-size: 16px;
	  cursor: pointer;
	}

	/* Darker background on mouse-over */
	.btn:hover {
	  background-color: RoyalBlue;
	}
	.gray {color: #3d3d3d; text-align: left;}
	.danger {background-color: #f44336;} /* Red */
	.danger:hover {background: #da190b;}
	.info {
  		border-color: #2196F3;
  		color: white;
	}
	.third {
		border: none;
	}

.info:hover {
  background: #2196F3;
  color: white;
}
	</style>
</head>
<body>
    <div class="wrapper">

        <div class="first">
            <a class="click-toggle" href="#">
            <img  class="star" src="image/star.png"> 
            </a>
            <p class="sim-p">SIMPLIFY LIFE</p>
        </div>

        <div class="second">
            <img class="logo center" src="image/logo.png">
            <h5>$user[firstname]</h5>

            <Center> <a class="center flow side-menu" href="dashboard.php"> <img class="m-img" src="image/goal.jpg">  Dashboard </a> </Center> <br>

            <center> <a class="center side-menu" href="goals.php"> <img class="m-img" src="image/statistics.png"> Goals Stat </a> </center> <br>

             <Center> <a class="center l-down"  href="logout.php">  <u>LOG OUT </u> </a> </center><br>
        </div>

        <div class="third">
_END;

?>