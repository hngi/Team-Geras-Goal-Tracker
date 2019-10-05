<?php
    session_start();

    require_once "Facebook/autoload.php";
    $FB = new \Facebook\Facebook([
        'app_id' => '2504658489771563', 
        'app_secret' => '63cdb104ca070221c329e8b2fe274c9f',
        'default_graph_version'=>'v4.0'
    ]);
    $helper = $FB->getRedirectLoginHelper();
?>