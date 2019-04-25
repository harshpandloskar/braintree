<?php
    session_start();
    session_destroy();
    $_SESSION = [];
    /**
     * Set logged in cookie in browser
     */
    $cookie_name = "isLoggedIn";
    $cookie_value = "false";

    if(isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    header('Location: ./');
    exit;
?>