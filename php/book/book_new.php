<?php
    include("../config/auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book New</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-32x32.png">
    
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/datatables.min.css">
    <link rel="stylesheet" href="../../css/slider_bar.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <!-- slider-bar Start -->
    <div class="sidebar">
        <div class="logo-details">          
            <div class="logo_name"><img src="../../img/logo.svg" alt="" style="width: 160px;"></div>
            <i class="fa fa-bars" id="btn-menu"></i>
        </div>
        <ul class="nav-list">
            <li class="sidebar-active">
                <a href="../book/book_list.php">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span class="links_name">Book List</span>
                </a>
                <span class="tooltip">Book List</span>
            </li>
            <li>
                <a href="../author/author_list.php">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="links_name">Author List</span>
                </a>
                <span class="tooltip">Author List</span>
            </li>
            <li>
                <a href="../category/category_list.php">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    <span class="links_name">Category List</span>
                </a>
                <span class="tooltip">Category List</span>
            </li>
            <li>
                <a href="../order/order_list.php">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    <span class="links_name">Order Request List</span>
            </a>
            <span class="tooltip">Order Request List</span>
            </li>
            <li>
                <a href="../book_sale/book_sale.php">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="links_name">Point Of Sale</span>
                </a>
            <span class="tooltip">Point Of Sale</span>
            </li>
            <li>
                <a href="../book_sale/book_sale_report.php">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <span class="links_name">Sale Report</span>
                </a>
                <span class="tooltip">Sale Report</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <div class="name_job">
                        <div class="name"> <?php echo $_SESSION["user_name"]?> </div>
                        <div class="job">Admin</div>
                    </div>
                </div>
                <form action="../logout.php">
                <button type="submit" id="log_out"><i class="fa fa-sign-out" onClick="return confirm('Are you sure want to logout?')"></i></button>
                </form>
            </li>
        </ul>
    </div>
    <!-- slider-bar end -->
    <section class="home-section">
        <div class="main_content_wrapper">
            <div class="main_content_header">Create New Book</div>
            <div class="main_content">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        include("../config/config.php");
                        
                        $book_ID = $_POST["book_ID"];
                        $book_Title = $_POST["book_Title"];
                        $author_ID = $_POST["author_ID"];
                        $category_ID = $_POST["category_ID"];
                        $language = $_POST["language"];
                        $publish_date = $_POST["publish_date"];
                        $book_cover=$_FILES['book_cover']['name'];
                        $tmp=$_FILES['book_cover']['tmp_name'];
                        $price = $_POST["price"];

                        if($book_cover){
                            move_uploaded_file($tmp,"../../img/book_covers/$book_cover");
                        }
                        else{
                            $book_cover = "unknown.jpg";
                        }

                        $sql = "INSERT INTO book(book_ID, book_Title, author_ID,category_ID, `language`, publish_date, book_cover, price)  
                        VALUES ('$book_ID','$book_Title','$author_ID','$category_ID','$language','$publish_date','$book_cover','$price')";
                        // mysqli_query($conn,$sql);
                        
                        if ($conn->query($sql) === TRUE) {
                            echo '<script language="javascript">';
                            echo 'alert("New record created successfully")';
                            echo '</script>';
                        }

                    }
                ?>
                <div style="margin-bottom: 20px;">
                    <a href="book_list.php" class="back-link"><i class="fa fa-reply" aria-hidden="true"></i>Back to Book List</a>
                </div>
                
                <div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="book_ID">Book ID</label>
                            <input type="text" class="form-control" id="book_ID" name="book_ID" placeholder="Book ID" required>
                        </div>
                        <div class="form-group">
                            <label for="book_Title">Book Title</label>
                            <input type="text" class="form-control" id="book_Title" name="book_Title" placeholder="Book Title" required>
                        </div>
                        <div class="form-group">
                            <label for="author_ID">Author</label>
                            <select class="form-control" id="author_ID" name="author_ID">
                                <option value="Unknown">  --  Choose --  </option>
                                <?php 
                                    include("../config/config.php");
                                    $result = mysqli_query($conn,"SELECT * FROM author"); 
                                    while($row=mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $row['author_ID'] ?>"><?php echo $row['author_Name'] ?></option> <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_ID">Category</label>
                            <select class="form-control" id="category_ID" name="category_ID">
                                <option value="Unknown">  --  Choose --  </option>
                                <?php 
                                    include("../config/config.php");
                                    $result = mysqli_query($conn,"SELECT * FROM category"); 
                                    while($row=mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $row['category_ID'] ?>"><?php echo $row['category_Name'] ?></option> <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="auther_Name">Language</label>
                            <select class="form-control" id="language" name="language">
                                <option>Myanmar</option>
                                <option>English</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="publish_date">Publish Date</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date" placeholder="Publish Date">
                        </div>
                        <div class="form-group">
                            <label >Book Cover</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="book_cover" name="book_cover">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="price" value="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <div class="main_content_wrapper">
        
        <h1></h1>
    </div>
    <!-- JavaScript -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/datatables.min.js"></script>
    <script src="../../js/slider_bar.js"></script>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
</html>