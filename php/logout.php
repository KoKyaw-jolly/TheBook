<?php

    session_start();
    unset($_SESSION["auth"]);
    unset($_SESSION["user_name"]);
    header("location: login.php");

?>