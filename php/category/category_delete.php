<?php 
    include("../config/config.php");
    $category_ID=$_GET["category_ID"];
    $sql = "Delete from category where category_ID='$category_ID'";
    mysqli_query($conn,$sql);

    header("location:category_list.php");
?>