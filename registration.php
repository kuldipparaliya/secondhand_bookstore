<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration-page</title>

    <link rel="stylesheet" href="css/registration.css" />
  </head>
  <body>
    <section>
      <div class="container">
        <div class="form-container">
          <!-- <?php $_SERVER['PHP_SELF'] ?>  Handling code is available in same Page -->
          <form action="<?php $_SERVER['PHP_SELF']; ?>" name="update-user" method="post" enctype="multipart/form-data">
            <div class="container-header">
              <h1 class="head">Registration</h1>
            </div>
            <div class="user-data">
            <!-- For first name -->
              <div class="firstname">
                <label for="fname">Firstname<span id="error" class="span"></span> </label>
                <input
                  type="text"
                  id="fname"
                  name="fname"
                  class="fname"
                  required
                />
              </div>
              <!-- For last name -->
              <div class="lastname">
                <label for="lname">Lastname<span id="error1" class="span"></span> </label>
                <input
                  type="text"
                  id="lname"
                  name="lname"
                  class="lname"
                  required
                />
              </div>

              <!-- for username -->
              <div class="username">
                <label for="uname">Username<span id="error2" class="span"></span> </label>
                <input
                  type="text"
                  id="uname"
                  name="uname"
                  class="uname"
                  required
                />
              </div>
              <!-- For password -->
              <div class="password">
                <label for="password">Password<span id="error3" class="span"></span> </label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="password"
                  required
                />
              </div>
              <!-- For Gmail-->
              <div class="gmail">
                <label for="gmail">Email<span id="error4" class="span"></span> </label>
                <input
                  type="email"
                  id="gmail"
                  name="gmail"
                  class="email"
                  required
                />
              </div>
              <!-- For contact-->
              <div class="contact">
                <label for="contact">Contact NO.<span id="error5" class="span"></span> </label>
                <input
                  type="text"
                  id="contact"
                  name="contact"
                  class="contactno"
                  required
                />
              </div>
              
            </div>
            <div class="file">
                <label for="user_image">User Image</label>
                <input
                  type="file"
                  id="user_image"
                  name="user-image"
                  class="user-image image"
                  required 
                />
              </div>
            <div class="book-save">
              <input
                id="save"
                type="submit"
                class="save"
                value="Register"
                name="register"
              />
            </div>
          </form>
          
       
      <?php
        include "config.php";
        /* Check register button is click or not*/ 
          if(isset($_POST['register'])){

              $new_name = "user.jpg";
            /* Upload image into the folder is image is set */
            if(isset($_FILES['user-image'])){
              $errors = array();
              $file_name = $_FILES['user-image']['name'];
              $file_size = $_FILES['user-image']['size'];
              $file_temp = $_FILES['user-image']['tmp_name'];
              $file_type = $_FILES['user-image']['type'];
              /* Extract the extension of the page */
              $ext = explode('.',$file_name);
              $file_ext = end($ext);

              $extension = ['jpeg','jpg','png'];

              /* Check file format only jpeg,jpg and png allowed */
              if(in_array($file_ext,$extension)=== false){
                $errors[] ="This extension file not allowed,Please choose a jpg,jpeg or png file";
              }


              /* Maximum size allowed is 2MB */

              if($file_size >= 2097152){
                $errors[] = "File size must be less than 2MB";
              }
              $new_name = time().'-' . $file_name;
              $target = 'admin/upload/' . $new_name;
              $new_img = $new_name;
              

              /*If No error present then upload image into folder */
              if(empty($errors)  == true){
                move_uploaded_file($file_temp,$target);
              }else{
                print_r($errors);
                die();
              }
            }
            
            /* Collect the data and enter into the database */
            $role = 0;
            $fname = mysqli_real_escape_string($conn,$_POST['fname']);
            $lname = mysqli_real_escape_string($conn,$_POST['lname']);
            $uname = mysqli_real_escape_string($conn,$_POST['uname']);
            $password = mysqli_real_escape_string($conn,md5($_POST['password']));
            $gmail = mysqli_real_escape_string($conn,$_POST['gmail']);
            $contact = mysqli_real_escape_string($conn,$_POST['contact']);

            /* Check whether User already available or not */
            $sql = "select * from user where username = '{$uname}'";
            $result = mysqli_query($conn,$sql) or die("Select query failed!!");
            if(mysqli_num_rows($result)>0){
              echo '<div class="error-box">
              <h2 class="error">Username already Exist!!</h2>
            </div>';
            }else{
              /* Username is not present */
              $sql1 = "insert into user(first_name,last_name,username,password,role,gmail,contact,user_image) values('{$fname}','{$lname}','{$uname}','{$password}','{$role}','{$gmail}','{$contact}','{$new_name}')";
              $result1 = mysqli_query($conn,$sql1) or die("insert query failed!!");
              /*Redirect the page into the login.php */
              header("location: login.php");
            }
          }
      ?>
       </div>
      </div>
    </section>
    <script type="text/javascript" src="registration.js"></script>
  </body>
</html>
