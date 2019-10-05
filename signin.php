<?php
require_once('config.php');
$redirectURL = "http://localhost/goal-tracker-facebook-login/fb-callback.php";
$permissions = ['email'];
$loginURL = $helper->getLoginUrl($redirectURL, $permissions);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mystyle.css">
    <script src="https://kit.fontawesome.com/f1c3882d23.js" crossorigin="anonymous"></script>
    <!--not working-->
</head>

<body>
    <!--Header with Logo and maybe nav bar to go in here later when logo is created-->
    <main>
        <div class="wrap">
            <!--Box containing Sign In form-->
            <h2>Sign In</h2>
            <p>You don't have an account? <a href="index.html">Sign up</a></p>
            <form>
                <input type="email" placeholder="Email address" required>
                <input type="password" placeholder="Password" required>
                <p style="text-align: center"><a href="">Forgot password?</a></p>
                <input type="submit" value="Sign In">

                <!--sign in with Twitter, facebook, google plus-->
                <div class="social-mediaicon">
                    <!--Sign up via social media-->
                    <input type="button" value="Sign In with Facebook" onclick="window.location='<?php echo $loginURL?>';" class="btn btn-primary">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer">
            <a href="https://www.000webhost.com/?utm_source=000webhostapp&utm_campaign=000_logo&utm_medium=website&utm_content=footer_img" target="_blank"><img src="https://res.cloudinary.com/kome/image/upload/v1570192562/hng/webhostlogo_mazb0d.webp" alt="webhost logo">
            </a>
        </div>
    </footer>
</body>

</html>