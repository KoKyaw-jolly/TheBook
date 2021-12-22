<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirm</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-32x32.png">
  
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  
<?php
    session_start();
    include("../config/config.php");
    
    $today_code = date("Ymd");
    $query_code = mysqli_query($conn,"Select * from order_id_autogenerate where code='$today_code'");

    if( mysqli_num_rows($query_code) == 0) {
      $sql = "INSERT INTO order_id_autogenerate(code, count_no) VALUES ('$today_code','1')";
      mysqli_query($conn,$sql);
      $today_code = "ORD".$today_code ."/1";
    }
    else{
      $row_code=mysqli_fetch_assoc($query_code);
      $old_code = $row_code['code'];
      $count_no = $row_code['count_no']+1;
      $today_code = "ORD".$today_code ."/".$count_no;
    }
    
    $order_ID = $today_code;
    $order_date = date('Y-m-d H:i:s');
    $customer_name = $_POST["customer_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $order_address = $_POST["order_address"];
    $remark = $_POST["remark"];
    $order_status = "request";

    $sql = "INSERT INTO `order`(`order_ID`, `order_date`, `customer_name`, `phone_number`, `email`, `order_address`, `remark`,`order_status`)VALUES ('$order_ID','$order_date', '$customer_name', '$phone_number', '$email', '$order_address', '$remark','$order_status');";
    mysqli_query($conn,$sql);
    
    foreach ($_SESSION["cart_item"] as $item){
      $sql = "INSERT INTO `order_detail`(`order_ID`, `book_ID`, `quantity`, `price`)VALUES ('$order_ID', '".$item["book_ID"]."', '".$item["quantity"]."', '".$item["price"]."');";
      mysqli_query($conn,$sql);
    }
    unset($_SESSION["cart_item"]);

    if(!mysqli_num_rows($query_code) == 0) {
      $sql = "UPDATE order_id_autogenerate SET count_no='$count_no' where code = $old_code";
      mysqli_query($conn,$sql);
    }

    echo "<div class='message-container'><div class='message-caption'><h1 style='text-align:center;'>Your Order is Successfully Submit!</h1><form action='book_menu.php'><button type='submit' class='btn btn-primary'>OK</button></form></div></div>";
?>
</body>
</html>
