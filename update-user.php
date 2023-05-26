<?php 
  include "config.php";
  session_start();
  if(!isset($_SESSION['username'])){
    header("location: {$hostname}");
  }
?>
<?php
  if(isset($_POST['save'])){
    $userid = mysqli_real_escape_string($conn,$_POST['user_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $uname = mysqli_real_escape_string($conn,$_POST['uname']);
    $contact = mysqli_real_escape_string($conn,$_POST['contact']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    
    $sql = "update user set first_name='{$fname}',last_name='{$lname}',username='{$uname}',contact='{$contact}',gmail='{$email}' where user_id = {$userid}";

    if( mysqli_query($conn,$sql)){
      header("Location: {$hostname}/profile.php?uid={$_SESSION['user_id']}");
    }
  }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update-User-page</title>
    <link rel="stylesheet" href="css/update-user.css" />

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
  <body id="body">
    
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
       <?php
       if(isset($_SESSION['username'])){
         echo '<li class="nav-li"><a class="nav-link" href="logout.php">Hello '.$_SESSION['username'].', LOGOUT</a></li>';
       }else{
         echo '<li class="nav-li"><a class="nav-link" href="login.php">LOGIN</a></li>';
       }
        ?> 
        
      </ul>
    </nav>
    <hr class="horizontal" />
    <section>
      <div class="section-container">
        <div class="container-header">
          <h1 class="head">UPDATE USER</h1>
        </div>
        <div class="form-container">
          <?php
          include "config.php";
          $user_id = $_GET['id'];
          $sql = "select * from user where user_id = {$user_id}";

          $result = mysqli_query($conn,$sql) or die("Query failed!!");

          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
              if($_SESSION['user_id'] != $row['user_id']){
                header("location: {$hostname}/profile.php?uid=".$_SESSION['user_id']."");
              }
              
          ?>
          <form action="<?php $_SERVER['PHP_SELF'];?>" name="update-user" method="post">
            <div class="user-data">

            <input
                  type="hidden"
                  id="user_id"
                  name="user_id"
                  class="userid"
                  value="<?php echo $row['user_id'];?>"
                  required
                />
              <div class="user-fname">
                <label for="fname">First-name</label>
                <input
                  type="text"
                  id="fname"
                  name="fname"
                  class="fname"
                  value="<?php echo $row['first_name'];?>"
                  required
                />
              </div>
              <div class="user-lname">
                <label for="lname">Last-name</label>
                <input
                  type="text"
                  id="lname"
                  name="lname"
                  class="lname"
                  value="<?php echo $row['last_name'];?>"
                  required
                />
              </div>
              <div class="username">
                <label for="uname">Username</label>
                <input
                  type="text"
                  id="uname"
                  name="uname"
                  class="uname"
                  value="<?php echo $row['username'];?>"
                  required
                />
              </div>
              <div class="user-contact">
                <label for="contact">contact NO.</label>
                <input
                  type="tel"
                  id="contact"
                  name="contact"
                  class="contact"
                  value="<?php echo $row['contact'];?>"
                  required
                />
              </div>
              <div class="user-email">
                <label for="email">Email.</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="email"
                  value="<?php echo $row['gmail'];?>"
                  required
                />
              </div>
              <!-- <div class="user-image">
                <label for="uimg">User-image</label>
                <input
                  class="user-img"
                  type="file"
                  id="uimg"
                  name="image"
                  required
                />
                <img class="img" src="author-1.jpg" alt="book-image" />
              </div> -->
              <div class="book-save">
                <input type="submit" class="save" value="Update" name="save" />
              </div>
            </div>
          </form>
          <?php
            }
          }
          ?>
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
