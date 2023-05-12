<?php include "header.php";
if($_SESSION['role']==0){
  header("location: ../index.php");
}
?>
<?php
  if(isset($_POST['save'])){


    include "config.php";

    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $uname = mysqli_real_escape_string($conn,$_POST['uname']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));
    $contact = mysqli_real_escape_string($conn,$_POST['contact']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);


    $sql = "select username from user where username = '{$uname}'";

    $result = mysqli_query($conn,$sql) or die("Query failed!!");

    if(mysqli_num_rows($result)>0){
      echo "<p class='danger'>Username is already exists!!</p>";
    }else{
      $sql1 = "insert into user(first_name,last_name,username,password,role,gmail,contact) values('{$fname}','{$lname}','{$uname}','{$password}','{$role}','{$email}','{$contact}')";

      if(mysqli_query($conn,$sql1)){
        header("Location: {$hostname}/user.php");
      }
    }
  }

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADD-User-page</title>
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
          <h1 class="head">ADD USER</h1>
        </div>
        <div class="form-container">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" name="update-user" method="post">
            <div class="user-data">
              <div class="user-fname">
                <label for="fname">First-name</label>
                <input
                  type="text"
                  id="fname"
                  name="fname"
                  class="fname"
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
                  required
                />
              </div>
              <div class="password">
                <label for="pasword">Password</label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="password"
                  required
                />
              </div>
              <div class="user-role">
                <label for="role">Select user role</label>
                <select class="select" name="role" id="role">
                  <option value="0">Normal User</option>
                  <option value="1">Admin</option>
                </select>
              </div>
              <div class="user-contact">
                <label for="contact">contact NO.</label>
                <input
                  type="tel"
                  id="contact"
                  name="contact"
                  class="contact"
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
                  required
                />
              </div>
              
              <div class="book-save">
                <input type="submit" class="save" value="ADD" name="save" />
              </div>
            </div>
          </form>
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
