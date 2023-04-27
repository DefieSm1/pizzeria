<?php
    unset($_COOKIE['userLoggedIn']);
    setcookie("userLoggedIn", "", time() - 300);
    unset($_COOKIE['userRole']);
    setcookie("userRole", "", time() - 300);
    
    session_start();
    session_destroy();

    header('Location: index.php');
    exit;
?>