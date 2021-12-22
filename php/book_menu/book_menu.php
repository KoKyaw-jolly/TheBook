<?php
session_start();
include("../config/config.php");

require_once("../config/dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    case "add":
      $book_ID=$_GET["book_ID"];
      $result = $db_handle->runQuery("SELECT * FROM book where book_ID = '$book_ID'");
        $itemArray = array($result[0]["book_ID"]=>array('book_Title'=>$result[0]["book_Title"], 'book_ID'=>$result[0]["book_ID"], 'quantity'=>$_POST["quantity"], 'price'=>$result[0]["price"], 'book_cover'=>$result[0]["book_cover"]));
      
        if(!empty($_SESSION["cart_item"])) {
          if(in_array($result[0]["book_ID"],array_keys($_SESSION["cart_item"]))) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($result[0]["book_ID"] == $k) {
                  if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                  }
                  $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                }
            }
          } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
        }
      
    break;
    case "remove":
      if(!empty($_SESSION["cart_item"])) {
        foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["book_ID"] == $k)
            unset($_SESSION["cart_item"][$k]);				
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
        }
      }
      break;
    case "empty":
      unset($_SESSION["cart_item"]);
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
    <title>Book Menu</title>
    <link rel="icon" type="image/x-icon" href="../../img/favicon-32x32.png">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/datatables.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/book_menu.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../../index.php"><img src="../../img/logo.svg" alt="" style="width: 125px; margin-left: 60px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 justify-content-end">
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="book_menu.php">Book Menu</a>
            </li>
            <li class="nav-item">
              <form action="../login.php" target="_blank">
                <button type="submit" class="btn btn-login">Login</button>
              </form>
            </li>
          </ul>
        </div>
    </nav>

    <!-- <div class="row book-menu-wapper" id="book-menu-wapper"> -->
  <div class="card-wapper pad-40 row" id="book-menu-wapper">
    <?php
            include("../config/config.php");
            $result = mysqli_query($conn,"SELECT book.*, category.category_Name, author.author_Name FROM book LEFT JOIN category ON book.category_ID = category.category_ID LEFT JOIN author ON book.author_ID = author.author_ID order By book.book_ID");
            // $result = mysqli_query($conn,"Select * from category");
        ?>
        <?php $i=1; while($row=mysqli_fetch_assoc($result)) {?>
            <div class="card-container col-sm-6 col-md-6 col-lg-4">
              <form method="post" action="book_menu.php?action=add&book_ID=<?php echo $row['book_ID'] ?>">
                <div class="book-menu-card">
                    <img src="../../img/book_covers/<?php echo $row['book_cover'] ?>" alt="">
                    <div class="book-menu-card-detail active">
                        <div class="card-header">
                            <?php echo $row['book_Title'] ?>
                            <!-- <span class="down-arrow"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                            <span class="up-arrow"><i class="fa fa-chevron-up" aria-hidden="true"></i></span> -->
                        </div>
                        <div class="card-desc">
                          <div style="display:none;">
                            <input type="text" id="book_ID" name="book_ID" value="<?php echo $row['book_ID'] ?>" readonly>
                            <input type="text" id="quantity" name="quantity" value="1" readonly>
                          </div>
                          <ul>
                            <li><i class="fa fa-user" aria-hidden="true"></i><?php echo $row['author_Name'] ?></li>
                            <li><i class="fa fa-suitcase" aria-hidden="true"></i><?php echo $row['category_Name'] ?></li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $row['publish_date'] ?></li>
                            <li><i class="fa fa-tags" aria-hidden="true"></i><?php echo $row['price'] ?> MMK</li>
                          </ul>
                          <button type="submit" class="btn btn-primary btn-cart"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add to Cart</button>
                          <!-- <input type="submit" value="Add to Cart" class="btnAddAction" /> -->
                        </div>
                    </div>
                </div>
              </form>    
            </div>
        <?php $i++;} ?>
    </div>
  
  <div class="cart-btn" id="cart-btn"><i id="icon-cart" class="fa fa-shopping-cart" aria-hidden="true"></i><i id="icon-back" class="fa fa-arrow-left icon-hide" aria-hidden="true"></i></div>

  
  <div class="cart-list-wapper" id="cart-list-wapper">
      <div class="card-wapper pad-40">
        <?php
        if(isset($_SESSION["cart_item"])){
        ?>	
        <div style="padding:15px;">
          <h1>Your Cart List</h1>
          <div style="width: 100%;overflow: auto;">
              <table id="book_cart_tablea" class="table list display" style="width:100%;">
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
                        foreach ($_SESSION["cart_item"] as $item){
                            $i+=1;
                            $item_price = $item["quantity"]*$item["price"];
                      ?>
                        <tr>
                          <td><?php echo $i ?></td>
                          <td><?php echo $item["book_Title"]; ?></td>
                          <td><?php echo $item["quantity"]; ?></td>
                          <td><?php echo number_format($item["price"],2); ?></td>
                          <td><?php echo number_format($item_price,2); ?></td>
                          <td><a href="book_menu.php?action=remove&book_ID=<?php echo $item["book_ID"]; ?>" class="del" onClick="return confirm('Are You Sure?')">
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
          </div> 
        </div>

        <form action="submit-order.php" method="post" >
            <div class="form-group row">
              <div class="col-md-6 m-bot-15">
                  <label for="customer_name">Customer Name</label>
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name" required>
              </div>
              <div class="col-md-6 m-bot-15">
                <label for="phone_number">Phone Number</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="09 xxxxxxxx" required>
              </div>
            </div>
            
            <div class="form-group row">
              <div class="col-md-6 m-bot-15">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
              </div>
              <div class="col-md-6 m-bot-15">
                <label for="order_address">Address</label>
                <input type="text" class="form-control" id="order_address" name="order_address" placeholder="Address" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 m-bot-15">
                <label for="remark">Remark</label>
                <input type="text" class="form-control" id="remark" name="remark" placeholder="Remark">
                <button type="submit" class="btn btn-primary" style="margin-top:30px;">Order</button>
              </div>
            </div>
        </form>
        
        <?php
          } else {
        ?>
        <div class="no-records"><h3 style="text-align:center;">Your Cart is Empty</h3></div>
        <?php 
          }
        ?>
    </div>
  </div>

  <footer class="row">
      <div class="col-md-6">
          <h4 style="color:var(--sec-color);">About Us</h4>
          <P>&#8195;&#8195;&#8195;We are one of the book store in myanmar. We believe that bookstores are essential to a healthy culture. They’re where authors can connect with readers, where we discover new writers, where children get hooked on the thrill of reading that can last a lifetime. They’re also anchors for our downtowns and communities. Our main function are-</P>
            <ul style="font-size:14px;">
              <li>UpToDate Books</li>
              <li>Easy Payment Method</li>
              <li>Clean And Simple UI For Book Order</li>
              <li>Deliver To All City</li>
            </ul>
          <P>&#8195;&#8195;&#8195;We hope that <a style="color:var(--sec-color);" href="book_menu.php">The Book(BookStore)</a> can help strengthen the fragile ecosystem and margins around bookselling and keep local bookstores an integral part of our culture and communities.</P>
      </div>
      <div class="col-md-6">
          <h4 style="color:var(--sec-color);">Address</h4>
          <P>Shop1 - NO(30/32), U Tun Lin Chan St, Hledan, Kamaryut Township,Yangon, Myanmar. <br>&#8195;&#8195;&#8195;&#8195;Ph: 01-365956, 01-365957, 09-975413682</P>
          <P>Shop1 - No(65) 40th St, Kyauktadar Township,Yangon, Myanmar. <br>&#8195;&#8195;&#8195;&#8195;Ph: 01-657892, 01-657893, 09-975413683</P>
          <div>
            <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="https://accounts.google.com" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a>
          </div>
      </div>
      <div class="col-12">
        <p class="copyright">Copyright 2021 by Refsnes Data. All Rights Reserved. Powered by Ko Ko Kyaw</p>
        <p class="copyright"> </p>
      </div>
    </footer>


    <!-- JavaScript -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/datatables.min.js"></script>
    <script>
        let cart_btn = document.querySelector("#cart-btn");
        let book_menu = document.querySelector("#book-menu-wapper");
        let cart_list = document.querySelector("#cart-list-wapper");
        let icon_cart = document.querySelector("#icon-cart");
        let icon_back = document.querySelector("#icon-back");

        cart_btn.onclick= function (){
          book_menu.classList.toggle("b-active");
          cart_list.classList.toggle("cart-active");
          icon_cart.classList.toggle("icon-hide");
          icon_back.classList.toggle("icon-hide");
        }
    </script>
</body>
</html>