<?php
    include "config.php";
    session_start();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart page</title>
    <link rel="stylesheet" href="css/cart.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rokkitt:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </head>
  <body>
    <header class="header">
      <div class="container">
        <div class="logo-box">
          <a href="">
            <img
              class="web-logo"
              src="images/website-logo.png"
              alt="SECOND HAND BOOK"
            />
          </a>
        </div>
        <div class="search-box">
          <input class="search" type="text" placeholder="search" />
          <button class="btn">
            <ion-icon class="icon" name="search-outline"></ion-icon>
          </button>
        </div>
      </div>
    </header>
    <hr class="horizontal" />

    <nav class="nav">
      <ul class="navigation">
      <li class="nav-li"><a class="nav-link" href="index.php">HOME</a></li>
        <li class="nav-li"><a class="nav-link" href="profile.php?uid=<?php echo $_SESSION['user_id']; ?>">PROFILE</a></li>
        <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li">
          <a class="nav-link" href="category_list.php">CATEGORY</a>
        </li>
        <li class="nav-li"><a class="nav-link" href="contact.php">CONTACT</a></li>
        <li class="nav-li"><a class="nav-link" href="logout.php">HELLO <?php echo $_SESSION['username']; ?>, LOGOUT</a></li>
      </ul>
    </nav>
    <hr class="horizontal" />

    <section>
      <div class="section-container">
        <div class="title">
          <h1>
            <ion-icon class="bag-icon" name="bag-check-outline"></ion-icon>
            <span> My Cart</span>
          </h1>
        </div>
        <?php
          if(isset($_SESSION['cart'])){
        ?>
        <div>
          <table class="table">
            <tr>
              <th>S.NO.</th>
              <th>BOOK_ID</th>
              <th>BOOK_IMAGE</th>
              <th>BOOK_TITLE</th>
              <th>BOOK_OWNER</th>
              <th>BOOK_CATEGORY</th>
              <th>OLD_PRIZE</th>
              <th>PRIZE</th>
              <th>REMOVE</th>
            </tr>
            <?php
            $i=0;
            $total = 0;
            foreach($_SESSION['cart'] as $key => $value){
              $total += $value['prize'];
              $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $value['book_id']; ?></td>
              <td>
                <img class="book-img" src="admin/upload/<?php echo $value['book_image']; ?>" alt="book_image" />
              </td>
              <td><?php echo $value['book_title']; ?></td>
              <td><?php echo $value['username']; ?></td>
              <td><?php echo $value['category_name']; ?></td>
              <td><?php echo $value['old_prize']; ?>&#8377;</td>
              <td><?php echo $value['prize']; ?>&#8377;</td>
              <td>
                <form action="save_cart.php" method="post">
                  <input type="hidden" name="book_id" value=<?php echo $value['book_id'];?>>
                  <button class="delete-icon" name="remove"><ion-icon name="close-circle-outline"></ion-icon
                ></button>
                </form>
              </td>
            </tr>
            <?php
             }
            ?>
            <tr>
              <td colspan="7" class="total">TOTAL</td>
              <td colspan="2" class="value"><?php echo $total; ?>&#8377;</td>
            </tr>
          </table>
          <div class="button-container">
            <a class="button danger" name="empty" href="empty_cart.php">EMPTY CART</a>
            <a class="button amount" href="paytm/pgRedirect.php">PROCEED TO PAY</a>
          </div>

        </div>
        <?php
          }else{
            echo "<div style='color:red;padding:10px;background-color:#990000;font-weight:bold;'>Cart is empty!!</div>";
          }
        ?>
      </div>
    </section>
    <footer class="footer">
      <p>
        &#169; Copyright 2023 second hand book | Powered by
        <a class="wp-link" href="">WP team</a>
      </p>
    </footer>
  </body>
</html>
