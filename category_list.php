<?php 
  include "config.php" ;
  session_start();
  $limit = 3;
  if(isset($_GET['page'])){
    $page=$_GET['page'];
  }else{
    $page = 1;
  }
  $offset = ($page - 1) *$limit;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category list page</title>
    <link rel="stylesheet" href="css/category_list.css">
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

    <section>
      <div class="section">
        <div class="container-header">
          <h1 class="head">Category-list</h1>
        </div>
        <?php
          $sql = "select * from category order by category_id desc limit {$offset},{$limit}";
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){  
        ?>
        <table class="table">
          <tr>
            <th>S.NO.</th>
            <th>CATEGORY NAME</th>
            <th>NO.OF POST.</th>
            <?php
                if(isset($_SESSION['role']) && $_SESSION['role'] == 1){
                    echo "<th>EDIT</th>
                    <th>DELETE</th>";
                }
            ?>
            
          </tr>
          <?php
            while($row = mysqli_fetch_assoc($result)){
          ?>
          <tr>
            <td><?php echo $row['category_id'] ?></td>
            <td> <a href="category.php?cid=<?php echo $row['category_id']; ?>"><?php echo $row['category_name'] ?></a> </td>
            <td><?php echo $row['no_book'] ?></td>
            <?php
                if(isset($_SESSION['role']) && $_SESSION['role'] == 1){
                    echo '<td>

                    <a href="admin/update-category.php?cid='.$row["category_id"].'"><ion-icon name="create-outline"></ion-icon></a>
                  </td>
                  <td>
                    <a href="admin/delete-category.php?cid='.$row['category_id'].'"><ion-icon name="trash-outline"></ion-icon></a>
                  </td>';
                }
            ?>
            
          </tr>
          <?php
            }
          ?>
        </table>
        <?php
            }

            $sql1 = "select * from category";
            $result1 = mysqli_query($conn,$sql1) or die("Query not executed");
            if(mysqli_num_rows($result1)>0){
              $total_record = mysqli_num_rows($result1);

              $total_page = ceil($total_record/$limit);

              echo " <ul class='page-link-list'>";
              if($page>1){
                echo '<li class="link"><a class="page-link" href="category_list.php?page='.($page - 1).'">Prev</a></li>';
              }

              for($i=1;$i<=$total_page;$i++){
                if($i == $page){
                  $active = "active";
                }else{
                  $active = "";
                }
                echo '<li class="link '.$active.'"><a class="page-link" href="category_list.php?page='.$i.'">'.$i.'</a></li>';
              }
              if($page<$total_page){
                echo '<li class="link"><a class="page-link" href="category_list.php?page='.($page + 1).'">Next</a></li>';
              }
              echo "</ul>";
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