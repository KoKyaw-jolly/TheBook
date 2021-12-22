<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "thebook";

    $conn = mysqli_connect ($dbhost,$dbuser,$dbpassword);
    mysqli_select_db($conn,$dbname);
?>