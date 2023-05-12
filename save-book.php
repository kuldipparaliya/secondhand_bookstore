<?php
    include "config.php";

    if(isset($_FILES['image'])){
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $ext = explode('.',$file_name);
        $file_ext = end($ext);

        $extension = ['jpeg','jpg','png'];

        
        if(in_array($file_ext,$extension)=== false){
            $errors[] ="This extension file not allowed,Please choose a jpg,jpeg or png file";
        }

        if($file_size >= 2097152){
            $errors[] = "File size must be less than 2MB";
        }
        $new_name = time().'-' . $file_name;
        $target = 'admin/upload/' . $new_name;
        $new_img = $new_name;
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
?>