<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    
    session_start();

    use public\utils\class\AuthLogout;

    $authLogout = new AuthLogout;    
    $authLogout->logoutUser(['user','nome','tipo','message_erro']);
    
    // sleep(3);
    
    header("Location: /login.php");
?>