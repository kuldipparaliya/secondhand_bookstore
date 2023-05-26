<?php include "header.php";

if($_SESSION['role'] == 0){
  header("location: ../index.php");
}
  
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update-Book-page</title>
    <link rel="stylesheet" href="css/update-book.css" />

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
          <a href="https://github.com/kuldipparaliya/secondhand_bookstore/tree/master">
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
          <h1 class="head">UPDATE BOOK</h1>
        </div>

        <?php
          include "config.php";

          $book_id = $_GET['id']; 
          
          $sql = "select * from book
          left join category on book.book_category = category.category_id
          left join user on book.book_author = user.user_id
          where book_id = {$book_id}";

          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="form-container">
          <form action="save-update-book.php" name="add-book" method="post">
            <div class="book-data">
              <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
              <div class="book-title">
                <label for="book-title">Book-title</label>
                <input
                  type="text"
                  id="book-title"
                  name="btitle"
                  class="btitle"
                  value="<?php echo $row['book_title']; ?>"
                  
                />
              </div>
              <div class="book-category">
                <label for="book-category">Book-category</label>
                <select class="category" name="category" id="book-category">
                  <option value="" disabled>Select Category</option>
                  <?php
                  include "config.php";
                  $sql1 = "select * from category";
                  $result1  = mysqli_query($conn,$sql1);
                  if(mysqli_num_rows($result1)>0){
                    while($row1 = mysqli_fetch_assoc($result1)){
                      if($row['book_category']==$row1['category_id']){
                        $active = "selected";
                      }else{
                        $active = "";
                      }
                      echo "<option value={$row1['category_id']} {$active}>".$row1['category_name']."</option>";
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
                  value="<?php echo $row['old_prize']; ?>"
                  
                />
              </div>
              <div class="actual-prize">
                <label for="actual-prize">Actual-prize</label>
                <input
                  type="gmail"
                  id="actual-prize"
                  name="prize"
                  class="aprize"
                  value="<?php echo $row['prize']; ?>"
                  
                />
              </div>
              <div class="file-image">
                <label for="file">Book-image</label>
                <!-- <input
                  class="upload-file"
                  type="file"
                  id="file"
                  name="new_image"
                  
                /> -->
                <img class="img" src="upload/<?php echo $row['book_image']; ?>" alt="book-image" />
                <input type="hidden" name="old_image" value="<?php echo $row['book_image']; ?>">
                
              </div>
              <div class="book-save">
                <input type="submit" class="save" value="Update" name="save" />
              </div>
            </div>
          </form>
          <?php
           }
          }else{
            echo "<div class= 'error'>NO Category available!!</div>";
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
  </body>
</html>
