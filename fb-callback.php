<?php

use Facebook\Authentication\AccessToken;

require_once "config.php";
    try{
        $accessToken = $helper ->getAccessToken();
    } catch(\Facebook\Exceptions\FacebookResponseException $e){
        echo "Response Exception: " . $e->getMessage();
        exit();
    } catch(\Facebook\Exceptions\FacebookSDKException $e){
        echo "SDK Exception: " . $e->getMessage();
        exit();
    }
    if (!$accessToken){
        header("location:signin.php");
        exit();
    }
    $oauth2Client = $FB->getOAuth2Client();
    if(!$accessToken->isLongLived())
        $accessToken = $oauth2Client->getLongLivedAccessToken($accessToken);
    $response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
    $userData = $response->getGraphNode()->asArray();
    /* var_dump($userData); */
    
    $_SESSION['userData'] = $userData;
    $_SESSION['access_token'] = (string)$accessToken;
    header ("location: dashboard.php");
    exit();

?>