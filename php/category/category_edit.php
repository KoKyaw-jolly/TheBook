<?php
    include("../config/auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Edit</title>
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
            <li>
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
            <li class="sidebar-active">
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
            <div class="main_content_header">Edit Category</div>
            <div class="main_content">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        include("../config/config.php");
                        $category_ID = $_POST["category_ID"];
                        $category_Name = $_POST["category_Name"];

                        
                        $sql = "UPDATE category SET category_Name='$category_Name' where category_ID='$category_ID'"; 
                        // mysqli_query($conn,$sql);
                        
                        if ($conn->query($sql) === TRUE) {
                            echo '<script language="javascript">';
                            echo 'alert("Your record Update successfully")';
                            echo '</script>';
                        }

                        header("location:category_list.php");
                    }
                ?>
                <?php 
                    include("../config/config.php");
                    $category_ID=$_GET['category_ID'];
                    $result = mysqli_query($conn,"Select * from category where category_ID='$category_ID'");
                    $row=mysqli_fetch_assoc($result);
                ?>
                <div style="margin-bottom: 20px;">
                    <a href="category_list.php" class="back-link"><i class="fa fa-reply" aria-hidden="true"></i>Back to category List</a>
                </div>
                <div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-group">
                            <label for="category_ID">Category ID</label>
                            <input type="text" class="form-control" id="category_ID" name="category_ID" placeholder="Category ID" value="<?php echo $row['category_ID'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="category_Name">Category Name</label>
                            <input type="text" class="form-control" id="category_Name" name="category_Name" placeholder="Category Name" value="<?php echo $row['category_Name'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" onClick="return confirm('Are You Sure?')">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- JavaScript -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/datatables.min.js"></script>
    <script src="../../js/slider_bar.js"></script>
</body>
</html>