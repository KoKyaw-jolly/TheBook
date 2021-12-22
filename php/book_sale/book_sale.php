<?php
include("../config/auth.php");
include("../config/config.php");

require_once("../config/dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    case "add":
      $book_ID=$_GET["book_ID"];
      $result = $db_handle->runQuery("SELECT * FROM book where book_ID = '$book_ID'");
        $itemArray = array($result[0]["book_ID"]=>array('book_Title'=>$result[0]["book_Title"], 'book_ID'=>$result[0]["book_ID"], 'quantity'=>$_POST["quantity"], 'price'=>$result[0]["price"], 'book_cover'=>$result[0]["book_cover"]));
      
        if(!empty($_SESSION["sale_item"])) {
          if(in_array($result[0]["book_ID"],array_keys($_SESSION["sale_item"]))) {
            foreach($_SESSION["sale_item"] as $k => $v) {
                if($result[0]["book_ID"] == $k) {
                  if(empty($_SESSION["sale_item"][$k]["quantity"])) {
                    $_SESSION["sale_item"][$k]["quantity"] = 0;
                  }
                  $_SESSION["sale_item"][$k]["quantity"] += $_POST["quantity"];
                }
            }
          } else {
            $_SESSION["sale_item"] = array_merge($_SESSION["sale_item"],$itemArray);
          }
        } else {
          $_SESSION["sale_item"] = $itemArray;
        }
      
    break;
    case "remove":
      if(!empty($_SESSION["sale_item"])) {
        foreach($_SESSION["sale_item"] as $k => $v) {
          if($_GET["book_ID"] == $k)
            unset($_SESSION["sale_item"][$k]);				
          if(empty($_SESSION["sale_item"]))
            unset($_SESSION["sale_item"]);
        }
      }
      break;
    case "empty":
      unset($_SESSION["sale_item"]);
            break;
  }
  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Sale</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-32x32.png">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/datatables.min.css">
    <link rel="stylesheet" href="../../css/slider_bar.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/book_sale.css">
</head>
<body>    <!-- slider-bar Start -->
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
            <li>
                <a href="../order/order_list.php">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    <span class="links_name">Order Request List</span>
            </a>
            <span class="tooltip">Order Request List</span>
            </li>
            <li class="sidebar-active">
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
            <div class="main_content_header">Sale Report</div>
            <div class="main_content">
                <div class="form-wapper">
                    <div class="tab">
                        <?php
                            include("../config/config.php");
                            $result = mysqli_query($conn,"SELECT book.*, category.category_Name, author.author_Name FROM book LEFT JOIN category ON book.category_ID = category.category_ID LEFT JOIN author ON book.author_ID = author.author_ID order By book.book_ID");
                        ?>
                        <table id="book_list_table" class="table list display" style="width:100%">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Book ID</th>
                                <th scope="col">Book Title</th>
                                <th scope="col">Author</th>
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
                                            <?php echo $row['book_ID'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['book_Title'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['author_Name'] ?>
                                        </th>
                                        <th scope="row">
                                            <?php echo $row['price'] ?> MMK
                                        </th>
                                        <th scope="row">
                                            <form method="post" action="book_sale.php?action=add&book_ID=<?php echo $row['book_ID'] ?>">
                                                <div style="display:none;">
                                                    <input type="text" id="book_ID" name="book_ID" value="<?php echo $row['book_ID'] ?>">
                                                    <input type="text" id="quantity" name="quantity" value="1">
                                                </div>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
                                            </form>
                                        </th> 
                                    </tr>
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab">    
                        <?php if(isset($_SESSION["sale_item"])){ ?>	
                        <table id="book_sale_tablea" class="table list display" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Book Title</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">price</th>
                                <th scope="col">Total price</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php		
                                $i=0;
                                $total_quantity = 0;
                                $total_price = 0;
                                foreach ($_SESSION["sale_item"] as $item){
                                    $i+=1;
                                    $item_price = $item["quantity"]*$item["price"];
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $item["book_Title"]; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo number_format($item["price"],2); ?></td>
                                    <td><?php echo number_format($item_price,2); ?></td>
                                    <td><a href="book_sale.php?action=remove&book_ID=<?php echo $item["book_ID"]; ?>" class="del" onClick="return confirm('Are You Sure?')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                </tr>
                                    <?php
                                    $total_quantity += $item["quantity"];
                                    $total_price += ($item["price"]*$item["quantity"]);
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <td></td>
                                <td><b>Total Quantity</b></td>
                                <td><b><?php echo number_format($total_quantity,2); ?></b></td>
                                <td><b>Total Price</b></td>
                                <td><b><?php echo number_format($total_price,2); ?></b></td>
                                <td></td>
                                </tr>
                            </tfoot>
                        </table> 
                        
                        <?php } else { ?>
                            <div class="no-records" style="text-align: center;"><h4>Your Cart is Empty</h4></div>
                        <?php } ?>
                    </div>

                    <div style="overflow:auto;">
                    <div style="float:right;">
                        <form action="submit_sale.php" id="step-form">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary">Next</button>
                            <?php if(isset($_SESSION["sale_item"])){ ?>
                            <button type="submit" id="sale" class="btn btn-primary" style="display:none;">Sale</button>
                            <?php } ?>
                        </form>
                    </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
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
    <script>
        let menu_btn = document.querySelector("#menu-btn");
        let slide_bar = document.querySelector("#slide_bar");
        let slide_bar_back = document.querySelector("#slide_bar_back");

        menu_btn.onclick= function (){
            slide_bar.classList.toggle("active");
            slide_bar_back.classList.toggle("active");
        }
        slide_bar_back.onclick= function (){
            slide_bar.classList.toggle("active");
            slide_bar_back.classList.toggle("active");
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#book_list_table').DataTable( {
                "scrollX": true
            } );
        } );
    </script>
</body>
</html>