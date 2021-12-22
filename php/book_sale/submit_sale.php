

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Success</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-32x32.png">
  
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php
    session_start();
    include("../config/config.php");
    
    $today_code = date("Ymd");
    $query_code = mysqli_query($conn,"Select * from sale_id_autogenerate where code='$today_code'");

    if( mysqli_num_rows($query_code) == 0) {
      $sql = "INSERT INTO sale_id_autogenerate(code, count_no) VALUES ('$today_code','1')";
      mysqli_query($conn,$sql);
      $today_code = "SAL".$today_code ."/1";
    }
    else{
      $row_code=mysqli_fetch_assoc($query_code);
      $old_code = $row_code['code'];
      $count_no = $row_code['count_no']+1;
      $today_code = "SAL".$today_code ."/".$count_no;
    }
    
    $book_sale_ID = $today_code;
    // $today = date();
    $sale_date = date('Y-m-d H:i:s');

    $total_qty = 0;
    $total_price = 0;
    foreach ($_SESSION["sale_item"] as $item){
      $total_qty += $item["quantity"] ;
      $total_price += ($item["price"]*$item["quantity"]);
    }

    $sql = "INSERT INTO `book_sale`(`sale_ID`, `sale_date`, `total_quantity`, `total_price`) VALUES ('$book_sale_ID', '$sale_date', '$total_qty', '$total_price');";
    mysqli_query($conn,$sql);
    
    foreach ($_SESSION["sale_item"] as $item){
      $sql = "INSERT INTO `book_sale_detail`(`sale_ID`, `book_ID`, `quantity`, `price`) VALUES ('$book_sale_ID', '".$item["book_ID"]."', '".$item["quantity"]."', '".$item["price"]."');";
      mysqli_query($conn,$sql);
    }
    unset($_SESSION["sale_item"]);

    if(!mysqli_num_rows($query_code) == 0) {
      $sql = "UPDATE sale_id_autogenerate SET count_no='$count_no' where code = $old_code";
      mysqli_query($conn,$sql);
    }
    echo "<div class='message-container'><div class='message-caption'><h1 style='text-align:center;'>Successfully Sale!</h1><form action='book_sale.php'><button type='submit' class='btn btn-primary'>OK</button></form></div></div>";
?>
</body>
</html>