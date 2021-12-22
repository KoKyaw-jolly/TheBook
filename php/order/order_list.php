<?php
    include("../config/auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-32x32.png">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/datatables.min.css">
    <link rel="stylesheet" href="../../css/slider_bar.css">
    <link rel="stylesheet" href="../../css/style.css">

    <style>
        .dataTable thead tr th,
        .dataTable tbody tr th{
            border: 1px solid #dee2e6;
            max-width: 300px;
            min-width: 120px;
        }

        .dataTable thead tr td:nth-child(9) td,
        .dataTable tbody tr td:nth-child(9) td {
            min-width: 180px;
        }   

        .dataTable thead tr th:first-child,
        .dataTable tbody tr th:first-child{
            min-width: 35px !important;
        }
        .dataTable thead tr th:last-child,
        .dataTable tbody tr th:last-child{
            min-width: 80px !important;
        }
        
        .tab-content>.tab-pane{
            padding: 30px;
            border-top: 3px solid #17173b;
            border-radius: 0px 0px 25px 25px;
            transition: all 0.7s ease;
        }
        .nav-tabs .nav-link{
            color: #495057;
            background-color: #d2d2d2;
            font-size: 20px;
            padding: 8px 30px;
            border-radius: 25px 25px 0px 0px;
            transition: all 0.7s ease;
        }
        .nav-tabs .nav-link.active {
            background-color: #17173b;
            color: #fff;
            border-color: #17173b;
        }
    </style>
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
            <li>
                <a href="../category/category_list.php">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    <span class="links_name">Category List</span>
                </a>
                <span class="tooltip">Category List</span>
            </li>
            <li class="sidebar-active">
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
            <div>
                <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-request-tab" data-toggle="tab" href="#nav-request" role="tab" aria-controls="nav-request" aria-selected="true">Request Order</a>
                    <a class="nav-item nav-link" id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">Claimed Order</a>
                    <a class="nav-item nav-link" id="nav-delivered-tab" data-toggle="tab" href="#nav-delivered" role="tab" aria-controls="nav-delivered" aria-selected="false">Complete Order</a>
                </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-request" role="tabpanel" aria-labelledby="nav-request-tab">
                        <?php
                            include("../config/config.php");
                            $result = mysqli_query($conn,"SELECT * FROM `order` where `order_status` = 'request' order By `order`.`order_ID`");
                        ?>
                        <table id="order_request_table" class="table list display" style="width:100%">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Remark</th>
                                <th scope="col" class="books_list_width">Order Books</th>
                                <th scope="col">Total Price</th>
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
                                            <?php echo $row['order_ID'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo date_format(date_create($row['order_date']),'d/m/Y') ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['customer_name'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['phone_number'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['email'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['order_address'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['remark'] ?>
                                        </th>
                                        <th scope="row" style="min-width:200px;">
                                        <?php		
                                            $total_quantity = 0;
                                            $total_price = 0;
                                            include("../config/config.php");
                                            $result_books = mysqli_query($conn,"SELECT `order_detail`.*,`book`.book_Title FROM `order_detail` LEFT JOIN `book` ON `order_detail`.book_ID = book.book_ID where `order_ID` = '".$row['order_ID']."'");
                                            while($row_books=mysqli_fetch_assoc($result_books)) { ?>
                                            <ul>
                                                <li><?php echo $row_books['book_Title'] ?> ( <?php echo $row_books['quantity'] ?> )</li>
                                            <?php
                                                $total_price += ($row_books['price']*$row_books['quantity']);
                                            ?>
                                            </ul>
                                        <?php    }
                                        ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $total_price ?>
                                        </th>
                                        <th scope="row">
                                            <form method="post" action="order_list_action.php?action=claim&order_ID=<?php echo $row['order_ID'] ?>">
                                                <input type="text" id="order_ID" name="order_ID" value="<?php echo $row['order_ID'] ?>" style="display:none;">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Claim</button>
                                            </form>
                                        </th> 
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                        <?php
                            include("../config/config.php");
                            $result = mysqli_query($conn,"SELECT * FROM `order` where `order_status` = 'claim' order By `order`.`order_ID`");
                        ?>
                        <table id="order_claim_table" class="table list display" style="width:100%">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Remark</th>
                                <th scope="col">Order Books</th>
                                <th scope="col">Total Price</th>
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
                                            <?php echo $row['order_ID'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo date_format(date_create($row['order_date']),'d/m/Y') ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['customer_name'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['phone_number'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['email'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['order_address'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['remark'] ?>
                                        </th>
                                        <th scope="row" style="min-width:200px;">
                                        <?php		
                                            $total_quantity = 0;
                                            $total_price = 0;
                                            include("../config/config.php");
                                            $result_books = mysqli_query($conn,"SELECT `order_detail`.*,`book`.book_Title FROM `order_detail` LEFT JOIN `book` ON `order_detail`.book_ID = book.book_ID where `order_ID` = '".$row['order_ID']."'");
                                            while($row_books=mysqli_fetch_assoc($result_books)) { ?>
                                            <ul>
                                                <li><?php echo $row_books['book_Title'] ?> ( <?php echo $row_books['quantity'] ?> )</li>
                                            <?php
                                                $total_price += ($row_books['price']*$row_books['quantity']);
                                            ?>
                                            </ul>
                                        <?php    }
                                        ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $total_price ?>
                                        </th>
                                        <th scope="row">
                                            <form method="post" action="order_list_action.php?action=complete&order_ID=<?php echo $row['order_ID'] ?>">
                                                <input type="text" id="order_ID" name="order_ID" value="<?php echo $row['order_ID'] ?>" style="display:none;">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle" aria-hidden="true"></i></i> Complete</button>
                                            </form>
                                        </th> 
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-delivered" role="tabpanel" aria-labelledby="nav-delivered-tab">
                        
                    <?php
                            include("../config/config.php");
                            $result = mysqli_query($conn,"SELECT * FROM `order` where `order_status` = 'complete' order By `order`.`order_ID`");
                        ?>
                        <table id="order_complete_table" class="table list display" style="width:100%">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Remark</th>
                                <th scope="col">Order Books</th>
                                <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; while($row=mysqli_fetch_assoc($result)) {?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $i ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['order_ID'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo date_format(date_create($row['order_date']),'d/m/Y') ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['customer_name'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['phone_number'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['email'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['order_address'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['remark'] ?>
                                        </th>
                                        <th scope="row" style="min-width:200px;">
                                        <?php		
                                            $total_quantity = 0;
                                            $total_price = 0;
                                            include("../config/config.php");
                                            $result_books = mysqli_query($conn,"SELECT `order_detail`.*,`book`.book_Title FROM `order_detail` LEFT JOIN `book` ON `order_detail`.book_ID = book.book_ID where `order_ID` = '".$row['order_ID']."'");
                                            while($row_books=mysqli_fetch_assoc($result_books)) { ?>
                                            <ul>
                                                <li><?php echo $row_books['book_Title'] ?> ( <?php echo $row_books['quantity'] ?> )</li>
                                            <?php
                                                $total_price += ($row_books['price']*$row_books['quantity']);
                                            ?>
                                            </ul>
                                        <?php    }
                                        ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $total_price ?>
                                        </th>
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="main_content_wrapper">
    </div>
    <!-- JavaScript -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/datatables.min.js"></script>
    <script src="../../js/slider_bar.js"></script>
    <script src="../../js/step.js"></script>
    <script>order_complete_table
        $(document).ready(function() {
            $('#order_request_table').DataTable( {
                "scrollX": true
            } );
            $('#order_claim_table').DataTable( {
                "scrollX": true
            } );
            $('#order_complete_table').DataTable( {
                "scrollX": true
            } );
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
            });  
        } );
    </script>
</body>
</html>