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
    $sql = "SELECT * FROM todo;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows( $result)
        if(resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row[todo_completed];
             }    
        }
    ?>
    
</body>
</html>

