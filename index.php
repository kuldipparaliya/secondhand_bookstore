<?php
  session_start();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Second hand book</title>
    <link rel="stylesheet" href="css/style.css" />
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
  <body id="body">
    <header class="header">
      <div class="container">
       
        <?php
         /* If username is set then check cart variable is set or not */
        if(isset($_SESSION['user_id'])){
          /* If cart set then set the length */
          if(!isset($_SESSION['cart'])){
            $count = 0;
          }else{
            $count = count($_SESSION['cart']);
          }
          /* If username is not set then cart section is not display */
          echo'<div class="cart-box">
          <a href="cart.php" class="total-cart"
            ><ion-icon  name="cart-outline"></ion-icon
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

      <?php
      /*If username set and role is admin then display ADMIN PANEL */
        if(isset($_SESSION['user_id']) && $_SESSION['role'] == 1){
          echo ' <li class="nav-li"><a class="nav-link" href="admin/index.php">ADMIN PANEL</a></li>';
        }
        ?>  
        <?php
        /* If username set then display Profile otherwise display Home link */
        if(isset($_SESSION['user_id'])){
          echo ' <li class="nav-li"><a class="nav-link" href="profile.php?uid='.$_SESSION['user_id'].'">PROFILE</a></li>';
        }else{
          echo '<li class="nav-li"><a class="nav-link" href="index.php">HOME</a></li>';
        }
        ?>       
        <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li"><a class="nav-link" href="category_list.php">CATEGORY</a></li>
        <!-- <li class="nav-li"><a class="nav-link" href="category.php">CATEGORY</a></li> -->
        <li class="nav-li"><a class="nav-link" href="contact.php">CONTACT</a></li>
        <?php
          
          /* If username is set then display logout link with username otherwise display login link */ 
          if(isset($_SESSION['username'])){
            echo '<li class="nav-li"><a class="nav-link" href="logout.php">Hello '.$_SESSION['username'].', LOGOUT</a></li>';
          }else{
            echo '<li class="nav-li"><a class="nav-link" href="login.php">LOGIN</a></li>';
          }
        ?>
      </ul>
      
    </nav>

    <section class="section">
      <!-- <div class="container-section"> -->
      <div class="text-box">
        <div class="heading">
          <h1>Good books don't give up all their secrets at once.</h1>
        </div>
        <div class="desc">
          <p>Buy and sell second hand books easily.</p>
        </div>
        <div class="btn-container">
          <a href="book.php" class="button btn-book">VIEW ALL BOOKS</a>
          <a href="login.php" class="button btn-sign">SIGN IN &#8594;</a>
        </div>
      </div>
      <!-- </div> -->
      <div class="guide-box">
        <h4 class="guide">
          <span class="name">Prof. Shraddha Ma'm</span>
        </h4>
      </div>
    </section>
    <div class="main-section">
      <div class="design-section">
        <div class="icon-box">
          <img class="icon-img" src="images/toy.png" alt="toy image" />
        </div>
        <h3 class="icon-title">Children book</h3>
      </div>
      <div class="design-section">
        <div class="icon-box">
          <img class="icon-img" src="images/course.png" alt="course image" />
        </div>

        <h3 class="icon-title">Course book</h3>
      </div>
      <div class="design-section">
        <div class="icon-box">
          <img class="icon-img" src="images/art.png" alt="art image" />
        </div>

        <h3 class="icon-title">Art & architecture</h3>
      </div>
      <div class="design-section">
        <div class="icon-box">
          <img class="icon-img" src="images/history.png" alt="history image" />
        </div>
        <h3 class="icon-title">history</h3>
      </div>
    </div>
    <!-- <hr /> -->

    <section class="book" id="book">
      <div class="section-title">
        <h1>BOOKS</h1>
      </div>
      <div class="book-header">
        <a class="buy-link" href="book.php">BOOK ON SELL &rarr;</a>
      </div>
      

      <div class="book-container">
      <?php
      /*Display latest 3 book added */
          include "config.php";
          $record = 3;
          $offset = 0;
          if(isset($_SESSION['user_id'])){
            /* If username is set then display only book which username is not equal with book_author*/
            $sql = "select * from book
            left join user on book.book_author = user.user_id 
            where book.book_author != {$_SESSION['user_id']}
            order by book_id desc limit {$offset},{$record}";
          }else{
            /*If username is not set then display latest 3 book  */
            $sql = "select * from book
            left join user on book.book_author = user.user_id 
            order by book_id desc limit {$offset},{$record}";
          }
          
          $result = mysqli_query($conn,$sql);
          
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
            
      ?>
        <div class="book-box">
          <div>
            <img class="book-img" src="admin/upload/<?php echo $row['book_image'] ?>" alt="book image" />
          </div>

          <div class="book-content">
            <h4 class="book-name">
              <ion-icon class="padding" name="book-outline"></ion-icon
              ><span><?php echo $row['book_title']; ?></span>
            </h4>
            <p book-author>
              <ion-icon class="padding" name="person-outline"></ion-icon
              ><span><a class="user-link" href="profile.php?uid=<?php echo $row['book_author']; ?>"><?php echo $row['username']; ?></a></span>
            </p>
            <p class="prize">
              <ion-icon class="padding" name="wallet-outline"></ion-icon
              ><span><?php echo $row['prize']; ?>&#8377;</span>
            </p>
            <form action="save_cart.php" method="post">
              <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
              <button name="cart" class="cart-button">ADD TO CART</button>
            </form>
          </div>
        </div>
        <?php
            }
          }
        ?>
        
      </div>

      <div class="sell-header">
        <a class="sell-link" href="sell.php">SELL YOUR BOOK &rarr;</a>
      </div>
    </section>

    <hr />

    <footer class="footer">
      <div class="footer--section">
        <div class="col--logo">
          <div class="footer--logo">
            <a href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master"
              ><img
                class="footer--img"
                src="images/website-logo.png"
                alt="secondhand book logo"
            /></a>
          </div>
          <div class="social--links">
            <ul class="social--link">
              <li>
                <a href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master"
                  ><ion-icon name="logo-github"></ion-icon></a>
              </li>
              <li>
                <a href="#"
                  ><ion-icon
                    name="logo-facebook"
                    class="footer--icon"
                  ></ion-icon
                ></a>
              </li>
              <li>
                <a href="#"
                  ><ion-icon name="logo-twitter" class="footer--icon"></ion-icon
                ></a>
              </li>
            </ul>
          </div>
          <p class="copyright">
            Copyright &copy; 2023 by kuldip inc. All rights reserved.
          </p>
        </div>
        <div class="contact me">
          <h4 class="footer--heading">Contact us</h4>
          <address class="contacts">
            <p class="address">LDCE hostel navarangpura, 380015 ahemadabad</p>
            <p>
              <a href="tel:111-222-3333" class="footer--link">931-311-8046</a
              ><br />
              <a href="mailto:me@exapmle.com" class="footer--link"
                >kuldipparaliya6987@gmail.com</a
              >
            </p>
          </address>
        </div>
        <div class="aboutme">
          <h4 class="footer--heading">About-us</h4>
          <ul class="list--style">
            <li><a class="footer--link" href="#">careers</a></li>
            <li><a class="footer--link" href="#">Graduation</a></li>
          </ul>
        </div>
        <div class="resources">
          <h4 class="footer--heading">resources</h4>
          <ul class="list--style">
            <li><a class="footer--link" href="#">Help center</a></li>
            <li><a class="footer--link" href="#">privacy & terms</a></li>
          </ul>
        </div>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/general.js"></script>
  </body>
</html>