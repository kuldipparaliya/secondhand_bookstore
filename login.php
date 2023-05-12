<?php
include "config.php";
  session_start();

  if(isset($_SESSION['username'])){
    header("location: {$hostname}/index.php");
  }
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login-page</title>

    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <section>
      <div class="container">
        <div class="form-container">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" name="update-user" method="post">
            <div class="user-data">
              <div class="container-header">
                <h1 class="head">Login</h1>
              </div>

              <div class="username">
                <label for="uname">Username<span id="error" ><span></label>
                <input
                  type="text"
                  id="uname"
                  name="uname"
                  class="uname"
                  required
                />
              </div>
              <div class="password">
                <label for="password">Password<span id="error1" ><span></label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="password"
                  required
                />
              </div>
              <div class="book-save">
                <input type="submit" class="save" value="Login" name="login" />
              </div>
            </div>
          </form>
          <?php
            if(isset($_POST['login'])){
              $username =mysqli_real_escape_string($conn,$_POST['uname']);
              $pass =mysqli_real_escape_string($conn,md5($_POST['password']));

              $sql = "select * from user where username = '{$username}' and password ='{$pass}'";
             
              $result = mysqli_query($conn,$sql) or die("Query Failed!!!");
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  session_start();

                  $_SESSION['user_id'] = $row['user_id'];
                  $_SESSION['username'] = $row['username'];
                  $_SESSION['role'] = $row['role'];
                  header("location: {$hostname}");
                }
                
              }else{
                echo "<div style='color:red;font-weight:700;background-color:#990000;padding:10px;'>Username and password incorrect!!</div>";
            }
            }
          ?>
          <div class="create-container">
            <a href="registration.php" class="create">Create account &rarr;</a>
        </div>
        </div>
        
      </div>
    </section>
    <script type="text/javascript" src="js/login.js"></script>
  </body>
</html>
