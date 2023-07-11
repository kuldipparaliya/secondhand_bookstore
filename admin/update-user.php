<?php include "header.php";
if($_SESSION['role']==0){
  header("location: ../index.php");
}?>
<?php
  include "config.php";

  if(isset($_POST['save'])){
    $userid = mysqli_real_escape_string($conn,$_POST['user_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $uname = mysqli_real_escape_string($conn,$_POST['uname']);
    $contact = mysqli_real_escape_string($conn,$_POST['contact']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);


    $sql = "update user set first_name='{$fname}',last_name='{$lname}',username='{$uname}',contact='{$contact}',gmail='{$email}',role='{$role}' where user_id = {$userid}";

    if( mysqli_query($conn,$sql)){
      header("Location: {$hostname}/user.php");
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
              <div class="user-role">
                <label for="role">Select user role</label>
                <select class="select" name="role" id="role" value="<?php echo $row['role']; ?>">
                  <?php
                     if($row['role']==1){
                      echo "<option value='0'>Normal role</option>
                      <option value='1' selected>Admin</option>";
                    }else{
                      echo "<option value='0' selected>Normal role</option>
                      <option value='1'>Admin</option>";
                    }
                  ?>
                  
                </select>
              </div>
              <div class="user-contact">
                <label for="contact">Contact NO.</label>
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
        &#169; Copyright 2024 second hand book | Powered by
        <a class="wp-link" href="">Kuldip Paraliya</a>
      </p>
    </footer>
  </body>
</html>
