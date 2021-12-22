<?php 
    include("../config/config.php");
    $author_ID=$_GET["author_ID"];
    $sql = "Delete from author where author_ID='$author_ID'";
    mysqli_query($conn,$sql);

    header("location:author_list.php");
?>