<?php
    session_start();
    $message = "";
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
          case "login":
            $user_name=$_POST["user_name"];
            $password=$_POST["password"];

            include("config/config.php");
            $result = mysqli_query($conn,"SELECT * FROM admin_user where `user_name` = '".$user_name."'");
            $row=mysqli_fetch_assoc($result);

            if(isset($row)){
                if($user_name == $row['user_name'] && $password == $row['user_password']){
                    $_SESSION["auth"]=true;
                    $_SESSION["user_name"]=$row['user_name'];
                    header("location: book/book_list.php");
                }
                else{
                    $message = "Invilid Password!";
                }
            }
            else{
                $message = "User Name doesn't exit!";
            }
            break;
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book - login</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon-32x32.png">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <link rel="stylesheet" href="../css/slider_bar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <h1>Welcome</h1>
            <p><?php echo $message ?></p>
            <form action="login.php?action=login&" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" id="login-button" class="btn btn-primary btn-login">Login</button>
            </form>
        </div>
        
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/datatables.min.js"></script>
</html>