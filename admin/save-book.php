<?php
    include "config.php";
    if($_SESSION['role']==0){
        header("location: ../index.php");
      }

    if(isset($_FILES['image'])){
         /* Check register button is click or not*/ 
        $errors = array();
        /* Upload image into the folder is image is set */
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

         /* Extract the extension of the page */
        $ext = explode('.',$file_name);
        $file_ext = end($ext);

        $extensions =array('jpeg','jpg','png');
        /* Check file format only jpeg,jpg and png allowed */
        if(in_array($file_ext,$extensions)=== false){
            $errors[] ="This extension file not allowed,Please choose a jpg,jpeg or png file";
        }
        /* Maximum size allowed is 2MB */
        if($file_size >= 2097152){
            $errors[] = "File size must be less than 2MB";
        }

        $new_name = time().'-'.$file_name;
        $target = 'upload/'.$new_name;
        $new_img = $new_name;
         /*If No error present then upload image into folder */
        if(empty($errors)  == true){
            move_uploaded_file($file_temp,$target);
        }else{
            print_r($errors);
            die();
        }
    }
    session_start();

    $booktitle = mysqli_real_escape_string($conn,$_POST['btitle']);
    $category = mysqli_real_escape_string($conn,$_POST['book-category']);
    $oldprize = mysqli_real_escape_string($conn,$_POST['oprize']);
    $actualprize = mysqli_real_escape_string($conn,$_POST['actual-prize']);
    $date = date('d M, Y');
    $bookauthor = $_SESSION['user_id'];

    $sql ="insert into book(book_title,book_category,book_author,date,book_image,old_prize,prize) values('{$booktitle}',{$category},{$bookauthor},'{$date}','{$new_img}',{$oldprize},{$actualprize})";

    $sql1 = "update category set no_book = no_book + 1 where category_id = {$category}";

    // $sql.="update category set no_book = no_book + 1 where category_id = {$category}";

    if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){
        header("location: {$hostname}/book.php");
    }else{
        echo "<div style='color:red;background-color:#990000;padding:10px;'>Query Failed!!</div>";
    }



    // if(mysqli_multi_query($conn,$sql)){
    //     header("location, {$hostname}/book.php");
    // }else{
    //     echo "<div style='color:red;background-color:#990000;padding:10px;'>Query Failed!!</div>";
    // }
    ?>