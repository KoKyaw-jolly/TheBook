<?php 
    include("../config/config.php");

    $book_ID=$_GET["book_ID"];

    $result = mysqli_query($conn,"SELECT * FROM book where book_ID = '$book_ID'");
    $row=mysqli_fetch_assoc($result);
    
    $cover = $row['book_cover'];
    $filename = "../../img/book_covers/$cover";
    if (file_exists($filename)) {
        if($cover!="unknown.jpg"){
            unlink("../../img/book_covers/$cover");
        }
    }

    $sql = "Delete from book where book_ID='$book_ID'";
    mysqli_query($conn,$sql);

    header("location:book_list.php");
?>