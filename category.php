<?php
  include "config.php";
  session_start();
  $category_id = $_GET['cid'];
  $limit = 3;

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }
  
  $offset = ($page - 1) * $limit;

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Category-page</title>
    <link rel="stylesheet" href="css/category.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rokkitt:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
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
  <body>
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
        <?php

        if(isset($_SESSION['username'])){
          echo '<li class="nav-li"><a class="nav-link" href="profile.php?uid='.$_SESSION['user_id'].'">PROFILE</a></li>';
        }
        ?>
        <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li"><a class="nav-link" href="category_list.php">CATEGORY</a></li>
        <li class="nav-li"><a class="nav-link" href="contact.php">CONTACT</a></li>
        <?php
         
          if(isset($_SESSION['username'])){
            echo "<li class='nav-li'><a class='nav-link' href='logout.php'>Hello ".$_SESSION['username'].", LOGOUT</a></li>";
          }else{
            echo '<li class="nav-li"><a class="nav-link" href="login.php">LOGIN</a></li>';
          }
        ?>
      </ul>
    </nav>
    <hr class="horizontal" />

  
    <section class="section">
      <div class="head">
        <h2>Category:
          <?php
          $sql2 = "select category_name from category where category_id = {$category_id}";
          $result2 = mysqli_query($conn,$sql2) or die("Query Failed!!");
          $row2 = mysqli_fetch_assoc($result2);
          if(mysqli_num_rows($result2)>0){

            echo $row2['category_name'];
          }
         ?></h2>
      </div>
     
        
      <?php
          $sql1 = "select * from book
          left join user on book.book_author = user.user_id
          left join category on book.book_category = category.category_id
          where book.book_category = {$category_id}
          order by book_id desc limit {$offset},{$limit}";
          
          $result1 = mysqli_query($conn,$sql1) or die("Query Failed!!");
          if(mysqli_num_rows($result1)>0){
        ?>
        <table class="table">
          <tr>
            <th>Book_id</th>
            <th>Book_image</th>
            <th>Book_title</th>
            <th>Book_Owner</th>
            <th>Date</th>
            <th>Book-old-prize</th>
            <th>Book-prize</th>
            <?php
              if(isset($_SESSION['user_id'])){
                echo "<th>ADD TO CART</th>";
              }
            ?>
          </tr>
          <?php
           while($row1=mysqli_fetch_assoc($result1)){
          ?>
          <tr>
            <td><?php echo $row1['book_id'] ?></td>
            <td><img class="book-img" src="admin/upload/<?php echo $row1['book_image'] ?>" alt="book image" /></td>
            <td><?php echo $row1['book_title'] ?></td>
            <td><a href="profile.php?uid=<?php echo $row1['user_id'] ?>"><?php echo $row1['username'] ?></a></td>
            <td><?php echo $row1['date'] ?></td>
            <td><?php echo $row1['old_prize'] ?></td>
            <td><?php echo $row1['prize'] ?></td>
            <?php
              if(isset($_SESSION['user_id'])  && ($_SESSION['user_id'] != $row1['book_author'])){
                echo '<td>
                <form action="save_cart.php" method="post">
              <input type="hidden" name="book_id" value="'.$row1['book_id'].'">
             
              <button name="cart" class="cart-button"><ion-icon name="cart-outline"></ion-icon></button>
            </form>
                
              </td>';
              }elseif(isset($_SESSION['user_id'])){
                echo '<td>
              <a href="update-book.php?id='.$row1["book_id"] .'"
                ><ion-icon name="create-outline"></ion-icon
              ></a>
            </td>
          ';

              }
              
            ?>
            
            
          </tr>

          <?php
          
        }
          
          ?>
        </table>
        <?php
      }

      $sql = "select * from book where book_category = {$category_id}";
      $result = mysqli_query($conn,$sql) or die("Query Failed!!!");
      if(mysqli_num_rows($result)>0){
        echo '<ul class="page-link-list">';
        $total_record = mysqli_num_rows($result);

        $total_page = ceil($total_record/$limit);

        if($page>1){
          echo '<li class="link"><a class="page-link" href="category.php?cid='.$category_id.'&page='.($page-1).'">Prev</a></li>';
        }
        
        for($i=1;$i<=$total_page;$i++){
          if($i == $page){
            $active = 'active';
          }else{
            $active='';
          }
          echo '<li class="link '.$active.'"><a class="page-link" href="category.php?cid='.$category_id.'&page='.$i.'">'.$i.'</a></li>';
        }


        if($page<$total_page){
          echo '<li class="link"><a class="page-link" href="category.php?cid='.$category_id.'&page='.($page+1).'">Next</a></li>';
        }

      }else{
        echo "<div class= 'error'>NO Category available!!</div>";
      }

      ?>
    </section>
    <footer class="footer">
      <p>
        &#169; Copyright 2023 second hand book | Powered by
        <a class="wp-link" href="">WP team</a>
      </p>
    </footer>
  </body>
</html>