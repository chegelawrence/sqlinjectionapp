<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['token']);

    session_destroy();

    header("Location: /login.php");

// done