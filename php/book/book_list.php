<?php
    include("../config/auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
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
            <div class="main_content_header">Book List</div>
            <div class="main_content">
                <button type="button" class="btn btn_create_new">
                    <a href="book_new.php">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Create New Book
                    </a>
                </button>
                <?php
                    include("../config/config.php");
                    $result = mysqli_query($conn,"SELECT book.*, category.category_Name, author.author_Name FROM book LEFT JOIN category ON book.category_ID = category.category_ID LEFT JOIN author ON book.author_ID = author.author_ID order By book.book_ID");
                ?>
                
                <table id="book_list_table" class="table list display" style="width:100%">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Book Cover</th>
                        <th scope="col">Book ID</th>
                        <th scope="col">Book Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Language</th>
                        <th scope="col">Publish Date</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; while($row=mysqli_fetch_assoc($result)) {?>
                            <tr>
                                <th scope="row">
                                    <?php echo $i ?>
                                </th>
                                <th scope="row">
                                    <img src="../../img/book_covers/<?php echo $row['book_cover'] ?>" alt="" style="width:100px;height:150px;object-fit: cover;">
                                </th>
                                <th scope="row">
                                    <?php echo $row['book_ID'] ?>
                                </th>
                                <th scope="row">
                                    <?php echo $row['book_Title'] ?>
                                </th>
                                <th scope="row">
                                    <?php echo $row['author_Name'] ?>
                                </th>
                                <th scope="row">
                                    <?php echo $row['category_Name'] ?>
                                </th>
                                <th scope="row">
                                    <?php echo $row['language'] ?>
                                </th>
                                <th scope="row">
                                    <?php 
                                    if($row['publish_date']=='0000-00-00'){
                                        echo "Unknow Date!";
                                    }
                                    else{
                                        $phpdate = strtotime( $row['publish_date'] );
                                        $mysqldate = date( 'd/m/Y', $phpdate );
                                        echo $mysqldate;
                                    } ?>
                                </th>
                                <th scope="row">
                                    <?php echo $row['price'] ?> MMK
                                </th>
                                <th scope="row">
                                    <a href="book_edit.php?book_ID=<?php echo $row['book_ID'] ?>" class="edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="book_delete.php?book_ID=<?php echo $row['book_ID'] ?>" class="del" onClick="return confirm('Are You Sure?')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i></a>                      
                                </th>
                            </tr>
                        <?php $i++;} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- JavaScript -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/datatables.min.js"></script>
    <script src="../../js/slider_bar.js"></script>
    <script>
        $(document).ready(function() {
            $('#book_list_table').DataTable( {
                "scrollX": true
            } );
        } );
    </script>
</body>
</html>