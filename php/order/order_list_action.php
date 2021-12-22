<?php

include("../config/config.php");

if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    case "claim":
        $order_ID=$_GET["order_ID"];
        $sql = "UPDATE `order` SET order_status='claim' where order_ID='$order_ID'";  
        mysqli_query($conn,$sql);
    break;
    case "complete":
        $order_ID=$_GET["order_ID"];
        $sql = "UPDATE `order` SET order_status='complete' where order_ID='$order_ID'";  
        mysqli_query($conn,$sql);
    break;
  }
  
}
header("location:order_list.php");
?>