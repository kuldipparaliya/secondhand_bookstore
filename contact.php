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
          <a
            href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master"
          >
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
    <section id="contact" class="section--cta">
      <div class="cta">
        <div class="cta--header">
          <p class="cta--heading">Contact</p>
          <p class="cta--description">
            I am every day here for you. Contact me and stay in touch.
          </p>
        </div>

        <div class="cta--content">
          <div class="info">
            <ion-icon name="location-outline" class="cta--icon"></ion-icon>
            <p class="cta--title">Address</p>
            <p class="cta--value">LDCE hostel navarangpura,380015 Ahmedabad</p>
          </div>
          <div class="info">
            <ion-icon name="call-outline" class="cta--icon"></ion-icon>
            <p class="cta--title">Phone</p>
            <p class="cta--value">+931-311-8046</p>
          </div>
          <div class="info">
            <ion-icon name="mail-outline" class="cta--icon"></ion-icon>
            <p class="cta--title">Email</p>
            <p class="cta--value">kuldipparaliya6987@gmail.com</p>
          </div>
        </div>
      </div>

      <div class="cta--form">
        <div class="form--text--box">
          <div class="form--header">
            <p class="form--title">Contact form</p>
            <p class="form--description">You can contact me by filling form.</p>
          </div>

          <form class="form--grid" name="sign-up" netlify>
            <div class="name">
              <label for="name"> Full name </label>
              <input
                id="name"
                name="name"
                type="text"
                placeholder="paraliya kuldip"
                required
              />
            </div>
            <div class="email">
              <label for="email"> Email </label>
              <input
                name="email"
                id="email"
                type="email"
                title="Please enter valid email address"
                placeholder="kuldipparaliya6987@gmail.com"
                required
              />
            </div>
            <div class="phone">
              <label for="phone"> Phone </label>
              <input
                name="name"
                id="phone"
                type="tel"
                placeholder="+931-311-8046"
                title="Please enter valid contact number"
                required
              />
            </div>
            <button class="submit" id="submit">submit</button>
          </form>
        </div>
        <div class="form-img-box" role="img" aria-label="person image">
          <img class="form--img" src="person.jpg" alt="" />
        </div>
        <!-- <div class="form--img--box">
            <img class="hero--img person" src="person.jpg" alt="person image" />
          </div> -->
      </div>
    </section>
    <footer class="footer">
      <div class="footer--section">
        <div class="col--logo">
          <div class="footer--logo">
            <a
              href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master"
              ><img
                class="footer--img"
                src="images/website-logo.png"
                alt="secondhand book logo"
            /></a>
          </div>
          <div class="social--links">
            <ul class="social--link">
              <li>
                <a
                  href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master"
                  ><ion-icon name="logo-github"></ion-icon
                ></a>
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
            Copyright &copy; 2023 by Kuldip inc. All rights reserved.
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
