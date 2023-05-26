<?php
  session_start();
  include "config.php";
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact page</title>
    <link rel="stylesheet" href="css/contact.css" />
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
        <?php
         /* If  username is set then display profile link */
        if(isset($_SESSION['username'])){
          echo '<li class="nav-li"><a class="nav-link" href="profile.php?uid='.$_SESSION['user_id'].'">PROFILE</a></li>';
        }
        ?>
        <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li">
          <a class="nav-link" href="category_list.php">CATEGORY</a>
        </li>

        <?php
          /* If username is set then display logout link with username*/
          if(isset($_SESSION['username'])){
            echo '<li class="nav-li"><a class="nav-link" href="logout.php">Hello '.$_SESSION['username'].', LOGOUT</a></li>';
          }else{
             /* If username is not set then dispaly login link */
            echo '<li class="nav-li"><a class="nav-link" href="login.php">LOGIN</a></li>';
          }
        ?>
      </ul>
    </nav>
    <hr class="horizontal" />
    <section>
      <div class="head">
        <h2>MEET OUR TEAM</h2>
      </div>
      <div class="guide-box">
        <h4 class="guide">
          Project-Guide:<span class="guide_name">Prof.Shraddha Ma'm</span>
        </h4>
      </div>
      <?php
      $sql = "select * from team";
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
          
      ?>

      <div class="section-container">
        <div class="contact-box">
          <img class="img" src="admin/upload/<?php echo $row['member_img'] ?>" alt="" />
          <h2 class="name">
            <ion-icon class="large" name="people-outline"></ion-icon><?php echo $row['member_name'] ?>
          </h2>
          <div class="enroll">
            <ion-icon class="contain" name="earth-outline"></ion-icon>
            <span><?php echo $row['enroll'] ?></span>
          </div>
          <div class="number">
            <ion-icon class="contain" name="call-outline"></ion-icon>
            <span>+91 <?php echo $row['contact'] ?></span>
          </div>
          <div class="email">
            <ion-icon class="contain" name="mail-outline"></ion-icon>
            <span><?php echo $row['email'] ?></span>
          </div>
        </div>
        <?php
          }
        }
        ?>
      </div>
    </section>

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
            copyright &copy; 2023 by WP TEAM inc. All rights reserved.
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
                >wpteam2K23@gmail.com</a
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