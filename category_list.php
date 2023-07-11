<?php 
  include "config.php" ;
  session_start();
  /* Set limit variable how many book is show into one page */
  $limit = 3;
  if(isset($_GET['page'])){
    /* If page variable not available then set 1 otherwise set respective page value set into the URL*/
    $page=$_GET['page'];
  }else{
    $page = 1;
  }
 /* Calculate the offset value*/
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
<body id="body">
<header class="header">
      <div class="container">
      <?php
       /* If  username and session cart variable is not set then set zero to the cart heading */
        if(isset($_SESSION['user_id'])){
          if(!isset($_SESSION['cart'])){
            $count = 0;
          }else{
            /* If  username and session cart variable is set then set length to the cart heading */
            $count = count($_SESSION['cart']);
          }
          /* If username is not set then not display cart section */
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
        <?php
        /* If  username is set then display profile link */
        if(isset($_SESSION['username'])){
          echo '<li class="nav-li"><a class="nav-link" href="profile.php?uid='.$_SESSION['user_id'].'">PROFILE</a></li>';
        }
        ?>
         <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li"><a class="nav-link" href="contact.php">CONTACT</a></li>
        <?php
         /* If username is set then display logout link with username*/
          if(isset($_SESSION['username'])){
            echo "<li class='nav-li'><a class='nav-link' href='logout.php'>Hello ".$_SESSION['username'].", LOGOUT</a></li>";
          }else{
            /* If username is not set then dispaly login link */
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
            /* If role is admin then give permission for update and delele the book*/
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
      /* Code for the pagination */
            $sql1 = "select * from category";
            $result1 = mysqli_query($conn,$sql1) or die("Query not executed");
            if(mysqli_num_rows($result1)>0){
              /* Fetch total number of rows present */
              $total_record = mysqli_num_rows($result1);
              /*Count number page required */
              $total_page = ceil($total_record/$limit);

              echo " <ul class='page-link-list'>";
              /* If $page value is grater then 1 then show prev button */
              if($page>1){
                echo '<li class="link"><a class="page-link" href="category_list.php?page='.($page - 1).'">Prev</a></li>';
              }
                /* print he total page number go for particular page*/
              for($i=1;$i<=$total_page;$i++){
                if($i == $page){
                  $active = "active";
                }else{
                  $active = "";
                }
                echo '<li class="link '.$active.'"><a class="page-link" href="category_list.php?page='.$i.'">'.$i.'</a></li>';
              }
              /* If $page value is not last value then print he next button*/
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
        <a class="wp-link" href="">Kuldip Paraliya</a>
      </p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/general.js"></script>
</body>
</html>