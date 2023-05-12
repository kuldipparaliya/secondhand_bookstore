<?php include "header.php";
if($_SESSION['role']==0){
  header("location: ../index.php");
}
  ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update-Category-page</title>
    <link rel="stylesheet" href="css/update-category.css" />

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
        
        <div class="logo-box">
          <a href="">
            <img
              class="web-logo"
              src="css/website-logo.png"
              alt="SECOND HAND BOOK"
            />
          </a>
        </div>
        
      </div>
    </header>
    <hr class="horizontal" />

    <nav class="nav">
      <ul class="navigation">
      <li class="nav-li"><a class="nav-link" href="../index.php">HOME</a></li>
        <li class="nav-li"><a class="nav-link" href="../profile.php?uid=<?php echo $_SESSION['user_id']?>">PROFILE</a></li>
        
        <li class="nav-li"><a class="nav-link" href="book.php">BOOKS</a></li>
        <li class="nav-li"><a class="nav-link" href="user.php">USER</a></li>
        <li class="nav-li"><a class="nav-link" href="category.php">CATEGORY</a></li>
      <li class="nav-li"><a class="nav-link" href="logout.php">Hello <?php echo $_SESSION['username']?>, LOGOUT</a></li>
         
      </ul>
      
    </nav>
    <hr class="horizontal" />
    <section>
      <div class="section-container">
        <div class="container-header">
          <h1 class="head">Update Category</h1>
        </div>
        <div class="form-container">
          
        <?php
        include "config.php";
        $cid = $_GET['cid'];
        
        $sql = "select * from category where category_id = {$cid}";

        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($result);

        ?>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" name="update-category" method="post">
            <div class="category-data">
              <div class="category-name">
                <label for="category-name">Category-name</label>
                <input
                  type="text"
                  id="category-name"
                  name="ctitle"
                  class="ctitle"
                  value="<?php echo $row['category_name']; ?>"
                  required
                />
              </div>

              <div class="book-save">
                <input type="submit" class="save" value="save" name="save" />
              </div>
            </div>
          </form>

          <?php

          if(isset($_POST['save'])){
            $category_name = mysqli_real_escape_string($conn,$_POST['ctitle']);
            $sql1 = "update category set category_name = '{$category_name}' where category_id = {$cid}";

            if(mysqli_query($conn,$sql1)){
              header("Location: {$hostname}/category.php");
            }
          }
          ?>
        </div>
      </div>
    </section>
    <footer class="footer">
      <p>
        &#169; Copyright 2024 second hand book | Powered by
        <a class="wp-link" href="">WP team</a>
      </p>
    </footer>
  </body>
</html>
