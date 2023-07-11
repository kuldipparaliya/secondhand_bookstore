<?php 
include "config.php";
$user_id = $_GET['uid'];
  session_start();
   /* Set limit variable how many book is show into one page */
  $limit = 3;
  /* If page variable not available then set 1 otherwise respective page value set into the URL*/
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }
/* Calculate the offset value*/
  $offset = ($page -1)*$limit;

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile-page</title>
    <link rel="stylesheet" href="css/profile.css" />
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
  <body id="body" >
    <header class="header">
      <div class="container">
      <?php
        if(isset($_SESSION['user_id'])){
          if(!isset($_SESSION['cart'])){
              /* If  user_id and session cart variable is not set then set zero to the cart heading */
            $count = 0;
          }else{
            /* If  user_id and session cart variable is set then set length to the cart heading */
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
        <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li"><a class="nav-link" href="category_list.php">CATEGORY</a></li>
        <li class="nav-li"><a class="nav-link" href="contact.php">CONTACT</a></li>
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
    <?php
     
      $sql = "select * from user where user_id = {$user_id}";
      $result = mysqli_query($conn,$sql) or die("Query Failed!!!");
      if(mysqli_num_rows($result)>0){

      
      $row = mysqli_fetch_assoc($result);
?>

    <section>
      <div class="section">
        <div class="background"></div>
        <div class="img-box">
          <img class="profile-img" src="admin/upload/<?php echo $row['user_image'] ?>" alt="profile picture" />
        </div>
        <div class="detail-container">
          <div class="profile-detail">
            <h2 class="name"><?php echo $row['first_name']; ?> <?php echo $row['last_name'];?></h2>
            <p class="contact">+91 <?php echo $row['contact']; ?></p>
            <p class="gmail"><?php echo $row['gmail']; ?></p>
          </div>
          <?php
          if(isset($_SESSION['user_id']) && $_SESSION['user_id']== $user_id){
            
            echo '<div>
            <a class="update-link" href="update-user.php?id='.$_SESSION["user_id"].'">Update</a>
          </div>';
          }
          ?>
          
        </div>
      </div>
    </section>
    <hr class="horizontal" />

    <div class="book-section">
      <div class="request-head">
        <h2>Sell request book:</h2>
      </div>
      <div>
        <?php
          $sql1 = "select * from book
          left join user on book.book_author = user.user_id
          left join category on book.book_category = category.category_id
          where book.book_author= {$user_id} order by book_id desc limit {$offset},{$limit}";
          
          $result1 = mysqli_query($conn,$sql1) or die("Query Failed!!");
          if(mysqli_num_rows($result1)>0){
        ?>
        <table class="table">
          <tr>
            <th>Book_id</th>
            <th>Book-image</th>
            <th>Book-title</th>
            <th>Book-category</th>
            <th>Date</th>
            <th>Book-old-prize</th>
            <th>Book-prize</th>
            
            <?php
            if(isset($_SESSION['user_id']) && $_SESSION['user_id']== $user_id){
              echo '<th>Edit-record</th>
              <th>Delete-record</th>';
            }
            ?>
             <?php
            if(isset($_SESSION['user_id']) && $_SESSION['user_id']!= $user_id){
              echo '<th>ADD TO CART</th>
              ';
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
            <td><a class="category-link" href="category.php?cid=<?php echo $row1['book_category']; ?>"><?php echo $row1['category_name'] ?></a></td>
            <td><?php echo $row1['date'] ?></td>
            <td><?php echo $row1['old_prize'] ?></td>
            <td><?php echo $row1['prize'] ?></td>
            <?php
            if(isset($_SESSION['user_id']) && $_SESSION['user_id']== $user_id){
              echo '<td>
              <a href="update-book.php?id='.$row1["book_id"] .'"
                ><ion-icon name="create-outline"></ion-icon
              ></a>
            </td>
            <td>
              <a
                href="delete-book.php?id='.$row1["book_id"].'&catid='.$row1["book_category"].'"
                ><ion-icon name="trash-outline"></ion-icon
              ></a>
           </td>';
            }
            ?>
             <?php
              if(isset($_SESSION['user_id']) && $_SESSION['user_id']!= $user_id){
                echo '<td>
                <form action="save_cart.php" method="post">
              <input type="hidden" name="book_id" value="'.$row1['book_id'].'">
             
              <button name="cart" class="cart-button"><ion-icon name="cart-outline"></ion-icon></button>
            </form>
                
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


          ?>
      </div>
    </div>
    <?php
      /* Code for the pagination */
      $sql2 = "select * from book where book_author = {$user_id}";
      $result2 = mysqli_query($conn,$sql2) or die("Query Failed!!");
      if(mysqli_num_rows($result2)>0){
        echo '<ul class="page-link-list">';
         /* Fetch total number of rows present */
        $total_record = mysqli_num_rows($result2);
         /*Count number page required */
        $total_page = ceil($total_record/$limit);
        /* If $page value is grater then 1 then show prev button */
        if($page>1){
          echo '<li class="link"><a class="page-link" href="profile.php?uid='.$user_id.'&page='.($page - 1).'">Prev</a></li>';
        }
         /* print he total page number go for particular page*/
        for($i=1;$i<=$total_page;$i++){
          if($i == $page){
            $active="active";
          }else{
            $active ="";
          }
          echo '<li class="link '.$active.'"><a class="page-link" href="profile.php?uid='.$user_id.'&page='.$i.'">'.$i.'</a></li>';
        }
        /* If $page value is not last value then print he next button*/
        if($page<$total_page){
          echo '<li class="link"><a class="page-link" href="profile.php?uid='.$user_id.'&page='.($page + 1).'">Next</a></li>';
        }
        echo "</ul>";
      }else{
        /* If sell request is not available then print error message*/
        echo "<div style='color:red;padding:10px;background-color:#990000;font-weight:bold;'>No sell request!!</div>";
      }
    }else{
      /* If user_id is not available then print error message*/
      echo "<div class='error'>No profile available!!</div>";
    }
    ?>
    
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
