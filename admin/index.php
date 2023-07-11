<?php
  include "config.php";

  session_start();

  if(isset($_SESSION['username'])){
    header("location: {$hostname}/book.php");
  }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login-page</title>
    <!-- <link rel="stylesheet" href="update-user.css" /> -->
    <link rel="stylesheet" href="css/index.css">
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
    
    <section>
      <div class="container">
        
        <div class="form-container">
          
          <form action="<?php $_SERVER['PHP_SELF'] ?>" name="update-user" method="post">
            <div class="user-data">
              <div class="container-header">
                <h1 class="head">Login</h1>
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
                <label for="password">Password</label>
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
                include "config.php";
                $user = mysqli_real_escape_string($conn,$_POST['uname']);
                $pass = mysqli_real_escape_string($conn,md5($_POST['password']));

                $sql = "select user_id,username,role from user where username = '{$user}' and password = '{$pass}'";
                $result = mysqli_query($conn,$sql) or die("Query Failed!!");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        session_start();

                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = $row['role'];
                        if($row['role'] == 0){
                          header("location: ../index.php");
                        }else{
                          header("Location: {$hostname}/book.php");
                        }
                    }
                }else{
                    echo "<div style='color:red;font-weight:700;background-color:#990000;padding:10px;'>Username and password incorrect!!</div>";
                }
            }
          ?>
          
        </div>
      </div>
    </section>
   
  </body>
</html>
