<?php
    session_start();
    ob_start();

    if (isset($_SESSION['login'])) {
        session_destroy();
        unset($_SESSION['login']);
        unset($_SESSION['nickname']);
        unset($_SESSION['role']);
        header("Location: index.php");
    }

    if(isset($_COOKIE['_uid_']) && isset($_COOKIE['_unickname_'])) {
        setcookie('_uid_', '', time() - 60 * 60 * 24, '/', '', '', true);
        setcookie('_unickname_', '', time() - 60 * 60 * 24, '/', '', '', true);
    }

    header("Location: index.php");

?>