<?php include "header.php";
  
if($_SESSION['role'] == 0){
  header("location: ../index.php");
}

?>
<?php
  include "config.php" ;
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User-page</title>
    <link rel="stylesheet" href="css/user.css" />

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
        <li class="nav-li"><a class="nav-link" href="category.php">CATEGORY</a></li>
      <li class="nav-li"><a class="nav-link" href="logout.php">Hello <?php echo $_SESSION['username']?>, LOGOUT</a></li>
         
      </ul>
      
    </nav>
    <hr class="horizontal" />
    <section>
      <div class="section-container">
        <div class="container-header">
          <h1 class="head">ALL USER</h1>
          <a class="btn" href="add-user.php">ADD USER</a>
        </div>
        <?php

        $sql = "select * from user order by user_id desc limit {$offset},{$limit}";
        $result = mysqli_query($conn,$sql) or die("query failed!!");

        if(mysqli_num_rows($result)>0){

    
        ?>
        <table class="table">
          <tr>
            <th>S.NO.</th>
            <th>FULL NAME</th>
            <th>USER NAME</th>
            <th>ROLE</th>
            <th>CONTACT NO.</th>
            <th>EMAIL</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
          <?php

            while($row = mysqli_fetch_assoc($result)){

          ?>
          <tr>
            <td><?php echo $row['user_id'] ?></td>
            <td><?php echo $row['first_name']." ". $row['last_name'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php 
            if($row['role']==1){
              echo "Admin";
            }else{
              echo "Normal User";
            }
            ?></td>
            <td><?php echo $row['contact'] ?></td>
            <td><?php echo $row['gmail'] ?></td>
            <td>
              <a href="update-user.php?id=<?php echo $row['user_id'] ?>"><ion-icon name="create-outline"></ion-icon></a>
            </td>
            <td>
              <a href="delete-user.php?id=<?php echo $row['user_id'] ?>"><ion-icon name="trash-outline"></ion-icon></a>
            </td>
          </tr>
          <?php
        }
        ?>
        </table>
        <?php
        }
          $sql1 = "select * from user";
          $result1 = mysqli_query($conn,$sql1) or die("Query Failed!!!");
          if(mysqli_num_rows($result1)>0){
            $total_record = mysqli_num_rows($result1);
            
            $total_page = ceil($total_record/$limit);
            
            echo '<ul class="page-link-list">';
            if($page>1){
              echo '<li class="link"><a class="page-link" href="user.php?page='.($page - 1).'">Prev</a></li>';
            }
            
            for($i=1;$i<=$total_page;$i++){
              if($i == $page){
                  $active = "active";
              }else{
                  $active = "";
              }
              echo '<li class="link '.$active.'"><a class="page-link" href="user.php?page='.$i.'">'.$i.'</a></li>';
            }
            if($page<$total_page){
              echo '<li class="link"><a class="page-link" href="user.php?page='.($page + 1).'">Next</a></li>';
            }
            echo "</ul>";
          }
        ?>
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
