<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book</title>
    <link rel="icon" type="../../image/x-icon" href="img/favicon-32x32.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/slider_bar.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/book_menu.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="img/logo.svg" alt="" style="width: 125px; margin-left: 60px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 justify-content-end">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="php/book_menu/book_menu.php">Book Menu</a>
            </li>
            <li class="nav-item">
              <form action="php/login.php" target="_blank">
                <button type="submit" class="btn btn-login">Login</button>
              </form>
            </li>
          </ul>
        </div>
    </nav>


    <div class="card-wapper row">
      <div class="col-md-6 quote">
          <div>
            <h1>Sleep is good, <br> and books are better</h1>
            <p>Books really are your best friends as you can rely on them when you are bored, upset, depressed, lonely or annoyed. They will accompany you anytime you want them and enhance your mood. They share with you information and knowledge any time you need. Good books always guide you to the correct path in life.</p>
            <br>
            <button type="button" class="btn btn_create_new">
                <a href="php/book_menu/book_menu.php">Get Books</a>
            </button>
          </div>
      </div>
      <div class="col-md-6 pad-40 quote-img">
        <img src="img/cover.svg" alt="" style="width: 100%;">
      </div>
    </div>
    <div class="card-wapper row">
      <div class="col-12" style="text-align:center;">
        <h2 style="margin:30px 0px;">The Latest For You</h2>
        <p>Here are 5 of the top Books from these weeks that you don't want to miss.</p>
      </div>
      <div class="owl-carousel owl-theme"><?php
            include("php/config/config.php");
            $result = mysqli_query($conn,"SELECT book.*, category.category_Name, author.author_Name FROM book LEFT JOIN category ON book.category_ID = category.category_ID LEFT JOIN author ON book.author_ID = author.author_ID ORDER BY publish_date DESC LIMIT 5;");
        ?>
        <?php $i=1; while($row=mysqli_fetch_assoc($result)) {?>
            <div class="card-container">
              <form method="post" action="php/book_menu/book_menu.php">
                <div class="book-menu-card">
                    <img src="img/book_covers/<?php echo $row['book_cover'] ?>" alt="">
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
                          
                          <button type="submit" class="btn btn-primary btn-cart">Go Book Menu</button>
                        </div>
                    </div>
                </div>
              </form>    
            </div>
        <?php $i++;} ?>
      </div>
    </div>
    <div class="card-wapper pad-40 row">
      <div class="col-md-12 col-lg-6 quote-img key-feature1 row">
        <div class="col-md-6 col-lg-6">
          <img src="img/UpToDate.svg" alt="" style="width: 100%;">
        </div>
        <div class="col-md-6 col-lg-6">
          <h3>Up To Date</h3>
          <p>In addition to the books that have been published in the past, there are many books that are currently being published.</p>
          <!--  There are many different types of books available by different authors. -->
        </div>
      </div>
      <div class="col-md-12 col-lg-6 quote-img key-feature2 row">
        <div class="col-md-6 col-lg-6">
        <img src="img/payment.svg" alt="" style="width: 100%;">
        </div>
        <div class="col-md-6 col-lg-6">
          <h3>Easy Payment</h3>
          <p>You can pay when you get home and you can pay both onile banking payment and cash as you like.</p>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 quote-img key-feature3 row">
        <div class="col-md-6 col-lg-6">
        <img src="img/order.svg" alt="" style="width: 100%;">
        </div>
        <div class="col-md-6 col-lg-6">
          <h3>Simple UI</h3>
          <p>You can order book using simple and clean UI. It's too easy to use for everyone.</p>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 quote-img key-feature4 row">
        <div class="col-md-6 col-lg-6">
        <img src="img/deli.svg" alt="" style="width: 100%;">
        </div>
        <div class="col-md-6 col-lg-6">
          <h3>Delivery</h3>
          <p>We deliver to Yangon and other cities within 1 to 2 weeks and delivery charge free above 25000 MMK.</p>
        </div>
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
          <P>&#8195;&#8195;&#8195;We hope that <a style="color:var(--sec-color);" href="php/book_menu/book_menu.php">The Book(BookStore)</a> can help strengthen the fragile ecosystem and margins around bookselling and keep local bookstores an integral part of our culture and communities.</P>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    
    <script>
      $('.owl-carousel').owlCarousel({
        // loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:2,
                nav:true
            },
            1000:{
                items:3,
            }
        }
    })
    </script>
</body>
</html>