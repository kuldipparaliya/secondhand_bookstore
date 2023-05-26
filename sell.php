<?php
  include "config.php";
  session_start();
  if(!isset($_SESSION['user_id'])){
    header("location: {$hostname}/login.php");
  }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sell-page</title>
    <link rel="stylesheet" href="css/sell.css" />

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>

    <script
      defer
      src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"
    ></script>
  </head>
  <body id="body" >
    
    <header class="header">
    
      <div class="container">
      <?php
        if(isset($_SESSION['user_id'])){
          if(!isset($_SESSION['cart'])){
            $count = 0;
          }else{
            $count = count($_SESSION['cart']);
          }
          echo'<div class="cart-box">
          <a href="cart.php" class="total-cart"
            ><ion-icon name="cart-outline"></ion-icon
          ></a>
          <div class="do">'.$count.'</div>
        </div>';
        }
        ?>
        <div class="logo-box">
          <a href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master">
            <img
              class="web-logo"
              src="images/website-logo.png"
              alt="SECOND HAND BOOK"
            />
          </a>
        </div>
        <div class="search-box">
          <input class="search" id="search" type="text" placeholder="search" />
          <button class="btn" id="button">
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
        <li class="nav-li"><a class="nav-link" href="category_list.php">CATEGORY</a></li>
        <li class="nav-li"><a class="nav-link" href="contact.php">CONTACT</a></li>
        <li class="nav-li"><a class="nav-link" href="logout.php">Hello <?php echo $_SESSION['username'] ?>, LOGOUT</a></li>
      </ul>
    </nav>
    <hr class="horizontal" />
    <section>
      <div class="section-container">
        <div class="container-header">
          <h1 class="head">SELL BOOK</h1>
        </div>
        <div class="form-container">
          <form
            action="save-book.php"
            name="add-book"
            method="post"
            enctype="multipart/form-data"
          >
            <div class="book-data">
              <div class="book-title">
                <label for="book-title">Book-title</label>
                <input
                  type="text"
                  id="book-title"
                  name="btitle"
                  class="btitle"
                  required
                />
              </div>

              <div class="book-category">
                <label for="book-category">Book-category</label>
                <select name="book-category" id="book-category">
                  <option disabled>Select Category</option>
                  <?php
                    include "config.php";
                    $sql = "select * from category";
                    $result = mysqli_query($conn,$sql) or die("Query Failed!!");
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['category_id']}'>".$row['category_name']."</option>";
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="old-prize">
                <label for="old-prize">Old-prize</label>
                <input
                  type="text"
                  id="old-prize"
                  name="oprize"
                  class="oprize"
                  required
                />
              </div>
              <div class="actual-prize">
                <label for="actual-prize">Actual-prize</label>
                <input
                  type="gmail"
                  id="actual-prize"
                  name="actual-prize"
                  class="aprize"
                  required
                />
              </div>
              <div class="file-image">
                <label for="file">Book-image</label>
                <input class="file" type="file" id="file" name="image" required />
              </div>
              <div class="book-save">
                <input type="submit" class="save" value="SELL" name="sell" />
                <input type="reset" class="reset" value="RESET" name="reset" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <footer class="footer">
      <p>
        &#169; Copyright 2023 second hand book | Powered by
        <a class="wp-link" href="">WP team</a>
      </p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/general.js"></script>
  </body>
</html>
